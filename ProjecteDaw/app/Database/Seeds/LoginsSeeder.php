<?php

namespace App\Database\Seeds;

use App\Models\LoginsModel;
use CodeIgniter\Database\Seeder;

class LoginsSeeder extends Seeder
{
    public function run()
    {
        $model = new LoginsModel();

        $model->insert([
            'email' => 'admin@gmail.com',
            'password' => password_hash('1234', PASSWORD_DEFAULT)
        ]);
    }
}
