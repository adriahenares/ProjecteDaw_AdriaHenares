<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\TownModel;

class TownSeeder extends Seeder
{
    public function run()
    {
        $model = new TownModel();
        $csvFile = fopen(WRITEPATH . "uploads" . DIRECTORY_SEPARATOR . "install" . DIRECTORY_SEPARATOR . "towns.csv", "r");
        $firstline = true;
        while (($filedata = fgetcsv($csvFile, 0, ";")) !== FALSE) {
            var_dump($filedata);
            if (!$firstline) {
                $data = [
                    'town_id' => $filedata[0],
                    'name'  => $filedata[1],
                    'region_id'  => $filedata[2]
                ];
                $model->insert($data);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
