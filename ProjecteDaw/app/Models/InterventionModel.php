<?php

namespace App\Models;

use CodeIgniter\Model;

class InterventionModel extends Model
{
    protected $table            = 'interventions';
    protected $primaryKey       = 'intervention_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];//TODO: Afegir allowed fields quan s'hagi d'afegir dades

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function addIntervention($intervention_id, $ticket_id, $professor_id, $student_id, $intervention_type_id, $description,
    $student_course, $student_studies, $intervention_date)
    {
        $data = [
            'intervention_id' => $intervention_id,
            'ticket_id' => $ticket_id,
            'professor_id' => $professor_id,
            'student_id' => $student_id,
            'intervention_type_id' => $intervention_type_id,
            'description' => $description,
            'student_course' => $student_course,
            'student_studies' => $student_studies,
            'intervention_date' => $intervention_date,
        ];
        $this->insert($data);
    }

    public function getInterventions($slug = false) {
        if($slug === false) {
            return $this->findAll();
        }
        return $this->where('intervention_id', $slug)->first();
    }
}
