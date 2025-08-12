<?php

namespace App\Controllers;
use App\Models\ProductModel;
use App\Models\ListproductoutModel;
use CodeIgniter\RESTful\ResourceController;

use App\Controllers\BaseController;

class Listproductout extends BaseController
{
    protected $session;
	public function __construct(){
		$this->productModel = new ProductModel();
		$this->listproductoutModel = new ListproductoutModel();
        $this->validation = \Config\Services::validation();
        $this->uri = new \CodeIgniter\HTTP\URI(uri_string());
        
	}
    public function create($request_code)
    {       
		$list_product = $this->productModel->get_all_data();
        $data =[
            'validation' => $this->validation,
            'list_product' => $list_product,
			'action' => '/add_action_listproductout',
			'judul_page' => 'Pembelian ATK',
			'sub_judul_page' => 'Add',
			'back' => '/listproductout',
			'url_delete' => 'hapus_listproductout',
            'id_product' => old('id_product'),
            'qty' => 1,
            'request_code' => $request_code,
			'id' => '',
			'id_user' => '',
            'url' =>'listproductout',
        ];
		return view('admin_listproductout_form',$data);
    }
    public function create_action()
    {   
        
        $row = $this->productModel->get_by_id($this->request->getPost('id_product'));
        $data =[
            'id_product'            => $this->request->getPost('id_product'),
            'request_code'          => $this->request->getPost('request_code'),
            'stock_before'          => $row['stock_product'],
            'qty'                   => str_replace(".","",str_replace(",","",$this->request->getPost('qty'))),
        ];
        $insert = $this->listproductoutModel->insert_data($data);
        
        if($insert){	
            return redirect()->to(base_url().'/add_productout/'.$this->request->getPost('request_code'));
        }
    }
    public function update($id)
    {   
        $row = $this->listproductoutModel->get_by_id($id);
		$list_product = $this->productModel->get_all_data();
        $data =[
            'validation' => $this->validation,
            'list_product' => $list_product,
			'action' => '/update_action_listproductout',
			'judul_page' => 'Pembelian ATK',
			'sub_judul_page' => 'Update',
			'back' => '/listproductout',
			'url_delete' => 'hapus_listproductout',
			'id' => $id,
            'id_product' => $row['id_product'],
			'request_code' => $row['request_code'],
			'qty' => $row['qty'],
            'url' =>'listproductout',
        ];
		return view('admin_listproductout_form',$data);
    }
    public function update_action()
    {           
        $id = $this->request->getPost('id');
        
        $row = $this->productModel->get_by_id($this->request->getPost('id_product'));
        $data =[
            'id_product'            => $this->request->getPost('id_product'),
            'request_code'          => $this->request->getPost('request_code'),
            'stock_before'          => $row['stock_product'],
            'qty'                   => str_replace(".","",str_replace(",","",$this->request->getPost('qty'))),
        ];
        
        $update = $this->listproductoutModel->update_data($data,$id);
        
        if($update){	
            return redirect()->to(base_url().'/add_productout/'.$this->request->getPost('request_code'));
        }
    }
    
	public function delete($id)
	{
        $row = $this->listproductoutModel->get_by_id($id);
		$delete = $this->listproductoutModel->delete_data($id);
		if($delete){	
            return redirect()->to(base_url().'/add_productout/'.$row['request_code']);
		}

    }
}
