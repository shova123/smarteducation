<?php
class Pages_model extends CI_Model
{
	function __construct(){
			parent::__construct();			
			$table_name = 'ark_static_pages';
	}
	
	function totalPages($where=NULL)
	{	
		$sql = "SELECT * FROM ark_static_pages";
		//$sql = "SELECT * FROM  `ark_static_pages` sp, `ark_static_pages_category` spc WHERE sp.pc_id= spc.id";	
		if($where)
		$sql.= ' WHERE'." ".$where;
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_pages($limit=NULL, $start=NULL, $where=NULL)
	{
		$sql = "SELECT * FROM ark_static_pages";
		if($where)
		$sql.= ' where'." ".$where;
		if($limit)
		$sql.= ' limit'." ".$limit;
		if($start)
		$sql.=",".$start;
		//echo $query=$this->db->last_query(); exit;
		//$this->db->limit($limit, $start);
		$query=$this->db->query($sql);
		
		
		return $query->result();
	}
	
        function get_Allpage($table,$filedName=null,$name=null,$filedName1=null,$name1=null)
	{
		$this->db->select('*');
                if($filedName && $name){
                    $this->db->where($filedName, $name);
                }
                if($filedName1 && $name1){
                    $this->db->where($filedName1, $name1);
                }
		$query = $this->db->get($table);
		return $query->result();
	}
        
	function get_page_by_id($page_id)
	{
		$this->db->select('*');
		$this->db->where('page_id', $page_id);
		$query = $this->db->get($this->table_name);
		return $query->row();
	}
	
	function get_page($page_slug)
	{
		$this->db->select('*');
		$this->db->where('page_status','Enabled');
		$this->db->where('page_slug', $page_slug);
		$query = $this->db->get($this->table_name);
		return $query->row();
	}
	
	function story($id,$table)
	{
		$this->db->select('*');
		$this->db->where('id', $id);
		$query = $this->db->get($table);
		return $query->row();
	}
	
	function get_banner()
	{
		$this->db->select('*');
		$this->db->where('banner_status','Published');
		$this->db->order_by('banner_id','asc');
		$query = $this->db->get('ark_banners');
		return $query->result();
	}
        function get_category($table, $fieldName=null, $name=null,$fieldName1=null, $name1=null,$orderBy=null)
	{
		$this->db->select('*');
		if($fieldName && $name){
                    $this->db->where($fieldName, $name);
                }
                if($fieldName1 && $name1){
                    $this->db->where($fieldName1, $name1);
                }
                if ($orderBy){
			$this->db->order_by($orderBy,'ASC');
                }
		$query = $this->db->get($table);
		return $query->result();
	}
}
?>