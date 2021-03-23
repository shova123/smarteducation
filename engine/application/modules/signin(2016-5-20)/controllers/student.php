<?php
class Student extends MX_Controller{
   
     function __construct() {
        parent::__construct();
        $this->load->model('signin_model');
         $this->load->library(array('ion_auth', 'form_validation','nepali_calendar'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    public function get_all_methods($class_name = null) {
        return get_class_methods($class_name);
    }

    function index() {
        $data['page_name'] = 'dashboard';
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect("signin/login", 'refresh');
        } else{
            //if ($this->ion_auth->has_permission("signin/signin", 'index', $this->ion_auth->get_user_id())) {
            $groupTypeDashboardName = $this->ion_auth->has_dashboard($this->ion_auth->get_user_id()); //$dasboardName = $groupDashboard['group_type'];
            //
            //set the flash data error message if there is one
            $data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            if ($this->session->userdata('user_id') != "") {
                $userID = $this->session->userdata('user_id');
            }
            $data['users_details'] = $this->signin_model->get_admins('users', 'user_id', $userID);
            $data['users_groups'] = $users_groups = $this->signin_model->get_results('users_groups', 'user_id', $userID, 'id');
            $groupsName = '';
            foreach ($users_groups as $values) {
                $groupID = $values->group_id;
                $group_details = $this->signin_model->get_admins('groups', 'group_id', $groupID);
                $groupName = $group_details->name;
                $groupsName.= "$groupName,";
            }$trimGroupName = trim($groupsName, ',');
            $this->session->set_userdata(array('groupNames' => $trimGroupName));
            //list the users
            $data['users'] = $this->ion_auth->users()->result();
            foreach ($data['users'] as $k => $user) {
                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->user_id)->result();
            }

            $redirectController = "signin";
            
            redirect("$redirectController/$groupTypeDashboardName" . "_dashboard", 'location');
        } 
    }
    function _render_template_front_dashboard($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $data : $data;

        $view_html = $this->template->load('template_dashboard', $view, $data);

        if (!$render)
            return $view_html;
    }
        
        
    function material(){
        $data['page_name'] = 'dashboard';
        if (!$this->ion_auth->logged_in()) {
            //redirect them to the login page
            redirect("signin/login", 'refresh');
        } else{
            if ($this->session->userdata('user_id') != "") {
                $userID = $this->session->userdata('user_id');
            }
            $data['users_details'] = $this->signin_model->get_admins('users', 'user_id', $userID);
            $loginUserID = $this->ion_auth->get_user_id();
            $studentDetail=$this->general_db_model->getById('users_eduinfo','user_id',$loginUserID);
          
            $board_id=$studentDetail->board_id;
            $level_id=$studentDetail->level_id;
            $stream_id=$studentDetail->stream_id;
            $course_id=$studentDetail->course_id;
            $department_id=$studentDetail->department_id;
            $year=$studentDetail->year;
            $semester=$studentDetail->semester;
            //print_r($data);die;
            $tableQuestion=$this->db->dbprefix('data_question');
            $tableSubject=$this->db->dbprefix('course_subject');
           /* $board_id="9";
            $level_id="12";
            $stream_id="19";
            $course_id="0";
            $department_id="0";
            $year="1";
            $semester="0";*/
            $date=date("Y");
            $where="where s.board_id=".$board_id." AND s.level_id=".$level_id." AND s.stream_id=".$stream_id." AND s.course_id=".$course_id ." AND s.department_id=".$department_id." AND s.year=".$year." AND s.semester=".$semester ." AND q.appeared_year < ".$date ;
            
            $subjects=$this->db->query("select s.*,q.appeared_year,count(s.subject_id) as tt from ".$tableSubject." s LEFT JOIN ".$tableQuestion." q ON s.subject_id=q.subject_id ". $where ." GROUP BY s.subject_id")->result_array();
//            echo "<pre>";
//            print_r($subjects);die;
           $data['rows']=$subjects;
         
            $this->_render_template_front_dashboard("student/second", $data);
        }
    }
    
    function chapter($chapterSlug=NULL,$subjectSlug)
    {       
            $where1='';
            $currentDate = date('Y-m-d');
            $c_y = date('Y', strtotime($currentDate));
            $c_m = date('m', strtotime($currentDate));
            $c_d = date('d', strtotime($currentDate));
            $nepdate= $this->nepali_calendar->eng_to_nep($c_y, $c_m, $c_d);
            
             if(isset($_POST['appeared_year'])){
                 $data['date']=$date=$_POST['appeared_year'];
                 $data['datetype']=$_POST['date_type'];
                 $where1 .="appeared_year='$date' AND ";
             }
             else{
                 $data['date']=$date=$c_y;
                 $data['datetype']=isset($_POST['date_type'])?$_POST['date_type']:'ad';
                 $where1 .="appeared_year='$date' AND ";
             }
             if(isset($_POST['question_tag'])){
                $data['tag']= $tag=$_POST['question_tag'];
                 $where1 .="question_tag='$tag' AND ";
             }
             if(isset($_POST['marks'])){
                 $data['mark']=$mark=$_POST['marks'];
                 $where1 .="mark='$mark' AND ";
             }
             
               
            $data['c_year_n'] = $nepdate['year'];
            
            $data['subject']=$subject=$this->db->query("select * from hya_course_subject where  subject_slug=$subjectSlug")->row();
            $subjectId=$subject->subject_id;
            $data['chapter']=$chapter=$this->db->query("select * from hya_course_chapter where  chapter_slug=$chapterSlug")->row();
            $chapterId=$chapter->chapter_id;
            $where=" where subject_id=".$subjectId." AND status=1";
            $data['chapters']=$this->db->query("select * from hya_course_chapter". $where)->result_array();
            
            $level_id=$data['subject']->level_id;
            $data['level']=$this->db->query("select * from hya_course_level where  level_id=$level_id")->row();
            
//          

            $data['questions']=$questions=$this->db->query("select * from hya_data_question where chapter_id=$chapterId AND subject_id=$subjectId AND $where1 status=1")->result_array();
            $questions=$this->db->query("select * from hya_data_question where status=1")->result_array();
            $data['marks'] = array_unique(array_column($questions, 'mark'));
          
           $this->_render_template_front_dashboard("student/chapter", $data);
    }
    function subject($subjectSlug)
    {
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
                 $where1 .="appeared_year='$date' AND ";
             }
             if(isset($_POST['question_tag'])){
                 $data['tag']=$tag=$_POST['question_tag'];
                 $where1 .="question_tag='$tag' AND ";
             }
             if(isset($_POST['marks'])){
                 $data['mark']=$mark=$_POST['marks'];
                 $where1 .="mark='$mark' AND ";
             }
      
            
            $level_id="12";
            
            $data['subject']=$subject=$this->db->query("select * from hya_course_subject where  subject_slug='$subjectSlug'")->row();
            $subjectId=$subject->subject_id;
            $where=" where subject_id=".$subjectId." AND status=1";
            $data['chapters']=$this->db->query("select * from hya_course_chapter". $where)->result_array();
            $data['level']=$this->db->query("select * from hya_course_level where  level_id=$level_id")->row();
            
           
//          

             
             $data['questions']=$this->db->query("select * from hya_data_question where $where1  subject_id=$subjectId AND status=1")->result_array();
             $questions=$this->db->query("select * from hya_data_question where status=1")->result_array();
             $data['marks'] = array_unique(array_column($questions, 'mark'));
            // print_r($data['marks']);die;
             $this->_render_template_front_dashboard("student/chapter", $data);
    }
    function question_detail($token=NULL)
    {
        $data['row']=$question=$this->db->query("select * from hya_data_question where token='$token'")->row();
        $questionId=$question->question_id;
        $data['answer']=$this->db->query("select * from hya_data_answer where  question_id=$questionId")->row();
        $data['subject']=$this->db->query("select * from hya_course_subject where  subject_id=$question->subject_id")->row();
        $data['chapter']=$this->db->query("select * from hya_course_chapter where  chapter_id=$question->chapter_id")->row();
        $data['level']=$this->db->query("select * from hya_course_level where  level_id=$question->level_id")->row();
       
        $this->_render_template_front_dashboard("student/third", $data);
    }

}