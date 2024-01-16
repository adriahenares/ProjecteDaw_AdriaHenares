<?php

namespace App\Models;

use CodeIgniter\Model;

class InterventionModel extends Model
{
    protected $table            = 'interventions';
    protected $primaryKey       = 'intervention_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

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

    public function addIntervention($center_id, $name, $address, $phone, $email, $town_id,
    $SSTT_id, $active, $workshop)
    {
        $data = [
            'center_id' => $center_id,
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'town_id' => $town_id,
            'SSTT_id' => $SSTT_id,
            'active' => $active,
            'workshop' => $workshop,
        ];
        $this->insert($data);
    }

    public function retrieveData() 
    {
        return $this->findAll();
    }
}
