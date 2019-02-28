{{--  input variables  --}}
{{--     $user         --}}
{{--     $address      --}}

<h3>Shipping Information</h3> 
<div class="container">
  <div class="row">
    <div class="form-group col-md-3">
      <label for="name">Name</label>
      <input type="text" class="form-control" name="name" value="{{ $user->name }}" disabled />  
    </div>
    <div class="form-group col-md-3">
      <label for="email">EMail</label>
      <input type="email" class="form-control" name="email" value="{{ $user->email }}" disabled/> 
    </div>
    <div class="form-group col-md-3">
      <label for="birthday">Birthday</label>
      <input type="date" class="form-control" name="birthday" value="{{ $user->birthday }}" disabled/> 
    </div>
    <div class="form-group col-md-3">
      <label for="tel">Tel</label>
      <input type="tel" class="form-control" name="tel" value="{{ $address->tel }}" disabled/>
    </div>
  </div>
  
  <div class="row">
    <div class="form-group col-md-6">
      <label for="address">Address</label>
      <input type="text" class="form-control" name="address" value="{{ $address->address }}" disabled/>
    </div>
    <div class="form-group col-md-3">
      <label for="district">District</label>
      <input type="text" class="form-control" name="district" value="{{ $address->district }}" disabled  />
    </div>
  </div>   

  <div class="row">
    <div class="form-group col-md-3">
      <label for="city">City</label>
      <input type="text" class="form-control" name="city" value="{{ $address->city }}" disabled/>   
    </div>
    <div class="form-group col-md-3">
      <label for="country">Country</label>
      <input type="text" class="form-control" name="country" value="{{ $address->country }}" disabled/>
    </div>  
    <div class="form-group col-md-2">
      <label for="zip">Zip</label>
      <input type="number" min="100" max="999" class="form-control" name="zip" value="{{ $address->zip }}" disabled/>   
    </div>
  </div> 
</div>