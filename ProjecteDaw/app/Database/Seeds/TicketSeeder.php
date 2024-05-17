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
            'fault_description' => 'L\'ordinador no s\'encen i anava molt lent.',
            'g_center_code' => '8021594',
            'r_center_code' => '43010116',
            'email_person_center_g' => 'anilei@xtec.cat',
            'name_person_center_g' => 'Alexander',
            'status_id' => '1'
        ]);

        $model->insert([
            'ticket_id' => 'dd7429f5-dc84-4e68-b094-adc9592ff307',
            'device_type_id' => '2',
            'fault_description' => 'Projecta de color groc',
            'g_center_code' => '8020486',
            'r_center_code' => '43010116',
            'email_person_center_g' => 'anilei@xtec.cat',
            'name_person_center_g' => 'Alexander',
            'status_id' => '1'
        ]);

        $model->insert([
            'ticket_id' => 'e54bac31-1744-4a5e-a0f9-dd4e176dcd47',
            'device_type_id' => '3',
            'fault_description' => 'La pantalla parpadeja',
            'g_center_code' => '8017153',
            'r_center_code' => '43010116',
            'email_person_center_g' => 'anilei@xtec.cat',
            'name_person_center_g' => 'Alexander',
            'status_id' => '1'
        ]);

        $model->insert([
            'ticket_id' => 'e816e721-c403-4a2f-b0ef-ca648ee9fd85',
            'device_type_id' => '1',
            'fault_description' => 'A vegades es mostra una pantalla blava',
            'g_center_code' => '8017153',
            'r_center_code' => '43010116',
            'email_person_center_g' => 'anilei@xtec.cat',
            'name_person_center_g' => 'Alexander',
            'status_id' => '1'
        ]);

        $model->insert([
            'ticket_id' => '6642e9c9-9111-42d9-8925-26b6d927fcba',
            'device_type_id' => '1',
            'fault_description' => 'L\'ordinador es sobrecalenta',
            'g_center_code' => '8005618',
            'r_center_code' => '43010116',
            'email_person_center_g' => 'anilei@xtec.cat',
            'name_person_center_g' => 'Alexander',
            'status_id' => '1'
        ]);

        $model->insert([
            'ticket_id' => '671d7eb3-af3b-4c29-ac18-f737d68cfff1',
            'device_type_id' => '3',
            'fault_description' => 'No funciona el port hdmi',
            'g_center_code' => '8005564',
            'r_center_code' => '43010116',
            'email_person_center_g' => 'anilei@xtec.cat',
            'name_person_center_g' => 'Alexander',
            'status_id' => '1'
        ]);

        $model->insert([
            'ticket_id' => '7fe28458-eceb-4a8b-8d88-8da69106ed0c',
            'device_type_id' => '1',
            'fault_description' => 'No funciona la tarjeta de xarxa',
            'g_center_code' => '8001789',
            'r_center_code' => '43010116',
            'email_person_center_g' => 'anilei@xtec.cat',
            'name_person_center_g' => 'Alexander',
            'status_id' => '1'
        ]);

        $model->insert([
            'ticket_id' => 'b64052a4-0758-47f0-be90-6a8c861e4c01',
            'device_type_id' => '2', 
            'fault_description' => 'El projector fa massa soroll', 
            'g_center_code' => '8000979', 
            'r_center_code' => '43010116', 
            'email_person_center_g' => 'anilei@xtec.cat', 
            'name_person_center_g' => 'Alexander', 
            'status_id' => '1'
        ]);

        $model->insert([
            'ticket_id' => 'e7c9688b-98e1-4261-abde-eea483c8559a',
            'device_type_id' => '1', 
            'fault_description' => 'S\'ha espallat el disc dur', 
            'g_center_code' => '8000165', 
            'r_center_code' => '43010116', 
            'email_person_center_g' => 'anilei@xtec.cat', 
            'name_person_center_g' => 'Alexander', 
            'status_id' => '1'
        ]);

        $model->insert([
            'ticket_id' => 'f756837b-0d8d-418d-9682-1e069f87d23f',
            'device_type_id' => '3', 
            'fault_description' => 'La pantalla no encen', 
            'g_center_code' => '8000165', 
            'r_center_code' => '43010116', 
            'email_person_center_g' => 'anilei@xtec.cat', 
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
