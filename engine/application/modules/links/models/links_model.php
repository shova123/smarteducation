<?php
class Links_model extends CI_Model
{
	function __construct(){
			parent::__construct();		
                        if($this->session->userdata('language')== 'french'){
                            $database_name = 'fr';
                        }else{
                            $database_name = 'default';
                        }
                    $this->db = $this->load->database($database_name, TRUE);
			$table_name = 'tbl_video_link';
	}
	
	function totalPages($where=NULL)
	{	
		$sql = "SELECT * FROM `tbl_static_pages_category` AS c LEFT JOIN `tbl_static_pages` AS p ON p.pc_id= c.id";
		//$sql = "SELECT * FROM  `tbl_static_pages` sp, `tbl_static_pages_category` spc WHERE sp.pc_id= spc.id";	
		if($where)
		$sql.= ' WHERE'." ".$where;
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_videos($limit=NULL, $start=NULL, $where=NULL)
	{
		$sql = "SELECT * FROM `tbl_video_link` AS c LEFT JOIN `tbl_static_pages` AS p ON p.pc_id= c.id";
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
        function getAll_links( $table, $fieldName=NULL, $name=NULL, $orderBy=NULL, $select=NULL, $group_by=NULL)
	{ 
		if($select)
		 {
		   $this->db->select($select);
		 }
		
		if($fieldName && $name)
			$this->db->where($fieldName, $name);
		if ($orderBy)
			$this->db->order_by($orderBy);
		
		if($group_by)
		  $this->db->group_by($group_by);
		$query = $this->db->get( $table ); 
		
		return $query->result(); 
	}
        function getById( $table, $fieldId=null, $id=null, $fieldName=null, $name=null, $select='*')
	{ 
		$this->db->select($select);
                if($fieldId && $id){
		$this->db->where($fieldId, $id); 
                }
                if($fieldName && $name){
                $this->db->where($fieldName, $name); 
                }
		$query = $this->db->get( $table ); 
		return $query->row(); 
	}
	function getVideosByWhere( $table, $fieldName, $name, $fieldId, $id)//function getByWhere( $table, $fieldName, $con, $select='*')
	{ 
		//$this->db->select($select);
		//$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' "); 
                $this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' " ."and status  = 'Publish' "); 
                
		$query = $this->db->get( $table ); 
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
        
        function get_pages($table,$filedName,$name)
	{
		$this->db->select('*');
		if($filedName && $name){
                    $this->db->where($filedName,$name);
                }
		$query = $this->db->get($table);
		return $query->result();
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
		$query = $this->db->get('tbl_banners');
		return $query->result();
	}
}
?>