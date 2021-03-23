<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends MX_Controller {

    public $hostname;
    public $dbprefix;

    function __construct() {
        parent::__construct();
        $this->load->model('data_model');
        $this->load->library(array('ion_auth', 'form_validation'));
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
            $data['result'] = $this->data_model->get_results('data_question','','','created_date');//$this->data_model->get_slc();
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("data/data_list", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    
    function add_question() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("data/data", 'add_question', $this->ion_auth->get_user_id())) {

            if ($this->input->post('submitQuestion')) {
//                echo "<pre>";
//                print_r($_POST);die;
                $insert = array(
                    'board_id' => (isset($_POST['board_id']) && !empty($_POST['board_id']))?$_POST['board_id']:0,
                    'level_id' => (isset($_POST['level_id']) && !empty($_POST['level_id']))?$_POST['level_id']:0,
                    'stream_id' => (isset($_POST['stream_id']) && !empty($_POST['stream_id'])) ? $_POST['stream_id'] : 0,
                    'course_id' => (isset($_POST['course_id']) && !empty($_POST['course_id'])) ? $_POST['course_id'] : 0,
                    'department_id' => (isset($_POST['department_id']) && !empty($_POST['department_id'])) ? $_POST['department_id'] : 0,
                    'subject_id' => isset($_POST['subject_id']) ? $_POST['subject_id'] : 0,
                    'chapter_id' => isset($_POST['chapter_id']) ? $_POST['chapter_id'] : 0,
                    'unit_id' => isset($_POST['unit_id']) ? $_POST['unit_id'] : 0,
                    'subunit_id' => isset($_POST['subunit_id']) ? $_POST['subunit_id'] : 0,
                    'question_set' => $_POST['set'],
                    'question_tag' => $_POST['question_tag'],
                    'appeared_year' => $_POST['appeared_year'],
                    'question_type' => $_POST['question_type'],
                    'question' => $_POST['question'],
                    'mark' => $_POST['mark'],
                    'user_id' => $this->user_id,
                    'status' => 1,
                    'created_date' => date("Y-m-d H:i:s")
                );

                $questionId = $this->general_db_model->insert('data_question', $insert);
                //echo $questionId;die;
                $subquestions = isset($_POST['subquestion']) ? $_POST['subquestion'] : '';
                $options = isset($_POST['option']) ? $_POST['option'] : '';
                $answers = isset($_POST['answer']) ? $_POST['answer'] : '';
                $reasons = isset($_POST['reason']) ? $_POST['reason'] : '';
                $hints = isset($_POST['hint']) ? $_POST['hint'] : '';
                $description = isset($_POST['description']) ? $_POST['description'] : '';
//                echo "<pre>";
//               print_r($subquestions);die;
                if (!empty($subquestions['question'])) {
                    
                    foreach ($subquestions['question'] as $key => $sub) {
                        if(!is_array($sub)){
                            $subquestion_name = $sub;
                        }
                        $option_insert = array(
                            'question_id' => $questionId,
                            'subquestion_name' => $subquestion_name,
                        );
                        // print_r($option_insert);die;
                        $subuestionId = $this->general_db_model->insert("data_subquestion", $option_insert);
                        $soptions = isset($_POST['subquestion']['option']) ? $_POST['subquestion']['option'][$key + 1] : '';
                        $sanswers = isset($_POST['subquestion']['answer']) ? $_POST['subquestion']['answer'][$key + 1] : '';
                        $sreasons = isset($_POST['subquestion']['reason']) ? $_POST['subquestion']['reason'][$key + 1] : '';
                        $shints = isset($_POST['subquestion']['hint']) ? $_POST['subquestion']['hint'][$key + 1] : '';
                        $sdescription = isset($_POST['subquestion']['description']) ? $_POST['subquestion']['description'][$key + 1] : '';
                        
                        if (!empty($soptions)) {
                            foreach ($soptions as $so) {
                                $soption_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $subuestionId,
                                    'option_name' => $so,
                                );
                                // print_r($option_insert);die;
                                $this->general_db_model->insert("data_option", $soption_insert);
                            }
                        }
                        if (!empty($sanswers)) {
                            foreach ($sanswers as $sa) {
                                $sa_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $subuestionId,
                                    'option_name' => $sa,//'answer' => $sa,
                                );
                                // print_r($option_insert);die;
                                $this->general_db_model->insert("data_option", $sa_insert);
                            }
                        }
                        if (!empty($sreasons)) {
                            foreach ($sreasons as $sr) {
                                $sr_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $subuestionId,
                                    'reason' => $sr,
                                );
                                // print_r($option_insert);die;
                                $this->general_db_model->insert("data_reason", $sr_insert);
                            }
                        }
                        if (!empty($shints)) {
                            foreach ($shints as $sh) {
                                $sh_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $subuestionId,
                                    'hint' => $sh,
                                );
                                // print_r($option_insert);die;
                                $this->general_db_model->insert("data_hint", $sh_insert);
                            }
                        }
                        if (!empty($sdescription)) {
                            foreach ($sdescription as $sd) {
                                $sd_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $subuestionId,
                                    'description' => $sd//'option_name' => $sd,
                                );
                                // print_r($option_insert);die;
                                $this->general_db_model->insert("data_description", $sd_insert);
                            }
                        }
                    }
                }

                if (!empty($options)) {
                     
                    foreach ($options as $o) {
                       
                        $option_insert = array(
                            'question_id' => $questionId,
                            'option_name' => $o,
                        );
                        // print_r($option_insert);die;
                        $error=$this->general_db_model->insert("data_option", $option_insert);
                        
                    }
                    
                    if (!empty($answers)) {
                        foreach ($answers as $a) {
                            $a_insert = array(
                                'question_id' => $questionId,
                                'answer' => $a,//'answer' => $a,
                            );
                            // print_r($option_insert);die;
                            $this->general_db_model->insert("data_answer", $a_insert);
                        }
                    }
                    if (!empty($reasons)) {
                        foreach ($reasons as $r) {
                            $r_insert = array(
                                'question_id' => $questionId,
                                'reason' => $r,
                            );
                            // print_r($option_insert);die;
                            $this->general_db_model->insert("data_reason", $r_insert);
                        }
                    }
                    if (!empty($hints)) {
                        foreach ($hints as $h) {
                            $h_insert = array(
                                'question_id' => $questionId,
                                'hint' => $h,
                            );
                            // print_r($option_insert);die;
                            $this->general_db_model->insert("data_hint", $h_insert);
                        }
                    }
                    if (!empty($description)) {
                        foreach ($description as $d) {
                            $d_insert = array(
                                'question_id' => $questionId,
                                'description' => $d,//'option_name' => $d,
                            );
                            // print_r($option_insert);die;
                            $this->general_db_model->insert("data_description", $d_insert);
                        }
                    }
                }



                $this->session->set_flashdata("success_message", "New Level is Added");
                //redirect('data/data');
                redirect('list_question');
