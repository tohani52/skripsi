<?php

namespace App\Controllers;
use App\Models\ProductModel;
use CodeIgniter\RESTful\ResourceController;

use App\Controllers\BaseController;
use Dompdf\Dompdf;

class Product extends BaseController
{
    protected $session;
	public function __construct(){
		$this->productModel = new ProductModel();
        $this->validation = \Config\Services::validation();
        $this->uri = new \CodeIgniter\HTTP\URI(uri_string());
        
	}
    public function index()
    {   
		$list_product = $this->productModel->get_all_data();
        $data =[
			'judul_page' => 'Data ATK',
			'list_product' => $list_product,
			'sub_judul_page' => 'Table Data',
			'add' => '/add_product',
			'update' => '/update_product',
			'url_delete' => 'hapus_product',
            'url' =>'product'
        ];
		return view('admin_product',$data);
    }
    public function create()
    {       
        $data =[
            'validation' => $this->validation,
			'action' => '/add_action_product',
			'judul_page' => 'Data ATK',
			'sub_judul_page' => 'Add',
			'back' => '/product',
			'url_delete' => 'hapus_product',
            'product_name' => old('product_name'),
            'stock_product' => old('stock_product'),
            'product_price' => old('product_price'),
            'unit_product' => old('unit_product'),
			'id' => '',
			'id_user' => '',
            'url' =>'product',
        ];
		return view('admin_product_form',$data);
    }
    public function create_action()
    {   
        $is_uniqe = 'is_unique[product.product_name]';
        if(!$this->validate($this->rules($is_uniqe))) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }

        $data =[
            'product_name'          => $this->request->getPost('product_name'),
            'unit_product'          => $this->request->getPost('unit_product'),
            'product_price'         => str_replace(".","",str_replace(",","",$this->request->getPost('product_price'))),
        ];
        $insert = $this->productModel->insert_data($data);
        if($insert){	
            return redirect()->to(base_url().'/product');
        }
    }
    public function update($id)
    {   
        $row = $this->productModel->get_by_id($id);
        $data =[
            'validation' => $this->validation,
			'action' => '/update_action_product',
			'judul_page' => 'Data ATK',
			'sub_judul_page' => 'Update',
			'back' => '/product',
			'url_delete' => 'hapus_product',
			'id' => $id,
            'product_name' => $row['product_name'],
			'product_price' => $row['product_price'],
			'stock_product' => $row['stock_product'],
			'unit_product' => $row['unit_product'],
            'url' =>'product',
        ];
		return view('admin_product_form',$data);
    }
    public function update_action()
    {           
        $id = $this->request->getPost('id');
        $row = $this->productModel->get_by_id($id);
        if($this->request->getPost('product_name') == $row['product_name']){
            $is_uniqe = '';
        }else{
            $validasi = $this->productModel->is_exist($this->request->getPost('product_name'));
            if(!empty($validasi)){
                $is_uniqe = 'is_unique[product.product_name]';
            }else{
                $is_uniqe = '';
    
            }

        }
        if(!$this->validate($this->rules($is_uniqe))) {
            return redirect()->back()->withInput()->with('validation', $this->validation);
        }
        $data =[
            'product_name'          => $this->request->getPost('product_name'),
            'unit_product'          => $this->request->getPost('unit_product'),
            'product_price'         => str_replace(".","",str_replace(",","",$this->request->getPost('product_price'))),
        ];
        $update = $this->productModel->update_data($data,$id);
       
        if($update){	
            return redirect()->to(base_url().'/product');
        }
    }
    
	public function delete($id)
	{
      
		$delete = $this->productModel->delete_data($id);
		if($delete){	
			return redirect()->to(base_url().'/product');
		}

    }
    public function rules($is_uniqe)
    {
        $rules= [
            'product_name' => [
               'rules' => 'required|'.$is_uniqe,
               'errors' => [
                'required' => 'ATK is reqiured !!',
                'is_unique' => 'ATK sudah terdaftar !!',
               ]
            ],
            'unit_product' => [
               'rules' => 'required',
               'errors' => [
                'required' => 'Satuan ATK is reqiured !!',
               ]
            ],
        ];
        
        return $rules;
    }
    
    public function laporan(){
        
		$list_product = $this->productModel->get_all_data();
        $logo = base64_encode(file_get_contents('assets-admin/img/logo_pudc.png'));
        
        $data =[
			'judul_page' => 'Laporan Stok ATK',
            'logo' =>$logo,
            'list_product' =>$list_product,
        ];
        $filename = 'Laporan Stok ATK ';

        // instantiate and use the dompdf class
        $dompdf = new Dompdf();

        // load HTML content
        $dompdf->loadHtml(view('laporan_product',$data));

        // (optional) setup the paper size and orientation
        $dompdf->setPaper('A4', 'potrait');

        // render html as PDF
        $dompdf->render();

        // output the generated pdf
        $dompdf->stream($filename, array("Attachment" => false));  
        exit();
    
    
    }
}
