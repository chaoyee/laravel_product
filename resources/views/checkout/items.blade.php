{{--  input variables  --}}
{{--     $cart         --}}
{{--     $shipping     --}}
{{--     $total        --}}

<h3>Items</h3>
<table class="table table-hover">
  <thead>	
	<tr>
		<td><b>ID</b></td>
		<td><b>Product Name</b></td>
		<td><b>Product Description</b></td>
		<td class="text-right"><b>Product Price</b></td>
		<td class="text-right"><b>Order Quantity</b></td>
		<td class="text-right"><b>Sub Total</b></td>
	</tr>
  </thead>
  <tbody>
  	@foreach($cart as $id => $product)
  	<tr>
  		<td>{{$id}}</td>
  		<td>{{$product['prod_name']}}</td>
  		<td>{{$product['prod_desc']}}</td>
  		<td class="text-right">{{$product['prod_price']}}</td>
  		<td class="text-right">{{$product['prod_amount']}}</td>
      <td class="text-right">{{ $product['prod_subtotal'] }}
  	</tr>
  	@endforeach
  </tbody>
</table>
@if ($cart instanceof \Illuminate\Pagination\LengthAwarePaginator)
  <div class="pagination justify-content-center">
	  {{ $cart->links() }}
  </div> 
@endif
<div class="text-right">
  <h4>Shipping: {{ $shipping }}</h4> 
  <h3>Total: {{ $total }}</h3>
</div>