<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
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
        DB::table('users')->truncate();

        //generate 3 users/author
        $faker = Factory::create();

        // standard name
        $user = [
            [
                'id' => 1,
                'name' => 'administrator',
                'slug' => 'user-administrator',
                'email' => 'admin@admin.com',
                'password' => bcrypt('secret'),
                'avatar' => $faker->image(),
            ],
            [
                'id' => 2,
                'name' => 'user',
                'slug' => 'user-user',
                'email' => 'user@user.com',
                'password' => bcrypt('secret'),
                'avatar' => $faker->image(),
            ],
            [
                'id' => 3,
                'name' => 'blogger',
                'slug' => 'user-blogger',
                'email' => 'blogger@blogger.com',
                'password' => bcrypt('secret'),
                'avatar' => $faker->image(),
            ],
        ];


        DB::table('users')->insert(
            $user
        );
    }
}
