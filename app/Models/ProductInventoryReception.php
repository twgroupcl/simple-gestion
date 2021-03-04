<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInventoryReception extends Model
{
    protected $table = 'product_inventory_receptions';
    protected $guarded = ['id'];
    protected $fillable = [
        'document_number',
        'user_id',
        'products_data',
        'type_operation',
        'excel_path',
        'company_id',
    ];

    protected $casts = [
        'products_data' => 'array',
    ];
}