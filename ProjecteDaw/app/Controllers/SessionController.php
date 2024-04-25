<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\UUID;
use App\Models\CenterModel;
//use App\Models\; tabla login
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Models\LoginsModel;
use App\Models\ProfessorModel;
use App\Models\StudentModel;
use Google\Service\Classroom\Student;

$session = \Config\Services::session();  // Config és opcional

// user login aleix@gmail.com 12345 con

class SessionController extends BaseController
{
    //funcionalitat de registre sstt
    public function redirectToLogin() {
        return redirect()->to('loginAuth');
    }

    public function loginNormal()
    {
        helper('form');
        return view("authentication/login/loginN");
    }

    public function login_post_Normal()
    {
        $validationRules = [
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
            $instance = new LoginsModel();
            
            $email = $this->request->getPost('mail');
            $password = $this->request->getPost('pass');
            
            $user = $instance->getUserByMail($email);
            if ($user == true) {
                d($user['password']);
                d($password[0]);
                d(password_verify((string)$password, $user['password']));
                if (password_verify((string)$password, $user['password'])) {
                    d('asdda');
                    $sessionData = [
                        'email' => $user['email'],
                        //atribut per verificar que el usuari no es professor ni alumne
                        'nonTraditional' => 1,
                    ];
                    session()->set($sessionData);
                    return redirect()->to('/viewTickets');
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

    //login
    public function google_login()
    {
        $instanceSt = new StudentModel();
        $instanceProfessor = new ProfessorModel();
        $instanceC = new CenterModel();
        $client = new \Google\Client();
        //$client->setAuthConfig('/path/to/client_credentials.json');

        $client->setClientId('216671585995-4knv971ddku8t6uqlleariq04qs2n27c.apps.googleusercontent.com'); //Define your ClientID
        $client->setClientSecret('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'); //Define your Client Secret Key

        $client->setRedirectUri('http://localhost:80/login'); //Define your Redirect Uri

        //$client->addScope(\Google\Service\Drive::DRIVE_METADATA_READONLY);
        $client->addScope(\Google\Service\Oauth2::USERINFO_EMAIL);
        $client->addScope(\Google\Service\Oauth2::USERINFO_PROFILE);
        $client->addScope(\Google\Service\Oauth2::OPENID);
        //$client->addScope('profile');
        $client->setAccessType('offline');
        //variariable per trobar si alumne o professor
        $userVerification = false;
        //$data['titol'] = "GSuite login";
        $client->addScope('email');
        if (isset($_GET["code"])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

            if (!isset($token["error"])) {
                $client->setAccessToken($token['access_token']);

                session()->set('access_token', $token['access_token']);

                $oauth2 = new \Google\Service\Oauth2($client);

                $userInfo = $oauth2->userinfo->get();
                $data['mail'] = $userInfo->getEmail();
                //validacions
                $pos = strpos($data['mail'], '@');
                $mailLast = substr($data['mail'], $pos);
                if ($mailLast == '@xtec.cat' || $instanceSt->verify_mail($data['mail']) == true) {
                    $data['nom'] = $userInfo->getGivenName();
                    $data['cognoms'] = $userInfo->getFamilyName();
                    $data['nomComplet'] = $userInfo->getName();
                    //comprovem la extensio del correu per veure si es alumne o professor
                    if ($mailLast == '@xtec.cat') {
                        //si ets un professor atribut nonTraditional a 0 per identificar que es un professor
                        $data['nonTraditional'] = 0;
                        if ($instanceProfessor->verifyProfessor($data['mail']) == false) {
                            $userVerification = true;
                        }
                    }

                   
                    //l'usuari es un professor 
                    if ($userVerification == true ) {
                        // creacio de les variables per professor 
                        $pos = strpos($data['nomComplet'], ' ');
                        $surnames = substr($data['nomComplet'], $pos);
                        $uuid = UUID::v4();
                        $dataProf = [
                            'professor_id' => $uuid,
                            'name' => $data['nom'],
                            'surnames' => $surnames,
                            'email' => $data['mail'],
                            'repair_center_id' => null
                        ];
                        $instanceProfessor->insert($dataProf);
                    }
                    session()->set('sessionData', $data);
                } else {
                    $this->logOut_function();
                    session()->setFlashdata('error', 'error, conta no valida');
                    $login_button = '';
                    $login_button = '<a href="' . $client->createAuthUrl() . '">LOGIN WITH GOOGLE</a>';
                    $data['login_button'] = $login_button;
                    return view("authentication/login/login", $data);
                }
            }
        }

        if (!session()->get('access_token')) {
            $login_button = '';
            $login_button = '<a href="' . $client->createAuthUrl() . '">LOGIN WITH GOOGLE</a>';
            $data['login_button'] = $login_button;
            return view("authentication/login/login", $data);
        } else {
            if ($userVerification == true) {
                session()->setFlashdata('id', $uuid);
                $dataView['center'] =  $instanceC->getAllCentersId();
                return view('authentication/register/validateCenter', $dataView);
            } else {
                return redirect()->to(base_url('/viewTickets'));
            }
            //redirect a la pagina que vols si esta autenticat
        }
    }

    public function validateCenter() {
        $instanceProfessor = new ProfessorModel();
        $center = $this->request->getPost('center_r');
        $data = [
            'repair_center_id' => $center,
        ];
        $instanceProfessor->update(session()->getFlashdata('id'),$data);
        return redirect()->to('/viewTickets');
    }

    //register de alumnes 
    public function validateStudents()
    {
        $crud = new KpaCrud();
        $crud->setTable('students');
        $crud->setPrimaryKey('student_id');
        $crud->setColumns(['email']);
        $crud->setColumnsInfo([
            'email' => [
                'name' => 'email',
            ],
        ]);
        $data['output'] = $crud->render();
        return view('authentication/register/validateStudents', $data);
    }

    public function validateStudents_post()
    {
        $validationRules = [
            'mail' => [
                'label'  => 'eMail usuari',
                'rules'  => 'required|valid_email',
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
            ];
            $instanceSt->insert($data);
            return redirect()->to(base_url('validateStudents'));
        } else {
            session()->setFlashdata('error', 'Failed');
            return redirect()->back()->withInput();
        }
    }

    // link -> al fer click cridar funcio per deslogejar
    public function logout()
    {
        $this->logOut_function();
        return redirect()->to(base_url('/ssttView'));
    }

    public function logOut_function()
    {
        $client = new \Google\Client();
        $token = session()->get('acces_token');
        if ($token != null) {
            $client->revokeToken($token);
            // Limpiar los datos de la sesión
            session()->unset_userdata('access_token');
            session()->unset_userdata('sessionData');
            session()->destroy();
        } else {
            session()->destroy();
        }
    }
}
