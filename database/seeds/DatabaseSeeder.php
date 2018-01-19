<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Administrator',
            'email' => 'admin@sales.com',
            'password' => bcrypt('password'),
            ]);

        // DB::table('items')->insert([
        //     [
        //         'name' => 'Fanta',
        //         'unitName' => 'bottle',
        //         'bundleName' => 'crate',
        //         'unitsPerBundle' => 24,
        //         'category' => 'drinks',
        //     ],
        //     [
        //         'name' => 'Coca Cola',
        //         'unitName' => 'bottle',
        //         'bundleName' => 'crate',
        //         'unitsPerBundle' => 24,
        //         'category' => 'drinks',
        //     ],
        //     [
        //         'name' => 'Bear',
        //         'unitName' => 'bottle',
        //         'bundleName' => 'crate',
        //         'unitsPerBundle' => 24,
        //         'category' => 'drinks',
        //     ],
        //     [
        //         'name' => 'Bread',
        //         'unitName' => 'loaf',
        //         'bundleName' => null,
        //         'unitsPerBundle' => 24,
        //         'category' => 'eats',
        //     ],
        //     ]);
        // $this->call(UsersTableSeeder::class);
    }
}
