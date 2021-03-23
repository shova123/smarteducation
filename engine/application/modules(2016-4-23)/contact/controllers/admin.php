<?php

class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
       
    }

    function index() {
        if ($this->input->post('submitDetail')) {
            $post['address'] = $this->input->post('address');
        $post['phone'] = $this->input->post('phone');
        $post['email'] = $this->input->post('email');
        $this->general_db_model->update('tbl_contact_us', $post, 'id = 1');
        $this->session->set_flashdata('display_message', 'Page successfully updated.');
        redirect("admin/contact");
        
            
            
        }
        $data['page_title'] = 'Edit Contact';
        $data['details'] = $this->general_db_model->getById( "tbl_contact_us", "id", 1);
        
        $this->template->load('template', 'contact_form', $data);
    }

    

}

?>