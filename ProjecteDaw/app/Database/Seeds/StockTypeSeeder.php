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
            'name' => 'Font d\'alimentació'
        ]);
        $model->insert([            
            'name'  => 'Busos'
        ]);
        $model->insert([
            'name'  => 'RAM'
        ]);
        $model->insert([
            'name'  => 'CPU'
        ]);
        $model->insert([
            'name'  => 'Placa base'
        ]);
        $model->insert([
            'name'  => 'Disc dur'
        ]);
        $model->insert([
            'name'  => 'Gràfica'
        ]);
        $model->insert([
            'name'  => 'Tarjeta de so'
        ]);
        $model->insert([
            'name'  => 'Cablejat'
        ]);
        $model->insert([
            'name'  => ' Bombeta projector'
        ]);
        $model->insert([
            'name'  => 'Altres'
        ]);
    }
}
