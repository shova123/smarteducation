<?php

class Permissions_model extends CI_Model {

    function __construct() {
        parent::__construct();

//                        if($this->session->userdata('language')== 'french'){
//                            $database_name = 'fr';
//                        }else{
//                            $database_name = 'default';
//                        }
//                    $this->db = $this->load->database($database_name, TRUE); 
    }

    public function add_email($data) {
        $this->db->insert('tbl_sent_emails', $data);
    }

    function get_emailId($table) {
        $query = $this->db->get($table);
        return $query->row();
    }

    function totalPages($where = NULL) {
        $sql = "SELECT * FROM `tbl_newsevent_category` AS c LEFT JOIN `tbl_news` AS p ON p.ne_c_id= c.id";
        //$sql = "SELECT * FROM  `tbl_news` sp, `tbl_newsevent_category` spc WHERE sp.ne_c_id= spc.id";	
        if ($where)
            $sql.= ' WHERE' . " " . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    function get_pages($limit = NULL, $start = NULL, $where = NULL) {
        $sql = "SELECT * FROM `tbl_newsevent_category` AS c LEFT JOIN `tbl_news` AS p ON p.ne_c_id= c.id";
        if ($where)
            $sql.= ' where' . " " . $where;
        if ($limit)
            $sql.= ' limit' . " " . $limit;
        if ($start)
            $sql.="," . $start;
        //echo $query=$this->db->last_query(); exit;
        //$this->db->limit($limit, $start);
        $query = $this->db->query($sql);
        return $query->result();
    }

    function get_byId($table, $fieldName = null, $name = null) {

        if (!empty($name)) {
            $this->db->where($fieldName, $name);
        }

        //$this->db->where( 'status', 'Publish');
//                if ($orderBy){
//			$this->db->order_by($orderBy,'DESC');
//                }
        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->row();
    }

    function get_admins($table, $fieldName, $name) {

        $this->db->where($fieldName, $name);
        $query = $this->db->get($table);
        return $query->row();
    }

    function get_adminsLog($table, $fieldName, $name) {

        $this->db->where($fieldName, $name);
        $this->db->order_by('logid', 'desc');
        $query = $this->db->get($table);
        return $query->result();
    }

    function get_rows($table, $fieldName = null, $name = null, $fieldName1 = null, $name1 = null) {
        $this->db->select('*');
        if (!empty($name)) {
            $this->db->where($fieldName, $name);
        }
        if (!empty($name1)) {
            $this->db->where($fieldName1, $name1);
        }

        //$this->db->where( 'status', 'Publish');
//                if ($orderBy){
//			$this->db->order_by($orderBy,'DESC');
//                }
        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->row();
    }

    function get_results($table, $fieldName = null, $name = null, $fieldNotName = null, $order = null) {
        $this->db->select('*');
        if (!empty($name)) {
            $this->db->where($fieldName, $name);
        }
        if (!empty($fieldNotName)) {
            $this->db->where($fieldNotName);
        }
        if (!empty($order)) {
            $this->db->order_by($order, 'asc');
        }
        $query = $this->db->get($table);
        return $query->result();
    }

    function get_resultsUnique($table, $fieldName = null, $name = null, $order = null, $group_by = null) {
        $this->db->select('*');
        //$this->db->distinct($distinctName);
        if (!empty($name)) {
            $this->db->where($fieldName, $name);
        }
        if (!empty($order)) {
            $this->db->order_by($order, 'asc');
        }
        if (!empty($group_by)) {
            $this->db->group_by($group_by);
        }
        $query = $this->db->get($table);
        return $query->result();
    }

//         function get_Trek_counted($table,$fieldName=null, $name=null)//function getByWhere( $table, $fieldName, $con, $select='*')
//	{ 
//            $this->db->select('count(*) as count');//$this->db->select('count(*) as count, tbl_contacts_lists.*');
//            if($fieldName && $name){
//            $this->db->where($fieldName, $name); 
//            }
////            $this->db->order_by($orderBy,'asc');
////            $this->db->group_by('MONTH(date), YEAR(date)');
//            $query = $this->db->get($table); 
//		return $query->result(); 
//	}
    function get_Trek_counted($table, $fieldName = null, $name = null, $fieldName1 = null, $name1 = null) {
        $this->db->select('count(*) as count');
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        if ($fieldName1 && $name1) {
            $this->db->where($fieldName1, $name1);
        }
//                if ($orderBy){
//			$this->db->order_by($orderBy,'ASC');
//                }
        //$this->db->where( $fieldId, $id);
        //$query = $this->db->get( $table ); 
//                if($limit){
//                    $query = $this->db->get($table, $limit, $start);
//                }else{
//                    $query = $this->db->get($table);
//                }
        $query = $this->db->get($table);
        return $query->row();
    }

    function get_news_events($table, $fieldName, $name, $orderBy) {

        $this->db->where($fieldName, $name);
        if ($orderBy) {
            $this->db->order_by($orderBy, 'DESC');
        }
        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->row();
    }

    function get_topic($table, $fieldName, $name) {
//                $this->db->where( $fieldName, $name);
//                //$this->db->where( $fieldId, $id);
//		$query = $this->db->get( $table ); 
//		return $query->row();


        $sql = "SELECT * FROM `$table` WHERE $fieldName like '%$name%' ";
        //$sql = "SELECT * FROM  `tbl_news` sp, `tbl_newsevent_category` spc WHERE sp.ne_c_id= spc.id";	
        $query = $this->db->query($sql);
        return $query->row();
    }

    function get_gallery($table, $fieldName, $name, $orderBy, $limit, $start) {

        $this->db->where($fieldName, $name);
        if ($orderBy) {
            $this->db->order_by($orderBy, 'DESC');
        }
        //$this->db->where( $fieldId, $id);
        //$query = $this->db->get( $table ); 
        $query = $this->db->get($table, $limit, $start);
        return $query->result();
    }

    function get_table($table, $fieldName, $name, $orderBy) {//function getByWhere( $table, $fieldName, $con, $select='*')
        //$this->db->select($select);
        //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' "); 
        //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' " ."and status  = 'Publish' "); 
        $this->db->where($fieldName, $name);
        if ($orderBy) {
            $this->db->order_by($orderBy, 'ASC');
        }
        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->result();
    }

    function get_page_by_id($page_id) {
        $this->db->select('*');
        $this->db->where('page_id', $page_id);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function get_page($page_slug) {
        $this->db->select('*');
        $this->db->where('page_status', 'Enabled');
        $this->db->where('page_slug', $page_slug);
        $query = $this->db->get($this->table_name);
        return $query->row();
    }

    function story($id, $table) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->row();
    }

    function get_banner() {
        $this->db->select('*');
        $this->db->where('banner_status', 'Published');
        $this->db->order_by('banner_id', 'asc');
        $query = $this->db->get('tbl_banners');
        return $query->result();
    }

}

?>