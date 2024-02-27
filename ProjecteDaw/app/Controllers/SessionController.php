<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfessorModel;

class SessionController extends BaseController
{
    //login
    public function login()
    {
        helper('form');
        return view("authentication/login/login");
    }

    // funcio que s'executa al intentar fer loggin
    public function login_post()
    {
        // validacions complexes
    }

    // link -> al fer click cridar funcio per deslogejar
    public function logout()
    {
        session()->destroy();
        return redirect()->to(base_url('"authentication/login"'));
    }

    // funcionalitat de registre
    public function register()
    {
        helper('form');
        return view("authentication/register/register");
    }


    public function register_post()
    {
    }


    //funcio 2fa
    // al fer login


    //funcio que es carregara al voler autenticarnos amb 2fa amb la view i codiqr

}
