<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Address;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('is_admin')->only(['index', 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::paginate(config('constants.PAGINATION'));
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
        // Since user is created and stored in RegisterController.php @showRegistrationForm
        //   and @register , so it's no need to set in UserController.
        // RegisterController@showRegistrationForm   => no need for UserController@create
        // RegisterController@register               => no need for UserController@store
        // 
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
         //
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::find($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        $address = $user->address;
        if (!$address) {
          $address = new Address(['user_id' => $user->id]);
          $address->save();
        } 
        return view('users.edit', compact('user', 'address'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
          'name'     => 'string', 
          'email'    => 'email',
          'birthday' => 'date',
          'tel'      => 'string', 
          'address'  => 'string', 
          'district' => 'string', 
          'city'     => 'string', 
          'country'  => 'string', 
          'zip'      => 'integer'
        ]);
        $user = User::find($id);
        $address = $user->address;
        $user->name     = $request->get('name');   
        $user->email    = $request->get('email');
        $user->birthday = $request->get('birthday'); 
        $address->tel      = $request->get('tel');
        $address->address  = $request->get('address');
        $address->district = $request->get('district');
        $address->city     = $request->get('city');
        $address->country  = $request->get('country');
        $address->zip      = $request->get('zip');
        $user->save();
        $address->save();
        return "<script>alert('The user has been updated!');history.go(-2);</script>";
        // return redirect()->back()->with('message', ['success', 'The user has been updated!']); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
      $user = User::find($id);
      $address = $user->address;
      $user->delete();
      $address->delete();
      return redirect('/users')->with('message', ['danger', 'The user has been deleted!']);
    }
}
