<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
    protected $table = 'product_logs';
    protected $guarded = ['id'];
    protected $casts = [
        'images_json' => 'array',
        'variations_json' => 'array',
        'attributes_json' => 'array',
        'inventories_json' => 'array',
        'json_value' => 'array',
    ];
}
