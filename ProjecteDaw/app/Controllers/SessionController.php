<?php

namespace App\Controllers;

use App\Controllers\BaseController;
//use App\Models\; tabla login
use App\Libraries\UUID;

$session = \Config\Services::session();  // Config és opcional

// user login aleix@gmail.com 12345 con

class SessionController extends BaseController
{
    //funcionalitat de registre sstt
    public function loginNormal()
    {
        helper('form');
        return view("authentication/register/register");
    }



    public function login_post_Normal()
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

            if ($this->request->getPost('password') == $this->request->getPost('passConfirm')) {
            } else {
                session()->setFlashdata('error', 'els camps email, nom, pass son obligatoris emplena');
                return redirect()->back()->withInput();
            }
        } else {
            // canviar la flash por la referencia
            session()->setFlashdata('error', 'els camps email, nom, pass son obligatoris emplena');
            return redirect()->back()->withInput();
        }
    }

    //login
    public function google_login()
    {
         {
            $client = new \Google\Client();
            //$client->setAuthConfig('/path/to/client_credentials.json');

            $client->setClientId('216671585995-4knv971ddku8t6uqlleariq04qs2n27c.apps.googleusercontent.com'); //Define your ClientID
            $client->setClientSecret('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'); //Define your Client Secret Key

            $client->setRedirectUri('http://localhost:80/viewTickets'); //Define your Redirect Uri

            //$client->addScope(\Google\Service\Drive::DRIVE_METADATA_READONLY);
            $client->addScope(\Google\Service\Oauth2::USERINFO_EMAIL);
            $client->addScope(\Google\Service\Oauth2::USERINFO_PROFILE);
            $client->addScope(\Google\Service\Oauth2::OPENID);
            //$client->addScope('profile');
            $client->setAccessType('offline');

            //$data['titol'] = "GSuite login";
            $client->addScope('email');
            if (isset($_GET["code"])) {
                var_dump(isset($_GET["code"]));
                die;
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

                if (!isset($token["error"])) {
                    $client->setAccessToken($token['access_token']);

                    session()->set('access_token', $token['access_token']);

                    $oauth2 = new \Google\Service\Oauth2($client);

                    $userInfo = $oauth2->userinfo->get();

                    // echo "getMail: " . $userInfo->getEmail(); // adreça xtec
                    // echo "<br>";
                    // echo "getGivenName: " . $userInfo->getGivenName(); // nom
                    // echo "<br>";
                    // echo "getFamilyName: " . $userInfo->getFamilyName(); //cognoms
                    // echo "<br>";
                    // echo "getName: " . $userInfo->getName(); //nom complet
                    // echo "<br>";
                    // echo "<img src='". $userInfo->getPicture()."'>";
                    // dd($userInfo);
                    $data['mail'] = $userInfo->getEmail();
                    $data['nom'] = $userInfo->getGivenName();
                    $data['cognoms'] = $userInfo->getFamilyName();
                    $data['nomComplet'] = $userInfo->getName();
                    $data['usrFoto'] = $userInfo->getPicture();
                    session()->set('user_data', $data);
                }
            }
            $login_button = '';

            if (!session()->get('access_token')) {
                $login_button = '<a href="' . $client->createAuthUrl() . '">LOGIN WITH GOOGLE</a>';
                $data['login_button'] = $login_button;
                return view('authentication/login/login', $data);
            } else {
                //redirect a la pagina que vols si esta autenticat
                return view('Project/Tickets/viewTickets', $data);
            }
        }
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

    //register de alumnes 
    
}
