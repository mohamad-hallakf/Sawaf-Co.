<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Database\QueryException;
use DateTime;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::latest()->get();
        return response()->json(array('response' => !is_null($orders), 'data' => $orders));
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
            'ordernumber' => 'required|numeric',
            'orderdate' => 'required|date',
            'totalamount' => 'required|numeric|min:0',
            'customer_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(array('response' => false, 'errors' => $validator->errors()));
        }
        $order = new Order;
        $order->ordernumber = $request->ordernumber;
        $order->orderdate = new DateTime($request->orderdate);
        $order->customer_id = $request->customer_id;
        $order->totalamount = $request->totalamount;
        try {
            $save = $order->save();
        } catch (QueryException $e) {
            return response()->json(array('response' => false, 'errors' => $e->getMessage()));
        };

        return response()->json(array('response' => $save, 'data' => $order));
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
        $order = Order::find($id);
        return response()->json(array('response' => !is_null($order), 'data' => $order));
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
            'ordernumber' => 'required|numeric',
            'orderdate' => 'required|date',
            'totalamount' => 'required|numeric|min:0',
            'customer_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(array('response' => false, 'errors' => $validator->errors()));
        }
        $order = Order::find($id);
        $order->ordernumber = $request->ordernumber;
        $order->orderdate = new DateTime($request->orderdate);
        $order->customer_id = $request->customer_id;
        $order->totalamount = $request->totalamount;
        try {
            $save = $order->save();
        } catch (QueryException $e) {
            return response()->json(array('response' => false, 'errors' => $e->getMessage()));
        };

        return response()->json(array('response' => $save, 'data' => $order));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if (is_null($order))
            return response()->json(array('response' => !is_null($order), 'data' => $order));
        $save = $order->delete();
        return response()->json(array('response' => $save, 'data' => $order));
    }
}
