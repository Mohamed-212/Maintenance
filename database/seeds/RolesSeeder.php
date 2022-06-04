<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'locations', 'guard_name' => 'web'],
            ['name' => 'taxes', 'guard_name' => 'web'],
            ['name' => 'items', 'guard_name' => 'web'],
            ['name' => 'customers', 'guard_name' => 'web'],
            ['name' => 'employees', 'guard_name' => 'web'],
            ['name' => 'inventories', 'guard_name' => 'web'],
            ['name' => 'suppliers', 'guard_name' => 'web'],
            ['name' => 'orders', 'guard_name' => 'web'],
            ['name' => 'returns', 'guard_name' => 'web'],
            ['name' => 'expenses', 'guard_name' => 'web'],
            ['name' => 'offers', 'guard_name' => 'web'],
            ['name' => 'purchase_payments', 'guard_name' => 'web'],
            ['name' => 'sales_payments', 'guard_name' => 'web'],
            ['name' => 'reports', 'guard_name' => 'web'],
            ['name' => 'administrators', 'guard_name' => 'web']
        ];
        foreach ($roles as $role)
            \App\Role::create($role);
    }
}
