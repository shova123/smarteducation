<?php

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('links_model');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

//=============================Social LInks Start=================================================				
    function index() {
        $data['links_title'] = 'Social Link manage';
        $data['links'] = $this->links_model->getAll_links('tbl_social_links');
        //create_pagination(base_url().'admin/video/index/?pagi=1',$data['videos'], 4, $this->settings->item('rows_per_video'));																		

        $data['current'] = 14;
        //$data['sub_current'] = 2;

        $this->template->load('template', 'links_list', $data);
    }

    function add() {
        if ($this->input->post('submitLinks')) {

            $this->add_edit();
            die();
        }
        $data['current'] = 14;
        //$data['sub_current'] = 2;
        $data['links_title'] = 'Social Link Add';
        $this->template->load('template', 'links_form', @$data);
    }

    function edit($id) {
        if ($this->input->post('submitLinks')) {
            $this->add_edit($id);
            die();
        }
        $data['details'] = $this->links_model->getById('tbl_social_links', 'id', $id);
        //print_r($data['details']);
        $data['links_title'] = 'Edit Social Links';
        $data['current'] = 14;
        //$data['sub_current'] = 2;
        $this->template->load('template', 'links_form', @$data);
    }

    function add_edit($id = NULL) {
        $not = array('submitLinks');

        $post = $this->mylibrary->get_post_array($not);
        $post['date'] = date('Y-m-d');

        //dumparray($post);
        if ($id) {
            $this->general_db_model->update('tbl_social_links', $post, 'id = ' . $id);
            $this->session->set_flashdata('display_message', 'Links successfully updated.');
        } else {
            $this->general_db_model->insert('tbl_social_links', $post);
            $this->session->set_flashdata('display_message', 'Links successfully added.');
        }
        redirect('admin/links');
    }

    function delete($id) {
        $this->general_db_model->delete('tbl_social_links', 'id = ' . $id);
        $this->session->set_flashdata('display_message', 'Link successfully deleted.');
        redirect(admin_url('links'));
    }

    function update_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        //echo $status; die();
        if ($status == 'Publish')
            $data['status'] = 'Unpublish';
        else
            $data['status'] = 'Publish';
        $this->general_db_model->update('tbl_social_links', $data, 'id = ' . $id);

        echo $data['status'];
    }

//=============================Social LInks End=================================================	
//=============================Important LInks Start=================================================				

    function link_list() {


        $data['page_title'] = 'Pages';
        $data['pages'] = $this->links_model->get_pages('tbl_important_links', 'status', 'Publish');
        $this->template->load('template', 'importantlinks_list', $data);
        //$this->load->view('listing_pages',$data);
    }

    function link_add() {
        if ($this->input->post('submitDetail')) {

            $this->link_add_edit();
            die();
        }

        $data['page_title'] = 'Add Page';
        $this->template->load('template', 'importantlinks_form', @$data);
    }

    function link_edit($id) {
        if ($this->input->post('submitDetail')) {
            $this->link_add_edit($id);
            die();
        }
        $data['details'] = $this->general_db_model->getById('tbl_important_links', 'id', $id);
        //print_r($data['details']);
        $data['page_title'] = 'Edit Page';
        $this->template->load('template', 'importantlinks_form', @$data);
    }

    function link_add_edit($id = NULL) {


        $post['page_title'] = $this->input->post('page_title');
        $post['page_slug'] = $this->input->post('page_slug');
        $post['html_keyword'] = $this->input->post('html_keyword');
        $post['html_describe'] = $this->input->post('html_describe');
        $post['content'] = $this->input->post('content');
        $post['order'] = $this->input->post('order');
        $post['status'] = $this->input->post('status');
        $post['home_image'] = $this->input->post('home_image');
        $home_image = $this->input->post('fileList');
        if (!empty($home_image)) {
            $post['home_image'] = $home_image;
        }
        $post['date'] = date("Y-m-d");
        //echo $PC_ID;die;
        //dumparray($post);
        if ($id) {
            $this->general_db_model->update('tbl_important_links', $post, 'id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully updated.');
        } else {
            $this->general_db_model->insert('tbl_important_links', $post);
            $this->session->set_flashdata('display_message', 'Page successfully added.');
        }
        redirect('admin/links/link_list');
    }

    function link_delete($id) {
        $this->general_db_model->delete('tbl_important_links', 'id = ' . $id);
        $this->session->set_flashdata('display_message', 'Page successfully deleted.');
        redirect(admin_url('links/link_list'));
    }

    function link_delete_image() {
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'important_links/' . $img; //echo $imgpath; exit;
        if (@file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

    function link_update_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        //echo $status; die();
        if ($status == 'Publish')
            $data['status'] = 'Unpublish';
        else
            $data['status'] = 'Publish';
        $this->general_db_model->update('tbl_important_links', $data, 'id = ' . $id);

        echo $data['status'];
    }

//=============================Important LInks End=================================================	
//=============================Footer IMages Start=================================================				

    function image_list() {
        $data['page_title'] = 'Pages';
        $data['pages'] = $this->links_model->get_pages('tbl_footer_images', 'status', 'Publish');
        $this->template->load('template', 'footerimage_list', $data);
        //$this->load->view('listing_pages',$data);
    }

    function image_add() {
        if ($this->input->post('submitDetail')) {

            $this->image_add_edit();
            die();
        }

        $data['page_title'] = 'Add Page';
        $this->template->load('template', 'footerimage_form', @$data);
    }

    function image_edit($id) {
        if ($this->input->post('submitDetail')) {
            $this->image_add_edit($id);
            die();
        }
        $data['details'] = $this->general_db_model->getById('tbl_footer_images', 'id', $id);
        //print_r($data['details']);
        $data['page_title'] = 'Edit Page';
        $this->template->load('template', 'footerimage_form', @$data);
    }

    function image_add_edit($id = NULL) {


        $post['image_title'] = $this->input->post('image_title');
        $post['image_link'] = $this->input->post('image_link');
        $post['page_slug'] = $this->input->post('page_slug');
        $post['html_keyword'] = $this->input->post('html_keyword');
        $post['html_describe'] = $this->input->post('html_describe');
        $post['content'] = $this->input->post('content');
        $post['order'] = $this->input->post('order');
        $post['status'] = $this->input->post('status');
        $post['home_image'] = $this->input->post('home_image');
        $home_image = $this->input->post('fileList');
        if (!empty($home_image)) {
            $post['home_image'] = $home_image;
        }
        $post['date'] = date("Y-m-d");
        //echo $PC_ID;die;
        //dumparray($post);
        if ($id) {
            $this->general_db_model->update('tbl_footer_images', $post, 'id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully updated.');
        } else {
            $this->general_db_model->insert('tbl_footer_images', $post);
            $this->session->set_flashdata('display_message', 'Page successfully added.');
        }
        redirect('admin/links/image_list');
    }

    function image_delete($id) {
        $this->general_db_model->delete('tbl_footer_images', 'id = ' . $id);
        $this->session->set_flashdata('display_message', 'Page successfully deleted.');
        redirect(admin_url('links/image_list'));
    }

    function image_delete_image() {
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'footer_images/' . $img; //echo $imgpath; exit;
        if (@file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

    function image_update_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        //echo $status; die();
        if ($status == 'Publish')
            $data['status'] = 'Unpublish';
        else
            $data['status'] = 'Publish';
        $this->general_db_model->update('tbl_footer_images', $data, 'id = ' . $id);

        echo $data['status'];
    }

//=============================Footer IMages End=================================================
}

?>