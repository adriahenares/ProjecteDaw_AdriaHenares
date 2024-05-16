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
            'student_id' => '679612ce-5c27-43',
            'email' => "faixala@inscaparrella.cat",
            'student_center_id' => "8000712",
            'language' => 'ca'
        ]);
    }
}
