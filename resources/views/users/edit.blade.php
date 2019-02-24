@extends('layouts.app')

@section('content')
<div class="card uper">
  <div class="card-header">
  	<h4>Edit User</h4>
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
  	<form method="post" action="{{ route('users.update', $user->id) }}">
  	  @method('PATCH')
  	  @csrf
  	  <div class="form-group">
  	  	<label for="name">Name</label>
  	  	<input type="text" class="form-control" name="name" value="{{ $user->name }}" />	
  	  </div>
  	  <div class="form-group">
  	  	<label for="email">EMail</label>
  	  	<input type="email" class="form-control" name="email" value="{{ $user->email }}" />	
  	  </div>
  	  <div class="form-group">
  	  	<label for="birthday">Birthday</label>
  	  	<input type="date" class="form-control" name="birthday" value="{{ $user->birthday }}" />	
  	  </div>
  	  <div class="form-group">
  	  	<label for="tel">Tel</label>
	  	<input type="tel" class="form-control" name="tel" value="{{ $address->tel }}" />
      <div class="form-group">
        <label for="address">Address</label>
      <input type="text" class="form-control" name="address" value="{{ $address->address }}" />
      <div class="form-group">
        <label for="district">District</label>
      <input type="text" class="form-control" name="district" value="{{ $address->district }}" /> 
      <div class="form-group">
        <label for="city">City</label>
      <input type="text" class="form-control" name="city" value="{{ $address->city }}" /> 
      <div class="form-group">
        <label for="country">Country</label>
      <input type="text" class="form-control" name="country" value="{{ $address->country }}" /> 
      <div class="form-group">
        <label for="zip">Zip</label>
      <input type="number" min="100" max="999" class="form-control" name="zip" value="{{ $address->zip }}" />  	
	  </div>
    <a class="btn btn-secondary" href="{{ URL::previous() }}">Back</a>
	  <button type="submit" class="btn btn-primary">Update</button>
    </form>
  </div>
</div>
@endsection