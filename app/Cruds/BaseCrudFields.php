<?php

namespace App\Cruds;

use Illuminate\Support\Facades\Schema;

class BaseCrudFields
{
	public function setBaseFields($crud)
	{
		$user = backpack_user();

		$model = $crud->model;

		$hasCompanyColumn = Schema::connection('mysql')->hasColumn($model->getTable(), 'company_id');

		$hasCompanyBranchColumn = Schema::connection('mysql')->hasColumn($model->getTable(), 'branch_id');

		if ($hasCompanyColumn) {
			$crud->addField([
				'name' => 'company_id',
				'type' => 'hidden',
				'value' => $user->current()->company->id,
			]);
		}

		if ($hasCompanyBranchColumn) {
			$crud->addField([
				'name' => 'branch_id',
				'type' => 'hidden',
				'value' => $user->current()->branch->id,
			]);
		}

		return $crud;
	}
}
