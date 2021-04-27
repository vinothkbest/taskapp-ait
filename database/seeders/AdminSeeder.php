<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create(["name" => 'Vinothkumar', "email" => "vinoth@gmail.com", "password" => Hash::make("vinoth")]);


    }
}
