<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\TicketModel;

class TicketSeeder extends Seeder
{
    public function run()
    {
        $model = new TicketModel();

        $model->insert([
            'ticket_id' => '821198ce-5c27-43',
            'device_type_id' => '1', 
            'fault_description' => '1`poiuhygtfrd', 
            'g_center_code' => '8000013', 
            'r_center_code' => '8000013', 
            'email_person_center_g' => 'testprofessor@me.local', 
            'name_person_center_g' => 'Alexander', 
            'date_last_modification' => '08/02/2024', 
            'registration_data' => '07/02/2024', 
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
