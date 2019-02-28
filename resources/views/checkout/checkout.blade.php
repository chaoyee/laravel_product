@extends('layouts.app')

@section('content')
<h2 class="title text-center">Checkout</h2>
<div class=" text-right">
  <a class="btn btn-secondary btn-md" href="{{ route('products.show_cart') }}">Back to Cart</a>
</div>
@include('checkout.items')
</br>
<hr>
@include('checkout.shipping_information')
  <div class="form-group col-md-2">
    <br>
    <label></label>
    <a class="btn btn-secondary btn-md" href="{{ route('users.edit', $user->id) }}">Change Address</a>
  </div> 
</br>
<div class="text-right">
  <a class="btn btn-primary" href="{{ route('checkout.payment') }}">PAYMENT &nbsp
    <i class="fa fa-angle-double-right"></i></a>
</div>
</br>  
@endsection