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

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'tel' => ['string', 'nullable'],
            'address' => ['string', 'nullable'],
            'district' => ['string', 'nullable'],
            'city' => ['string','nullable'],
            'country' => ['string', 'nullable'],
            'zip' => ['integer', 'min:3', 'nullable']
        ]);
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
