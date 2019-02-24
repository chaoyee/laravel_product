<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class ChangePasswordController extends Controller
{
	public function __construct() {
    $this->middleware('auth');
  }

  public function showChangeForm() {
    return view('auth.passwords.change');   
  }
  
  public function change(Request $request) {
    $current_password = $request->get('current_password');
    $new_password     = $request->get('new_password');
    
    // User authentication check
    if (Hash::check($current_password, Auth::user()->password)) {
    	// Current and new password are the same, meaning user does not change password.
      if (strcmp($current_password, $new_password) != 0) { 
        $request->validate([
          'current_password' => 'required',
          'new_password'     => 'required|string|min:6|confirmed',
        ]); 

        // Change password
        $user = Auth::user();
        $user->password = Hash::make($new_password);
        $user->save();
        return redirect('/')->with('message', ['success', 'Password has been updated!']);
         
      } else {
        return redirect()->back()->with('message', ['danger', 'New and current password are the same!']);
      }
    } else {
    	return redirect()->back()->with('message', ['danger', 'Password incorrect!']);
    }
  }
}
