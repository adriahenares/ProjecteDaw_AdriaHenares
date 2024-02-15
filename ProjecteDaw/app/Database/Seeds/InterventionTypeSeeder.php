<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\InterventionTypeModel;


class InterventionTypeSeeder extends Seeder
{
    public function run()
    {
        $model = new InterventionTypeModel();

        $model->save([            
            'intervention_type' => 'Placa base'
        ]);
        $model->save([            
            'intervention_type'  => 'Memòria RAM'
        ]);
        $model->save([
            'intervention_type'  => 'Gràfica'
        ]);
    }
}
