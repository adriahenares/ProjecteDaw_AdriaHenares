<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessorModel extends Model
{
    protected $table            = 'professors';
    protected $primaryKey       = 'professor_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [ 'professor_id' , 'name', 'surnames' , 'email' , 'repair_center_id',"language"];

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

    // Aleix
    // obtenir el codi de centre reparador amb la id 
    public function getGeneratingCodeById ($id) {
        return $this->where('professor_id', $id)->first();
    }

    //verifica si el professor esta a la taula professor
    public function verifyProfessor ($email) {
        $verify = false;
        $query = $this->where('email', $email)->first();
        if ($query != null) {
            $verify = true;
        }
        return $verify;
    }
    // obtenir un profesor en especific
    public function obtainProfessor($email) {
        return $this->where('email', $email)->first();

    }
  
    public function obtainAllProfessors() {
        $professorArr = $this->findAll();
        return $professorArr;

    }
    // funcio per comprovar si es estudiant o professor 
    public function checkIfProfessorOrStudent($email) {
        // comprovacio professors
        $data = $this->where('email', $email)->first();
        if ($data != null) {
            $valueSession = 2;
            return $valueSession;
        }
        //comprovacio estudiants
        $instance = new StudentModel();
        $data = $instance->where('email', $email)->first();
        if ($data != null) {
            $valueSession = 3;
            return $valueSession;
        }
        return 0;
    }

    //funcio que al passarli la id ens retorna el professors de aquells centres
    public function getProfessorsByCenterId ($id) {
        return $this->where('repair_center_id', $id)->findAll();
    }

    public function updateLang($lang){

        $data = [
            'language' => $lang
        ];

        // return $this->update(session()->get('mail'), ['language'->$lang]);
        return $this->where('email', session()->get('mail'))->set($data)->update();
    }

}

