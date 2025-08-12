<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\LevelModel;
use CodeIgniter\RESTful\ResourceController;

use App\Controllers\BaseController;

class User extends BaseController
{
    protected $session;
    public function __construct()
    {

        $this->userModel = new UserModel();
        $this->levelModel = new LevelModel();
        $this->validation = \Config\Services::validation();
        $this->uri = new \CodeIgniter\HTTP\URI(uri_string());
    }
    public function index()
    {
        $list_user = $this->userModel->get_all_data();
        $data = [
            'judul_page' => 'User',
            'list_user' => $list_user,
            'sub_judul_page' => 'Table Data',
            'add' => '/add_user',
            'update' => '/update_user',
            'url_delete' => 'hapus_user',
            'url' => 'user'
        ];
        return view('admin_user', $data);
    }
    public function create()
    {
        $list_level = $this->levelModel->get_all_data();
        $data = [
            'validation' => $this->validation,
            'list_level' => $list_level,
            'action' => '/add_action_user',
            'judul_page' => 'User',
            'sub_judul_page' => 'Add',
            'back' => '/user',
            'url_delete' => 'hapus_user',
            'display_name' => old('display_name'),
            'user_name' => old('user_name'),
            'password' => old('password'),
            'id_level' => old('id_level'),
            'id' => '',
            'url' => 'user',
        ];
        return view('admin_user_form', $data);
    }
    public function create_action()
    {
        $is_uniqe = 'is_unique[user.user_name]';
        if (!$this->validate($this->rules($is_uniqe))) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        $data = [
            'id_level'          => $this->request->getPost('id_level'),
            'user_name'          => $this->request->getPost('user_name'),
            'password'             => hash('sha512', $this->request->getPost('password')),
            'display_name'         => ($this->request->getPost('display_name'))
        ];
        $insert = $this->userModel->insert_data($data);
        if ($insert) {
            return redirect()->to(base_url() . '/user');
        }
    }
    public function update($id)
    {
        $row = $this->userModel->get_by_id($id);
        $list_level = $this->levelModel->get_all_data();
        $data = [
            'validation' => $this->validation,
            'list_level' => $list_level,
            'action' => '/update_action_user',
            'judul_page' => 'User',
            'sub_judul_page' => 'Update',
            'back' => '/user',
            'url_delete' => 'hapus_user',
            'id' => $id,
            'display_name' => $row['display_name'],
            'user_name' => $row['user_name'],
            'password' => $row['password'],
            'id_level' => $row['id_level'],
            'url' => 'user',
        ];
        return view('admin_user_form', $data);
    }
    public function update_action()
    {
        $id = $this->request->getPost('id');
        $row = $this->userModel->get_by_id($id);
        if ($this->request->getPost('user_name') == $row['user_name']) {
            $is_uniqe = '';
        } else {
            $validasi = $this->userModel->is_exist($this->request->getPost('user_name'));
            if (!empty($validasi)) {
                $is_uniqe = 'is_unique[user.user_name]';
            } else {
                $is_uniqe = '';
            }
        }
        if (!$this->validate($this->rules($is_uniqe))) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        if ($row['password'] == $this->request->getPost('password')) {
            $data = [
                'id_level'          => $this->request->getPost('id_level'),
                'user_name'          => $this->request->getPost('user_name'),
                'display_name'         => ($this->request->getPost('display_name'))
            ];
        } else {
            $data = [
                'id_level'          => $this->request->getPost('id_level'),
                'user_name'          => $this->request->getPost('user_name'),
                'password'             => hash('sha512', $this->request->getPost('password')),
                'display_name'         => ($this->request->getPost('display_name'))
            ];
        }

        $update = $this->userModel->update_data($data, $id);
        if ($update) {
            return redirect()->to(base_url() . '/user');
        }
    }

