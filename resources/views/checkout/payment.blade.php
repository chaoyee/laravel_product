@extends('layouts.app')

@section('content')
<h2 class="title text-center">Payment Method</h2>
<div class=" text-right">
  <a class="btn btn-secondary btn-md" href="{{ route('checkout.checkout') }}">Back to Checkout</a>
</div>
<h3>Payment</h3>  
<div class="container">
  <div class="row">
    <div class="form-group col-md-1">
      <label for="user_id">User ID</label>
      <input type="text" class="form-control" name="user_id" value="{{ $user->id }}" disabled/>
    </div>
    <div class="form-group col-md-3">
      <label for="user_name">User Name</label>
      <input type="text" class="form-control" name="user_name" value="{{ $user->name }}" disabled/>
    </div>
  </div>  
  <br>
  <form action="{{ route('checkout.order_confirmation') }}" method="POST" id="payment">
    @csrf
    <input type="radio" name="payment" value="card" checked> Credit Card<br/>
    <input type="radio" name="payment" value="atm"> ATM<br/>
    <input type="radio" name="payment" value="paypal"> PayPal<br/>
    <input type="radio" name="payment" value="pwr"> Pay When Received<br/>
  
    <!--a class="btn btn-primary" href="javascript:history.go(-1)">
      <i class="fa fa-angle-double-left"></i> Check Out</a -->
   
    <div class="text-right">
      <button type="submit" class="btn btn-primary">ORDER CONFIRMATION 
      <i class="fa fa-angle-double-right"></i></button>
    </div>  
  </form>
  </div>
</div>

@endsection