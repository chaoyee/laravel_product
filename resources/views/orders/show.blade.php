@extends('layouts.app')

@section('content')
<div class="row">
  <h4>Order  ID: {{ $order->id }}</h4>&nbsp;
  <h4>User Name: {{ $order->user['name'] }}</h4>
</div> 
<table class="table table-hover">
  <thead>	
	<tr>
		<td><b>ID</b></td>
		<td><b>Product ID</b></td>
		<td><b>Product Name</b></td>
    <td><b>Product Description</b></td>
		<td><b>QTY</b></td>
		<td><b>Sub-Total</b></td>
		<td colspan="3"><b></b></td>
	</tr>
  </thead>
  <tbody>
  	@foreach($order_details as $order_detail)
  	<tr>
  		<td>{{ $order_detail->id }}</td>
  		<td>{{ $order_detail->product['id'] }}</td>
  		<td>{{ $order_detail->product['prod_name'] }}</td>
      <td>{{ $order_detail->product['prod_desc'] }}</td>
  		<td>{{ $order_detail->sub_qty }}</td>
  		<td>{{ $order_detail->sub_total }}</td>
      
      <!-- Check if user is an administrator  -->   
      @isAdmin
        <!--   
  		  <td><a href="{{-- route('orders.show', $order->id) --}}" 
  		  	class="btn btn-secondary"><i class="fa fa-edit"></i>Show Details</a></td>
  		  <td>
  		  	<form method="post" action="{{ route('orders.destroy', $order->id) }}">
  		  		@method('DELETE')
  		  		@csrf
  		  		<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</button>
  		  	</form>	
  		  </td>
        -->
      @endisAdmin
  	</tr>
  	@endforeach
  </tbody>
</table>
@if ($order_details instanceof \Illuminate\Pagination\LengthAwarePaginator)
  <div class="pagination justify-content-center">
	  {{ $order_details->links() }}
  </div> 
@endif
<div>
  <a class="btn btn-secondary btn-md" href="javascript:history.go(-1)">Back</a>
</div>
@endsection