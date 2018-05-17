<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
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
        DB::table('events')->truncate();

        //generate 3 users/author
        $faker = Factory::create();

        /*
         *
         $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->tinyInteger('published')->nullable();
            $table->dateTime('event_time')->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('modified_by')->nullable();
            $table->timestamps();
         *
         *
         */
        // standard name
//        $events = [
//            [
//                'id' => 1,
//                'title' => 'administrator',
//                'slug' => 'user-administrator',
//                'published' => true,
//                'event_time' => ,
//            ],
//            [
//                'id' => 2,
//                'name' => 'user',
//                'slug' => 'user-user',
//                'email' => 'user@user.com',
//                'password' => bcrypt('secret'),
//                'avatar' => $faker->image(),
//            ],
//            [
//                'id' => 3,
//                'name' => 'blogger',
//                'slug' => 'user-blogger',
//                'email' => 'blogger@blogger.com',
//                'password' => bcrypt('secret'),
//                'avatar' => $faker->image(),
//            ],
//        ];
    }
}
