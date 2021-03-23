<?php

class Users_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->table = 'admins';
        $this->tbllog = 'adminslog';
        $this->table2 = 'users';
        $this->tbllog2 = 'userslog';

//                        
//                         $path = trim($_SERVER['REQUEST_URI'], '/');    // Trim leading slash(es)
//                    $elements = explode('/', $path);
//                    $counted = 0;
//                    foreach ($elements as $action) {
//                        $counted++;
//                    }
//                    if($counted>1){
//                        $lang_name = $elements[1];
//                    }else{
//                        $lang_name = '';
//                    }
//                    
//                    if($lang_name != 'fr'){
//                        $database_name = 'default';
//                    }else{
//                        $database_name = 'fr';
//                    }
//                $this->db = $this->load->database($database_name, TRUE); 
    }

    //check valid username and password
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

   function get_byId($table, $fieldName = null, $name = null, $fieldName1 = null, $name1 = null) {

            if (!empty($name)) {
                $this->db->where($fieldName, $name);
            }
            if (!empty($name1)) {
                $this->db->where($fieldName1, $name1);
            }

            $query = $this->db->get($table);
            return $query->row();
        }
        function update_profile( $table, $array ,$field=null, $value=null, $field1=null, $value1=null)
	{ 
		if(!empty($value)){
                    $this->db->where($field, $value);
                }
                if(!empty($value1)){
                    $this->db->where($field1, $value1);
                }
		return  $this->db->update($table, $array);
	}
        
        function value_exist($table, $field=null, $value=null, $field1=null, $value1=null)
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
        function countTotal($table, $field=null, $value=null)
	{		
		 if(!empty($value)){
                    $this->db->where($field, $value);
                }
		$this->db->from($table);
		return $this->db->count_all_results();
	}
    
    function get_byIdLike($table, $fieldName=null, $name=null)
    {
        $this->db->select("*");
            if( $fieldName && $name){
                 $this->db->like( $fieldName, $name);
            }
             //$this->db->where( 'status', 'Publish');
//                if ($orderBy){
//			$this->db->order_by($orderBy,'DESC');
//                }
            //$this->db->where( $fieldId, $id);
            $query = $this->db->get( $table ); 
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
    
    function get_usersDatewise($table, $fieldName1=null, $name1=null, $currentMonth=null,$weekStart=null,$weekEnd=null) {

        if(!empty($name1)){
            $this->db->where($fieldName1, $name1);
        }
        if(!empty($currentMonth)){
            $this->db->like("created_on","-$currentMonth-");
        }
        if(!empty($weekStart)){
            $this->db->where('created_on >=', $weekStart);
            $this->db->where('created_on <=', $weekEnd);
        }
        $query = $this->db->get($table);
        return $query->result();
    }
    
    function getUsers($keyword=null,$userID=null){
        $sql = "SELECT";
        $sql .= " u.USER_ID, u.USER_TOKEN, u.USERNAME, u.FIRST_NAME, u.LAST_NAME, u.EMAIL, u.ADDRESS, u.HOME_IMAGE, u.ACTIVE, u.CREATED_ON, u.LAST_LOGIN, u.SENT_EMAIL, u.LAST_UPDATE,";
        $sql .= " c.CATEGORY_TITLE,";
        $sql .= " sc.SUBCATEGORY_TITLE";
        $sql .= " FROM tbl_users u";
        $sql .= " INNER JOIN tbl_category c on u.category_id = c.category_id";
        $sql .= " INNER JOIN tbl_category_sub sc on u.sub_cat_id = sc.sub_cat_id";
        $sql .= " WHERE u.c_user_id='$userID'";
        $sql .= " AND (";
                $sql .= "u.username like '%$keyword%'";
                $sql .= " OR u.first_name like '%$keyword%'";
                $sql .= " OR u.last_name like '%$keyword%'";
                $sql .= " OR u.email like '%$keyword%'";
                $sql .= " OR u.address like '%$keyword%'";
                $sql .= " OR c.category_title like '%$keyword%'";
                $sql .= " OR sc.subcategory_title like '%$keyword%'";
        $sql .= ")";
        // $sql = "SELECT u.USER_ID, u.USER_TOKEN, u.USERNAME, u.FIRST_NAME, u.LAST_NAME, u.EMAIL, u.ADDRESS, u.HOME_IMAGE, u.ACTIVE, u.CREATED_ON, u.LAST_LOGIN, u.SENT_EMAIL, u.LAST_UPDATE, c.CATEGORY_TITLE, sc.SUBCATEGORY_TITLE FROM tbl_users u INNER JOIN tbl_category c on u.category_id = c.category_id INNER JOIN tbl_category_sub sc on u.sub_cat_id = sc.sub_cat_id WHERE u.c_user_id='$userID' AND (u.username like '%$keyword%' OR u.first_name like '%$keyword%' OR u.last_name like '%$keyword%' OR u.email like '%$keyword%' OR u.address like '%$keyword%' OR c.category_title like '%$keyword%' OR sc.subcategory_title like '%$keyword%')";
        $query = $this->db->query($sql);
    return $query->result();
    }
    function getGroups($keyword=null,$userID=null){
        /*
        $sql = "SELECT";
        $sql .= " g.GROUP_ID, g.C_USER_ID, g.GROUP_TYPE, g.NAME, g.DESCRIPTION,";
        //$sql .= " u.USERNAME,u.FIRST_NAME,u.LAST_NAME,";
        //$sql .= " ug.USER_ID,ug.GROUP_ID";
        $sql .= " FROM tbl_groups g";
        $sql .= " INNER JOIN tbl_users_groups ug on g.group_id = ug.group_id";
        $sql .= " INNER JOIN tbl_users u on ug.user_id = u.user_id";
        $sql .= " WHERE g.c_user_id='$userID'";
        $sql .= " AND (";
                $sql .= " u.username like '%$keyword%'";
                $sql .= " OR u.first_name like '%$keyword%'";
                $sql .= " OR u.last_name like '%$keyword%'";
                $sql .= " OR u.email like '%$keyword%'";
                $sql .= " OR g.name like '%$keyword%'";
        $sql .= ")";
        */
        $sql = "SELECT GROUP_ID, C_USER_ID, GROUP_TYPE, NAME,DESCRIPTION FROM tbl_groups WHERE c_user_id='$userID' AND name like '%$keyword%'";
        $query = $this->db->query($sql);
    return $query->result();
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
    function get_row($table, $fieldName=null, $name=null,$fieldName1=null, $name1=null)
    {
            $this->db->select('*');
            if (!empty($name)) {
                $this->db->where($fieldName, $name);
            } 
            if (!empty($name1)) {
                $this->db->where($fieldName1, $name1);
            }
            $query = $this->db->get($table);
            return $query->row();
    }
    function get_result($table, $fieldName=null, $name=null,$fieldName1=null, $name1=null,$orderBy=null)
    {
            $this->db->select('*');
            if (!empty($name)) {
                $this->db->where($fieldName, $name);
            } 
            if (!empty($name1)) {
                $this->db->where($fieldName1, $name1);
            }
            if ($orderBy){
                    $this->db->order_by($orderBy,'ASC');
            }
            $query = $this->db->get($table);
            return $query->result();
    }
    function get_results($table, $fieldName = null, $name = null,$fieldName1 = null, $name1 = null, $order = null) {

        if (!empty($name)) {
            $this->db->where($fieldName, $name);
        } 
        if (!empty($name1)) {
            $this->db->where($fieldName1, $name1);
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

    function checkteachers($username, $password, $loginAs = null) {
        $email = @strpos($username, "@");

        if ($email !== false) {
            $this->db->where('user_email', $username);
        } else {
            $this->db->where('username', $username);
        }
        if (!empty($loginAs)) {
            $this->db->where('user_type', $loginAs);
        }
        $this->db->where('user_status', "Publish");
        $this->db->where('password', $password);
        return $this->db->get('tbl_users');
    }

    function users_checkuser($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        return $this->db->get($this->table2);
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

//    function get_results($table, $fieldName = NULL, $name = NULL, $fieldName1 = NULL, $name1 = NULL, $orderBy = NULL, $group_by = NULL) {
//        $this->db->select("*");
//
//        if ($fieldName) {
//            $this->db->where($fieldName, $name);
//        }
//        if ($fieldName1) {
//            $this->db->where($fieldName1, $name1);
//        }
//        if ($orderBy) {
//            $this->db->order_by($orderBy);
//        }
//        if ($group_by) {
//            $this->db->group_by($group_by);
//        }
//        $query = $this->db->get($table);
//
//        return $query->result();
//    }

    

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

    function update_template($table, $array, $fieldName = null, $name = null, $fieldName1 = null, $name1 = null) {
        if ($fieldName && $name) {
            $this->db->where($fieldName, $name);
        }
        if ($fieldName1 && $name1) {
            $this->db->where($fieldName1, $name1);
        }
        return $this->db->update($table, $array);
    }

}

?>