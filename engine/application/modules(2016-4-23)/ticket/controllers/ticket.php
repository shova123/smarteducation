<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ticket extends MX_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('ticket_model');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    function index() {
        $data['page_name'] = 'Ticket';
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("ticket/ticket", 'index', $this->ion_auth->get_user_id())) {
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            if ($this->session->userdata('user_id') != "") {
                $userID = $this->session->userdata('user_id');
            }
            $data['users_details'] = $this->ticket_model->get_admins('users', 'user_id', $userID);
            $data['users_groups'] = $users_groups = $this->ticket_model->get_results('users_groups', 'user_id', $userID, 'id');
            $groupsName = '';
            foreach ($users_groups as $values) {
                $groupID = $values->group_id;
                $group_details = $this->ticket_model->get_admins('groups', 'group_id', $groupID);
                $groupName = $group_details->name;
                $groupsName.= "$groupName,";
            }$trimGroupName = trim($groupsName, ',');
            $this->session->set_userdata(array('groupNames' => $trimGroupName));
            $data['users'] = $this->ion_auth->users()->result();
            foreach ($data['users'] as $k => $user) {
                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->user_id)->result();
            }

            $redirectController = "signin";
            redirect("$redirectController/$groupTypeDashboardName" . "_dashboard", 'location');
        } else {
            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
            redirect("signin/login", 'refresh');
        }
    }
    function ticket_list() {
        $data['page_name'] = 'Ticket List';
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("ticket/ticket", 'ticket_list', $this->ion_auth->get_user_id())) {
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];
            $userID = $this->ion_auth->get_user_id();
            $data['users_details'] = $this->ticket_model->get_admins('users', 'user_id', $userID);
            $data['users_groups'] = $users_groups = $this->ticket_model->get_result('users_groups', 'user_id', $userID, 'id');
            
            $data['tickets_list'] = $this->ticket_model->get_result('tickets');
            
            $redirectController = "signin";
            $this->_render_template("ticket_list",$data);
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

}
?>