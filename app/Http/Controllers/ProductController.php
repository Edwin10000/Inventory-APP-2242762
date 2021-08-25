<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Categorie;
class ProductController extends Controller
{
    function _construct(){
        $this->middleware('auth');
    }
    function show(){
        $productList = Product::has('categorie')->get();
        $productList = Product::has('brand')->get();
        return view('product/list',['list' => $productList]);
    }
    function delete($id){
        //Product::destroy($id);
        $product = Product::findOrFail($id);
        $product->delete();
        return redirect('/products')->with('message', 'El producto fue borrado');
    }
    function form($id = null){
        $product = new Product();
        $brands = Brand::all();
        $categories = Categorie::all();
        if($id != null){
            $product = Product::findOrFail($id);
        }
        return view('product/form', ['product' => $product, 'brands' => $brands, 'categories' => $categories]);
    }
    function save(Request $request){
        $request->validate([
           'name' => 'required|max:50',
           'cost' => 'required|numeric',
           'price' => 'required|numeric',
           'quantity' => 'required|numeric',
           'brand' => 'required|max:50',
           'categorie' => 'required|max:50'
        ]);

        $product = new Product();
$message = 'Se ha creado un producto nuevo';
        if(intval($request->id)>0){
            $product = Product::findOrFail($request->id);
            $message = 'Se ha editado un producto';
        }
        $product->name = $request->name;
        $product->cost = $request->cost;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->brand_id = $request->brand;
        $product->category_id = $request->categorie;

        $product->save();
        return redirect('/products')->with('successMessage',$message);
    }
}
