<?php

class Home_model extends CI_Model {

    function __construct() {
        parent::__construct();
//                    if($this->session->userdata('language_front')){
//                        if($this->session->userdata('language_front')== 'french'){
//                            $database_name = 'fr';
//                        }else{
//                            $database_name = 'default';
//                        }
//                    $this->db = $this->load->database($database_name, TRUE); 
//                    }
    }

    public function add_email($data) {
        $this->db->insert('tbl_sent_emails', $data);
    }

    function totalPages($where = NULL) {
        $sql = "SELECT * FROM `tbl_newsevent_category` AS c LEFT JOIN `tbl_news` AS p ON p.ne_c_id= c.id";
        //$sql = "SELECT * FROM  `tbl_news` sp, `tbl_newsevent_category` spc WHERE sp.ne_c_id= spc.id";	
        if ($where)
            $sql.= ' WHERE' . " " . $where;
        $query = $this->db->query($sql);
        return $query->num_rows();
    }

    //being used
    function get_By_Id($table, $fieldId, $id, $select = '*') {
        $this->db->select($select);
        $this->db->where($fieldId . " = '" . $id . "'");
        $query = $this->db->get($table);
        return $query->row();
    }

    //being used
    function get_all($table, $where = NULL, $orderBy = NULL, $limit=null) {

        $this->db->select('*');


        if ($where)
            $this->db->where($where);
        if ($orderBy)
            $this->db->order_by($orderBy);
        if ($limit)
            $this->db->limit($limit,0);

        $query = $this->db->get($table);

        return $query->result();
    }

    function get_allArray($table, $where = NULL, $orderBy = NULL) {

        $this->db->select('*');


        if ($where)
            $this->db->where($where);
        if ($orderBy)
            $this->db->order_by($orderBy);


        $query = $this->db->get($table);

        return $query->result_array();
    }

//    function get_emailId($table) {
//
//
//        $query = $this->db->get($table);
//        return $query->row();
//    }
//
    function get_news_events($table, $fieldName, $name, $orderBy) {

        $this->db->where($fieldName, $name);
        if ($orderBy) {
            $this->db->order_by($orderBy, 'DESC');
        }
        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->row();
    }
//
    function get_slides($table, $fieldName = null, $name = null, $orderBy = null) {
        if (!empty($name)) {
            $this->db->where($fieldName, $name);
        }
        if (!empty($orderBy)) {
            $this->db->order_by($orderBy, 'ASC');
        }
        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->result();
    }

