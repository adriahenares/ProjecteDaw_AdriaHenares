<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\StockTypeModel;

class StockTypeSeeder extends Seeder
{
    public function run()
    {
        $model = new StockTypeModel();

        $model->insert([            
            'name' => 'Placa base'
        ]);
        $model->insert([            
            'name'  => 'Memòria RAM'
        ]);
        $model->insert([
            'name'  => 'Gràfica'
        ]);
    }
}
