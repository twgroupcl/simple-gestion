<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPriceHistory extends Model
{
    protected $table = 'product_price_history';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
}
