@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Change Password') }}</div>
        <div class="card-body">
          <form method="POST" action="{{ route('password.change') }}">
            @csrf
            <div class="form-group row">
              <label for="current_password" class="col-md-4 col-form-label text-md-right">
                {{ __('Current Password') }}
              </label>
              <div class="col-md-6">
                <input id="current_password" type="password" 
                  class="form-control{{ $errors->has('current_password') ? ' is-invalid' : '' }}" 
                  name="current_password" value="{{ old('current_password') }}" required autofocus>
                @if ($errors->has('current_password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('current_password') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="new_password" class="col-md-4 col-form-label text-md-right">
                {{ __('New Password') }}
              </label>
              <div class="col-md-6">
                <input id="new_password" type="password" 
                  class="form-control{{ $errors->has('new_password') ? ' is-invalid' : '' }}" 
                  name="new_password" required>
                @if ($errors->has('new_password'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('new_password') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row">
              <label for="new_password_confirmation" class="col-md-4 col-form-label text-md-right">
                {{ __('Confirm New Password') }}
              </label>
              <div class="col-md-6">
                <input id="new_password_confirmation" type="password" 
                  class="form-control{{ $errors->has('new_password_confirmation') ? ' is-invalid' : '' }}" 
                  name="new_password_confirmation" required>
                @if ($errors->has('new_password_confirmation'))
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('new_password_confirmation') }}</strong>
                  </span>
                @endif
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Change Password') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection