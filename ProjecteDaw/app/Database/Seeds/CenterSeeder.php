<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\CenterModel;

class CenterSeeder extends Seeder
{
    public function run()
    {
        $model = new CenterModel();
        $csvFile = fopen(WRITEPATH . "uploads" . DIRECTORY_SEPARATOR . "install" . DIRECTORY_SEPARATOR . "centers.csv", "r");
        $firstline = true;
        while (($filedata = fgetcsv($csvFile, 0, ";")) !== FALSE) {
            var_dump($filedata);
            if (!$firstline) {
                $data = [
                    'center_id' => $filedata[0],
                    'name'  => $filedata[1],
                    'address'  => $filedata[2],
                    'phone'  => $filedata[3],
                    'email'  => $filedata[4],
                    'town_id'  => $filedata[5],
                    'SSTT_id'  => $filedata[6],
                    'active'  => $filedata[7],
                    'workshop'  => $filedata[8]

                ];
                $model->insert($data);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