//           }
//           
//           else{
//               $this->session->set_flashdata("error_message", "Duplicate Entry For Level With Same Board");
//               redirect("course/add_level");
//           }
            }
            $data['page_title'] = "Add New Question";
            $data['boards'] = $this->data_model->get_results("course_board", 'status', '1', 'board_name');
            $data['levels'] = $this->data_model->get_results("course_level", 'status', '1', 'level_name');
            $data['streams'] = $this->data_model->get_results("course_stream", 'status', '1', 'stream_name');
            $data['courses'] = $this->data_model->get_results("course_course", 'status', '1', 'course_name');
            $data['departments'] = $this->data_model->get_results("course_department", 'status', '1', 'department_name');
            $data['subjects'] = $this->data_model->get_results("course_subject", 'status', '1', 'subject_name');
            $data['chapters'] = $this->data_model->get_results("course_chapter", 'status', '1', 'chapter_name');
            $data['units'] = $this->data_model->get_results("course_unit", 'status', '1', 'unit_name');
            $data['subUnits'] = $this->data_model->get_results("course_subunit", 'status', '1', 'subunit_name');

            $this->_render_template("data/add_question", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function edit_question($questionId) {
        //echo "hello";die;
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("data/data", 'edit_question', $this->ion_auth->get_user_id())) {

            if ($this->input->post('submitQuestion')) {

                $insert = array(
                    'board_id' => $_POST['board_id'],
                    'level_id' => $_POST['level_id'],
                    'stream_id' => isset($_POST['stream_id']) ? $_POST['stream_id'] : 0,
                    'course_id' => isset($_POST['course_id']) ? $_POST['course_id'] : 0,
                    'department_id' => isset($_POST['department_id']) ? $_POST['department_id'] : 0,
                    'subject_id' => isset($_POST['subject_id']) ? $_POST['subject_id'] : 0,
                    'chapter_id' => isset($_POST['chapter_id']) ? $_POST['chapter_id'] : 0,
                    'unit_id' => isset($_POST['unit_id']) ? $_POST['unit_id'] : 0,
                    'subunit_id' => isset($_POST['subunit_id']) ? $_POST['subunit_id'] : 0,
                    'question_set' => $_POST['set'],
                    'question_tag' => $_POST['question_tag'],
                    'appeared_year' => $_POST['appeared_year'],
                    'question_type' => $_POST['question_type'],
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
                    foreach ($subquestions as $key => $sub) {
                        $option_insert = array(
                            'question_id' => $questionId,
                            'subquestion_name' => $sub,
                        );
                        // print_r($option_insert);die;
                        $subuestionId = $this->general_db_model->update("data_subquestion", $option_insert,'subquestion_id',$key);
                        $soptions = isset($_POST['subquestion']['option']) ? $_POST['subquestion']['option'][$key + 1] : '';
                        $sanswers = isset($_POST['subquestion']['answer']) ? $_POST['subquestion']['answer'][$key + 1] : '';
                        $sreasons = isset($_POST['subquestion']['reason']) ? $_POST['subquestion']['reason'][$key + 1] : '';
                        $shints = isset($_POST['subquestion']['hint']) ? $_POST['subquestion']['hint'][$key + 1] : '';
                        $sdescription = isset($_POST['subquestion']['description']) ? $_POST['subquestion']['description'][$key + 1] : '';
                        $this->general_db_model->delete("data_option",'subquestion_id',$key);
                        $this->general_db_model->delete("data_answer",'subquestion_id',$key);
                        $this->general_db_model->delete("data_reason",'subquestion_id',$key);
                        $this->general_db_model->delete("data_hint",'subquestion_id',$key);
                        $this->general_db_model->delete("data_description",'subquestion_id',$key);
                        if (!empty($soptions)) {
                            foreach ($soptions as $so) {
                                $soption_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $key,
                                    'option_name' => $so,
                                );
                                // print_r($option_insert);die;
                                $this->general_db_model->insert("data_option", $soption_insert);
                            }
                        }
                        if (!empty($sanswers)) {
                            foreach ($sanswers as $sa) {
                                $sa_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $key,
                                    'answer' => $sa,
                                );
                                // print_r($option_insert);die;
                                $this->general_db_model->insert("data_answer", $sa_insert);
                            }
                        }
                        if (!empty($sreasons)) {
                            foreach ($sreasons as $sr) {
                                $sr_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $key,
                                    'reason' => $sr,
                                );
                                // print_r($option_insert);die;
                                $this->general_db_model->insert("data_reason", $sr_insert);
                            }
                        }
                        if (!empty($shints)) {
                            foreach ($shints as $sh) {
                                $sh_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $key,
                                    'hint' => $sh,
                                );
                                // print_r($option_insert);die;
                                $this->general_db_model->insert("data_hint", $sh_insert);
                            }
                        }
                        if (!empty($sdescription)) {
                            foreach ($sdescription as $sd) {
                                $sd_insert = array(
                                    'question_id' => $questionId,
                                    'subquestion_id' => $key,
                                    'option_name' => $sd,
                                );
                                // print_r($option_insert);die;
                                $this->general_db_model->insert("data_description", $sd_insert);
                            }
                        }
                    }
                }

                if (!empty($options)) {
                    foreach ($options as $o) {
                        $option_insert = array(
                            'question_id' => $questionId,
                            'option_name' => $o,
                        );
                        // print_r($option_insert);die;
                        $this->general_db_model->insert("data_option", $option_insert);
                    }
                    if (!empty($answers)) {
                        foreach ($answers as $a) {
                            $a_insert = array(
                                'question_id' => $questionId,
                                'answer' => $a,
                            );
                            // print_r($option_insert);die;
                            $this->general_db_model->insert("data_option", $a_insert);
                        }
                    }
                    if (!empty($reasons)) {
                        foreach ($reasons as $r) {
                            $r_insert = array(
                                'question_id' => $questionId,
                                'reason' => $r,
                            );
                            // print_r($option_insert);die;
                            $this->general_db_model->insert("data_reason", $r_insert);
                        }
                    }
                    if (!empty($hints)) {
                        foreach ($hints as $h) {
                            $h_insert = array(
                                'question_id' => $questionId,
                                'hint' => $h,
                            );
                            // print_r($option_insert);die;
                            $this->general_db_model->insert("data_hint", $h_insert);
                        }
                    }
                    if (!empty($description)) {
                        foreach ($description as $d) {
                            $d_insert = array(
                                'question_id' => $questionId,
                                'option_name' => $d,
                            );
                            // print_r($option_insert);die;
                            $this->general_db_model->insert("data_description", $d_insert);
                        }
                    }
                }



                $this->session->set_flashdata("success_message", "New Level is Added");
                //redirect('data/data');
                redirect('list_question');
