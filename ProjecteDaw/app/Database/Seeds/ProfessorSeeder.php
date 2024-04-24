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
            'professor_id' => 'cd597db3-a6cb-4cb7-9b1d-848b04a158ff',
            'name' => 'Alexander',
            'surnames' => 'Nilei Vostob',
            'email'  => 'anilei@xtec.cat',
            'repair_center_id' => '8000712',
        ]);
    }
}
