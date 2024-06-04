<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table            = 'students';
    protected $primaryKey       = 'student_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ["student_id","email","student_center_id","language"];

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

    public function verify_mail($mail) {
        $query = $this->where('email', $mail)->first();
        if ($query != null) {
            return true;
        } else {
            return false;
        }
    }

    public function obtainStByMail($email) {
        return $this->where("email", $email)->first();
    }

    public function updateLang($lang){
        $data = [
            'language' => $lang
        ];

        // return $this->update(session()->get('mail'), ['language'->$lang]);
        return $this->where('email', session()->get('mail'))->set($data)->update();
    }
    public function studentsByCenterId($id)
    {
        return $this->select('student_id, email')
        ->where('student_center_id', $id);
    }

}
