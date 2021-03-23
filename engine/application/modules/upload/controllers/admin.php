
<?php
class Admin extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('upload_model');
        $this->load->model('data/data_model');
        $this->load->library(array('ion_auth', 'form_validation','nepali_calendar'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
        $this->user_id = $this->ion_auth->get_user_id();
        $this->dbprefix = $this->db->dbprefix;
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

    function syllabus_list() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("upload/admin", 'syllabus_list', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Upload syllabus";
           $data['results'] = $this->upload_model->get_all('hya_syllabus');
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("upload/list", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    
    function add_syllabus() {
        //print_r($_POST);
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("upload/admin", 'add_syllabus', $this->ion_auth->get_user_id())) {
            if ($this->input->post('submitQuestion')) {
                    $insert['token'] = $mark = $_POST['token'];
                    $insert['board_id'] = $board_id = (isset($_POST['board_id']) && !empty($_POST['board_id']))?$_POST['board_id']:0;
                    $insert['level_id'] = $level_id = (isset($_POST['level_id']) && !empty($_POST['level_id']))?$_POST['level_id']:0;
                    $insert['stream_id'] = $stream_id = (isset($_POST['stream_id']) && !empty($_POST['stream_id'])) ? $_POST['stream_id'] : 0;
                    $insert['course_id'] = $course_id = (isset($_POST['course_id']) && !empty($_POST['course_id'])) ? $_POST['course_id'] : 0;
                    $insert['department_id'] = $department_id =  (isset($_POST['department_id']) && !empty($_POST['department_id'])) ? $_POST['department_id'] : 0;
                    $insert['date_type'] = $date_type = (isset($_POST['date_type']) && !empty($_POST['date_type']))?$_POST['date_type']:0;
                    $insert['year'] = $year = (isset($_POST['year']) && !empty($_POST['year']))?$_POST['year']:0;
                    $insert['appeared_year'] = $appeared_year = (isset($_POST['appeared_year']) && !empty($_POST['appeared_year']))?$_POST['appeared_year']:0;
                    $insert['semester'] = $semester = (isset($_POST['semester']) && !empty($_POST['semester']))?$_POST['semester']:0;
                    $insert['subject_id'] = $subject_id = (isset($_POST['subject_id']) && !empty($_POST['subject_id']))?$_POST['subject_id']:0;
                    $insert['home_image']=$_POST['fileList'];
                    $insert['user_id'] = $this->user_id;
                    $insert['status'] = 1;
                    $this->general_db_model->insert("syllabus", $insert);
                     $this->session->set_flashdata("success_message", "Syllabus Has been Added");
                    redirect("admin/upload/syllabus_list");
            }
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
            $this->_render_template("upload/add", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    
    function do_upload()
        {
        $config['upload_path'] = './uploads/syllabus/';
        $config['allowed_types'] = 'gif|jpg|png|pdf';
        $config['max_size']    = '100';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';

        // You can give video formats if you want to upload any video file.

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload())
        {
        $error = array('error' => $this->upload->display_errors());

        // uploading failed. $error will holds the errors.
        }
        else
        {
        $data = array('upload_data' => $this->upload->data());

        // uploading successfull, now do your further actions
        }
        }
    function edit_syllabus($questionId = null){
                
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("data/data", 'edit_question', $this->ion_auth->get_user_id())) {

       if ($this->input->post('submitQuestion')) {
                    $insert['token'] = $mark = $_POST['token'];
                    $insert['board_id'] = $board_id = (isset($_POST['board_id']) && !empty($_POST['board_id']))?$_POST['board_id']:0;
                    $insert['level_id'] = $level_id = (isset($_POST['level_id']) && !empty($_POST['level_id']))?$_POST['level_id']:0;
                    $insert['stream_id'] = $stream_id = (isset($_POST['stream_id']) && !empty($_POST['stream_id'])) ? $_POST['stream_id'] : 0;
                    $insert['course_id'] = $course_id = (isset($_POST['course_id']) && !empty($_POST['course_id'])) ? $_POST['course_id'] : 0;
                    $insert['department_id'] = $department_id =  (isset($_POST['department_id']) && !empty($_POST['department_id'])) ? $_POST['department_id'] : 0;
                    $insert['date_type'] = $date_type = (isset($_POST['date_type']) && !empty($_POST['date_type']))?$_POST['date_type']:0;
                    $insert['year'] = $year = (isset($_POST['year']) && !empty($_POST['year']))?$_POST['year']:0;
                    $insert['appeared_year'] = $appeared_year = (isset($_POST['appeared_year']) && !empty($_POST['appeared_year']))?$_POST['appeared_year']:0;
                    $insert['semester'] = $semester = (isset($_POST['semester']) && !empty($_POST['semester']))?$_POST['semester']:0;
                    $insert['subject_id'] = $subject_id = (isset($_POST['subject_id']) && !empty($_POST['subject_id']))?$_POST['subject_id']:0;
                    $insert['home_image']=$_POST['fileList'];
                    $insert['user_id'] = $this->user_id;
                    $insert['status'] = 1;
                 
                $questionId = $this->general_db_model->update('hya_syllabus', $insert, 'syllabus_id =' . $questionId);
                $this->session->set_flashdata("success_message", "Syllabus Has been edited");
                redirect("upload/admin/syllabus_list");
           }
           
            
            $data['page_title'] = "Edit Syllabus";
            $data['details'] = $details = $this->general_db_model->getById("hya_syllabus", 'syllabus_id', $questionId);
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
            
            //$data['qboards'] = $this->data_model->get_resultsNine("course_board");//, 'question_id',$questionId
            $data['qlevels'] = $this->data_model->get_resultsNine("course_level", 'board_id',$boardID);
            $data['qstreams'] = $this->data_model->get_resultsNine("course_stream",'level_id',$levelID);
            $data['qcourses'] = $this->data_model->get_resultsNine("course_course", 'board_id',$boardID,'level_id',$levelID,'stream_id',$streamID);
            $data['qdepartments'] = $this->data_model->get_resultsNine("course_department",'level_id',$levelID,'stream_id',$streamID,'course_id',$courseID);
            $data['qsubjects'] = $this->data_model->get_resultsNine("course_subject", 'board_id',$boardID,'level_id',$levelID,'stream_id',$streamID,'course_id',$courseID,'year',$year,'semester',$semester);
             


            $data['boards'] = $this->data_model->get_results("course_board", 'status', '1', 'board_name');
            $data['levels'] = $this->data_model->get_results("course_level", 'status', '1', 'level_name');
            $data['streams'] = $this->data_model->get_results("course_stream", 'status', '1', 'stream_name');
            $data['courses'] = $this->data_model->get_results("course_course", 'status', '1', 'course_name');
            $data['departments'] = $this->data_model->get_results("course_department", 'status', '1', 'department_name');
            $data['subjects'] = $this->data_model->get_results("course_subject", 'status', '1', 'subject_name');
           
            
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
//            echo '<pre>';
//            print_r($data);die;
        $this->_render_template("upload/add", $data);
        }
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
        $this->general_model->update('hya_syllabus', $post, 'syllabus_id = ' . $id);
        echo $data['status'];
    }
    
    function delete_syllabus_image(){
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'syllabus/' . $img; //echo $imgpath; exit;
        if (file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Syllabus successfully deleted!';
        } else {
            echo 'File does not exist!';
        } 
    }
    function delete_syllabus($id = NULL) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("upload/admin", 'delete_syllabus', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('syllabus', 'syllabus_id = ' . $id);

            $this->session->set_flashdata('display_message', 'syllabus successfully deleted.');
            redirect("admin/upload/syllabus_list");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }


}

?>