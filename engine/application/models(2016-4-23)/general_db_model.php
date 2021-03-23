<?php
class General_Db_Model extends CI_Model
{ 
    	function __construct()
	{ 
		parent::__construct();
//                    if($this->session->userdata('language')== 'french'){
//                        $database_name = 'fr';
//                    }else{
//                        $database_name = 'default';
//                    }
                $this->db = $this->load->database('default', TRUE); 
	}
	  
	function insert( $table, $array)
	{ 	
		$this->db->set( $array );
		$this->db->insert($table);
                if(!$this->db->insert_id()){
                    return  $this->db->_error_message(); 
                }
		return $this->db->insert_id(); 
	}
	
	function update( $table, $array ,$where)
	{ 
		$this->db->where($where);
		return  $this->db->update($table, $array);
	}
        function updateWhereNot( $table, $array ,$where=null,$whereNot=null)
	{ 
		if(!empty($where)){
                    $this->db->where($where);
                }
                if(!empty($whereNot)){
                    $this->db->where($whereNot);
                }
                
		return  $this->db->update($table, $array);
	}
	
	function delete($table,$where)
	{
	  $this->db->where($where);
	  $this->db->delete($table);
	}
        function deleteWhere($table,$whereField=null,$whereValue=null,$whereField1=null,$whereValue1=null)
	{
            if(!empty($whereValue)){
                $this->db->where($whereField,$whereValue);
            }
            if(!empty($whereValue1)){
                $this->db->where($whereField1,$whereValue1);
            }
	  $this->db->delete($table);
	}
        function delete_users_related($user_id=null){
            $sql ="DELETE u, ug, ut, utq, utqo";
            $sql.=" FROM hya_users AS u";
            $sql.=" LEFT JOIN hya_users_groups AS ug ON ug.user_id = u.user_id";
            $sql.=" LEFT JOIN hya_users_templates AS ut ON ut.user_id = u.user_id OR ut.c_user_id = u.user_id";
            $sql.=" LEFT JOIN hya_users_temp_question AS utq ON utq.user_id = u.user_id";
            $sql.=" LEFT JOIN hya_users_question_option AS utqo ON utqo.user_id = u.user_id";
            $sql.=" LEFT JOIN hya_users_temp_q_a AS utqa ON utqa.user_id = u.user_id";
            $sql.=" WHERE u.user_id = $user_id";
            $query = $this->db->query($sql);
//                return $query->result();
        }
        
//        function getUsers($keyword=null,$userID=null){
//        $sql = "SELECT";
//        $sql .= " u.USER_ID, u.USER_TOKEN, u.USERNAME, u.FIRST_NAME, u.LAST_NAME, u.EMAIL, u.ADDRESS, u.HOME_IMAGE, u.ACTIVE, u.CREATED_ON, u.LAST_LOGIN, u.SENT_EMAIL, u.LAST_UPDATE,";
//        $sql .= " c.CATEGORY_TITLE,";
//        $sql .= " sc.SUBCATEGORY_TITLE";
//        $sql .= " FROM hya_users u";
//        $sql .= " INNER JOIN hya_category c on u.category_id = c.category_id";
//        $sql .= " INNER JOIN hya_category_sub sc on u.sub_cat_id = sc.sub_cat_id";
//        $sql .= " WHERE u.c_user_id='$userID'";
//        $sql .= " AND (";
//                $sql .= "u.username like '%$keyword%'";
//                $sql .= " OR u.first_name like '%$keyword%'";
//                $sql .= " OR u.last_name like '%$keyword%'";
//                $sql .= " OR u.email like '%$keyword%'";
//                $sql .= " OR u.address like '%$keyword%'";
//                $sql .= " OR c.category_title like '%$keyword%'";
//                $sql .= " OR sc.subcategory_title like '%$keyword%'";
//        $sql .= ")";
//        $query = $this->db->query($sql);
//    return $query->result();
//    }

