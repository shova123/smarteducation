<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('signin_model');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    public function get_all_methods($class_name = null) {
        return get_class_methods($class_name);
    }

    function index() {
        $data['page_name'] = 'dashboard';
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect("signin/login", 'refresh');
        } else{
            //if ($this->ion_auth->has_permission("signin/signin", 'index', $this->ion_auth->get_user_id())) {
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];
            //set the flash data error message if there is one
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            if ($this->session->userdata('user_id') != "") {
                $userID = $this->session->userdata('user_id');
            }
            $data['users_details'] = $this->signin_model->get_admins('users', 'user_id', $userID);
            $data['users_groups'] = $users_groups = $this->signin_model->get_results('users_groups', 'user_id', $userID, 'id');
            $groupsName = '';
            foreach ($users_groups as $values) {
                $groupID = $values->group_id;
                $group_details = $this->signin_model->get_admins('groups', 'group_id', $groupID);
                $groupName = $group_details->name;
                $groupsName.= "$groupName,";
            }$trimGroupName = trim($groupsName, ',');
            $this->session->set_userdata(array('groupNames' => $trimGroupName));
            //list the users
            $data['users'] = $this->ion_auth->users()->result();
            foreach ($data['users'] as $k => $user) {
                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->user_id)->result();
            }

            $redirectController = "signin";
            redirect("$redirectController/$groupTypeDashboardName" . "_dashboard", 'location');
        } 
