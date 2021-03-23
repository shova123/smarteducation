<?php
class Users extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('users_model');
        $this->load->model('general_model');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    function get_all_methods($class_name = null) {
        return get_class_methods($class_name);
    }

    function index() {
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('signin/login', 'refresh');
        } elseif ($this->ion_auth->has_permission("users/users", 'index', $this->ion_auth->get_user_id())) {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $userID = $this->ion_auth->get_user_id();
            $data['users_details'] = $this->users_model->get_admins('tbl_users', 'user_id', $userID);
            $data['users_groups'] = $users_groups = $this->users_model->get_results('tbl_users_groups', 'user_id', $userID);
            $groupsName = '';
            foreach ($users_groups as $values) {
                $groupID = $values->group_id;
                $group_details = $this->users_model->get_admins('tbl_groups', 'group_id', $groupID);
                $groupName = $group_details->name;
                $groupsName.= "$groupName,";
            }$trimGroupName = trim($groupsName, ',');
            $this->session->set_userdata(array('groupNames' => $trimGroupName));
            //redirect('users/users_template_list','location');
            redirect('users/users_dashboard', 'location');
        } else {
             $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    function users($categoryToken = null, $subCategoryToken = null) {
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'users', $this->ion_auth->get_user_id())) {
            $categoryId = null;
            if (!empty($categoryToken)) {
                $categoryDetails = $this->users_model->get_byId('tbl_category', 'token', $categoryToken);
                $categoryId = $categoryDetails->category_id;
            }
            $subCategoryId = null;
            if (!empty($subCategoryToken)) {
                $subCategoryDetails = $this->users_model->get_byId('tbl_category_sub', 'token', $subCategoryToken);
                $subCategoryId = $subCategoryDetails->sub_cat_id;
            }
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $userID = $this->ion_auth->get_user_id();
            $data['users'] = $this->users_model->get_users('tbl_users', 'category_id', $categoryId, 'sub_cat_id', $subCategoryId);
            foreach ($data['users'] as $k => $user) {
                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->user_id)->result();
            }
            $this->_render_template("users_list", $data);
        } else {
             $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    public function search_users() {
        $keyword = $this->input->post('user_keywords');
        
        $userID = $this->ion_auth->get_user_id();
        $query = $this->users_model->getUsers($keyword, $userID);
        echo json_encode($query);
    }
    function rangeWeek($datestr) {
            date_default_timezone_set(date_default_timezone_get());
            $dt = strtotime($datestr);
            $res['start'] = date('N', $dt)==1 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('last monday', $dt));
            $res['end'] = date('N', $dt)==7 ? date('Y-m-d', $dt) : date('Y-m-d', strtotime('next sunday', $dt));
            return $res;
        }
        
    function users_list($date = null) {
        $data['current'] = "2";
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'users_list', $this->ion_auth->get_user_id())) {
            $creatorUserID = $this->ion_auth->get_user_id();
            $currentMonth='';
            $weekStart='';
            $weekEnd='';
            $currentDate = date("Y-m-d");
            if($date == "monthly"){
                $currentMonth = date("m",strtotime($currentDate));
            }elseif($date == "weekly"){
                $weekRange = $this->rangeWeek($currentDate);  
                $weekStart = $weekRange['start'];
                $weekEnd = $weekRange['end'];
            }
//            $categoryId = null;
//            if(!empty($categoryToken)){
//                $categoryDetails = $this->users_model->get_byId('tbl_category', 'token', $categoryToken);
//                $categoryId = $categoryDetails->category_id;
//            }
//            $subCategoryId = null;
//            if(!empty($subCategoryToken)){
//                $subCategoryDetails = $this->users_model->get_byId('tbl_category_sub', 'token', $subCategoryToken);
//                $subCategoryId = $subCategoryDetails->sub_cat_id;
//            }
            $data['error_message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            //$userID = $this->ion_auth->get_user_id();
            //$data['users'] = $this->users_model->get_users('tbl_users', "c_user_id", $creatorUserID);
            $data['users'] = $this->users_model->get_usersDatewise('users', "c_user_id", $creatorUserID,$currentMonth,$weekStart,$weekEnd);
            
            foreach ($data['users'] as $k => $user) {
                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->user_id)->result();
            }
            $data['bootstropID1'] = "-1";
            $data['bootstropIDA1'] = 0;
            $data['bootstropID2'] = "-1";
            $data['bootstropID3'] = "-1";
            $data['bootstropID4'] = "-1";
            $data['bootstropID5'] = "-1";
            $data['bootstropID6'] = "-1";
            $data['bootstropID7'] = "-1";
            $data['bootstropID8'] = "-1";
            $this->_render_template_front_dashboard("users_list", $data);
        } else {
             $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    function signup() {
        $data['title'] = "Signup";
         $data = array(
            'widget' => $this->recaptcha->getWidget(),
            'script' => $this->recaptcha->getScriptTag(),
        );
    $this->_render_template_front('users/signup_form', $data);
    }
    function register() {
        $data['subject'] = 'register';
        $data['title'] = "Register";

        $tables = $this->config->item('tables', 'ion_auth');
        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required');
//        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
//        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        $recaptcha = $this->input->post('g-recaptcha-response');
        if (!empty($recaptcha)) {
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if (isset($response['success']) && $response['success'] === true) {
                if ($this->form_validation->run() == true) {
                    $username = strtolower($this->input->post('first_name')) . '_' . strtolower($this->input->post('last_name'));
                    $email = strtolower($this->input->post('email'));
                    $password = "";//$this->input->post('password');
                    $additional_data = array(
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'phone' => $this->input->post('phone'),
                        'user_token' => $this->input->post('user_token'),
                        'active' => '0',
                        'status' => $this->input->post('status'),
                        'created_on' => date("Y-m-d"),
                    );
                    $groupData = $this->input->post('groups');
                }

                if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data, $groupData)) {
                    //$this->ion_auth->add_user_count();
                    $this->session->set_flashdata('success_message', $this->ion_auth->messages());
                    //redirect("signin", 'refresh');
                } else {
                    //display the create user form
                    //set the flash data error message if there is one
                    $data['error_message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

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
//                $data['company'] = array(
//                    'name' => 'company',
//                    'id' => 'company',
//                    'type' => 'text',
//                    'value' => $this->form_validation->set_value('company'),
//                );
                    $data['phone'] = array(
                        'name' => 'phone',
                        'id' => 'phone',
                        'type' => 'text',
                        'value' => $this->form_validation->set_value('phone'),
                    );
//                    $data['password'] = array(
//                        'name' => 'password',
//                        'id' => 'password',
//                        'type' => 'password',
//                        'value' => $this->form_validation->set_value('password'),
//                    );
//                    $data['password_confirm'] = array(
//                        'name' => 'password_confirm',
//                        'id' => 'password_confirm',
//                        'type' => 'password',
//                        'value' => $this->form_validation->set_value('password_confirm'),
//                    );
//                    $data['category_list'] = $this->users_model->get_result("tbl_category");
//                    $data['sub_category_list'] = $this->users_model->get_result("tbl_category_sub");
                    //$this->template->load('template', 'users_form', $data);
                    $data['bootstropID1'] = 0;
                    $data['bootstropID2'] = 1;
                    $data['bootstropID3'] = 2;
                    $data['bootstropID4'] = 3;
                    $data['bootstropID5'] = 4;
                    //$this->_render_template_front_dashboard("users_form", $data);
                    //$this->_render_page('signin/create_user', $data);
                }
            }
            redirect("home");
        }else {
            //$this->session->set_flashdata('success_message', "Please verify that you are not a robot.");
            //$this->session->set_flashdata('message', "Please verify that you are not a robot.");
            $data['error_message'] = "Please verify that you are not a robot.";
            $this->session->set_flashdata("error_message","Please verify that you are not a robot.");
            redirect("users/signup");
        }

        
    }

    function create_user() {
        
        
        $data['subject'] = 'create';
        $data['title'] = "Create User";
        $data['current'] = "2";
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'create_user', $this->ion_auth->get_user_id())) {
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];
            if($groupTypeDashboardName =="clients"){
                $data['user_create_restriction'] = true;
            }else{
                $data['user_create_restriction'] = false;
            }
          
            $loginUserID = $this->ion_auth->get_user_id();
            $loginUserDetails = $this->ion_auth->login_user_details();
            $profileID = $loginUserDetails->profile_id;
            $profileDetails = $this->users_model->get_byId('profile', 'profile_id', $profileID);
            $profileUsersCapacity = $profileDetails->users;

            //$profileCounterDetails = $this->ion_auth_model->get_byId('profile_counter', 'user_id', $loginUserID, 'profile_id', $profileID);


            $tables = $this->config->item('tables', 'ion_auth');
            $creatorWhere = "c_user_id = $loginUserID";
            $data['groups'] = $this->ion_auth->groups($creatorWhere)->result_array(); //list all the groups on the database
            //$data['groups'] = $this->ion_auth->get_users_groups($loginUserID)->result_array(); //list all the groups on the database
            //echo "<pre>";print_r($data);die;
            //validate form input
            //$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
            //$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
            $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['users'] . '.email]');
            //$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required');
            //$this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'required');
            //$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
            //$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

            if ($this->form_validation->run() == true) {
                $username = strtolower($this->input->post('username'));//strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
                $email = strtolower($this->input->post('email'));
                //$password = $this->input->post('password');
                //'company' => $this->input->post('company'),
                $additional_data = array(
                    'category_id' => $this->input->post('category_id'),
                    'sub_cat_id' => $this->input->post('sub_cat_id'),
                    'c_user_id' => $loginUserID,
                    //'first_name' => $this->input->post('first_name'),
                    //'last_name' => $this->input->post('last_name'),
                    //'phone' => $this->input->post('phone'),
                    //'address' => $this->input->post('address'),
                    //'lat' => $this->input->post('lat'),
                    //'lng' => $this->input->post('lng'),
                    //'information' => $this->input->post('information'),
                    'user_token' => $this->input->post('user_token'),
                    //'active' => $this->input->post('active'),
                    'profile_id' => $this->input->post('profile_id'),
                    'created_on' => date("Y-m-d"),
                );
                //$additional_data['home_image'] = $this->input->post('home_image');
                //$home_image = $this->input->post('fileList');
                //if (!empty($home_image)) {
                //    $additional_data['home_image'] = $home_image;
                //}
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
            
            $present_c_users_count = $this->users_model->countTotal('users', 'c_user_id', $loginUserID);
            if ($present_c_users_count == 0 || $present_c_users_count < $profileUsersCapacity) {


                if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password=null, $email, $additional_data, $groupData)) {
                     $this->ion_auth->add_user_count();
                    $this->session->set_flashdata('success_message', $this->ion_auth->messages());
                    redirect("signin", 'refresh');
                } else {
                    //display the create user form
                    //set the flash data error message if there is one
                    $data['error_message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
/*
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
                    );*/
                    $data['email'] = array(
                        'name' => 'email',
                        'id' => 'email',
                        'type' => 'text',
                        'value' => $this->form_validation->set_value('email'),
                    );
//                $data['company'] = array(
//                    'name' => 'company',
//                    'id' => 'company',
//                    'type' => 'text',
//                    'value' => $this->form_validation->set_value('company'),
//                );
                    /*
                    $data['phone'] = array(
                        'name' => 'phone',
                        'id' => 'phone',
                        'type' => 'text',
                        'value' => $this->form_validation->set_value('phone'),
                    );
                    $data['password'] = array(
                        'name' => 'password',
                        'id' => 'password',
                        'type' => 'password',
                        'value' => $this->form_validation->set_value('password'),
                    );
                    $data['password_confirm'] = array(
                        'name' => 'password_confirm',
                        'id' => 'password_confirm',
                        'type' => 'password',
                        'value' => $this->form_validation->set_value('password_confirm'),
                    );*/
                    $data['category_list'] = $this->users_model->get_result("tbl_category");
                    $data['sub_category_list'] = $this->users_model->get_result("tbl_category_sub");
                    //$this->template->load('template', 'users_form', $data);
                    $data['bootstropID1'] = 0;
                    $data['bootstropID2'] = 1;
                    $data['bootstropID3'] = 2;
                    $data['bootstropID4'] = 3;
                    $data['bootstropID5'] = 4;
                    $this->_render_template_front_dashboard("users_form", $data);
                    //$this->_render_page('signin/create_user', $data);
                }
            } else {
                $this->session->set_flashdata('error_user', 'you cannnot add Users you exceed the limit');
               redirect("users/create_user");
               die();
                //return show_error("you cannnot add user you exceed the limit");
            }
        } else { //remove this elseif if you want to enable this for non-admins
            //redirect them to the home page because they must be an administrator to view this
             $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    //edit a user
    function edit_user($user_token = null) {
        $data['current'] = "2";
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'edit_user', $this->ion_auth->get_user_id())) {
            $loggedInUserId = $this->ion_auth->get_user_id();    
            $data['subject'] = 'edit';
                $data['title'] = "Edit User";
                $users_details = $this->users_model->get_byId('tbl_users', 'user_token', $user_token);
                $id = $users_details->user_id;
                $category_id = $users_details->category_id;
            $data['user_create_restriction'] = false;
            $loginUserID = $this->ion_auth->get_user_id();
            $user = $this->ion_auth->user($id)->row();
            $data['details'] = $user;
           
            $creatorWhere = "c_user_id = $loggedInUserId";
            $groups = $this->ion_auth->groups($creatorWhere)->result_array(); //list all the groups on the database
            $currentGroups = $this->ion_auth->get_users_groups($id)->result(); //current groups of the user id 
            //validate form input
            $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
            $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
            $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
            //$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

            if (isset($_POST) && !empty($_POST)) {
                if ($this->_valid_csrf_nonce() === FALSE ) {
                    show_error($this->lang->line('error_csrf'));
                }

                if ($this->input->post('password')) {
                    $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                    $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
                }
                //'company' => $this->input->post('company'),
                if ($this->form_validation->run() === TRUE) {
                    
//                     if ($this->ion_auth->is_admin()) {
//                            $c_user_id = $loginUserID;
//                        }else{
//                            $userID = $user->user_id;
//                            if($userID == $loginUserID){
//                                $c_user_id = 0;
//                            }else{
//                                $c_user_id = $loginUserID;
//                            }
//                            
//                        }
                    $post = array(
                        'category_id' => $this->input->post('category_id'),
                        'sub_cat_id' => $this->input->post('sub_cat_id'),
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
                        'status' => $this->input->post('status'),
                        'last_update' => date("Y-m-d"),
                    );
                    $post['home_image'] = $this->input->post('home_image');
                    $home_image = $this->input->post('fileList');
                    if (!empty($home_image)) {
                        $post['home_image'] = $home_image;
                    }

                    //update the password if it was posted
                    if ($this->input->post('password')) {
                        $post['password'] = $this->input->post('password');
                    }

                    // Only allow updating groups if user is admin
                    if ($this->ion_auth->is_admin()) {
                        //Update the groups user belongs to
                        $groupData = $this->input->post('groups');
                        if (isset($groupData) && !empty($groupData)) {
                            $this->ion_auth->remove_from_group('', $id);
                            foreach ($groupData as $grp) {
                                $this->ion_auth->add_to_group($grp, $id);
                            }
                        }
                    }

//                    echo "<pre>";
//                    print_r($post);die;
                    //check to see if we are updating the user
                    if ($this->ion_auth->update($user->user_id, $post)) {
                        $this->session->set_flashdata('success_message', $this->ion_auth->messages());
                        redirect("users/users_list", 'refresh');
                    } else {
                        $this->session->set_flashdata('error_message', $this->ion_auth->errors());
                    }
                }
            }

            //display the edit user form
            $data['csrf'] = $this->_get_csrf_nonce();
            //set the flash data error message if there is one
            $data['error_message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

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
            $data['category_list'] = $this->users_model->get_result("tbl_category");
            $data['sub_category_list'] = $this->users_model->get_result("tbl_category_sub", 'category_id', $category_id);

            $data['bootstropID1'] = 0;
            $data['bootstropID2'] = 1;
            $data['bootstropID3'] = 2;
            $data['bootstropID4'] = 3;
            $data['bootstropID5'] = 4;
            $this->_render_template_front_dashboard("users_form", $data);
        } else {
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
        //$this->_render_page('signin/users_form', $data);
    }

    function end_user_invitation() {
        $data['subject'] = 'create';
        $data['title'] = "Create User";
        if (!$this->ion_auth->logged_in()){
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'end_user_invitation', $this->ion_auth->get_user_id())) {
            
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];
                $loginUserID = $this->ion_auth->get_user_id();
                $loginUserDetails = $this->ion_auth->login_user_details();
                $tables = $this->config->item('tables', 'ion_auth');
                $creatorWhere = "c_user_id = $loginUserID";
                $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[' . $tables['end_users'] . '.email]');
                if ($this->form_validation->run() == true) {
                    $email = strtolower($this->input->post('email'));
                    $additional_data = array(
                        'c_user_id' => $loginUserID,
                        'user_token' => $this->input->post('user_token'),
                        'created_on' => date("Y-m-d"),
                    );
                }
                 if ($this->form_validation->run() == true && $this->ion_auth->invitation($email, $additional_data)) {
                         //$this->ion_auth->add_user_count();
                        $this->session->set_flashdata('success_message', $this->ion_auth->messages());
                        redirect("signin", 'refresh');
                    } else {
                        $data['error_message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
                        $data['email'] = array(
                            'name' => 'email',
                            'id' => 'email',
                            'type' => 'text',
                            'value' => $this->form_validation->set_value('email'),
                        );
                        //$data['category_list'] = $this->users_model->get_result("tbl_category");
                        //$data['sub_category_list'] = $this->users_model->get_result("tbl_category_sub");
                        $data['bootstropID1'] = 0;
                        $data['bootstropID2'] = 1;
                        $data['bootstropID3'] = 2;
                        $data['bootstropID4'] = 3;
                        $data['bootstropID5'] = 4;
                        //$this->_render_template_front_dashboard("users_form", $data);
                        $this->session->set_flashdata('error_message', $this->ion_auth->errors());
                        redirect("signin", 'refresh');
                    }
            
        } else {
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }
    
    function view_profile($user_token = null) {

        
        $data['subject'] = 'edit';
        $data['title'] = "Edit User";
        $users_details = $this->users_model->get_byId('tbl_users', 'user_token', $user_token);
        $id = $users_details->user_id;
        $category_id = $users_details->category_id;
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'view_profile', $this->ion_auth->get_user_id())) {
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id());
            
            if(strpos($groupTypeDashboardName,"users") !== false){
                $data['current'] = "1";
            }else if(strpos($groupTypeDashboardName,"clients") !== false){
                $data['current'] = "5";
            }
            $loginUserID = $this->ion_auth->get_user_id();
            $user = $this->ion_auth->user($id)->row();
            $data['details'] = $user;
            $groups = $this->ion_auth->groups()->result_array(); //list all the groups on the database
            $currentGroups = $this->ion_auth->get_users_groups($id)->result(); //current groups of the user id 
            

            $data['user'] = $user;
            $data['groups'] = $groups;
            $data['currentGroups'] = $currentGroups;

            $data['category_list'] = $this->users_model->get_result("tbl_category");
            $data['sub_category_list'] = $this->users_model->get_result("tbl_category_sub", 'category_id', $category_id);
            //$this->template->load('template', 'users_form', $data);
            if($groupTypeDashboardName == "clients"){
                $data['bootstropID1'] = "-1";
                $data['bootstropID2'] = "-1";
                $data['bootstropID3'] = "-1";
                $data['bootstropID4'] = "-1";
                //$data['bootstropIDA4'] = 1;
                $data['bootstropID5'] = "-1";
                $data['bootstropIDA5'] = 0;
                $data['bootstropID6'] = "-1";
                $data['bootstropID7'] = "-1";
                $data['bootstropID8'] = "-1";
            }else if($groupTypeDashboardName == "users"){
                $data['bootstropID1'] = "-1";
                $data['bootstropID2'] = "-1";
                $data['bootstropID3'] = "-1";
                
                $data['bootstropIDA5'] = 0;
                
            }
            
            $this->_render_template_front_dashboard("profile_view", $data);
        } else { 
             $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
        
    }
    
     function edit_profile($user_token = null) {

        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'edit_profile', $this->ion_auth->get_user_id())) {
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id());
            
            if(strpos($groupTypeDashboardName,"users") !== false){
                $data['current'] = "1";
            }else if(strpos($groupTypeDashboardName,"clients") !== false){
                $data['current'] = "5";
            }
            
            $data['subject'] = 'edit';
            $data['title'] = "Edit User";
            $users_details = $this->users_model->get_byId('tbl_users', 'user_token', $user_token);
            $id = $users_details->user_id;
            $category_id = $users_details->category_id;
            
            $loginUserID = $this->ion_auth->get_user_id();
            $user = $this->ion_auth->user($id)->row();
            $data['details'] = $user;
            $groups = $this->ion_auth->groups()->result_array(); //list all the groups on the database
            $currentGroups = $this->ion_auth->get_users_groups($id)->result(); //current groups of the user id 
            //validate form input
            $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required');
            $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required');
            $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required');
            //$this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required');

            if (isset($_POST) && !empty($_POST)) {
                //if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('user_id')) {
                if ($this->_valid_csrf_nonce() === FALSE ) {
                    show_error($this->lang->line('error_csrf'));
                }

                if ($this->input->post('password')) {
                    $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
                    $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');
                }
                //'company' => $this->input->post('company'),
                        if ($this->ion_auth->is_admin()) {
                            $c_user_id = $loginUserID;
                        }else{
                            $userID = $user->user_id;
                            if($userID == $loginUserID){
                                $c_user_id = '';
                            }else{
                                $c_user_id = $loginUserID;
                            }
                            
                        }
                if ($this->form_validation->run() === TRUE) {
                    
                    $post = array(
                        //'category_id' => $this->input->post('category_id'),
                        //'sub_cat_id' => $this->input->post('sub_cat_id'),
                        //'c_user_id' => $c_user_id,
                        'first_name' => $this->input->post('first_name'),
                        'last_name' => $this->input->post('last_name'),
                        'phone' => $this->input->post('phone'),
                        'email' => $this->input->post('email'),
                        'address' => $this->input->post('address'),
                        'lat' => $this->input->post('lat'),
                        'lng' => $this->input->post('lng'),
                        'information' => $this->input->post('information'),
                        'phone' => $this->input->post('phone'),
                        'username' => $this->input->post('username'),
                        'user_token' => $this->input->post('user_token'),
                        'last_update' => date("Y-m-d"),
                    );
                    $post['home_image'] = $this->input->post('home_image');
                    $home_image = $this->input->post('fileList');
                    if (!empty($home_image)) {
                        $post['home_image'] = $home_image;
                    }

                    //update the password if it was posted
                    if ($this->input->post('password')) {
                        $post['password'] = $this->input->post('password');
                    }

                    // Only allow updating groups if user is admin
                    if ($this->ion_auth->is_admin()) {
                        //Update the groups user belongs to
                        $groupData = $this->input->post('groups');
                        if (isset($groupData) && !empty($groupData)) {
                            $this->ion_auth->remove_from_group('', $id);
                            foreach ($groupData as $grp) {
                                $this->ion_auth->add_to_group($grp, $id);
                            }
                        }
                    }

                    //check to see if we are updating the user
                    if ($this->ion_auth->update($user->user_id, $post)) {
                        //redirect them back to the admin page if admin, or to the base url if non admin
                        $this->session->set_flashdata('success_message', $this->ion_auth->messages());
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
            $data['csrf'] = $this->_get_csrf_nonce();
            //set the flash data error message if there is one
            $data['error_message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

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
//            $data['company'] = array(
//                'name' => 'company',
//                'id' => 'company',
//                'type' => 'text',
//                'value' => $this->form_validation->set_value('company', $user->company),
//            );
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
            $data['category_list'] = $this->users_model->get_result("tbl_category");
            $data['sub_category_list'] = $this->users_model->get_result("tbl_category_sub", 'category_id', $category_id);
            //$this->template->load('template', 'users_form', $data);
            $data['bootstropID1'] = 0;
            $data['bootstropID2'] = 1;
            $data['bootstropID3'] = 2;
            $data['bootstropID4'] = 3;
            $data['bootstropID5'] = 4;
            $this->_render_template_front_dashboard("profile_form", $data);
        } else { //remove this elseif if you want to enable this for non-admins
            //redirect them to the home page because they must be an administrator to view this
             $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
        //$this->_render_page('signin/users_form', $data);
    }
    
    function delete_user($user_token = null) {
        $data['subject'] = 'delete';
        //if(!empty($user_token)){
        $users_details = $this->users_model->get_byId('tbl_users', 'user_token', $user_token);
        $id = $users_details->user_id;
        //}
        $data['title'] = "Edit User";
        if (!$this->ion_auth->logged_in()) {
            redirect("signin", 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'delete_user', $this->ion_auth->get_user_id())) {
            $user = $this->ion_auth->delete_user($id);
            //redirect('signin/users/users', 'refresh');
            redirect('users/users_list', 'refresh');
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
        $this->general_model->update('tbl_users', $post, 'user_id = ' . $id);
        echo $data['status'];
    }

    public function search_groups() {
        $keyword = $this->input->post('group_keywords');
        $userID = $this->ion_auth->get_user_id();
        $query = $this->users_model->getGroups($keyword,$userID);
        echo json_encode($query);
    }
    
    function list_group() {
        $data['current'] = 4;
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'list_group', $this->ion_auth->get_user_id())) {
            $loginUserID = $this->ion_auth->get_user_id();
            
            $data['groups'] = $this->users_model->get_results('tbl_groups','group_type','users',"c_user_id",$loginUserID);
            //$this->template->load('template', 'group_list', $data);
            $data['bootstropID1'] = "-1";
            $data['bootstropID2'] = "-1";
            $data['bootstropID3'] = "-1";
            $data['bootstropIDA3'] = 0;
            $data['bootstropID4'] = "-1";
            $data['bootstropID5'] = "-1";
            $data['bootstropID6'] = "-1";
            $data['bootstropID7'] = "-1";
            $data['bootstropID8'] = "-1";
            $data['current'] = "1";
            $this->_render_template_front_dashboard("group_list", $data);
        } else {
             $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }
    function create_group(){
        $data['subject'] = 'create';
        $data['current'] = "1";
        $data['title'] = "Create Groups for your user";
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'create_group', $this->ion_auth->get_user_id())) {
            $loginUserId = $this->ion_auth->get_user_id();
            $this->form_validation->set_rules('name', $this->lang->line('create_group_validation_name_label'), 'required|alpha_dash');
            if ($this->form_validation->run() == TRUE) {
                //$additionalData = array("group_type"=>$this->input->post('group_type'));
                $additionalData = array(
                    "group_type"=>$this->input->post('group_type'),
                    "c_user_id"=>$loginUserId
                    );
                $new_group_id = $this->ion_auth->create_group($this->input->post('name'), $this->input->post('description'),$additionalData);
                if ($new_group_id) {
                    $this->session->set_flashdata('message', $this->ion_auth->messages());
                    redirect("users/list_group", 'refresh');
                }elseif($new_group_id == FALSE){
                    $this->session->set_flashdata('error_message', $this->ion_auth->errors());
                    redirect("users/create_group", 'refresh');
                }
            } else {
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
                $data['bootstropID1'] = 0;
                $data['bootstropID2'] = 1;
                $data['bootstropID3'] = 2;
                $data['bootstropID4'] = 3;
                $data['bootstropID5'] = 4;
                $this->_render_template_front_dashboard("group_form", $data);
                
            }
        } else {
             $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    function edit_group($id) {
        $data['subject'] = 'edit';
        $data['current'] = "1";
        $data['title'] = "Update Groups for your user";
        if (!$id || empty($id)) {
            redirect("signin", 'refresh');
        }
        $data['title'] = $this->lang->line('edit_group_title');
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'edit_group', $this->ion_auth->get_user_id())) {
            $loginUserId = $this->ion_auth->get_user_id();
            $group = $this->ion_auth->group($id)->row();
            $data['details'] = $group;
            $this->form_validation->set_rules('name', $this->lang->line('edit_group_validation_name_label'), 'required|alpha_dash');
            if (isset($_POST) && !empty($_POST)) {
                if ($this->form_validation->run() === TRUE) {
                    //$additional_data = array("description"=>$_POST['description'],"group_type"=>$_POST['group_type'],);
                    $additionalData = array(
                        "description"=>$this->input->post('description'),
                        "group_type"=>$this->input->post('group_type'),
                        "c_user_id"=>$loginUserId
                    );
                    $group_update = $this->ion_auth->update_group($id, $_POST['name'], $additional_data);
                    if ($group_update) {
                        $this->session->set_flashdata('message', $this->lang->line('edit_group_saved'));
                    } else {
                        $this->session->set_flashdata('message', $this->ion_auth->errors());
                    }
                    redirect("users/list_group", 'refresh');
                }
            }
            $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
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
            $data['bootstropID1'] = 0;
            $data['bootstropID2'] = 1;
            $data['bootstropID3'] = 2;
            $data['bootstropID4'] = 3;
            $data['bootstropID5'] = 4;
            $this->_render_template_front_dashboard("group_form", $data);
            //$this->_render_page('signin/group_form', $data);
        } else {
             $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }

    function delete_group($group_id = null) {
        $data['subject'] = 'delete';
        $data['current'] = "1";
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'delete_group', $this->ion_auth->get_user_id())) {
            $group = $this->ion_auth->delete_group($group_id);
            redirect('users/list_group', 'refresh');
        } else {
             $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }
    
    
     public function search_support() {
        $keyword = $this->input->post('support_keywords');
        
        $userID = $this->ion_auth->get_user_id();
        $query = $this->users_model->getUsers($keyword, $userID);
        echo json_encode($query);
    }
    
    
    function support() {
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'support', $this->ion_auth->get_user_id())) {
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];

            if(strpos($groupTypeDashboardName,"users") !== false){
                $data['current'] = "3";
            }else if(strpos($groupTypeDashboardName,"clients") !== false){
                $data['current'] = "4";
            }
            
            $categoryId = null;
            $creatorUserId = $login_userID = $this->ion_auth->get_user_id();
            
            //get_join_result($select="*",$fromTable=null,$innerJoinTable1=null,$onJoinFrom1=null,$innerJoinTable2=null,$onJoinFrom2=null,$where=null)
            if($groupTypeDashboardName =='users'){
                $select = "*";//"t.ticket_id,t.ticket_token,t.category_id,t.sub_cat_id,t.user_id,t.temp_id,t.subject,t.content,t.date, ut.template_title,ut.tag_keywords, u.ticket_u_id, u.username,u.first_name,u.last_name,u.email";
                //$data['ticket_list'] = $this->general_db_model->get_join_result($select,"tbl_tickets ti","tbl_users_templates ut","ti.temp_id = ut.temp_id","tbl_users u","ti.user_id = u.user_id","ti.user_id='$login_userID'");
                $data['ticket_list'] = $this->general_db_model->get_join_result($select,"tbl_tickets ti","","","tbl_users u","ti.ticket_u_id = u.user_id","ti.user_id='$login_userID'");
                $pageName = "ticket_list";
            }elseif($groupTypeDashboardName =='clients'){
                $select = "*";//"t.ticket_id,t.ticket_token,t.category_id,t.sub_cat_id,t.user_id,t.temp_id,t.subject,t.content,t.date, ut.template_title,ut.tag_keywords, u.ticket_u_id, u.username,u.first_name,u.last_name,u.email";
                //$data['ticket_list'] = $this->general_db_model->get_join_result($select,"tbl_tickets ti","tbl_users_templates ut","ti.temp_id = ut.temp_id","tbl_users u","ti.user_id = u.user_id","ti.ticket_u_id='$login_userID'");
                $data['ticket_list'] = $this->general_db_model->get_join_result($select,"tbl_tickets ti","","","tbl_users u","ti.ticket_u_id = u.user_id","ti.ticket_u_id='$login_userID'");
                $pageName = "ticket_client_list";
            }
          
            $data['bootstropID1'] = "-1";
            $data['bootstropIDA1'] = "-1";
            $data['bootstropID2'] = "-1";
            $data['bootstropID3'] = "-1";
            $data['bootstropID4'] = "-1";
            $data['bootstropIDA4'] = 0;
            $data['bootstropID5'] = "-1";
            $data['bootstropID6'] = "-1";
            $data['bootstropID7'] = "-1";
            $data['bootstropID8'] = "-1";
            $this->_render_template_front_dashboard("$pageName",$data);
        } else {
             $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }
    
    function support_view($ticket_token=null) {
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'support_view', $this->ion_auth->get_user_id())) {
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];

            if(strpos($groupTypeDashboardName,"users") !== false){
                $data['current'] = "3";
            }else if(strpos($groupTypeDashboardName,"clients") !== false){
                $data['current'] = "4";
            }
            
            $categoryId = null;
            $creatorUserId = $login_userID = $this->ion_auth->get_user_id();
            $data['ticket_details'] = $ticket_details = $this->users_model->get_row("tickets",'ticket_token',$ticket_token);
            $ticket_id = $ticket_details->ticket_id;
            //get_join_result($select="*",$fromTable=null,$innerJoinTable1=null,$onJoinFrom1=null,$innerJoinTable2=null,$onJoinFrom2=null,$where=null)
            if($groupTypeDashboardName =='users'){
                
                $select = "*";//"t.ticket_id,t.ticket_token,t.category_id,t.sub_cat_id,t.user_id,t.temp_id,t.subject,t.content,t.date, ut.template_title,ut.tag_keywords, u.ticket_u_id, u.username,u.first_name,u.last_name,u.email";
                $data['ticket_replies'] = $this->general_db_model->get_join_result($select,"tbl_tickets_replies tr","","","tbl_users u","tr.replier_id = u.user_id","tr.ticket_id='$ticket_id'");
                $pageName = "ticket_view";
            }elseif($groupTypeDashboardName =='clients'){
                $select = "*";//"t.ticket_id,t.ticket_token,t.category_id,t.sub_cat_id,t.user_id,t.temp_id,t.subject,t.content,t.date, ut.template_title,ut.tag_keywords, u.ticket_u_id, u.username,u.first_name,u.last_name,u.email";
                $data['ticket_replies'] = $this->general_db_model->get_join_result($select,"tbl_tickets_replies tr","","","tbl_users u","tr.replier_id = u.user_id","tr.ticket_id='$ticket_id'");
                $pageName = "ticket_view";
            }
