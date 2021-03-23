<?php
function dumparray($array)
{
	echo "<pre>";
	print_r($array);
	echo "</pre>";
	exit;
}

function printQuery()
{
	$CI = &get_instance();
	echo $CI->db->last_query();
	exit;
}
	
	function admin_url($uri='')
	{
		$CI = &get_instance();
		return site_url('admin').'/'.$uri;
	}
	
	
	/**
	* Get current date
	* @return current date
	*/
	function currentDate(){ 
	
		return date('Y-m-d');
	}
	
	/**
	* Get current time	
	* @return current time
	*/
	function currentTime(){
	
		return date("G:i:s");
	}
	
	/**
	* Get current time	
	* @return current time
	*/
	function currentTimestamp(){
	
		return currentDate()." ".currentTime();
	}		


	/**
	* Format date
	* @param date $date	
	* @return formatted date
	*/		
	function getDateFormatted($date){
	
		if(trim($date) != null && $date != "0000-00-00 00:00:00")
		{
			//$date = date('g:i ad/m/Y H:i:s', strtotime($date));
			$date = date('M d, Y', strtotime($date));
		}
		else
		{
			$date = "N/A";
		}
		return $date;
	}
	
	
	/**
	* Format date
	* @param date $date	
	* @return formatted date
	*/		
	function getDateTmeFormatted($date){
	
		if(trim($date) != null && $date != "0000-00-00 00:00:00")
		{
			//$date = date('g:i ad/m/Y H:i:s', strtotime($date));
			$date = date('Y-m-d G:i:s', strtotime($date));
		}
		else
		{
			$date = "N/A";
		}
		return $date;
	}
	
	/**
	* Format time	
	* @param time $time	
	* @return formatted time
	*/
	function getTimeFormatted($time){
	
		$exptime = explode(":",$time);
		
		if($exptime[0] > 12){
			$hr = $exptime[0]-12;
			$ampm = "PM";
		}
		else{
			$hr = $exptime[0];
			$ampm = "AM";
		}
		
		$time = $hr.":".$exptime[1].":".$exptime[2]." ".$ampm;
		return $time;
	}
	
	
	function addDays ($days, $fmt="Y-m-d", $date=NULL) {
		// Adds days to date or from now // By JM, www.Timehole.com
		if ($date==NULL) { $t1 = time(); }
		else $t1 = strtotime($date);
		$t2 = $days * 86400; // make days to seconds
		return date($fmt,($t2+$t1));
	}

        function getDaysDiff($date1,$date2){
            $t1 = strtotime($date1);            
            $t2 = strtotime($date2);
            
            $diff = $t2-$t1;
           // echo $diff;
            $moddays = $diff % 86400;
           $days = $diff/86400;
            
            if($moddays>0)
                $added = 1;
            else
                $added = 0;
            $daysDiff = $days + $added;
            return $daysDiff;
        }
	/**
	* Generate random keys	
	* @param integer $length	
	* @return string $key
	*/
	function randomkeys($length){
	   $key='';
	   $i = '';
	   $pattern = '';
	   $pattern = "1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	   
	   for($i=0;$i<$length;$i++){
	   
		 $key .= $pattern{rand(0,62)};
	   }
	   return $key;
	}
	
	
	function create_pagination($baseurl, $totalRows, $uri_segment = 4, $per_page = REC_PER_PAGE,$segment='page')
	{
		$CI = &get_instance();
		$CI->load->library('pagination');						
		$config['base_url'] 		= $baseurl;
		$config['uri_segment'] 		= $uri_segment;
		$config['per_page'] 		= $per_page;
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '';
		$config['first_tag_close'] = '';
		$config['cur_tag_open'] 	= '<span>';
		$config['cur_tag_close'] 	= '</span>';
		$config['next_link'] 		= 'Next';
		$config['prev_link'] 		= 'Pervious';
		$config['next_tag_open'] 	= '';
		$config['next_tag_close'] 	= '';
		$config['prev_tag_open'] 	= '';
		$config['prev_tag_close'] 	= '';
		$config['num_tag_open'] 	= '';
		$config['num_tag_close'] 	= '';	
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '';
		$config['last_tag_close'] = '';
		$config['num_links'] = 5;
		$config['page_query_string'] = TRUE;
		$config['query_string_segment'] = $segment;
		
		$config['total_rows'] = $totalRows;
		$CI->pagination->initialize($config);	
	}	
	
	function subString($string, $limit)
	{
		if($limit)
		{
			$CI = &get_instance();
			$CI->load->helper('text');
			$short_text = character_limiter($string, $limit);
			
			return $short_text;
		}
		else
			return $string;
	}
	
	function textWrap($str,$strlen,$strpos=0){
	
		$text = "";
		if(strlen($str)>$strlen){		
			$rem = strlen($str);		
			while(true){
				$text .= substr(strip_tags(html_entity_decode($str)),$strpos,$strlen)."<br>";
				$rem -= $strlen;			
				$strpos += $strlen;
				if($rem<=0){
					$text = substr(strip_tags(html_entity_decode($text)),0,-4);
					break;
				}
			}
		}
		else
		{
			$text = strip_tags(html_entity_decode($str));
		}
		return $text;
	}
	
		
?>