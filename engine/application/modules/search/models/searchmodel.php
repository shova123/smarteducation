<?php
class Searchmodel extends CI_Model{
	
		function __construct(){
			parent::__construct();
		}
                public function add_email($data)
                {
                           $this->db->insert('tbl_sent_emails',$data);
                }
                
                
                
                
        function totalPages($where=NULL)
	{	
		$sql = "SELECT * FROM `tbl_newsevent_category` AS c LEFT JOIN `tbl_news` AS p ON p.ne_c_id= c.id";
		//$sql = "SELECT * FROM  `tbl_news` sp, `tbl_newsevent_category` spc WHERE sp.ne_c_id= spc.id";	
		if($where)
		$sql.= ' WHERE'." ".$where;
		$query=$this->db->query($sql);
		return $query->num_rows();
	}
	
	function get_pages($limit=NULL, $start=NULL, $where=NULL)
	{
		$sql = "SELECT * FROM `tbl_newsevent_category` AS c LEFT JOIN `tbl_news` AS p ON p.ne_c_id= c.id";
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
         function get_byId($table, $fieldName, $name)
	{
           
		 $this->db->where( $fieldName, $name);
                 $this->db->where( 'status', 'Publish');
//                if ($orderBy){
//			$this->db->order_by($orderBy,'DESC');
//                }
                //$this->db->where( $fieldId, $id);
		$query = $this->db->get( $table ); 
		return $query->row();
	}
        function get_news_events($table, $fieldName, $name,$orderBy)
	{
           
		 $this->db->where( $fieldName, $name);
                if ($orderBy){
			$this->db->order_by($orderBy,'DESC');
                }
                //$this->db->where( $fieldId, $id);
		$query = $this->db->get( $table ); 
		return $query->row();
	}
        function get_topic($table, $fieldName, $name)
	{
//                $this->db->where( $fieldName, $name);
//                //$this->db->where( $fieldId, $id);
//		$query = $this->db->get( $table ); 
//		return $query->row();
                
                
                $sql = "SELECT * FROM `$table` WHERE $fieldName like '%$name%' ";
		//$sql = "SELECT * FROM  `tbl_news` sp, `tbl_newsevent_category` spc WHERE sp.ne_c_id= spc.id";	
		$query=$this->db->query($sql);
                return $query->row();
	}
        function get_gallery($table, $fieldName, $name, $orderBy, $limit, $start)
	{
           
		 $this->db->where( $fieldName, $name);
                if ($orderBy){
			$this->db->order_by($orderBy,'DESC');
                }
                //$this->db->where( $fieldId, $id);
		//$query = $this->db->get( $table ); 
                $query = $this->db->get( $table, $limit, $start );
		return $query->result();
	}
        function get_table( $table, $fieldName, $name,$orderBy)//function getByWhere( $table, $fieldName, $con, $select='*')
	{ 
		//$this->db->select($select);
		//$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' "); 
                //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' " ."and status  = 'Publish' "); 
                $this->db->where( $fieldName, $name);
                if ($orderBy){
			$this->db->order_by($orderBy,'ASC');
                }
                //$this->db->where( $fieldId, $id);
		$query = $this->db->get( $table ); 
		return $query->result(); 
	}
        
        function get_quick_search( $table, $jobType=null,$jobTKC=null,$jobLocation=null,$jobCatId=null)//function getByWhere( $table, $fieldName, $con, $select='*')
	{ 
            $where = "status = 'Publish' ";
            if($jobType){
                $where.="and job_type like '%$jobType%' ";
            }
            if($jobTKC){
                $where.="and job_title like '%$jobTKC%' or organization_title like '%$jobTKC%' ";
            }
            if($jobLocation){
                $where.="and job_location like '%$jobLocation%' ";
            }
            if($jobCatId){
                $where.="and job_category = '$jobCatId' ";
            }
                $sql = "SELECT * FROM `$table` WHERE $where";
                $query=$this->db->query($sql);
                //$this->db->order_by('job_title','ASC');
                //$query = $this->db->get( $table ); 
		return $query->result(); 
	}
        function get_quick_search2($table, $job_category=null,$job_level=null,$education_qualification=null,$job_type=null,$job_location=null)//function getByWhere( $table, $fieldName, $con, $select='*')
	{ 
            $where = "status = 'Publish' ";
            if($job_category){
                $where.="and job_category ='$job_category' ";
            }
            if($job_level){
                $where.="and job_level like '%$job_level%' ";
            }
            if($education_qualification){
                $where.="and education_qualification like '%$education_qualification%' ";
            }
            if($job_type){
                $where.="and job_type like '%$job_type%' ";
            }
            if($job_location){
                $where.="and job_location like '%$job_location%' ";
            }
      
                $sql = "SELECT * FROM `$table` WHERE $where";
                $query=$this->db->query($sql);
                //$this->db->order_by('job_title','ASC');
                //$query = $this->db->get( $table ); 
		return $query->result(); 
	}
        
         function get_dropdown( $table, $fieldName, $name,$orderBy)//function getByWhere( $table, $fieldName, $con, $select='*')
	{ 
		//$this->db->select($select);
		//$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' "); 
                //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' " ."and status  = 'Publish' "); 
                $this->db->where( $fieldName, $name);
                
                $this->db->order_by($orderBy,'ASC');
               
                //$this->db->where( $fieldId, $id);
		$query = $this->db->get( $table ); 
		return $query->result(); 
	}
        
        function get_mostRepeated($table, $fieldName){
//            $this->db->select('*');
//            $this->db->where( $fieldName, $name); 
//            $this->db->order_by($orderBy,'desc');
//            $this->db->group_by('MONTH(date), YEAR(date)');
//            $query = $this->db->get($table); 
//		return $query->result(); 

            $sql = "SELECT $fieldName FROM `$table` GROUP BY $fieldName ORDER BY count($fieldName) DESC limit 5";
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