//        else {
////            return show_error('You Dont have permission to view this page.');
//            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
//            redirect("signin/login", 'refresh');
//        }
    }

    function superAdmin_dashboard() {

        $data['page_name'] = 'dashboard';
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'superAdmin_dashboard', $this->ion_auth->get_user_id())) {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            if ($this->session->userdata('user_id') != "") {
                $userID = $this->session->userdata('user_id');
            }
            $data['users_details'] = $this->signin_model->get_admins('users', 'user_id', $userID);
            $data['users_groups'] = $users_groups = $this->signin_model->get_results('users_groups', 'user_id', $userID, 'id');
            $groupsName = '';
            foreach ($users_groups as $values) {
                $groupID = $values->group_id;
                $group_details = $this->signin_model->get_admins('groups', 'group_id', $groupID);
                $groupName = $group_details->name;
                $groupsName.= "$groupName,";
            }$trimGroupName = trim($groupsName, ',');
            $this->session->set_userdata(array('groupNames' => $trimGroupName));
            $data['users'] = $this->ion_auth->users()->result();
            foreach ($data['users'] as $k => $user) {

                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->user_id)->result();
            }
            
            $data['current'] = 1;
            
            $this->_render_template("superAdmin_dashboard", $data);
        } else {
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    function manager_dashboard() {
        $data['page_name'] = 'dashboard';
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'manager_dashboard', $this->ion_auth->get_user_id())) {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            if ($this->session->userdata('user_id') != "") {
                $userID = $this->session->userdata('user_id');
            }
            $data['users_details'] = $this->signin_model->get_admins('users', 'user_id', $userID);
            $data['users_groups'] = $users_groups = $this->signin_model->get_results('users_groups', 'user_id', $userID, 'id');
            $groupsName = '';
            foreach ($users_groups as $values) {
                $groupID = $values->group_id;
                $group_details = $this->signin_model->get_admins('groups', 'group_id', $groupID);
                $groupName = $group_details->name;
                $groupsName.= "$groupName,";
            }$trimGroupName = trim($groupsName, ',');
            $this->session->set_userdata(array('groupNames' => $trimGroupName));
            //$data['users'] = $this->ion_auth->users()->result();
            $groupsType = array('manager', 'clients', 'users');
            $data['users'] = $this->ion_auth->users_groupType($groupsType)->result();
            foreach ($data['users'] as $k => $user) {

                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->user_id)->result();
            }
            $this->_render_template("manager_dashboard", $data);
        } else {
           $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    function clients_dashboard() {
        $data['page_name'] = 'dashboard';
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'clients_dashboard', $this->ion_auth->get_user_id())) {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $loginUserID = $userID = $this->ion_auth->get_user_id();

            $data['users_details'] = $this->signin_model->get_admins('users', 'user_id', $userID);
            $data['users_groups'] = $users_groups = $this->signin_model->get_results('users_groups', 'user_id', $userID, 'id');
            $groupsName = '';
            foreach ($users_groups as $values) {
                $groupID = $values->group_id;
                $group_details = $this->signin_model->get_admins('groups', 'group_id', $groupID);
                $groupName = $group_details->name;
                $groupsName.= "$groupName,";
            }$trimGroupName = trim($groupsName, ',');
            $this->session->set_userdata(array('groupNames' => $trimGroupName));
            $groupsType = array('clients', 'users');
            $data['clients_users'] = $this->ion_auth->users_groupType($groupsType)->result();

            $data['clients'] = $this->ion_auth->users_groupType("clients")->result();
            $userWhere = "c_user_id = $loginUserID"; //where creator user id is client or not
            $data['users'] = $this->ion_auth->users_groupType("users", $userWhere)->result();

            //$data['templates'] = $this->signin_model->get_templates('users_templates', 'status', 'Publish');
            $templateWhere = "c_user_id = '$loginUserID' OR user_id = '$loginUserID'"; //where creator user id is client or not
            $data['templates'] = $this->signin_model->get_templatesWhereOr('users_templates',$templateWhere, 'status', 'Publish');
            //$data['users'] = $this->ion_auth->users()->result();
            foreach ($data['users'] as $k => $user) {
                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->user_id)->result();
            }
            $data['bootstropID1'] = 0;
            $data['bootstropID2'] = 1;
            $data['bootstropID3'] = 2;
            $data['bootstropID4'] = 3;
            $data['bootstropID5'] = 4;
            
            $data['bootstropID6'] = 5;
            $data['bootstropID7'] = 6;
            $data['bootstropID8'] = 7;
            $data['bootstropID9'] = 8;
            $data['bootstropID10'] = 9;
            $data['bootstropID11'] = 10;
            $data['bootstropID12'] = 11;
            $data['bootstropID13'] = 12;
            $data['bootstropID14'] = 13;
            $data['bootstropID15'] = 14;
            
            $this->_render_template_front_dashboard("clients_dashboard", $data);
        } else {
           $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    function users_dashboard() {
        $data['page_name'] = 'Teachers Dashboard';
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'users_dashboard', $this->ion_auth->get_user_id())) {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            if ($this->session->userdata('user_id') != "") {
                $userID = $this->session->userdata('user_id');
                $login_userID = $this->ion_auth->get_user_id();
            }
            $data['users_details'] = $this->signin_model->get_admins('users', 'user_id', $userID);
            $data['users_groups'] = $users_groups = $this->signin_model->get_results('users_groups', 'user_id', $userID, 'id');
            $groupsName = '';
            foreach ($users_groups as $values) {
                $groupID = $values->group_id;
                $group_details = $this->signin_model->get_admins('groups', 'group_id', $groupID);
                $groupName = $group_details->name;
                $groupsName.= "$groupName,";
            }$trimGroupName = trim($groupsName, ',');
            $this->session->set_userdata(array('groupNames' => $trimGroupName));
            $groupsType = array('clients', 'users');
            $data['users'] = $this->ion_auth->users_groupType($groupsType)->result();
            //$data['users'] = $this->ion_auth->users()->result();
            $data['templates_list'] = $template_lists = $this->signin_model->get_templates('users_templates', 'user_id', $login_userID);
            foreach ($data['users'] as $k => $user) {
                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->user_id)->result();
            }
            $data['bootstropID1'] = 0;
            $data['bootstropID2'] = 1;
            $data['bootstropID3'] = 2;
            $data['bootstropID4'] = 3;

            $this->_render_template_front_dashboard("users_dashboard", $data);
        } else {
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }
/*
    function user($groups = null) {
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else{
            //if ($this->ion_auth->has_permission("signin/signin", 'users', $this->ion_auth->get_user_id())) {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            if ($this->session->userdata('user_id') != "") {
                $userID = $this->session->userdata('user_id');
            }
            $data['users_details'] = $this->signin_model->get_admins('users', 'user_id', $userID);
////////////////////////// finding groups in table_users_groups with the login user ID
            $data['users_groups'] = $users_groups = $this->signin_model->get_results('users_groups', 'user_id', $userID, 'id');
            $groupsName = '';
            foreach ($users_groups as $values) {
                $groupID = $values->group_id;
                $group_details = $this->signin_model->get_admins('groups', 'group_id', $groupID);
                $groupName = $group_details->name;
                $groupsName.= "$groupName,";
            }$trimGroupName = trim($groupsName, ',');
            $this->session->set_userdata(array('groupNames' => $trimGroupName));
////////////////////////// finding groups in table_users_groups with the login user ID
            //$groups = array('users');
            $data['users'] = $this->ion_auth->users_groupType($groups)->result();
            foreach ($data['users'] as $k => $user) {
                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->user_id)->result();
            }
            if($groups == 'clients'){
               $data['current'] = 3;
               $data['sub_current'] = 1; 
            }elseif($groups == 'manager'){
               $data['current'] = 3;
               $data['sub_current'] = 2; 
            }elseif($groups == 'users'){
               $data['current'] = 4;
               //$data['sub_current'] = 2; 
            }
            $this->_render_template("users_list", $data);
        }
//        else { 
//            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
//            redirect("signin/login", 'refresh');
//        }
    }

    function users($categoryToken = null, $subCategoryToken = null) {

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('signin/login', 'refresh');
        } else{ 
            //if ($this->ion_auth->has_permission("signin/signin", 'users', $this->ion_auth->get_user_id())) {
            $categoryId = null;
            if (!empty($categoryToken)) {
                $categoryDetails = $this->signin_model->get_byId('category', 'token', $categoryToken);
                $categoryId = $categoryDetails->category_id;
            }
            $subCategoryId = null;
            if (!empty($subCategoryToken)) {
                $subCategoryDetails = $this->signin_model->get_byId('category_sub', 'token', $subCategoryToken);
                $subCategoryId = $subCategoryDetails->sub_cat_id;
            }
            //set the flash data error message if there is one
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            if ($this->session->userdata('user_id') != "") {
                $userID = $this->session->userdata('user_id');
            }

////////////////////////// finding groups in table_users_groups with the login user ID
            $data['users_groups'] = $users_groups = $this->signin_model->get_results('users_groups', 'user_id', $userID, 'id');
            $groupsName = '';
            foreach ($users_groups as $values) {
                $groupID = $values->group_id;
                $group_details = $this->signin_model->get_admins('groups', 'group_id', $groupID);
                $groupName = $group_details->name;
                $groupsName.= "$groupName,";
            }$trimGroupName = trim($groupsName, ',');
            $this->session->set_userdata(array('groupNames' => $trimGroupName));
////////////////////////// finding groups in table_users_groups with the login user ID
            //list the users
            //$groups = array('users');
//            $data['users'] = $this->ion_auth->users_groupType($groups)->result();
//            if(is_string($categoryToken)){
//                $groups = $categoryToken;
//             $data['users'] = $this->ion_auth->users_groupType($groups)->result();   
//            }else{
//            $data['users'] = $this->signin_model->get_users('users','category_id', $categoryId,'sub_cat_id', $subCategoryId);
//            }
            $data['users'] = $this->signin_model->get_users('users', 'category_id', $categoryId, 'sub_cat_id', $subCategoryId);
            
            foreach ($data['users'] as $k => $user) {
                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->user_id)->result();
            }
            $this->_render_template("users_list", $data);
            //$this->template->load('template', 'users_list', $data);
            //$this->_render_page('signin/index', $data);
        } 
//        else { 
//            
//            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
//            redirect("signin/login", 'refresh');
//        }
    }
*/
    function send_user_email($user_token = null) {
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'send_user_email', $this->ion_auth->get_user_id())) {


            $data['title'] = "Send Email to Users";

            $users_details = $this->signin_model->get_byId('users', 'user_token', $user_token);
            $id = $users_details->user_id;

            if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->user_id == $id ) )) {
                redirect("signin", 'refresh');
            }

            $userDetails = $this->ion_auth->user($id)->row();
            $groups = $this->ion_auth->groups()->result_array(); //list all the groups on the database
            $currentGroups = $this->ion_auth->get_users_groups($id)->result(); //current groups of the user id 

            $userName = $userDetails->username;
            $userFirstName = $userDetails->first_name;
            $userLastName = $userDetails->last_name;
            $userFullName = ucfirst("$userFirstName $userLastName");
            $userPassword = $this->ion_auth->generateRandomString(8); //generate password  from ion_auth MOdel;
            $userEmail = $userDetails->email;

            ////////////// $salt       = $this->store_salt ? $this->salt() : FALSE;
            ////////////// $password   = $this->hash_password($userPassword, $salt);
            $password = $this->ion_auth->create_password($userPassword); // hash the password in ion auth_model


            $post['active'] = '1';
            $post['password'] = $password;
            //$post['sent_email'] = '1';
            $this->general_db_model->update('users', $post, 'user_id = ' . $id);

            $adminsEmail = $this->signin_model->get_emailId('admins');
            $from = $adminsEmail->email;
            $headerinfo_users = $adminsEmail->headerinfo_users;

            $message = "<table width='570' border='0' cellspacing='0' cellpadding='0' align='center' style='color:#1ABE67'>
                                $headerinfo_users
                                <tr>
                                    <td width='188' height='30' class='txt3'>User Name </td>
                                    <td width='382' height='30'><label>
                                    $userName
                                    </label></td>
                                    </tr>
                                <tr>
                                    <td height='30' class='txt3'>Password </td>
                                    <td height='30'><label>
                                    $userPassword (Please Change Your Password)
                                    </label></td>
                                </tr>
                                <tr>
                                    <td width='188' height='30' class='txt3'>Your Email</td>
                                    <td width='382' height='30'><label>
                                    $userEmail
                                    </label></td>
                                </tr>
                    ";
            //print_r($message);die;
            //============================
            $config = array();
            $config['useragent'] = "CodeIgniter";
            $config['mailpath'] = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
            $config['protocol'] = "smtp";
            $config['smtp_host'] = "localhost";
            $config['smtp_port'] = "25";
            $config['mailtype'] = 'html';
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['wordwrap'] = FALSE;

            $this->load->helper(array('email'));
            $this->load->library(array('email'));
            $this->email->initialize($config);
            $this->email->from($from, "Account Activation");
            $this->email->to($userEmail);
            $this->email->subject("User Details");
            $this->email->message($message);
            //echo print_r($this->email->print_debugger(), true);
            //$this->email->send();
            //                                    if($this->email->send() == true){
            //                                        $data['message'] = "Your message has been send to Administrator we will be in touch";
            //                                    } else {
            //                                        $data['message'] = "Your message has not been send Please Try again !!!";
            //                                    }

            if ($this->email->send() == true) {
                $post['sent_email'] = '1';
                $this->general_db_model->update('users', $post, 'user_id = ' . $id);

                $this->session->set_flashdata('message', "Your message has been send to $userFullName with their user details and password Set");
            } else {
                $post['sent_email'] = '0';
                $this->general_db_model->update('users', $post, 'user_id = ' . $id);

                $this->session->set_flashdata('message', "Your message has not been send to $userFullName Please Try again !!!");
            }

            redirect("signin/users/users");
        } else { 
            
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

//    function templates_list($categoryToken = null, $subCategoryToken = null) {
//        if (!$this->ion_auth->logged_in()) {
//            redirect('signin/login', 'refresh');
//        } else if ($this->ion_auth->has_permission("signin/signin", 'templates_list', $this->ion_auth->get_user_id())) {
//            $categoryId = null;
//            if (!empty($categoryToken)) {
//                $categoryDetails = $this->signin_model->get_byId('category', 'token', $categoryToken);
//                $categoryId = $categoryDetails->category_id;
//            }
//            $subCategoryId = null;
//            if (!empty($subCategoryToken)) {
//                $subCategoryDetails = $this->signin_model->get_byId('category_sub', 'token', $subCategoryToken);
//                $subCategoryId = $subCategoryDetails->sub_cat_id;
//            }
//            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
//            if ($this->session->userdata('user_id') != "") {
//                $userID = $this->session->userdata('user_id');
//            }
//
//            $data['templates_list'] = $this->signin_model->get_templates('users_templates', 'category_id', $categoryId, 'sub_cat_id', $subCategoryId);
//
//            $this->_render_template("templates_list", $data);
//            //$this->template->load('template', 'users_list', $data);
//            //$this->_render_page('signin/index', $data);
//        } else {
//            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
//            redirect("signin/login", 'refresh');
//        }
//    }
 
/*
    function templates_list() {
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'templates_list', $this->ion_auth->get_user_id())) {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            if ($this->session->userdata('user_id') != "") {
                $userID = $this->session->userdata('user_id');
            }

            $data['templates_list'] = $this->signin_model->get_templates('users_templates');
            $data['current'] = 5;
            //$data['sub_current'] = 2; 
            $this->_render_template("templates_list", $data);
        } else {
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    function template_add($link = null) {
        //if($this->session->userdata('users_user_id') !=''){
        //$login_userID = $this->session->userdata('users_user_id');
        //$login_userTYPE = $this->session->userdata('users_user_type');
        //$login_userNAME = $this->session->userdata('users_name');
        if ($this->input->post('submitTemplate')) {

            $this->add_edit_template();
            die();
        }

        $data['page_title'] = 'Add package';
        $data['link'] = $link;
        $data['current'] = 6;
        $this->load->helper('directory');
        $this->load->helper('file');
        $map = directory_map('./resources/email_templates/');
        $a = "./resources/email_templates/Basic/Basic Template 2/index.html ";
        $data['folder'] = $map;

        //list the users
        //$groups = array('teachers');
        $data['users'] = $this->ion_auth->users("users")->result();
        $data['category_list'] = $this->signin_model->get_result("category", 'category_type', 'sub_category');
        $data['sub_category_list'] = $this->signin_model->get_result("category_sub");
        $this->template->load('template', 'templates_form', @$data);
        //}
    }

    function template_edit($tempToken, $link = NULL) {
        $data["subject"] = "edit";
        //if($this->session->userdata('users_user_id') !=''){
        //$login_userID = $data['login_userID']= $this->session->userdata('users_user_id');
        //$login_userTYPE = $this->session->userdata('users_user_type');
        //$login_userNAME = $this->session->userdata('users_name');

        if ($this->input->post('submitTemplate')) {
            $this->add_edit_template($tempToken, $link);
            die();
        }
        $data['template_details'] = $template_details = $this->signin_model->getByRows('users_templates', 'token', $tempToken); //,"user_id",$login_userID	
        $temp_id = $template_details->temp_id;
        $template = $template_details->template_path;
        $category_id = $template_details->category_id;
        $sub_cat_id = $template_details->sub_cat_id;


        //$data['template_question'] = $template_question = $this->signin_model->get_templates('users_temp_question', 'temp_id', $temp_id,"user_id",$login_userID);	
        //echo "<pre>";
        //print_r($template_question);die;

        $this->load->helper('directory');
        $this->load->helper('file');
        $map = directory_map('./resources/email_templates/');
        $a = "./resources/email_templates/Basic/Basic Template 2/index.html ";
        $data['folder'] = $map;

        $data['page_title'] = "Edit Template";
        $data['link'] = $link;
        $data['current'] = 6;
        $data['template'] = $template;
        $data['users'] = $this->ion_auth->users("users")->result();
        $data['category_list'] = $this->signin_model->get_result("category", 'category_type', 'sub_category');
        $data['sub_category_list'] = $this->signin_model->get_result("category_sub", 'category_id', $category_id);
        $this->template->load('template', 'templates_form', @$data);
        //}
    }

    function add_edit_template($temp_token = NULL, $redirections = NULL) {
        //if($this->session->userdata('users_user_id') !=''){
        //$login_userID = $this->session->userdata('users_user_id');
        //$login_userTYPE = $this->session->userdata('users_user_type');
        //$login_userNAME = $this->session->userdata('users_name');
//        echo "<pre>";
//        print_r($_POST);die;
        $post['token'] = $templateToken = $this->input->post('token');
        $post['user_id'] = $login_userID = $this->input->post('user_id');
        $post['storage_type'] = $storage_type = $this->input->post('storage_type');
        $post['template_title'] = $this->input->post('template_title');
        $post['template_path'] = $this->input->post('template_path'); // the real path of the template /Airmail/Left Sidebar/
        $post['html_content'] = $this->input->post('html_content');
        $post['template_description'] = $this->input->post('template_description');
        $post['order'] = $this->input->post('temp_order');
        $post['status'] = $this->input->post('status');


//        echo "<pre>";
//        print_r($_POST);die;
        $questionsARRiD = $this->input->post('questionID');
        $questionsARR = $this->input->post('questionField');
        $totalQuestion = @count(@array_filter($questionsARR));
        $Q_orderARR = $this->input->post('order');
        $Q_typeARR = $this->input->post('type');
        $Ans_numberARRiD = $this->input->post('answerID');
        $Ans_numberARR = $this->input->post('ansOptions');
        $totalAnswer = @count(@array_filter($Ans_numberARR));
        //$post2['option_1_1'] = $this->input->post('option_1_1');

        $post['created_date'] = $postQ['created_date'] = $postAns['created_date'] = date("Y-m-d");

        if (!empty($temp_token)) {
            $tempDetails = $this->general_model->getById('users_templates', 'token', $temp_token);
            $tempID = $tempDetails->temp_id;
            if (!empty($tempID)) {
                $this->general_model->update('users_templates', $post, 'temp_id = ' . $tempID);
                $nextLoop = '';
                $questionNUM = 1;
                for ($i = 0; $i < $totalQuestion; $i++) {
                    //$postQ['user_id'] = $login_userID;// User Id
                    //$postQ['temp_id'] = $templateID;// Question order
                    $QiD = $questionsARRiD[$i];
                    $postQ['order'] = $Q_orderARR[$i]; // Question order
                    $postQ['q_title'] = $questionsARR[$i]; //Question Title
                    $postQ['type'] = $optionType = $Q_typeARR[$i]; //Option Type
                    $this->general_model->update('users_temp_question', $postQ, 'q_id = ' . $QiD);
                    $Question_id = $QiD; //$this->db->insert_id();
                    $answerLOOP = $Ans_numberARR[$i]; // number of Option selected
                    $initial = "";
                    if ($i == 0) {
                        $initial = 0;
                    } else {
                        $k = $i - 1;
                        $RR = $answerLOOP - 1; // number of Option selected
                        $initial = $RR;
                    }
                    $optionID = "";
                    for ($j = 1; $j <= $answerLOOP; $j++) {
                        $optionID = @$Ans_numberARRiD[$initial];
                        if (!empty($optionID)) {
                            $valuedOPtion = "option_" . $questionNUM . "_" . $j;
                            $postAns['option_title'] = $this->input->post("$valuedOPtion");
                            //$postAns['user_id'] = $login_userID;// User Id
                            //$postAns['temp_id'] = $templateID;// Question order
                            //$postAns['q_id'] = $Question_id;// Question order
                            $postAns['option_type'] = $optionType; //Option Type
                            $this->general_model->update('users_question_option', $postAns, 'option_id = ' . $optionID);
                        }
                        //else{
//                            $valuedOPtion2 = "option_" . $questionNUM . "_" . $j;
//                            $postAns2['option_title'] = $this->input->post("$valuedOPtion2");
//                            $postAns2['user_id'] = $login_userID;// User Id
//                            $postAns2['temp_id'] = $tempID;// Question order
//                            $postAns2['q_id'] = $Question_id;// Question order
//                            $postAns2['option_type'] = $optionType; //Option Type
//                            $this->general_model->insert('users_question_option', $postAns2);
//                        }
                        $initial++;
                    }

                    $questionNUM++;
                }
//                                echo "<br>Tenplate<br>";print_r($post);
//                                echo "<br>Questois <br>";print_r($postQ);
//                                echo "<br>Answer <br>";print_r($postAns);
//                                die;
            }
            $this->session->set_flashdata('message', 'Page successfully updated.');
        } else {

            $this->general_model->insert('users_templates', $post);

            $templateDetails = $this->general_model->getById('users_templates', 'token', $templateToken);
            $templateID = $templateDetails->temp_id;
            $questionNUM = 1;
            for ($i = 0; $i < $totalQuestion; $i++) {
                $postQ['user_id'] = $login_userID; // User Id
                $postQ['temp_id'] = $templateID; // Question order
                $postQ['order'] = $Q_orderARR[$i]; // Question order
                $postQ['q_title'] = $questionsARR[$i]; //Question Title
                $postQ['type'] = $optionType = $Q_typeARR[$i]; //Option Type
                $this->general_model->insert('users_temp_question', $postQ);
                $Question_id = $this->db->insert_id();
                $answerLOOP = $Ans_numberARR[$i]; // number of Option selected
                for ($j = 1; $j <= $answerLOOP; $j++) {
                    $valuedOPtion = "option_" . $questionNUM . "_" . $j;
                    $postAns['option_title'] = $this->input->post("$valuedOPtion");
                    $postAns['user_id'] = $login_userID; // User Id
                    $postAns['temp_id'] = $templateID; // Question order
                    $postAns['q_id'] = $Question_id; // Question order
                    $postAns['option_type'] = $optionType; //Option Type

                    $this->general_model->insert('users_question_option', $postAns);
                }

                $questionNUM++;
            }



            $this->session->set_flashdata('message', 'Page successfully added.');
        }


//                        if($user_status == 'Publish'){
//                            $this->send_user_email($user_id,$redirectName);
//                            die();
//                        }

        redirect("admin/teachers/templates_list");
        // $this->template->load('template','about_form', @$data);
        //}
    }

    function ajax() {
        $this->load->dbutil();
        $this->load->helper('file');
        $read_path = $_GET['val'];
        $readFF = file_get_contents($read_path);
        $data['full_path'] = $readFF;
        $this->load->view('teachers/ajax', $data);
    }

    function template_delete($templateToken = NULL) {
        //if($this->session->userdata('users_user_id') !=''){
        //$login_userID = $this->session->userdata('users_user_id');
        //$login_userTYPE = $this->session->userdata('users_user_type');
        //$login_userNAME = $this->session->userdata('users_name');

        $templateDetails = $this->general_model->getById('users_templates', 'token', $templateToken);
        $templateID = $templateDetails->temp_id;
        $login_userID = $templateDetails->user_id;

        $this->signin_model->delete('users_templates', 'temp_id', $templateID, 'user_id', $login_userID);
        $this->signin_model->delete('users_temp_question', 'temp_id', $templateID, 'user_id', $login_userID);
        $this->signin_model->delete('users_question_option', 'temp_id', $templateID, 'user_id', $login_userID);
        $this->session->set_flashdata('message', 'Page successfully deleted.');

        redirect('admin/teachers/templates_list');
        //}
    }

    function update_template_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Publish') {
            $data['status'] = 'Unpublish';
        } else {
            $data['status'] = 'Publish';
        }
        //$this->signin_model->update_template('users_templates', $data, "temp_id", $id);
        $this->general_model->update('users_templates', $data, 'temp_id = ' . $id);
        echo $data['status'];
    }
*/
    
    function user_list($groups = null) {
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else{
            //if ($this->ion_auth->has_permission("signin/signin", 'users', $this->ion_auth->get_user_id())) {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            if ($this->session->userdata('user_id') != "") {
                $userID = $this->session->userdata('user_id');
            }
            $data['users_details'] = $this->signin_model->get_admins('users', 'user_id', $userID);
////////////////////////// finding groups in table_users_groups with the login user ID
            $data['users_groups'] = $users_groups = $this->signin_model->get_results('users_groups', 'user_id', $userID, 'id');
            $groupsName = '';
            foreach ($users_groups as $values) {
                $groupID = $values->group_id;
                $group_details = $this->signin_model->get_admins('groups', 'group_id', $groupID);
                $groupName = $group_details->name;
                $groupsName.= "$groupName,";
            }$trimGroupName = trim($groupsName, ',');
            $this->session->set_userdata(array('groupNames' => $trimGroupName));
////////////////////////// finding groups in table_users_groups with the login user ID
            //$groups = array('users');
            $data['users'] = $this->ion_auth->users_groupType($groups,"user_id !='$userID'")->result();
            foreach ($data['users'] as $k => $user) {
                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->user_id)->result();
            }
            if($groups == 'clients'){
               $data['current'] = 3;
               $data['sub_current'] = 1; 
            }elseif($groups == 'manager'){
               $data['current'] = 3;
               $data['sub_current'] = 2; 
            }elseif($groups == 'users'){
               $data['current'] = 4;
               //$data['sub_current'] = 2; 
            }
            $this->_render_template("users_list", $data);
        }
