<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = [['department_id' => 1, 'name'=>'Dakota Rice', 'age' => 22, 'gender' => 'Female', 'mobile'=>'8344667591', 'email'=>'dakota.r@gmail.com', 'address' => json_encode(['location' => 'Guindy', 'city' => 'Chennai'])], ['department_id' => 2, 'name'=>'Minerva Hooper', 'age' => 27, 'gender' => 'Female', 'mobile'=>'8344667599', 'email'=>'minerva.hooper@gmail.com', 'address' => json_encode(['location' => 'Kryslini de', 'city' => 'Lyon'])],
    		['department_id' => 2, 'name'=>'Sage Rodriguez', 'age' => 30, 'gender' => 'Male', 'mobile'=>'8344669595', 'email'=>'sage.rodriguez@gmail.com', 'address' => json_encode(['location' => 'Frskliti', 'city' => 'Brazillia'])],
    		['department_id' => 4, 'name'=>'Saravanan', 'age' => 29, 'gender' => 'Male', 'mobile'=>'8344669999', 'email'=>'saravanan@gmail.com', 'address' => json_encode(['location' => 'Thogaimalai', 'city' => 'Karur'])],
    		['department_id' => 3, 'name'=>'Vinoth Kumar', 'age' => 32, 'gender' => 'Male', 'mobile'=>'8344667595', 'email'=>'vinothkbest@gmail.com', 'address' => json_encode(['location' => 'Manapparai', 'city' => 'Trichy'])],
    		['department_id' => 1, 'name'=>'Manikandan', 'age' => 21, 'gender' => 'Male', 'mobile'=>'8344777591', 'email'=>'manikandan.k@gmail.com', 'address' => json_encode(['location' => 'Manapparai', 'city' => 'Trichy'])],];

        foreach ($employees as $employee) {
        	Employee::create($employee);
        }
    }
}
