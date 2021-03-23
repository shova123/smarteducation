<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permissions extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('permissions_model');
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
            redirect('signin/login', 'refresh');
        } else{
            //if ($this->ion_auth->has_permission("permissions/permissions", 'index', $this->ion_auth->get_user_id())) {
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            //$data['permissions'] = $this->permissions_model->get_resultsUnique("permissions",'','','','controller');
            $data['permissions'] = $this->permissions_model->get_results("permissions");
            //$data['signin_class'] = $this->signin_model->get_all_methods("signin");
//            foreach ($data['users'] as $k => $user) {
//                
//                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->user_id)->result();
//            }
            $data['current'] = 7;
            //$data['sub_current'] = 2; 
            $this->template->load('template', 'permissions_list', $data);
        }
//        else {
//            return show_error('You Dont have permission to view this page.');
//        }
    }

    function create_permissions() {
        $data['page_title'] = 'Add Permission';
        $data['subject'] = 'add';
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("permissions/permissions", 'create_permissions', $this->ion_auth->get_user_id())) {
            if ($this->input->post('submitDetails')) {
                $this->permissions_add_edit();
                die();
            }
            //////////////// sample start
            //list the permission to admin
            //$this->load->module('module/controller');
            //$this->controller->method(classname);
            //$this->load->module("users/users");//module/contorller
            //$usersAllMethods = $this->admin->get_all_methods('admin');//controller->get_all_methods(class);
            //////////////// sample end
            //////////////////// get_controller_required_methods("moduleName/controllerName","className",OnlyIncludeMethodsIN);
//            $signinIncludeMethods = array('create', 'edit', 'update', 'delete', 'list', 'dashboard');
//            $signinExcludedMethods = $this->general_db_model->get_controller_required_methods("signin/signin", "signin", $signinIncludeMethods);
//            $usersIncludeMethods = array('add', 'create', 'edit', 'update', 'delete', 'list', 'dashboard');
//            $usersExcludedMethods = $this->general_db_model->get_controller_required_methods("users/users", "users", $usersIncludeMethods);
//            $categoryIncludeMethods = array('add', 'create', 'edit', 'update', 'delete', 'list', 'dashboard');
//            $categoryExcludedMethods = $this->general_db_model->get_controller_required_methods("category/category", "admin", $categoryIncludeMethods);
//            $data['ModuleControllerMethods'] = $controllerMethods = array_merge($signinExcludedMethods, $usersExcludedMethods, $categoryExcludedMethods);
            $signinIncludeMethods['signin/signin'] = array('superAdmin_dashboard', 'manager_dashboard', 'clients_dashboard', 'users_dashboard','create_user','edit_user','edit_profile','delete_user','list_group','create_group','edit_group','delete_group','login_as');
            $usersIncludeMethods = array('add', 'create', 'edit', 'update', 'delete', 'list', 'dashboard');
            //$categoryIncludeMethods['category/category'] = array('category_list','category_add', 'category_edit', 'category_delete', 'category_sub', 'category_sub_add', 'category_sub_edit');
            //$templatesIncludeMethods['templates/templates'] = array('templates_list','templates_add', 'templates_edit', 'templates_delete','form_builder','answers_list');
            $userIncludeMethods['users/users'] = array('dashboard','users','send_user_email','users_list', 'create_user', 'edit_user','view_profile','edit_profile','delete_user','list_group','create_group','edit_group','delete_group','end_user_invitation','support','support_view','support_add','support_edit');
            //$ticketIncludeMethods['ticket/ticket'] = array('ticket_list');
            //$helpIncludeMethods['help/help'] = array('help_list','help_add','help_edit','help_delete');
            
            $data['ModuleControllerMethods'] = $controllerMethods = array_merge($signinIncludeMethods, $userIncludeMethods);
            $data['groups'] = $this->ion_auth->groups()->result_array(); //list all the groups on the database

        $this->template->load('template', 'permissions_form', $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function edit_permissions($token) {
        $data['title'] = "Edit Permissions";
        $data['subject'] = 'edit';
        if (!$this->ion_auth->logged_in()) {
             redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("permissions/permissions", 'edit_permissions', $this->ion_auth->get_user_id())) {
            $data['details'] = $details = $this->permissions_model->get_byId('permissions', 'token', $token);
            $id = $details->p_id;
            $moduleController = $details->controller;
            if ($this->input->post('submitDetails')) {
                $this->permissions_add_edit($id);
                die();
            }
            $explode = explode("/", $moduleController);
            foreach ($explode as $keys => $value) {
                $class = $value;
            }
            $moduleControllerName = $class;
            $includeMethods = array('add','create', 'edit', 'update', 'delete', 'list', 'dashboard');
            $data['ModuleControllerMethodsSelect'] = $this->general_db_model->get_controller_required_methods($moduleController, $moduleControllerName, $includeMethods);

//            $signinIncludeMethods = array('create', 'edit', 'update', 'delete', 'list', 'dashboard');
//            $signinExcludedMethods = $this->general_db_model->get_controller_required_methods("signin/signin", "signin", $signinIncludeMethods);
            $usersIncludeMethods = array('add', 'create', 'edit', 'update', 'delete', 'list', 'dashboard');
//            $usersExcludedMethods = $this->general_db_model->get_controller_required_methods("users/users", "users", $usersIncludeMethods);
//            $categoryIncludeMethods = array('add', 'create', 'edit', 'update', 'delete', 'list', 'dashboard');
//            $categoryExcludedMethods = $this->general_db_model->get_controller_required_methods("category/category", "admin", $categoryIncludeMethods);
            $signinIncludeMethods['signin/signin'] = array('superAdmin_dashboard', 'manager_dashboard', 'clients_dashboard', 'users_dashboard','create_user','edit_user','edit_profile','delete_user','list_group','create_group','edit_group','delete_group','login_as');
            //$usersIncludeMethods = array('add', 'create', 'edit', 'update', 'delete', 'list', 'dashboard');
            //$categoryIncludeMethods['category/category'] = array('category_list','category_add', 'category_edit', 'category_delete', 'category_sub', 'category_sub_add', 'category_sub_edit');
            //$templatesIncludeMethods['templates/templates'] = array('templates_list','templates_add', 'templates_edit', 'templates_delete','form_builder','answers_list');
            $userIncludeMethods['users/users'] = array('dashboard','users','send_user_email','users_list', 'create_user', 'edit_user','view_profile','edit_profile','delete_user','list_group','create_group','edit_group','delete_group','end_user_invitation','support','support_view','support_add','support_edit');
            //$ticketIncludeMethods['ticket/ticket'] = array('ticket_list');
            //$helpIncludeMethods['help/help'] = array('help_list','help_add','help_edit','help_delete');
                        
            $data['ModuleControllerMethods'] = $controllerMethods = array_merge($signinIncludeMethods, $userIncludeMethods);

            $data['groups'] = $this->ion_auth->groups()->result_array(); //list all the groups on the database

        $this->template->load('template', 'permissions_form', $data);
        } else {
          return show_error('You Dont have permission to view this page.');
        }
    }

    function permissions_add_edit($id = null) {
        
        $postDetail['permission_title'] = $this->input->post('permission_title');
        
        $postPermission['token'] = $postDetail['token'] = $this->input->post('token');
        $postPermission['controller'] = $controller = $this->input->post('controller');
        $actionsARR = $this->input->post('actions');
        
        
        $postPermission['description'] = $this->input->post('description');
        $groups = $this->input->post('groups');
        $grp = '';
        foreach ($groups as $grpVal) {
            $grp = $grp . $grpVal . ",";
        }
        $total_groups = trim($grp, ",");
        $postPermission['groups'] = $total_groups;
        $postPermission['user_id'] = $this->input->post('user_id');
        $postPermission['status'] = $postDetail['status'] = $this->input->post('status');
        $postPermission['date'] =  date("Y-m-d H:i:s");

       
        if ($id) {
            $this->general_db_model->update('permissions_detail', $postDetail, 'p_d_id = ' . $p_d_id);
            $this->session->set_flashdata('message', 'Page successfully updated.');
        } else {
            $this->general_db_model->insert('permissions_detail', $postDetail);
            foreach ($actionsARR as $acKey=>$acValue){
                $postPermission['actions'] = $actions = $acValue; 
               
                $alreadyExist = $this->general_db_model->value_existMore('permissions', 'controller', $controller, 'actions', $actions);

                if ($alreadyExist == true) {
                    $this->session->set_flashdata('message', "You have already created the Permission of($controller) with ($actions)");
                } else {
                    $this->general_db_model->insert('permissions', $post);
                    $this->session->set_flashdata('message', 'Page successfully added.');
                }
            }
        }

        redirect("permissions");
    }

    function delete_permissions($token = null) {
        if (!$this->ion_auth->logged_in()) {
            redirect('signin/login', 'refresh');
        } else if ($this->ion_auth->has_permission("permissions/permissions", 'delete_permissions', $this->ion_auth->get_user_id())) {
            $data['subject'] = 'delete';
            $permissionDetails = $this->permissions_model->get_byId('permissions', 'token', $token);
            $id = $permissionDetails->p_id;
            $data['title'] = "Delte Permission";
            if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->user_id == $id))) {
                redirect("signin", 'refresh');
            }
            $this->general_db_model->delete("permissions", "p_id =$id");
            redirect("permissions");
        } else { 
        return show_error('You Dont have permission to view this page.');
        }
    }

    function update_permissions_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Publish') {
            $data['status'] = 'Unpublish';
        } else {
            $data['status'] = 'Publish';
        }
        $this->general_model->update('permissions', $data, 'p_id = ' . $id);
        echo $data['status'];
    }

    function _render_page($view, $data = null, $render = false) {
        $this->viewdata = (empty($data)) ? $data : $data;
        $view_html = $this->load->view($view, $this->viewdata, $render);
        if (!$render)
            return $view_html;
    }

}
