<?php
defined('BASEPATH') or exit('No direct script access allowed');
class General_model extends CI_Model
{ 
    	function __construct()
	{ 
		parent::__construct();
//                    if($this->session->userdata('language')== 'french'){
//                        $database_name = 'fr';
//                    }else{
//                        $database_name = 'default';
//                    }
//                $this->db = $this->load->database($database_name, TRUE); 
	}
	  
	function insert( $table, $array)
	{ 	
		$this->db->set( $array );
		$this->db->insert($table);		
		return $this->db->insert_id(); 
	}
	
	function update( $table, $array ,$where)
	{ 
		$this->db->where($where);
		return  $this->db->update($table, $array);
	}
	
	function delete($table,$where)
	{
	  $this->db->where($where);
	  $this->db->delete($table);
	}

	function getById( $table, $fieldId, $id, $select='*')
	{ 
		$this->db->select($select);
		$this->db->where( $fieldId ." = '". $id ."'" ); 
		$query = $this->db->get( $table ); 
		return $query->row(); 
	}

	function getAll( $table, $orderBy=NULL, $where=NULL, $select=NULL, $group_by=NULL)
	{ 
		if($select)
		 {
		   $this->db->select($select);
		 }
		
		if($where)
			$this->db->where($where);
		if ($orderBy)
			$this->db->order_by($orderBy);
		
		if($group_by)
		  $this->db->group_by($group_by);
		$query = $this->db->get( $table ); 
		
		return $query->result(); 
	}
	function getByWhere( $table, $fieldName, $name, $fieldId, $id)//function getByWhere( $table, $fieldName, $con, $select='*')
	{ 
		//$this->db->select($select);
		//$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' "); 
                $this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' " ."and status  = 'Publish' "); 
                
		$query = $this->db->get( $table ); 
		return $query->result(); 
	}
	function getAll_array( $table, $orderBy=NULL, $where=NULL, $select=NULL, $group_by=NULL)
	{ 
		if($select)
		 {
		   $this->db->select($select);
		 }
		
		if($where)
			$this->db->where($where);
		if ($orderBy)
			$this->db->order_by($orderBy);
		
		if($group_by)
		  $this->db->group_by($group_by);
		$query = $this->db->get( $table ); 
		
		return $query->result_array(); 
	}    
	 
	function get_with_limit( $table , $limit, $start ,$orderBy = NULL,$search=NULL) 
	{
		if($search)
		 $this->db->where($search);
		if ($orderBy)
		 $this->db->order_by($orderBy);
		$query = $this->db->get( $table, $limit, $start );
		//print_r($this->db->last_query());
		return $query->result();
		
	}
	
	function countTotal($table, $where=NULL)
	{		
		if($where)
			$this->db->where($where);
		$this->db->from($table);
		return $this->db->count_all_results();
	}
	
	function get_parentName($table, $where=NULL)
	{		
		if($where)
			$this->db->where($where);
		$parentName = $this->db->get($table)->row()->gallery_name;
		//print_r($this->db->last_query()); exit;
		return $parentName;
	}
	
	function getLast($table)
	{
		$query = $this->db->get($table);
		return $query->row();
	}

	function get_attribute($table,$attribute,$where) 
	{ 
		$this->db->select($attribute);
		$this->db->where($where);
		$query = $this->db->get( $table ); 
		if ($query->num_rows() == 1 ) 
			return $query->row(); 
		else if ($query->num_rows() > 1 ) 
			return $query->result(); 
	}
	
	function value_exist($table, $field, $value)
	{
		$this->db->where(''.$field.'', $value);
		$this->db->from($table);
		if($this->db->count_all_results() > 0)
			return true;
		else
			return false;
	}
	
	function runQuery($sql) {
		$this->db->query($sql);
	}
	
} 
 
?>