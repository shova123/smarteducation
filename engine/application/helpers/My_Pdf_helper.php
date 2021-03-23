<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if (!function_exists('create_pdf')) {

    function create_pdf1($html_data, $file_path = "",$file_name) {
        if ($file_path == "") {
            $file_pat = 'poster'.date('dMY');
        }
        if ($file_path != "") {
            $file_pat = $file_path.$file_name;//'poster'.date('dMY');
        }
        
        include("mpdf/mpdf.php");
        $mypdf = new mPDF();
        $mypdf->WriteHTML($html_data);
        $mypdf->Output($file_pat.'.pdf', 'F');//($name,$dest)
    }
    
    function create_pdf2($html_data,$stylesheet_path, $file_path = "",$file_name) {
        if ($file_path == "") {
            $file_pat = 'poster'.date('dMY');
        }
        if ($file_path != "") {
            $file_pat = $file_path.$file_name;//'poster'.date('dMY');
        }
        include("mpdf/mpdf.php");
        $mypdf=new mPDF(); //'utf-8', 'A4'
        //$mypdf->SetDisplayMode('fullpage');
        $mypdf->useKerning=true;
        //$mypdf->restrictColorSpace=3; 	// forces everything to convert to CMYK colors
        $mypdf->AddSpotColor('PANTONE 534 EC',85,65,47,9);
        // LOAD a stylesheet
        $stylesheet = file_get_contents($stylesheet_path);
        $mypdf->WriteHTML($stylesheet,1);	// The parameter 1 tells that this is css/style only and no body/html/text
        $mypdf->WriteHTML($html_data);
        $mypdf->Output($file_pat.'.pdf', 'F');//($name,$dest)
    }
    
}
?>
