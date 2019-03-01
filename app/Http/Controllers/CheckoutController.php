<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Order;
use App\OrderDetail;

class CheckoutController extends Controller
{    
    //
    public function __construct() 
    {
      $this->middleware('auth'); 
    }
    
    // checkout process
    public function checkout() 
    {
      if (auth()->check()) {
        $cart  = session()->get('cart');
        $total = 0;
        if (isset($cart)) {  
          foreach($cart as $id => $product) {
            $total = $total + $product['prod_subtotal'];
          }
        }
        $shipping = $total * 0.05;
        $total    = $total + $shipping;

        $user = auth()->user();
        $address = $user->address;

        return view('checkout.checkout', compact('cart', 'total', 'shipping', 'user', 'address')); 
      } else {
        return redirect()->back()->with('message', ['danger', 'You must login first!']);
      } 
    }

    public function payment() 
    {
      $user = auth()->user();
      return view('checkout.payment', compact('user'));
    }

    public function order_confirmation(Request $request) 
    {
      $cart  = session()->get('cart');
      $total = 0;
      if (isset($cart)) {  
        foreach($cart as $id => $product) {
          $total = $total + $product['prod_subtotal'];
        }
      }
      $shipping = $total * 0.05;
      $total    = $total + $shipping;

      $user = auth()->user();
      $address = $user->address;
      $payment = $request->get('payment');

      return view('checkout.order_confirmation', compact('cart', 'total', 'shipping', 'user', 'address', 'payment'));
    }

    public function return_page() 
    {
      // get response from the payment gateway.
      // if paid,
      if (true) { 
        // save items to order.
        $user_id = auth()->user()->id;
        $cart  = session()->get('cart');
        
        $total = 0;
        if (isset($cart)) {  
          foreach($cart as $id => $product) {
            $total = $total + $product['prod_subtotal'];
          }
        }
        $shipping = $total * 0.05;
        $total    = $total + $shipping;
        
        DB::beginTransaction();

        try {
          // Order
          $order = new Order([
            'user_id'      => $user_id,
            'order_total'  => $total,
            'order_date'   => now(),
            'order_status' => 'order placed'
            // 'created'      => now();
          ]);
          $order->save();
          $order_id = $order->id;  // get the order id 
          
          // OrderDetail
          if (isset($cart)) {  
            foreach($cart as $id => $product) {
              $order_detail = new OrderDetail([
                'order_id'   => $order_id,
                'product_id' => $id,
                'sub_qty'    => $product['prod_amount'],
                'sub_total'  => $product['prod_subtotal']
                // 'created'      => now();  
              ]);
              $order_detail->save();
            }
          }
        
          DB::commit();
        } catch (\Throwable $e) {
          DB::rollback();
          throw $e;
        }
      
        // clear the shopping cart.
        if (session('cart')) {
          session()->forget('cart');
        }
        return redirect('/')->with('message', ['success', 'Thank you for your order!']);   
      } else {
      // if not, show error page and return to the shopping cart.
      return redirect('/show_cart')->with('message', ['danger', 'Payment gateway error! Please try again!']);  
      }
    }
}
