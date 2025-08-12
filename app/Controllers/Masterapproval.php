<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\MasterapprovalModel;
use CodeIgniter\RESTful\ResourceController;

use App\Controllers\BaseController;

class Masterapproval extends BaseController
{
    protected $session;
	public function __construct(){

		$this->userModel = new UserModel();
		$this->masterapprovalModel = new MasterapprovalModel();
        $this->validation = \Config\Services::validation();
        $this->uri = new \CodeIgniter\HTTP\URI(uri_string());
	}
    public function index()
    {   
		$list_masterapproval = $this->masterapprovalModel->get_all_data();
        $data =[
			'judul_page' => 'Master Approval',
			'list_masterapproval' => $list_masterapproval,
			'sub_judul_page' => 'Table Data',
			'add' => '/add_masterapproval',
			'url_delete' => 'hapus_masterapproval',
            'url' =>'masterapproval'
        ];
		return view('admin_masterapproval',$data);
    }
    public function create()
    {   
        $list_user = $this->userModel->get_all_data();
		$list_masterapproval = $this->masterapprovalModel->get_all_data();
        $data =[
            'validation' => $this->validation,
            'list_user' => $list_user,
			'list_masterapproval' => $list_masterapproval,
			'action' => '/add_action_masterapproval',
			'judul_page' => 'Master Approval',
			'sub_judul_page' => 'Add',
			'back' => '/masterapproval',
			'url_delete' => 'hapus_user',
            'id_user' => old('id_user'),
			'id' => '',
            'url' =>'masterapproval',
        ];
		return view('admin_masterapproval_form',$data);
    }
    public function create_action()
    {   
        $data =[
            'id_user'          => $this->request->getPost('id_user'),
        ];
        $insert = $this->masterapprovalModel->insert_data($data);
        if($insert){	
            return redirect()->to(base_url().'/masterapproval');
        }
    }
	public function delete($id)
	{
		$delete = $this->masterapprovalModel->delete_data($id);
		if($delete){	
			return redirect()->to(base_url().'/masterapproval');
		}

    }
}
