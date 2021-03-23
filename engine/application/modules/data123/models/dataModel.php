<?php
class DataModel extends CI_Model{
	
    function __construct(){
            parent::__construct();
            $this->table1="hya_course_board";
            $this->table2="hya_course_level";
            $this->table3="hya_course_stream";
            $this->table4="hya_course_department";
            $this->table5="hya_course_subject";
            $this->table6="hya_course_chapter";
            $this->table7="hya_course_unit";
            $this->table8="hya_course_course";

    } 
}