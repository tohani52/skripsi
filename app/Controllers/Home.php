<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;
use App\Controllers\BaseController;

class Home extends BaseController
{

    protected $session;
    public function __construct()
    {

        $this->UserModel = new UserModel();
        $this->session = \Config\Services::session();
        $this->validation = \Config\Services::validation();
        $this->session->start();
    }

    public function index()
    {

        $data = [];
        return view('admin_login', $data);
    }

    public function login()
    {
        $cek_login = $this->UserModel->check_login($this->request->getPost('user_name'), hash('sha512', $this->request->getPost('password')));

        if (!empty($cek_login)) {
            $data = [
                'is_login'         => 1,
            ];
            $update = $this->UserModel->set_login($data, $cek_login[0]['id']);
            if ($update) {
                $data =  [
                    'display_name' => $cek_login[0]['display_name'],
                    'user_name' => $cek_login[0]['user_name'],
                    'isLogin' => $cek_login[0]['is_login'],
                    'level_name' => $cek_login[0]['level_name'],
                    'id_level' => $cek_login[0]['id_level'],
                    'id_user' => $cek_login[0]['id'],
                    'photo_profile' => $cek_login[0]['photo_profile'],

                ];
                $this->session->set($data);

                if ($cek_login[0]['id_level'] == 1) {
                    return redirect()->to(base_url() . '/user');
                } else  if ($cek_login[0]['id_level'] == 4) {
                    return redirect()->to(base_url() . '/product');
                } else {
                    return redirect()->to(base_url() . '/productout_app');
                }
            } else {

                return redirect()->to(base_url() . '/');
            }
        } else {
            return redirect()->to(base_url() . '/');
        }
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to(base_url());
    }
}