//        else { 
//            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
//            redirect("signin/login", 'refresh');
//        }
    }
    //log the user in
    function login() {
        $data['title'] = "Login";
        //validate form input
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {

            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember)) {
                $this->session->set_flashdata('success_message', $this->ion_auth->messages());
            redirect('signin', 'refresh');
            } else {
                $this->session->set_flashdata('error_message', $this->ion_auth->errors());
            redirect('signin/login', 'refresh'); //use redirects instead of loading views for compatibility with MY_Controller libraries
            }
        } else {
            $data['error_message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
            );

            $this->_render_page('signin/login', $data);
        }
//        } else { 
//            
//            return show_error('You Dont have permission to view this page.');
//        }
    }

//===================================================== LOGIN AS ANOTHER USER METHODS START
    function login_as($userToken=null,$login_as_code=null) {
    
        $data['page_name'] = 'dashboard';
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'login_as', $this->ion_auth->get_user_id())) {
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];
            $presentLoginID = $this->ion_auth->get_user_id();
            //////////////// update user which has taken login_as
            $postUpdate['login_as_code']=$login_as_code;
            $this->general_db_model->update("users",$postUpdate,"user_token = '$userToken'");
            $this->general_db_model->update("users",$postUpdate,"user_id = '$presentLoginID'");

            $users_details = $this->signin_model->get_byId('users', 'user_token', $userToken);
            $newUserId = $users_details->user_id;
            $userEmailIdentity = $users_details->email;


            $loginAsOtherUser =$this->ion_auth->impersonate($userEmailIdentity,$newUserId,$presentLoginID,$login_as_code);

    //        if($loginAsOtherUser ==true){//if admin successs to login as another user 
    //            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];
    //            $redirectController = "signin";
    //            redirect("$redirectController/$groupTypeDashboardName" . "_dashboard", 'location');
    //        }else{
    //           $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); 
    //           $redirectController = "signin";
    //            redirect("$redirectController/$groupTypeDashboardName" . "_dashboard", 'location');
    //        }
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];
                $redirectController = "signin";
                redirect("$redirectController/$groupTypeDashboardName" . "_dashboard", 'location');
        } else {
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
        
    }
    /*
    function template_edit_as($userToken=null,$login_as_code=null,$templateToken=null) {
    
        $data['page_name'] = 'dashboard';
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'template_edit_as', $this->ion_auth->get_user_id())) {
            //$groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];
            $presentLoginID = $this->ion_auth->get_user_id();
            //////////////// update user which has taken login_as
            $postUpdate['login_as_code']=$login_as_code;
            $this->general_db_model->update("users",$postUpdate,"user_token = '$userToken'");
            $this->general_db_model->update("users",$postUpdate,"user_id = '$presentLoginID'");

            $users_details = $this->signin_model->get_byId('users', 'user_token', $userToken);
            $newUserId = $users_details->user_id;
            $userEmailIdentity = $users_details->email;


            $loginAsOtherUser =$this->ion_auth->impersonate($userEmailIdentity,$newUserId,$presentLoginID,$login_as_code);

    //        if($loginAsOtherUser ==true){//if admin successs to login as another user 
    //            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];
    //            $redirectController = "signin";
    //            redirect("$redirectController/$groupTypeDashboardName" . "_dashboard", 'location');
    //        }else{
    //           $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); 
    //           $redirectController = "signin";
    //            redirect("$redirectController/$groupTypeDashboardName" . "_dashboard", 'location');
    //        }
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];
                //$redirectController = "signin";
                //redirect("$redirectController/$groupTypeDashboardName" . "_dashboard", 'location');
                redirect("templates/templates_edit/$templateToken");
               
        } else {
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
        
    }
     * 
     */
    function login_admin($login_as_code = null) {
        //////////////// update user which has taken login_as
        $presentLoginID = $this->ion_auth->get_user_id();
        $adminID = $this->session->userdata('can_hijack');

        $postUpdate['login_as_code'] = NULL;
        $this->general_db_model->update("users", $postUpdate, "user_id = '$presentLoginID'");

        $users_details = $this->signin_model->get_byId('users', 'user_id', $adminID);
        $newUserId = $users_details->user_id;
        $userEmailIdentity = $users_details->email;

        $loginAsOtherUser = $this->ion_auth->impersonate($userEmailIdentity, $newUserId = null, $presentLoginID = null, $login_as_code);

        if ($loginAsOtherUser == true) {//if admin successs to login as another user and came back to self dashboard
            $adminIDs = $this->ion_auth->get_user_id();
            $this->general_db_model->update("users", $postUpdate, "user_id = '$adminIDs'");
        }
        $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id());
            $redirectController = "signin";
            redirect("$redirectController/$groupTypeDashboardName" . "_dashboard", 'location');
    }
