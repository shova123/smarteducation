<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MyLibrary{

    function MyLibrary(){
        $this->CI=& get_instance();		
    }
	
	
	function generateArray2XML($rootName,$array4XML,$xmlFileNameWithPath) {
		$this->CI->load->library('array2XML');
		//include_once("array2XML.php");	
		$xml = Array2XML::createXML($rootName,$array4XML);
		echo $xml->saveXML();
		$xml->save($xmlFileNameWithPath); 
	}
	
	function generateXML2Array($xmlFileNameWithPath) {
		include_once("XML2array.php");
		$xmltoarray = new XML2Array;
		$array = $xmltoarray->createArray(file_get_contents($xmlFileNameWithPath));
		return $array;
	}	
	
	function DropDown($field,$idfield,$tablename,$selected="",$condition="",$orderby='',$showselect=true,$value = '-- Select --'){
		$fields = explode('^^',$field);
		$fieldname = '';
		$fieldlist = '';
		if(sizeof($fields)>'1')
		{
			$orderbyfield = $fields[0];
			for($i=0;$i<sizeof($fields);$i++) {
				//$fieldname .= $row[$fields[$i]].' ';
				$fieldlist .= $fields[$i].",";
			}
		}
		else
		{
			$orderbyfield = $field;
			//$fieldname = $row[$field];
			$fieldlist = $field;
		}
		$this->CI->db->select($idfield.",".$fieldlist);
		$this->CI->db->from($tablename);		
		if($condition!="")
			$this->CI->db->where($condition);
		if($orderby=='')				
			$orderby = $orderbyfield;
		$this->CI->db->order_by($orderby);	
		$res = $this->CI->db->get();
		$result = $res->result_array();
		$selSection = '';
		if($showselect)
			$selSection .= '<option value="" >'.$value.'</option>';
		if(!empty($result)) {
			foreach($result as $row)
			{	
				if(sizeof($fields)>'1')
				{					
					for($i=0;$i<sizeof($fields);$i++) {
						$fieldname .= $row[$fields[$i]].' ';
					}
				}
				else
				{										
					$fieldname = $row[$field];					
				}			
				if($row[$idfield] == $selected)
					$selSection .= '<option value="'.$row[$idfield].'" selected="selected">'.$fieldname.'</option>';
				else
					$selSection .= '<option value="'.$row[$idfield].'">'.$fieldname.'</option>';
				$fieldname = '';
			}
		}			
		return $selSection;
	}
	
	function DropDownBySql($sql,$field,$idfield,$selected="",$showselect=true,$value = '-- Select --'){	
		
		$res = $this->CI->db->query($sql);
/*		echo $this->CI->db->last_query();
		die();*/
		$result = $res->result_array();
		$selSection = '';
		if($showselect)
			$selSection .= '<option value="" >'.$value.'</option>';
		if(!empty($result)) {
			foreach($result as $row)
			{
				if($row[$idfield] == $selected)
					$selSection .= '<option value="'.$row[$idfield].'" selected="selected">'.$row[$field].'</option>';
				else
					$selSection .= '<option value="'.$row[$idfield].'">'.$row[$field].'</option>';
			}
		}			
		return $selSection;
	}
	
	function get_post_array( $not )
	{ 
		 $array = array(); 
		
		 foreach($_POST as $key=>$value)
		 { 
			$match=false; 
			foreach($not as $vals)
			{ 
				if ($key==$vals) 
				{ 
				  $match=true; 	
				} 
			} 
			if ($match == false)
			{ 
				$array[$key] = $this->CI->input->post($key); 
			} 
		  } 
		return $array; 
	}
	
	function pushmail($to, $subject, $message, $header, $from)
		{			
			$this->CI->load->library('email');
					
			$this->CI->email->clear(true);
			
			$config['mailtype'] = 'html';
			$config['charset']  = 'iso-8859-1';
			$config['send_multipart'] = false;
			$config['protocol'] = 'sendmail';
			$this->CI->email->initialize($config);
			
			$this->CI->email->from($from, $header);
			$this->CI->email->to($to);
			
			$this->CI->email->subject($subject);
			$this->CI->email->message($message);
			
			$trackMsg = array('mail_from'=>$from,'mail_to'=>$to,'subject'=>$subject,'content'=>$message,'sent_date'=>currentTimestamp());
			
			if($this->CI->email->send())
			{
				$this->CI->email->clear(TRUE);
				$trackMsg['status'] = 1;
				$return = true;
			}
			else
			{
				//$this->email->print_debugger();
				$trackMsg['status'] = 0;
				$return = false;
			}
			$this->CI->general_db_model->insert('sent_emails',$trackMsg);
			return $return;
		}
}