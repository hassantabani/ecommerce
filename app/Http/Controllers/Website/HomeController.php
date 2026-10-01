<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Order;
use App\Models\Products;
use App\Models\ShippingMethod;
use App\Models\Tracking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Session;

class HomeController extends Controller
{

    protected $phone;
    protected $password;

    public function __construct()
    {
        $this->phone = '923123456789';
        $this->password = '12345678';
    }


    public function getToken()
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://dev.digidokaan.pk/api/v1/digidokaan/auth/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => array('phone' => $this->phone, 'password' => $this->password),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $response = json_decode($response);
        $token = $response->token;
        return $token;
    }

    public function index(){
        $products = Products::where('status',1)->get();
        $latests = Products::where('status',1)->latest()->take(5)->get();
        $productSales = [];
        $productProfit = [];

        $orders = Order::all();
        
        foreach ($orders as $order) {
            $cartItems = json_decode($order->cart_items);
        
            foreach ($cartItems as $item) {
                $productId = $item->product_id;
                $quantity = $item->quantity ?? 1;
        
                if (!isset($productSales[$productId])) {
                    $productSales[$productId] = 0;
                }
        
                $productSales[$productId] += $quantity;
            }
        }
        arsort($productSales);
        $topProductIds = array_slice(array_keys($productSales), 0, 5);
        $MostSelling = Products::whereIn('id', $topProductIds)->get();

        foreach ($orders as $order) {
            $cartItems = json_decode($order->cart_items);
        
            foreach ($cartItems as $item) {
                $productId = $item->product_id;
                $profit = $item->profit ?? 1;
        
                if (!isset($productProfit[$productId])) {
                    $productProfit[$productId] = 0;
                }
        
                $productProfit[$productId] += $profit;
            }
        }
        arsort($productProfit);
        $profitProductIds = array_slice(array_keys($productProfit), 0, 5);
        $MostProfitable =  Products::whereIn('id', $profitProductIds)->get();
        
        $categories = Category::where('status','active')->take(11)->get();
        return view('website.pages.index',compact('products','MostProfitable','MostSelling','latests','categories'));
    }

    public function about(){
        return view('website.pages.about');
    }

    public function contact(){
        return view('website.pages.contact');
    }

    public function single_product(Request $request){
        $product= Products::find($request->id);
        $products = Products::where('category',$product->category)->take(4)->get();
        $categories = Category::where('status','active')->get();
        return view('website.pages.single-product', compact('product','products','categories'));
    }

    public function add_to_cart(Request $request){
        $quantity = $request->product_quantity;
        $profit = $request->profit_amount;
        $product_id = $request->product_id;
        $user_id = auth()->user()->id;
        $Product = Products::find($product_id);
        $rowId = rand(0000,9999);
       
        if($request->size){
            $size = $request->size;
        }else{
            $size = null;
        }
        if($request->color){
            $color = $request->color;
        }else{
            $color = null;
        }

        \Cart::session($user_id)->add(array(
            'id' => $rowId,
            'name' => $Product->name,
            'price' => $Product->price,
            'quantity' => $quantity,
            'attributes' => array(
                'profit'=>$profit,
                'color'=>$color,
                'size'=>$size
            ),
            'associatedModel' => $Product
        ));

        return redirect()->back()->with('success','Successfully Added in Cart');
}

public function cart(){
    $user_id =  auth()->user()->id;
   $cart = \Cart::session($user_id)->getContent();
    $shippings = ShippingMethod::where('status','active')->get();
   return view('website.pages.cart',compact('cart','shippings'));
}

public function delete_cart(Request $request){
    $user_id =  auth()->user()->id;
    $row_id = $request->row_id;
    \Cart::session($user_id)->remove($row_id);
    return redirect()->back()->with('success','Item Deleted From Cart');
}

public function update_cart(Request $request){
    $quantity = $request->quantity;
    $row_id = $request->row_id;
    $profit = $request->profit;
    $userId =  auth()->user()->id;
    \Cart::session($userId)->update($row_id, array(
  'quantity' => $quantity, // new item name
  'attributes' => array(
                'profit'=>$profit,
            ),
));
$cart = \Cart::session($userId)->getContent();
    return response()->json(["status"=>true,"message"=>'Updated Successfully',"cart"=>$cart]);
}


public function checkout(){
    $user_id =  auth()->user()->id;
    $carts = \Cart::session($user_id)->getContent();
    $shipping =Session::get('shipping_name');
    $gateway = ShippingMethod::where('name',$shipping)->first();
    $cities = City::where('gateway_id',$gateway->api_id)->get();
    return view('website.pages.checkout',compact('carts','shipping','cities'));
}

