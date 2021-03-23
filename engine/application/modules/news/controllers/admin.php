<?php

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('news_model');
    }

    function index() {
        $data['page_title'] = 'Manage News';
        $data['page'] = $this->news_model->list_all("tbl_news","date DESC");
        
        $this->template->load('template', 'news_list', $data);
    }

    function news_add() {
        if ($this->input->post('submitDetail')) {
            $this->news_add_edit();
            die();
        }

        $data['page_title'] = 'Add News';
        $this->template->load('template', 'news_form', $data);
    }

    function news_edit($id) {
        if ($this->input->post('submitDetail')) {
            $this->news_add_edit($id);
            die();
        }
        $data['details'] = $this->general_db_model->getById('tbl_news', 'id', $id);
        //print_r($data['details']);
        $data['page_title'] = 'Edit News';
        $this->template->load('template', 'news_form', $data);
    }

    function news_add_edit($id = NULL) {
       
        $post['heading'] = $this->input->post('heading');
        $post['content'] = $this->input->post('content');
        $post['date'] = date("Y-m-d H:i:s");


        if ($id) {
            $this->general_db_model->update('tbl_news', $post, 'id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully updated.');
        } else {
            $this->general_db_model->insert('tbl_news', $post);
            $this->session->set_flashdata('display_message', 'Page successfully added.');
        }
        redirect("admin/news");
    }

    function news_delete($id) {
        $this->general_db_model->delete('tbl_news', 'id = ' . $id);
        $this->session->set_flashdata('display_message', 'Page successfully deleted.');
         redirect("admin/news");
    }

    
function update_status() {
    
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Publish') {
            $data['status'] = 'Unpublish';
        } else {
            $data['status'] = 'Publish';
        }
        $this->general_db_model->update("tbl_news", $data, "id = $id");

        echo $data['status'];
    }

}

?>