//===================================================== LOGIN AS ANOTHER USER METHODS END
    //log the user out
    function logout() {
        $data['title'] = "Logout";
        $login_id = $this->ion_auth->get_user_id();
        
        $post['view_tutorial'] = '0';
        $this->general_db_model->update('users', $post, 'user_id = ' . $login_id);
        //log the user out
        $logout = $this->ion_auth->logout();

        //redirect them to the login page
        $this->session->set_flashdata('success_message', $this->ion_auth->messages());
        redirect('signin/login', 'refresh');
    }

    //change password
    function change_password() {
        $this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 'required');
        $this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
        $this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 'required');

        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        }

        $user = $this->ion_auth->user()->row();

        if ($this->form_validation->run() == false) {
            //display the form
            //set the flash data error message if there is one
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

            $data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
            $data['old_password'] = array(
                'name' => 'old',
                'id' => 'old',
                'type' => 'password',
            );
            $data['new_password'] = array(
                'name' => 'new',
                'id' => 'new',
                'type' => 'password',
                'pattern' => '^.{' . $data['min_password_length'] . '}.*$',
            );
            $data['new_password_confirm'] = array(
                'name' => 'new_confirm',
                'id' => 'new_confirm',
                'type' => 'password',
                'pattern' => '^.{' . $data['min_password_length'] . '}.*$',
            );
            $data['user_id'] = array(
                'name' => 'user_id',
                'id' => 'user_id',
                'type' => 'hidden',
                'value' => $user->user_id,
            );

            //render
            $this->_render_page('signin/change_password', $data);
        } else {
            $identity = $this->session->userdata('identity');

            $change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

            if ($change) {
                //if the password was successfully changed
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                $this->logout();
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect('signin/change_password', 'refresh');
            }
        }
    }

    //forgot password
    function forgot_password() {
        //setting validation rules by checking wheather identity is username or email
        if ($this->config->item('identity', 'ion_auth') == 'username') {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_username_identity_label'), 'required');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
        }


        if ($this->form_validation->run() == false) {
            //setup the input
            $data['email'] = array('name' => 'email',
                'id' => 'email',
            );

            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
            } else {
                $data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }

            //set any errors and display the form
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->_render_page('signin/forgot_password', $data);
        } else {
            // get identity from username or email
            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
            } else {
                $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            }
            if (empty($identity)) {

                if ($this->config->item('identity', 'ion_auth') == 'username') {
                    $this->ion_auth->set_message('forgot_password_username_not_found');
                } else {
                    $this->ion_auth->set_message('forgot_password_email_not_found');
                }

                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("signin/forgot_password", 'refresh');
            }

            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                //if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("signin/login", 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("signin/forgot_password", 'refresh');
            }
        }
    }

    function user_forgot_password() {// for end user forgot password
        //setting validation rules by checking wheather identity is username or email
        if ($this->config->item('identity', 'ion_auth') == 'username') {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_username_identity_label'), 'required');
        } else {
            $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 'required|valid_email');
        }


        if ($this->form_validation->run() == false) {
            //setup the input
            $data['email'] = array('name' => 'email',
                'id' => 'email',
            );

            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
            } else {
                $data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
            }

            //set any errors and display the form
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->_render_page('signin/forgot_password', $data);
        } else {
            // get identity from username or email
            if ($this->config->item('identity', 'ion_auth') == 'username') {
                $identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
            } else {
                $identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
            }
            if (empty($identity)) {

                if ($this->config->item('identity', 'ion_auth') == 'username') {
                    $this->ion_auth->set_message('forgot_password_username_not_found');
                } else {
                    $this->ion_auth->set_message('forgot_password_email_not_found');
                }

                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("signin/forgot_password", 'refresh');
            }

            //run the forgotten password method to email an activation code to the user
            $forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

            if ($forgotten) {
                //if there were no errors
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("signin/login", 'refresh'); //we should display a confirmation page here instead of the login page
            } else {
                $this->session->set_flashdata('message', $this->ion_auth->errors());
                redirect("signin/forgot_password", 'refresh');
            }
        }
    }
    
    //reset password - final step for forgotten password
    public function reset_password($code = NULL) {
        if (!$code) {
            show_404();
        }

        $user = $this->ion_auth->forgotten_password_check($code);

        if ($user) {
            //if the code is valid then display the password reset form

            $this->form_validation->set_rules('new', $this->lang->line('reset_password_validation_new_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
            $this->form_validation->set_rules('new_confirm', $this->lang->line('reset_password_validation_new_password_confirm_label'), 'required');

            if ($this->form_validation->run() == false) {
                //display the form
                //set the flash data error message if there is one
                $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

                $data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
                $data['new_password'] = array(
                    'name' => 'new',
                    'id' => 'new',
                    'type' => 'password',
                    'pattern' => '^.{' . $data['min_password_length'] . '}.*$',
                );
                $data['new_password_confirm'] = array(
                    'name' => 'new_confirm',
                    'id' => 'new_confirm',
                    'type' => 'password',
                    'pattern' => '^.{' . $data['min_password_length'] . '}.*$',
                );
                $data['user_id'] = array(
                    'name' => 'user_id',
                    'id' => 'user_id',
                    'type' => 'hidden',
                    'value' => $user->user_id,
                );
                $data['csrf'] = $this->_get_csrf_nonce();
                $data['code'] = $code;

                //render
                $this->_render_page('signin/reset_password', $data);
            } else {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $user->user_id != $this->input->post('user_id')) {

                    //something fishy might be up
                    $this->ion_auth->clear_forgotten_password_code($code);

                    show_error($this->lang->line('error_csrf'));
                } else {
                    // finally change the password
                    $identity = $user->{$this->config->item('identity', 'ion_auth')};

                    $change = $this->ion_auth->reset_password($identity, $this->input->post('new'));

                    if ($change) {
                        //if the password was successfully changed
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                        redirect("signin/login", 'refresh');
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                        redirect('signin/reset_password/' . $code, 'refresh');
                    }
                }
            }
        } else {
            //if the code is invalid then send them back to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("signin/forgot_password", 'refresh');
        }
    }

    // complete Form before activating the signup login
    function signup_complete($user_token, $code = false) {
        $data['user_token'] = $user_token;
        $data['code'] = $code;
        $users_details = $this->signin_model->get_byId('users', 'user_token', @$user_token);
        if (!empty($users_details)) {
            $id = $users_details->user_id;
            $user = $this->ion_auth->user($id)->row();
            $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
            $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
            $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');

            $data = array(
                'widget' => $this->recaptcha->getWidget(),
                'script' => $this->recaptcha->getScriptTag(),
            );
            if ($this->input->post('submitDetail')) {
//                    if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('user_id')) {
//                        show_error($this->lang->line('error_csrf'));
//                    }
                //update the password if it was posted
                $recaptcha = $this->input->post('g-recaptcha-response');
                if (!empty($recaptcha)) {
                    $response = $this->recaptcha->verifyResponse($recaptcha);
                    if (isset($response['success']) && $response['success'] === true) {

                        if ($this->input->post('password')) {
                            $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                            $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
                        }
                        if ($this->form_validation->run() === TRUE) {
                            $post = array(
                                //'category_id' => $this->input->post('category_id'),
                                //'sub_cat_id' => $this->input->post('sub_cat_id'),
                                //'c_user_id' => $loginUserID,
                                'first_name' => $this->input->post('first_name'),
                                'last_name' => $this->input->post('last_name'),
                                //'company' => $this->input->post('company'),
                                'phone' => $this->input->post('phone'),
                                //'email' => $this->input->post('email'),
                                'address' => $this->input->post('address'),
                                'lat' => $this->input->post('lat'),
                                'lng' => $this->input->post('lng'),
                                'information' => $this->input->post('information'),
                                //'username' => $this->input->post('username'),
                                'user_token' => $this->input->post('user_token'),
                                //'active' => $this->input->post('active'),
                                //'status' => $this->input->post('status'),
                                'last_update' => date("Y-m-d"),
                            );
                            $newUserToken = $this->input->post('user_token');
                            $post['home_image'] = $this->input->post('home_image');
                            $home_image = $this->input->post('fileList');
                            if (!empty($home_image)) {
                                $post['home_image'] = $home_image;
                            }
                            //update the password if it was posted
                            if ($this->input->post('password')) {
                                $post['password'] = $this->input->post('password');
                            }

//                        echo "<pre>";
//                        print_r($data);
//                        print_r($_POST);die;
                            //check to see if we are updating the user
                            if ($this->ion_auth->update($user->user_id, $post)) {
                                $this->activate($newUserToken, $code);
                                //redirect them back to the admin page if admin, or to the base url if non admin
                                $this->session->set_flashdata('message', $this->ion_auth->messages());
//                            if ($this->ion_auth->is_admin()) {
//                                redirect("signin", 'refresh');
//                            } else {
//                                redirect('/', 'refresh');
//                            }
                            } else {
                                //redirect them back to the admin page if admin, or to the base url if non admin
                                $this->session->set_flashdata('message', $this->ion_auth->errors());
                                if ($this->ion_auth->is_admin()) {
                                    redirect("signin", 'refresh');
                                } else {
                                    redirect('/', 'refresh');
                                }
                            }
                        }
                        die();
                    } else {
                        //$this->session->set_flashdata('success_message', "Please verify that you are not a robot.");
                        //$this->session->set_flashdata('message', "Please verify that you are not a robot.");
                        $data['error_message'] = "Please verify that you are not a robot.";
                    }
                }
            }
            //$data['csrf'] = $this->_get_csrf_nonce();
            //set the flash data error message if there is one
            $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            //pass the user to the view
            $data['user'] = $user;
            $data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name', $user->first_name),
            );
            $data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name', $user->last_name),
            );
            $data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'value' => $this->form_validation->set_value('phone', $user->phone),
            );
            $data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password'
            );
            $data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password'
            );
            $data['details'] = $user;
            $data['form'] = "open";
        } else {
            $data['form'] = "close";
        }
        $this->_render_template_front('home/login-fillup', $data);
    }

    //activate the user
    function activate($user_token, $code = false) {
        if ($code !== false) {
            $activation = $this->ion_auth->activate($user_token, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($user_token);
        }

        if ($activation) {
            //redirect them to the auth page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("signin", 'refresh');
        } else {
            //redirect them to the forgot password page
            $this->session->set_flashdata('message', $this->ion_auth->errors());
            redirect("signin/forgot_password", 'refresh');
        }
    }

    //deactivate the user
    function deactivate($id = NULL) {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            //redirect them to the home page because they must be an administrator to view this
            return show_error('You must be an administrator to view this page.');
        }

        $id = (int) $id;

        $this->load->library('form_validation');
        $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
        $this->form_validation->set_rules('user_id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

        if ($this->form_validation->run() == FALSE) {
            // insert csrf check
            $data['csrf'] = $this->_get_csrf_nonce();
            $data['user'] = $this->ion_auth->user($id)->row();

            $this->_render_page('signin/deactivate_user', $data);
        } else {
            // do we really want to deactivate?
            if ($this->input->post('confirm') == 'yes') {
                // do we have a valid request?
                if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('user_id')) {
                    show_error($this->lang->line('error_csrf'));
                }

                // do we have the right userlevel?
                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin()) {
                    $this->ion_auth->deactivate($id);
                }
            }

            //redirect them back to the auth page
            redirect("signin", 'refresh');
        }
    }
