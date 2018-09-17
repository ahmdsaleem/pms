<?php

namespace App\Http\Controllers;

use App\Classes\Response;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    const MODULE = 'product';

    public function index()
    {
        return view('products.index');
    }


    public function store(Request $request)
    {
        $response=new Response();

        try {

            $this->validate($request, [
                'name'=> 'required',
            ]);

            $product = Product::create([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
            ]);

            $response->setResponse(true, 200, 'auth'.'.'.SELF::MODULE . '.' . '200');
        }
        catch(\Exception $e)
        {
            $response->setResponse(false, 400, 'auth'.'.'.SELF::MODULE . '.' . '400');
        }

        return response()->json($response->getResponse());
    }

    public function edit($id)
    {
        $response= new Response();
        try {
            $product = Product::findOrFail($id);
            return response()->json($product);
        }
        catch (\Exception $ex)
        {
            $response->setResponse(false, 400, 'auth'.'.'.SELF::MODULE . '.' . '400');
            return response()->json($response->getResponse());
        }
    }


    public function update(Request $request, $id)
    {
        $response=new Response();
        try {

            $this->validate($request, [
                'name'=> 'required'
            ]);

            $product = Product::findOrFail($id);
            $product->name = $request->get('name');
            $product->description = $request->get('description');
            $product->save();
            $response->setResponse(true, 200, 'auth'.'.'.SELF::MODULE . '.' . '200');
        }
        catch (\Exception $ex)
        {
            $response->setResponse(false, 400, 'auth'.'.'.SELF::MODULE . '.' . '400');
        }

        return response()->json($response->getResponse());
    }



    public function destroy($id)
    {
        $response=new Response();
        try {
            $product = Product::findOrFail($id);
            Product::destroy($id);
            $response->setResponse(true, 200, 'auth'.'.'.SELF::MODULE . '.' . '200');
        }
        catch (\Exception $ex)
        {
            $response->setResponse(false, 400, 'auth'.'.'.SELF::MODULE . '.' . '400');
        }

        return response()->json($response->getResponse());

    }



    public function getProducts(Request $request)
    {

        $draw = $request->get('draw');
        $start = $request->get('start');
        $length = $request->get('length');
        $search['value']=true;

        $products = Auth::user()->products()->skip($start)->take($length)->get();
        $total_products= Auth::user()->products()->count();

        $parameters=array();
        $parameters['draw']=$draw;
        $parameters['recordsTotal']=$total_products;
        $parameters['recordsFiltered']=$total_products;

        foreach ($products as $product)
        {
            $product['action']='<a onclick="ProductController.editProduct('.$product->id.')"> <l title="Edit Product Details" style="margin:10px" class="fa fa-pencil-square-o"></l> </a>'.
                '<a onclick="ProductController.deleteProduct('.$product->id.')"> <l title="Delete Product" style="margin:10px" class="font-icon font-icon-trash"></l></a>';
        }

        $parameters['data']=$products;
        $parameters['input']=array();
        return $parameters;

    }


}
