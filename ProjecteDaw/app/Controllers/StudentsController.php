<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StudentModel;
use CodeIgniter\HTTP\ResponseInterface;
use \Hermawan\DataTables\DataTable;
use App\Libraries\UUID;

class StudentsController extends BaseController
{
    //register de alumnes 
    public function validateStudents()
    {
        return view('authentication/register/validateStudents');
    }

    public function validateStudents_post()
    {
        $validationRules = [
            'mail' => [
                'label' => 'eMail usuari',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'eMail es un camp obligatori',
                    'valid_email' => 'No és un mail valid',
                ],
            ],
        ];

        if ($this->validate($validationRules)) {
            $instanceSt = new StudentModel();
            $data = [
                'student_id' => UUID::v4(),
                'email' => $this->request->getPost('mail'),
                'student_center_id' => session()->idCenter,
                'language' => 'ca'
            ];
            $instanceSt->insert($data);
            return redirect()->to(base_url('students'));
        } else {
            session()->setFlashdata('error', 'Failed');
            return redirect()->back()->withInput();
        }
    }

    public function loadTableData($id)
    {
        if (session()->get('role') == 'Admin' || session()->get('role') == 'Professor') {
            $studentModel = new StudentModel();
            $builder = $studentModel->studentsByCenterId($id);
            return DataTable::of($builder)
            ->add('action', function ($row) {
                return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit customer: ' . $row->student_id . '\')" ><i class="fas fa-edit"></i></button>';
            }, 'last')
            ->toJson();
        } else {
            echo '<alert>No tens permisos</alert>';
            return redirect()->to('login');
        }
    }
}
