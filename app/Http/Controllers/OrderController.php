<?php

namespace App\Http\Controllers;

use App\Models\Customer;
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
        $orders = Order::latest()->with('customers')->get();

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

        $validator = Validator::make($request->order, [
            'ordernumber' => 'required|numeric',
            'orderdate' => 'required|date',
            'customer_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(array('response' => false, 'errors' => $validator->errors()));
        }
        $productid = $request->productid;
        $price = $request->price;
        $quantity = $request->quantity;
        $totalAmount = 0;
        for ($i = 0; $i < sizeOf($productid); $i++)
            $totalAmount = $totalAmount + (intval($price[$i]) * intval($quantity[$i]));
        $order = new Order;
        $order->ordernumber = $request->order['ordernumber'];
        $date = new DateTime($request->order['orderdate']);
        $order->orderdate = $date->format('Y-m-d');
        $order->customer_id = $request->order['customer_id'];
        $order->totalamount = $totalAmount;
        try {
            $save = $order->save();
            for ($i = 0; $i < sizeOf($productid); $i++)
                $order->items()->attach($productid[$i], ['unitprice' => intval($price[$i]), 'quantity' => intval($quantity[$i])]);
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
        $order = Order::with('items')->find($id);
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

        $validator = Validator::make($request->order, [
            'ordernumber' => 'required|numeric',
            'orderdate' => 'required|date',
            'customer_id' => 'required|numeric',
        ]);
        if ($validator->fails()) {
            return response()->json(array('response' => false, 'errors' => $validator->errors()));
        }
        $productid = $request->productid;
        $price = $request->price;
        $quantity = $request->quantity;
        $totalAmount = 0;
        for ($i = 0; $i < sizeOf($productid); $i++)
            $totalAmount = $totalAmount + (intval($price[$i]) * intval($quantity[$i]));
        // get the old items in the order
        $order = Order::with('items')->find($id);
        $orderItem = $order->items;
        $oldItems = array();
        foreach ($orderItem as $item)
            array_push($oldItems, $item->id);
        $order->ordernumber = $request->order['ordernumber'];
        $date = new DateTime($request->order['orderdate']);
        $order->orderdate = $date->format('Y-m-d');
        $order->customer_id = $request->order['customer_id'];
        $order->totalamount = $totalAmount;
        try {
            $save = $order->save();
            foreach ($productid as $i => $rqitem) {
                if (in_array($rqitem, $oldItems)) {
                    $order->items()->updateExistingPivot($rqitem, ['unitprice' => intval($price[$i]), 'quantity' => intval($quantity[$i])]);
                    $index = array_search($rqitem, $oldItems);
                    unset($oldItems[$index]);
                } else {
                    $order->items()->attach($rqitem, ['unitprice' => intval($price[$i]), 'quantity' => intval($quantity[$i])]);
                }
            }

            foreach ($oldItems as $i => $olditem) {

                $order->items()->detach($olditem);
            }
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
    public function getAllCustomers()
    {
        $customers = Customer::latest()->get();
        return response()->json(array('response' => !is_null($customers), 'data' => $customers));
    }
}
