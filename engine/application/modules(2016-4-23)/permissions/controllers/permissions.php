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
            $data['permissions'] = $this->permissions_model->get_results("permissions",'','',"controller !='permissions/permissions'");
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
            
            $signinIncludeMethods['signin/signin'] = array('superAdmin_dashboard', 'manager_dashboard', 'clients_dashboard', 'users_dashboard','list_user','create_user','edit_user','edit_profile','delete_user','list_group','create_group','edit_group','delete_group','login_as');
            
            $userIncludeMethods['users/users'] = array('dashboard','users','send_user_email','users_list', 'create_user', 'edit_user','view_profile','edit_profile','delete_user','list_group','create_group','edit_group','delete_group','end_user_invitation','support','support_view','support_add','support_edit');
            
            $courseIncludeMethods['course/course'] = array('board','board_add','board_edit','board_delete','list_level','add_level','edit_level','delete_level','list_stream','add_stream','edit_stream','delete_stream','list_department','add_department','edit_department','delete_department','list_subject','add_subject','edit_subject','delete_subject','list_chapter','add_chapter','edit_chapter','delete_chapter','list_unit','add_unit','edit_unit','delete_unit');
            
            $dataIncludeMethods['data/data'] = array('list_question','add_question','edit_question','delete_question');
            
            $pagesIncludeMethods['pages/pages'] = array('page_list','add_page','edit_page','delete_page','subpages','subpages_add','subpages_edit','subpages_delete');
            
            $settingsIncludeMethods['settings/settings'] = array('settings_list','settings_add', 'settings_edit', 'settings_delete');
            
            $data['ModuleControllerMethods'] = $controllerMethods = array_merge($signinIncludeMethods, $userIncludeMethods, $courseIncludeMethods,$dataIncludeMethods,$pagesIncludeMethods,$settingsIncludeMethods);
            $data['groups'] = $this->ion_auth->groups()->result(); //list all the groups on the database

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
//            $explode = explode("/", $moduleController);
//            foreach ($explode as $keys => $value) {
//                $class = $value;
//            }
//            $moduleControllerName = $class;
//            $includeMethods = array('add','create', 'edit', 'update', 'delete', 'list', 'dashboard');
//            $data['ModuleControllerMethodsSelect'] = $this->general_db_model->get_controller_required_methods($moduleController, $moduleControllerName, $includeMethods);
//
//            $usersIncludeMethods = array('add', 'create', 'edit', 'update', 'delete', 'list', 'dashboard');
            
            $signinIncludeMethods['signin/signin'] = array('superAdmin_dashboard', 'manager_dashboard', 'clients_dashboard', 'users_dashboard','list_user','create_user','edit_user','edit_profile','delete_user','list_group','create_group','edit_group','delete_group','login_as');
            
            $userIncludeMethods['users/users'] = array('dashboard','users','send_user_email','users_list', 'create_user', 'edit_user','view_profile','edit_profile','delete_user','list_group','create_group','edit_group','delete_group','end_user_invitation','support','support_view','support_add','support_edit');

            $courseIncludeMethods['course/course'] = array('board','board_add','board_edit','board_delete','list_level','add_level','edit_level','delete_level','list_stream','add_stream','edit_stream','delete_stream','list_department','add_department','edit_department','delete_department','list_subject','add_subject','edit_subject','delete_subject','list_chapter','add_chapter','edit_chapter','delete_chapter','list_unit','add_unit','edit_unit','delete_unit');
            
            $dataIncludeMethods['data/data'] = array('list_question','add_question','edit_question','delete_question');
            
            $pagesIncludeMethods['pages/pages'] = array('page_list','add_page','edit_page','delete_page','subpages','subpages_add','subpages_edit','subpages_delete');
            
            $settingsIncludeMethods['settings/settings'] = array('settings_list','settings_add', 'settings_edit', 'settings_delete');
            
            $data['ModuleControllerMethods'] = $controllerMethods = array_merge($signinIncludeMethods, $userIncludeMethods, $courseIncludeMethods,$dataIncludeMethods,$pagesIncludeMethods,$settingsIncludeMethods);
            $data['groups'] = $this->ion_auth->groups()->result(); //list all the groups on the database

        $this->template->load('template', 'permissions_form', $data);
        } else {
          return show_error('You Dont have permission to view this page.');
        }
    }

    function permissions_add_edit($id = null) {
        
        $post['token'] = $this->input->post('token');
        $post['permission_title'] = $this->input->post('permission_title');
        $post['controller'] = $controller = $this->input->post('controller');
        $actions = $this->input->post('actions');
            $act = '';
            foreach ($actions as $actVal) {
                $act = $act . $actVal . ",";
            }
            $total_actions = trim($act, ",");
            $post['actions'] = $total_actions;
        //$post['description'] = $this->input->post('description');
        $groups = $this->input->post('groups');
            $grp = '';
            foreach ($groups as $grpVal) {
                $grp = $grp . $grpVal . ",";
            }
            $total_groups = trim($grp, ",");
            $post['groups'] = $total_groups;
        $post['user_id'] = $this->input->post('user_id');
        $post['status'] = $this->input->post('status');
        $post['date'] = date("Y-m-d H:i:s");

       
        if ($id) {
            $this->general_db_model->update('permissions', $post, 'p_id = ' . $id);
            $this->session->set_flashdata('message', 'Page successfully updated.');
        } else {
            //$alreadyExist = $this->general_db_model->value_existMore('permissions', 'controller', $controller, 'actions', $actions);

//            if ($alreadyExist == true) {
//                $this->session->set_flashdata('message', "You have already created the Permission of($controller) with ($actions)");
//            } else {
                $this->general_db_model->insert('permissions', $post);
                $this->session->set_flashdata('message', 'Page successfully added.');
            //}
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
