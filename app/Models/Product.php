<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $primaryKey='id';
    protected $fillable = ['id', 'productname', 'supplier_id', 'unitprice'];

    public function suppliers()
    {
        return $this->belongsTo('App\Models\Supplier'::class);
    }
    public function orders()
    {
        return $this->belongsToMany('App\Models\Order'::class, 'order_items');
    }
}
