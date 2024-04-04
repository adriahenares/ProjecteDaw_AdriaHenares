<?php

namespace App\Controllers;

use App\Controllers\BaseController;
//use App\Models\; tabla login
use App\Libraries\UUID;

$session = \Config\Services::session();  // Config és opcional

// user login aleix@gmail.com 12345 con

class SessionController extends BaseController
{
    /* funcionalitat de registre
    public function register()
    {
        helper('form');
        return view("authentication/register");
    }



    public function register_post()
    {
        // validacions complexes
        $validationRules = [
            'name' => [
                'label'  => 'nom usuari',
                'rules'  => 'required',
                'errors' => [
                    'required' => 'el nom es un camp obligator',
                ],
            ],
            'mail' => [
                'label'  => 'eMail usuari',
                'rules'  => 'required|valid_email',
                'errors' => [
                    'required' => 'eMail es un camp obligatori',
                    'valid_email' => 'No és un mail valid',
                ],
            ],
            'password' => [
                'label'  => 'Contrasenya usuari',
                'rules'  => 'required|max_length[8]',
                'errors' => [
                    'required' => 'La clau és un camp obligatori',
                    'max_length' => 'maxim 8 caracters',
                ],
            ],
            'passConfirm' => [
                'label'  => 'confirmació contrasenya usuari',
                'rules'  => 'required|max_length[8]',
                'errors' => [
                    'required' => 'La clau és un camp obligatori',
                    'max_length' => 'maxim 8 caracters',
                ],
            ],
        ];

        if ($this->validate($validationRules)) {
            if ($this->request->getPost('inputCaptcha') != session()->getFlashdata('textCaptcha')) {
                session()->setFlashdata('error', 'Completa el Captcha');
                return redirect()->back()->withInput();
            }
            if ($this->request->getPost('password') == $this->request->getPost('passConfirm')) {
                $model = new UserModel();
                $uuid = UUID::v4();
                $name = $this->request->getPost('name');
                $email = $this->request->getPost('mail');
                $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $code2fa = "";
                $role = ['user'];
                $model->addUser($uuid, $name, $email, $pass, $code2fa, $role);
                return redirect()->to(base_url("add2fa"));
                // /captcha poner i ya funcionaria
            } else {
                return redirect()->back()->withInput();
            }
        } else {
            // canviar la flash por la referencia
            session()->setFlashdata('error', 'els camps email, nom, pass son obligatoris emplena');
            return redirect()->back()->withInput();
        }
    }

    //login
    public function login()
    {
        helper('form');
        return view("authentication/login");
    }

    // funcio que s'executa al intentar fer login
    public function login_post()
    {
        // validacions complexes
        $validationRules =
            [
                'mail' => [
                    'label'  => 'eMail usuari',
                    'rules'  => 'required|valid_email',
                    'errors' => [
                        'required' => 'eMail es un camp obligatori',
                        'valid_email' => 'No és un mail valid',
                    ],
                ],
                'pass' => [
                    'label'  => 'Contrasenya usuari',
                    'rules'  => 'required',
                    'errors' => [
                        'required' => 'La clau és un camp obligatori',
                    ],
                ],
            ];

        if ($this->validate($validationRules)) {

            //$model = new UserModel();

            $email = $this->request->getPost('mail');
            $password = $this->request->getPost('pass');

            $user = $model->getUserByMail($email);

            if ($user == true) {
                if (password_verify((string)$password, $user['password'])) {
                    $sessionRole = $model->findRolesOfUser($user['idUser']);
                    $sessionData = [
                        // mod con values bien
                        'id' => $user['idUser'],
                        'name' => $user['name'],
                        'role' => $sessionRole,
                    ];
                    session()->set($sessionData);
                    return redirect()->to(base_url('/feed'));
                } else {
                    session()->setFlashdata('error', 'Failed');
                    return redirect()->back()->withInput();
                }
            } else {
                session()->setFlashdata('error', 'Failed');
                return redirect()->back()->withInput();
            }
        } else {
            session()->setFlashdata('error', 'Failed');
            return redirect()->back()->withInput();
        }
    }

    // link -> al fer click cridar funcio per deslogejar
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('/feed'));
    }
    */
}
