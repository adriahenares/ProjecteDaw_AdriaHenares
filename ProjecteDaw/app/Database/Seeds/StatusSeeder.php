<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\StatusModel;

class StatusSeeder extends Seeder
{
    public function run()
    {
        $model = new StatusModel();

        $model->insert([
            'status' => 'Pendent'
        ]);
        $model->insert([
            'status' => 'En process'
        ]);
        $model->insert([
            'status' => 'Acabat'
        ]);
    }
}