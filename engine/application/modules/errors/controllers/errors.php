<?php

class Errors extends MX_Controller {

    function __construct() {
        parent::__construct();

    }

    function index() {
        $data['page_title'] = 'Home';
        $this->template->load('template_front', 'home_front',$data);
    }

    function error_html($err_num=null) {
        $data['page_title'] = 'About Us';
        $data['heading'] = '404 error';
        $data['message'] = 'Page Not Found';
        $this->template->load('template_front', "html/error_$err_num", $data);
    }
}
?>