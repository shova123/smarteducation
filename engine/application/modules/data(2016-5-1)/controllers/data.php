<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends MX_Controller {

    public $hostname;
    public $dbprefix;

    function __construct() {
        parent::__construct();
        $this->load->model('data_model');
        $this->load->library(array('ion_auth', 'form_validation','nepali_calendar'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->user_id = $this->ion_auth->get_user_id();

        //$CI = &get_instance();
//        $this->hostname = $this->db->hostname;
//        $username = $this->db->username;
//        $password = $this->db->password;
//        $databaseName = $this->db->database;
        $this->dbprefix = $this->db->dbprefix;
    }

    function index() {
        return $this->slc();
    }

    public function get_all_methods($class_name = null) {
        return get_class_methods($class_name);
    }

    function _render_page($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render)
            return $view_html;
    }

    function _render_template($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $data : $data;

        $view_html = $this->template->load('template', $view, $data);

        if (!$render)
            return $view_html;
    }

    function _render_template_front($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $data : $data;

        $view_html = $this->template->load('template_front', $view, $data);

        if (!$render)
            return $view_html;
    }

    function _render_template_front_dashboard($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $data : $data;

        $view_html = $this->template->load('template_dashboard', $view, $data);

        if (!$render)
            return $view_html;
    }

    function slc() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("data/data", 'slc', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Data Management";
            $data['result'] = $this->data_model->get_slc();
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("data/data_list", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function list_question($level_slug=null) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("data/data", 'list_question', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Data Management";
            //$data['result'] = $this->data_model->get_results('data_question','','','created_date');//$this->data_model->get_slc();
            $data['result'] = $this->general_db_model->get_join_result("*", "hya_data_question AS q", "hya_course_board cb", "q.board_id = cb.board_id", "hya_course_level cl", "q.level_id = cl.level_id", "cl.level_slug LIKE '%$level_slug%' ");
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("data/data_list", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    
    function reset_add_question() {
        $sessionData = array( 's_board_id'=>'',
                                    's_level_id'=>'',
                                    's_stream_id'=>'',
                                    's_course_id'=>'',
                                    's_department_id'=>'',
                                    's_year'=>'',
                                    's_semester'=>'',
                                    's_subject_id'=>'',
                                    's_chapter_id'=>'',
                                    's_unit_id'=>'',
                                    's_subunit_id'=>'',
                                    's_question_set'=>'',
                                    's_question_tag'=>'',
                                    's_appeared_year'=>'',
                                    's_question_type'=>'',
                                    's_question'=>'',
                                    's_mark'=>''
                        );

        $this->session->unset_userdata($sessionData);
        //$this->session->sess_destroy();
        redirect('data/add_question');
    }

    function add_question() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("data/data", 'add_question', $this->ion_auth->get_user_id())) {

            
            $data['page_title'] = "Add New Question";
            $data['boards'] = $this->data_model->get_results("course_board", 'status', '1', 'board_name');
            $data['levels'] = $this->data_model->get_results("course_level", 'status', '1', 'level_name');
            $data['streams'] = $this->data_model->get_results("course_stream", 'status', '1', 'stream_name');
            $data['courses'] = $this->data_model->get_results("course_course", 'status', '1', 'course_name');
            $data['departments'] = $this->data_model->get_results("course_department", 'status', '1', 'department_name');
            $data['subjects'] = $this->data_model->get_results("course_subject", 'status', '1', 'subject_name');
            $data['chapters'] = $this->data_model->get_results("course_chapter", 'status', '1', 'chapter_name');
            $data['units'] = $this->data_model->get_results("course_unit", 'status', '1', 'unit_name');
            $data['subunits'] = $this->data_model->get_results("course_subunit", 'status', '1', 'subunit_name');
            
            $currentDate = date('Y-m-d');
            $c_y = date('Y', strtotime($currentDate));
            $c_m = date('m', strtotime($currentDate));
            $c_d = date('d', strtotime($currentDate));
            $nepdate= $this->nepali_calendar->eng_to_nep($c_y, $c_m, $c_d);
            
            $data['c_year_n'] = $nepdate['year'];
//            $data['month_n'] = $nepdate['month'];
//            $data['month_name_n'] = $nepdate['nmonth'];
//            $data['day_n'] = $nepdate['date'];
//            $data['day_name_n'] = $nepdate['day'];
            
                
            $this->_render_template("data/add_question", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function add_question_submit(){
        echo "<pre>";
       
        //if ($this->input->post('submitQuestion')) {
                    $insert['board_id'] = $board_id = (isset($_POST['board_id']) && !empty($_POST['board_id']))?$_POST['board_id']:0;
                    $insert['level_id'] = $level_id = (isset($_POST['level_id']) && !empty($_POST['level_id']))?$_POST['level_id']:0;
                    $insert['stream_id'] = $stream_id = (isset($_POST['stream_id']) && !empty($_POST['stream_id'])) ? $_POST['stream_id'] : 0;
                    $insert['course_id'] = $course_id = (isset($_POST['course_id']) && !empty($_POST['course_id'])) ? $_POST['course_id'] : 0;
                    $insert['department_id'] = $department_id =  (isset($_POST['department_id']) && !empty($_POST['department_id'])) ? $_POST['department_id'] : 0;
                    $insert['year'] = $year = isset($_POST['year']) ? $_POST['year'] : 0;
                    $insert['semester'] = $semester = isset($_POST['semester']) ? $_POST['semester'] : 0;
                    $insert['subject_id'] = $subject_id = isset($_POST['subject_id']) ? $_POST['subject_id'] : 0;
                    $insert['chapter_id']= $chapter_id = isset($_POST['chapter_id']) ? $_POST['chapter_id'] : 0;
                    $insert['unit_id'] = $unit_id = isset($_POST['unit_id']) ? $_POST['unit_id'] : 0;
                    $insert['subunit_id'] = $subunit_id = isset($_POST['subunit_id']) ? $_POST['subunit_id'] : 0;
                    $insert['question_set'] = $question_set = $_POST['set'];
                    $insert['question_tag'] = $question_tag = $_POST['question_tag'];
                    $insert['date_type'] = $appeared_year = $_POST['date_type'];
                    $insert['appeared_year'] = $appeared_year = $_POST['appeared_year'];
                    $insert['question_type'] = $question_type = $_POST['question_type'];
                    $insert['question_no'] = $question_no = $_POST['question_no'];
                    $insert['question'] = $question = $_POST['question'];
                    $insert['mark'] = $mark = $_POST['mark'];
                    $insert['user_id'] = $this->user_id;
                    $insert['status'] = 1;
                    $insert['created_date'] = date("Y-m-d H:i:s");

                    $sessionData = array( 's_board_id'=>$board_id,
                                    's_level_id'=>$level_id,
                                    's_stream_id'=>$stream_id,
                                    's_course_id'=>$course_id,
                                    's_department_id'=>$department_id,
                                    's_year'=>$year,
                                    's_semester'=>$semester,
                                    's_subject_id'=>$subject_id,
                                    's_chapter_id'=>$chapter_id,
                                    's_unit_id'=>$unit_id,
                                    's_subunit_id'=>$subunit_id
//                                    's_question_set'=>$question_set,
//                                    's_question_tag'=>$question_tag,
//                                    's_appeared_year'=>$appeared_year,
//                                    's_question_type'=>$question_type,
//                                    's_question'=>$question,
//                                    's_mark'=>$mark
                        );
                $this->session->set_userdata($sessionData);
                  
                $questionId = $this->general_db_model->insert('data_question', $insert);
                
                $subquestions = isset($_POST['subquestion']) ? $_POST['subquestion'] : '';
                $options = isset($_POST['option']) ? $_POST['option'] : '';
                $answers = isset($_POST['answer']) ? $_POST['answer'] : '';
                $reasons = isset($_POST['reason']) ? $_POST['reason'] : '';
                $hints = isset($_POST['hint']) ? $_POST['hint'] : '';
                $description = isset($_POST['description']) ? $_POST['description'] : '';

                if (!empty($subquestions['question'])) {
                    
                    foreach ($subquestions['question'] as $key => $sub) {
                        if(!is_array($sub)){
                            $subquestion_name = $sub;
                        }
                        $option_insert = array(
                            'question_id' => $questionId,
                            'subquestion_name' => $subquestion_name,
                        );
                        
                        $subuestionId = $this->general_db_model->insert("data_subquestion", $option_insert);
                        $soptions = isset($_POST['subquestion']['option']) ? $_POST['subquestion']['option'][$key + 1] : '';
                        $sanswers = isset($_POST['subquestion']['answer']) ? $_POST['subquestion']['answer'][$key + 1] : '';
                        $sreasons = isset($_POST['subquestion']['reason']) ? $_POST['subquestion']['reason'][$key + 1] : '';
                        $shints = isset($_POST['subquestion']['hint']) ? $_POST['subquestion']['hint'][$key + 1] : '';
                        $sdescription = isset($_POST['subquestion']['description']) ? $_POST['subquestion']['description'][$key + 1] : '';
                       
                        if (!empty($soptions)) {
                            foreach ($soptions as $so) {
                                //print_r($so);die;
                                $soption_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $subuestionId,
                                    'option_name' => trim($so),
                                );
                                $this->db->set( $soption_insert );
		                $this->db->insert("data_option");
//                               $oid= $this->db->insert('hya_data_option',$soption_insert);
//                                //$oid=$this->general_db_model->insert("hya_data_option", $soption_insert);
//                                echo $this->db->last_query();die;
                            }
                        }
                        if (!empty($sanswers)) {
                            foreach ($sanswers as $sa) {
                                $sa_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $subuestionId,
                                    'answer_name' => trim($sa),//'answer' => $sa,
                                );
                                $this->db->set( $sa_insert );
		                $this->db->insert("data_answer");
                               // $this->general_db_model->insert("data_option", $sa_insert);
                            }
                        }
                        if (!empty($sreasons)) {
                            foreach ($sreasons as $sr) {
                                $sr_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $subuestionId,
                                    'reason' => trim($sr),
                                );
                                $this->db->set( $sr_insert );
		                $this->db->insert("data_reason");
                                //$this->general_db_model->insert("data_reason", $sr_insert);
                            }
                        }
                        if (!empty($shints)) {
                            foreach ($shints as $sh) {
                                $sh_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $subuestionId,
                                    'hint' => trim($sh),
                                );
                                $this->db->set( $sh_insert );
		                $this->db->insert("data_hint");
                                //$this->general_db_model->insert("data_hint", $sh_insert);
                            }
                        }
                        if (!empty($sdescription)) {
                            foreach ($sdescription as $sd) {
                                $sd_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $subuestionId,
                                    'description' => trim($sd)//'option_name' => $sd,
                                );
                                $this->db->set( $sd_insert );
		                $this->db->insert("data_description");
                                //$this->general_db_model->insert("data_description", $sd_insert);
                            }
                        }
                    }
                }

                if (!empty($options)) {
                     
                    foreach ($options as $o) {
                        
                       
                        $option_insert = array(
                            'question_id' => $questionId,
                            'option_name' => trim($o),
                        );
                        $this->db->set( $option_insert );
		       $opid= $this->db->insert("hya_data_option");
//                        print_r($opid) ;die;
                       // $error=$this->general_db_model->insert("hya_data_option", $option_insert);
                        
                    }
                }
                    
                    if (!empty($answers)) {
                        foreach ($answers as $a) {
                            $a_insert = array(
                                'question_id' => $questionId,
                                'answer_name' => trim($a),//'answer' => $a,
                            );
                            $this->db->set( $a_insert );
		            $this->db->insert("data_answer");
                            //$error1=$this->general_db_model->insert("data_answer", $a_insert);
                        }
                    }
                    if (!empty($reasons)) {
                        foreach ($reasons as $r) {
                            $r_insert = array(
                                'question_id' => $questionId,
                                'reason' => trim($r),
                            );
                            $this->db->set( $r_insert );
		            $this->db->insert("data_reason");
                            //$error2=$this->general_db_model->insert("data_reason", $r_insert);
                        }
                    }
                   // print_r($hints);die;
                    if (!empty($hints)) {
                        foreach ($hints as $h) {
                            $h_insert = array(
                                'question_id' => $questionId,
                                'hint' => trim($h),
                            );
                            // print_r($option_insert);die;
                            	    $this->db->set( $h_insert );
		                    $this->db->insert("data_hint");
//                                
//                            $error3=$this->general_db_model->insert("data_hint", $h_insert);
                        }
                    }
                    if (!empty($description)) {
                        foreach ($description as $d) {
                            $d_insert = array(
                                'question_id' => $questionId,
                                'description' => trim($d),//'option_name' => $d,
                            );
                            $this->db->set( $d_insert );
		            $this->db->insert("data_description");
//                            $error4=$this->general_db_model->insert("data_description", $d_insert);
                        }
                    }
                
             //echo $this->db->last_query();die;
//                echo $error4;die;
//                var_dump($error4,$error1,$error2,$error3);die;


                $this->session->set_flashdata("success_message", "Question Has been Added");
                redirect('data/list_question');
//           }
//           
//           else{
//               $this->session->set_flashdata("error_message", "Duplicate Entry For Level With Same Board");
//               redirect("course/add_level");
//           }
            
    }
    function edit_question($questionId) {
        //echo "hello";die;
        
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("data/data", 'edit_question', $this->ion_auth->get_user_id())) {

            
            $data['page_title'] = "Edit Question";
            $data['details'] = $details = $this->general_db_model->getById("data_question", 'question_id', $questionId);
//            echo '<pre>';
//            print_r($details);die;
            $boardID = $details->board_id;
            $levelID = $details->level_id;
            $streamID = $details->stream_id;
            
            $courseID = $details->course_id;
            $departmentID = $details->department_id;
            $year = $details->year;
            $semester = $details->semester;
            $subjectID = $details->subject_id;
            $chapterID = $details->chapter_id;
            $unitID = $details->unit_id;
            $subunitID = $details->subunit_id;
            
            //$data['qboards'] = $this->data_model->get_resultsNine("course_board");//, 'question_id',$questionId
            $data['qlevels'] = $this->data_model->get_resultsNine("course_level", 'board_id',$boardID);
            $data['qstreams'] = $this->data_model->get_resultsNine("course_stream",'level_id',$levelID);
            $data['qcourses'] = $this->data_model->get_resultsNine("course_course", 'board_id',$boardID,'level_id',$levelID,'stream_id',$streamID);
            $data['qdepartments'] = $this->data_model->get_resultsNine("course_department",'level_id',$levelID,'stream_id',$streamID,'course_id',$courseID);
            $data['qsubjects'] = $this->data_model->get_resultsNine("course_subject", 'board_id',$boardID,'level_id',$levelID,'stream_id',$streamID,'course_id',$courseID,'year',$year,'semester',$semester);
            $data['qchapters'] = $this->data_model->get_resultsNine("course_chapter", 'board_id',$boardID,'level_id',$levelID,'stream_id',$streamID,'course_id',$courseID,'year',$year,'semester',$semester,'subject_id',$subjectID);
            $data['qunits'] = $this->data_model->get_resultsNine("course_unit",'chapter_id',$chapterID);
            $data['qsubunits'] = $this->data_model->get_resultsNine("course_subunit",'unit_id',$unitID);
//            


            $data['boards'] = $this->data_model->get_results("course_board", 'status', '1', 'board_name');
            $data['levels'] = $this->data_model->get_results("course_level", 'status', '1', 'level_name');
            $data['streams'] = $this->data_model->get_results("course_stream", 'status', '1', 'stream_name');
            $data['courses'] = $this->data_model->get_results("course_course", 'status', '1', 'course_name');
            $data['departments'] = $this->data_model->get_results("course_department", 'status', '1', 'department_name');
            $data['subjects'] = $this->data_model->get_results("course_subject", 'status', '1', 'subject_name');
            $data['chapters'] = $this->data_model->get_results("course_chapter", 'status', '1', 'chapter_name');
            $data['units'] = $this->data_model->get_results("course_unit", 'status', '1', 'unit_name');
            $data['subunits'] = $this->data_model->get_results("course_subunit", 'status', '1', 'subunit_name');
            
//            echo '<pre>';
//            print_r($data);die;
        $this->_render_template("data/edit_question", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function edit_question_submit($questionId = null){
        
//        if ($this->input->post('submitQuestion')) {

                $insert = array(
                    'board_id' => $_POST['board_id'],
                    'level_id' => $_POST['level_id'],
                    'stream_id' => isset($_POST['stream_id']) ? $_POST['stream_id'] : 0,
                    'course_id' => isset($_POST['course_id']) ? $_POST['course_id'] : 0,
                    'department_id' => isset($_POST['department_id']) ? $_POST['department_id'] : 0,
                    'year' => isset($_POST['year']) ? $_POST['year'] : 0,
                    'semester' => isset($_POST['semester']) ? $_POST['semester'] : 0,
                    'subject_id' => isset($_POST['subject_id']) ? $_POST['subject_id'] : 0,
                    'chapter_id' => isset($_POST['chapter_id']) ? $_POST['chapter_id'] : 0,
                    'unit_id' => isset($_POST['unit_id']) ? $_POST['unit_id'] : 0,
                    'subunit_id' => isset($_POST['subunit_id']) ? $_POST['subunit_id'] : 0,
                    'question_set' => $_POST['set'],
                    'question_tag' => $_POST['question_tag'],
                    'date_type' => $_POST['date_type'],
                    'appeared_year' => $_POST['appeared_year'],
                    'question_type' => $_POST['question_type'],
                    'question_no' => $_POST['question_no'],
                    'question' => $_POST['question'],
                    'mark' => $_POST['mark'],
                    'user_id' => $this->user_id,
                    'status' => 1,
                    'created_date' => date("Y-m-d H:i:s")
                );

                $questionId = $this->general_db_model->update('data_question', $insert, 'question_id =' . $questionId);
                $this->general_db_model->delete("data_option", "question_id =" . $questionId);
                $this->general_db_model->delete("data_hint", "question_id =" . $questionId);
                $this->general_db_model->delete("data_answer", "question_id =" . $questionId);
                $this->general_db_model->delete("data_reason", "question_id =" . $questionId);
                $this->general_db_model->delete("data_description", "question_id =" . $questionId);

                $subquestions = isset($_POST['subquestion']) ? $_POST['subquestion'] : '';
                $options = isset($_POST['option']) ? $_POST['option'] : '';
                $answers = isset($_POST['answer']) ? $_POST['answer'] : '';
                $reasons = isset($_POST['reason']) ? $_POST['reason'] : '';
                $hints = isset($_POST['hint']) ? $_POST['hint'] : '';
                $description = isset($_POST['description']) ? $_POST['description'] : '';
                if (!empty($subquestions)) {
//                    echo "<pre>";
//                    print_r($subquestions);
                    foreach ($subquestions as $key => $sub) {
                        if(is_array($key)){
                            
                        }elseif(is_numeric($key)){
                            $option_insert = array(
                                'question_id' => $questionId,
                                'subquestion_name' => $sub,
                            );
                            // print_r($option_insert);die;
                            $subuestionId = $this->general_db_model->update("data_subquestion", $option_insert,'subquestion_id',$key);
                        }
                        
                        $soptions = isset($_POST['subquestion']['option']) ? $_POST['subquestion']['option'] : '';
                        $sanswers = isset($_POST['subquestion']['answer']) ? $_POST['subquestion']['answer'] : '';
                        $sreasons = isset($_POST['subquestion']['reason']) ? $_POST['subquestion']['reason'] : '';
                        $shints = isset($_POST['subquestion']['hint']) ? $_POST['subquestion']['hint'] : '';
                        $sdescription = isset($_POST['subquestion']['description']) ? $_POST['subquestion']['description'] : '';
                        $this->general_db_model->delete("data_option",'subquestion_id',$key);
                        $this->general_db_model->delete("data_answer",'subquestion_id',$key);
                        $this->general_db_model->delete("data_reason",'subquestion_id',$key);
                        $this->general_db_model->delete("data_hint",'subquestion_id',$key);
                        $this->general_db_model->delete("data_description",'subquestion_id',$key);
                        if (!empty($soptions)) {
                            foreach ($soptions as $so) {
                                if(is_array($so)){
                                    foreach($so as $sso){
                                        $soption_insert = array(
                                            'question_id' => $questionId,
                                            'subquestion_id' => $key,
                                            'option_name' => trim($sso),
                                        );
                                        $this->db->set( $soption_insert );
		                        $this->db->insert("data_option");
                                        // print_r($option_insert);die;
//                                        $this->general_db_model->insert("data_option", $soption_insert);
                                    }
                                }
                                
                                
                            }
                        }
                        if (!empty($sanswers)) {
                            foreach ($sanswers as $sa) {
                                if(is_array($sa)){
                                    foreach($sa as $ssa){
                                        $sa_insert = array(
                                            'question_id' => $questionId,
                                            'subquestion_id' => $key,
                                            'answer' => trim($ssa),
                                        );
                                        $this->db->set( $sa_insert );
		                        $this->db->insert("data_answer");
                                        // print_r($option_insert);die;
//                                        $this->general_db_model->insert("data_answer", $sa_insert);
                                    }
                                }
                                
                            }
                        }
                        if (!empty($sreasons)) {
                            foreach ($sreasons as $sr) {
                                if(is_array($sr)){
                                    foreach($sr as $ssr){
                                        $sr_insert = array(
                                            'question_id' => $questionId,
                                            'subquestion_id' => $key,
                                            'reason' => trim($ssr),
                                        );
                                        $this->db->set( $sr_insert );
		                        $this->db->insert("data_reason");
                                        // print_r($option_insert);die;
//                                        $this->general_db_model->insert("data_reason", $sr_insert);
                                    }
                                }
                                
                            }
                        }
                        if (!empty($shints)) {
                            foreach ($shints as $sh) {
                                if(is_array($sh)){
                                    foreach($sh as $ssh){
                                        $sh_insert = array(
                                            'question_id' => $questionId,
                                            'subquestion_id' => $key,
                                            'hint' => trim($ssh),
                                        );
                                        $this->db->set( $sh_insert );
		                        $this->db->insert("data_hint");
                                        // print_r($option_insert);die;
//                                        $this->general_db_model->insert("data_hint", $sh_insert);
                                        
                                    }
                                }
                                
                            }
                        }
                        if (!empty($sdescription)) {
                            foreach ($sdescription as $sd) {
                                if(is_array($sd)){
                                    foreach($sd as $ssd){
                                        $sd_insert = array(
                                            'question_id' => $questionId,
                                            'subquestion_id' => $key,
                                            'description' => trim($ssd),
                                        );
                                        $this->db->set( $sd_insert );
		                        $this->db->insert("data_description");
                                        // print_r($option_insert);die;
//                                        $this->general_db_model->insert("data_description", $sd_insert);
                                        
                                    }
                                }
                                
                            }
                        }
                    }
                }
                
                if (!empty($options)) {
                   
                    foreach ($options as $o) {
                        $option_insert = array(
                            'question_id' => $questionId,
                            'option_name' => trim($o),
                        );
                        // print_r($option_insert);die;
                         $this->db->set( $option_insert );
		         $opid= $this->db->insert("hya_data_option");
//                          echo "<pre>";
//                    print_r($opid);die;
//                        $this->general_db_model->insert("data_option", $option_insert);
                    }
                }
                    if (!empty($answers)) {
                        foreach ($answers as $a) {
                            $a_insert = array(
                                'question_id' => $questionId,
                                'answer' => trim($a),
                            );
                             $this->db->set( $a_insert );
		            $this->db->insert("data_answer");
                            // print_r($option_insert);die;
//                            $this->general_db_model->insert("data_option", $a_insert);
                        }
                    }
                    if (!empty($reasons)) {
                        foreach ($reasons as $r) {
                            $r_insert = array(
                                'question_id' => $questionId,
                                'reason' => trim($r),
                            );
                            $this->db->set( $r_insert );
		            $this->db->insert("data_reason");
                            // print_r($option_insert);die;
//                            $this->general_db_model->insert("data_reason", $r_insert);
                        }
                    }
                    if (!empty($hints)) {
                        foreach ($hints as $h) {
                            $h_insert = array(
                                'question_id' => $questionId,
                                'hint' =>trim($h),
                            );
                                    $this->db->set( $h_insert );
		                    $this->db->insert("data_hint");
                            // print_r($option_insert);die;
//                            $this->general_db_model->insert("data_hint", $h_insert);
                        }
                    }
                    if (!empty($description)) {
                        foreach ($description as $d) {
                            $d_insert = array(
                                'question_id' => $questionId,
                                'description' => trim($d),
                            );
                            $this->db->set( $d_insert );
		            $this->db->insert("data_description");
                            // print_r($option_insert);die;
//                            $this->general_db_model->insert("data_description", $d_insert);
                        }
                    }
                



                $this->session->set_flashdata("success_message", "Question Has been edited");
                redirect('data/list_question');
//           }
//           
//           else{
//               $this->session->set_flashdata("error_message", "Duplicate Entry For Level With Same Board");
//               redirect("course/add_level");
//           }
            
    }
    
    function update_status_data() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('data_question', $post, 'question_id = ' . $id);
        echo $data['status'];
    }

    function delete_question($id = NULL) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("data/data", 'delete_question', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('data_question', 'question_id = ' . $id);

            $this->general_db_model->delete("data_option", "question_id =" . $id);
            $this->general_db_model->delete("data_hint", "question_id =" . $id);
            $this->general_db_model->delete("data_answer", "question_id =" . $id);
            $this->general_db_model->delete("data_reason", "question_id =" . $id);
            $this->general_db_model->delete("data_description", "question_id =" . $id);
            $this->session->set_flashdata('display_message', 'Question successfully deleted.');
            redirect("data/list_question");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    
     function delete_ajax_option() {
        $option_id = $this->input->post('option_id');
        echo $option_id;
        $this->general_db_model->deleteWhere('hya_data_option', 'option_id', $option_id);
        //$this->templates_model->delete('users_question_option', 'q_id', $qid);
        $this->session->set_flashdata('message', 'Option successfully deleted.');
        echo "deleted";
    }

}
?>