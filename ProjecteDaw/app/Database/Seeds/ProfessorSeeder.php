<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\ProfessorModel;

class ProfessorSeeder extends Seeder
{
    public function run()
    {
        $model = new ProfessorModel();

        $model->insert([
            'professor_id' => 'testprofessor',
            'name' => 'Alexander',
            'surnames' => 'Nilei Vostob',
            'email'  => 'testprofessor@me.local',
            'repair_center_id' => '8000712',
        ]);
    }
}
