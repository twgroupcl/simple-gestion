<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCostHistory extends Model
{
    protected $table = 'product_cost_history';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
}
