<?php
namespace App\Models;

use CodeIgniter\Model;

class Commonmodel extends Model{
    // Insert method;
    public function InserData($table,$data){
        $builder = $this->db->table($table);
        $builder->insert($data);
         return true;
    }
    // Get all data record :
    public function GetAllData($table,$where=array(),$orderByColumn ='id',$orderByDirection='ASC',$limit=null,$select='*'){
        $builder = $this->db->table($table);
        $builder->where($where);
        $builder->orderBy($orderByColumn,$orderByDirection);
        $builder->limit($limit);
        $builder->select($select);
        $result = $builder->get();
        return $result->getResult();
    }
    // Get singledata record;
    public function GetSingleData($table,$where = array()){
        $builder = $this->db->table($table);
        $builder->where($where);
        $result = $builder->get();
        return $result->getRow();
    }
    //Update SingleData;
    public function UpdateSingleData($table,$where = array(),$data){
        $builder = $this->db->table($table);
        $builder->where($where);
        $builder->update($data);
        return true;
    }
    // Delete Data;
    public function DeleteData($table,$where=array()){
        $builder = $this->db->table($table);
        $builder->where($where);
        return true;
    }

}
?>