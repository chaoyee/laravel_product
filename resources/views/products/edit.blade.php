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
  	<form method="post" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
  	  @method('PATCH')
  	  @csrf
  	  <div class="form-group">
  	  	<label for="prod_name">Product Name</label>
  	  	<input type="text" class="form-control" name="prod_name" value="{{ $product->prod_name }}" />	
  	  </div>
  	  <div class="form-group">
  	  	<label for="prod_desc">Product Description</label>
  	  	<input type="text" class="form-control" name="prod_desc" value="{{ $product->prod_desc }}" />	
  	  </div>
  	  <div class="form-group">
  	  	<label for="prod_price">Product Price</label>
  	  	<input type="text" class="form-control" name="prod_price" value="{{ $product->prod_price }}" />	
  	  </div>
  	  <div class="form-group">
  	  	<label for="prod_qty">Product Qty</label>
	  	  <input type="text" class="form-control" name="prod_qty" value="{{ $product->prod_qty }}" />	
	    </div>
      
      <!-- upload pictures -->
      <div id="upload_pictures">
        <h5>Available Product Images: {{ count($images) }} (Maximum number of images is 4)</h5>
        @foreach ($images as $image)
        <div class="form-group">
          <label class="col-md-2 control-label" for="prod_pic">Picture {{ $loop->index + 1 }}</label>
          <div class="col-md-10">
            @if (file_exists($image))
              <img src="{{ url('/prod_imgs') }}/{{ basename($image) }}" width="300px" height="300px" />
            @else
              <p>Image file does not exist!</p>
            @endif  
            <input type="file" class="form-control-file" name="prod_img[]" id="prod_img[]">
          </div>
        </div>
        @endforeach
        @for ($i =1; $i < (5 - count($images)); $i++)
          <div class="form-group">
            <label class="col-md-2 control-label" for="prod_pic">Picture {{ count($images) + $i }}</label>
            <div class="col-md-10">
              <input type="file" class="form-control-file" name="prod_img[]" id="prod_img[]">
            </div>
          </div>  
        @endfor
      </div>
      <!-- upload pictures -->

      <a class="btn btn-secondary" href="{{ URL::previous() }}">Back</a>
	    <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
@endsection