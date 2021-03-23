<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('settings_model');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    public function get_all_methods($class_name = null) {
        return get_class_methods($class_name);
    }

    function index() {
        $this->settings_list();
    }

    function settings_list() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("settings/settings", 'settings_list', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Settings";
            $data['settings_list'] = $this->settings_model->get_settings("settings");
            $data['current'] = 2;
            $data['sub_current'] = 1;
            $this->_render_template("settings_list", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function settings_add() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("settings/settings", 'settings_add', $this->ion_auth->get_user_id())) {
            if ($this->input->post('submitDetail')) {
                $this->add_edit_settings();
                die();
            }
            $data['page_title'] = 'Add Settings';
            $data['current'] = 2;
            $data['sub_current'] = 1;
            $this->_render_template("settings_form", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function settings_edit($id) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("settings/settings", 'settings_edit', $this->ion_auth->get_user_id())) {

            if ($this->input->post('submitDetail')) {
                $this->add_edit_settings($id);
                die();
            }
            $data['details'] = $this->general_db_model->getById('settings', 'setting_id', $id);
            $data['page_title'] = "Edit Settings";
            $data['current'] = 2;
            $data['sub_current'] = 1;
            $this->_render_template("settings_form", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function add_edit_settings($id = NULL) {
        //$post['token'] = $this->input->post('token');
        $post['setting_title'] = $this->input->post('setting_title');
        $post['setting_slug'] = $this->input->post('setting_slug');
        $post['setting_type'] = $setting_type = $this->input->post('setting_type');
        $post['setting_action'] = $setting_action = $this->input->post('setting_action');
        $post['header'] = $this->input->post('header');
        $post['footer'] = $this->input->post('footer');
        
        $post['status'] = $this->input->post('status');
        $valueExist = $this->general_db_model->value_existThreeMore('settings','setting_type',$setting_type,'setting_action',$setting_action);
            if ($id) {
                $this->general_db_model->update('settings', $post, 'setting_id = ' . $id);
                $this->session->set_flashdata('display_message', 'Setting successfully updated.');
            } else {
                if($valueExist == true){
                    $this->session->set_flashdata('error_message', 'Setting Already added.');
                }else{
                    $this->general_db_model->insert('settings', $post);
                    $this->session->set_flashdata('display_message', 'Setting successfully added.');
                }
            }
        
        redirect("settings");
    }

    function settings_delete($id) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("settings/settings", 'settings_delete', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('settings', 'setting_id = ' . $id);
            //$this->general_db_model->delete('settings_sub', 'setting_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Setting successfully deleted.');
            redirect("settings");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function delete_settings_image() {
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'settings/' . $img; //echo $imgpath; exit;
        if (@file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

    
    function settings_update_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Publish')
            $data['status'] = 'Unpublish';
        else
            $data['status'] = 'Publish';
        $this->general_db_model->update('settings', $data, 'setting_id = ' . $id);

        echo $data['status'];
    }

    function _render_template($view, $data = null, $render = false) {
        $this->viewdata = (empty($data)) ? $data : $data;
        $view_html = $this->template->load('template', $view, $data);
        if (!$render)
            return $view_html;
    }

}

?>