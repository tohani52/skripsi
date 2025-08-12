<?php

namespace App\Models;

use CodeIgniter\Model;

class ListproductoutModel extends Model
{
    protected $table            = 'list_product_out';
    protected $primaryKey       = 'id';
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'request_code','id_product','qty','stock_before'
    ];
    
    public function get_data_by_request_code($request_code)
    {  		  
      $this->select('list_product_out.*,product.product_name');
      $this->join('product', 'list_product_out.id_product = product.id','LEFT');
      $array = array('list_product_out.request_code' => $request_code);
		  $data = $this->where($array)->findAll();
		  return $data;
    }
    public function get_all_data()
    {  		  
      $this->select('list_product_out.*,product.product_name');
      $this->join('product', 'list_product_out.id_product = product.id','LEFT');
      $data = $this->findAll();
		  return $data;
    }
    public function get_by_id($id)
    {
      $this->select('list_product_out.*,product.product_name');
      $this->join('product', 'list_product_out.id_product = product.id','LEFT');
		  $data = $this->find($id);
		  return $data;
    }
    public function insert_data($data)
    {
      return $this->insert($data);
    } 
    public function update_data($data,$id)
    {
      return $this->update(['id' => $id],$data);
    
    } 
    public function delete_data($id)
    {
      return $this->delete(['id' => $id]);
    } 
}
