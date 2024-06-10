<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\LoginsModel;
use App\Models\StudentModel;
use App\Models\UsersInRoleModel;
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
                'label' => 'mail',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'eMail es un camp obligatori',
                    'valid_email' => 'No és un mail valid',
                ],
            ],
            'password' => [
                'label' => 'password',
                'rules' => 'required',
                'error' => [
                    'required' => 'Introdueixi la contrasenya'
                ]
            ]
        ];

        if ($this->validate($validationRules)) {
            $studentModel = new StudentModel();
            $id = UUID::v4();
            $studentModel->addStudent($id, $this->request->getPost('mail'));
            $loginsModel = new LoginsModel();
            $loginsModel->addLogin($this->request->getPost('mail'), $this->request->getPost('password'));
            $userRoleModel = new UsersInRoleModel();
            $userRoleModel->addUserRole($this->request->getPost('mail'), '5');
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
                return '<a href="'. base_url('delStudent/'. $row->email) . '"><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></a>';
            }, 'last')
            ->toJson();
        } else {
            echo '<alert>No tens permisos</alert>';
            return redirect()->to('login');
        }
    }
    public function deleteStudent($email) {
        $studentModel = new StudentModel();
        $student = $studentModel->obtainStByMail($email);
        if (session()->get('role') == 'Professor' && session()->get('idCenter') == $student['student_center_id']) {
            $userRoleModel = new UsersInRoleModel();
            $userRoleModel->deleteUserRole($email);
            $loginsModel = new LoginsModel();
            $loginsModel->deleteLogin($email);
            $studentModel->deleteStudent($email);
            return redirect()->to('students');
        } else {
            return redirect()->to('login');
        }
    }
}
