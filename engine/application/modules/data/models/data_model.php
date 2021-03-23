<?php
class Data_Model extends CI_Model{
	
    function __construct(){
            parent::__construct();
            $this->table1="hya_data_question";
            $this->table2="hya_data_options";
            $this->table3="hya_data_answer";
            $this->table4="hya_data_sub_question";
            

    } 
    
    function get_slc()
    {
        $this->db->select('*');
        $this->db->from($this->table1);
//        $this->db->where('status',1);
        $this->db->order_by('created_date','DESC');
        $result=$this->db->get();
        return $result->result();
    }
    
    function get_results($table, $fieldName=null, $name=null,$order=null)
    {
        $this->db->select("*");
        if(!empty($name)){
            $this->db->where( $fieldName, $name);
        }
        if(!empty($order)){        
            $this->db->order_by($order,'asc');
        }
        $query = $this->db->get( $table ); 
        return $query->result();
    }
    
    
    function get_resultsNine($table, $fieldName=null, $name=null,$fieldName1=null, $name1=null,$fieldName2=null, $name2=null,$fieldName3=null, $name3=null,$fieldName4=null, $name4=null,$fieldName5=null, $name5=null,$fieldName6=null, $name6=null,$fieldName7=null, $name7=null,$fieldName8=null, $name8=null,$order=null)
    {
        $this->db->select("*");
        if(!empty($name)){$this->db->where( $fieldName, $name);}
        if(!empty($name1)){$this->db->where( $fieldName1, $name1);}
        if(!empty($name2)){$this->db->where( $fieldName2, $name2);}
        if(!empty($name3)){$this->db->where( $fieldName3, $name3);}
        if(!empty($name4)){$this->db->where( $fieldName4, $name4);}
        if(!empty($name5)){$this->db->where( $fieldName5, $name5);}
        if(!empty($name6)){$this->db->where( $fieldName6, $name6);}
        if(!empty($name7)){$this->db->where( $fieldName7, $name7);}
        if(!empty($name8)){$this->db->where( $fieldName8, $name8);}
        if(!empty($order)){        
            $this->db->order_by($order,'asc');
        }
        $query = $this->db->get( $table ); 
        return $query->result();
    }
    
