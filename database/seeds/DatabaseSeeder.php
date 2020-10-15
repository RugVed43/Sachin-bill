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
        // $this->call(UsersTableSeeder::class);
        // $faker = Faker::create();
        // foreach (range(1,9999) as $index) {
        //     DB::table('users')->insert([
        //         'fname' => $faker->firstName,
        //         'lname' => $faker->lastName,
        //         'username' => $faker->userName.time().rand(1,9999),
        //         'email' => $faker->email,
        //         'password' => bcrypt('secret'),
        //     ]);
        // }
        // DB::table('users')->insert([
        //     'fname' => 'USER',
        //     'lname' => 'TEST',
        //     'username' => 'user',
        //     'email' => 'info@exits.in',
        //     'password' => bcrypt('123456'),
        //     ]);
        // DB::table('users')->insert([
        //     'fname' => 'USER',
        //     'lname' => 'TEST',
        //     'username' => 'user',
        //     'email' => 'info@exits.in',
        //     'password' => bcrypt('123456'),
        //     'created_at' => date('Y-m-d h:i;s', time()),
        // ]);
        DB::table('admins')->insert([
            'fname' => 'Exits',
            'lname' => 'Admin',
            'username' => 'anto',
            'email' => 'info@exits.in',
            'password' => bcrypt('25824096'),
            'created_at' => date('Y-m-d h:i;s', time()),
        ]);

    }
}
