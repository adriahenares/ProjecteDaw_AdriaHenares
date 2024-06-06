<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\UUID;
use App\Models\CenterModel;
//use App\Models\; tabla login
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Models\LoginsModel;
use App\Models\ProfessorModel;
use App\Models\SSTTModel;
use App\Models\StudentModel;

// use Google\Service\Classroom\Student;

$session = \Config\Services::session();  // Config és opcional

// user login aleix@gmail.com 12345 con

class SessionController extends BaseController
{
    //funcionalitat de registre sstt
    public function redirectToLogin()
    {
        return redirect()->to('login');
    }

    public function login_post_Normal()
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
            'pass' => [
                'label' => 'Contrasenya usuari',
                'rules' => 'required',
                'errors' => [
                    'required' => 'La clau és un camp obligatori',
                ],
            ],
        ];

        if ($this->validate($validationRules)) {
            $instance = new LoginsModel();

            $email = (string) $this->request->getPost('mail');
            $password = $this->request->getPost('pass');
            if ($instance->userExists($email)) {
                $user = $instance->getUserByMail($email);
                $role = $instance->getRoleByEmail($email);
                if (password_verify((string) $password, $user['password'])) {
                    //sstt
                    session()->set('mail', $email);
                    session()->set('role', $instance->getRoleByEmail($email));
                    d(session()->get('role'));
                    // session()->set('idSessionUser', 1);
                    $pos = strpos($email, '@');
                    $mailType = substr($email, $pos);
                    if ($mailType != '@gencat.cat') {
                        $studentsModel = new StudentModel();
                        $studentInfo = $studentsModel->obtainStByMail($email);
                        session()->set('id', $studentInfo['student_id']);
                        session()->set('idCenter', $studentInfo['student_center_id']);
                        session()->set('lang', $studentInfo['language']);
                    } else {
                        $ssttModel = new SSTTModel();
                        $ssttInfo = $ssttModel->getSSTTByEmail($email);
                        session()->set('id', $ssttInfo['SSTT_id']);
                        session()->set('lang', $ssttInfo['language']);
                    }
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
        $professorTrue = false;
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
                session()->set('mail', $data['mail']);
                $pos = strpos($data['mail'], '@');
                $mailLast = substr($data['mail'], $pos);
                // dd($mailLast);
                if ($mailLast == '@gmail.com') {
                    $data['nom'] = $userInfo->getGivenName();
                    $data['nomComplet'] = $userInfo->getName();
                    //diverses comrprovacions
                    //verificacio que es o centre o professor
                    // si el email esta a la taula centre es un centre
                    if ($instanceC->verifyCenter($data['mail']) == true) {
                        $center = $instanceC->obtainCenterByEmail($data['mail']);
                        session()->set('role', 'Center');
                        session()->set('idCenter', $center['center_id']);
                        //obtenim el codi del centre
                    } else {
                        session()->set('role', 'Professor');
                        // si no esta el email a centre es un professor i  veriquem si esta el email a la taula professors, si no esta s'afegeix
                        if ($instanceProfessor->verifyProfessor($data['mail']) == false) {
                            $professorTrue = true;
                        } else {
                            $prof = $instanceProfessor->obtainProfessor($data['mail']);
                            session()->set('idCenter', $prof['repair_center_id']);
                        }
                    }

                    //l'usuari es un professor 
                    if ($professorTrue == true) {
                        // creacio de les variables per professor 
                        $pos = strpos($data['nomComplet'], ' ');
                        $surnames = substr($data['nomComplet'], $pos);
                        $uuid = UUID::v4();
                        $dataProf = [
                            'professor_id' => $uuid,
                            'name' => $data['nom'],
                            'surnames' => $surnames,
                            'email' => $data['mail'],
                            'repair_center_id' => null,
                            'language' => 'ca'
                        ];
                        $instanceProfessor->insert($dataProf);
                    }
                } else {
                    $this->logOut_function();
                    session()->setFlashdata('error', 'error, conta no valida');
                    $login_button = '';
                    $login_button = '<a href="' . $client->createAuthUrl() . '" class="btn w-100 position-relative" 
                    style="  border: 2px solid blue; background-color: white;">
                    <img src="' . base_url("images/google.jpg") . '" style=" left: 8px; width: 22px; height: 22px;">
                    LOGIN WITH GOOGLE</a>';
                    $data['login_button'] = $login_button;
                    return view("authentication/login/login", $data);
                }
            }
        }

        if (!session()->get('access_token')) {
            $login_button = '';
            $login_button = '<a href="' . $client->createAuthUrl() . '" class="btn w-100 position-relative" 
            style="  border: 2px solid blue; background-color: white;">
            <img src="' . base_url("images/google.jpg") . '" style=" left: 8px; width: 22px; height: 22px;">
            LOGIN WITH GOOGLE</a>';
            $data['login_button'] = $login_button;
            return view("authentication/login/login", $data);
        } else {
            if ($professorTrue == true) {
                session()->setFlashdata('id', $uuid);
                $dataView['center'] = $instanceC->getAllCentersId();
                return view('authentication/register/validateCenter', $dataView);
            } else {
                return redirect()->to(base_url('/viewTickets'));
            }
        }
    }

    public function validateCenter()
    {
        $validationRules = [
            'center_r' => [
                'label' => 'centre',
                'rules' => 'required',
                'errors' => [
                    'required' => 'Selecciona un centre',
                ],
            ],
        ];

        if ($this->validate($validationRules)) {
            $instanceProfessor = new ProfessorModel();
            $center = $this->request->getPost('center_r');
            session()->set('idCenter', $center);
            $data = [
                'repair_center_id' => $center,
            ];
            $instanceProfessor->update(session()->getFlashdata('id'), $data);
            return redirect()->to('/viewTickets');
        } else {
            session()->setFlashdata('error', 'Selecciona un centre'); //TODO: Traduir
            return redirect()->back()->withInput();
        }
    }

    // link -> al fer click cridar funcio per deslogejar
    public function logout()
    {
        $this->logOut_function();
        return redirect()->to(base_url('/login'));
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

    public function changeLang($lang)
    {

        // $lang = session()->get('lang');
        // dd($lang);

        if (session()->get('role') == 'Student') {
            $model = new StudentModel();
            $model->updateLang($lang);
        } else if (session()->get('role') == 'Center') {
            $model = new CenterModel();
            $model->updateLang($lang);
        } else if (session()->get('role') == 'SSTT') {
            $model = new SSTTModel();
            $model->updateLang($lang);
        } else if (session()->get('role') == 'Professor') {
            $model = new ProfessorModel();
            $model->updateLang($lang);
        }

        session()->set('lang', $lang);
        $this->request->setlocale($lang);
        // d($this->request->getlocale());
        // return redirect()->to('viewTickets');

        return redirect()->to(previous_url());

    }
}
