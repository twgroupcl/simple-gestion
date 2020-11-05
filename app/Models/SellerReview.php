<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SellerReview extends Model
{
    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'seller_reviews';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    protected $fillable = [
        'seller_id',
        'customer_id',
        'title',
        'rating',
        'comment',
        'pros',
        'cons',
        'status',
    ];
    // protected $hidden = [];
    // protected $dates = [];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    public function scopeCustomSort($query, $order)
    {
        switch ($order) {
            case 'asc':
                return $query->orderBy('created_at', 'asc');
                break;

            case 'popular':
                return $query->orderBy('rating', 'asc');
                break;

            case 'high-rating':
                return $query->orderBy('rating', 'desc');
                break;

            case 'low-rating':
                return $query->orderBy('rating', 'asc');
                break;

            default:
                return $query->latest();
                break;
        }

    }

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
