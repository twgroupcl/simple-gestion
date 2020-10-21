<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Schema;

class CompanyBranchScope implements Scope
{
    public function apply(Builder $builder, Model $model)
    {
    	if (app()->runningInConsole()) {
    		return;
    	}

    	$user = backpack_user();

        //@todo: agregar un company por defecto
        if(!empty($user)) {
            $table = $model->getTable();

            $hasCompanyColumn = Schema::connection('mysql')->hasColumn($model->getTable(), 'company_id');

            $hasBranchColumn = Schema::connection('mysql')->hasColumn($model->getTable(), 'branch_id');

            if ($hasCompanyColumn) {
                $builder->where($table.'.company_id', $user->current()->company->id);
            }

            if ($hasBranchColumn) {
                $builder->where($table.'.branch_id', $user->current()->branch->id);
            }
        }
    }
}
