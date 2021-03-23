<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CI_Settings {

	var $settings = array();
	
	function CI_Settings()
	{
		$this->CI = & get_instance();
		//$this->CI->load->model('settings_model');
		$this->settings = $this->get_settings_item();
		//print_r($this->settings);die();
	}
	
	function item($item)
	{	
		if ( ! isset($this->settings[$item]))
			return FALSE;
		return $this->settings[$item];
	}
	
	function get_settings_item()
	{
		$this->CI->db->select('slug, value');
		$query = $this->CI->db->get('site_settings');
		$result = $query->result();
		$settings = array();
		foreach($result as $key=>$val)
		{
			$settings[$val->slug] = $val->value;
		}
		
		return $settings;
	}
}

?>