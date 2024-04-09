<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\TicketModel;
use App\Libraries\UUID;

class TicketSeeder extends Seeder
{
    public function run()
    {
        $model = new TicketModel();

        $model->insert([
            'ticket_id' => '6cfdd8c4-d2ce-46b1-b91e-36e229f5238f',
            'device_type_id' => '1', 
            'fault_description' => '1`poiuhygtfrd', 
            'g_center_code' => '8000013', 
            'r_center_code' => '8000013', 
            'email_person_center_g' => 'testprofessor@me.local', 
            'name_person_center_g' => 'Alexander', 
            'status_id' => '1'
        ]);

        // $model->save([            
        //     'intervention_type'  => 'Memòria RAM'
        // ]);
        // $model->save([
        //     'intervention_type'  => 'Gràfica'
        // ]);
    }
}
