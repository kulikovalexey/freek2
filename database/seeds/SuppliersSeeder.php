<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;
use App\Role;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset the users table
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('suppliers')->truncate();

        $data = include '../../config/suppliers.php';

        foreach ($data as $item) {
            $suppliers[] = [
                [
                    'id' => $item['id'],
                    'name' => $item['name'],
                    'inside_name' => $item['_name'],
                ]
            ];
        }

        DB::table('suppliers')->insert(
            $suppliers
        );
    }
}