        function get_all_methods($class_name=null){
            return get_class_methods($class_name);
        }
        
        function get_controller_required_methods($moduleControllerName=null,$controller=null,$includeMethods=null){
            
            $this->load->module("$moduleControllerName");//module/contorller
            $allMethods = $this->$controller->get_all_methods("$controller");//controller->get_all_methods(class);
            
            foreach($allMethods as $key=>$value){
                //$check = array('__get','_render_page','valid_csrf_nonce','get_csrf_nonce','__construct','get_all_methods');
                $check = $includeMethods;
                foreach($check as $checkKey => $checkVal){
                    if (strpos($value,$checkVal) !== false) {
                        $existVal[] = $value;
                    }
                }
            }
             $existValues["$moduleControllerName"] = $existVal;
             return $existValues;
        //return $existVal["$controller"];
        }
     
        
//        function getById($table, $where = null) {
//
//                $this->db->where($where);
//            $query = $this->db->get($table);
//            return $query->row();
//        }
	function getById( $table, $fieldId, $id, $select='*')
	{ 
		$this->db->select($select);
		$this->db->where( $fieldId ,$id); 
		$query = $this->db->get( $table ); 
		return $query->row(); 
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
        
	function getAll( $table, $orderBy=NULL, $where=NULL, $select=NULL, $group_by=NULL)
	{ 
		if($select)
		 {
		   $this->db->select($select);
		 }
		
		if($where)
			$this->db->where($where);
		if ($orderBy)
			$this->db->order_by($orderBy);
		
		if($group_by)
		  $this->db->group_by($group_by);
		$query = $this->db->get( $table ); 
		
		return $query->result(); 
	}
        
        //function get_join_result("hya_users u","hya_category c","u.category_id = c.category_id","hya_category_sub sc","u.sub_cat_id = sc.sub_cat_id","u.user_id=4")
        function get_join_result($select="*",$fromTable=null,$innerJoinTable1=null,$onJoinFrom1=null,$innerJoinTable2=null,$onJoinFrom2=null,$where=null){
            $sql = "SELECT";
            $sql .= " $select";
            $sql .= " FROM $fromTable";
            if(!empty($innerJoinTable1)){
                if($innerJoinTable1 && $onJoinFrom1){
                    $sql .= " INNER JOIN $innerJoinTable1 on $onJoinFrom1";
                }
            }
            if(!empty($innerJoinTable2)){
                if($innerJoinTable2 && $onJoinFrom2){
                    $sql .= " INNER JOIN $innerJoinTable2 on $onJoinFrom2";
                }
            }
            if(!empty($where)){
                $sql .= " WHERE $where";
            }
            
            // $sql = "SELECT u.USER_ID, u.USER_TOKEN, u.USERNAME, u.FIRST_NAME, u.LAST_NAME, u.EMAIL, u.ADDRESS, u.HOME_IMAGE, u.ACTIVE, u.CREATED_ON, u.LAST_LOGIN, u.SENT_EMAIL, u.LAST_UPDATE, c.CATEGORY_TITLE, sc.SUBCATEGORY_TITLE FROM hya_users u INNER JOIN hya_category c on u.category_id = c.category_id INNER JOIN hya_category_sub sc on u.sub_cat_id = sc.sub_cat_id WHERE u.c_user_id='$userID' AND (u.username like '%$keyword%' OR u.first_name like '%$keyword%' OR u.last_name like '%$keyword%' OR u.email like '%$keyword%' OR u.address like '%$keyword%' OR c.category_title like '%$keyword%' OR sc.subcategory_title like '%$keyword%')";
            $query = $this->db->query($sql);
        return $query->result();
        }
        
        function get_join_row($select="*",$fromTable=null,$innerJoinTable1=null,$onJoinFrom1=null,$innerJoinTable2=null,$onJoinFrom2=null,$where=null){
            $sql = "SELECT";
            $sql .= " $select";
            $sql .= " FROM $fromTable";
            if(!empty($innerJoinTable1)){
                if($innerJoinTable1 && $onJoinFrom1){
                    $sql .= " INNER JOIN $innerJoinTable1 on $onJoinFrom1";
                }
            }
            if(!empty($innerJoinTable2)){
                if($innerJoinTable2 && $onJoinFrom2){
                    $sql .= " INNER JOIN $innerJoinTable2 on $onJoinFrom2";
                }
            }
            if(!empty($where)){
                $sql .= " WHERE $where";
            }
            
            // $sql = "SELECT u.USER_ID, u.USER_TOKEN, u.USERNAME, u.FIRST_NAME, u.LAST_NAME, u.EMAIL, u.ADDRESS, u.HOME_IMAGE, u.ACTIVE, u.CREATED_ON, u.LAST_LOGIN, u.SENT_EMAIL, u.LAST_UPDATE, c.CATEGORY_TITLE, sc.SUBCATEGORY_TITLE FROM hya_users u INNER JOIN hya_category c on u.category_id = c.category_id INNER JOIN hya_category_sub sc on u.sub_cat_id = sc.sub_cat_id WHERE u.c_user_id='$userID' AND (u.username like '%$keyword%' OR u.first_name like '%$keyword%' OR u.last_name like '%$keyword%' OR u.email like '%$keyword%' OR u.address like '%$keyword%' OR c.category_title like '%$keyword%' OR sc.subcategory_title like '%$keyword%')";
            $query = $this->db->query($sql);
        return $query->row();
        }
        
	function getByWhere( $table, $fieldName, $name, $fieldId, $id)//function getByWhere( $table, $fieldName, $con, $select='*')
	{ 
		//$this->db->select($select);
		//$this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' "); 
                $this->db->where( $fieldName ." = '".$name."' " ."and ". $fieldId."= '". $id ."' " ."and status  = 'Publish' "); 
                
		$query = $this->db->get( $table ); 
		return $query->result(); 
	}
	function getAll_array( $table, $orderBy=NULL, $where=NULL, $select=NULL, $group_by=NULL)
	{ 
		if($select)
		 {
		   $this->db->select($select);
		 }
		
		if($where)
			$this->db->where($where);
		if ($orderBy)
			$this->db->order_by($orderBy);
		
		if($group_by)
		  $this->db->group_by($group_by);
		$query = $this->db->get( $table ); 
		
		return $query->result_array(); 
	}    
	 
	function get_with_limit( $table , $limit, $start ,$orderBy = NULL,$search=NULL) 
	{
		if($search)
		 $this->db->where($search);
		if ($orderBy)
		 $this->db->order_by($orderBy);
		$query = $this->db->get( $table, $limit, $start );
		//print_r($this->db->last_query());
		return $query->result();
		
	}
	
	function countTotal($table, $where=NULL)
	{		
		if($where)
			$this->db->where($where);
		$this->db->from($table);
		return $this->db->count_all_results();
	}
	
	function get_parentName($table, $where=NULL)
	{		
		if($where)
			$this->db->where($where);
		$parentName = $this->db->get($table)->row()->gallery_name;
		//print_r($this->db->last_query()); exit;
		return $parentName;
	}
	
	function getLast($table)
	{
		$query = $this->db->get($table);
		return $query->row();
	}

	function get_attribute($table,$attribute,$where) 
	{ 
		$this->db->select($attribute);
		$this->db->where($where);
		$query = $this->db->get( $table ); 
		if ($query->num_rows() == 1 ) 
			return $query->row(); 
		else if ($query->num_rows() > 1 ) 
			return $query->result(); 
	}
	
	function value_exist($table, $field=null, $value=null,$field1=null, $value1=null)
	{
            if(!empty($value)){
                $this->db->where($field, $value);
            }
            if(!empty($value1)){
                $this->db->where($field1, $value1);
            }
		
		$this->db->from($table);
		if($this->db->count_all_results() > 0)
			return true;
		else
			return false;
	}
        function value_existDepartment($table, $field=null, $value=null,$field1=null, $value1=null,$field2=null, $value2=null)
	{
            if(!empty($value)){
                $this->db->where($field, $value);
            }
            if(!empty($value1)){
                $this->db->where($field1, $value1);
            }
            if(!empty($value2)){
                $this->db->where($field2, $value2);
            }
		
		$this->db->from($table);
		if($this->db->count_all_results() > 0)
			return true;
		else
			return false;
	}
         function value_existChapter($table, $field=null, $value=null,$field1=null, $value1=null,$field2=null, $value2=null,$field3=null, $value3=null,$field4=null, $value4=null,$field5=null, $value5=null)
	{
            if(!empty($value)){
                $this->db->where($field, $value);
            }
            if(!empty($value1)){
                $this->db->where($field1, $value1);
            }
            if(!empty($value2)){
                $this->db->where($field2, $value2);
            }
            if(!empty($value3)){
                $this->db->where($field3, $value3);
            }
            if(!empty($value4)){
                $this->db->where($field4, $value4);
            }
           
		
		$this->db->from($table);
		if($this->db->count_all_results() > 0)
			return true;
		else
			return false;
	}
        function value_existSubject($table, $field=null, $value=null,$field1=null, $value1=null,$field2=null, $value2=null,$field3=null, $value3=null,$field4=null, $value4=null)
	{
            if(!empty($value)){
                $this->db->where($field, $value);
            }
            if(!empty($value1)){
                $this->db->where($field1, $value1);
            }
            if(!empty($value2)){
                $this->db->where($field2, $value2);
            }
            if(!empty($value3)){
                $this->db->where($field3, $value3);
            }
            if(!empty($value4)){
                $this->db->where($field4, $value4);
            }
		
		$this->db->from($table);
		if($this->db->count_all_results() > 0)
			return true;
		else
			return false;
	}
        function value_existMore($table, $field, $value,$field1, $value1)
	{
            if(!empty($value)){
		$this->db->where($field, $value);
            }
            if(!empty($value1)){
		$this->db->where($field1, $value1);
            }
		$this->db->from($table);
		if($this->db->count_all_results() > 0)
			return true;
		else
			return false;
	}
        function value_existThreeMore($table, $field=null, $value=null,$field1=null, $value1=null,$field2=null, $value2=null)
	{
            if(!empty($value)){
		$this->db->where($field, $value);
            }
            if(!empty($value1)){
		$this->db->where($field1, $value1);
            }
            if(!empty($value2)){
		$this->db->where($field2, $value2);
            }
		$this->db->from($table);
		if($this->db->count_all_results() > 0)
			return true;
		else
			return false;
	}
	function value_existNineMore($table, $field=null, $value=null,$field1=null, $value1=null,$field2=null, $value2=null, $field3=null, $value3=null,$field4=null, $value4=null,$field5=null, $value5=null, $field6=null, $value6=null,$field7=null, $value7=null,$field8=null, $value8=null)
	{
            if(!empty($value)){
		$this->db->where($field, $value);
            }
            if(!empty($value1)){
		$this->db->where($field1, $value1);
            }
            if(!empty($value2)){
		$this->db->where($field2, $value2);
            }
            if(!empty($value3)){
		$this->db->where($field3, $value3);
            }
            if(!empty($value4)){
		$this->db->where($field4, $value4);
            }
            if(!empty($value5)){
		$this->db->where($field5, $value5);
            }
            if(!empty($value6)){
		$this->db->where($field6, $value6);
            }
            if(!empty($value7)){
		$this->db->where($field7, $value7);
            }
            if(!empty($value8)){
		$this->db->where($field8, $value8);
            }
		$this->db->from($table);
		if($this->db->count_all_results() > 0)
			return true;
		else
			return false;
	}
	function runQuery($sql) {
		$this->db->query($sql);
	}
	
} 
 
?>