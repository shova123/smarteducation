<?php

class Signin_model extends CI_Model {

    function __construct() {
        parent::__construct();

//                        if($this->session->userdata('language')== 'french'){
//                            $database_name = 'fr';
//                        }else{
//                            $database_name = 'default';
//                        }
//                    $this->db = $this->load->database($database_name, TRUE); 
    }
    
    function get_Trek_counted($table, $fieldName = null, $name = null, $fieldName1 = null, $name1 = null) {
        $this->db->select('count(*) as count');
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        if ($fieldName1 && $name1) {
            $this->db->where($fieldName1, $name1);
        }

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
        $sql = "SELECT * FROM `$table` WHERE $fieldName like '%$name%' ";
        //$sql = "SELECT * FROM  `hya_news` sp, `hya_newsevent_category` spc WHERE sp.ne_c_id= spc.id";	
        $query = $this->db->query($sql);
        return $query->row();
    }

    function get_gallery($table, $fieldName, $name, $orderBy, $limit, $start) {

        $this->db->where($fieldName, $name);
        if ($orderBy) {
            $this->db->order_by($orderBy, 'DESC');
        }
        $query = $this->db->get($table, $limit, $start);
        return $query->result();
    }
    public function add_email($data) {
        $this->db->insert('hya_sent_emails', $data);
    }

    function get_emailId($table) {
        $query = $this->db->get($table);
        return $query->row();
    }

    function totalPages($where = NULL) {
        $sql = "SELECT * FROM `hya_newsevent_category` AS c LEFT JOIN `hya_news` AS p ON p.ne_c_id= c.id";
        //$sql = "SELECT * FROM  `hya_news` sp, `hya_newsevent_category` spc WHERE sp.ne_c_id= spc.id";	
        if ($where)
            $sql.= ' WHERE' . " " . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    function get_pages($limit = NULL, $start = NULL, $where = NULL) {
        $sql = "SELECT * FROM `hya_newsevent_category` AS c LEFT JOIN `hya_news` AS p ON p.ne_c_id= c.id";
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

    function get_byId($table, $fieldName=null, $name=null) {
        $this->db->select("*");
        if (!empty($name)) {
            $this->db->where($fieldName, $name);
        }
        $query = $this->db->get($table);
        return $query->row();
    }
    function getByRows($table, $fieldName = null, $name = null, $fieldName1 = null, $name1 = null) {
        $this->db->select("*");
        if ($name) {
            $this->db->where($fieldName, $name);
        }
        if ($name1) {
            $this->db->where($fieldName1, $name1);
        }
        $query = $this->db->get($table);
        return $query->row();
    }
    function get_admins($table, $fieldName, $name) {

        $this->db->where($fieldName, $name);
        $query = $this->db->get($table);
        return $query->row();
    }

    function get_users($table, $fieldName1=null, $name1=null, $fieldName2=null, $name2=null, $fieldName3=null, $name3=null) {

        if($name1){
            $this->db->where($fieldName1, $name1);
        }
        if($name2){
            $this->db->where($fieldName2, $name2);
        }
        if($name3){
            $this->db->where($fieldName3, $name3);
        }
        $query = $this->db->get($table);
        return $query->result();
    }
   
    function get_adminsLog($table, $fieldName, $name) {

        $this->db->where($fieldName, $name);
        $this->db->order_by('logid', 'desc');
        $query = $this->db->get($table);
        return $query->result();
    }

     function get_result($table, $fieldName=null, $name=null,$fieldName1=null, $name1=null,$orderBy=null)
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
    function get_results($table, $fieldName = null, $name = null, $order = null) {

        if (!empty($name)) {
            $this->db->where($fieldName, $name);
        }
        if (!empty($order)) {
            $this->db->order_by($order, 'asc');
        }
        $query = $this->db->get($table);
        return $query->result();
    }
    

    function get_resultsSelect($table, $select = null, $fieldName = NULL, $name = NULL, $fieldName1 = NULL, $name1 = NULL, $orderBy = NULL, $group_by = NULL) {
        $this->db->select("$select");
        if ($fieldName) {
            $this->db->where($fieldName, $name);
        }
        if ($fieldName1) {
            $this->db->where($fieldName1, $name1);
        }
        if ($orderBy) {
            $this->db->order_by($orderBy);
        }
        if ($group_by) {
            $this->db->group_by($group_by);
        }
        $query = $this->db->get($table);

        return $query->result();
    }

    function getBySelectionExporting($table, $allColl = NULL, $user_id = null, $temp_id = null) {
        $sql = "SELECT $allColl FROM `$table` WHERE temp_id='" . $temp_id . "' and user_id='" . $user_id . "' ";
        $query = $this->db->query($sql);
        $data_wrt = $this->dbutil->csv_from_result($query);
        return $data_wrt;
    }
    function get_templates($table,$fieldName=NULL,$name=NULL,$fieldName1=NULL,$name1=NULL,$orderBy=NULL,$group_by=NULL) {
        $this->db->select("*");

        if ($name) {
            $this->db->where($fieldName, $name);
        }
        if ($name1) {
            $this->db->where($fieldName1, $name1);
        }
        if ($orderBy) {
            $this->db->order_by($orderBy,"ASC");
        }
        if ($group_by) {
            $this->db->group_by($group_by);
        }
        $query = $this->db->get($table);

        return $query->result();
    }

    function get_templatesWhereOr($table,$whereOR=NULL,$fieldName1=NULL,$name1=NULL,$orderBy=NULL,$group_by=NULL) {
        $this->db->select("*");

        if ($whereOR) {
            $this->db->where($whereOR);
        }
        if ($name1) {
            $this->db->where($fieldName1, $name1);
        }
        if ($orderBy) {
            $this->db->order_by($orderBy,"ASC");
        }
        if ($group_by) {
            $this->db->group_by($group_by);
        }
        $query = $this->db->get($table);

        return $query->result();
    }
    
    function get_exceptUserID_templates($table, $fieldName = NULL, $name = NULL, $fieldName1 = NULL, $name1 = NULL, $orderBy = NULL, $group_by = NULL) {
        $this->db->select("*");

        if ($fieldName) {
            $this->db->where("$fieldName != $name");
        }
        if ($fieldName1) {
            $this->db->where($fieldName1, $name1);
        }
        if ($orderBy) {
            $this->db->order_by($orderBy);
        }
        if ($group_by) {
            $this->db->group_by($group_by);
        }
        $query = $this->db->get($table);

        return $query->result();
    }

    function delete($table, $fiedName = NULL, $name = NULL, $fiedName1 = NULL, $name1 = NULL) {
        if (!empty($fiedName)) {
            $this->db->where($fiedName, $name);
        }
        if (!empty($fiedName1)) {
            $this->db->where($fiedName1, $name1);
        }
        $this->db->delete($table);
    }
    function update($table, $array, $where = null) {
        if (!empty($where)) {
            $this->db->where($where);
        }
        return $this->db->update($table, $array);
    }
    function update_template($table, $array, $fieldName = null, $name = null, $fieldName1 = null, $name1 = null) {
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        if ($fieldName1 && $name1) {
            $this->db->where($fieldName1, $name1);
        }
        return $this->db->update($table, $array);
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
        $query = $this->db->get('hya_banners');
        return $query->result();
    }

}

?>