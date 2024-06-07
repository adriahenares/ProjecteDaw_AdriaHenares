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
            'status' => 'Inicial'
        ]);
        $model->insert([
            'status' => 'Magatzem SSTT'
        ]);
        $model->insert([
            'status' => 'Al centre reparador'
        ]);
        $model->insert([
            'status' => 'En reparació'
        ]);
        $model->insert([
            'status' => 'Reparat i pendent de recollir'
        ]);
        $model->insert([
            'status' => 'Recollit'
        ]);
        $model->insert([
            'status' => 'Entregat i finalitzat'
        ]);
        $model->insert([
            'status' => 'Desguasat i finalitzat'
        ]);
    }
}