<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductoutModel extends Model
{
    protected $table            = 'product_out';
    protected $primaryKey       = 'id';
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'request_code','request_date','id_request','approval','proccess','description'
    ];
    
    public function get_data_by_request_code($request_code)
    {  		  
      $this->select('product_out.*,user.display_name');
      $this->join('user', 'product_out.id_request = user.id','LEFT');
      $array = array('product_out.request_code' => $request_code);
		  $data = $this->where($array)->find();
		  return $data;
    }
    public function get_all_data()
    {  		  
      $this->select('product_out.*,user.display_name');
      $this->join('user', 'product_out.id_request = user.id','LEFT');
      $data = $this->findAll();
		  return $data;
    }
    public function get_by_id($id)
    {
      $this->select('product_out.*,user.display_name');
      $this->join('user', 'product_out.id_request = user.id','LEFT');
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