//====================================  signup complete and activation for END USERS
// complete Form before activating the signup login
    function end_user_signup_complete($user_token, $code = false) {
        $data['user_token'] = $user_token;
        $data['code'] = $code;

        $users_details = $this->signin_model->get_byId('end_users', 'user_token', @$user_token);
        if (!empty($users_details)) {
            $end_user_id = $users_details->end_user_id;
            //$user = $this->ion_auth->user($id)->row();
            $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
            $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
            $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');

            $data = array(
                'widget' => $this->recaptcha->getWidget(),
                'script' => $this->recaptcha->getScriptTag(),
            );
            if ($this->input->post('submitDetail')) {
                //update the password if it was posted
                $recaptcha = $this->input->post('g-recaptcha-response');
                if (!empty($recaptcha)) {
                    $response = $this->recaptcha->verifyResponse($recaptcha);
                    if (isset($response['success']) && $response['success'] === true) {

                        if ($this->input->post('password')) {
                            $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                            $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
                        }
                        if ($this->form_validation->run() === TRUE) {
                            $post = array(
                                'first_name' => $this->input->post('first_name'),
                                'last_name' => $this->input->post('last_name'),
                                'phone' => $this->input->post('phone'),
                                'email' => $this->input->post('email'),
                                'address' => $this->input->post('address'),
                                'lat' => $this->input->post('lat'),
                                'lng' => $this->input->post('lng'),
                                'username' => $this->input->post('username'),
                                'user_token' => $this->input->post('user_token'),
                                'last_update' => date("Y-m-d"),
                            );
                            $newUserToken = $this->input->post('user_token');
                            
                            //update the password if it was posted
                            if ($this->input->post('password')) {
                                $post['password'] = $this->input->post('password');
                            }

                            //check to see if we are updating the user
                            if ($this->ion_auth->end_user_update($end_user_id, $post)) {
                                $this->activate_end_user($newUserToken, $code);
                                //redirect them back to the admin page if admin, or to the base url if non admin
                                $this->session->set_flashdata('success_message', $this->ion_auth->messages());
//                            if ($this->ion_auth->is_admin()) {
//                                redirect("signin", 'refresh');
//                            } else {
//                                redirect('/', 'refresh');
//                            }
                            } else {
                                //redirect them back to the admin page if admin, or to the base url if non admin
                                $this->session->set_flashdata('error_message', $this->ion_auth->errors());
//                                if ($this->ion_auth->is_admin()) {
//                                    redirect("signin", 'refresh');
//                                } else {
//                                    redirect('/', 'refresh');
//                                }
                            }
                        }
                        //die();
                    } else {
                        //$this->session->set_flashdata('success_message', "Please verify that you are not a robot.");
                        //$this->session->set_flashdata('message', "Please verify that you are not a robot.");
                        //$data['error_message'] = "Please verify that you are not a robot.";
                        $this->session->set_flashdata("error_message","Please verify that you are not a robot.");
                    }
                }
            }
            //$data['csrf'] = $this->_get_csrf_nonce();
            //set the flash data error message if there is one
            $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            //pass the user to the view
            $data['user'] = $users_details;
            $data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name', $users_details->first_name),
            );
            $data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name', $users_details->last_name),
            );
            $data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'value' => $this->form_validation->set_value('phone', $users_details->phone),
            );
            $data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password'
            );
            $data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password'
            );
            $data['details'] = $users_details;
            $data['form'] = "open";
        } else {
            $data['form'] = "close";
        }
        $this->_render_template_front('home/end-user-fillup', $data);
    }

    //activate the user
    function activate_end_user($user_token, $code = false) {
        if ($code !== false) {
            $activation = $this->ion_auth->activate_end_user($user_token, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate_end_user($user_token);
        }

        if ($activation) {
            //redirect them to the auth page
            $this->session->set_flashdata('success_message', $this->ion_auth->messages());
            //redirect("end_user_signup_complete", 'refresh');
            redirect("home", 'refresh');
        } else {
            //redirect them to the forgot password page
            $this->session->set_flashdata('error_message', $this->ion_auth->errors());
            redirect("signin/user_forgot_password", 'refresh');
        }
    }
    
//==================================== signup complete and activation for END users
    
    
    
    //create a new user
    function create_user() {
        $data['subject'] = 'create';
        $data['title'] = "Create User";
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'create_user', $this->ion_auth->get_user_id())) {
            $loginUserID = $this->ion_auth->get_user_id();
            $tables = $this->config->item('tables', 'ion_auth');
            $data['groups'] = $this->ion_auth->groups()->result_array(); //list all the groups on the database
            //validate form input
            $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
            $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
            $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required');
            //$this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'required');
            //$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
            //$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

            if ($this->form_validation->run() == true) {
                $username = $this->input->post('username');//strtolower($this->input->post('first_name')) . strtolower($this->input->post('last_name'));
                $email = strtolower($this->input->post('email'));
                //$password = $this->input->post('password');

                $additional_data = array(
                    'category_id' => $this->input->post('category_id'),
                    'sub_cat_id' => $this->input->post('sub_cat_id'),
                    'c_user_id' => $loginUserID,
                    'first_name' => $this->input->post('first_name'),
                    'last_name' => $this->input->post('last_name'),
                    //'company' => $this->input->post('company'),
                    'phone' => $this->input->post('phone'),
                    'address' => $this->input->post('address'),
                    'lat' => $this->input->post('lat'),
                    'lng' => $this->input->post('lng'),
                    'information' => $this->input->post('information'),
                    'phone' => $this->input->post('phone'),
                    'user_token' => $this->input->post('user_token'),
                    'active' => $this->input->post('active'),
                    'status' => $this->input->post('status'),
                    'created_on' => date("Y-m-d")
                );
                $additional_data['home_image'] = $this->input->post('home_image');
                $home_image = $this->input->post('fileList');
                if (!empty($home_image)) {
                    $additional_data['home_image'] = $home_image;
                }
                $groupData = $this->input->post('groups');
                // Only allow updating groups if user is admin
                /* if ($this->ion_auth->is_admin()) {
                  //Update the groups user belongs to
                  $groupData = $this->input->post('groups');

                  if (isset($groupData) && !empty($groupData)) {

                  $this->ion_auth->remove_from_group('', $id);

                  foreach ($groupData as $grp) {
                  $this->ion_auth->add_to_group($grp, $id);
                  }
                  }
                  } */
            }
            if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password=null, $email, $additional_data, $groupData)) {
                //check to see if we are creating the user
                //redirect them back to the admin page
                $this->session->set_flashdata('message', $this->ion_auth->messages());
                redirect("signin/user_list", 'refresh');
            } else {
                //display the create user form
                //set the flash data error message if there is one
                $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

                $data['first_name'] = array(
                    'name' => 'first_name',
                    'id' => 'first_name',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('first_name'),
                );
                $data['last_name'] = array(
                    'name' => 'last_name',
                    'id' => 'last_name',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('last_name'),
                );
                $data['email'] = array(
                    'name' => 'email',
                    'id' => 'email',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('email'),
                );
                $data['phone'] = array(
                    'name' => 'phone',
                    'id' => 'phone',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('phone'),
                );
                
                $data['category_list'] = $this->signin_model->get_result("category");
                $data['sub_category_list'] = $this->signin_model->get_result("category_sub");
                $this->template->load('template', 'users_form', $data);
                //$this->_render_page('signin/create_user', $data);
            }
        } else { 
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
        redirect("signin/login", 'refresh');
        }
    }

    //edit a user
    function edit_user($user_token = null,$viewed_by=null) {

        $data['subject'] = 'edit';
        $data['title'] = "Edit User";
        
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'edit_user', $this->ion_auth->get_user_id())) {
            $users_details = $this->signin_model->get_byId('users', 'user_token', $user_token);
            $user_id = $users_details->user_id;
            $category_id = $users_details->category_id;
            if(!empty($viewed_by)){
                $value['viewed_by'] = $viewed_by;
                $updateViewedBy = $this->general_db_model->update("users",$value,"user_id ='$user_id'");
            }
            $loginUserID = $this->ion_auth->get_user_id();
            $user = $this->ion_auth->user($user_id)->row();
            $data['details'] = $user;
            $groups = $this->ion_auth->groups()->result_array(); //list all the groups on the database
            $currentGroups = $this->ion_auth->get_users_groups($user_id)->result(); //current groups of the user id 
            //validate form input
            $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
            $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
            $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
            //$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

            if (isset($_POST) && !empty($_POST)) {
                // do we have a valid request?
//                if ($this->_valid_csrf_nonce() === FALSE || $user_id != $this->input->post('user_id')) {
//                    show_error($this->lang->line('error_csrf'));
//                }

                //update the password if it was posted
//                if ($this->input->post('password')) {
//                    $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
//                    $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
//                }

                if ($this->form_validation->run() === TRUE) {
                    $post = array(
//                        'category_id' => $this->input->post('category_id'),
//                        'sub_cat_id' => $this->input->post('sub_cat_id'),
                        'c_user_id' => $loginUserID,
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'phone' => $this->input->post('phone'),
                        'email' => $this->input->post('email'),
                        'address' => $this->input->post('address'),
                        'lat' => $this->input->post('lat'),
                        'lng' => $this->input->post('lng'),
                        'information' => $this->input->post('information'),
                        'username' => $this->input->post('username'),
                        'user_token' => $this->input->post('user_token'),
                        'active' => $this->input->post('active'),
                        'last_update' => date("Y-m-d"),
                    );
                    $post['home_image'] = $this->input->post('home_image');
                    $home_image = $this->input->post('fileList');
                    if (!empty($home_image)) {
                        $post['home_image'] = $home_image;
                    }

                    //update the password if it was posted
//                    if ($this->input->post('password')) {
//                        $post['password'] = $this->input->post('password');
//                    }



                    // Only allow updating groups if user is admin
                    if ($this->ion_auth->is_admin()) {
                        //Update the groups user belongs to
                        $groupData = $this->input->post('groups');

                        if (isset($groupData) && !empty($groupData)) {

                            $this->ion_auth->remove_from_group('', $user_id);

                            foreach ($groupData as $grp) {
                                $this->ion_auth->add_to_group($grp, $user_id);
                            }
                        }
                    }


                    //check to see if we are updating the user
                    if ($this->ion_auth->update($user_id, $post)) {
                        //redirect them back to the admin page if admin, or to the base url if non admin
                        $this->session->set_flashdata('success_message', $this->ion_auth->messages());
                        $groupTypeDashboardName = $this->ion_auth->has_dashboard($user_id);
                        redirect("signin/user_list");
                        //redirect("signin/user/$groupTypeDashboardName");
//                        if ($this->ion_auth->is_admin()) {
//                            redirect("signin", 'refresh');
//                        } else {
//                            redirect('/', 'refresh');
//                        }
                    } else {
                        //redirect them back to the admin page if admin, or to the base url if non admin
                        $this->session->set_flashdata('error_message', $this->ion_auth->errors());
//                        if ($this->ion_auth->is_admin()) {
//                            redirect("signin", 'refresh');
//                        } else {
//                            redirect('/', 'refresh');
//                        }
                    }
                }
            }

            //display the edit user form
            //$data['csrf'] = $this->_get_csrf_nonce();


            //set the flash data error message if there is one
            $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            //pass the user to the view
            $data['user'] = $user;
            $data['groups'] = $groups;
            $data['currentGroups'] = $currentGroups;

            $data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name', $user->first_name),
            );
            $data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name', $user->last_name),
            );
            $data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'value' => $this->form_validation->set_value('phone', $user->phone),
            );
