<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
class CI_Authenticate
{ 
	private $CI;
	//private $member_pages = array('dashboard','profile','business','mynotice','message'); 
	function CI_Authenticate()
	{ 
		$this->CI =& get_instance();
		$this->check_admin_login();		
	} 
	
	function check_admin_login()
	{ 	
		if ($this->CI->uri->segment(1) == 'admin' and $this->CI->uri->segment(2)!='login' ) 
		{ 
			if (!$this->CI->session->userdata('admin_user_id')) 
			{ 
				if($this->CI->uri->segment(2))
					$this->CI->session->set_userdata('admin_redirect_login_url', uri_string());
				
				redirect(admin_url('login'));
			}
			
		}
	
	}		
} 
?>