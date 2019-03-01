@extends('layouts.app')

@section('content')
<table class="table table-hover">
  <thead>	
	<tr>
		<td><b>ID</b></td>
		<td><b>User Name</b></td>
		<td><b>Order Total</b></td>
		<td><b>Order Date</b></td>
		<td><b>Status</b></td>
		<td colspan="3"><b>Action</b></td>
	</tr>
  </thead>
  <tbody>
  	@foreach($orders as $order)
  	<tr>
  		<td>{{$order->id}}</td>
  		<td>{{$order->user['name']}}</td>
  		<td>{{$order->order_total}}</td>
  		<td>{{$order->order_date}}</td>
  		<td>{{$order->order_status}}</td>
      
      <!-- Check if user is an administrator  -->   
      @isAdmin  
  		  <td><a href="{{ route('orders.show', $order->id) }}" 
  		  	class="btn btn-secondary"><i class="fa fa-edit"></i>Show Details</a></td>
  		  <td>
  		  	<form method="post" action="{{ route('orders.destroy', $order->id) }}">
  		  		@method('DELETE')
  		  		@csrf
  		  		<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</button>
  		  	</form>	
  		  </td>
      @endisAdmin
  	</tr>
  	@endforeach
  </tbody>
</table>
@if ($orders instanceof \Illuminate\Pagination\LengthAwarePaginator)
  <div class="pagination justify-content-center">
	  {{ $orders->links() }}
  </div> 
@endif
@endsection