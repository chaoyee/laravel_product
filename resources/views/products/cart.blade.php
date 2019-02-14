@extends('layouts.app')

@section('content')
<div class="uper">
	@if(session()->get('success'))
		<div class="alert alert-success">
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			  <span aria-hidden="true">&times;</span>
      </button>
			{{ session()->get('success') }}
		</div><br/>
	@endif
</div>
<h2 class="title text-center">Shopping Cart</h2>
@if(session('cart'))
  <div class=" text-right">
    <a class="btn btn-secondary btn-md" href="{{ route('index') }}">Continue Shopping</a>
    <a class="btn btn-danger btn-md update" href="{{ route('products.empty_cart') }}">Empty Cart</a>
  </div>
  </br>
  <table class="table table-hover">
    <thead>	
  	<tr>
  		<td><b>ID</b></td>
  		<td><b>Product Name</b></td>
  		<td><b>Product Description</b></td>
  		<td><b>Product Price</b></td>
  		<td><b>Order Quantity</b></td>
      <td><b>Sub Total</b></td>
  		<td colspan="3"><b>Action</b></td>
  	</tr>
    </thead>
    <tbody>
    	@foreach(session('cart') as $id => $product)
    	<tr>
    		<td>{{$id}}</td>
    		<td>{{$product['prod_name']}}</td>
    		<td>{{$product['prod_desc']}}</td>
    		<td class="text-right">{{$product['prod_price']}}</td>
    		<td>{{$product['prod_amount']}}</td>
        <td class="text-right">{{ $product['prod_price'] * $product['prod_amount'] }}
        <td class="cart_quantity">
          <div class="cart_quantity_button">
            <a class="cart_quantity_up" title="Increase order quantity by 1"
              href="{{ route('products.cart_quantity_up', $id) }}"> 
              <i class="fa fa-plus"></i></a>
            <input class="cart_quantity_input" type="text"
              name="quantity" value="{{$product['prod_amount']}}" autocomplete="off2" disabled>
            <a class="cart_quantity_down" title="Decrease order quantity by 1"
            @if($product['prod_amount'] > 1)
              href="{{ route('products.cart_quantity_down', $id) }}"
            @else
              href=""
            @endif
            ><i class="fa fa-minus"></i></a>
          </div>
        </td>
        <td class="cart_total">
          <p class="cart_total_price text-right"></p>
        </td>
        <td class="cart_item_delete">
          <a class="cart_item_delete" title="Delete This Item" 
            href="{{ route('products.cart_item_delete', $id) }}">
            <i class="fa fa-times"></i></a>
        </td>
    	</tr>
    	@endforeach
    </tbody>
  </table>
  @if (session('cart') instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="pagination justify-content-center">
  	  {{ session('cart')->links() }}
    </div> 
  @endif
@else
  <h3>No item found!</h3>
@endif

@endsection