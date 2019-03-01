@extends('layouts.app')

@section('content')
<table class="table table-hover">
  <thead>	
	<tr>
		<td><b>ID</b></td>
		<td><b>Product Name</b></td>
		<td><b>Product Description</b></td>
		<td><b>Product Price</b></td>
		<td><b>Product Qty</b></td>
		<td colspan="3"><b>Action</b></td>
	</tr>
  </thead>
  <tbody>
  	@foreach($products as $product)
  	<tr>
  		<td>{{$product->id}}</td>
  		<td>{{$product->prod_name}}</td>
  		<td>{{$product->prod_desc}}</td>
  		<td>{{$product->prod_price}}</td>
  		<td>{{$product->prod_qty}}</td>
      <td><a href="{{ route('products.add_to_cart', $product->id) }}" 
        class="btn btn-primary"><i class="fa fa-shopping-cart"></i>
        Add to cart</a></td>
      <!-- Check if user is an administrator  -->   
      @isAdmin 
  		  <td><a href="{{ route('products.edit', $product->id) }}" 
  		  	class="btn btn-secondary"><i class="fa fa-edit"></i>Edit</a></td>
  		  <td>
  		  	<form method="post" action="{{ route('products.destroy', $product->id) }}">
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
@if ($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
  <div class="pagination justify-content-center">
	  {{ $products->links() }}
  </div> 
@endif
@endsection