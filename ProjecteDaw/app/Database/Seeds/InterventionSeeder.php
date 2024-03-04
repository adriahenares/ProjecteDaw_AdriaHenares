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
            'ticket_id' => '821198ce-5c27-43', 
            'professor_id' => 'testprofessor', 
            'student_id' => '679612ce-5c27-43', 
            'intervention_type_id' => '1', 
            'description' => 'testeo prueba', 
            'student_course' => '2', 
            'student_studies' => 'DAM', 
            'intervention_date' => '07/02/2024', 
        ]);
    }
}
