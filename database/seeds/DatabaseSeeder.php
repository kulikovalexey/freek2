<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (env('APP_ENV') == 'local') {
            $this->call(UsersTableSeeder::class);
            $this->call(BrandsTableSeeder::class);
        $this->call(Supplier2ProductsTableSeeder::class);
    }
    }
}
