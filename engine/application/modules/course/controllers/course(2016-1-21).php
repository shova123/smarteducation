<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('courseModel');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    public function get_all_methods($class_name = null) {
        return get_class_methods($class_name);
    }

    function board() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'board', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Board";
            $data['boards'] = $this->courseModel->get_board();
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/board/board-list", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function board_add() {
        //print_r($_POST);
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'board_add', $this->ion_auth->get_user_id())) {
            $insert = array(
                'board_name' => $_POST['board_name'],
                'status' => $_POST['status'],
                'created_date' => time()
            );
            $this->general_db_model->insert('hya_course_board', $insert);
            echo $_POST['board_name'];
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function board_edit() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'board_edit', $this->ion_auth->get_user_id())) {
            //print_r($_POST);
            $update = array(
                'board_name' => $_POST['board_name'],
                'status' => $_POST['status'],
                'created_date' => time()
            );
            $id = $_POST['id'];
            $this->general_db_model->update('hya_course_board', $update, 'id = ' . $id);
            echo $_POST['board_name'];
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function board_delete($id) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'board_delete', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('hya_course_board', 'id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully deleted.');
            redirect("course/board");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function board_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('hya_course_board', $post, 'id = ' . $id);
        echo $data['status'];
    }
    function list_level() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'list_level', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Level";
            $data['levels'] = $this->courseModel->get_level();
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/level/list_level", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function add_level()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_level', $this->ion_auth->get_user_id())) {
        
            if($this->input->post('submit')){
                    $insert = array(
                    'level_type' => $_POST['level_type'],
                    'level_name' => $_POST['level_name'],
                    'level_slug' => $_POST['level_slug'],
                    'status' => $_POST['status'],
                    'order' => $_POST['order'],
                    'created_date' => date("Y-m-d H:i:s")
                );
    //            print_r($insert);die;
                $this->general_db_model->insert('hya_course_level', $insert);
                $this->session->set_flashdata("success_message","New Level is Added");
            //    redirect('course/add_level');
            }
        $data['page_title']="Add New Level";
        $data['board']=$this->courseModel->get_board();
        $this->_render_template("course/level/add_list", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
        
    }
    function edit_level($id=NULL)
    {

        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_level', $this->ion_auth->get_user_id())) {
         if($this->input->post('submit')){
            $insert = array(
                'level_type' => $_POST['level_type'],
                 
                'level_name' => $_POST['level_name'],
                'level_slug' => $_POST['level_slug'],
                'status' => $_POST['status'],
                'order' => $_POST['order'],
                'created_date' => date("Y-m-d H:i:s")
            );
            //print_r($insert);die;
            
            $this->general_db_model->update('hya_course_level', $insert,'level_id = ' . $id);
            //$this->general_db_model->update('permissions', $post, 'level_id = ' . $id);
            $this->session->set_flashdata('message', 'Page successfully updated.');
            redirect('course/list_level');
            
        }
        $data['page_title']="Add New Level";
        $data['board']=$this->courseModel->get_board();
        $data['details']=$this->general_db_model->getById("hya_course_level",'level_id',$id);
        $this->_render_template("course/level/add_list", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function delete_level($id=NULL)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_level', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('hya_course_level', 'level_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully deleted.');
            redirect("course/list_level");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function update_status_level()
    {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('hya_course_level', $post, 'level_id = ' . $id);
        echo $data['status'];
    }
     function list_stream() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'list_stream', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Stream";
            $data['streams'] = $this->courseModel->get_stream();
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/stream/list_stream", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function add_stream()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_stream', $this->ion_auth->get_user_id())) {
        
            if($this->input->post('submit')){
                $order=$_POST['order'];
                $exist=$this->general_db_model->value_exist('hya_course_stream',"order",$order);
                if(!$exist){
                    $insert = array(
                    'stream_name' => $_POST['stream_name'],
                    'stream_slug' => $_POST['stream_slug'],
                    'status' => $_POST['status'],
                    'order' => $_POST['order'],
                    'created_date' => date("Y-m-d H:i:s")
                );
                print_r($insert);die;
                $this->general_db_model->insert('hya_course_stream', $insert);
                $this->session->set_flashdata("success_message","New Stream is Added");
                }
                else{
                   $this->session->set_flashdata("error_message","Order Number is already Taken");
                 
                }
            //    redirect('course/add_level');
            }
        $data['page_title']="Add New Stream";
        $data['board']=$this->courseModel->get_board();
        $this->_render_template("course/stream/add_stream", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
        
    }
    function edit_stream($id=NULL)
    {

        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'edit_stream', $this->ion_auth->get_user_id())) {
         if($this->input->post('submit')){
             $order=$_POST['order'];
                
              $exist=$this->db->query("SELECT * FROM hya_course_stream as s WHERE s.order=$order AND s.stream_id !=$id ")->result();
                if(count($exist)<= 0){
            $insert = array(
                'stream_name' => $_POST['stream_name'],
                'stream_slug' => $_POST['stream_slug'],
                'status' => $_POST['status'],
                'order' => $_POST['order'],
                'created_date' => date("Y-m-d H:i:s")
            );
            //print_r($insert);die;
            
            $this->general_db_model->update('hya_course_stream', $insert,'stream_id = ' . $id);
            //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
            $this->session->set_flashdata('message', 'Page successfully updated.');
            redirect('course/list_stream');
            }
                else{
                   $this->session->set_flashdata("error_message","Order Number is already Taken");
                 
                }
            
        }
        $data['page_title']="Add New Stream";
        $data['board']=$this->courseModel->get_stream();
        $data['details']=$this->general_db_model->getById("hya_course_stream",'stream_id',$id);
        $this->_render_template("course/stream/add_stream", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function delete_stream($id=NULL)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_stream', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('hya_course_stream', 'stream_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully deleted.');
            redirect("course/list_stream");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function update_status_stream()
    {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('hya_course_stream', $post, 'stream_id = ' . $id);
        echo $data['status'];
    }
    
     function list_subject() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'list_subject', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Stream";
            $data['results'] = $this->courseModel->get_subject();
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/subject/list_subject", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function add_subject()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_subject', $this->ion_auth->get_user_id())) {
        
            if($this->input->post('submit')){
              //  print_r($_POST['subject_name']);die;
                $subject=count($_POST['subject_name']);
//                $order=$_POST['order'];
//              $exist=$this->db->query("SELECT * FROM hya_course_subject as s WHERE s.subject_order=$order ")->result();
//                if(count($exist)<= 0){
                for($i=0;$i<$subject;$i++){
                    
                
              $insert = array(
                'subject_name' => $_POST['subject_name'][$i],
                'board_id' => $_POST['board_id'],
                'level_id' => $_POST['level_id'],
                'stream_id' => $_POST['stream_id'],
                'department_id' => $_POST['department_id'],
                'year' => $_POST['year'],
                'semester' => $_POST['semester'],
                'status' => $_POST['status'],
                'subject_order' => $_POST['order'],
                'created_at' => date("Y-m-d H:i:s")
            );
            //print_r($insert);die;
            
            $this->general_db_model->insert('hya_course_subject', $insert);
                }
            //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
            $this->session->set_flashdata('message', 'New Subject successfully created.');
            redirect('course/list_subject');
//            }
//                else{
//                   $this->session->set_flashdata("error_message","Order Number is already Taken");
//                 
//                }
            //    redirect('course/add_level');
            }
        $data['page_title']="Add New Subject";
        $data['boards']=$this->courseModel->get_board();
        $data['levels']=$this->courseModel->get_level();
        $data['streams']=$this->courseModel->get_stream();
        $data['departments']=$this->courseModel->get_department();
        $this->_render_template("course/subject/add_subject", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
        
    }
    function edit_subject($id=NULL)
    {

        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'edit_department', $this->ion_auth->get_user_id())) {
         if($this->input->post('submit')){
            // $order=$_POST['order'];
                
              //$exist=$this->db->query("SELECT * FROM hya_course_subject as s WHERE s.subject_order=$order AND s.subject_id !=$id ")->result();
               // if(count($exist)<= 0){
            $insert = array(
                'subject_name' => $_POST['subject_name'][0],
                'board_id' => $_POST['board_id'],
                'level_id' => $_POST['level_id'],
                'stream_id' => $_POST['stream_id'],
                'department_id' => $_POST['department_id'],
                'year' => $_POST['year'],
                'semester' => $_POST['semester'],
                'status' => $_POST['status'],
                'subject_order' => $_POST['order'],
                'created_at' => date("Y-m-d H:i:s")
            );
            //print_r($insert);die;
            
            $this->general_db_model->update('hya_course_subject', $insert,'subject_id = ' . $id);
            //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
            $this->session->set_flashdata('message', 'Page successfully updated.');
            redirect('course/list_subject');
           // }
               // else{
                  // $this->session->set_flashdata("error_message","Order Number is already Taken");
                 
                //}
            
        }
        $data['page_title']="Edit  Subject";
        $data['boards']=$this->courseModel->get_board();
        $data['levels']=$this->courseModel->get_level();
        $data['streams']=$this->courseModel->get_stream();
        $data['departments']=$this->courseModel->get_department();
       
        $data['details']=$this->general_db_model->getById("hya_course_subject",'subject_id',$id);
        $this->_render_template("course/subject/add_subject", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function delete_subject($id=NULL)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_subject', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('hya_course_subject', 'subject_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully deleted.');
            redirect("course/list_subject");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function update_status_subject()
    {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('hya_course_subject', $post, 'subject_id = ' . $id);
        echo $data['status'];
    }
    
     function list_department() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'list_department', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Stream";
            $data['departments'] = $this->courseModel->get_department();
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/department/list_department", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function add_department()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_department', $this->ion_auth->get_user_id())) {
        
            if($this->input->post('submit')){
                $order=$_POST['order'];
                $exist=$this->general_db_model->value_exist('hya_course_department',"department_order",$order);
                if(!$exist){
                    $insert = array(
                'department_name' => $_POST['department_name'],
                'department_slug' => $_POST['department_slug'],
                'year' => $_POST['year'],
                'semester' => $_POST['semester'],
                'status' => $_POST['status'],
                'department_order' => $_POST['order'],
                'created_at' => date("Y-m-d H:i:s")
            );
                //print_r($insert);die;
                $this->general_db_model->insert('hya_course_department', $insert);
                $this->session->set_flashdata("success_message","New Department is Added");
                }
                else{
                   $this->session->set_flashdata("error_message","Order Number is already Taken");
                 
                }
            //    redirect('course/add_level');
            }
        $data['page_title']="Add New Department";
        $data['board']=$this->courseModel->get_board();
        $this->_render_template("course/department/add_department", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
        
    }
    function edit_department($id=NULL)
    {

        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'edit_department', $this->ion_auth->get_user_id())) {
         if($this->input->post('submit')){
             $order=$_POST['order'];
                
              $exist=$this->db->query("SELECT * FROM hya_course_department as s WHERE s.order=$order AND s.stream_id !=$id ")->result();
                if(count($exist)<= 0){
            $insert = array(
                'department_name' => $_POST['department_name'],
                'department_slug' => $_POST['department_slug'],
                'year' => $_POST['year'],
                'semester' => $_POST['semester'],
                'status' => $_POST['status'],
                'department_order' => $_POST['order'],
                'created_at' => date("Y-m-d H:i:s")
            );
            //print_r($insert);die;
            
            $this->general_db_model->update('hya_course_department', $insert,'department_id = ' . $id);
            //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
            $this->session->set_flashdata('message', 'Page successfully updated.');
            redirect('course/list_department');
            }
                else{
                   $this->session->set_flashdata("error_message","Order Number is already Taken");
                 
                }
            
        }
        $data['page_title']="Add New Department";
        $data['board']=$this->courseModel->get_stream();
        $data['details']=$this->general_db_model->getById("hya_course_department",'department_id',$id);
        $this->_render_template("course/department/add_department", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function delete_department($id=NULL)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_department', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('hya_course_department', 'department_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully deleted.');
            redirect("course/list_stream");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function update_status_department()
    {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('hya_course_department', $post, 'department_id = ' . $id);
        echo $data['status'];
    }
     function list_chapter() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'list_chapter', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Chapter";
            $data['results'] = $this->courseModel->get_chapter();
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/chapter/list_chapter", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function add_chapter()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_chapter', $this->ion_auth->get_user_id())) {
        
            if($this->input->post('submit')){
              //  print_r($_POST['subject_name']);die;
                $subject=count($_POST['chapter_name']);
                for($i=0;$i<$subject;$i++){
                    
                
              $insert = array(
                'chapter_name' => $_POST['chapter_name'][$i],
                'board_id' => $_POST['board_id'],
                'level_id' => $_POST['level_id'],
                'stream_id' => $_POST['stream_id'],
                'department_id' => $_POST['department_id'],
                'subject_id' => $_POST['subject_id'],
                  'year' => $_POST['year'],
                'semester' => $_POST['semester'],
                'status' => $_POST['status'],
                'created_at' => date("Y-m-d H:i:s")
            );
            //print_r($insert);die;
            
            $this->general_db_model->insert('hya_course_chapter', $insert);
                }
            //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
            $this->session->set_flashdata('message', 'New Subject successfully created.');
            redirect('course/list_chapter');
//            }
//                else{
//                   $this->session->set_flashdata("error_message","Order Number is already Taken");
//                 
//                }
            //    redirect('course/add_level');
            }
        $data['page_title']="Add New Chapter";
        $data['boards']=$this->courseModel->get_board();
        $data['levels']=$this->courseModel->get_level();
        $data['streams']=$this->courseModel->get_stream();
        $data['departments']=$this->courseModel->get_department();
        //$data['subjects']=$this->courseModel->get_subject();
        $this->_render_template("course/chapter/add_chapter", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
        
    }
    function edit_chapter($id=NULL)
    {

        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'edit_chapter', $this->ion_auth->get_user_id())) {
         if($this->input->post('submit')){
            // $order=$_POST['order'];
                
              //$exist=$this->db->query("SELECT * FROM hya_course_subject as s WHERE s.subject_order=$order AND s.subject_id !=$id ")->result();
               // if(count($exist)<= 0){
            $insert = array(
                'chapter_name' => $_POST['chapter_name'][0],
                'board_id' => $_POST['board_id'],
                'level_id' => $_POST['level_id'],
                'stream_id' => $_POST['stream_id'],
                'department_id' => $_POST['department_id'],
                'subject_id' => $_POST['subject_id'],
                'year' => $_POST['year'],
                'semester' => $_POST['semester'],
                'status' => $_POST['status'],
                'created_at' => date("Y-m-d H:i:s")
            );
            //print_r($insert);die;
            
            $this->general_db_model->update('hya_course_chapter', $insert,'chapter_id = ' . $id);
            //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
            $this->session->set_flashdata('message', 'Page successfully updated.');
            redirect('course/list_chapter');
           // }
               // else{
                  // $this->session->set_flashdata("error_message","Order Number is already Taken");
                 
                //}
            
        }
        $data['page_title']="Edit  Chapter";
        $data['boards']=$this->courseModel->get_board();
        $data['levels']=$this->courseModel->get_level();
        $data['streams']=$this->courseModel->get_stream();
        $data['departments']=$this->courseModel->get_department();
       
        $data['details']=$this->general_db_model->getById("hya_course_chapter",'chapter_id',$id);
        $this->_render_template("course/chapter/add_chapter", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function delete_chapter($id=NULL)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_chapter', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('hya_course_chapter', 'chapter_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully deleted.');
            redirect("course/list_subject");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function update_status_chapter()
    {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('hya_course_chapter', $post, 'chapter_id = ' . $id);
        echo $data['status'];
    }
    
    function ajaxSelectYear(){
        $departmentId=$_POST['department_id'];
        $row=$this->general_db_model->getById('hya_course_department','department_id',$departmentId);
        $year=$row->year;
        $semester=$row->semester;
        

        $return=array(
          'yearOption'=>$year,
            'semesterOption'=>$semester
        );
        echo  json_encode($return);
    }
    function ajaxSelectSubject(){
        $post=$_POST;
        $where=[];
        foreach($post as $key=>$value){
            $where=$key."=".$value ;
        }
        $where .=" status=1";
        
        $row=$this->db->query('Select * from hya_course_subject where ' .$where)->result();
       
        print_r(json_encode($row)) ;
    }
    function ajaxSelectSubjectFromUnit(){
        $post=$_POST;
        $where=[];
        foreach($post as $key=>$value){
            $where=$key."=".$value ;
        }
        $where .=" status=1";
        
        $subject=$this->db->query('Select * from hya_course_subject where ' .$where)->result();
        $chapter=$this->db->query('Select * from hya_course_chapter where ' .$where)->result();
       $row=array(
           "subject"=>$subject,
           "chapter"=>$chapter
       );
        print_r(json_encode($row)) ;
    }
    function ajaxSelectChapter(){
        $post=$_POST;
        $where=[];
        foreach($post as $key=>$value){
            $where=$key."=".$value ;
        }
        $where .=" status=1";
        
        $row=$this->db->query('Select * from hya_course_chapter where ' .$where)->result();
       
        print_r(json_encode($row)) ;
    }
    
         function list_unit() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'list_unit', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Unit";
            $data['results'] = $this->courseModel->get_unit();
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/unit/list_unit", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function add_unit()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_unit', $this->ion_auth->get_user_id())) {
        
            if($this->input->post('submit')){
              //  print_r($_POST['subject_name']);die;
                $subject=count($_POST['unit_name']);
                for($i=0;$i<$subject;$i++){
                    
                
              $insert = array(
                'unit_name'=>$_POST['unit_name'][$i],
                'chapter_id' => $_POST['chapter_id'],
                'board_id' => $_POST['board_id'],
                'level_id' => $_POST['level_id'],
                'stream_id' => $_POST['stream_id'],
                'department_id' => $_POST['department_id'],
                'subject_id' => $_POST['subject_id'],
                  'year' => $_POST['year'],
                'semester' => $_POST['semester'],
                'status' => $_POST['status'],
                'created_at' => date("Y-m-d H:i:s")
            );
            //print_r($insert);die;
            
            $this->general_db_model->insert('hya_course_unit', $insert);
                }
            //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
            $this->session->set_flashdata('message', 'New Subject successfully created.');
            redirect('course/list_unit');
//            }
//                else{
//                   $this->session->set_flashdata("error_message","Order Number is already Taken");
//                 
//                }
            //    redirect('course/add_level');
            }
        $data['page_title']="Add New Unit";
        $data['boards']=$this->courseModel->get_board();
        $data['levels']=$this->courseModel->get_level();
        $data['streams']=$this->courseModel->get_stream();
        $data['departments']=$this->courseModel->get_department();
        //$data['subjects']=$this->courseModel->get_subject();
        $this->_render_template("course/unit/add_unit", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
        
    }
    function edit_unit($id=NULL)
    {

        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'edit_unit', $this->ion_auth->get_user_id())) {
         if($this->input->post('submit')){
            // $order=$_POST['order'];
                
              //$exist=$this->db->query("SELECT * FROM hya_course_subject as s WHERE s.subject_order=$order AND s.subject_id !=$id ")->result();
               // if(count($exist)<= 0){
            $insert = array(
                'unit_name'=>$_POST['unit_name'][0],
                'chapter_id' => $_POST['chapter_id'],
                
                'board_id' => $_POST['board_id'],
                'level_id' => $_POST['level_id'],
                'stream_id' => $_POST['stream_id'],
                'department_id' => $_POST['department_id'],
                'subject_id' => $_POST['subject_id'],
                'year' => $_POST['year'],
                'semester' => $_POST['semester'],
                'status' => $_POST['status'],
                'created_at' => date("Y-m-d H:i:s")
            );
            //print_r($insert);die;
            
            $this->general_db_model->update('hya_course_unit', $insert,'unit_id = ' . $id);
            //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
            $this->session->set_flashdata('message', 'Page successfully updated.');
            redirect('course/list_unit');
           // }
               // else{
                  // $this->session->set_flashdata("error_message","Order Number is already Taken");
                 
                //}
            
        }
        $data['page_title']="Edit  Unit";
        $data['boards']=$this->courseModel->get_board();
        $data['levels']=$this->courseModel->get_level();
        $data['streams']=$this->courseModel->get_stream();
        $data['departments']=$this->courseModel->get_department();
        //$data['departments']=$this->courseModel->get_department();
       
        $data['details']=$this->general_db_model->getById("hya_course_unit",'unit_id',$id);
        $this->_render_template("course/unit/add_unit", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function delete_unit($id=NULL)
    {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_unit', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('hya_course_unit', 'unit_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully deleted.');
            redirect("course/list_unit");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function update_status_unit()
    {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('hya_course_unit', $post, 'unit_id = ' . $id);
        echo $data['status'];
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
    

}

?>