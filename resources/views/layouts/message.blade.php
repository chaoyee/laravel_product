@php
  // The message box structure in session       
  //   key          =>        value             
  //   string       =>        Array             
  //   'message'    =>  ['message_type','xxxx'] 
  //   example                                  
  //   'message'    =>  ['success', 'Saved!']   
@endphp

<!-- Message Box start -->
<div class="uper">
  @if(session('message'))
    <div class="alert alert-{{ session('message')[0] }}" >
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      {{ session('message')[1] }}
    </div>
  @endif
</div>
<!-- Message Box end -->