<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanSuscription extends Model
{
    protected $table = 'plan_subscriptions';    
    protected $primaryKey = 'slug';
}