    function getQuestions($keyword=null,$userID=null){
        $sql = "SELECT";
        $sql .= " q.QUESTION_ID, q.QUESTION,";
        $sql .= " csu.SUBJECT_NAME"; 
        $sql .= " FROM hya_data_question q";
        $sql .= " INNER JOIN hya_course_board cb on q.board_id = cb.board_id";
        $sql .= " INNER JOIN hya_course_level cl on q.level_id = cl.level_id";
//        $sql .= " INNER JOIN hya_course_stream cs on q.stream_id = cs.stream_id";
//        $sql .= " INNER JOIN hya_course_course cc on q.course_id = cc.course_id";
//        $sql .= " INNER JOIN hya_course_department cd on q.department_id = cd.department_id";
        $sql .= " INNER JOIN hya_course_subject csu on q.subject_id = csu.subject_id";
        $sql .= " INNER JOIN hya_course_chapter cch on q.chapter_id = cch.chapter_id";
        $sql .= " INNER JOIN hya_course_unit cu on q.unit_id = cu.unit_id";
        $sql .= " INNER JOIN hya_course_subunit csbu on q.subunit_id = csbu.subunit_id";
        
        $sql .= " WHERE q.status='1'";
        $sql .= " AND (";
                $sql .= "q.question like '%$keyword%'";
                $sql .= " OR q.question_type like '%$keyword%'";
                $sql .= " OR q.question_tag like '%$keyword%'";
                $sql .= " OR cb.board_name like '%$keyword%'";
                $sql .= " OR cb.board_alias like '%$keyword%'";
                $sql .= " OR cl.level_name like '%$keyword%'";
                $sql .= " OR cl.level_type like '%$keyword%'";
//                $sql .= " OR cs.stream_name like '%$keyword%'";
//                $sql .= " OR cc.course_name like '%$keyword%'";
//                $sql .= " OR cc.course_alias like '%$keyword%'";
//                $sql .= " OR cd.department_name like '%$keyword%'";
//                $sql .= " OR cd.department_alias like '%$keyword%'";
                $sql .= " OR csu.subject_name like '%$keyword%'";
                $sql .= " OR cch.chapter_name like '%$keyword%'";
                $sql .= " OR cu.unit_name like '%$keyword%'";
                $sql .= " OR csbu.subunit_name like '%$keyword%'";
        $sql .= ")";
        // $sql = "SELECT u.USER_ID, u.USER_TOKEN, u.USERNAME, u.FIRST_NAME, u.LAST_NAME, u.EMAIL, u.ADDRESS, u.HOME_IMAGE, u.ACTIVE, u.CREATED_ON, u.LAST_LOGIN, u.SENT_EMAIL, u.LAST_UPDATE, c.CATEGORY_TITLE, sc.SUBCATEGORY_TITLE FROM tbl_users u INNER JOIN tbl_category c on u.category_id = c.category_id INNER JOIN tbl_category_sub sc on u.sub_cat_id = sc.sub_cat_id WHERE u.c_user_id='$userID' AND (u.username like '%$keyword%' OR u.first_name like '%$keyword%' OR u.last_name like '%$keyword%' OR u.email like '%$keyword%' OR u.address like '%$keyword%' OR c.category_title like '%$keyword%' OR sc.subcategory_title like '%$keyword%')";
        $query = $this->db->query($sql);
    return $query->result();
    }
    function  getQuestions_bySession($board_id=null, $level_id=null, $stream_id=null, $course_id=null, $department_id=null, $year=null, $semester=null, $subject_id=null, $chapter_id=null, $unit_id=null, $subunit_id=null){
      $sql = "SELECT";
        $sql .= " q.*,";
        $sql .= " csu.SUBJECT_NAME"; 
        $sql .= " FROM hya_data_question q";
        $sql .= " INNER JOIN hya_course_board cb on q.board_id = cb.board_id";
//        $sql .= " INNER JOIN hya_course_level cl on q.level_id = cl.level_id";
//        $sql .= " INNER JOIN hya_course_stream cs on q.stream_id = cs.stream_id";
//        $sql .= " INNER JOIN hya_course_course cc on q.course_id = cc.course_id";
//        $sql .= " INNER JOIN hya_course_department cd on q.department_id = cd.department_id";
        $sql .= " INNER JOIN hya_course_subject csu on q.subject_id = csu.subject_id";
//        $sql .= " INNER JOIN hya_course_chapter cch on q.chapter_id = cch.chapter_id";
//        $sql .= " INNER JOIN hya_course_unit cu on q.unit_id = cu.unit_id";
//        $sql .= " INNER JOIN hya_course_subunit csbu on q.subunit_id = csbu.subunit_id";
        
        $sql .= " WHERE q.status='1'";
        $sql .= " AND (";
//                $sql .= "q.question like '%$keyword%'";
//                $sql .= " OR q.question_type like '%$keyword%'";
//                $sql .= " OR q.question_tag like '%$keyword%'";
                if(!empty($board_id)){$sql .= "q.board_id ='$board_id'";}
                if(!empty($level_id)){$sql .= " AND q.level_id ='$level_id'";}
                if(!empty($stream_id)){$sql .= " AND q.stream_id ='$stream_id'";}
                if(!empty($course_id)){$sql .= " AND q.course_id ='$course_id'";}
                if(!empty($department_id)){$sql .= " AND q.department_id ='$department_id'";}
                if(!empty($year)){$sql .= " AND q.year ='$year'";}
                if(!empty($semester)){$sql .= " AND q.semester ='$semester'";}
                if(!empty($subject_id)){$sql .= " AND q.subject_id ='$subject_id'";}
                if(!empty($chapter_id)){$sql .= " AND q.chapter_id ='$chapter_id'";}
                if(!empty($unit_id)){$sql .= " AND q.unit_id ='$unit_id'";}
                if(!empty($subunit_id)){$sql .= " AND q.subunit_id ='$subunit_id'";}
        $sql .= ")";
        // $sql = "SELECT u.USER_ID, u.USER_TOKEN, u.USERNAME, u.FIRST_NAME, u.LAST_NAME, u.EMAIL, u.ADDRESS, u.HOME_IMAGE, u.ACTIVE, u.CREATED_ON, u.LAST_LOGIN, u.SENT_EMAIL, u.LAST_UPDATE, c.CATEGORY_TITLE, sc.SUBCATEGORY_TITLE FROM tbl_users u INNER JOIN tbl_category c on u.category_id = c.category_id INNER JOIN tbl_category_sub sc on u.sub_cat_id = sc.sub_cat_id WHERE u.c_user_id='$userID' AND (u.username like '%$keyword%' OR u.first_name like '%$keyword%' OR u.last_name like '%$keyword%' OR u.email like '%$keyword%' OR u.address like '%$keyword%' OR c.category_title like '%$keyword%' OR sc.subcategory_title like '%$keyword%')";
        $query = $this->db->query($sql);
        return $query->result();   
    }
   function getQuestions_by($board_id=null, $level_id=null, $stream_id=null, $course_id=null, $department_id=null, $year=null, $semester=null, $subject_id=null, $chapter_id=null, $unit_id=null, $subunit_id=null){
        $sql = "SELECT";
        $sql .= " q.QUESTION_ID, q.QUESTION,";
        $sql .= " csu.SUBJECT_NAME"; 
        $sql .= " FROM hya_data_question q";
        $sql .= " INNER JOIN hya_course_board cb on q.board_id = cb.board_id";
//        $sql .= " INNER JOIN hya_course_level cl on q.level_id = cl.level_id";
//        $sql .= " INNER JOIN hya_course_stream cs on q.stream_id = cs.stream_id";
//        $sql .= " INNER JOIN hya_course_course cc on q.course_id = cc.course_id";
//        $sql .= " INNER JOIN hya_course_department cd on q.department_id = cd.department_id";
        $sql .= " INNER JOIN hya_course_subject csu on q.subject_id = csu.subject_id";
//        $sql .= " INNER JOIN hya_course_chapter cch on q.chapter_id = cch.chapter_id";
//        $sql .= " INNER JOIN hya_course_unit cu on q.unit_id = cu.unit_id";
//        $sql .= " INNER JOIN hya_course_subunit csbu on q.subunit_id = csbu.subunit_id";
        
        $sql .= " WHERE q.status='1'";
        $sql .= " AND (";
//                $sql .= "q.question like '%$keyword%'";
//                $sql .= " OR q.question_type like '%$keyword%'";
//                $sql .= " OR q.question_tag like '%$keyword%'";
                if(!empty($board_id)){$sql .= "q.board_id ='$board_id'";}
                if(!empty($level_id)){$sql .= " AND q.level_id ='$level_id'";}
                if(!empty($stream_id)){$sql .= " AND q.stream_id ='$stream_id'";}
                if(!empty($course_id)){$sql .= " AND q.course_id ='$course_id'";}
                if(!empty($department_id)){$sql .= " AND q.department_id ='$department_id'";}
                if(!empty($year)){$sql .= " AND q.year ='$year'";}
                if(!empty($semester)){$sql .= " AND q.semester ='$semester'";}
                if(!empty($subject_id)){$sql .= " AND q.subject_id ='$subject_id'";}
                if(!empty($chapter_id)){$sql .= " AND q.chapter_id ='$chapter_id'";}
                if(!empty($unit_id)){$sql .= " AND q.unit_id ='$unit_id'";}
                if(!empty($subunit_id)){$sql .= " AND q.subunit_id ='$subunit_id'";}
        $sql .= ")";
        // $sql = "SELECT u.USER_ID, u.USER_TOKEN, u.USERNAME, u.FIRST_NAME, u.LAST_NAME, u.EMAIL, u.ADDRESS, u.HOME_IMAGE, u.ACTIVE, u.CREATED_ON, u.LAST_LOGIN, u.SENT_EMAIL, u.LAST_UPDATE, c.CATEGORY_TITLE, sc.SUBCATEGORY_TITLE FROM tbl_users u INNER JOIN tbl_category c on u.category_id = c.category_id INNER JOIN tbl_category_sub sc on u.sub_cat_id = sc.sub_cat_id WHERE u.c_user_id='$userID' AND (u.username like '%$keyword%' OR u.first_name like '%$keyword%' OR u.last_name like '%$keyword%' OR u.email like '%$keyword%' OR u.address like '%$keyword%' OR c.category_title like '%$keyword%' OR sc.subcategory_title like '%$keyword%')";
        $query = $this->db->query($sql);
    return $query->result();
    }
    
