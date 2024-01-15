<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SSTTSeeder extends Seeder
{
    public function run()
    {
        $csvFile = fopen(WRITEPATH . "uploads\install\totcat-centres-educatius.csv", "r");

        $firstline = true;

        while (($data = fgetcsv($csvFile, 0, ";")) !== FALSE) {
            var_dump($data);
            die();
            if (!$firstline) {
                $model = new UsuarisDemoModel();

                $model->save([
                    'name' => $data[0],
                    'address'  => $data[1],
                    'phone'  => $data[2],
                    'email'  => $data[3]
                ]);
            }
            $firstline = false;
        }

        fclose($csvFile);
    }
}