    function get_newsLimit($table, $fieldName = null, $name = null, $fieldName1 = null, $name1 = null, $orderBy = null, $limit = null, $start = null) {
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        if ($fieldName1 && $name1) {
            //$this->db->where( $fieldName1, $name1);//." and status='Publish' "
            $this->db->where($fieldName1 . " != '" . $name1 . "' ");
        }
        if ($orderBy) {
            $this->db->order_by($orderBy, 'DESC');
        }
        //$this->db->where( $fieldId, $id);
        //$query = $this->db->get( $table ); 
        if ($limit) {
            $query = $this->db->get($table, $limit, $start);
        } else {
            $query = $this->db->get($table);
        }

        return $query->result();
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

    function get_topicID($table, $fieldName = null, $name = null) {
        $this->db->select("*");
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->row();


//                $sql = "SELECT * FROM `$table` WHERE $fieldName like '%$name%' ";
//		//$sql = "SELECT * FROM  `tbl_news` sp, `tbl_newsevent_category` spc WHERE sp.ne_c_id= spc.id";	
//		$query=$this->db->query($sql);
//                return $query->row();
    }

    function get_testimonial($table, $fieldName = null, $name = null) {
        $this->db->select("*");
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->result();
    }

    function get_socialLink($table, $fieldName = null, $name = null) {
        $this->db->select("*");
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->result();


//                $sql = "SELECT * FROM `$table` WHERE $fieldName like '%$name%' ";
//		//$sql = "SELECT * FROM  `tbl_news` sp, `tbl_newsevent_category` spc WHERE sp.ne_c_id= spc.id";	
//		$query=$this->db->query($sql);
//                return $query->row();
    }

    function get_logos($table, $fieldName, $name, $orderBy = null, $limit = null, $start = null) {

        $this->db->where($fieldName, $name);
        if ($orderBy) {
            $this->db->order_by($orderBy, 'DESC');
        }
        //$this->db->where( $fieldId, $id);
        //$query = $this->db->get( $table ); 
        if ($limit) {
            $query = $this->db->get($table, $limit, $start);
        } else {
            $query = $this->db->get($table);
        }

        return $query->result();
    }
    
    function get_content($table,$field,$name,$orderBy){
        $this->db->select('*');
        $this->db->where($field,$name);
        $this->db->order_by($orderBy, 'ASC');
        $query = $this->db->get($table);
        return $query->row();
    }

    function get_topicByID($table, $fieldName = null, $name = null, $fieldName1 = null, $name1 = null, $fieldName2 = null, $name2 = null) {
        $this->db->select("*");
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        if ($fieldName1 && $name1) {
            $this->db->where($fieldName1, $name1);
        }
        if ($fieldName2 && $name2) {
            $this->db->where($fieldName2, $name2);
        }
        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->row();
    }

    function get_tags($table, $fieldName = null, $name = null, $fieldName1 = null, $name1 = null, $orderBy = null, $limit = null, $start = null) {
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        if ($fieldName1 && $name1) {
            $this->db->where($fieldName1, $name1);
        }
        if ($orderBy) {
            $this->db->order_by($orderBy, 'ASC');
        }
        //$this->db->where( $fieldId, $id);
        //$query = $this->db->get( $table ); 
        if ($limit) {
            $query = $this->db->get($table, $limit, $start);
        } else {
            $query = $this->db->get($table);
        }

        return $query->result();
    }

    function get_packageByDisplayType($table, $fieldName = null, $name = null, $fieldName1 = null, $name1 = null, $orderBy = null, $limit = null, $start = null) {
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        if ($fieldName1 && $name1) {
            $this->db->where($fieldName1, $name1);
        }
        if ($orderBy) {
            $this->db->order_by($orderBy, 'ASC');
        }
        //$this->db->where( $fieldId, $id);
        //$query = $this->db->get( $table ); 
        if ($limit) {
            $query = $this->db->get($table, $limit, $start);
        } else {
            $query = $this->db->get($table);
        }

        return $query->result();
    }

    function get_packageByDisplayTypeID($table, $fieldName = null, $name = null, $fieldName1 = null, $name1 = null, $fieldName2 = null, $name2 = null, $orderBy = null, $limit = null, $start = null) {
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        if ($fieldName1 && $name1) {
            $this->db->where($fieldName1, $name1);
        }
        if ($fieldName2 && $name2) {
            $this->db->where($fieldName2, $name2);
        }
        if ($orderBy) {
            $this->db->order_by($orderBy, 'ASC');
        }
        //$this->db->where( $fieldId, $id);
        //$query = $this->db->get( $table ); 
        if ($limit) {
            $query = $this->db->get($table, $limit, $start);
        } else {
            $query = $this->db->get($table);
        }

        return $query->result();
    }

    function get_packageByDisplayTypeIDRegion($table, $fieldName = null, $name = null, $fieldName1 = null, $name1 = null, $fieldName2 = null, $name2 = null, $fieldName3 = null, $name3 = null, $orderBy = null, $limit = null, $start = null) {
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        if ($fieldName1 && $name1) {
            $this->db->where($fieldName1, $name1);
        }
        if ($fieldName2 && $name2) {
            $this->db->where($fieldName2, $name2);
        }
        if ($fieldName3 && $name3) {
            $this->db->where($fieldName3, $name3);
        }
        if ($orderBy) {
            $this->db->order_by($orderBy, 'ASC');
        }
        //$this->db->where( $fieldId, $id);
        //$query = $this->db->get( $table ); 
        if ($limit) {
            $query = $this->db->get($table, $limit, $start);
        } else {
            $query = $this->db->get($table);
        }

        return $query->result();
    }

    function get_package_details($table, $fieldName = null, $name = null, $orderBy = null) {//function getByWhere( $table, $fieldName, $con, $select='*')
        //$this->db->select($select);
        //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' "); 
        //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' " ."and status  = 'Publish' "); 
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        if ($orderBy) {
            $this->db->order_by($orderBy, 'ASC');
        }
        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->row();
    }

    function get_package_slider($table, $fieldName = null, $name = null, $orderBy = null) {//function getByWhere( $table, $fieldName, $con, $select='*')
        //$this->db->select($select);
        //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' "); 
        //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' " ."and status  = 'Publish' "); 
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        if ($orderBy) {
            $this->db->order_by($orderBy, 'ASC');
        }
        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->result();
    }

    function get_table($table, $fieldName, $name, $orderBy = null) {//function getByWhere( $table, $fieldName, $con, $select='*')
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

    function get_table_sorted($table, $fieldName, $name, $orderBy = null, $limit = NULL, $start = NULL) {//function getByWhere( $table, $fieldName, $con, $select='*')
        //$this->db->select($select);
        //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' "); 
        //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' " ."and status  = 'Publish' "); 
        $this->db->where($fieldName, $name);
        if ($orderBy) {
            $this->db->order_by($orderBy, 'DESC');
        }
        //if($limit && $start){
        $query = $this->db->get($table, $limit, $start);
        //}else{
        //  $query = $this->db->get($table); 
        //}

        return $query->result();
    }

    function get_video($table, $fieldName, $name, $orderBy = null) {//function getByWhere( $table, $fieldName, $con, $select='*')
        //$this->db->select($select);
        //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' "); 
        //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' " ."and status  = 'Publish' "); 
        $this->db->where($fieldName, $name);
        $this->db->where('status', 'Publish');
        if ($orderBy) {
            $this->db->order_by($orderBy, 'ASC');
        }
        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->result();
    }

    function get_dropdown($table, $fieldName, $name, $orderBy) {//function getByWhere( $table, $fieldName, $con, $select='*')
        //$this->db->select($select);
        //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' "); 
        //$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' " ."and status  = 'Publish' "); 
        $this->db->where($fieldName, $name);

        $this->db->order_by($orderBy, 'ASC');

        //$this->db->where( $fieldId, $id);
        $query = $this->db->get($table);
        return $query->result();
    }

    function get_mostRepeated($table, $fieldName) {
//            $this->db->select('*');
//            $this->db->where( $fieldName, $name); 
//            $this->db->order_by($orderBy,'desc');
//            $this->db->group_by('MONTH(date), YEAR(date)');
//            $query = $this->db->get($table); 
//		return $query->result(); 

        $sql = "SELECT $fieldName FROM `$table` GROUP BY $fieldName ORDER BY count($fieldName) DESC limit 5";
        $query = $this->db->query($sql);
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
//
    function story($id, $table) {
        $this->db->select('*');
        $this->db->where('id', $id);
        $query = $this->db->get($table);
        return $query->row();
    }
//
    function get_banner() {
        $this->db->select('*');
        $this->db->where('banner_status', 'Published');
        $this->db->order_by('created_date', 'DESC');
        $query = $this->db->get('tbl_banners');
        return $query->result();
    }
    
    function get_questions($where,$limit,$start){
        $this->db->select('*');
        $this->db->where($where);
        $this->db->order_by('banner_id', 'asc');
        $this->db->limit($limit, $start);
        $query = $this->db->get('hya_data_question');
        return $query->result_array();
    }
    
    function get_join($table2,$questionId){
        $this->db->select('*');
        $this->db->from('hya_data_question as q');
        $this->db->join($table2 .' as o',"q.question_id=o.question_id");
        $this->db->where("q.question_id",$questionId);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    function get_all_subjects()
    {
       $result=$this->db->query("select b.*,l.*,c.* from hya_course_board as b Left Join hya_course_level as l on b.board_id=l.board_id  left join hya_course_course as c on l.level_id=c.level_id   where b.status=1 AND l.level_type='academic' order by b.board_id ASC")->result(); 
       return $result;
    }

}

?>