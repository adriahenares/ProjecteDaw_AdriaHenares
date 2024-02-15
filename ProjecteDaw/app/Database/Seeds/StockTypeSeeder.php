<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\StockTypeModel;

class StockTypeSeeder extends Seeder
{
    public function run()
    {
        $model = new StockTypeModel();

        $model->save([            
            'name' => 'Placa base'
        ]);
        $model->save([            
            'name'  => 'Memòria RAM'
        ]);
        $model->save([
            'name'  => 'Gràfica'
        ]);
    }
}
