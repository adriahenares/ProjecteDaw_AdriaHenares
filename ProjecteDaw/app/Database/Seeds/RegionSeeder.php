<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\RegionModel;

class RegionSeeder extends Seeder
{
    public function run()
    {
        $model = new RegionModel();
        $csvFile = fopen(WRITEPATH . "uploads" . DIRECTORY_SEPARATOR . "install" . DIRECTORY_SEPARATOR . "regions.csv", "r");
        $firstline = true;
        while (($filedata = fgetcsv($csvFile, 0, ";")) !== FALSE) {
            if (!$firstline) {
                $data = [
                    'region_id' => $filedata[0],
                    'name'  => $filedata[1]
                ];
                $model->insert($data);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
