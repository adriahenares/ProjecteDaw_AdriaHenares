<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\SSTTModel;

class SSTTSeeder extends Seeder
{
    public function run()
    {
        $model = new SSTTModel();
        $csvFile = fopen(WRITEPATH . "uploads" . DIRECTORY_SEPARATOR . "install" . DIRECTORY_SEPARATOR . "SSTT.csv", "r");
        $firstline = true;
        while (($filedata = fgetcsv($csvFile, 0, ";")) !== FALSE) {
            if (!$firstline) {

                
                $data = [
                    'SSTT_id' => $filedata[0],
                    'name'  => $filedata[1],
                    'address'  => $filedata[2],
                    'phone'  => $filedata[3],
                    'email'  => $filedata[4]
                ];
                $model->insert($data);
            }
            $firstline = false;
        }
        fclose($csvFile);
    }
}
