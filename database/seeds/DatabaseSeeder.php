<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([CountriesTableSeeder::class, RegionsTableSeeder::class, ProvincesTableSeeder::class, CommunesTableSeeder::class, TaxesTableSeeder::class, InvoiceTypesTableSeeder::class, BusinessActivitiesTableSeeder::class]);
        $this->call(CurrenciesTableSeeder::class);
        $this->call(UnitsTableSeeder::class);
        $this->call([CompaniesTableSeeder::class, BranchesTableSeeder::class, BranchCompaniesTableSeeder::class, RolesTableSeeder::class, UsersTableSeeder::class, ModelHasRolesTableSeeder::class, CompanyUsersTableSeeder::class, BranchUsersTableSeeder::class]);
        $this->call([AttributeModulesTableSeeder::class, AttributeFamiliesTableSeeder::class, AttributeFieldsTableSeeder::class, AttributesTableSeeder::class, AttributeGroupsTableSeeder::class, AttributeGroupMappingTableSeeder::class]);
    }
}
