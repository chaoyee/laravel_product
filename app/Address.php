<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    //
	  protected $fillable = [
      'tel',
      'address',
      'district',
      'city',
      'country',
      'zip'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
