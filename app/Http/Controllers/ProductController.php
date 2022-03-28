<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\QueryException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::latest()->with('suppliers')->get();
        return response()->json(array('response' => !is_null($products), 'data' => $products));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'productname' => 'required|string',
            'supplier_id' => 'required|numeric',
            'unitprice' => 'required|numeric|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json(array('response' => false, 'errors' => $validator->errors()));
        }
        $product = new Product;
        $product->productname = $request->productname;
        $product->unitprice = $request->unitprice;
        $product->supplier_id = $request->supplier_id;;
        try {
            $save = $product->save();
        } catch (QueryException $e) {
            return response()->json(array('response' => false, 'errors' => $e->getMessage()));
        };

        return response()->json(array('response' => $save, 'data' => $product));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return response()->json(array('response' => !is_null($product), 'data' => $product));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'productname' => 'required|string',
            'supplier_id' => 'required|numeric',
            'unitprice' => 'required|numeric|min:0',
        ]);
        if ($validator->fails()) {
            return response()->json(array('response' => false, 'errors' => $validator->errors()));
        }
        $product = Product::find($id);
        $product->productname = $request->productname;
        $product->unitprice = $request->unitprice;
        $product->supplier_id = $request->supplier_id;;
        try {
            $save = $product->save();
        } catch (QueryException $e) {
            return response()->json(array('response' => false, 'errors' => $e->getMessage()));
        };

        return response()->json(array('response' => $save, 'data' => $product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        if (is_null($product))
            return response()->json(array('response' => !is_null($product), 'data' => $product));
        $save = $product->delete();
        return response()->json(array('response' => $save, 'data' => $product));
    }

    public function getAllSuppliers(){
        $suppliers = Supplier::latest()->get();
        return response()->json(array('response' => !is_null($suppliers), 'data' => $suppliers));
    }
}
