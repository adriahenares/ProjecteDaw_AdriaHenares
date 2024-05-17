<?php

namespace App\Database\Seeds;

use App\Models\InterventionModel;
use CodeIgniter\Database\Seeder;

class InterventionSeeder extends Seeder
{
        
    public function run()
    {   
        $model = new InterventionModel();

        $model->insert([
            'intervention_id' => '827890ce-5c27-25',
            'ticket_id' => '6cfdd8c4-d2ce-46b1-b91e-36e229f5238f', 
            'professor_id' => 'cd597db3-a6cb-4cb7-9b1d-848b04a158ff', 
                'student_id' => '679612ce-5c27-43', 
                'intervention_type_id' => '1', 
            'description' => 'He cambiat la memoria RAM.', 
            'student_course' => '2', 
            'student_studies' => 'DAM', 
        ]);
    }
}
