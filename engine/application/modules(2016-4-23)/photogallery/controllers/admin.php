<?php

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('photogallery_model');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    function index() {

        $data['page_title'] = 'Photogallery';
        $data['total_gallery'] = $this->general_db_model->countTotal('gallery');
        //echo $query=$this->db->last_query(); exit;
        $data['details'] = $this->general_db_model->get_with_limit('gallery', $this->settings->item('rows_per_page'), @$_GET['page']);
        create_pagination(base_url() . 'admin/photogallery/index/?pagi=1', $data['total_gallery'], 4, $this->settings->item('rows_per_page'));

        $data['current'] = 11;
        $data['sub_current'] = 2;
        $this->template->load('template', 'gallery_list', $data);
    }

    function add() {
        if ($this->input->post('submitDetail')) {

            $this->add_edit();
            die();
        }
        $data['current'] = 11;
        $data['sub_current'] = 2;
        $data['page_title'] = 'Add Gallery';
        $this->template->load('template', 'gallery_add', @$data);
    }

    function edit($id) {
        if ($this->input->post('submitDetail')) {
            $this->add_edit($id);
            die();
        }
        $data['details'] = $this->general_db_model->getById('gallery', 'id', $id);
        $where = array("gid" => $id);
        $data['total_img'] = $this->general_db_model->countTotal('gallery_images', $where);
        //echo $query=$this->db->last_query(); exit;
        $data['img_details'] = $this->general_db_model->get_with_limit('gallery_images', NULL, NULL, 'order', $where);
        $data['gid'] = $id;
        $data['page_title'] = 'Edit Gallery';
        $data['current'] = 11;
        $data['sub_current'] = 2;
        $this->template->load('template', 'gallery_add', $data);
    }

    function add_edit($id = NULL) {
        $not = array('submitDetail');

        $post = $this->mylibrary->get_post_array($not);
        $date = date('Y-m-d H:i:s');
        $post['date'] = $date;
        //dumparray($post);
        if ($id) {
            $this->general_db_model->update('gallery', $post, 'id = ' . $id);
            $this->session->set_flashdata('display_message', 'Gallery successfully updated.');
        } else {
            $this->general_db_model->insert('gallery', $post);
            $this->session->set_flashdata('display_message', 'Gallery successfully added.');
        }
        redirect('admin/photogallery');
    }

    function delete($id) {
        $this->general_db_model->delete('gallery', 'id = ' . $id);
        $this->general_db_model->delete('gallery_images', 'gid = ' . $id);
        $this->session->set_flashdata('display_message', 'Gallery successfully deleted.');
        redirect(admin_url('photogallery'));
    }

    function update_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        //echo $status; die();
        if ($status == 'Publish')
            $data['status'] = 'Unpublish';
        else
            $data['status'] = 'Publish';
        $this->general_db_model->update('gallery', $data, 'id = ' . $id);

        echo $data['status'];
    }

##########################################################################################################
##########################################################################################################

    function insertImg() {
        $gid = $this->input->post('gid');
        $imgname = $this->input->post('imgname');
        $title = substr($imgname, 11, -3);
        $date = date('Y-m-d H:i:s');
        $order = $this->photogallery_model->gen_order($gid); //echo $order; exit;
        $insertData = array('imgname' => $imgname,
            'gid' => $gid,
            'title' => $title,
            'order' => $order,
            'date' => $date,
        );
        if ($this->general_db_model->insert('gallery_images', $insertData))
            echo mysql_insert_id();
    }

    function delete_image() {
        $img = $this->input->post('imgName');
        $imgID = $this->input->post('id');
        $imgpath = $this->config->item('uploads') . 'gallery/' . $img;
        $this->general_db_model->delete('gallery_images', 'id = ' . $imgID);
        if (file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

}

?>