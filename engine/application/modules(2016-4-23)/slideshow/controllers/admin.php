<?php

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('slideshow_model');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    function index() {
        error_reporting(0);
        $data['page_title'] = 'Slides';
        $data['total_slides'] = $this->general_db_model->countTotal('slides');
        //echo $query=$this->db->last_query(); exit;
        $data['details'] = $this->slideshow_model->get_slides('slides', 'status', 'Publish', 'order');
        //$data['details'] = $this->slideshow_model->get_slides( 'slides' , $this->settings->item('rows_per_page'), @$_GET['page']);

        $data['current'] = 11;
        $data['sub_current'] = 1;
        $this->template->load('template', 'slide_list', $data);
    }

    function add() {
        if ($this->input->post('submitDetail')) {

            $this->add_edit();
            die();
        }
        $data['current'] = 12;
        $data['imgsub'] = 1;
        $data['page_title'] = 'Add Slide';
        $this->template->load('template', 'slide_form', $data);
    }

    function edit($id) {
        if ($this->input->post('submitDetail')) {
            $this->add_edit($id);
            die();
        }
        $data['details'] = $this->general_db_model->getById('slides', 'id', $id);
        //print_r($data['details']);
        $data['current'] = 12;
        $data['imgsub'] = 1;
        $data['page_title'] = 'Edit Slide';
        $this->template->load('template', 'slide_form', $data);
    }

    function add_edit($id = NULL) {
        $not = array('submitDetail', 'fileList');

        $post = $this->mylibrary->get_post_array($not);
        $home_image = $this->input->post('fileList');
        $post['imgname'] = $home_image;
        //dumparray($post);
        if ($id) {
            $this->general_db_model->update('slides', $post, 'id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully updated.');
        } else {
            $this->general_db_model->insert('slides', $post);
            $this->session->set_flashdata('display_message', 'Page successfully added.');
        }
        redirect('admin/slideshow');
    }

    function delete($id) {
        $this->general_db_model->delete('slides', 'id = ' . $id);
        $this->session->set_flashdata('display_message', 'Page successfully deleted.');
        redirect(admin_url('slideshow'));
    }

    function delete_image() {
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'slides/' . $img; //echo $imgpath; exit;
        if (file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

    function update_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        //echo $status; die();
        if ($status == 'Publish')
            $data['status'] = 'Unpublish';
        else
            $data['status'] = 'Publish';
        $this->general_db_model->update('slides', $data, 'id = ' . $id);

        echo $data['status'];
    }

    function clients() {
        error_reporting(0);
        $data['page_title'] = 'Clients';
        $data['total_clients'] = $this->general_db_model->countTotal('clients');
        //echo $query=$this->db->last_query(); exit;
        $data['details'] = $this->slideshow_model->get_slides('clients', 'status', 'Publish', 'order');
        //$data['details'] = $this->slideshow_model->get_slides( 'clients' , $this->settings->item('rows_per_page'), @$_GET['page']);

        $data['current'] = 3;
        $data['imgsub'] = 1;
        $this->template->load('template', 'clients_list', $data);
    }

    function clients_add() {
        if ($this->input->post('submitDetail')) {

            $this->clients_add_edit();
            die();
        }
        $data['current'] = 3;
        $data['imgsub'] = 1;
        $data['page_title'] = 'Add Clients';
        $this->template->load('template', 'clients_form', $data);
    }

    function clients_edit($id) {
        if ($this->input->post('submitDetail')) {
            $this->clients_add_edit($id);
            die();
        }
        $data['details'] = $this->general_db_model->getById('clients', 'id', $id);
        //print_r($data['details']);
        $data['current'] = 3;
        $data['imgsub'] = 1;
        $data['page_title'] = 'Edit Clients';
        $this->template->load('template', 'clients_form', $data);
    }

    function clients_add_edit($id = NULL) {
        $not = array('submitDetail', 'fileList');

        $post = $this->mylibrary->get_post_array($not);
        $home_image = $this->input->post('fileList');
        $post['imgname'] = $home_image;
        //dumparray($post);
        if ($id) {
            $this->general_db_model->update('clients', $post, 'id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully updated.');
        } else {
            $this->general_db_model->insert('clients', $post);
            $this->session->set_flashdata('display_message', 'Page successfully added.');
        }
        redirect('admin/slideshow/clients');
    }

    function clients_delete($id) {
        $this->general_db_model->delete('clients', 'id = ' . $id);
        $this->session->set_flashdata('display_message', 'Page successfully deleted.');
        redirect(admin_url('slideshow/clients'));
    }

    function clients_delete_image() {
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'clients/' . $img; //echo $imgpath; exit;
        if (file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

    function clients_update_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        //echo $status; die();
        if ($status == 'Publish')
            $data['status'] = 'Unpublish';
        else
            $data['status'] = 'Publish';
        $this->general_db_model->update('clients', $data, 'id = ' . $id);

        echo $data['status'];
    }

}

?>