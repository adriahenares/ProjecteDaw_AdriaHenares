<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\InterventionTypeModel;


class InterventionTypeSeeder extends Seeder
{
    public function run()
    {
        $model = new InterventionTypeModel();

        $model->insert([            
            'intervention_type' => 'Placa base'
        ]);
        $model->insert([            
            'intervention_type'  => 'Memòria RAM'
        ]);
        $model->insert([
            'intervention_type'  => 'Gràfica'
        ]);
    }
}
