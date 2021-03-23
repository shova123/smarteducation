<?php

class Photogallery extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('photogallery_model');
        $this->load->model('general_db_model');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    function index() {

        $data['page_title'] = 'Photo Gallery';
        $data['indexing'] = "BrideGroom_Gallery";
        //  $data['home'] = $this->general_db_model->getByWhere( 'static_pages', 'page_title', 'homepage','pc_id',4);
        //function getByWhere( $table, $fieldName, $name, $fieldId, $id)
        //  $data['slides'] = $this->general_db_model->getAll('slides');
        $data['gallery'] = $this->photogallery_model->get_gallery('gallery', '', '', '', '', 'order', 10, 0);
        //  $data['testimonial'] = $this->general_db_model->getByWhere( 'static_pages', 'page_title', 'testimonials','pc_id',4); 
//function getByWhere( $table, $fieldName, $name, $fieldId, $id)
//function using to find testimonials within same page category id=4 tat is same for homepage & testimonials which can be visible in same index page
        //$this->template->set('title', 'Home');
        //$data['image_gallery'] = $this->photogallery_model->get_img_by_id('bridegroom','status','Publish');
        $this->template->load('template_front', 'gallery_front', $data);
    }

    function photo_gallery_front($galery_id) {

        $data['page_title'] = 'Photo Gallery';
        $data['indexing'] = "Other_Gallery";
        //  $data['home'] = $this->general_db_model->getByWhere( 'static_pages', 'page_title', 'homepage','pc_id',4);
        //function getByWhere( $table, $fieldName, $name, $fieldId, $id)
        //  $data['slides'] = $this->general_db_model->getAll('slides');
        //$data['g_name'] = $this->photogallery_model->get_gallery_by_id('gallery','id',$galery_id);
        //$data['photo_gallery'] = $this->photogallery_model->get_img_by_id('gallery_images','gid',$galery_id);
        $data['photo_gallery'] = $this->photogallery_model->get_gallery('gallery', 'id', $galery_id, '', '', 'order', 10, 0);

        //  $data['testimonial'] = $this->general_db_model->getByWhere( 'static_pages', 'page_title', 'testimonials','pc_id',4); 
//function getByWhere( $table, $fieldName, $name, $fieldId, $id)
//function using to find testimonials within same page category id=4 tat is same for homepage & testimonials which can be visible in same index page
        //$this->template->set('title', 'Home');

        $this->template->load('template_front', 'gallery_front', $data);
    }

}

?>
