<?php

namespace App\Database\Seeds;

use App\Libraries\UUID;
use App\Models\StockModel;
use CodeIgniter\Database\Seeder;

class StockSeeder extends Seeder
{
    public function run()
    {
        $model = new StockModel();
        $model->insert([
            'stock_id' => UUID::v4(),
            'stock_type_id' => 1,
            'description' => "hola",
            'intervention_id' => null,
            'center_id' => 8000013,
            'purchase_date' =>  date('Y-m-d'),
            'price'  => 15,       
        ]);
    }
}
