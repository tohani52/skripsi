<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductinModel extends Model
{
    protected $table            = 'product_in';
    protected $primaryKey       = 'id';
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'id_product','qty','description','price'
    ];
    
    public function get_all_data()
    {  		  
      $this->select('product_in.*,product.product_name,product.stock_product,product.unit_product');
      $this->join('product', 'product_in.id_product = product.id','LEFT');
      $data = $this->findAll();
		  return $data;
    }
    public function get_by_id($id)
    {
      $this->select('product_in.*,product.product_name,product.stock_product,product.unit_product');
      $this->join('product', 'product_in.id_product = product.id','LEFT');
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
