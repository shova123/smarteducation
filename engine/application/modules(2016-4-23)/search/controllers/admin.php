<?php
	class Admin extends MX_Controller{
    	
		function __construct(){
			parent::__construct();
			$this->load->model('homemodel');
		}	
    	
		function index(){	
									
			$this->template->set('title', 'Home');
        	$this->template->load('template', 'home_admin');
                
		}
                
    }
?>