@extends('layouts.app')

@section('content')
<h2 class="title text-center">Order Confirmation</h2>
<div class="container">
  <h5><p>Please make sure that your order details and shipping/billing address is correct. No amendment is allowed after order confirmation. Please be careful of checking this information. If there is any mistake, please move backward to correct it. Thank you!</p></h5>
</div>
<div class=" text-right">
  <a class="btn btn-secondary btn-md" href="{{ route('checkout.payment') }}">Back to Payment</a>
</div>
@include('checkout.items')

<!-- Payment method -->

<div class="container">
  <div class="row">
    <h3>Payment Method: </h3>&nbsp;
    <h3 style="color:red;"><b>{{ $payment }}</b></h3>
  </div>
</div>
<hr>

@include('checkout.shipping_information')
</br>
<div class="text-right">
  <a class="btn btn-primary" href="{{ route('checkout.payment_gateway') }}">
  	CONFIRM and PLACE ORDER! &nbsp
    <i class="fa fa-angle-double-right"></i></a>
</div>
</br>

@endsection('content')

