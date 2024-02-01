<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class Install extends Seeder
{
    public function run()
    {
        $this->call("SSTTSeeder");
        $this->call("RegionSeeder");
        $this->call("TownSeeder");
        $this->call("CenterSeeder");
        $this->call("ProfessorSeeder");
        $this->call("StatusSeeder");
    }
}
