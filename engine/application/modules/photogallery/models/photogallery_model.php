<?php
class Photogallery_model extends CI_Model
{
	function __construct(){
			parent::__construct();			
			$table_name = 'tbl_gallery';
                        if($this->session->userdata('language')== 'french'){
                            $database_name = 'fr';
                        }else{
                            $database_name = 'default';
                        }
                    $this->db = $this->load->database($database_name, TRUE);
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
	
	function get_pages($limit=NULL, $start=NULL, $where=NULL)
	{
		$sql = "SELECT * FROM `tbl_static_pages_category` AS c LEFT JOIN `tbl_static_pages` AS p ON p.pc_id= c.id";
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
	
	function gen_order($gid)
	{
		$this->db->order_by('id','DESC');
		$query = $this->db->get_where('tbl_gallery_images',array('gid'=>$gid),1);
		//echo $this->db->last_query();
		$get_order = $query->row();
		if($query->num_rows()==0)$in_order=0; else $in_order = $get_order->order;
		if(isset($in_order)==0) $order=1;else $order=$in_order+1;
		return $order;
	}
	
	function get_banner()
	{
		$this->db->select('*');
		$this->db->where('banner_status','Published');
		$this->db->order_by('banner_id','asc');
		$query = $this->db->get('tbl_banners');
		return $query->result();
	}
        
        
        
        
        
        
        /*=========================FOR FRONT DESIGN================================*/
        
        function get_img_by_id($table, $fieldId, $id)
	{
		$this->db->select('*');
		$this->db->where($fieldId,$id);
		$this->db->order_by('order','asc');
		$query = $this->db->get( $table ); 
		return $query->result(); 
	}
        
        function get_gallery_by_id($table, $fieldId, $id)
	{
		$this->db->select('*');
		$this->db->where($fieldId,$id);
		//$this->db->order_by('order','asc');
		$query = $this->db->get( $table ); 
		return $query->row(); 
	}
        
        
        function get_gallery($table, $fieldName=null, $name=null ,$fieldName1=null, $name1=null, $orderBy=null, $limit=null, $start=null)
	{
            if($fieldName && $name){
                $this->db->where( $fieldName, $name);
            }    
            if($fieldName1 && $name1){
                $this->db->where( $fieldName1, $name1);
            } 
                if ($orderBy){
			$this->db->order_by($orderBy,'DESC');
                }
                //$this->db->where( $fieldId, $id);
		//$query = $this->db->get( $table ); 
                if($limit){
                    $query = $this->db->get($table, $limit, $start);
                }else{
                    $query = $this->db->get($table);
                }
                
		return $query->result();
	}
        
}
?>