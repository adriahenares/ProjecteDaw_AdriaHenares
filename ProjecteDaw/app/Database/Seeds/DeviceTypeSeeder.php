<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\DeviceTypeModel;

class DeviceTypeSeeder extends Seeder
{
    public function run()
    {
        $model = new DeviceTypeModel();

        $model->save([
            'device_type' => 'Ordinador'
        ]);
        $model->save([
            'device_type' => 'Projector'
        ]);
        $model->save([
            'device_type' => 'Pantalla'
        ]);
    }
}
