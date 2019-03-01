<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Order;
use App\OrderDetail;

class OrderController extends Controller
{
    public function __construct() 
    {
      $this->middleware('auth'); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // if $request is not empty, meaning select orders belong to user_id.
        // if not, then select all orders.
        //
        if (isset($request->user_id)) {
          $orders = Order::where('user_id', $request->user_id)
            ->paginate(config('constants.PAGINATION')); 
        } else {
          $orders = Order::paginate(config('constants.PAGINATION'));  
        }
        return view('orders.index', compact('orders'));
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
        //
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
        $order = Order::find($id);
        $order_details = OrderDetail::where('order_id', $id)
          ->paginate(config('constants.PAGINATION'));
        return view('orders.show', compact('order', 'order_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        DB::beginTransaction();
        
        try {
          $order = Order::find($id);
          $order->delete();
          $order->orderDetails->each->delete();
          DB::commit();
          
          return redirect('/orders')->with('message', 
            ['danger', 'The order id: '.$id.' has been deleted!']);  
        } catch (\Throwable $e) {
          DB::rollback();
          throw $e;
        }
    }
    
}
