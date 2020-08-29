<?php

namespace App;

use App\Models\Branch;
use App\Models\Company;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use CrudTrait;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function default_company()
    {
        $default_branch_id = $this->default_branch();

        $company = Company::whereHas('branches', function ($query) use ($default_branch_id) {
            $query->where('company_branches.id', $default_branch_id);
        })->first();

        return $company->id;
    }

    public function default_branch()
    {
        $default_branch = backpack_user()->branches()->wherePivot('is_default', true)->first();

        return $default_branch->pivot->branch_id;
    }

    private function set_current_company($company_id = null)
    {
        if( empty($company_id) ) {
            $company_id = $this->default_company();
        }

        $company = Company::find($company_id);
        session(['user.current.company.id' => $company_id]);
        session(['user.current.company.name' => $company->name]);

        return;
    }

    public function set_current_branch($branch_id = null)
    {
        if( empty($branch_id) ) {
            $branch_id = $this->default_branch();
        }

        $branch = Branch::find($branch_id);

        session(['user.current.branch.id' => $branch_id]);
        session(['user.current.branch.name' => $branch->name]);

        $this->set_current_company($branch->companies->first()->id);

        return;
    }

    public function current()
    {
        $current = arrayToObject(session('user.current'));

        return $current;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    public function companies()
    {
        return $this->belongsToMany(Company::class)->withPivot(['id', 'user_id', 'company_id']);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class)->withPivot(['is_default', 'branch_id']);
    }
}
