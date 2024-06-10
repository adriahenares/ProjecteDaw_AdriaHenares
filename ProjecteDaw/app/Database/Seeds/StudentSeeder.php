<?php

namespace App\Database\Seeds;

use App\Models\StudentModel;
use CodeIgniter\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run()
    {
        $model = new StudentModel();

        $model->insert([
            'student_id' => '7446b5b8-6dea-4cfa-a5f9-18178e0437cb',
            'email' => "faixala@inscaparrella.cat",
            'student_center_id' => "8000712",
            'language' => 'ca'
        ]);
    }
}