//           }
//           
//           else{
//               $this->session->set_flashdata("error_message", "Duplicate Entry For Level With Same Board");
//               redirect("course/add_level");
//           }
            }
            $data['page_title'] = "Edit Question";
            $data['details'] = $this->general_db_model->getById("data_question", 'question_id', $questionId);
//            $data['qboards'] = $this->general_db_model->get_results("course_board", 'question_id',$questionId);
//            $data['qlevels'] = $this->general_db_model->get_results("course_level", 'question_id',$questionId);
//            $data['qstreams'] = $this->general_db_model->get_results("course_stream", 'question_id',$questionId);
//            $data['qcourses'] = $this->general_db_model->get_results("course_course", 'question_id',$questionId);
//            $data['qdepartments'] = $this->general_db_model->get_results("course_department", 'question_id',$questionId);
//            $data['qsubjects'] = $this->general_db_model->get_results("course_subject", 'question_id',$questionId);
//            $data['qchapters'] = $this->general_db_model->get_results("course_chapter", 'question_id',$questionId);
//            $data['qunits'] = $this->general_db_model->get_results("course_unit", 'question_id',$questionId);
//            $data['qsubUnits'] = $this->general_db_model->get_results("course_subunit", 'question_id',$questionId);
//            


            $data['boards'] = $this->data_model->get_results("course_board", 'status', '1', 'board_name');
            $data['levels'] = $this->data_model->get_results("course_level", 'status', '1', 'level_name');
            $data['streams'] = $this->data_model->get_results("course_stream", 'status', '1', 'stream_name');
            $data['courses'] = $this->data_model->get_results("course_course", 'status', '1', 'course_name');
            $data['departments'] = $this->data_model->get_results("course_department", 'status', '1', 'department_name');
            $data['subjects'] = $this->data_model->get_results("course_subject", 'status', '1', 'subject_name');
            $data['chapters'] = $this->data_model->get_results("course_chapter", 'status', '1', 'chapter_name');
            $data['units'] = $this->data_model->get_results("course_unit", 'status', '1', 'unit_name');
            $data['subUnits'] = $this->data_model->get_results("course_subunit", 'status', '1', 'subunit_name');

            $this->_render_template("data/edit_question", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
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

}
