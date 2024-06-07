<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\DeviceTypeModel;

class DeviceTypeSeeder extends Seeder
{
    public function run()
    {
        $model = new DeviceTypeModel();

        $model->insert([
            'device_type' => 'Sobretaula'
        ]);
        $model->insert([
            'device_type' => 'Portatil'
        ]);
        $model->insert([
            'device_type' => 'Pantalla'
        ]);
        $model->insert([
            'device_type' => 'Projector'
        ]);
        $model->insert([
            'device_type' => 'Impressora'
        ]);
    }
}
