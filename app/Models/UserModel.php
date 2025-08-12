<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'id';
    
    protected $useSoftDeletes = true;
    protected $useTimestamps = true;
    
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $allowedFields = [
        'display_name', 'user_name', 'password','id_level','photo_profile','is_login','photo_ttd'
    ];
    
    public function check_login($var1,$var2)
    {
      $this->select('user.*, level_user.level_name');
      $this->join('level_user', 'level_user.id = user.id_level','LEFT');
      $array = array('user.user_name' => $var1,'user.password' => $var2);
		  $data = $this->where($array)->find();
		  return $data;
    }
    
    public function set_login($data,$id)
    {
      return $this->update(['id' => $id],$data);
  
    } 
    public function get_all_data()
    {  
      $this->select('user.*,level_user.level_name');
      $this->join('level_user', 'user.id_level = level_user.id','LEFT');
		  $data = $this->findAll();
		  return $data;
    }
    
    public function is_exist($var1)
    {
      $array = array('user_name' => $var1);
		  $data = $this->where($array)->findAll();
		  return $data;
    }
    public function get_by_id($id)
    {
      $this->select('user.*,level_user.level_name');
      $this->join('level_user', 'user.id_level = level_user.id','LEFT');
		  $data = $this->find($id);
		  return $data;
    }
    public function insert_data($data)
    {
      return $this->insert($data);
    } 
    
    public function insert_data2($data)
    {
       $this->insert($data);
       return $this->insertID();
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
