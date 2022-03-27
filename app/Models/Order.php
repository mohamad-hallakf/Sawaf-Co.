<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'orderdate', 'ordernumber', 'customer_id', 'totalamount'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer'::class);
    }
    public function items()
    {
        return $this->belongsToMany('App\Models\Product'::class, 'order_items');
    }
}
