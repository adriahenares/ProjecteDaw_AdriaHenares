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
            'status' => 'Be'
        ]);
        $model->insert([
            'status' => 'Decent'
        ]);
        $model->insert([
            'status' => 'Malament'
        ]);
    }
}