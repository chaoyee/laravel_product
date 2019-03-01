<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    //
	  protected $fillable = [
      'order_id', 'product_id', 'sub_qty', 'sub_total'
	  ];

    public function orderDetail() {
    	return $this->belongsTo('App\Order', 'order_id');
    }

    public function product() {
    	return $this->belongsTo('App\Product', 'product_id');
    }
}
