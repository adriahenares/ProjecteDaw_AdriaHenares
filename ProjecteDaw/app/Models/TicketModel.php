<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class TicketModel extends Model
{
    protected $table = 'tickets';
    protected $primaryKey = 'ticket_id';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;
    protected $protectFields = true;
    protected $allowedFields = ['ticket_id', 'device_type_id', 'fault_description', 'g_center_code', 'r_center_code', 'email_person_center_g', 'name_person_center_g', 'status_id'];
    // protected $allowedFields = ['ticket_id', 'device_type_id', 'fault_description', 'g_center_code', 'r_center_code', 'email_person_center_g', 'name_person_center_g', 'date_last_modification', 'registration_data', 'status_id'];

    // Dates
    protected $useTimestamps = true;
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

    public function assignTicket($id, $repairCenterId)
    {
        $query = $this->where('ticket_id', $id)->find();
        if ($query != null) {
            // si no comprovar con insert
            $this->update($id, $repairCenterId);
        }
    }
    public function deleteTicket($id)
    {
        // helper('date');

        // dd($id);

        if ($id != null) {
            $this->where('ticket_id', $id);
            $this->delete();
        }

        // $data = [
        //     'deleted_at' => 
        // ];
        // $this->where('ticket_id', $id);
        // $this->set('deleted_at', date('Y-m-d H:i:s', now('GMT+2')));
        // $this->update();
    }
    public function getAllTickets()
    {
        return $this->select('tickets.ticket_id, devicetype.device_type, tickets.fault_description, centers.name, centers2.name as repairname, status.status')
            ->join('devicetype', 'tickets.device_type_id = devicetype.device_type_id')
            ->join('centers', 'tickets.g_center_code = centers.center_id', 'left')
            ->join('centers2', 'tickets.r_center_code = centers2.center_id', 'left')
            ->join('status', 'tickets.status_id = status.status_id')
            ->where('deleted_at', null);
    }
    public function getTicketsByCenterId($id)
    {
        return $this->select('tickets.ticket_id, devicetype.device_type, tickets.fault_description, centers.name, centers2.name as repairname, status.status')
            ->join('devicetype', 'tickets.device_type_id = devicetype.device_type_id')
            ->join('centers', 'tickets.g_center_code = centers.center_id', 'left')
            ->join('centers2', 'tickets.r_center_code = centers2.center_id', 'left')
            ->join('status', 'tickets.status_id = status.status_id')
            ->where('tickets.deleted_at', null)
            ->where('(tickets.g_center_code = "' . $id . '" or tickets.r_center_code = "' . $id . '")');
    }
    public function getTicketsByRepairCenterId($id)
    {
        return $this->select('tickets.ticket_id, devicetype.device_type, tickets.fault_description, centers.name, centers2.name as repairname, status.status')
            ->join('devicetype', 'tickets.device_type_id = devicetype.device_type_id')
            ->join('centers', 'tickets.g_center_code = centers.center_id', 'left')
            ->join('centers2', 'tickets.r_center_code = centers2.center_id', 'left')
            ->join('status', 'tickets.status_id = status.status_id')
            ->where('tickets.deleted_at', null)
            ->where('tickets.r_center_code = "' . $id . '"');
    }
    public function updateTicketById(
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
            'email_person_center_g' => $email_person_center_g,
            'name_person_center_g' => $name_person_center_g,
            'status_id' => $status_id
        ];
        $this->where('ticket_id', $ticket_id)->update($data);
    }
}
