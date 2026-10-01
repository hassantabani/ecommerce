<?php

namespace App\Http\Controllers;

use App\Models\book;
use App\Models\Order;
use App\Models\Products;
use App\Models\QRcode;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $user = auth()->user();
        if($user->user_type == 'admin'){
            $orders= Order::all();
        }else{
            $orders = Order::where('user_id',$user->id)->get(); 
        }

        if($orders->count() > 0){
            foreach($orders as $order){
                $user = User::find($order->user_id);
                $order->user = $user;
            }
        }

        return view('dashboards.orders_list',compact('orders'));
    }
    public function orders_pending(){
        $user = auth()->user();
        if($user->user_type == 'admin'){
            $orders= Order::where('status','pending')->get();;
        }else{
            $orders = Order::where('user_id',$user->id)->where('status','pending')->get(); 
        }

        if($orders->count() > 0){
            foreach($orders as $order){
                $user = User::find($order->user_id);
                $order->user = $user;
            }
        }

        return view('dashboards.orders_list',compact('orders'));
    }
    public function orders_reject(){
        $user = auth()->user();
        if($user->user_type == 'admin'){
            $orders= Order::where('status','reject')->get();
        }else{
            $orders = Order::where('user_id',$user->id)->where('status','reject')->get(); 
        }

        if($orders->count() > 0){
            foreach($orders as $order){
                $user = User::find($order->user_id);
                $order->user = $user;
            }
        }

        return view('dashboards.orders_list',compact('orders'));
    }
    public function orders_deliver(){
        $user = auth()->user();
        if($user->user_type == 'admin'){
            $orders= Order::where('status','deliver')->get();
        }else{
            $orders = Order::where('user_id',$user->id)->where('status','deliver')->get(); 
        }

        if($orders->count() > 0){
            foreach($orders as $order){
                $user = User::find($order->user_id);
                $order->user = $user;
            }
        }

        return view('dashboards.orders_list',compact('orders'));
    }
    public function orders_inprocess(){
        $user = auth()->user();
        if($user->user_type == 'admin'){
            $orders= Order::where('status','inprocess')->get();
        }else{
            $orders = Order::where('user_id',$user->id)->where('status','inprocess')->get();
        }

        if($orders->count() > 0){
            foreach($orders as $order){
                $user = User::find($order->user_id);
                $order->user = $user;
            }
        }

        return view('dashboards.orders_list',compact('orders'));
    }

    public function view_order($id){
        $order = Order::find($id);
        if($order){
            return view('dashboards.order_view',compact('order'));
        }else{
            return redirect()->back()->with('error','Order Not found');
        }
    }

    public function order_status_update(Request $request, $id){
        $order = Order::find($id);
        if($order){
            $order->status = $request->update_status;
            if($request->update_status == 'reject'){
                $cart_item = json_decode($order->cart_items);
                if(!empty($cart_item)){
                    foreach($cart_item as $c){
                        $product = Products::find($c->product_id);
                        $product->stock = (float)$product->stock + (float)$c->quantity;
                        $product->update();
                    }
                }
            }
            $order->update();
            return redirect()->back()->with('success','Updated Successfully');
        }else{
            return redirect()->back()->with('error','Order not found');
        }
 
    }


    public function order_print($id){
        $order = Order::find($id);
        if($order){
            $user = User::find($order->user_id);
            if($user){
                $order->user = $user;
                $qrcode = QRcode::find($order->qrcode_id);
                if($qrcode){
                    $order->qrcode = $qrcode;
                }
            }

            return view('dashboards.order_print',compact('order'));
        }else{
            return redirect()->back()->with('error','Order Not found');
        }
    }

    public function scanner(){
        return view('dashboards.scanner');
    }

    public function order_detail($id){
        $order = Order::find($id);
        if($order){
            $user = User::find($order->user_id);
            if($user){
                $order->user = $user;
                $qrcode = QRcode::find($order->qrcode_id);
                if($qrcode){
                    $order->qrcode = $qrcode;
                }
            }

            return view('dashboards.order_detail',compact('order'));
        }else{
            return redirect()->back()->with('error','Order Not found');
        }
    }


    public function show_profit_details(){
        $user = auth()->user()->id;
        $books = book::where('user_id',$user)->get();
        return view('dashboards.profit_details',compact('books'));
    }
}
