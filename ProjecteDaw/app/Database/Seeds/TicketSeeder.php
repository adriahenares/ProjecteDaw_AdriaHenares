<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\TicketModel;

class TicketSeeder extends Seeder
{
    public function run()
    {
        $model = new TicketModel();

        $model->save([            
            'device_type_id' => '0', 
            'fault_description' => '1`poiuhygtfrd', 
            'g_center_code' => '8000013', 
            'r_center_code' => '8000013', 
            'email_person_center_g' => '8000013@xtec.cat', 
            'name_person_center_g' => '8000013@xtec.cat', 
            'date_last_modification' => '08/02/2024', 
            'registration_data' => '07/02/2024', 
            'status_id' => '0'
        ]);

        // $model->save([            
        //     'intervention_type'  => 'Memòria RAM'
        // ]);
        // $model->save([
        //     'intervention_type'  => 'Gràfica'
        // ]);
    }
}
