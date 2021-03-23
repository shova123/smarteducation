<?php
class Home extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_model');
        $this->load->library('email');
        $this->load->model('general_model');
        $this->load->library('pagination');
        
    }

     function index() {
        
        $data['page_title'] = 'Home';
        $data['page'] = $this->home_model->get_By_id("static_pages", "page_slug", "home");
        $data['home_slider'] = $this->home_model->get_slides('slides', '', '', 'order');
        $data['home_subcontent'] = $this->home_model->get_table('static_pages', 'page_type', 'subcontent', 'order');
        $data['home_content'] = $this->home_model->get_content('static_pages', 'page_type', 'content', 'order');
        $data['home_video'] = $this->home_model->get_content('static_pages', 'page_type', 'subcontentvideo', 'order');
        $data['home_aboutus'] = $this->home_model->get_content('static_pages', 'page_type', 'subpage', 'order');
        $data['news'] =$this->general_db_model->get_results("news",'status','Publish');
        $data['videos'] = $this->general_db_model->get_results("video_link",'status','Publish');
        $courses=$this->home_model->get_all_subjects();
        foreach($courses as $course){
             $d[$course->board_name][]=$course;
        }
       
        $data['courses']=$d;
//        echo "<pre>";
//        print_r($data['courses']);
        $this->template->load('template_front', 'index', $data);
    }
    
    function contact_us() {

        if ($this->input->post('submit')) {

           
            $recaptcha = $this->input->post('g-recaptcha-response');
            if (!empty($recaptcha)) {
                $response = $this->recaptcha->verifyResponse($recaptcha);
                if (isset($response['success']) and $response['success'] === true) {
                    
                    
                    $fname = $this->input->post('name');
                    $email = $this->input->post('email');
                    $phone = $this->input->post('phone');
                    $message = $this->input->post('comment');

                    $this->load->helper(array('email'));
                    $this->load->library(array('email'));

                    $message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('email_activate', 'ion_auth'), $data, true);

                    $config = array();
                    $config['useragent'] = "CodeIgniter";
                    $config['mailpath'] = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
                    $config['protocol'] = "smtp";
                    $config['smtp_host'] = "localhost";
                    $config['smtp_port'] = "25";
                    $config['mailtype'] = 'html';
                    $config['charset'] = 'utf-8';
                    $config['newline'] = "\r\n";
                    $config['wordwrap'] = FALSE;

                    $this->email->initialize($config);
                    $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
                    $this->email->to($email);
                    $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - Enquiry');
                    $this->email->message($message);
                    
                    if ($this->email->send() == TRUE) {
                        $this->session->set_flashdata('success_message', "your Email has been sent to administrator");
                        //$this->set_message('your Email has been sent to administrator');
                    }else{
                        $data['error_message']="Your Email has not sent Please try again";
                    }
                } else {
                    $data['error_message']="Please verify that you are not a robot.";
                    //$this->session->set_flashdata('success_message', $this->ion_auth->messages());
                }
            }
        }
        
        $data['page_title'] = 'Contact Us';
        $this->template->load('template_front', 'contact', $data);
    }
    
     public function send_mail($to_sender = null)
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $except = array('g-recaptcha-response');
            $data = $this->all_post_data($except);
            $captcha = $this->input->post('g-recaptcha-response');
            $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LfriQoTAAAAADWnbBlKErGMnqSKFNyC47gFN5Xt&response=" . $captcha . "&remoteip=" . $_SERVER['REMOTE_ADDR']);
            $response = json_decode($response, true);
            if ($response["success"] === false) {
                echo 'You were taged as spammer';
            } else {
                $msg = $this->display($data);

                $config = array();
                $config['useragent'] = "CodeIgniter";
                $config['mailpath'] = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
                $config['protocol'] = "smtp";
                $config['smtp_host'] = "localhost";
                $config['smtp_port'] = "25";
                $config['mailtype'] = 'html';
                $config['charset'] = 'utf-8';
                $config['newline'] = "\r\n";
                $config['wordwrap'] = FALSE;

                $this->load->helper(array('email'));
                $this->load->library(array('email'));
                $adminsEmail = $this->general_db_model->getById("admins", "admin_id", 1);
                $to = $adminsEmail->email;
                $from = $data['email'];
                $from_name = $data['name'];
                $this->email->initialize($config);
                $this->email->from("$from", "$from_name");
                $this->email->to("$to");
                if ($to_sender) {
                    $this->email->cc("$from");
                }
                if ($data['subject']) {
                    $subject = $data['subject'];
                    $this->email->subject("$subject");
                }
                $this->email->message("$msg");

                if ($this->email->send() == true) {
                    echo "Your message has been send to Administrator we will be in touch", "success";
                } else {
                    echo "Your message has not been send Please Try again !!!", "success";
                }
            }
        } else {
            echo "No direct access allowed";
        }
    }
    
     public function all_post_data($except = null)
    {
        if ($except) {
            foreach ($_POST as $key => $value) {
                if (!in_array($key, $except))
                    $data[$key] = $this->input->post($key);
            }
        } else {
            foreach ($_POST as $key => $value) {
                $data[$key] = $this->input->post($key);
            }
        }
        return $data;
    }

    

    public function notify($msg, $type)
    {
        $notification = array(
            'msg' => $msg,
            'type' => $type
        );
        $this->session->set_flashdata($notification);
    }
    
    
    function content_details($slug)
    {
        
        $data['page_title'] = 'Home';
        $data['about'] = $this->home_model->get_By_id("static_pages", "page_slug", $slug);
        
        $this->template->load('template_front', 'single', $data);
    }
    
    
    function courses($boardSlug=NULL,$levelSlug=NULL,$streamSlug=NULL,$courseSlug=NULL)
    {
       $data['page_title'] = 'Courses';
       $where="status=1";
       $board=$this->db->query("select * from hya_course_board where board_slug='$boardSlug'")->row();
       $boardId=$board->board_id;
       $level=$this->db->query("select * from hya_course_level where  level_slug='$levelSlug'")->row();
       $levelId=$level->level_id;
       if($streamSlug){
       $stream=$this->db->query("select * from hya_course_stream where  stream_slug='$streamSlug'")->row();
       $streamId=$stream->stream_id;$data['stream']=$stream;
       }
       else{
           $streamId=0;
       }
       if($courseSlug){
       $course=$this->db->query("select * from hya_course_course where course_slug='$courseSlug'")->row();
       $courseId=$course->course_id;
       }else{
           $courseId=0;
       }
       $data['course']=empty($course)?$level:$course;
       
//       echo "<pre>";
//       print_r($data['course']);die;
//       $data['subjects']=$this->db->query("select * from hya_course_subject where board_id=$boardId AND level_id=$levelId AND stream_id=$streamId AND course_id=$courseId")->result();

       $this->template->load('template_front', 'second', $data);
    }
    
     function subject($subjectSlug=NULL)
    {
            $this->load->library(array('nepali_calendar'));
            $this->load->model('data/data_model');
            $where1='';
            $currentDate = date('Y-m-d');
            $c_y = date('Y', strtotime($currentDate));
            $c_m = date('m', strtotime($currentDate));
            $c_d = date('d', strtotime($currentDate));
            $nepdate= $this->nepali_calendar->eng_to_nep($c_y, $c_m, $c_d);
            
            $data['c_year_n'] = $nepdate['year'];
             if(isset($_POST['appeared_year'])){
                 $data['date']=$date=$_POST['appeared_year'];
                 $data['datetype']=isset($_POST['date_type'])?$_POST['date_type']:'ad';
                 $where1 .="appeared_year='$date' AND ";
             }
             else{
                 $data['date']=$date=$c_y;
                 $data['datetype']=isset($_POST['date_type'])?$_POST['date_type']:'ad';
//                 $where1 .="appeared_year='$date' AND ";
             }
             if(isset($_POST['question_tag'])){
                 $data['tag']=$tag=$_POST['question_tag'];
                 $where1 .="question_tag='$tag' AND ";
             }
             else{
                  $data['tag']='very_short';
                $where1 .="question_tag='very_short' AND "; 
             }
             
              if(isset($_POST['subject'])){
                 $data['subjectSearch']=$subject=$_POST['subject'];
                 $where1 .="subject_id='$subject' AND ";
             }
             
//             if(isset($_POST['subject'])){
//                 $data['subjectSearch']=$subject=$_POST['subject'];
//                 $where1 .="subject_id='$subject' AND ";
            // }
             if(isset($_POST['chapter_id'])){
                 $data['chapterSearch']=$chapter=$_POST['chapter_id'];
                 $where1 .="chapter_id='$chapter' AND ";
             }
             if(isset($_POST['unit_id'])){
                 $data['unitSearch']=$unit=$_POST['unit_id'];
                 $where1 .="unit_id='$unit' AND ";
             }
             if(isset($_POST['subunit_id'])){
                 $data['subunit']=$subunit=$_POST['subunit_id'];
                 $where1 .="subunit_id='$subunit' AND ";
             }
           
           if(isset($_POST['subject'])){
                $data['subject']=$subject=$this->db->query("select * from hya_course_subject where  subject_id=$subject")->row();
            }
            else{
                
            $data['subject']=$subject=$this->db->query("select * from hya_course_subject where  token='$subjectSlug'")->row();
             $data['subjectSearch']=$subject->subject_id;
            }
            $board_id=$subject->board_id;
            $level_id=$subject->level_id;
            $stream_id=$subject->stream_id;
            $course_id=$subject->course_id;
            $department_id=$subject->department_id;
            $year=$subject->year;
            $semester=$subject->semester;
            
            if(isset($_POST['subject'])){
                $subjectId=$_POST['subject'];
                
             }
            else{
            $subjectId=$subject->subject_id;
            }
            
            $where=" where subject_id=".$subjectId." AND status=1";
            
            $data['chapters']=$this->db->query("select * from hya_course_chapter". $where)->result_array();
            $data['units'] = $this->data_model->get_results("course_unit", 'status', '1', 'unit_name');
            $data['subunits'] = $this->data_model->get_results("course_subunit", 'status', '1', 'subunit_name');
            $data['level']=$this->db->query("select * from hya_course_level where  level_id=$level_id")->row();
            $data['stream']=$this->db->query("select * from hya_course_stream where  stream_id=$stream_id")->row();
            
            $data['subjects']=$this->db->query("select * from hya_course_subject where board_id=$board_id AND level_id=$level_id AND stream_id=$stream_id AND course_id=$course_id AND department_id=$department_id AND year=$year AND semester=$semester")->result();
            //             $data['marks'] = array_unique(array_column($questions, 'mark'));
            // print_r($data['marks']);die;
            
           

            $questions=$this->db->query("select * from hya_data_question where $where1  subject_id=$subjectId AND status=1 order by created_date DESC ")->result_array();
           $config = array();
            $config['base_url'] =  base_url()."questions/$subjectSlug";
            $config["uri_segment"] = 3;
            $config['total_rows'] = count($questions);
            $config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li class="first">';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li class="next">';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="last">';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="current"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            
            $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;  
            $data['questions']=$this->db->query("select * from hya_data_question where $where1  subject_id=$subjectId AND status=1 order by created_date DESC LIMIT $page , 10 ")->result_array();
            $data['pagination'] = $this->pagination->create_links();
            $this->template->load('template_front',"chapter", $data);
    }
    function chapter($chapterSlug=NULL,$subjectSlug=NULL)
    {      
          
            $this->load->library(array('nepali_calendar'));
            $this->load->model('data/data_model');
            $where1='';
            $currentDate = date('Y-m-d');
            $c_y = date('Y', strtotime($currentDate));
            $c_m = date('m', strtotime($currentDate));
            $c_d = date('d', strtotime($currentDate));
            $nepdate= $this->nepali_calendar->eng_to_nep($c_y, $c_m, $c_d);
            
            $data['c_year_n'] = $nepdate['year'];
             if(isset($_POST['appeared_year'])){
                 $data['date']=$date=$_POST['appeared_year'];
                 $data['datetype']=isset($_POST['date_type'])?$_POST['date_type']:'ad';
                 $where1 .="appeared_year='$date' AND ";
             }
             else{
                 $data['date']=$date=$c_y;
                 $data['datetype']=isset($_POST['date_type'])?$_POST['date_type']:'ad';
//                 $where1 .="appeared_year='$date' AND ";
             }
             if(isset($_POST['question_tag'])){
                 $data['tag']=$tag=$_POST['question_tag'];
                 $where1 .="question_tag='$tag' AND ";
             }
             else{
                  $data['tag']='Very Short';
                $where1 .="question_tag='very_short' AND "; 
             }
             
              
             if(isset($_POST['chapter_id'])){
                 $data['chapterSearch']=$chapter=$_POST['chapter_id'];
                 $where1 .="chapter_id='$chapter' AND ";
             }
             if(isset($_POST['unit_id'])){
                 $data['unitSearch']=$unit=$_POST['unit_id'];
                 $where1 .="unit_id='$unit' AND ";
             }
             if(isset($_POST['subunit_id'])){
                 $data['subunit']=$subunit=$_POST['subunit_id'];
                 $where1 .="subunit_id='$subunit' AND ";
             }
           
             if(isset($_POST['subject'])){
                $subjectId=$_POST['subject'];
                $data['subject']=$subject=$this->db->query("select * from hya_course_subject where  subject_id=$subjectId")->row();
//                $subjectId=$subject->subject_id;
                $where1 .="subject_id='$subjectId' AND ";
                
             }
            else{
                
            $data['subject']=$subject=$this->db->query("select * from hya_course_subject where  token='$subjectSlug'")->row();
             $data['subjectSearch']=$subjectId=$subject->subject_id;
             $where1 .="subject_id='$subjectId' AND ";
            }
                          
            if(isset($_POST['course'])){
                 $course=$_POST['course'];
                $where1 .="course_id='$course' AND ";
             }
            if(isset($_POST['ssubject'])){
               $subjectSlug= $_POST['ssubject'];
               $whr="subject_name like '%".$subjectSlug."%'";
               $data['subject']=$subject=$this->db->query("select * from hya_course_subject where $whr")->row();
               $subjectId=$data['subjectSearch']=!empty($subject->subject_id)?$subject->subject_id:"0";
                }
            
            $board_id=!empty($subject->board_id)?$subject->board_id:0;
            $level_id=!empty($subject->level_id)?$subject->level_id:0;
            $stream_id=!empty($subject->stream_id)?$subject->stream_id:0;
            $course_id=!empty($subject->course_id)?$subject->course_id:0;
            $department_id=!empty($subject->department_id)?$subject->department_id:0;
            $year=!empty($subject->year)?$subject->year:0;
            $semester=!empty($subject->semester)?$subject->semester:0;
            

            
            $where=" where subject_id=".$subjectId." AND status=1";
            
            $data['chapters']=$this->db->query("select * from hya_course_chapter". $where)->result_array();
            $data['units'] = $this->data_model->get_results("course_unit", 'status', '1', 'unit_name');
            $data['subunits'] = $this->data_model->get_results("course_subunit", 'status', '1', 'subunit_name');
            $data['level']=$this->db->query("select * from hya_course_level where  level_id=$level_id")->row();
            $data['stream']=$this->db->query("select * from hya_course_stream where  stream_id=$stream_id")->row();
            
            $data['subjects']=$this->db->query("select * from hya_course_subject where board_id=$board_id AND level_id=$level_id AND stream_id=$stream_id AND course_id=$course_id AND department_id=$department_id AND year=$year AND semester=$semester")->result();
            //             $data['marks'] = array_unique(array_column($questions, 'mark'));
            // print_r($data['marks']);die;
            
           

            $questions=$this->db->query("select * from hya_data_question where $where1 status=1 order by created_date DESC ")->result_array();
           $config = array();
            $config['base_url'] =  base_url()."questions/$subjectSlug";
            $config["uri_segment"] = 3;
            $config['total_rows'] = count($questions);
            $config['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li class="first">';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="previous">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li class="next">';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li class="last">';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="current"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';
            $this->pagination->initialize($config);
            
            $page = ($this->uri->segment(3))? $this->uri->segment(3) : 0;  
            $data['questions']=$this->db->query("select * from hya_data_question where $where1 status=1 order by created_date DESC LIMIT $page , 10 ")->result_array();
            $data['pagination'] = $this->pagination->create_links();
            $this->template->load('template_front',"chapter", $data);
    }
    
    function question_detail($token=NULL)
    {
        $data['row']=$question=$this->db->query("select * from hya_data_question where token='$token'")->row();
        $questionId=$question->question_id;
        $data['answer']=$this->db->query("select * from hya_data_answer where  question_id=$questionId")->row();
        $data['subject']=$this->db->query("select * from hya_course_subject where  subject_id=$question->subject_id")->row();
        $data['chapter']=$this->db->query("select * from hya_course_chapter where  chapter_id=$question->chapter_id")->row();
        $data['level']=$this->db->query("select * from hya_course_level where  level_id=$question->level_id")->row();
        $data['stream']=$this->db->query("select * from hya_course_stream where  stream_id=$question->stream_id")->row();
        
        $data['option']=$this->home_model->get_join('data_option',$questionId);
        $data['hint']=$this->home_model->get_join('data_hint',$questionId);
        $data['answer']=$this->home_model->get_join('data_answer',$questionId);
        $data['description']=$this->home_model->get_join('data_description',$questionId);
        $data['subquestion']=$this->home_model->get_join('data_subquestion',$questionId);
//       print_r($data['subquestion']);die;

        $this->template->load('template_front',"third", $data);
       
    }
     function news($slug){
        
        $data['page_title'] = 'Smartsikshya-News';
        $data['news']=$this->general_db_model->getById('news','slug',$slug);
        $this->template->load('template_front', 'news_detail', $data);
    }

}

?>