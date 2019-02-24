@extends('layouts.app')

@section('content')
<table class="table table-hover">
  <thead>	
	<tr>
		<td><b>ID</b></td>
		<td><b>Name</b></td>
		<td><b>email</b></td>
		<td><b>Birthday</b></td>
		<td><b>Country</b></td>
		<td colspan="3"><b>Action</b></td>
	</tr>
  </thead>
  <tbody>
  	@foreach($users as $user)
  	<tr>
  		<td>{{$user->id}}</td>
  		<td>{{$user->name}}</td>
  		<td>{{$user->email}}</td>
  		<td>{{$user->birthday}}</td>
  		<td>{{$user->address->country}}</td>
      <!-- Check if user is an administrator  -->   
      @if(Auth::check() and (Auth::user()->isAdmin() == true))  
  		  <td><a href="{{ route('users.edit', $user->id) }}" 
  		  	class="btn btn-secondary"><i class="fa fa-edit"></i>Edit</a></td>
  		  <td>
  		  	<form method="post" action="{{ route('users.destroy', $user->id) }}">
  		  		@method('DELETE')
  		  		@csrf
  		  		<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i>Delete</button>
  		  	</form>	
  		  </td>
      @endif
  	</tr>
  	@endforeach
  </tbody>
</table>
@if ($users instanceof \Illuminate\Pagination\LengthAwarePaginator)
  <div class="pagination justify-content-center">
	  {{ $users->links() }}
  </div> 
@endif
@endsection