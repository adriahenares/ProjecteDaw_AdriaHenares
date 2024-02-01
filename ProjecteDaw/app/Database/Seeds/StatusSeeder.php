<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\StatusModel;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $model = new StatusModel();

        $model->save([
            'status_id' => '',
            'status' => 'Be'
        ]);
        $model->save([
            'status_id' => '',
            'status' => 'Decent'
        ]);
        $model->save([
            'status_id' => '',
            'status' => 'Malament'
        ]);
    }
}