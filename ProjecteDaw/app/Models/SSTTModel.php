<?php

namespace App\Models;

use CodeIgniter\Model;

class SSTTModel extends Model
{
    protected $table            = 'SSTT';
    protected $primaryKey       = 'SSTT_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["SSTT_id", "name", "address", "phone", "email","language"];

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

    public function addSSTT($SSTT_id, $name, $address, $phone, $email)
    {
        $data = [
            'SSTT_id' => $SSTT_id,
            'name' => $name,
            'address' => $address,
            'phone' => $phone,
            'email' => $email,
            'lenguage' => 'ca'
        ];
        $this->insert($data);
    }

    public function updateLang($lang){
        
        $data = [
            'language' => $lang
        ];

        // return $this->update(session()->get('mail'), ['language'->$lang]);
        return $this->where('email', session()->get('mail'))->set($data)->update();
    }
}
