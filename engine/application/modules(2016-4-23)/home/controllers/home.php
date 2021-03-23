<?php
class Home extends MX_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('home_model');
        $this->load->library('email');
        $this->load->model('general_model');
        
    }

    function index() {
        
        $data['page_title'] = 'Home';
        $data['page'] = $this->home_model->get_By_id("static_pages", "page_slug", "home");
        $data['home_slider'] = $this->home_model->get_slides('slides', '', '', 'order');
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
        $this->template->load('template_front', 'index', $data);
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

}

?>