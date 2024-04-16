<?php

namespace App\Database\Seeds;

use App\Models\LoginsModel;
use App\Models\RolesModel;
use App\Models\UsersInRoleModel;
use CodeIgniter\Database\Seeder;

class LoginsSeeder extends Seeder
{
    public function run()
    {
        $isntanceR = new RolesModel();
        $isntanceL = new LoginsModel();
        $instanceUR =  new UsersInRoleModel();
        //inserts
        //roles
        $roles = ['administrador', 'SSTT'];
        for ($i = 0; $i < 2; $i++) {
            $data = [
                'role' => $roles[$i],
            ];
            $isntanceR->insert($data);
        }
        //users
        $dataUsers = [
                'email' => 'admin@gmail.com',
                'password' => password_hash('1234', PASSWORD_DEFAULT),
        ];
        $isntanceL->insert($dataUsers);
        //userInRole

        $dataInRole = [
            'email' => $dataUsers['email'],
            'idRole' => 1
        ];
        $instanceUR->insert($dataInRole);
    }
}