public function place_order(Request $request){
    
    $validator = Validator::make($request->all(), [
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'phone_number' => 'required|numeric',
        'main_address' => 'required|string',
        'city' => 'required|string',
        'postal_code' => 'required|string',
        'country' => 'required|string',
        'shipping_gateway' => 'required|string',
        'payment_method' => 'required|string',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }
    $input = $request->all();
    $shipping_gateway = ShippingMethod::where('name',$input['shipping_gateway'])->first();
    $cities = City::where('id',$input['city'])->where('gateway_id',$shipping_gateway->api_id)->first();
    $user_id =  auth()->user()->id;
    $carts = \Cart::session($user_id)->getContent();
    $cart_data = [];
    $total_sale = 0;
    $total_profit = 0;
    $total_admin = 0;
    $total_items = 0;
    $total_purchase_price = 0;
    foreach($carts as $cart){
        $data = [
            "product_name" => $cart->name,
            "product_id"=> $cart->associatedModel->id,
            "price"=>$cart->price,
            "quantity"=>$cart->quantity,
            "profit"=>$cart->attributes->profit,
            "image"=>$cart->associatedModel->main_image,
            "attributes" => $cart->attributes,
        ];
        $product = Products::find($cart->associatedModel->id);
        if($product){
            $product->stock = (float)$product->stock - (float)$cart->quantity;
            $product->update();
            $total_purchase_price += (float)$product->purchase_price * (float)$cart->quantity;
        }
        $total_sale += ((float)$cart->price * (float)$cart->quantity) + (float)$cart->attributes->profit;
        $total_profit += (float)$cart->attributes->profit;
        $total_admin += ((float)$cart->price * (float)$cart->quantity);
        
        $total_items++;
        $cart_data [] = $data;
    }
    $input['cart_items'] = $cart_data;
    $input['user_profit'] = $total_profit;
    $input['total_price'] = (float)$total_sale + 250;
    $input['total_items'] = $total_items;
    $input['admin_cost'] = $total_admin;
    $input['total_purchase'] = $total_purchase_price;
    $input['status'] = 'pending';
    $input['user_id'] = $user_id;
    $input['shipping_cost'] = 250;
    $fullname = $input['firstname'].' '.$input['lastname'];
    $address = $input['main_address'].' '.$input['address2-dd'].', '.$input['city'].', '.$input['postal_code'].', '.$input['province'].', '.$input['country'];
    $token = $this->getToken();

    
   
    $order = Order::create([
            "customer_fname"=> $input['firstname'],
            "customer_lname"=> $input['lastname'],
            "customer_number"=> $input['phone_number'],
            "customer_address1"=> $input['main_address'],
            "customer_address2"=> $input['address2-dd'],
            "postal_code"=> $input['postal_code'],
            "customer_country"=> $input['country'],
            "customer_city"=> $cities->name,
            "customer_province"=> $input['province'],
            "extra_customer_details"=> $input['extra_customer_details'],
            "shipping_gateway"=> $input['shipping_gateway'],
            "payment_method"=> $input['payment_method'],
            "extra_shipping_details"=> $input['delivery-comments'],
            "shipping_cost"=> $input['shipping_cost'],
            "total_purchase"=> $input['total_purchase'],
            "total_price"=> $input['total_price'],
            "total_items"=> $input['total_items'],
            "cart_items" => json_encode($input['cart_items']),
            "user_profit"=> $input['user_profit'],
            "admin_cost"=> $input['admin_cost'],
            "status"=> $input['status'],
            "user_id"=> $input['user_id']
    ]);
    $orderId = $order->id;
    $curl = curl_init();
    $data = [
'seller_number' => $this->phone,
'buyer_number' => $input['phone_number'],
'buyer_name' => $fullname,
'buyer_address' => $address,
'buyer_city' => $cities->city_id,
'piece' => $input['total_items'],
'amount' => $input['total_price'],
'special_instruction' => $input['delivery-comments'],
'origin' => $input['country'],
'gateway_id' => $shipping_gateway->api_id,
'shipment_type' => 3,
'pickup_id'=>5518,
'shipper_address' => 'Tester',
'shipper_name' => 'tester',
'shipper_phone' => $this->phone,
'external_reference_no' => $orderId
    ];


    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://dev.digidokaan.pk/api/v1/digidokaan/order-book',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
        "Authorization: Bearer {$token}"
      ),
    ));
    
    $response = curl_exec($curl);
    
    curl_close($curl);
    $response = json_decode($response);
    $code = $response->code;
    if($code == 200){
        $response_data = $response->data;
     
        $tracking_id = $response_data->tracking_no;
        $tracking = Tracking::create([
            'tracking_id'=> $tracking_id,
            'order_id' => $orderId,
            'courier_company' => $response_data->courier_company,
            'slip_link'=>$response_data->slip_link,
            'delivery_charges'=>$response_data->delivery_charges,
            'order_no_api'=> $response_data->order_no,
        ]);
    }else{
        $tracking_id = null;
    }
    
    $data = [
        'orderId' => $orderId,
        "total_price"=> $input['total_price'],
        "total_items"=> $input['total_items'],
    ];
    $jsonData = json_encode($data);
    $image = QrCode::format('png')->size(150)->generate($jsonData);

    // Save to `storage/app/public/qrcodes/order_123.png`
    $qrcode = Storage::put("public/qrcodes/order_{$orderId}.png", $image);
    $qr = \App\Models\QRcode::create([
        "order_id" => $orderId,
        "user_id" =>  $input['user_id'],
        "image" => "storage/qrcodes/order_{$orderId}.png",
        "tracking_id" => $tracking_id
    ]);
   
    $order->update(['qrcode_id'=>$qr->id,'tracking_id'=> $tracking_id]);
    \Cart::session($user_id)->clear();
    return redirect()->route('website-thankyou', ['orderId' => $orderId]);
}

public function store_shipping(Request $request){
    $shipping = $request->shipping;
    Session::put('shipping_name', $shipping);
    return response()->json(["status"=>true,"message"=>'Updated Successfully',"shipping"=>$shipping]);
}

public function thankyou($id){
    $order = Order::find($id);
    return view('website.pages.thankyou',compact('order'));
}

public function product_categories($id){
    $products = Products::where('category',$id)->where('status',1)->paginate(9);
    $categories = Category::where('status','active')->get();
    $category = Category::find($id);
    return view('website.pages.products',compact('categories','products','category'));
}

public function products(){
    $products = Products::where('status',1)->paginate(9);
    $categories = Category::where('status','active')->get();
    return view('website.pages.products',compact('categories','products'));
}
}