<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderErrorLog extends Model
{
    protected $table = 'order_errors_log';
    protected $fillable = [
        'order_id',
        'order_json',
        'error_message',
        'api_response',
    ];

    protected $casts = [
        'order_json' => 'array',
    ];
}
