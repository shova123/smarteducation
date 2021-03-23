<?php
class Course_model extends CI_Model{
	
    function __construct(){
            parent::__construct();
            $this->table1="hya_course_board";
            $this->table2="hya_course_level";
            $this->table3="hya_course_stream";
            $this->table4="hya_course_course";
            $this->table5="hya_course_department";
            $this->table6="hya_course_subject";
            $this->table7="hya_course_chapter";
            $this->table8="hya_course_unit";
            $this->table9="hya_course_course";

    } 
    
    function get_board()
    {
        $this->db->select('*');
        $this->db->from($this->table1);
//        $this->db->where('status',1);
        $this->db->order_by('created_date','DESC');
        $result=$this->db->get();
        return $result->result();
    }
    function get_level()
    {
        $this->db->select('*');
        $this->db->from($this->table2." as l");
        $this->db->order_by('l.order','ASC');
        $result=$this->db->get();
        return $result->result();
    }
    
    function allOrder($order){
        $this->db->select('*');
        $this->db->from($this->table2." as l");
        $this->db->where('l.order >=',$order);
        $result=$this->db->get();
        return $result->result();
    }
    function allMoreThanOrder($table,$order){
        $this->db->select('*');
        //$this->db->from($this->table2." as l");
        $this->db->where('order >=',$order);
        //$this->db->where('l.order >=',$order);
        $result=$this->db->get($table);
        return $result->result();
    }
    function get_stream()
    {
        $this->db->select('*');
        $this->db->from($this->table3." as s");
        $this->db->join($this->table2." as l","s.level_id=l.level_id");
        $this->db->order_by('l.order');
        $this->db->order_by('s.created_date');
        $result=$this->db->get();
       // echo $this->db->last_query();
        return $result->result();
    }
    function get_department()
    {
        $this->db->select('*');
        $this->db->from($this->table5." as l");
        $this->db->order_by('l.created_at','DESC');
        $result=$this->db->get();
        return $result->result();
    }
    function get_course()
    {
        $this->db->select('*');
        $this->db->from($this->table9." as c");
         $this->db->order_by('c.created_at','DESC');
        $result=$this->db->get();
        return $result->result();
    }
    function get_subject()
    {
        $this->db->select('*');
        $this->db->from($this->table6." as s");
//        $this->db->join('course_board as b','s.board_id=b.id');
//        $this->db->join('course_level as l','s.level_id=l.level_id');
//        $this->db->join('course_stream as st','s.stream_id=st.stream_id');
//        $this->db->join('course_department as d','s.department_id=d.department_id');
        $this->db->order_by('s.created_at','DESC');
        $result=$this->db->get();
        return $result->result();
    }
    function get_chapter()
    {
        $this->db->select('*');
        $this->db->from($this->table7." as s");
//        $this->db->join('course_board as b','s.board_id=b.id');
//        $this->db->join('course_level as l','s.level_id=l.level_id');
//        $this->db->join('course_stream as st','s.stream_id=st.stream_id');
//        $this->db->join('course_department as d','s.department_id=d.department_id');
        $this->db->order_by('s.created_at','DESC');
        $result=$this->db->get();
        return $result->result();
    }
        function get_unit()
    {
        $this->db->select('*');
        $this->db->from($this->table8." as u");
        $this->db->order_by('u.created_at','ASC');
        $result=$this->db->get();
        return $result->result();
    }
        function get_subunit($id)
    {
        $this->db->select('*');
        $this->db->from("hya_course_subunit as u");
        $this->db->where("u.unit_id",$id);
        $this->db->order_by('u.created_at','ASC');
        $result=$this->db->get();
        return $result->result();
    }
     
    function get_row($table,$fieldName=null,$fieldValue=null,$fieldName1=null,$fieldValue1=null)
    {
        $this->db->select('*');
        $this->db->from($table);
        if(!empty($fieldValue)){
            $this->db->where( $fieldName, $fieldValue);
        }
        if(!empty($fieldValue1)){
            $this->db->where( $fieldName1, $fieldValue1);
        }
        if(!empty($orderBy)){        
            $this->db->order_by($orderBy,'asc');
        }
        
        $result=$this->db->get();
        return $result->row();
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
    
    function get_resultsNINE($table, $fieldName1=null, $name1=null,$fieldName2=null, $name2=null,$fieldName3=null, $name3=null,$fieldName4=null, $name4=null,$fieldName5=null, $name5=null,$fieldName6=null, $name6=null,$fieldName7=null, $name7=null,$fieldName8=null, $name8=null,$fieldName9=null, $name9=null,$order=null)
    {
        $this->db->select("*");
        if(!empty($name1)){$this->db->where( $fieldName1, $name1);}
        if(!empty($name2)){$this->db->where( $fieldName2, $name2);}
        if(!empty($name3)){$this->db->where( $fieldName3, $name3);}
        if(!empty($name4)){$this->db->where( $fieldName4, $name4);}
        if(!empty($name5)){$this->db->where( $fieldName5, $name5);}
        if(!empty($name6)){$this->db->where( $fieldName6, $name6);}
        if(!empty($name7)){$this->db->where( $fieldName7, $name7);}
        if(!empty($name8)){$this->db->where( $fieldName8, $name8);}
        if(!empty($name9)){$this->db->where( $fieldName9, $name9);}
        
        if(!empty($order)){        
            $this->db->order_by($order,'asc');
        }
        $query = $this->db->get( $table ); 
        return $query->result();
    }
    
    
    function getJoinResult($select="*",$fromTable=null,$innerJoinTable1=null,$onJoinFrom1=null,$innerJoinTable2=null,$onJoinFrom2=null,$innerJoinTable3=null,$onJoinFrom3=null,$whereField=null,$order=null){
            $sql = "SELECT";
            $sql .= " $select";
            $sql .= " FROM $fromTable";//FROM tbl_users_temp_q_a tqa
            if(!empty($innerJoinTable1)){
                if($innerJoinTable1 && $onJoinFrom1){
                    $sql .= " INNER JOIN $innerJoinTable1 on $onJoinFrom1";// INNER JOIN tbl_users_templates ut on tqa.temp_id = ut.temp_id
                }
            }
            if(!empty($innerJoinTable2)){
                if($innerJoinTable2 && $onJoinFrom2){
                    $sql .= " INNER JOIN $innerJoinTable2 on $onJoinFrom2";// INNER JOIN tbl_users_templates ut on tqa.temp_id = ut.temp_id
                }
            }
            if(!empty($innerJoinTable3)){
                if($innerJoinTable3 && $onJoinFrom3){
                    $sql .= " INNER JOIN $innerJoinTable3 on $onJoinFrom3";
                }
            }
            
            if(!empty($whereField)){
                $sql .= " WHERE $whereField";// WHERE ut.c_user_id='$creatorUserId'
            }
             
            if(!empty($order)){
                //$this->db->order_by('l.order','ASC');
                $sql .= " ORDER BY $order";//ORDER BY order ASC
            }
            
//            if(!empty($currentMonth)){
//                $sql .= " AND tqa.date LIKE '%-$currentMonth-%'";
//            }
//            if(!empty($weekStart)){
//                $sql .= " AND tqa.date >= '$weekStart'";
//                $sql .= " AND tqa.date <= '$weekEnd'";
//            }
            //$sql .= " GROUP BY tqa.temp_id,ut.temp_id";
            $query = $this->db->query($sql);
        return $query->result();
        }
    
}
