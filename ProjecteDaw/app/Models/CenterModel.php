<?php

namespace App\Models;

use CodeIgniter\Model;

class CenterModel extends Model
{
    protected $table            = 'centers';
    protected $primaryKey       = 'center_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["center_id", "name", "address", "phone", "email", "town_id", "SSTT_id", "active", "workshop","language"];

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

    public function addCenter($center_id, $name, $address, $phone, $email, $town_id, $SSTT_id, $active, $workshop)
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

    public function getAllCentersId() {
        $centerArr = $this->findAll();
        return $centerArr;
    }

    //funcio API 
    public function putEmailOfCenter($id) {
        return $this->where('center_id', $id)->first();
    }

    public function verifyCenter ($email) {
        $verify = false;
        $query = $this->where('email', $email)->first();
        if ($query != null) {
            $verify = true;
        }
        return $verify;
    }

    //obtenim el centre  per email
    public function obtainCenterByEmail($email) {
        return $this->where('email', $email)->first();
    }

    public function updateLang($lang){
        return $this->update(session()->get('mail'), ['language'->$lang]);
    }

}
