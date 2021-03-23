<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function upload_image($image, $target, $thumb = array('dest' => '', 'size' => array('w' => 257, 'h' => 218), 'ratio' => false), $prev_img = NULL)
{
	
	$CI = &get_instance();
	initialize_upload($target);
	if($CI->upload->do_upload($image))
	{
		if($prev_img)
		{
			if(is_file($target.$prev_img))
				@unlink($target.$prev_img);
		}
		
		$data = $CI->upload->data();
		$image = $data['file_name'];
		$image_path = $data['full_path'];
		$image_name = $data['raw_name'];
		$image_ext = $data['file_ext'];
		
		if($thumb)
		{			
			if($thumb['dest'])
				$dest = $thumb['dest'];
			else
				$dest = $target;
			create_thumb($image_path, $dest.$image, $thumb['size'], $thumb['ratio']);
		}
		return $image;
	}
	else
	{
		$CI->session->set_flashdata('error_message', $CI->upload->display_errors());
		return false;
		//return $CI->upload->display_errors();
	}
	
}

function initialize_upload($path, $max_size = '20480', $max_width = '2048', $max_height='2048')
{
	$CI = &get_instance();
	$config['upload_path'] = $path;
	$config['allowed_types'] = 'gif|jpg|png';
	$config['max_size']	= $max_size;
	$config['max_width']  = $max_width;
	$config['max_height']  = $max_height;
	
	$CI->load->library('upload', $config);

}

function create_thumb($src, $dest, $size, $ratio = false)
{
	$CI = &get_instance();
	
	$config['image_library'] = 'gd2';
	$config['source_image'] = $src;
	$config['new_image']    = $dest;
	$config['create_thumb'] = TRUE;
	if($ratio)
		$config['maintain_ratio'] = TRUE;
	else
		$config['maintain_ratio'] = FALSE;
		
	$config['thumb_marker'] = '';	
		
	$config['width'] = $size['w'];
	$config['height'] = $size['h'];
	
	$CI->load->library('image_lib');
	$CI->image_lib->initialize($config); 
	
	$CI->image_lib->resize();

}

?>