    public function delete($id)
    {
        $delete = $this->userModel->delete_data($id);
        if ($delete) {
            return redirect()->to(base_url() . '/user');
        }
    }
    public function profile()
    {
        $id = $this->session->get("id_user");
        $row = $this->userModel->get_by_id($id);
        $list_level = $this->levelModel->get_all_data();
        $data = [
            'validation' => $this->validation,
            'list_level' => $list_level,
            'action' => '/change_profile',
            'action2' => '/change_password',
            'judul_page' => 'User',
            'sub_judul_page' => 'Update',
            'back' => '/profileuser',
            'url_delete' => 'hapus_user',
            'id' => $id,
            'photo_profile' => $row['photo_profile'],
            'photo_ttd' => $row['photo_ttd'],
            'display_name' => $row['display_name'],
            'user_name' => $row['user_name'],
            'password' => $row['password'],
            'id_level' => $row['id_level'],
            'url' => 'profileuser',
        ];
        return view('admin_profile_user', $data);
    }
    public function change_profile()
    {
        $id = $this->session->get("id_user");

        $validation = $this->validate([
            'file_upload' => 'uploaded[file_upload]|mime_in[file_upload,image/jpg,image/jpeg,image/gif,image/png]|max_size[file_upload,4096]'
        ]);


        $data = [
            'user_name'          => $this->request->getPost('user_name'),
            'display_name'         => ($this->request->getPost('display_name'))
        ];
        if ($this->request->getFile('file_upload')->getSize() > 0) {
            if ($validation) {
                $upload = $this->request->getFile('file_upload');
                $photoProfile = "profile" . str_replace(" ", "", $this->request->getPost('display_name'));
                $file_delete =  WRITEPATH . '../public/assets-admin/img/profile/' . $photoProfile;
                if (file_exists($file_delete)) {
                    unlink($file_delete);
                }
                $upload->move(WRITEPATH . '../public/assets-admin/img/profile/', $photoProfile);

                $photoProfileArray = [
                    'photo_profile'       => $photoProfile
                ];
                $data = array_merge($data, $photoProfileArray);
                $this->session->set('photo_profile', $photoProfile);
            }
        }

        $update = $this->userModel->update_data($data, $id);
        $this->session->set('display_name', ($this->request->getPost('display_name')));
        if ($update) {
            return redirect()->to(base_url() . '/profileuser');
        }
    }
    public function change_password()
    {
        $id = $this->session->get("id_user");
        $row = $this->userModel->get_by_id($id);
        if ($row['password'] == hash('sha512', $this->request->getPost('currentPassword'))) {

            $data = [
                'password'             => hash('sha512', $this->request->getPost('newPassword')),
            ];
            $update = $this->userModel->update_data($data, $id);

            header('Content-Type: application/json');
            echo json_encode(1);
        } else {

            header('Content-Type: application/json');
            echo json_encode('failed');
        }
    }
    public function upload_ttd()
    {
        $id = $this->session->get("id_user");
        $row = $this->userModel->get_by_id($id);
        $signature = $this->request->getPost('signature');

        if ($signature) {
            // Bersihkan format base64
            $signature = str_replace('data:image/png;base64,', '', $signature);
            $signature = str_replace(' ', '+', $signature);
            $imageData = base64_decode($signature);

            // Path folder publik
            $uploadDir = FCPATH . 'public/assets-admin/img/ttd/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Simpan file
            $filename = 'signature_' . time() . '.png';
            $filePath = $uploadDir . $filename;
            file_put_contents($filePath, $imageData);

            // Tampilkan hasil
            $imageUrl = base_url('assets-admin/img/ttd/' . $filename);

            $this->session->set('photo_ttd', $filename);

            $data = [
                'photo_ttd'             => $filename,
            ];
            $update = $this->userModel->update_data($data, $id);
        }

        return redirect()->to(base_url() . '/profileuser');
    }

    public function rules($is_uniqe)
    {
        $rules = [
            'user_name' => [
                'rules' => 'required|' . $is_uniqe,
                'errors' => [
                    'required' => 'User Name is reqiured !!',
                    'is_unique' => 'User Name sudah terdaftar !!',
                ]
            ],
            'display_name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Display Name is reqiured !!',
                ]
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Password is reqiured !!',
                ]
            ],
            'repassword' => [
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Input ulang Password is reqiured !!',
                    'matches' => 'Pasword tidak sama !!',
                ]
            ]
        ];

        return $rules;
    }
}