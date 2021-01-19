<?php
namespace App\Http\Middleware;
use Closure;
use App\Models\Seller;
class CheckIfSellerActive
{
    public function handle($request, Closure $next)
    {
        $seller = Seller::where('user_id', backpack_user()->id)->first();

        if ( isset($seller) && ( 
            $seller->status == 0 || 
            $seller->is_approved != Seller::REVIEW_STATUS_APPROVED 
        )) {
            \Auth::logout();
        }
            //return response(trans('backpack::base.unauthorized'),401);
        
        return $next($request);
    }
}