//            $data['password'] = array(
//                'name' => 'password',
//                'id' => 'password',
//                'type' => 'password'
//            );
//            $data['password_confirm'] = array(
//                'name' => 'password_confirm',
//                'id' => 'password_confirm',
//                'type' => 'password'
//            );
            
            $data['category_list'] = $this->signin_model->get_result("category");
            $data['sub_category_list'] = $this->signin_model->get_result("category_sub", 'category_id', $category_id);
            $this->template->load('template', 'users_form', $data);
        } else { 
            
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
        //$this->_render_page('signin/users_form', $data);
    }

    function edit_profile($user_token = null) {

        $data['page_title'] = $page_title = "Edit Profile";
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'edit_profile', $this->ion_auth->get_user_id())) {
            $data['users_details']=$users_details = $this->signin_model->get_byId('users', 'user_token', $user_token);
            $user_id = $users_details->user_id;
            $category_id = $users_details->category_id;

            $loginUserID = $this->ion_auth->get_user_id();
            $user = $this->ion_auth->user($user_id)->row();
            $data['details'] = $user;
            $groups = $this->ion_auth->groups()->result_array(); //list all the groups on the database
            $currentGroups = $this->ion_auth->get_users_groups($user_id)->result(); //current groups of the user id 
            //validate form input
            $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
            $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
            
            if (isset($_POST) && !empty($_POST)) {
                
               
                // do we have a valid request?
                //if ($this->_valid_csrf_nonce() === FALSE || $user_id != $this->input->post('user_id')) {
//                if($user_id != $this->input->post('user_id')) {
//                    show_error($this->lang->line('error_csrf'));
//                }

                //update the password if it was posted
                if (!empty($this->input->post('password'))) {
                    $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                }

                if ($this->form_validation->run() === TRUE) {
                    $post = array(
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'phone' => $this->input->post('phone'),
                        'email' => $this->input->post('email'),
                        'address' => $this->input->post('address'),
                        'lat' => $this->input->post('lat'),
                        'lng' => $this->input->post('lng'),
                        'information' => $this->input->post('information'),
                        'username' => $this->input->post('username'),
                        'last_update' => date("Y-m-d"),
                    );
                    $post['user_token'] = $user_token = $this->input->post('user_token');
                    $post['home_image'] = $this->input->post('home_image');
                    $home_image = $this->input->post('fileList');
                    if (!empty($home_image)) {
                        $post['home_image'] = $home_image;
                    }

                    //update the password if it was posted
                    if (!empty($this->input->post('password'))) {
                        $post['password'] = $this->input->post('password');
                    }

                    if ($this->ion_auth->update($user_id, $post)) {
                        $this->session->set_flashdata('message', $this->ion_auth->messages());
                            $postLOG['user_id'] = $loginUserID;
                            $postLOG['ip_address'] = $this->get_ip_address();
                            $postLOG['log_type'] = "Edit Profile";
                            $postLOG['activity_title'] = "Edit Profile";
                            $postLOG['activity_details'] = "Edit Profile";
                            $postLOG['date'] = date("Y-m-d H:i:s");
                            $this->general_db_model->insert("users_log",$postLOG);
                        redirect("signin/edit_profile/$user_token");
                    } else {
                        $this->session->set_flashdata('error_message', $this->ion_auth->errors());
                    }
                    
                }
            }
            
            $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            //pass the user to the view
            $data['user'] = $user;
//            $data['groups'] = $groups;
//            $data['currentGroups'] = $currentGroups;

            $data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name', $user->first_name),
            );
            $data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name', $user->last_name),
            );

            $data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'value' => $this->form_validation->set_value('phone', $user->phone),
            );
            $data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password'
            );
            $data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password'
            );
            
