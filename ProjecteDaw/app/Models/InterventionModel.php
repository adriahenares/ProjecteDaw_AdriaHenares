<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class InterventionModel extends Model
{
    protected $table            = 'interventions';
    protected $primaryKey       = 'intervention_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['intervention_id', 'ticket_id', 'professor_id', 'student_id', 'intervention_type_id', 'description', 'student_course', 'student_studies', 'deleted_at'];
    //TODO: Afegir allowed fields quan s'hagi d'afegir dades

    // Dates
    protected $useTimestamps = true;
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

    public function addIntervention(
        $intervention_id,
        $ticket_id,
        $professor_id,
        $student_id,
        $intervention_type_id,
        $description,
        $student_course,
        $student_studies,
        
    ) {
        $data = [
            'intervention_id' => $intervention_id,
            'ticket_id' => $ticket_id,
            'professor_id' => $professor_id,
            'student_id' => $student_id,
            'intervention_type_id' => $intervention_type_id,
            'description' => $description,
            'student_course' => $student_course,
            'student_studies' => $student_studies,
        ];
        $this->insert($data);
    }

    public function getAllInterventions()
    {
        return $this->findAll();
    }

    public function getInterventionsByTicketId($id)
    {   
        return $this->where('ticket_id', $id)->findAll();
    }

    public function deleteInterventionsByTicketId($id)
    {
        helper('date');
        $this->where('ticket_id', $id);
        $this->set('deleted_at', date('Y-m-d H:i:s', now('GMT+2')));
        $this->update();
    }
}
