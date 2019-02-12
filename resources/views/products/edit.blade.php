@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
  	<h4>Edit Product</h4>
  </div>
  <div class="card-body">
  	@if ($errors->any())
  	  <div class="alert alert-danger">
  	  	<ul>
  	  		<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			      <span aria-hidden="true">&times;</span>
          </button>
  	  	  @foreach ($errors->all() as $error)
  	  		  <li>{{ $error }}</li>
  	  	  @endforeach
  	  	</ul>
  	  </div><br/>
  	@endif 
  	<form method="post" action="{{ route('products.update', $product->id) }}">
  	  @method('PATCH')
  	  @csrf
  	  <div class="form-group">
  	  	<label for="prod_name">Product Name</label>
  	  	<input type="text" class="form-control" name="prod_name" value={{ $product->prod_name }} />	
  	  </div>
  	  <div class="form-group">
  	  	<label for="prod_desc">Product Description</label>
  	  	<input type="text" class="form-control" name="prod_desc" value={{ $product->prod_desc }} />	
  	  </div>
  	  <div class="form-group">
  	  	<label for="prod_price">Product Price</label>
  	  	<input type="text" class="form-control" name="prod_price" value={{ $product->prod_price }} />	
  	  </div>
  	  <div class="form-group">
  	  	<label for="prod_qty">Product Qty</label>
	  	<input type="text" class="form-control" name="prod_qty" value={{ $product->prod_qty }} />	
	  </div>
	  <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
@endsection