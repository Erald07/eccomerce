<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\File;

class ProductController extends Controller
{
    public function index()
    {   
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }
    public function add()
    {
        $category = Category::all();
        return view('admin.products.add', compact('category'));
    }
    public function insert(Request $request)
    {
        $products = new Product();
        if($request->hasFile('image')){
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/products',$filename);
            $products->image = $filename;
        }
        $products->cate_id = $request->input('cate_id');
        $products->name = $request->input('name');
        $products->slug = $request->input('slug');
        $products->small_description = $request->input('small_description');
        $products->description = $request->input('description');
        $products->original_price = $request->input('original_price');
        $products->selling_price = $request->input('selling_price');
        $products->tax = $request->input('tax');
        $products->qty = $request->input('qty');
        $products->status = $request->input('status') == TRUE ? '1':'0';
        $products->trending = $request->input('trending') == TRUE ? '1':'0';
        $products->meta_title = $request->input('meta_title');
        $products->meta_keywords = $request->input('meta_keywords');
        $products->meta_description = $request->input('meta_description');
        $products->save();
        return redirect('products')->with('status', 'Product Added Successfully');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        return view('admin.products.edit', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if($request->hasFile('image')){
            $path = 'assets/uploads/category/'.$product->image;
            if(file_exists($path)){
                Storage::delete($path);
            }
            $file = $request->file('image');
            $ext = $file->getClientOriginalExtension();
            $filename = time().'.'.$ext;
            $file->move('assets/uploads/products',$filename);
            $product->image = $filename;
        }
        $product->name = $request->input('name');
        $product->slug = $request->input('slug');
        $product->small_description = $request->input('small_description');
        $product->description = $request->input('description');
        $product->original_price = $request->input('original_price');
        $product->selling_price = $request->input('selling_price');
        $product->tax = $request->input('tax');
        $product->qty = $request->input('qty');
        $product->status = $request->input('status') == TRUE ? '1':'0';
        $product->trending = $request->input('trending') == TRUE ? '1':'0';
        $product->meta_title = $request->input('meta_title');
        $product->meta_keywords = $request->input('meta_keywords');
        $product->meta_description = $request->input('meta_description');
        $product->update();
        return redirect('products')->with('status', 'Product Updated Sucesfully');
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $path = 'assets/uploads/products/'.$product->image;
        if(file_exists($path)){
            Storage::delete($path);
        }
        $product->delete();
        return redirect('products')->with('status', 'Product Deleted Successfully');
    }
}
