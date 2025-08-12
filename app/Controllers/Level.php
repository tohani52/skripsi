<?php

namespace App\Controllers;
use App\Models\LevelModel;
use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

use App\Controllers\BaseController;

class Level extends BaseController
{
    protected $session;
	public function __construct(){

		$this->levelModel = new LevelModel();
		$this->userModel = new UserModel();
        $this->validation = \Config\Services::validation();
        $this->uri = new \CodeIgniter\HTTP\URI(uri_string());
        
	}
    public function index()
    {   
		$list_level = $this->levelModel->get_all_data();
        $data =[
			'judul_page' => 'Level User',
			'list_level' => $list_level,
			'sub_judul_page' => 'Table Data',
			'add' => '/add_level',
			'update' => '/update_level',
			'url_delete' => 'hapus_level',
            'url' =>'level'
        ];
		return view('admin_level',$data);
    }
    public function create()
    {       
        $data =[
            'validation' => $this->validation,
			'action' => '/add_action_level',
			'judul_page' => 'Level User',
			'sub_judul_page' => 'Add',
			'back' => '/level',
			'url_delete' => 'hapus_level',
            'field_level_name' => old('field_level_name'),
			'id' => '',
			'id_user' => '',
			'ishow' => 0,
            'url' =>'level',
        ];
		return view('admin_level_form',$data);
    }
    public function create_action()
    {   
        $is_uniqe = 'is_unique[level_user.level_name]';
        if(!$this->validate($this->rules($is_uniqe))) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        $data =[
            'level_name'          => $this->request->getPost('field_level_name'),
        ];
        $insert = $this->levelModel->insert_data($data);
        if($insert){	
            return redirect()->to(base_url().'/level');
        }
    }
    public function update($id)
    {   
        $row = $this->levelModel->get_by_id($id);
        $data =[
            'validation' => $this->validation,
			'action' => '/update_action_level',
			'judul_page' => 'Level User',
			'sub_judul_page' => 'Update',
			'back' => '/level',
			'url_delete' => 'hapus_level',
			'id' => $id,
            'field_level_name' => $row['level_name'],
			'ishow' => 1,
            'url' =>'level',
        ];
		return view('admin_level_form',$data);
    }
    public function update_action()
    {           
        $id = $this->request->getPost('id');
        $row = $this->levelModel->get_by_id($id);
        if($this->request->getPost('field_level_name') == $row['level_name']){
            $is_uniqe = '';
        }else{
            $validasi = $this->levelModel->is_exist($this->request->getPost('field_level_name'));
            if(!empty($validasi)){
                $is_uniqe = 'is_unique[level_user.level_name]';
            }else{
                $is_uniqe = '';
    
            }

        }
        if(!$this->validate($this->rules($is_uniqe))) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

       
        $data =[
            'level_name'          => $this->request->getPost('field_level_name'),
        ];
        
        $update = $this->levelModel->update_data($data,$id);
       
        if($update){	
            return redirect()->to(base_url().'/level');
        }
    }
    
	public function delete($id)
	{
      
		$delete = $this->levelModel->delete_data($id);
		if($delete){	
			return redirect()->to(base_url().'/level');
		}

    }
    public function rules($is_uniqe)
    {
        $rules= [
            'field_level_name' => [
               'rules' => 'required|'.$is_uniqe,
               'errors' => [
                'required' => 'Level User is reqiured !!',
                'is_unique' => 'Level User sudah terdaftar !!',
               ]
            ],
        ];
        
        return $rules;
    }
}
