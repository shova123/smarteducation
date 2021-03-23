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
}