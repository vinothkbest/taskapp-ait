<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $departments = [['name' => 'Development'], ['name' => 'Marketing'], ['name' => 'Management'], ['name' => 'Production']];

        foreach ($departments as $department) {
        	Department::create($department);
        }
    }
}
