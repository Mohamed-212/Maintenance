<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\User::create([
            'name' => '212user',
            'email' => 'demo@212.com',
            'password' => bcrypt('@212.com'),
        ]);
        $user->assignRole(['locations', 'taxes', 'items', 'customers', 'employees', 'inventories', 'suppliers',
             'orders', 'returns', 'expenses', 'offers', 'purchase_payments', 'sales_payments', 'reports', 'administrators']);

    }
}