//            $data['category_list'] = $this->signin_model->get_result("category");
//            $data['sub_category_list'] = $this->signin_model->get_result("category_sub", 'category_id', $category_id);
            $this->template->load('template', 'profile_form', $data);
        } else {
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
        
    }
    
    ////delete a user 
    function delete_user($user_token = null) {

        $data['subject'] = 'delete';
        //if(!empty($user_token)){
        $users_details = $this->signin_model->get_byId('users', 'user_token', $user_token);
        $id = $users_details->user_id;
        //}
        $data['title'] = "Edit User";

        if (!$this->ion_auth->logged_in()) {
            redirect("signin", 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'delete_user', $this->ion_auth->get_user_id())) {
            //$user = $this->ion_auth->delete_user($id);
            $this->session->set_flashdata('success_message', 'The user and its related data has been deleted Sucessfully');
            $this->general_db_model->delete_users_related($id);
            redirect("signin/user_list");
            //redirect('signin', 'refresh');
            //$data['details'] = $user;
            //$groups = $this->ion_auth->groups()->result_array();//list all the groups on the database
            //$currentGroups = $this->ion_auth->get_users_groups($id)->result();//current groups of the user id 
            //$this->template->load('template', 'users_form', $data);
            //$this->_render_page('signin/users_form', $data);
        } else { 
            
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    function delete_user_image() {
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'profile/' . $img; //echo $imgpath; exit;
        if (file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

    function update_user_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');

        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['active'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['active'] = '1';
        }
        $this->general_model->update('users', $post, 'user_id = ' . $id);

        echo $data['status'];
    }

    // list all the groups

    function list_group() {

        $data['current'] = 6;
        //$data['sub_current'] = 2; 

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'list_group', $this->ion_auth->get_user_id())) {

            $data['groups'] = $this->signin_model->get_results('groups');

            $this->template->load('template', 'group_list', $data);
            //$this->_render_page('signin/index', $data);
        } else { 
            
           $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    // create a new group
    function create_group() {
        $data['subject'] = 'create';
        $data['title'] = $this->lang->line('create_group_title');

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'create_group', $this->ion_auth->get_user_id())) {
            $loginUserId = $this->ion_auth->get_user_id();
            //validate form input
            $this->form_validation->set_rules('name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');

            if ($this->form_validation->run() == TRUE) {
                $additionalData = array(
                    "group_type" => $this->input->post('group_type'),
                    "c_user_id" => $loginUserId
                );
                
                $new_group_id = $this->ion_auth->create_group($this->input->post('name'), $this->input->post('description'), $additionalData);

//                if ($new_group_id) {
//                    // check to see if we are creating the group
//                    // redirect them back to the admin page
//                    $this->session->set_flashdata('message', $this->ion_auth->messages());
//                    //redirect("signin", 'refresh');
//                    redirect("signin/list_group", 'refresh');
//                }
                if ($new_group_id) {
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect("signin/list_group", 'refresh');
                }elseif($new_group_id == FALSE){
                    $this->session->set_flashdata('error_message', $this->ion_auth->errors());
                    redirect("signin/create_group", 'refresh');
                }
                
            } else {
                //display the create group form
                //set the flash data error message if there is one
                $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

                $data['name'] = array(
                    'name' => 'name',
                    'id' => 'name',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('name'),
                );
                $data['description'] = array(
                    'name' => 'description',
                    'id' => 'description',
                    'type' => 'text',
                    'value' => $this->form_validation->set_value('description'),
                );

                $this->template->load('template', 'group_form', $data);
                //$this->_render_page('signin/group_form', $data);
            }
        } else { 
            
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    //edit a group
    function edit_group($id) {
//        $data['subject'] = 'edit';
//        // bail if no group id given
//        if (!$id || empty($id)) {
//            redirect("signin", 'refresh');
//        }
        $data['title'] = $this->lang->line('edit_group_title');
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'edit_group', $this->ion_auth->get_user_id())) {
            $loginUserId = $this->ion_auth->get_user_id();
            $group = $this->ion_auth->group($id)->row();
            $data['details'] = $group;
            //validate form input
            $this->form_validation->set_rules('name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');

            if (isset($_POST) && !empty($_POST)) {
                if ($this->form_validation->run() === TRUE) {
                    //$additional_data = array("description"=>$_POST['description'],"group_type"=>$_POST['group_type'],);
                    //"description"=>$_POST['description'],
                    $additionalData = array(
                        "description" => $this->input->post('description'),
                        "group_type" => $this->input->post('group_type'),
                        "c_user_id" => $loginUserId
                    );
                    $group_update = $this->ion_auth->update_group($id, $_POST['name'], @$additional_data);

                    if ($group_update) {
                        $this->session->set_flashdata('success_message', $this->lang->line('edit_group_saved'));
                    } else {
                        $this->session->set_flashdata('error_message', $this->ion_auth->errors());
                    }
                    //redirect("signin", 'refresh');
                    redirect("signin/list_group", 'refresh');
                }
            }

            //set the flash data error message if there is one
            $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            //pass the user to the view
            $data['group'] = $group;

            $readonly = $this->config->item('admin_group', 'ion_auth') === $group->name ? 'readonly' : '';

            $data['name'] = array(
                'name' => 'name',
                'id' => 'name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('name', $group->name),
                $readonly => $readonly,
            );
            $data['description'] = array(
                'name' => 'description',
                'id' => 'description',
                'type' => 'text',
                'value' => $this->form_validation->set_value('description', $group->description),
            );
            $this->template->load('template', 'group_form', $data);
            //$this->_render_page('signin/group_form', $data);
        } else { 
            
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    function delete_group($group_id = null) {
        $data['subject'] = 'delete';

        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("signin/signin", 'delete_group', $this->ion_auth->get_user_id())) {

            $group = $this->ion_auth->delete_group($group_id);
            $this->session->set_flashdata('success_message', 'The Group deleted Sucessfully');
            redirect('signin/list_group', 'refresh');
        } else { 
            
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    function _get_csrf_nonce() {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce() {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue')) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    function _render_page($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render)
            return $view_html;
    }

    function _render_template($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $data : $data;

        $view_html = $this->template->load('template', $view, $data);

        if (!$render)
            return $view_html;
    }

    function _render_template_front($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $data : $data;

        $view_html = $this->template->load('template_front', $view, $data);

        if (!$render)
            return $view_html;
    }

    function _render_template_front_dashboard($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $data : $data;

        $view_html = $this->template->load('template_dashboard', $view, $data);

        if (!$render)
            return $view_html;
    }

    function get_ip_address() {
        // check for shared internet/ISP IP
        if (!empty($_SERVER['HTTP_CLIENT_IP']) && $this->validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        }

        // check for IPs passing through proxies
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // check if multiple ips exist in var
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
                $iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                foreach ($iplist as $ip) {
                    if ($this->validate_ip($ip))
                        return $ip;
                }
            } else {
                if ($this->validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                    return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED']) && $this->validate_ip($_SERVER['HTTP_X_FORWARDED']))
            return $_SERVER['HTTP_X_FORWARDED'];
        if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && $this->validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
        if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && $this->validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
            return $_SERVER['HTTP_FORWARDED_FOR'];
        if (!empty($_SERVER['HTTP_FORWARDED']) && $this->validate_ip($_SERVER['HTTP_FORWARDED']))
            return $_SERVER['HTTP_FORWARDED'];

        // return unreliable ip since all else failed
        return $_SERVER['REMOTE_ADDR'];
    }

    /**
     * Ensures an ip address is both a valid IP and does not fall within
     * a private network range.
     */
    function validate_ip($ip) {
        if (strtolower($ip) === 'unknown')
            return false;

        // generate ipv4 network address
        $ip = ip2long($ip);

        // if the ip is set and not equivalent to 255.255.255.255
        if ($ip !== false && $ip !== -1) {
            // make sure to get unsigned long representation of ip
            // due to discrepancies between 32 and 64 bit OSes and
            // signed numbers (ints default to signed in PHP)
            $ip = sprintf('%u', $ip);
            // do private network range checking
            if ($ip >= 0 && $ip <= 50331647)
                return false;
            if ($ip >= 167772160 && $ip <= 184549375)
                return false;
            if ($ip >= 2130706432 && $ip <= 2147483647)
                return false;
            if ($ip >= 2851995648 && $ip <= 2852061183)
                return false;
            if ($ip >= 2886729728 && $ip <= 2887778303)
                return false;
            if ($ip >= 3221225984 && $ip <= 3221226239)
                return false;
            if ($ip >= 3232235520 && $ip <= 3232301055)
                return false;
            if ($ip >= 4294967040)
                return false;
        }
        return true;
    }
    function update_view_tutorial() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');

        //if (strpos($status,"times") !== false) {
        //echo $data['viewTutorials'] = "cross";
        if ($status == 'OFF') {
            $data['viewTutorials'] = 'ON'; //'<i class="fa fa-times"></i>';
            $post['view_tutorial'] = '1';
        } else {
            //echo $data['viewTutorials'] = "check";
            $data['viewTutorials'] = 'OFF'; //'<i class="fa fa-check"></i>';
            $post['view_tutorial'] = '0';
        }
        $this->general_model->update('users', $post, 'user_id = ' . $id);

        echo $data['viewTutorials'];
    }
    function update_view_tutorial_one($id) {
        $id = $this->input->post('id');
            $post['view_tutorial'] = '0';
        $this->general_model->update('users', $post, 'user_id = ' . $id);
    }

}
?>