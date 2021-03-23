<?php
function imagecopyresampledselection($filename, $desired_width, $desired_height, $bordersize, $position)
{    
    // Get new dimensions
    list($width, $height) = getimagesize($filename);
    if($desired_width/$desired_height > $width/$height):
        $new_width = $desired_width;
        $new_height = $height * ($desired_width / $width);
    else:
        $new_width = $width * ($desired_height / $height);
        $new_height = $desired_height;
    endif;
    
    // Resize
    $image_p = imagecreatetruecolor($new_width, $new_height);
    $image_f = imagecreatetruecolor($desired_width, $desired_height);
    $format = strtolower(substr(strrchr($filename,"."),1));
	  switch($format)
	  {
		case 'gif' :
		$type ="gif";
		$image = imagecreatefromgif($filename);
		break;
		case 'png' :
		$type ="png";
		$image = imagecreatefrompng($filename);
		break;
		case 'jpg' :
		$type ="jpg";
		$image = imagecreatefromjpeg($filename);
		break;
		case 'jpeg' :
		$type ="jpg";
		$image = imagecreatefromjpeg($filename);
		break;
		case 'bmp' :
		$type ="bmp";
		$image = imagecreatefrombmp($filename);
		break;
		default :
		die ("ERROR; UNSUPPORTED IMAGE TYPE");
		break;
	  }
	
	//$image = imagecreatefromjpeg($filename);
    imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
    
    // Adjust position
    switch($position)
    {
        case("topleft"):
            $x = $bordersize;
            $y = $bordersize;
            break;
            
        case("topright"):
            $x = $new_width - $desired_width + $bordersize;
            $y = $bordersize;
            break;
        
        case("bottomleft"):
            $x = $bordersize;
            $y = $new_height - $desired_height + $bordersize;
            break;
        
        case("bottomright"):
            $x = $new_width - $desired_width + $bordersize;
            $y = $new_height - $desired_height + $bordersize;
            break;
        
        case("center"):
            $x = ($new_width - $desired_width) / 2 + $bordersize;
            $y = ($new_height - $desired_height) / 2 + $bordersize;
            break;
    }
    
    // Resample with 1px border
    imagecopyresampled($image_f, $image_p, $bordersize, $bordersize, $x, $y,     $desired_width    - 2 * $bordersize, 
                                                                                $desired_height    - 2 * $bordersize, 
                                                                                $desired_width    - 2 * $bordersize, 
                                                                                $desired_height    - 2 * $bordersize);
    
    if($type=="gif")
	  {
		header('Content-type: image/gif');
		imagegif($image_f);
	  }
	  elseif($type=="jpg")
	  {
		header('Content-type: image/jpeg');
		imagejpeg($image_f);
	  }
	  elseif($type=="png")
	  {
		header('Content-type: image/png');
		imagepng($image_f);
	  }
	  elseif($type=="bmp")
	  {
		header('Content-type: image/jpeg');
		imagejpeg($image_f);
	  }
	  
	  return ;
	
	//return $image_f;
}

function imagecreatefrombmp($p_sFile)
{
    $file    =    fopen($p_sFile,"rb");
    $read    =    fread($file,10);
    while(!feof($file)&&($read<>""))
        $read    .=    fread($file,1024);
    $temp    =    unpack("H*",$read);
    $hex    =    $temp[1];
    $header    =    substr($hex,0,108);
    if (substr($header,0,4)=="424d")
    {
        $header_parts    =    str_split($header,2);
        $width            =    hexdec($header_parts[19].$header_parts[18]);
        $height            =    hexdec($header_parts[23].$header_parts[22]);
        unset($header_parts);
    }
    $x                =    0;
    $y                =    1;
    $image            =    imagecreatetruecolor($width,$height);
    $body            =    substr($hex,108);
    $body_size        =    (strlen($body)/2);
    $header_size    =    ($width*$height);
    $usePadding        =    ($body_size>($header_size*3)+4);
    for ($i=0;$i<$body_size;$i+=3)
    {
        if ($x>=$width)
        {
            if ($usePadding)
                $i    +=    $width%4;
            $x    =    0;
            $y++;
            if ($y>$height)
                break;
        }
        $i_pos    =    $i*2;
        $r        =    hexdec($body[$i_pos+4].$body[$i_pos+5]);
        $g        =    hexdec($body[$i_pos+2].$body[$i_pos+3]);
        $b        =    hexdec($body[$i_pos].$body[$i_pos+1]);
        $color    =    imagecolorallocate($image,$r,$g,$b);
        imagesetpixel($image,$x,$height-$y,$color);
        $x++;
    }
    unset($body);
    return $image;
}
?>