    function getQuestions_all(){
        $sql = "SELECT";
        $sql .= " q.QUESTION_ID, q.QUESTION,";
        $sql .= " csu.SUBJECT_NAME"; 
        $sql .= " FROM hya_data_question q";
        $sql .= " INNER JOIN hya_course_board cb on q.board_id = cb.board_id";
        $sql .= " INNER JOIN hya_course_level cl on q.level_id = cl.level_id";
//        $sql .= " INNER JOIN hya_course_stream cs on q.stream_id = cs.stream_id";
//        $sql .= " INNER JOIN hya_course_course cc on q.course_id = cc.course_id";
//        $sql .= " INNER JOIN hya_course_department cd on q.department_id = cd.department_id";
        $sql .= " INNER JOIN hya_course_subject csu on q.subject_id = csu.subject_id";
//        $sql .= " INNER JOIN hya_course_chapter cch on q.chapter_id = cch.chapter_id";
//        $sql .= " INNER JOIN hya_course_unit cu on q.unit_id = cu.unit_id";
//        $sql .= " INNER JOIN hya_course_subunit csbu on q.subunit_id = csbu.subunit_id";
        
        $sql .= " WHERE q.status='1'";
//        $sql .= " AND (";
////                $sql .= "q.question like '%$keyword%'";
////                $sql .= " OR q.question_type like '%$keyword%'";
////                $sql .= " OR q.question_tag like '%$keyword%'";
//                $sql .= " cb.board_id ='$board_id'";
////                $sql .= " OR cb.board_alias like '%$keyword%'";
////                $sql .= " OR cl.level_name like '%$keyword%'";
////                $sql .= " OR cl.level_type like '%$keyword%'";
////                $sql .= " OR cs.stream_name like '%$keyword%'";
////                $sql .= " OR cc.course_name like '%$keyword%'";
////                $sql .= " OR cc.course_alias like '%$keyword%'";
////                $sql .= " OR cd.department_name like '%$keyword%'";
////                $sql .= " OR cd.department_alias like '%$keyword%'";
//                $sql .= " OR csu.subject_name like '%$keyword%'";
////                $sql .= " OR cch.chapter_name like '%$keyword%'";
////                $sql .= " OR cu.unit_name like '%$keyword%'";
////                $sql .= " OR csbu.subunit_name like '%$keyword%'";
//        $sql .= ")";
        // $sql = "SELECT u.USER_ID, u.USER_TOKEN, u.USERNAME, u.FIRST_NAME, u.LAST_NAME, u.EMAIL, u.ADDRESS, u.HOME_IMAGE, u.ACTIVE, u.CREATED_ON, u.LAST_LOGIN, u.SENT_EMAIL, u.LAST_UPDATE, c.CATEGORY_TITLE, sc.SUBCATEGORY_TITLE FROM tbl_users u INNER JOIN tbl_category c on u.category_id = c.category_id INNER JOIN tbl_category_sub sc on u.sub_cat_id = sc.sub_cat_id WHERE u.c_user_id='$userID' AND (u.username like '%$keyword%' OR u.first_name like '%$keyword%' OR u.last_name like '%$keyword%' OR u.email like '%$keyword%' OR u.address like '%$keyword%' OR c.category_title like '%$keyword%' OR sc.subcategory_title like '%$keyword%')";
        $query = $this->db->query($sql);
    return $query->result();
    }
}