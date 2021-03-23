<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Course extends MX_Controller {

    public $dbprefixs;

    function __construct() {
        parent::__construct();
        $this->load->model('course_model');
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
        $this->dbprefixs = $this->db->dbprefix;
    }

    public function get_all_methods($class_name = null) {
        return get_class_methods($class_name);
    }

    function board() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'board', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Board";
            $data['boards'] = $this->course_model->get_board();
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
            
            $insert['board_name'] = $board_name = $_POST['board_name'];
            $insert['board_slug'] = $board_slug = $_POST['board_slug'];
            $insert['board_alias'] = $board_alias = $_POST['board_alias'];
            $insert['status'] = $_POST['status'];
            $insert['user_id'] = $this->user_id;
            $insert['created_date'] = time();
            $valueExist = $this->general_db_model->value_existThreeMore('course_board', 'board_name',$board_name,'board_alias',$board_alias);
            if($valueExist == true){
                $this->session->set_flashdata('error_message', 'Board Already Exist.');
            }else{
                $output=$this->general_db_model->insert('course_board', $insert);
                if(!(int)$output)
                    {
                    $response['error']=true;
                    }
                else
                    {
                    $response['error']=false;
                    }
                echo json_encode($response);
            }
            
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function board_edit() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'board_edit', $this->ion_auth->get_user_id())) {
            //print_r($_POST);
            $board_id = $_POST['board_id'];
            
            $update['board_name'] = $board_name = $_POST['board_name'];
            $update['board_slug'] = $board_slug = $_POST['board_slug'];
            $update['board_alias'] = $board_alias = $_POST['board_alias'];
            $update['status'] = $_POST['status'];
            $update['user_id'] = $this->user_id;
            $update['created_date'] = time();
            
            $boardDetails = $this->course_model->get_row('course_board','board_name',$board_name);
            $db_boardName = $boardDetails->board_name;
            
            $valueExist = $this->general_db_model->value_existThreeMore('course_board', 'board_name',$board_name,'board_alias',$board_alias);
            if($valueExist == true){
                if($db_boardName == $board_name){
                    $this->general_db_model->update('course_board', $update, 'board_id = ' . $board_id);
                    echo $_POST['board_name'];
                }else{

                        $this->session->set_flashdata('error_message', 'Board Already Exist.');

                }
            }else{
                    $this->general_db_model->update('course_board', $update, 'board_id = ' . $board_id);
                    echo $_POST['board_name'];
            }
            
            
            
            
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function board_delete($board_id) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'board_delete', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('course_board', 'board_id = ' . $board_id);
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
        $this->general_model->update('course_board', $post, 'board_id = ' . $id);
        echo $data['status'];
    }

    function list_level() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'list_level', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Level";
            $data['levels'] = $this->course_model->get_level();
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/level/list_level", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function add_level() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_level', $this->ion_auth->get_user_id())) {

            if ($this->input->post('submit')) {

                $insert['board_id'] = $board_id = $_POST['board_id'];
                $insert['level_type'] = $level_type = $_POST['level_type'];
                $insert['level_name'] = $level_name = $_POST['level_name'];
                $insert['level_slug'] = $level_slug = $_POST['level_slug'];
                $insert['status'] = $_POST['status'];
                $insert['user_id'] = $this->user_id;
                $insert['order'] = $order = $_POST['order'];
                $insert['created_date'] = date("Y-m-d H:i:s");

                $valueExist = $this->general_db_model->value_existThreeMore('course_level', 'level_name', $level_name, 'board_id', $board_id);
                if ($valueExist == true) {
                    $this->session->set_flashdata('error_message', 'The Board Level Already Exist.');
                    redirect("course/add_level");
                } else {
                    $existOrder = $this->general_db_model->value_exist("course_level", "order", $order);
                    if ($existOrder) {
                        $orders = $this->course_model->allMoreThanOrder('course_level',$order);
                        //print_r($orders);die;
                        foreach ($orders as $o) {
                            $levelId = $o->level_id;
                            $incrementeddOrder = $o->order;
                            $update = array(
                                "order" => $incrementeddOrder + 1
                            );
                            $this->general_db_model->update("course_level", $update, "level_id =" . $levelId);
                        }
                    }
                    $this->general_db_model->insert('course_level', $insert);
                    $this->session->set_flashdata("success_message", "Level Added Successfully");
                    redirect('course/list_level');
                }
            }
            $data['page_title'] = "Add New Level";
            //$data['board']=$this->course_model->get_board();
            $data['order'] = $this->db->query("select l.order from ".$this->dbprefixs."course_level as l order by l.order DESC")->row();
            $data['board'] = $this->course_model->get_results("course_board", 'status', '1', 'board_name');
            $this->_render_template("course/level/add_level", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function edit_level($id = NULL) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'edit_level', $this->ion_auth->get_user_id())) {
//            $level_details = $this->general_db_model->getById("course_level", 'level_id', $id);
//            $db_levelBoardID = $level_details->board_id;
//            $db_levelName = $level_details->level_name;
//            $db_levelORDER = $level_details->order;
            
            $levelDetails = $this->course_model->get_row('course_level', 'level_id', $id);
            $db_levelName = $levelDetails->level_name;
            $db_levelBoardID = $levelDetails->board_id;
            $db_levelORDER = $levelDetails->order;
            
            if ($this->input->post('submit')) {
                $update['board_id'] = $board_id = $this->input->post('board_id'); //$_POST['board_id'];
                $update['level_type'] = $level_type = $this->input->post('level_type');
                $update['level_name'] = $level_name = $this->input->post('level_name');
                $update['level_slug'] = $level_slug = $this->input->post('level_slug');
                $update['status'] = $this->input->post('status');
                $update['user_id'] = $this->user_id;
                $update['order'] = $order = $this->input->post('order');
                $update['created_date'] = date("Y-m-d H:i:s");

                

                $valueExist = $this->general_db_model->value_existNineMore('course_level', 'level_name', $level_name, 'board_id', $board_id);
                if ($valueExist == true) {
                    
                    if ($db_levelName == $level_name && $db_levelBoardID == $board_id) {
                        if ($order != $db_levelORDER) {
                            $existOrder = $this->general_db_model->value_exist("course_level", "order", $order);
                            if ($existOrder) {
                                $orders = $this->course_model->allOrder($order);
                                foreach ($orders as $o) {
                                    $levelId = $o->level_id;
                                    $incrementeddOrder = $o->order;
                                    $update = array(
                                        "order" => $incrementeddOrder + 1
                                    );
                                    if ($id != $levelId) {
                                        $this->general_db_model->update("course_level", $update, "level_id =" . $levelId);
                                    }
                                }
                            }
                        }
                        //$this->general_db_model->update('course_level', $update, 'level_id = ' . $id);
                        $this->session->set_flashdata('message', 'Level successfully updated.');
                        redirect('course/list_level');
                    } else {

                        $this->session->set_flashdata('error_message', 'Level Already Exist.');
                        redirect('course/list_level');
                    }
                } else {
                    if ($order != $db_levelORDER) {
                        $existOrder = $this->general_db_model->value_exist("course_level", "order", $order);
                        if ($existOrder) {
                            $orders = $this->course_model->allOrder($order);
                            foreach ($orders as $o) {
                                $levelId = $o->level_id;
                                $incrementeddOrder = $o->order;
                                $update = array(
                                    "order" => $incrementeddOrder + 1
                                );
                                if ($id != $levelId) {
                                    $this->general_db_model->update("course_level", $update, "level_id =" . $levelId);
                                }
                            }
                        }
                    }
                    $this->general_db_model->update('course_level', $update, 'level_id = ' . $id);
                    $this->session->set_flashdata('message', 'Level successfully updated.');
                    redirect('course/list_level');
                }
            }
            $data['page_title'] = "Add New Level";
            //$data['board']=$this->course_model->get_board();
            $data['board'] = $this->course_model->get_results("course_board", 'status', '1', 'board_name');
            $data['details'] = $this->general_db_model->getById("course_level", 'level_id', $id);
            $this->_render_template("course/level/add_level", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function delete_level($id = NULL) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_level', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('course_level', 'level_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully deleted.');
            redirect("course/list_level");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function update_status_level() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('course_level', $post, 'level_id = ' . $id);
        echo $data['status'];
    }

    function list_stream() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'list_stream', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Stream";
            //$data['streams'] = $this->course_model->get_stream();
            $dbPrefix = $this->dbprefixs;
            $data['streams'] = $this->course_model->getJoinResult("*",$dbPrefix."course_stream as cs",$dbPrefix."course_level as cl","cs.level_id = cl.level_id",'','','','','',"cl.order ASC");
            //$data['streams'] = $this->general_db_model->get_join_result("*", "hya_data_question AS q", "hya_course_board cb", "q.board_id = cb.board_id", "hya_course_level cl", "q.level_id = cl.level_id", "cl.level_slug LIKE '%$level_slug%' ");
//            echo "<pre>";
//            print_r($data['streams']);die();
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/stream/list_stream", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function add_stream() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_stream', $this->ion_auth->get_user_id())) {

            if ($this->input->post('submit')) {
                $insert['level_id'] = $level_id = $this->input->post('level_id'); //$_POST['board_id'];
                $insert['stream_name'] = $stream_name = $this->input->post('stream_name');
                $insert['stream_slug'] = $stream_slug = $this->input->post('stream_slug');
                $insert['status'] = $status = $this->input->post('status');
                $insert['year'] = $this->input->post('year');
                $insert['semester'] = $this->input->post('semester');
                $insert['user_id'] = $this->user_id;
                $insert['created_date'] = date("Y-m-d H:i:s");



                $valueExist = $this->general_db_model->value_existNineMore('course_stream', 'stream_name', $stream_name, 'level_id', $level_id);
                if ($valueExist == true) {
                    $this->session->set_flashdata("error_message", "Duplicate Entry For Stream With Same Level");
                    redirect("course/add_stream");
                } else {
                    $this->general_db_model->insert('course_stream', $insert);
                    $this->session->set_flashdata("success_message", "New Stream is Added");

                    redirect('course/list_stream');
                }
                
            }
            $data['page_title'] = "Add New Stream";
            $data['level'] = $this->course_model->get_results("course_level", 'status', '1', 'level_name');
            $this->_render_template("course/stream/add_stream", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function edit_stream($stream_id = NULL) {

        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'edit_stream', $this->ion_auth->get_user_id())) {
            $data['details'] = $details = $this->general_db_model->getById("course_stream", 'stream_id', $stream_id);
            $db_streamName = $details->stream_name;
            $db_streamLevelID = $details->level_id;
            if ($this->input->post('submit')) {
//                $order = $_POST['order'];
                $dbPrefix = $this->dbprefixs;

                $update['level_id'] = $level_id = $this->input->post('level_id'); //$_POST['board_id'];
                $update['stream_name'] = $stream_name = $this->input->post('stream_name');
                $update['stream_slug'] = $stream_slug = $this->input->post('stream_slug');
                $update['status'] = $this->input->post('status');
                $update['year'] = $this->input->post('year');
                $update['semester'] = $this->input->post('semester');
                $update['user_id'] = $this->user_id;
                $update['created_date'] = date("Y-m-d H:i:s");
                
                $valueExist = $this->general_db_model->value_existNineMore('course_stream', 'stream_name', $stream_name, 'level_id', $level_id);
                if ($valueExist == true) {
                    
                    if ($db_streamName == $stream_name && $db_streamLevelID == $level_id) {
                        $this->general_db_model->update('course_stream', $update, 'stream_id = ' . $stream_id);
                        $this->session->set_flashdata('message', 'Page successfully updated.');
                        redirect('course/list_stream'); 
                    }else{
                        $this->session->set_flashdata('error_message', 'Stream Already Exist.');
                        redirect('course/list_stream');
                    }
                }else{
                    $this->general_db_model->update('course_stream', $update, 'stream_id = ' . $stream_id);
                    $this->session->set_flashdata('message', 'Page successfully updated.');
                    redirect('course/list_stream'); 
                }
                
                    $this->general_db_model->update('course_stream', $update, 'stream_id = ' . $stream_id);
                    //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $stream_id);
                    $this->session->set_flashdata('message', 'Page successfully updated.');
                    redirect('course/list_stream');

            }
            $data['page_title'] = "Add New Stream";
            $data['level'] = $this->course_model->get_results("course_level", 'status', '1', 'level_name');
            
            $this->_render_template("course/stream/add_stream", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function delete_stream($id = NULL) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_stream', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('course_stream', 'stream_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Stream successfully deleted.');
            redirect("course/list_stream");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function update_status_stream() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('course_stream', $post, 'stream_id = ' . $id);
        echo $data['status'];
    }

    function list_course() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'list_department', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Course";
            //$data['courses'] = $this->course_model->get_course();
            $dbPrefix = $this->dbprefixs;
            $data['courses'] = $this->course_model->getJoinResult("*",$dbPrefix."course_course as cc",$dbPrefix."course_board as cb","cc.board_id = cb.board_id",$dbPrefix."course_level as cl","cc.level_id = cl.level_id",$dbPrefix."course_stream as cs","cc.stream_id = cs.stream_id",'',"cl.order ASC");
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/course/list_course", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function add_course() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_department', $this->ion_auth->get_user_id())) {

            if ($this->input->post('submit')) {
                $course_name = $_POST['course_name'];
                 $level_id = $_POST['level_id'];
                 $level_detail = $this->general_db_model->getById("course_level", 'level_id', $level_id);
                 $board_id = $level_detail->board_id;
                  $stream_id = $_POST['stream_id'];
                  //$exist=$this->general_db_model->value_existDepartment("hya_course_course","course_name",$course_name,"level_id",$_POST['level_id'],'stream_id',$stream_id);
                  
                  $valueExist = $this->general_db_model->value_existNineMore('course_course', 'course_name',$course_name, 'level_id',$_POST['level_id'], 'stream_id',$stream_id);
                    if($valueExist == true){
                        $data['exist'][$i+1] = "Already Exist";
                        $this->session->set_flashdata('error_message', "$course_name Already Exist.");
                        redirect('course/add_course');
                    }else{
                        $insert = array(
                            'board_id' => $board_id,
                            'level_id' => $_POST['level_id'],
                            'stream_id' => $_POST['stream_id'],
                            'course_name' => $course_name,
                            'course_slug' => $_POST['course_slug'],
                            'course_alias' => $_POST['course_alias'],
                            'year' => $_POST['year'],
                            'semester' => $_POST['semester'],
                            'status' => $_POST['status'],
                            'user_id' => $this->user_id,
                            'created_at' => date("Y-m-d H:i:s")
                        );
                        //print_r($insert);die;
                        $this->general_db_model->insert('course_course', $insert);
                        $this->session->set_flashdata("success_message", "$course_name is Added");
                        redirect('course/list_course');
                        
                    }
                  
                    
            }
            $data['page_title'] = "Add New Course";
            //$data['board']=$this->course_model->get_board();
            $data['level'] = $this->course_model->get_results("course_level", 'status', '1', 'level_name');
            $data['stream'] = $this->course_model->get_results("course_stream", 'status', '1', 'stream_name');
            $this->_render_template("course/course/add_course", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function edit_course($id = NULL) {

        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'edit_department', $this->ion_auth->get_user_id())) {
            if ($this->input->post('submit')) {
                $dbPrefix = $this->dbprefixs;
                $update['level_id'] = $level_id = $this->input->post('level_id'); //$_POST['board_id'];
                
                $level_detail = $this->general_db_model->getById("course_level", 'level_id', $level_id);
                    $board_id = $level_detail->board_id;
                
                $course_detail = $this->general_db_model->getById("course_course", 'course_id', $id);
                    $db_courseName = $course_detail->course_name;
                    $db_courseBoardID = $course_detail->board_id;
                    $db_courseLevelID = $course_detail->level_id;
                    $db_courseStreamID = $course_detail->stream_id;
                $update['board_id'] = $board_id;
                $update['stream_id'] = $stream_id = $this->input->post('stream_id');
                
                $update['course_name'] = $course_name = $this->input->post('course_name');
                $update['course_slug'] = $course_slug = $this->input->post('course_slug');
                $update['course_alias'] = $course_alias = $this->input->post('course_alias');
                $update['year'] = $this->input->post('year');
                $update['semester'] = $this->input->post('semester');
                $update['status'] = $this->input->post('status');
                $update['user_id'] = $this->user_id;
                $update['created_at'] = date("Y-m-d H:i:s");
                
                $valueExist = $this->general_db_model->value_existNineMore('course_stream', 'stream_name', $stream_name, 'level_id', $level_id);
                if ($valueExist == true) {
                    
                    if ($db_courseName == $course_name && $db_courseBoardID == $board_id && $db_courseLevelID == $level_id && $db_courseStreamID == $stream_id) {
                        $this->general_db_model->update('course_course', $update, 'course_id = ' . $id);
                        //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
                        $this->session->set_flashdata('message', 'Page successfully updated.');
                        redirect('course/list_course');
                    }else{
                       $data['exist'][$i+1] = "Already Exist";
                    $this->session->set_flashdata('error_message', "$course_name Already Exist.");
                    redirect("course/edit_course/$id"); 
                    }
                }else{
                    $this->general_db_model->update('course_course', $update, 'course_id = ' . $id);
                    //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
                    $this->session->set_flashdata('message', 'Page successfully updated.');
                    redirect('course/list_course');
                }
                
                
                
                
//                    $course_name = $_POST['course_name'];
//                    $level_id = $_POST['level_id'];
//                    $level_detail = $this->general_db_model->getById("course_level", 'level_id', $level_id);
//                    $board_id = $level_detail->board_id;
//                    $stream_id = $_POST['stream_id'];
//                    
//                    $valueExist = $this->general_db_model->value_existNineMore('course_course', 'course_name',$course_name, 'level_id',$_POST['level_id'], 'stream_id',$stream_id);
//                    if($valueExist == true){
//                        $data['exist'][$i+1] = "Already Exist";
//                        $this->session->set_flashdata('error_message', "$course_name Already Exist.");
//                        redirect("course/edit_course/$id");
//                    }else{
//                        
//                        $this->general_db_model->update('course_course', $update, 'course_id = ' . $id);
//                        //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
//                        $this->session->set_flashdata('message', 'Page successfully updated.');
//                        redirect('course/list_course');
//                        //print_r($insert);die;
//                    }

            }
            $data['page_title'] = "Edit  Course";
            //$data['board']=$this->course_model->get_stream();
            $data['details'] = $details = $this->general_db_model->getById("course_course", 'course_id', $id);
            $levelID = $details->level_id;
            $streamID = $details->stream_id;
            $data['level'] = $this->course_model->get_results("course_level", 'status', '1', 'level_name');
            $data['stream'] = $this->course_model->get_results("course_stream", 'status', '1','stream_name');
            
            $this->_render_template("course/course/add_course", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function delete_course($id = NULL) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_department', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('course_course', 'course_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully deleted.');
            redirect("course/list_course");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function update_status_course() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('course_course', $post, 'course_id = ' . $id);
        echo $data['status'];
    }
    
    function list_department() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'list_department', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Department";
            //$data['departments'] = $this->course_model->get_department();
            $dbPrefix = $this->dbprefixs;
            //$data['departments'] = $this->course_model->getJoinResult("*",$dbPrefix."course_department as cd",$dbPrefix."course_level as cl","cd.level_id = cl.level_id",'','','','','',"cl.order ASC");
            $data['departments'] = $this->course_model->getJoinResult("*",$dbPrefix."course_department as cd",$dbPrefix."course_level as cl","cd.level_id = cl.level_id",$dbPrefix."course_stream as cs","cd.stream_id = cs.stream_id",$dbPrefix."course_course as cc","cd.course_id = cc.course_id");
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/department/list_department", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function add_department() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_department', $this->ion_auth->get_user_id())) {

            if ($this->input->post('submit')) {
                $department_name = $_POST['department_name'];
                 $level_id = $_POST['level_id'];
                  $stream_id = $_POST['stream_id'];
                  $exist=$this->general_db_model->value_existDepartment("hya_course_department","department_name",$department_name,"level_id",$_POST['level_id'],'stream_id',$stream_id);
          
               // $exist = $this->db->query("SELECT * FROM hya_course_department WHERE department_name=$department_name AND level_id=$level_id AND stream_id=$stream_id")->results();
                //echo $exist;die;
                 if (!$exist) {
                    $insert = array(
                        'level_id' => $_POST['level_id'],
                        'stream_id' => $_POST['stream_id'],
                        'department_name' => $_POST['department_name'],
                        'department_slug' => $_POST['department_slug'],
                        'course_id' => $_POST['course_id'],
                        'status' => $_POST['status'],
                        'user_id' => $this->user_id,
                        'created_at' => date("Y-m-d H:i:s")
                    );
                    //print_r($insert);die;
                    $this->general_db_model->insert('course_department', $insert);
                    $this->session->set_flashdata("success_message", "New Department is Added");
                    redirect('course/list_department');
                } else {
                    $this->session->set_flashdata("error_message", "Duplicate Entry For  Department Name ");
                    redirect('course/add_department');
                }
                    
            }
            $data['page_title'] = "Add New Department";
            //$data['board']=$this->course_model->get_board();
            $data['level'] = $this->course_model->get_results("course_level", 'status', '1', 'level_name');
            $data['stream'] = $this->course_model->get_results("course_stream", 'status', '1', 'stream_name');
            $data['course'] = $this->course_model->get_results("course_course", 'status', '1', 'course_name');
            $this->_render_template("course/department/add_department", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function edit_department($id = NULL) {

        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'edit_department', $this->ion_auth->get_user_id())) {
            if ($this->input->post('submit')) {
                $dbPrefix = $this->dbprefixs;
//                $exist = $this->db->query("SELECT * FROM " . $dbPrefix . "course_department as s WHERE s.department_order=$order AND s.stream_id =$id ")->result();
//                if (count($exist) <= 0) {
                    $insert = array(
                        'level_id' => $_POST['level_id'],
                        'stream_id' => $_POST['stream_id'],
                        'course_id' => $_POST['course_id'],
                        'department_name' => $_POST['department_name'],
                        'department_slug' => $_POST['department_slug'],
                       
                        'status' => $_POST['status'],
                        'user_id' => $this->user_id,
                        'department_order' => $_POST['order'],
                        'created_at' => date("Y-m-d H:i:s")
                    );
                    //print_r($insert);die;

                    $this->general_db_model->update('course_department', $insert, 'department_id = ' . $id);
                    //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
                    $this->session->set_flashdata('message', 'Page successfully updated.');
                    redirect('course/list_department');
//                } else {
//                    $this->session->set_flashdata("error_message", "Order Number is already Taken");
//                }
            }
            $data['page_title'] = "Add New Department";
            //$data['board']=$this->course_model->get_stream();
            $data['details'] = $details = $this->general_db_model->getById("course_department", 'department_id', $id);
            $courseID=$details->course_id;
            $levelID = $details->level_id;
            $streamID = $details->stream_id;
            $data['level'] = $this->course_model->get_results("course_level", 'status', '1', 'level_name');
            $data['stream'] = $this->course_model->get_results("course_stream", 'status', '1','stream_name');
            $data['course'] = $this->course_model->get_results("course_course", 'status', '1', 'course_name');
            
            
            $this->_render_template("course/department/add_department", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function delete_department($id = NULL) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_department', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('course_department', 'department_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully deleted.');
            redirect("course/list_department");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function update_status_department() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('course_department', $post, 'department_id = ' . $id);
        echo $data['status'];
    }

     

    
    function list_subject() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'list_subject', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Stream";
            //$data['results'] = $this->course_model->get_subject();
            //$data['results'] = $this->course_model->get_results("course_subject", 'status', '1','subject_name');
            $dbPrefix = $this->dbprefixs;
            $data['results'] = $this->course_model->getJoinResult("*",$dbPrefix."course_subject as cs",$dbPrefix."course_level as cl","cs.level_id = cl.level_id",'','','','','',"cl.order ASC");
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/subject/list_subject", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function add_subject() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_subject', $this->ion_auth->get_user_id())) {

            if ($this->input->post('submit')) {
                $subject_name = $_POST['subject_name'];
                $level_id = $_POST['level_id'];
                $department_id = $_POST['department_id'];
                $stream_id = $_POST['stream_id'];
                
                    $insert['board_id'] = $board_id = $this->input->post('board_id');
                    $insert['level_id'] = $level_id = $this->input->post('level_id');
                    $insert['stream_id'] = $stream_id = $this->input->post('stream_id');
                    $insert['course_id'] = $course_id = $this->input->post('course_id');
                    $insert['department_id'] = $department_id = $this->input->post('department_id');
                    $insert['year'] = $year = $this->input->post('year');
                    $insert['semester'] = $semester = $this->input->post('semester');
                    
                    $sessionData = array( 'subject_board_id'=>$board_id,
                                        'subject_level_id'=>$level_id,
                                        'subject_stream_id'=>$stream_id,
                                        'subject_course_id'=>$course_id,
                                        'subject_department_id'=>$department_id,
                                        'subject_year'=>$year,
                                        'subject_semester'=>$semester
                    );
                    $this->session->set_userdata($sessionData);
//                $exist=$this->general_db_model->value_existSubject("hya_course_subject","subject_name",$subject_name,"department_id",$_POST['department_id'],"level_id",$_POST['level_id'],'stream_id',$stream_id);
//          
//               // $exist = $this->db->query("SELECT * FROM hya_course_department WHERE department_name=$subject_name AND level_id=$level_id AND stream_id=$stream_id")->results();
//                //echo $exist;die;
//                 if (!$exist) {
                $subject = count($_POST['subject_name']);
//                $order=$_POST['order'];
//              $exist=$this->db->query("SELECT * FROM course_subject as s WHERE s.subject_order=$order ")->result();
//                if(count($exist)<= 0){
                for ($i = 0; $i < $subject; $i++) {

                    $insert['subject_name'] = $subject_name = $_POST['subject_name'][$i];
                    
                    $insert['status'] = $status = $this->input->post('status');
                    $insert['user_id'] = $this->user_id;
                    $insert['created_at'] = date("Y-m-d H:i:s");
                    //print_r($insert);die;
                    $valueExist = $this->general_db_model->value_existNineMore('course_subject', 'subject_name',$subject_name, 'board_id',$board_id, 'level_id',$level_id, 'stream_id',$stream_id, 'department_id',$department_id, 'year',$year);
                    if($valueExist == true){
                        $data['exist'][$i+1] = "Already Exist";
                        $this->session->set_flashdata('error_message', "$subject_name Already Exist.");
                    }else{
                        $this->general_db_model->insert('course_subject', $insert);
                        $this->session->set_flashdata('message', "$subject_name successfully created.");
                    }
                    
                }
                
                
                //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
                
                redirect('course/list_subject');
//                }
//                else{
//                   $this->session->set_flashdata("error_message","Duplicate Entry For Subject");
//                   redirect('course/add_subject');
//                 
//                }
            //}
        
                
                //    
            }
            $data['page_title'] = "Add New Subject";
            //$data['boards'] = $this->course_model->get_board();
            $data['boards'] = $this->course_model->get_results("course_board", 'status', '1', 'board_name');
            $data['levels'] = $this->course_model->get_results("course_level", 'status', '1', 'level_name');
            $data['streams'] = $this->course_model->get_results("course_stream", 'status', '1', 'stream_name');
            $data['courses'] = $this->course_model->get_results("course_course", 'status', '1', 'course_name');
            $data['departments'] = $this->course_model->get_results("course_department", 'status', '1', 'department_name');
            $this->_render_template("course/subject/add_subject", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function edit_subject($id = NULL) {

        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'edit_subject', $this->ion_auth->get_user_id())) {
            if ($this->input->post('submit')) {
                // $order=$_POST['order'];
                //$exist=$this->db->query("SELECT * FROM course_subject as s WHERE s.subject_order=$order AND s.subject_id !=$id ")->result();
                // if(count($exist)<= 0){
//                $insert = array(
//                    'subject_name' => $_POST['subject_name'][0],
//                    'board_id' => $_POST['board_id'],
//                    'level_id' => $_POST['level_id'],
//                    'stream_id' => $_POST['stream_id'],
//                    'course_id' => $_POST['course_id'],
//                    'department_id' => $_POST['department_id'],
//                    'year' => $_POST['year'],
//                    'semester' => $_POST['semester'],
//                    'status' => $_POST['status'],
//                    //'subject_order' => $_POST['order'],
//                    'user_id' => $this->user_id,
//                    'created_at' => date("Y-m-d H:i:s")
//                );
                $subject = count($_POST['subject_name']);

                for ($i = 0; $i < $subject; $i++) {
                    $update['subject_name'] = $subject_name = $_POST['subject_name'][$i];
                    $update['board_id'] = $board_id = $this->input->post('board_id');
                    $update['level_id'] = $level_id = $this->input->post('level_id');
                    $update['stream_id'] = $stream_id = $this->input->post('stream_id');
                    $update['course_id'] = $course_id = $this->input->post('course_id');
                    $update['department_id'] = $department_id = $this->input->post('department_id');
                    $update['year'] = $year = $this->input->post('year');
                    $update['semester'] = $semester = $this->input->post('semester');
                    $update['status'] = $status = $this->input->post('status');
                    $update['user_id'] = $this->user_id;
                    $update['created_at'] = date("Y-m-d H:i:s"); 
                
                
                $this->general_db_model->update('course_subject', $update, 'subject_id ='.$id);
                }
                //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
                $this->session->set_flashdata('message', 'Subject successfully updated.');
                redirect('course/list_subject');
                // }
                // else{
                // $this->session->set_flashdata("error_message","Order Number is already Taken");
                //}
            }
            $data['page_title'] = "Edit  Subject";
            $data['boards'] = $this->course_model->get_results("course_board", 'status', '1', 'board_name');
            $data['levels'] = $this->course_model->get_results("course_level", 'status', '1', 'level_name');
            $data['streams'] = $this->course_model->get_results("course_stream", 'status', '1', 'stream_name');
            $data['courses'] = $this->course_model->get_results("course_course", 'status', '1', 'course_name');
            $data['departments'] = $this->course_model->get_results("course_department", 'status', '1', 'department_name');

            $data['details'] = $this->general_db_model->getById("course_subject", 'subject_id', $id);
            $this->_render_template("course/subject/add_subject", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function delete_subject($id = NULL) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_subject', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('course_subject', 'subject_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully deleted.');
            redirect("course/list_subject");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    
    function update_status_subject() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('course_subject', $post, 'subject_id = ' . $id);
        echo $data['status'];
    }
    
    function reset_add_subject() {
        $sessionData = array( 'subject_board_id'=>'',
                                    'subject_level_id'=>'',
                                    'subject_stream_id'=>'',
                                    'subject_course_id'=>'',
                                    'subject_department_id'=>'',
                                    'subject_year'=>'',
                                    'subject_semester'=>'',
//'subject_subject_id'=>'',
//'subject_chapter_id'=>'',
//'subject_unit_id'=>'',
//'subject_subunit_id'=>'',
//'s_question_set'=>'',
//'s_question_tag'=>'',
//'s_appeared_year'=>'',
//'s_question_type'=>'',
//'s_question'=>'',
//'s_mark'=>''
                        );

        $this->session->unset_userdata($sessionData);
        //$this->session->sess_destroy();
        redirect('course/add_subject');
    }
    
    function list_chapter() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'list_chapter', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Chapter";
            //$data['results'] = $this->course_model->get_chapter();
            $dbPrefix = $this->dbprefixs;
            $data['results'] = $this->course_model->getJoinResult("*",$dbPrefix."course_chapter as cc",$dbPrefix."course_level as cl","cc.level_id = cl.level_id",'','','','','',"cl.order ASC");
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/chapter/list_chapter", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function get_data() {
        $table_name = $this->input->get('table_name');
        $board_id = $this->input->get('board_id');
        $level_id = $this->input->get('level_id');
        $stream_id = $this->input->get('stream_id');
        $course_id = $this->input->get('course_id');
        $department_id = $this->input->get('department_id');
        $year = $this->input->get('year');
$result = $this->course_model->get_resultsNINE($table_name,'board_id',$board_id,'level_id',$level_id,'stream_id',$stream_id,'course_id',$course_id,'department_id',$department_id,'year',$year);

foreach($result as $subject){
                $subject_idd = $subject->subject_id;
                $subject_name = $subject->subject_name;
                
    echo "<option value='$subject_idd'> $subject_name</option>";
}
//        if ($status == 'Active') {
//            $data['status'] = 'Inactive';
//            $post['active'] = '0';
//        } else {
//            $data['status'] = 'Active';
//            $post['active'] = '1';
//        }
//        $this->general_model->update('users', $post, 'user_id = ' . $id);
        $data['subjects'] = $result;
        //echo $data['status'];
    }
    
    function add_chapter() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_chapter', $this->ion_auth->get_user_id())) {

            if ($this->input->post('submit')) {
                //  print_r($_POST['subject_name']);die;
                $chapter = count($_POST['chapter_name']);
                $chapter_name = $_POST['chapter_name'];
                $level_id = $_POST['level_id'];
                $stream_id = $_POST['stream_id'];
                $department_id = $_POST['department_id'];
                $subject_id = $_POST['subject_id'];
                 // $exist=$this->general_db_model->value_existChapter("hya_course_chapter","chapter_name",$chapter_name,"department_id",$_POST['department_id'],"level_id",$_POST['level_id'],'stream_id',$stream_id,'subject_id',$subject_id);
                $insert['board_id'] = $board_id = $this->input->post('board_id');
                $insert['level_id'] = $level_id = $this->input->post('level_id');
                $insert['stream_id'] = $stream_id = $this->input->post('stream_id');
                $insert['course_id'] = $course_id = $this->input->post('course_id');
                $insert['department_id'] = $department_id = $this->input->post('department_id');
                $insert['subject_id'] = $subject_id = $this->input->post('subject_id');
                $insert['year'] = $year = $this->input->post('year');
                $insert['semester'] = $semester = $this->input->post('semester');
                
                $sessionData = array( 'chapter_board_id'=>$board_id,
                                    'chapter_level_id'=>$level_id,
                                    'chapter_stream_id'=>$stream_id,
                                    'chapter_course_id'=>$course_id,
                                    'chapter_department_id'=>$department_id,
                                    'chapter_year'=>$year,
                                    'chapter_semester'=>$semester,
                                    'chapter_subject_id'=>$subject_id
                );
                $this->session->set_userdata($sessionData);
               // $exist = $this->db->query("SELECT * FROM hya_course_department WHERE department_name=$department_name AND level_id=$level_id AND stream_id=$stream_id")->results();
                //echo $exist;die;
                //if (!$exist) {
                    for ($i = 0; $i < $chapter; $i++) {
//                        $insert = array(
//                            'chapter_name' => $_POST['chapter_name'][$i],
//                            'board_id' => $_POST['board_id'],
//                            'level_id' => $_POST['level_id'],
//                            'stream_id' => $_POST['stream_id'],
//                            'department_id' => $_POST['department_id'],
//                            'subject_id' => $_POST['subject_id'],
//                            'year' => $_POST['year'],
//                            'semester' => $_POST['semester'],
//                            'status' => $_POST['status'],
//                            'user_id' => $this->user_id,
//                            'created_at' => date("Y-m-d H:i:s")
//                        );
//                        //print_r($insert);die;
//
//                        $this->general_db_model->insert('course_chapter', $insert);
//                    }
//                    //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
//                    $this->session->set_flashdata('message', 'New Subject successfully created.');
//                    redirect('course/list_chapter');
                    
                    
                    
                    
                    $insert['chapter_name'] = $chapter_name = $_POST['chapter_name'][$i];
                    $insert['status'] = $status = $this->input->post('status');
                    $insert['user_id'] = $this->user_id;
                    $insert['created_at'] = date("Y-m-d H:i:s");
                    //print_r($insert);die;
                    $valueExist = $this->general_db_model->value_existNineMore('course_chapter', 'chapter_name',$chapter_name, 'board_id',$board_id, 'level_id',$level_id, 'stream_id',$stream_id, 'department_id',$department_id,'subject_id',$subject_id);
                    if($valueExist == true){
                        $data['exist'][$i+1] = "Already Exist";
                        $this->session->set_flashdata('error_message', "$chapter_name Already Exist.");
                    }else{
                        $this->general_db_model->insert('course_chapter', $insert);
                        $this->session->set_flashdata('message', "$chapter_name successfully created.");
                    }
                }
                redirect('course/list_chapter');
                //}
//            }
//                else{
//                   $this->session->set_flashdata("error_message","Duplicate Entry For Subject Name");
//                   redirect('course/add_chapter');
//                 
//                }
                    
            }
            $data['page_title'] = "Add New Chapter";
            $data['boards'] = $this->course_model->get_results("course_board", 'status', '1', 'board_name');
            $data['levels'] = $this->course_model->get_results("course_level", 'status', '1', 'level_name');
            $data['streams'] = $this->course_model->get_results("course_stream", 'status', '1', 'stream_name');
            $data['courses'] = $this->course_model->get_results("course_course", 'status', '1', 'course_name');
            $data['departments'] = $this->course_model->get_results("course_department", 'status', '1', 'department_name');
            $data['subjects'] = $this->course_model->get_results("course_subject", 'status', '1', 'subject_name');
            //$data['subjects']=$this->course_model->get_subject();
            $this->_render_template("course/chapter/add_chapter", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function edit_chapter($id = NULL) {

        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'edit_chapter', $this->ion_auth->get_user_id())) {
            if ($this->input->post('submit')) {
                // $order=$_POST['order'];
                //$exist=$this->db->query("SELECT * FROM course_subject as s WHERE s.subject_order=$order AND s.subject_id !=$id ")->result();
                // if(count($exist)<= 0){
                $insert = array(
                    'chapter_name' => $_POST['chapter_name'][0],
                    'board_id' => $_POST['board_id'],
                    'level_id' => $_POST['level_id'],
                    'stream_id' => $_POST['stream_id'],
                    'course_id' => $_POST['course_id'],
                    'department_id' => $_POST['department_id'],
                    'subject_id' => $_POST['subject_id'],
                    'year' => $_POST['year'],
                    'semester' => $_POST['semester'],
                    'status' => $_POST['status'],
                    'user_id' => $this->user_id,
                    'created_at' => date("Y-m-d H:i:s")
                );
                //print_r($insert);die;

                $this->general_db_model->update('course_chapter', $insert, 'chapter_id = ' . $id);
                //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
                $this->session->set_flashdata('message', 'Page successfully updated.');
                redirect('course/list_chapter');
                // }
                // else{
                // $this->session->set_flashdata("error_message","Order Number is already Taken");
                //}
            }
            $data['page_title'] = "Edit  Chapter";
            $data['boards'] = $this->course_model->get_results("course_board", 'status', '1', 'board_name');
            $data['levels'] = $this->course_model->get_results("course_level", 'status', '1', 'level_name');
            $data['streams'] = $this->course_model->get_results("course_stream", 'status', '1', 'stream_name');
            $data['courses'] = $this->course_model->get_results("course_course", 'status', '1', 'course_name');
            $data['departments'] = $this->course_model->get_results("course_department", 'status', '1', 'department_name');
            $data['subjects'] = $this->course_model->get_results("course_subject", 'status', '1', 'subject_name');

            $data['details'] = $this->general_db_model->getById("course_chapter", 'chapter_id', $id);
            $this->_render_template("course/chapter/add_chapter", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function delete_chapter($id = NULL) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_chapter', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete('course_chapter', 'chapter_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Chapter successfully deleted.');
            redirect("course/list_chapter");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function update_status_chapter() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('course_chapter', $post, 'chapter_id = ' . $id);
        echo $data['status'];
    }
    
    function reset_add_chapter() {
        $sessionData = array( 'chapter_board_id'=>'',
                                    'chapter_level_id'=>'',
                                    'chapter_stream_id'=>'',
                                    'chapter_course_id'=>'',
                                    'chapter_department_id'=>'',
                                    'chapter_year'=>'',
                                    'chapter_semester'=>'',
                                    'chapter_subject_id'=>'',
//                                    'chapter_chapter_id'=>'',
//                                    'chapter_unit_id'=>'',
//                                    'chapter_subunit_id'=>'',
//                                    'chapter_question_set'=>'',
//                                    'chapter_question_tag'=>'',
//                                    'chapter_appeared_year'=>'',
//                                    'chapter_question_type'=>'',
//                                    'chapter_question'=>'',
//                                    'chapter_mark'=>''
                        );

        $this->session->unset_userdata($sessionData);
        //$this->session->sess_destroy();
        redirect('course/add_chapter');
    }

    
    function ajaxSelectYear() {
        $levelId = @$_POST['level_id'];
            if(!empty($levelId)){
                $row = $this->general_db_model->getById('course_stream', 'level_id', $levelId);
                $year = $row->year;
                $semester = $row->semester;
            }
        $streamId = @$_POST['stream_id'];
            if(!empty($streamId)){
                $row = $this->general_db_model->getById('course_stream', 'stream_id', $streamId);
                $year = $row->year;
                $semester = $row->semester;
            }
        $courseId = @$_POST['course_id'];
            if(!empty($courseId)){
                $row = $this->general_db_model->getById('course_course', 'course_id', $courseId);
                $year = $row->year;
                $semester = $row->semester;
            }

        $return = array(
            'yearOption' => $year,
            'semesterOption' => $semester
        );
        echo json_encode($return);
    }

//    function ajaxLevelSelectYear() {
//        $levelId = $_POST['level_id'];
//        $rowStream = $this->general_db_model->getById('course_stream', 'level_id', $levelId);
//        $year = $rowStream->year;
//        $courseId = $_POST['course_id'];
//        $row = $this->general_db_model->getById('course_course', 'course_id', $courseId);
//        $year = $row->year;
//        $semester = $row->semester;
//
//
//        $return = array(
//            'yearOption' => $year,
//            'semesterOption' => $semester
//        );
//        echo json_encode($return);
//    }
    function delete_ajax_subunit() {
        $sunit_id = $this->input->post('sunit_id');
        $this->general_db_model->deleteWhere('course_subunit', 'subunit_id', $sunit_id);
        //$this->templates_model->delete('users_question_option', 'q_id', $qid);
        $this->session->set_flashdata('message', 'Subunit successfully deleted.');
    }
    function ajaxSelectSubject() {
        $post = $_POST;
        $where = [];
        foreach ($post as $key => $value) {
            $where = $key . "=" . $value;
        }
        $where .=" status=1";
        $dbPrefix = $this->dbprefixs;
        $row = $this->db->query("Select * from " . $dbPrefix . "course_subject where " . $where)->result();

        print_r(json_encode($row));
    }

    function ajaxSelectSubjectFromUnit() {
        $post = $_POST;
        $where = [];
        foreach ($post as $key => $value) {
            $where = $key . "=" . $value;
        }
        $where .=" status=1";
        $dbPrefix = $this->dbprefixs;
        $subject = $this->db->query('Select * from ' . $dbPrefix . 'course_subject where ' . $where)->result();
        $chapter = $this->db->query('Select * from ' . $dbPrefix . 'course_chapter where ' . $where)->result();
        $row = array(
            "subject" => $subject,
            "chapter" => $chapter
        );
        print_r(json_encode($row));
    }

    function ajaxSelectChapter() {
        $post = $_POST;
        $where = [];
        foreach ($post as $key => $value) {
            $where = $key . "=" . $value;
        }
        $where .=" status=1";
        $dbPrefix = $this->dbprefixs;
        $row = $this->db->query('Select * from ' . $dbPrefix . 'course_chapter where ' . $where)->result();

        print_r(json_encode($row));
    }

    function list_unit() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'list_unit', $this->ion_auth->get_user_id())) {
            $data['page_title'] = "Course Management-Unit";
            //$data['results'] = $this->course_model->get_unit();
            $dbPrefix = $this->dbprefixs;
            $data['results'] = $this->course_model->getJoinResult("*",$dbPrefix."course_unit as cu",$dbPrefix."course_level as cl","cu.level_id = cl.level_id",'','','','','',"cl.order ASC");
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/unit/list_unit", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
   function view_subunit($id=NULL){
       $data['page_title'] = "Course Management-Sub Unit";
            $data['results'] = $this->course_model->get_subunit($id);
//            $data['current'] = 2;
//            $data['sub_current'] = 1;
            $this->_render_template("course/unit/subunit_list", $data);
   }
   function add_unit() {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'add_unit', $this->ion_auth->get_user_id())) {

            if ($this->input->post('submit')) {

                $insert['board_id'] = $board_id = $this->input->post('board_id');
                $insert['level_id'] = $level_id = $this->input->post('level_id');
                $insert['stream_id'] = $stream_id = $this->input->post('stream_id');
                $insert['course_id'] = $course_id = $this->input->post('course_id');
                $insert['department_id'] = $department_id = $this->input->post('department_id');
                $insert['subject_id'] = $subject_id = $this->input->post('subject_id');
                $insert['chapter_id'] = $chapter_id = $this->input->post('chapter_id');
                $insert['year'] = $year = $this->input->post('year');
                $insert['semester'] = $semester = $this->input->post('semester');
                
                $sessionData = array( 'unit_board_id'=>$board_id,
                                    'unit_level_id'=>$level_id,
                                    'unit_stream_id'=>$stream_id,
                                    'unit_course_id'=>$course_id,
                                    'unit_department_id'=>$department_id,
                                    'unit_year'=>$year,
                                    'unit_semester'=>$semester,
                                    'unit_subject_id'=>$subject_id,
                                    'unit_chapter_id'=>$chapter_id
                );
                $this->session->set_userdata($sessionData);
                $unitName = count($_POST['unit_name']);
                for ($i = 0; $i < $unitName; $i++) {
                    $insert['unit_name'] = $_POST['unit_name'][$i];
                    $insert['year'] = $year = $this->input->post('year');
                    $insert['semester'] = $semester = $this->input->post('semester');
                    $insert['status'] = $semester = $this->input->post('status');
                    $insert['user_id'] = $this->user_id;
                    $insert['created_at'] = date("Y-m-d H:i:s");
                    
//                    $insert = array(
//                        'unit_name' => $_POST['unit_name'][$i],
//                        
//                        'chapter_id' => $_POST['chapter_id'],
//                        'year' => $_POST['year'],
//                        'semester' => $_POST['semester'],
//                        'status' => $_POST['status'],
//                        'user_id' => $this->user_id,
//                        'created_at' => date("Y-m-d H:i:s")
//                    );
                    //print_r($insert);die;

                    $lastUnitId = $this->general_db_model->insert('course_unit', $insert);


                    $countSubunit = count($_POST["subunit_name"]);
                    $arrayIndex = array_keys($_POST["subunit_name"]);
                    // print_r($arrayIndex);
                    if (in_array($i, $arrayIndex)) {
                        // echo $i;die;
                        //  $round=0;
                        // print_r($_POST["subunit_name"][$i]);die();
                        $subunt = $_POST["subunit_name"][$i];
                        //print_r(count($subunt));die;
                        //foreach($subunt as $s){
                        // if($round <=$countSubunit){
                        for ($j = 0; $j < count($subunt); $j++) {
                            // echo $subunt[$j];
                            $insert1 = array(
                                "unit_id" => $lastUnitId,
                                "subunit_name" => $_POST["subunit_name"][$i][$j],
                                "status" => $_POST['status'],
                                "user_id" => $this->user_id,
                                "created_at" => date("Y-m-d H:i:s")
                            );

                            $this->general_db_model->insert('course_subunit', $insert1);
                        }
                        // }
                        //$round++;
                    }
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
            $data['page_title'] = "Add New Unit";
            
            $data['boards'] = $this->course_model->get_results("course_board", 'status', '1', 'board_name');
            $data['levels'] = $this->course_model->get_results("course_level", 'status', '1', 'level_name');
            $data['streams'] = $this->course_model->get_results("course_stream", 'status', '1', 'stream_name');
            $data['courses'] = $this->course_model->get_results("course_course", 'status', '1', 'course_name');
            $data['departments'] = $this->course_model->get_results("course_department", 'status', '1', 'department_name');
            $data['subjects'] = $this->course_model->get_results("course_subject", 'status', '1', 'subject_name');
            $data['chapters'] = $this->course_model->get_results("course_chapter", 'status', '1', 'chapter_name');
            //$data['subjects']=$this->course_model->get_subject();
            $this->_render_template("course/unit/add_unit", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function edit_unit($id = NULL) {
        error_reporting(E_ALL);
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'edit_unit', $this->ion_auth->get_user_id())) {
            if ($this->input->post('submit')) {
                // $order=$_POST['order'];
                //$exist=$this->db->query("SELECT * FROM course_subject as s WHERE s.subject_order=$order AND s.subject_id !=$id ")->result();
                // if(count($exist)<= 0){
                $insert = array(
                    'unit_name' => $_POST['unit_name'][0],
                    'board_id' => $_POST['board_id'],
                    'level_id' => $_POST['level_id'],
                    'stream_id' => $_POST['stream_id'],
                    'course_id' => $_POST['course_id'],
                    'department_id' => $_POST['department_id'],
                    'subject_id' => $_POST['subject_id'],
                    'chapter_id' => $_POST['chapter_id'],
                    'year' => $_POST['year'],
                    'semester' => $_POST['semester'],
                    'status' => $_POST['status'],
                    'user_id' => $this->user_id,
                    'created_at' => date("Y-m-d H:i:s")
                );
                if (!empty($_POST['subunit_name'][0])) {
//                    echo "<pre>";
//                    print_r($_POST['subunit_name'][0]);die;
                    $this->general_db_model->delete("hya_course_subunit", 'unit_id =' . $id);
                    // foreach($_POST['subunit_name'][0] as $sub){
                    for ($j = 0; $j < count($_POST['subunit_name'][0]); $j++) {
                        $insert1 = array(
                            'unit_id' => $id,
                            "subunit_name" => $_POST['subunit_name'][0][$j],
                            'status' => $_POST['status'],
                            'user_id' => $this->user_id,
                            'created_at' => date("Y-m-d H:i:s")
                        );

                        $this->general_db_model->insert('course_subunit', $insert1);
                    }
                }
                //print_r($insert);die;

                $this->general_db_model->update('course_unit', $insert, 'unit_id = ' . $id);
                //$this->general_db_model->update('permissions', $post, 'stream_id = ' . $id);
                $this->session->set_flashdata('message', 'Page successfully updated.');
                redirect('course/list_unit');
                // }
                // else{
                // $this->session->set_flashdata("error_message","Order Number is already Taken");
                //}
            }
            $data['page_title'] = "Edit  Unit";
            $data['boards'] = $this->course_model->get_results("course_board", 'status', '1', 'board_name');
            $data['levels'] = $this->course_model->get_results("course_level", 'status', '1', 'level_name');
            $data['streams'] = $this->course_model->get_results("course_stream", 'status', '1', 'stream_name');
            $data['courses'] = $this->course_model->get_results("course_course", 'status', '1', 'course_name');
            $data['departments'] = $this->course_model->get_results("course_department", 'status', '1', 'department_name');
            $data['subjects'] = $this->course_model->get_results("course_subject", 'status', '1', 'subject_name');
            $data['chapters'] = $this->course_model->get_results("course_chapter", 'status', '1', 'chapter_name');

            $data['details'] = $unitDETAILS = $this->general_db_model->getById("course_unit", 'unit_id', $id);
            $data['subunits'] = $this->general_db_model->get_results("course_subunit", 'unit_id', $id);
//            echo '<pre>';
//            print_r($data['details']);
//            print_r($data['subunits']);die;
            $this->_render_template("course/unit/add_unit", $data);
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }

    function delete_unit($id = NULL) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_unit', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete("hya_course_subunit",'unit_id =' .$id);
                   
            $this->general_db_model->delete('course_unit', 'unit_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully deleted.');
            redirect("course/list_unit");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    function delete_subunit($unitId,$id = NULL) {
        if (!$this->ion_auth->logged_in()) {
            redirect("signin/login", 'refresh');
        } else if ($this->ion_auth->has_permission("course/course", 'delete_subunit', $this->ion_auth->get_user_id())) {
            $this->general_db_model->delete("hya_course_subunit",'subunit_id =' .$id);
                   
             $this->session->set_flashdata('display_message', 'Page successfully deleted.');
            redirect("course/view_subunit/$unitId");
        } else {
            return show_error('You Dont have permission to view this page.');
        }
    }
    
    function update_status_unit() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('course_unit', $post, 'unit_id = ' . $id);
        echo $data['status'];
    }
    function update_status_subunit() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        if ($status == 'Active') {
            $data['status'] = 'Inactive';
            $post['status'] = '0';
        } else {
            $data['status'] = 'Active';
            $post['status'] = '1';
        }
        $this->general_model->update('course_subunit', $post, 'subunit_id = ' . $id);
        echo $data['status'];
    }
    
    function reset_add_unit() {
        $sessionData = array( 'unit_board_id'=>'',
                                    'unit_level_id'=>'',
                                    'unit_stream_id'=>'',
                                    'unit_course_id'=>'',
                                    'unit_department_id'=>'',
                                    'unit_year'=>'',
                                    'unit_semester'=>'',
                                    'unit_subject_id'=>'',
                                    'unit_chapter_id'=>'',
//                                    'unit_unit_id'=>'',
//                                    'unit_subunit_id'=>'',
//                                    'unit_question_set'=>'',
//                                    'unit_question_tag'=>'',
//                                    'unit_appeared_year'=>'',
//                                    'unit_question_type'=>'',
//                                    'unit_question'=>'',
//                                    'chapter_mark'=>''
                        );

        $this->session->unset_userdata($sessionData);
        //$this->session->sess_destroy();
        redirect('course/add_chapter');
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