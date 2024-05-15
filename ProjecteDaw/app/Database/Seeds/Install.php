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
        //temporals
        $this->call('ProfessorSeeder');
        $this->call("StudentSeeder");
        $this->call("InterventionTypeSeeder");
        $this->call("StatusSeeder");
        $this->call("DeviceTypeSeeder");
        $this->call("TicketSeeder");
        $this->call("InterventionSeeder");
        $this->call("LoginsSeeder");
        $this->call("StockTypeSeeder");
        $this->call("StockSeeder");
    }
}
