<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('category_model');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    public function get_all_methods($class_name = null) {
        return get_class_methods($class_name);
    }

    function index() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("category/category", 'index', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Category";
            $data['category_list'] = $this->category_model->get_category("tbl_category");
            $data['current'] = 2;
            $data['sub_current'] = 1;
            $this->_render_template("category_list", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function category_list() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("category/category", 'category_list', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Category";
            $data['category_list'] = $this->category_model->get_category("tbl_category");
            $data['current'] = 2;
            $data['sub_current'] = 1;
            $this->_render_template("category_list", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function category_add() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("category/category", 'category_add', $this->ion_auth->get_user_id())) {
            if ($this->input->post('submitDetail')) {
                $this->add_edit_category();
                die();
            }
            $data['page_title'] = 'Add Category';
            $data['current'] = 2;
            $data['sub_current'] = 1;
            $this->_render_template("category_form", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function category_edit($id) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("category/category", 'category_edit', $this->ion_auth->get_user_id())) {

            if ($this->input->post('submitDetail')) {
                $this->add_edit_category($id);
                die();
            }
            $data['details'] = $this->general_db_model->getById('tbl_category', 'category_id', $id);
            $data['page_title'] = "Edit Category";
            $data['current'] = 2;
            $data['sub_current'] = 1;
            $this->_render_template("category_form", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function add_edit_category($id = NULL) {
        $post['token'] = $this->input->post('token');
        $post['category_title'] = $this->input->post('category_title');
        $post['category_slug'] = $this->input->post('category_slug');
        $post['category_type'] = $this->input->post('category_type');
        $post['category_description'] = $this->input->post('category_description');
        $post['order'] = $this->input->post('order');
        $post['status'] = $this->input->post('status');
        $post['date'] = date("Y-m-d");
        if ($id) {
            $this->general_db_model->update('tbl_category', $post, 'category_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Activity successfully updated.');
        } else {
            $this->general_db_model->insert('tbl_category', $post);
            $this->session->set_flashdata('display_message', 'Activity successfully added.');
        }
        redirect("admin/category");
    }

    function category_delete($id) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("category/category", 'category_delete', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('tbl_category', 'category_id = ' . $id);
            $this->general_db_model->delete('tbl_category_sub', 'category_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Activity successfully deleted.');
            redirect("admin/category");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function delete_category_image() {
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'category/' . $img; //echo $imgpath; exit;
        if (@file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

    function delete($id) {
        $this->general_db_model->delete('static_pages', 'id = ' . $id);
        $this->session->set_flashdata('display_message', 'Page successfully deleted.');
        redirect(admin_url('pages'));
    }

    function delete_image() {
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'banners/' . $img; //echo $imgpath; exit;
        if (@file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

    function update_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Publish')
            $data['status'] = 'Unpublish';
        else
            $data['status'] = 'Publish';
        $this->general_db_model->update('static_pages', $data, 'id = ' . $id);

        echo $data['status'];
    }

    function category_sub($category_id = null) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("category/category", 'category_sub', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Sub Category";
            
            $data['subcategory_list'] = $this->category_model->get_category("tbl_category_sub", 'category_id', $category_id);
            $data['current'] = 2;
            $data['sub_current'] = 2;
            $this->_render_template("category_sub_list", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function category_sub_add() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("category/category", 'category_sub_add', $this->ion_auth->get_user_id())) {
            if ($this->input->post('submitDetail')) {
                $this->add_edit_category_sub();
                die();
            }
            $data['category_list'] = $this->category_model->get_result("tbl_category", 'category_type', 'sub_category');
            $data['page_title'] = 'Add Sub Category';
            $data['current'] = 2;
            $data['sub_current'] = 2;
            $this->_render_template("category_sub_form", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function category_sub_edit($id) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("category/category", 'category_sub_edit', $this->ion_auth->get_user_id())) {

            if ($this->input->post('submitDetail')) {
                $this->add_edit_category_sub($id);
                die();
            }
            $data['details'] = $this->general_db_model->getById('tbl_category_sub', 'sub_cat_id', $id);
            $data['category_list'] = $this->category_model->get_result("tbl_category", 'category_type', 'sub_category');
            $data['page_title'] = "Edit Category";
            $data['current'] = 2;
            $data['sub_current'] = 2;
            $this->_render_template("category_sub_form", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function add_edit_category_sub($id = NULL) {
        $post['token'] = $this->input->post('token');
        $post['subcategory_title'] = $this->input->post('subcategory_title');
        $post['subcategory_slug'] = $this->input->post('subcategory_slug');
        $post['category_id'] = $this->input->post('category_id');
        $post['subcategory_description'] = $this->input->post('subcategory_description');
        $post['order'] = $this->input->post('order');
        $post['status'] = $this->input->post('status');
        $post['date'] = date("Y-m-d");

        if ($id) {
            $this->general_db_model->update('tbl_category_sub', $post, 'sub_cat_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Sub category successfully updated.');
        } else {
            $this->general_db_model->insert('tbl_category_sub', $post);
            $this->session->set_flashdata('display_message', 'Sub category successfully added.');
        }
        redirect("admin/category/category_sub");
    }

    function category_sub_delete($id) {
        $this->general_db_model->delete('tbl_category_sub', 'sub_cat_id = ' . $id);
        $this->session->set_flashdata('display_message', 'Activity successfully deleted.');
        redirect("admin/category/category_sub");
    }

    function delete_category_sub_image() {
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'sub_category/' . $img; //echo $imgpath; exit;
        if (@file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

    function update_category_sub_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Publish')
            $data['status'] = 'Unpublish';
        else
            $data['status'] = 'Publish';
        $this->general_db_model->update('tbl_category_sub', $data, 'sub_cat_id = ' . $id);
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