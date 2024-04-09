<?php

namespace App\Models;

use CodeIgniter\Model;

class TicketModel extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'ticket_id';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['ticket_id', 'device_type_id', 'fault_description', 'g_center_code', 'r_center_code', 'email_person_center_g', 'name_person_center_g', 'status_id'];
    // protected $allowedFields = ['ticket_id', 'device_type_id', 'fault_description', 'g_center_code', 'r_center_code', 'email_person_center_g', 'name_person_center_g', 'date_last_modification', 'registration_data', 'status_id'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function addTicket(
        $ticket_id,
        $device_type_id,
        $fault_description,
        $g_center_code,
        $r_center_code,
        $email_person_center_g,
        $name_person_center_g,
        $status_id
    ) {
        $data = [
            'ticket_id' => $ticket_id,
            'device_type_id' => $device_type_id,
            'fault_description' => $fault_description,
            'g_center_code' => $g_center_code,
            'r_center_code' => $r_center_code,
            'email_person_center_g' => $email_person_center_g,
            'name_person_center_g' => $name_person_center_g,
            'status_id' => $status_id
        ];
        $this->insert($data);
    }
    public function retrieveData()
    {
        return $this->findAll();
    }

    public function retrieveSpecificData($id)
    {
        return $this->where('ticket_id', $id)->first();
    }

    public function assingTicket($id, $repairCenterId)
    {
        $query = $this->where('ticket_id', $id)->find();
        if ($query != null) {
            // si no comprovar con insert
            $this->update($id, $repairCenterId);
        }
    }
}
