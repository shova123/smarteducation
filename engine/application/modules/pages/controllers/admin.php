<?php
class Admin extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('pages_model');
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    function page_list() {
//        if (!$this->ion_auth->logged_in()) {
//            redirect('signin/login', 'refresh');
//        } else if ($this->ion_auth->has_permission("pages/admin", 'page_list', $this->ion_auth->get_user_id())) {
            $data['page_title'] = 'Pages';
            //echo $query=$this->db->last_query(); exit;
            $data['pages'] = $this->pages_model->get_Allpage('static_pages', 'status', 'Publish');

            $data['current'] = 10;
            $data['sub_current'] = 1;;

            $this->template->load('template', 'page_list', $data);
//        } else {
//            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
//            redirect("signin/login", 'refresh');
//        }
    }

    function contents($link = null) {

//        if (!$this->ion_auth->logged_in()) {
//            redirect('signin/login', 'refresh');
//        } else if ($this->ion_auth->has_permission("pages/admin", 'contents', $this->ion_auth->get_user_id())) {

            $data['page_title'] = ucfirst($link);

            //echo $query=$this->db->last_query(); exit;
            $data['pages'] = $this->pages_model->get_Allpage('static_pages', 'status', 'Publish', 'link', "$link");
            $data['link'] = $link;
            if ($link == 'content') {
                $data['current'] = 7;
            } else {
                $data['current'] = 8;
            }


            $this->template->load('template', 'page_list', $data);
//        } else {
//            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
//            redirect("signin/login", 'refresh');
//        }
    }

    function add_page($link = null) {
//        if (!$this->ion_auth->logged_in()) {
//            redirect('signin/login', 'refresh');
//        } else if ($this->ion_auth->has_permission("pages/admin", 'add_page', $this->ion_auth->get_user_id())) {
        
            if ($this->input->post('submitDetail')) {

                $this->add_edit();
                die();
            }

            $data['page_title'] = 'Add Page';
            $data['link'] = $link;
            $data['current'] = 7;
            $data['all_pages'] = $this->pages_model->get_Allpage("static_pages", "page_type", "content");
            $this->template->load('template', 'page_form', @$data);
//        } else {
//            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
//            redirect("signin/login", 'refresh');
//        }
    }

    function edit_page($id, $link = null) {
//        if (!$this->ion_auth->logged_in()) {
//            redirect('signin/login', 'refresh');
//        } else if ($this->ion_auth->has_permission("pages/admin", 'edit_page', $this->ion_auth->get_user_id())) {
            if ($this->input->post('submitDetail')) {
                $this->add_edit($id);
                die();
            }
            $data['details'] = $this->general_db_model->getById('static_pages', 'page_id', $id);
            //print_r($data['details']);
            $data['page_title'] = 'Edit Page';
            $data['link'] = $link;
            $data['current'] = 7;
            $data['all_pages'] = $this->pages_model->get_Allpage("static_pages", "page_type", "content");
            $this->template->load('template', 'page_form', @$data);
//        } else {
//            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
//            redirect("signin/login", 'refresh');
//        }
    }

    function add_edit($id = NULL) {
        //$not = array('submitDetail', 'fileList');
        //$post = $this->mylibrary->get_post_array($not);
        $post['page_type'] = $this->input->post('page_type');
        $post['page_name'] = $this->input->post('page_name');
        $post['page_title'] = $this->input->post('page_title');
        $post['page_slug'] = $this->input->post('page_slug');
        
        $post['html_title'] = $this->input->post('html_title');
        $post['html_keyword'] = $this->input->post('html_keyword');
        $post['html_describe'] = $this->input->post('html_describe');
        
        $post['content'] = $this->input->post('content');
        
        $post['order'] = $this->input->post('order');
        $post['status'] = $this->input->post('status');
        
        $post['home_image'] = $this->input->post('home_image');
            $home_image = $this->input->post('fileList');
        $post['home_image'] = $home_image;
        
        $link = $this->input->post('link');
        
        $display_type = $this->input->post('display_type');
            $display = '';
            foreach ($display_type as $disp) {
                $display = $display . $disp . "||";
            }
            $total_display = trim($display, "||");
        $post['display_type'] = $total_display;
        $post['price'] = $this->input->post('price');
        $youtube_link = $this->input->post('youtube_link'); //cleint upload http://www.youtube.com/watch?v=abhBw-IBLJo
        if(!empty($youtube_link)){
            if (strpos($youtube_link, 'watch')) {
                $video = explode('?', $youtube_link); //explode after ? $video[0] = http://www.youtube.com/watch $video[1]=   v=abhBw-IBLJo
                $string = $video[1]; //$video[1]=   v=abhBw-IBLJo
                $strlength = strlen($string); //finding $video[1] length
                $video_id = substr($string, 2, $strlength); // cutting main name from v=abhBw-IBLJo  to  abhBw-IBLJo
                $post['video_id'] = $video_id;
                $post['youtube_link'] = "www.youtube.com/embed/$video_id?feature=player_detailpage";
            }
            if (strpos($youtube_link, 'embed')) {
                $videoEmbed = explode('/', $youtube_link); //explode after / $video[0] = http://www.youtube.com/watch $video[1]=   v=abhBw-IBLJo
                $beforeVideoID = $videoEmbed[2]; 
                $videoEmbedAfter = explode('?', $beforeVideoID);
                $video_id = $videoEmbedAfter[0];
                $post['video_id'] = $video_id;
                $post['youtube_link'] = $youtube_link;
            }
        }
        //dumparray($post);
        if ($id) {
            $this->general_db_model->update('static_pages', $post, 'page_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully updated.');
        } else {
            $this->general_db_model->insert('static_pages', $post);
            $this->session->set_flashdata('display_message', 'Page successfully added.');
        }
        redirect("admin/pages/page_list");
    }

    function delete_page($id) {
//        if (!$this->ion_auth->logged_in()) {
//            redirect('signin/login', 'refresh');
//        } else if ($this->ion_auth->has_permission("pages/admin", 'delete_page', $this->ion_auth->get_user_id())) {
        
        $this->general_db_model->delete('static_pages', 'page_id = ' . $id);
        $this->session->set_flashdata('display_message', 'Page successfully deleted.');
        redirect(admin_url('pages/page_list'));
//        } else {
//            $this->session->set_flashdata('error_message', 'You Dont have permission to view this page.');
//            redirect("signin/login", 'refresh');
//        }
    }

    function delete_image() {
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'banners/' . $img; //echo $imgpath; exit;
        
        if (@file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

    function update_status() {
        $id = $this->input->get('page_id');
        $status = $this->input->get('status');
        //echo $status; die();
        if ($status == 'Publish')
            $data['status'] = 'Unpublish';
        else
            $data['status'] = 'Publish';
        $this->general_db_model->update('static_pages', $data, 'page_id = ' . $id);

        echo $data['status'];
    }

    //=================================== subpages start
    function subpages() {

        $data['page_title'] = 'Pages';
        //echo $query=$this->db->last_query(); exit;
        $data['pages'] = $this->pages_model->get_Allpage('static_subpages', 'status', 'Publish');

        $data['current'] = 7;

        $this->template->load('template', 'subpage_list', $data);
        //$this->load->view('listing_pages',$data);
    }

    function subpages_add($link = null) {
        if ($this->input->post('submitDetail')) {

            $this->subpages_add_edit();
            die();
        }

        $data['page_title'] = 'Add Page';
        $data['link'] = $link;
        $data['current'] = 7;

        $this->template->load('template', 'subpage_form', @$data);
    }

    function subpages_edit($id, $link = null) {
        if ($this->input->post('submitDetail')) {
            $this->subpages_add_edit($id);
            die();
        }
        $data['details'] = $this->general_db_model->getById('static_subpages', 'subpage_id', $id);
        //print_r($data['details']);
        $data['page_title'] = 'Edit Page';
        $data['link'] = $link;
        $data['current'] = 7;
        $this->template->load('template', 'subpage_form', @$data);
    }

    function subpages_add_edit($id = NULL) {
        $not = array('submitDetail', 'fileList');

        $post = $this->mylibrary->get_post_array($not);
        $home_image = $this->input->post('fileList');
        $post['home_image'] = $home_image;
        $link = $this->input->post('link');
        $display_type = $this->input->post('display_type');
        $display = '';
        foreach ($display_type as $disp) {
            $display = $display . $disp . "||";
        }
        $total_display = trim($display, "||");
        $post['display_type'] = $total_display;
        //dumparray($post);
        if ($id) {
            $this->general_db_model->update('static_subpages', $post, 'subpage_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully updated.');
        } else {
            $this->general_db_model->insert('static_subpages', $post);
            $this->session->set_flashdata('display_message', 'Page successfully added.');
        }
        redirect("admin/pages");
    }

    function subpages_delete($id) {
        $this->general_db_model->delete('static_subpages', 'subpage_id = ' . $id);
        $this->session->set_flashdata('display_message', 'Page successfully deleted.');
        redirect(admin_url('pages'));
    }

    function subpages_delete_image() {
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'banners/' . $img; //echo $imgpath; exit;
        if (@file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

    function subpages_update_status() {
        $id = $this->input->get('page_id');
        $status = $this->input->get('status');
        //echo $status; die();
        if ($status == 'Publish')
            $data['status'] = 'Unpublish';
        else
            $data['status'] = 'Publish';
        $this->general_db_model->update('static_subpages', $data, 'page_id = ' . $id);

        echo $data['status'];
    }

   //================================ user profile start
   function profile() {
        $data['page_title'] = "Profile List";
        //echo $query=$this->db->last_query(); exit;
        $data['profile'] = $this->pages_model->get_Allpage('profile');
        $data['current'] = 8;
        $data['sub_current'] = 1; 
    $this->template->load('template', 'profile_list', $data);
    }
    function profile_add() {
        if ($this->input->post('submitDetail')) {
            $this->profile_add_edit();
            die();
        }
        $data['page_title'] = 'Add Profile';
        $data['current'] = 7;
        $data['profile'] = $this->pages_model->get_Allpage("profile");
        $this->template->load('template', 'profile_form', @$data);
    }

    function profile_edit($id) {
        if ($this->input->post('submitDetail')) {
            $this->profile_add_edit($id);
            die();
        }
        $data['details'] = $this->general_db_model->getById('profile', 'profile_id', $id);
        $data['page_title'] = 'Edit Profile';
        $data['current'] = 7;
        $this->template->load('template', 'profile_form', @$data);
    }

    function profile_add_edit($id = NULL) {
        $not = array('submitDetail', 'fileList');
        $post = $this->mylibrary->get_post_array($not);
        if ($id) {
            $this->general_db_model->update('profile', $post, 'profile_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully updated.');
        } else {
            $this->general_db_model->insert('profile', $post);
            $this->session->set_flashdata('display_message', 'Page successfully added.');
        }
        redirect("admin/pages/profile");
    }

    function profile_delete($id) {
        $this->general_db_model->delete('profile', 'profile_id = ' . $id);
        $this->session->set_flashdata('display_message', 'Page successfully deleted.');
       redirect("admin/pages/profile");
    }

    function profile_update_status() {
        $id = $this->input->get('page_id');
        $status = $this->input->get('status');
        if ($status == 'Publish')
            $data['status'] = 'Unpublish';
        else
            $data['status'] = 'Publish';
        $this->general_db_model->update('profile', $data, 'profile_id = ' . $id);

        echo $data['status'];
    }
   //================================ user profile end

    //================================ testimonial start
    function testimonial() {

        $data['page_title'] = "Testimonial";

        $data['pages'] = $this->pages_model->get_Allpage('testimonials', 'status', 'Publish');
        
//        if ($link == 'content') {
//            $data['current'] = 7;
//        } else {
//            $data['current'] = 8;
//        }
        $data['current'] = 13;
        //$data['sub_current'] = 2;

        $this->template->load('template', 'testimonial_list', $data);
    }

    function add_testimonial() {
        if ($this->input->post('submitDetail')) {

            $this->add_edit_testimonial();
            die();
        }

        $data['page_title'] = 'Add Testimonial';
        $data['current'] = 13;
        //$data['sub_current'] = 2;
        //$data['all_pages'] = $this->pages_model->get_Allpage("testimonials", "page_type", "content");
        $this->template->load('template', 'testimonial_form', @$data);
    }

    function edit_testimonial($id) {
        if ($this->input->post('submitDetail')) {
            $this->add_edit_testimonial($id);
            die();
        }
        $data['details'] = $this->general_db_model->getById('testimonials', 'testimonial_id', $id);
        //print_r($data['details']);
        $data['page_title'] = 'Edit Testimonial';
        
        $data['current'] = 13;
        //$data['sub_current'] = 2;
        //$data['all_pages'] = $this->pages_model->get_Allpage("testimonials", "page_type", "content");
        $this->template->load('template', 'testimonial_form', @$data);
    }

    function add_edit_testimonial($id = NULL) {
        //$not = array('submitDetail', 'fileList');
        //$post = $this->mylibrary->get_post_array($not);
        $post['author_title'] = $this->input->post('author_title');
        $post['author_slug'] = $this->input->post('author_slug');
        $post['content'] = $this->input->post('content');
        
        $post['order'] = $this->input->post('order');
        $post['status'] = $this->input->post('status');
        
        $post['home_image'] = $this->input->post('home_image');
            $home_image = $this->input->post('fileList');
        $post['home_image'] = $home_image;
        
        
        //dumparray($post);
        if ($id) {
            $this->general_db_model->update('testimonials', $post, 'testimonial_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully updated.');
        } else {
            $this->general_db_model->insert('testimonials', $post);
            $this->session->set_flashdata('display_message', 'Page successfully added.');
        }
        redirect("admin/pages/testimonial");
    }

    function delete_testimonial($id) {
        $this->general_db_model->delete('testimonials', 'testimonial_id = ' . $id);
        $this->session->set_flashdata('display_message', 'Page successfully deleted.');
        redirect("admin/pages/testimonial");
    }

    function delete_testimonial_image() {
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'testimonials/' . $img; //echo $imgpath; exit;
        if (@file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

    function update_testimonial_status() {
        $id = $this->input->get('id');
        $status = $this->input->get('status');
        //echo $status; die();
        if ($status == 'Publish')
            $data['status'] = 'Unpublish';
        else
            $data['status'] = 'Publish';
        $this->general_db_model->update('testimonials', $data, 'testimonial_id = ' . $id);

        echo $data['status'];
    }
    //================================ testimonial end
    
    function our_team() {
        $data['page_title'] = 'Our Team Management';
        $data['our_team'] = $this->pages_model->get_category("our_team", "link", "portfolio");

        $data['current'] = 8;
        $data['dropsub'] = 2;
        $this->template->load('template', 'our_team_list', $data);
    }

    function our_team_add() {
        if ($this->input->post('submitDetail')) {

            $this->add_edit_our_team();
            die();
        }

        $data['page_title'] = 'Add Category';
        $data['link'] = "portfolio";
        $data['current'] = 8;
        $data['dropsub'] = 2;
        $data['dropdown_list'] = $this->pages_model->get_category("about_dropdown", "link", "portfolio");
        $this->template->load('template', 'our_team_form', @$data);
    }

    function our_team_edit($id) {
        if ($this->input->post('submitDetail')) {
            $this->add_edit_our_team($id);
            die();
        }
        $data['details'] = $this->general_db_model->getById('our_team', 'page_id', $id);
        $data['dropdown_list'] = $this->pages_model->get_category("about_dropdown", "link", "portfolio");
        $data['page_title'] = "Edit Category";
        $data['current'] = 8;
        $data['dropsub'] = 2;
        $this->template->load('template', 'our_team_form', @$data);
    }

    function add_edit_our_team($id = NULL) {
//			$not = array('submitDetail','fileList');
//			$post = $this->mylibrary->get_post_array($not);

        $post['link'] = "portfolio";

        $post['dropdown_id'] = $this->input->post('dropdown_id');
        $post['name'] = $this->input->post('name');
        $post['designation'] = $this->input->post('designation');
        $post['email'] = $this->input->post('email');
        $post['phone'] = $this->input->post('phone');
        //$post['html_describe'] = $this->input->post('html_describe');
        $post['contents'] = $this->input->post('contents');
        $post['order'] = $this->input->post('order');
        $post['status'] = $this->input->post('status');
        $post['home_image'] = $this->input->post('home_image');

        $home_image = $this->input->post('fileList');

        $post['home_image'] = $home_image;

        //$redirectName = $this->input->post('redirectName');
        //dumparray($post);
        if ($id) {
            $this->general_db_model->update('our_team', $post, 'page_id = ' . $id);
            $this->session->set_flashdata('display_message', 'Page successfully updated.');
        } else {
            $this->general_db_model->insert('our_team', $post);
            $this->session->set_flashdata('display_message', 'Page successfully added.');
        }
        redirect("admin/pages/our_team");
        // $this->template->load('template','about_form', @$data);
    }

    function our_team_delete($id) {
        $this->general_db_model->delete('our_team', 'page_id = ' . $id);
//                        $this->general_db_model->delete('region', 'category_id = '.$id);
//                        $this->general_db_model->delete('package', 'category_id = '.$id);
        $this->session->set_flashdata('display_message', 'Category successfully deleted.');
        redirect("admin/pages/our_team");
    }

    function delete_our_team_image() {
        $img = $this->input->post('imgName');
        $imgpath = $this->config->item('uploads') . 'our_team/' . $img; //echo $imgpath; exit;
        if (@file_exists($imgpath)) {
            unlink($imgpath);
            echo 'Image successfully deleted!';
        } else {
            echo 'File does not exist!';
        }
    }

    
}

?>