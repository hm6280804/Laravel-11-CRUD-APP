<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(){
        $products = Product::orderBy('created_at', 'DESC')->get();
        return view('products.list', compact('products'));
    }


    public function create(){
        return view('products.create');
    }


    public function store(Request $request){
        $rules = [
            'name' => 'required|min:5',
            'sku'  => 'required|min:3',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];


        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('products.create')->withInput()->withErrors($validator);
        }

        //store values to database
        $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();


        if($request->image != ''){
                //here we will store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //unique image name

            //save image to products directory
            $image->move(public_path('uploads/products'), $imageName);

            //save image name in database
            $product->image = $imageName;
            $product->save();

        }
       
        return redirect()->route('products.index')->with('success', 'product added successfully');

    }


    public function edit($id){

        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }


    public function update($id, Request $request){
        $product = Product::findOrFail($id);

        $rules = [
            'name' => 'required|min:5',
            'sku'  => 'required|min:3',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];


        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()){
            return redirect()->route('products.edit', $product->id)->withInput()->withErrors($validator);
        }

       
        // $product = new Product();
        $product->name = $request->name;
        $product->sku = $request->sku;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->save();


        if($request->image != ''){
            //delete old image
            File::delete(public_path('uploads/products/' . $product->image));

                //here we will store image
            $image = $request->image;
            $ext = $image->getClientOriginalExtension();
            $imageName = time() . '.' . $ext; //unique image name

            //save image to products directory
            $image->move(public_path('uploads/products'), $imageName);

            //save image name in database
            $product->image = $imageName;
            $product->save();

        }
       
        return redirect()->route('products.index')->with('success', 'product Updated successfully');

    }


    public function delete($id){
        $product =Product::findOrFail($id);

        //first delete image 
        FILE::delete(public_path('uploads/products/', $product->image));

        //delete product data from database
        $product->delete();
        return redirect()->route('products.index')->with('success', 'product deleted successfully');
    }
}
