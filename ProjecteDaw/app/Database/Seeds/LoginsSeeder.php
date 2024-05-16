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
        $roles = ['Admin', 'SSTT', 'Center', 'Professor', 'Student'];
        for ($i = 0; $i < count($roles); $i++) {
            $data = [
                'role' => $roles[$i],
            ];
            $isntanceR->insert($data);
        }
        //users
        $dataUsers = [
            'email' => 'st_lleida.educacio@gencat.cat',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
        ];

        $isntanceL->insert($dataUsers);
        //userInRole

        $dataInRole = [
            'email' => $dataUsers['email'],
            'idRole' => 2
        ];
        $instanceUR->insert($dataInRole);
        $dataUsers = [
            'email' => 'admin@gmail.com',
            'password' => password_hash('123456', PASSWORD_DEFAULT),
        ];
        $isntanceL->insert($dataUsers);
        $dataInRole = [
            'email' => $dataUsers['email'],
            'idRole' => 1
        ];
        $instanceUR->insert($dataInRole);
    }
}
