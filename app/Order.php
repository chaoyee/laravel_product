<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
	  protected $fillable = [
      'user_id', 'order_total', 'order_date', 'order_status'
	  ];

    public function orderDetails() {
    	return $this->hasMany('App\OrderDetail', 'order_id');
    }

    public function user() {
    	return $this->belongsTo('App\User', 'user_id');
    }
}
