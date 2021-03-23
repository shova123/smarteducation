<?php
ob_start();
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Linkedin_signup extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->config->load('linkedin');
        $this->data['consumer_key'] = $this->config->item('api_key');
        $this->data['consumer_secret'] = $this->config->item('secret_key');
        $this->data['callback_url'] = site_url() . 'linkedin_signup/data/';
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('language'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));
        $this->lang->load('auth');
    }

    function index() {
        echo '<form id="linkedin_connect_form" action="linkedin_signup/initiate" method="post">';
        echo '<input type="submit" value="Login with LinkedIn" />';
        echo '</form>';
    }

    function initiate() {
        // setup before redirecting to Linkedin for authentication.
        $linkedin_config = array(
            'appKey' => $this->data['consumer_key'],
            'appSecret' => $this->data['consumer_secret'],
            'callbackUrl' => $this->data['callback_url']
        );
        $this->load->library('linkedin', $linkedin_config);
        $this->linkedin->setResponseFormat(LINKEDIN::_RESPONSE_JSON);
        $token = $this->linkedin->retrieveTokenRequest();
        $this->session->set_flashdata('oauth_request_token_secret', $token['linkedin']['oauth_token_secret']);
        $this->session->set_flashdata('oauth_request_token', $token['linkedin']['oauth_token']);
        //$link = "https://api.linkedin.com/uas/oauth/authorize?oauth_token=" . $token['linkedin']['oauth_token'];
        $link = "https://www.linkedin.com/uas/oauth/authorize?oauth_token=". $token['linkedin']['oauth_token'];
        redirect($link);
    }

    function cancel() {
        // See https://developer.linkedin.com/documents/authentication
        // You need to set the 'OAuth Cancel Redirect URL' parameter to <your URL>/linkedin_signup/cancel
        echo 'Linkedin user cancelled login';
    }

    function logout() {
        session_unset();
        $_SESSION = array();
        echo "Logout successful";
        redirect("signin/login");
    }

    function data() {
        $linkedin_config = array(
            'appKey' => $this->data['consumer_key'],
            'appSecret' => $this->data['consumer_secret'],
            'callbackUrl' => $this->data['callback_url']
        );
        $this->load->library('linkedin', $linkedin_config);
        $this->linkedin->setResponseFormat(LINKEDIN::_RESPONSE_JSON);
        $oauth_token = $this->session->flashdata('oauth_request_token');
        $oauth_token_secret = $this->session->flashdata('oauth_request_token_secret');
        $oauth_verifier = $this->input->get('oauth_verifier');
        $response = $this->linkedin->retrieveTokenAccess($oauth_token, $oauth_token_secret, $oauth_verifier);
        // ok if we are good then proceed to retrieve the data from Linkedin
        if ($response['success'] === TRUE) {
            // From this part onward it is up to you on how you want to store/manipulate the data 
            $oauth_expires_in = $response['linkedin']['oauth_expires_in'];
            $oauth_authorization_expires_in = $response['linkedin']['oauth_authorization_expires_in'];
            $response = $this->linkedin->setTokenAccess($response['linkedin']);
            $profile = $this->linkedin->profile('~:(id,first-name,last-name,picture-url,email-address)');
            $profile_connections = $this->linkedin->profile('~/connections:(id,first-name,last-name,picture-url,industry)');
            $user = json_decode($profile['linkedin']);
            $user_array = array('linkedin_id' => $user->id,'email_address' => $user->emailAddress,'second_name' => $user->lastName,'profile_picture' => $user->pictureUrl,'first_name' => $user->firstName);
                $this->db->select("*");
                $this->db->like("group_type",'user');
                $this->db->like("name",'student');
                $queryGroup = $this->db->get("groups");
                $resultGroup = $queryGroup->row();
                if(!empty($resultGroup)){
                    $group_id[]= $resultGroup->group_id;
                }
//                echo "<pre>";
//                print_r($resultGroup);die;
            $groupData = @$group_id;
            $user_token = md5(uniqid(mt_rand(), True));
            $linkedinID = $user_array['linkedin_id'];
            $first_name = $user_array['first_name'];
            $second_name = $user_array['second_name'];
            $username= strtolower($first_name)."_".strtolower($second_name);
            $password='';
            $email = $user_array['email_address'];
            $image_url = $user_array['profile_picture'];
            $filename = @substr($image_url, strrpos($image_url, '/') + 1);
            $encrypt = @md5('unique_salt' . time());
            $image_name = $encrypt . "_" . $first_name . ".jpg";
            $main_root = $this->config->item('main_root');
            //$image_path = "./uploads/profile/$image_name";
            $image_path = $main_root.'uploads/profile/'.$image_name; 
            /* Extract and upload the Image*/
                $get_image = file_get_contents($image_url);
                file_put_contents($image_path, $get_image);
            /* Extract and upload the Image*/
            $email_exist = $this->general_db_model->value_exist("users","email",$email);
            if($email_exist == true){
                $additional_data = array(
                   'user_token' => $user_token,
                   'first_name' => $first_name,
                   'last_name' => $second_name,
                   'home_image' =>$image_name,
                   'linkedin_id' => $linkedinID,
                   'last_update' => date("Y-m-d"),
                );
                $user_details = $this->general_db_model->get_row("users","email",$email);
                $user_id = $user_details['user_id'];
                $user_group_details = $this->general_db_model->get_join_row("*","hya_users u","hya_users_groups ug","u.user_id=ug.user_id","hya_groups g","ug.group_id=g.group_id","u.user_id='$user_id'");
                $exist_image = $user_group_details->home_image;//$user_group_details['home_image'];
                $exist_linkedinID = $user_group_details->linkedin_id;
                $exist_image_path = $main_root."uploads/profile/$exist_image";
                $groupTypeDashboardName = $user_group_details->group_type;
//                if($groupTypeDashboardName == "company"){
//                    $var = "Company";$tryTo = "Candidate";
//                    $this->session->set_flashdata('error_message', "Account already member in $var.Please try with different Linkedin Account");//You are trying to log in as a $tryTo. Please switch to $var Login Tab.
                //redirect('signin/login');
//                }elseif($groupTypeDashboardName == "users"){
                    //$var = "Candidate";$tryTo = "Company";
                    if($exist_linkedinID == $linkedinID){// already logged /register as candidate (users) through linkedin
//                        if ($this->ion_auth->update($user_id, $additional_data)) {
//                            if (file_exists($exist_image_path)) {
//                                unlink($exist_image_path);
//                            }
//                        }
                        $this->session->set_flashdata('error_message', "Account already member in Student.Please try with different Linkedin Account");
                    }else{
                        $this->session->set_flashdata('error_message', "Account already member in Student Through system.Please try with different Linkedin Account");//You are trying to log in as a $tryTo. Please switch to $var Login Tab.
                    //redirect('signin/login');
                    }
                    /*
                     * For login into system
                     * 
                     * 
                    if ($this->ion_auth->linked_login($email)) {
                        $this->session->set_flashdata('success_message', $this->ion_auth->messages());
                        redirect('signin', 'refresh');
                    }
                    * 
                    */
//                }
            //redirect("signin/login", 'refresh');
            }else{
                $additional_data = array(
                    'user_token' => $user_token,
                    'first_name' => $first_name,
                    'last_name' => $second_name,
                    'home_image' =>$image_name,
                    'active' => '0',
                    'linkedin_id' => $linkedinID,
                    'created_on' => date("Y-m-d"),
                );
                if ($this->ion_auth->register($username, $password, $email, $additional_data, $groupData)) {
                    //$this->ion_auth->add_user_count();
                    $this->session->set_flashdata('success_message', "Please check your email and activate your account.<b>Note</b>:check in your spam folder too.");
                   // echo "Please check your email and activate your account";die;
                    
                
                }
                
                /*
                * For login into system
                * 
                * 
                if ($this->ion_auth->linked_login($email)) {
                    //if the login is successful
                    //redirect them back to the perticular Users Dashboard
                    $message = "You are logged in through Linkedin Account. If you want to login through our system using same Email. Please check your email to activate account.";
                    $this->session->set_flashdata('success_message', $message);//$this->ion_auth->messages()
                    //redirect('admin/dashboard','location');
                    //redirect('signin', 'refresh');
                    redirect("signin/users_dashboard", 'refresh');
                }
                * 
                */
                //redirect("signin/login", 'refresh');
                
            }
            
        } else {
            // bad token request, display diagnostic information
            //echo "Request token retrieval failed:<br /><br />RESPONSE:<br /><br />" . print_r($response, TRUE);
            $this->session->set_flashdata('error_message', "Request token retrieval failed:<br /><br />RESPONSE:<br /><br />" . print_r($response, TRUE));
            
        }
        redirect("signin/login", 'refresh');
    }

}

?>