//          echo "<pre>";
//          print_r($data['ticket_replies']);die;
            $data['bootstropID1'] = "-1";
            $data['bootstropIDA1'] = "-1";
            $data['bootstropID2'] = "-1";
            $data['bootstropID3'] = "-1";
            $data['bootstropID4'] = "-1";
            $data['bootstropIDA4'] = 0;
            $data['bootstropID5'] = "-1";
            $data['bootstropID6'] = "-1";
            $data['bootstropID7'] = "-1";
            $data['bootstropID8'] = "-1";
            $this->_render_template_front_dashboard("$pageName",$data);
            //$this->_render_template_front_dashboard("support_view",$data);
        } else {
             $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }
    
    function support_reply() {
        $data['page_title'] = "Support Reply";
        $post['ticket_id'] = $ticket_id = $this->input->post('ticket_id');
        $post['replier'] = $replier =$this->input->post('replier');
        $post['replier_id'] = $user_id = $this->input->post('replier_id');
        $post['content'] = $this->input->post('content');

        $from_details = $this->users_model->get_row("users",'user_id',$user_id);
            $from_fullname = $from_details->first_name ." ".$from_details->last_name;
            $from_email = $from_details->email;
        $to_details = $this->general_db_model->get_join_row("*","tbl_users u","tbl_users_groups ug","u.user_id = ug.user_id","tbl_groups g","ug.group_id = g.group_id","g.group_type='superAdmin'");
            $to_fullname = $to_details->first_name ." ".$to_details->last_name;
            $to_email = $to_details->email;
        $ticket_details = $this->users_model->get_row("tickets",'ticket_id',$ticket_id);
            $ticket_token = $ticket_details->ticket_token;
            $subject = $ticket_details->subject;
            $content = $ticket_details->body;
            $ip_address = $this->get_ip_address();
        
        $post['time'] = date("Y-m-d H:i:s");
//        if (!empty($token)){
//            $reportDetails = $this->general_model->getById('report_issue', 'report_token', $token);
//            $report_id = $reportID = $reportDetails->r_id;
//            if (!empty($reportID)){
//                $this->general_model->update('report_issue', $post, 'r_id = ' . $reportID);
//            }
//            //$this->session->set_flashdata('display_message', 'Page successfully updated.');
//        } else {
            $t_reply_id = $this->general_model->insert('tickets_replies', $post);
            
            //$this->session->set_flashdata('display_message', 'Page successfully added.');
//        }
        
        $message = "<table width='570' border='0' cellspacing='0' cellpadding='0' align='center' style='color:#1ABE67'>
                    Ticket #$subject has been responded by the $replier. 

                    <tr>
                        <td height='30' class='txt3'>Subject</td>
                        <td height='30'><label>
                        $subject
                        </label></td>
                    </tr>
                    <tr>
                        <td width='188' height='30' class='txt3'>User Name</td>
                        <td width='382' height='30'><label>
                        $from_fullname
                        </label></td>
                    </tr>
                    <tr>
                        <td width='188' height='30' class='txt3'>Email</td>
                        <td width='382' height='30'><label>
                        $from_email
                        </label></td>
                    </tr>
                    <tr>
                        <td width='188' height='30' class='txt3'>Message</td>
                        <td width='382' height='30'><label>
                        $content
                        </label></td>
                    </tr>
                </table>
        ";
        $this->send_email($from_email, "Support", $message, $to_email,$ticket_id,$ticket_token);
        redirect("users/support_view/$ticket_token");
        
    }
    
    
    function send_email($from_email=null,$subject=null,$message=null,$to_email=null,$ticket_id=null,$ticket_token=null) {
            $data['title'] = "Send Report Issue";
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
            $this->email->from($from_email, "Template Report");
            $this->email->to($to_email);
            $this->email->subject("$subject");
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
                $this->general_db_model->update('tickets', $post, 'ticket_id = ' . $ticket_id);

                $this->session->set_flashdata('message', "Your message has been send to Administrator");
            } else {
                $post['sent_email'] = '0';
                $this->general_db_model->update('tickets', $post, 'ticket_id = ' . $ticket_id);

                $this->session->set_flashdata('message', "Your message has not been send to Administrator!!!");
            }

            redirect("users/support_view/$ticket_token");
    }
    
    function send_user_email($user_token = null) {
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("users/users", 'send_user_email', $this->ion_auth->get_user_id())) {
            $data['title'] = "Send Email to Users";
            $users_details = $this->users_model->get_byId('tbl_users', 'user_token', $user_token);
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
            $this->general_db_model->update('tbl_users', $post, 'user_id = ' . $id);

            $adminsEmail = $this->users_model->get_emailId('tbl_admins');
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
                $this->general_db_model->update('tbl_users', $post, 'user_id = ' . $id);

                $this->session->set_flashdata('message', "Your message has been send to $userFullName with their user details and password Set");
            } else {
                $post['sent_email'] = '0';
                $this->general_db_model->update('tbl_users', $post, 'user_id = ' . $id);

                $this->session->set_flashdata('message', "Your message has not been send to $userFullName Please Try again !!!");
            }

            redirect("signin/users/users");
        } else { //remove this elseif if you want to enable this for non-admins
            //redirect them to the home page because they must be an administrator to view this
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

    //============================== Template Question Answers Download end
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

}
?>
