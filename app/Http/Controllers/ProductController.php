<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function list(){
        $products = Products::all();
        return view('products.list',compact('products'));
    }

    public function add_product(){
        $category = Category::where('status','active')->get();
        return view('products.store',compact('category'));
    }

    public function store_products(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'purchase_price' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'is_sale' => 'required|boolean',
            'attribute' => 'required|boolean',
            'status' => 'required|boolean',
            'main_image' => 'required|image|mimes:png,jpg,jpeg|max:2048', // Limit size to 2MB
        ]);


       
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = $request->all();
        if($request->hasFile('main_image')){
            $filename = uniqid().'.'.$request->main_image->extension();
            $request->main_image->storeAs('public/main_image', $filename);
            $imagePath = 'storage/main_image/'.$filename;
            $input['main_image'] = $imagePath;
        }
      
        if($request->hasFile('more_media')){
            $images = [];
            foreach($request->more_media as $media){
                $filenames =  uniqid().'.'. $media->extension();
                $media->storeAs('public/more_image', $filenames);
                $imagePaths = 'storage/more_image/'.$filenames;
                $images[] = $imagePaths;
            }
            $input['more_media'] = json_encode($images);
        }
        $attribute = [];
            if($request->attribute == 1){
                
                if(!empty($request->color)){
                    $attribute['color'] = $request->color;
                }
                if(!empty($request->size)){
                    $attribute['size'] = $request->size;
                }
            }

            if($request->is_sale == 1){
                $input['sale_price'] = $request->sale_price;
            }

            $input['attribute_items'] =  json_encode($attribute);
       

        $points = [];
        $points [] = $request->points1;
        $points [] = $request->points2;
        $points [] = $request->points3;
        $points [] = $request->points4;

        $input['points'] = json_encode($points);

       
        
        $product = Products::create($input);
        if($product){
            return redirect()->back()->with('success','Product Created Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong');
        }

    }


    public function edit_product($id){
        $product = Products::find($id);
        $category = Category::where('status','active')->get();
        return view('products.edit',compact('product','category'));
    }

    
    public function product_delete($id){
        $product = Products::find($id);
        $product->delete();
        return redirect()->back()->with('success','Product Deleted Successfully');
    }

    public function product_update(Request $request, $id){
        $product = Products::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'purchase_price' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'description' => 'required|string',
            'is_sale' => 'required|boolean',
            'attribute' => 'required|boolean',
            'status' => 'required|boolean',
            'main_image' => 'required|image|mimes:png,jpg,jpeg|max:2048', // Limit size to 2MB
        ]);
       
        $input = $request->all();
        if($request->hasFile('main_image')){
            $filename = uniqid().'.'.$request->main_image->extension();
            $request->main_image->storeAs('public/main_image', $filename);
            $imagePath = 'storage/main_image/'.$filename;
            $input['main_image'] = $imagePath;
        }
      
      
        $attribute = [];
            if($request->attribute == 1){
                
                if(!empty($request->color)){
                    $attribute['color'] = $request->color;
                }
                if(!empty($request->size)){
                    $attribute['size'] = $request->size;
                }
            }

            if($request->is_sale == 1){
                $input['sale_price'] = $request->sale_price;
            }

            $input['attribute_items'] =  json_encode($attribute);
       

        $points = [];
        $points [] = $request->points1;
        $points [] = $request->points2;
        $points [] = $request->points3;
        $points [] = $request->points4;

        $input['points'] = json_encode($points);

       
        
        $product->update($input);
        if($product){
            return redirect()->back()->with('success','Product Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong');
        }

    }
}
