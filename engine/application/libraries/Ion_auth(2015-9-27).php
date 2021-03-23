<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Name:  Ion Auth
 *
 * Version: 2.5.2
 *
 * Author: Ben Edmunds
 * 		  ben.edmunds@gmail.com
 *         @benedmunds
 *
 * Added Awesomeness: Phil Sturgeon
 *
 * Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
 *
 * Created:  10.01.2009
 *
 * Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
 * Original Author name has been kept but that does not mean that the method has not been modified.
 *
 * Requirements: PHP5 or above
 *
 */
class Ion_auth {

    /**
     * account status ('not_activated', etc ...)
     *
     * @var string
     * */
    protected $status;

    /**
     * extra where
     *
     * @var array
     * */
    public $_extra_where = array();

    /**
     * extra set
     *
     * @var array
     * */
    public $_extra_set = array();

    /**
     * caching of users and their groups
     *
     * @var array
     * */
    public $_cache_user_in_group;

    /**
     * config value for permission 
     * of each controller with its action respectively with groups(role) access
     * 
     * @var array
     * */
    //private $_CI;
    private $acl;
    
    /**
     * __construct
     *
     * @return void
     * @author Ben
     * */
    
    
    public function __construct() {

        $this->load->config('ion_auth', TRUE);
        
        $this->load->library(array('email'));
        $this->lang->load('ion_auth');
        
        $this->acl = $this->config->item('permission', 'ion_auth');// retriving config values of permission 
        
        //$this->load->helper(array('cookie', 'language','url'));
        $this->load->helper(array('language'));

        $this->load->library('session');

        $this->load->model('ion_auth_model');

        $this->_cache_user_in_group = & $this->ion_auth_model->_cache_user_in_group;

        //auto-login the user if they are remembered
        if (!$this->logged_in() && get_cookie($this->config->item('identity_cookie_name', 'ion_auth')) && get_cookie($this->config->item('remember_cookie_name', 'ion_auth'))) {
            $this->ion_auth_model->login_remembered_user();
        }

        $email_config = $this->config->item('email_config', 'ion_auth');

        if ($this->config->item('use_ci_email', 'ion_auth') && isset($email_config) && is_array($email_config)) {
            $this->email->initialize($email_config);
        }

        $this->ion_auth_model->trigger_events('library_constructor');
    }

    /**
     * __call
     *
     * Acts as a simple way to call model methods without loads of stupid alias'
     *
     * */
    public function __call($method, $arguments) {
        if (!method_exists($this->ion_auth_model, $method)) {
            throw new Exception('Undefined method Ion_auth::' . $method . '() called');
        }
        if ($method == 'create_user') {
            return call_user_func_array(array($this, 'register'), $arguments);
        }
        if ($method == 'update_user') {
            return call_user_func_array(array($this, 'update'), $arguments);
        }
        return call_user_func_array(array($this->ion_auth_model, $method), $arguments);
    }

    /**
     * __get
     *
     * Enables the use of CI super-global without having to define an extra variable.
     *
     * I can't remember where I first saw this, so thank you if you are the original author. -Militis
     *
     * @access	public
     * @param	$var
     * @return	mixed
     */
    public function __get($var) {
        return get_instance()->$var;
    }

    /**
     * forgotten password feature
     *
     * @return mixed  boolian / array
     * @author Mathew
     * */
    public function forgotten_password($identity) {    //changed $email to $identity
        if ($this->ion_auth_model->forgotten_password($identity)) {   //changed
            // Get user information
            $identifier = $this->ion_auth_model->identity_column; // use model identity column, so it can be overridden in a controller
            $user = $this->where($identifier, $identity)->where('active', 1)->users()->row();  //changed to get_user_by_identity from email

            if ($user) {
                $data = array(
                    'identity' => $user->{$this->config->item('identity', 'ion_auth')},
                    'forgotten_password_code' => $user->forgotten_password_code
                );

                if (!$this->config->item('use_ci_email', 'ion_auth')) {
                    $this->set_message('forgot_password_successful');
                    return $data;
                } else {
                    $message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('email_forgot_password', 'ion_auth'), $data, true);
                    $this->email->clear();
                    $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
                    $this->email->to($user->email);
                    $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_forgotten_password_subject'));
                    $this->email->message($message);

                    if ($this->email->send()) {
                        $this->set_message('forgot_password_successful');
                        return TRUE;
                    } else {
                        $this->set_error('forgot_password_unsuccessful');
                        return FALSE;
                    }
                }
            } else {
                $this->set_error('forgot_password_unsuccessful');
                return FALSE;
            }
        } else {
            $this->set_error('forgot_password_unsuccessful');
            return FALSE;
        }
    }

    /**
     * forgotten_password_complete
     *
     * @return void
     * @author Mathew
     * */
    public function forgotten_password_complete($code) {
        $this->ion_auth_model->trigger_events('pre_password_change');

        $identity = $this->config->item('identity', 'ion_auth');
        $profile = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

        if (!$profile) {
            $this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
            $this->set_error('password_change_unsuccessful');
            return FALSE;
        }

        $new_password = $this->ion_auth_model->forgotten_password_complete($code, $profile->salt);

        if ($new_password) {
            $data = array(
                'identity' => $profile->{$identity},
                'new_password' => $new_password
            );
            if (!$this->config->item('use_ci_email', 'ion_auth')) {
                $this->set_message('password_change_successful');
                $this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_successful'));
                return $data;
            } else {
                $message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('email_forgot_password_complete', 'ion_auth'), $data, true);

                $this->email->clear();
                $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
                $this->email->to($profile->email);
                $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_new_password_subject'));
                $this->email->message($message);

                if ($this->email->send()) {
                    $this->set_message('password_change_successful');
                    $this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_successful'));
                    return TRUE;
                } else {
                    $this->set_error('password_change_unsuccessful');
                    $this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
                    return FALSE;
                }
            }
        }

        $this->ion_auth_model->trigger_events(array('post_password_change', 'password_change_unsuccessful'));
        return FALSE;
    }

    /**
     * forgotten_password_check
     *
     * @return void
     * @author Michael
     * */
    public function forgotten_password_check($code) {
        $profile = $this->where('forgotten_password_code', $code)->users()->row(); //pass the code to profile

        if (!is_object($profile)) {
            $this->set_error('password_change_unsuccessful');
            return FALSE;
        } else {
            if ($this->config->item('forgot_password_expiration', 'ion_auth') > 0) {
                //Make sure it isn't expired
                $expiration = $this->config->item('forgot_password_expiration', 'ion_auth');
                if (time() - $profile->forgotten_password_time > $expiration) {
                    //it has expired
                    $this->clear_forgotten_password_code($code);
                    $this->set_error('password_change_unsuccessful');
                    return FALSE;
                }
            }
            return $profile;
        }
    }

    /**
     * register
     *
     * @return void
     * @author Mathew
     * */
    /*
    public function register($username, $password, $email, $additional_data = array(), $group_ids = array()) //need to test email activation
	{
		$this->ion_auth_model->trigger_events('pre_account_creation');

		$email_activation = $this->config->item('email_activation', 'ion_auth');

		if (!$email_activation)
		{
			$id = $this->ion_auth_model->register($username, $password, $email, $additional_data, $group_ids);
			if ($id !== FALSE)
			{
				$this->set_message('account_creation_successful');
				$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful'));
				return $id;
			}
			else
			{
				$this->set_error('account_creation_unsuccessful');
				$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
				return FALSE;
			}
		}
		else
		{
			$id = $this->ion_auth_model->register($username, $password, $email, $additional_data, $group_ids);

			if (!$id)
			{
				$this->set_error('account_creation_unsuccessful');
				return FALSE;
			}

			//deactivate so the user much follow the activation flow
			$deactivate = $this->ion_auth_model->deactivate($id);

			//the deactivate method call adds a message, here we need to clear that
			$this->ion_auth_model->clear_messages();


			if (!$deactivate)
			{
				$this->set_error('deactivate_unsuccessful');
				$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
				return FALSE;
			}

			$activation_code = $this->ion_auth_model->activation_code;
			$identity        = $this->config->item('identity', 'ion_auth');
			$user            = $this->ion_auth_model->user($id)->row();

			$data = array(
				'identity'   => $user->{$identity},
				'id'         => $user->id,
				'email'      => $email,
				'activation' => $activation_code,
			);
			if(!$this->config->item('use_ci_email', 'ion_auth'))
			{
				$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
				$this->set_message('activation_email_successful');
					return $data;
			}
			else
			{
				$message = $this->load->view($this->config->item('email_templates', 'ion_auth').$this->config->item('email_activate', 'ion_auth'), $data, true);

				$this->email->clear();
				$this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
				$this->email->to($email);
				$this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_activation_subject'));
				$this->email->message($message);
                                
				if ($this->email->send() == TRUE)
				{
					$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
					$this->set_message('activation_email_successful');
					return $id;
				}

			}

			$this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful', 'activation_email_unsuccessful'));
			$this->set_error('activation_email_unsuccessful');
			return FALSE;
		}
	}
   */ 
    public function register($username, $password, $email, $additional_data = array(), $group_ids = array()) { //need to test email activation
        
        $this->ion_auth_model->trigger_events('pre_account_creation');

        $email_activation = $this->config->item('email_activation', 'ion_auth');

        if (!$email_activation) {
            $id = $this->ion_auth_model->register($username, $password, $email, $additional_data, $group_ids);
            if ($id !== FALSE) {
                $this->set_message('account_creation_successful');
                $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful'));
                return $id;
            } else {
                $this->set_error('account_creation_unsuccessful');
                $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }
        } else {
            $id = $this->ion_auth_model->register($username, $password, $email, $additional_data, $group_ids);

            if (!$id) {
                $this->set_error('account_creation_unsuccessful');
                return FALSE;
            }

            //deactivate so the user much follow the activation flow
            $deactivate = $this->ion_auth_model->deactivate($id);

            //the deactivate method call adds a message, here we need to clear that
            $this->ion_auth_model->clear_messages();


            if (!$deactivate) {
                $this->set_error('deactivate_unsuccessful');
                $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }

            $activation_code = $this->ion_auth_model->activation_code;
            $identity = $this->config->item('identity', 'ion_auth');
            $user = $this->ion_auth_model->user($id)->row();
       
            
            $user_token = $user->user_token;
            

            $data = array(
                'identity' => $user->{$identity},
                'user_id' => $user->user_id,
                'email' => $email,
                'activation' => $activation_code,
            );
            $identity = $user->{$identity};
            $user_id = $user->user_id;
            //$email= $email;
            $activation = $activation_code;
            if (!$this->config->item('use_ci_email', 'ion_auth')) {
                
                $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                $this->set_message('activation_email_successful');
                return $data;
            } else {
                $this->load->helper(array('email'));
                $this->load->library(array('email'));
                
//                $email_activation_heading = sprintf(lang('email_activate_heading'), $identity);
//                $email_activation_messages = sprintf(lang('email_activate_subheading'), anchor('signin/activate/'. $user_token .'/'. $activation, lang('email_activate_link')));
                //$message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('email_activate', 'ion_auth'), $data, true);
                $email_activation_heading = sprintf(lang('email_activate_heading'), $identity);
                $email_activation_messages = sprintf(lang('email_activate_subheading'), anchor("signin/signup_complete/$user_token/$activation", lang('email_activate_link')));
                $message = "<html><body><h1>$email_activation_heading</h1><p>$email_activation_messages</p></body></html>";
                
                
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
                $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_activation_subject'));
                $this->email->message($message);

                 //echo print_r($this->email->print_debugger(), true);die;

//                $this->email->clear();
//                $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
//                $this->email->to($email);
//                $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_activation_subject'));
//                $this->email->message($message);

                if ($this->email->send() == true) {
                    $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                    $this->set_message('activation_email_successful');
                    return $id;
                }else{
                    //echo print_r($this->email->print_debugger(), true);
                    $this->set_message('activation_email_unsuccessful');
                   //die;
                }
                //$this->set_message('activation_email_successful');
                
            }

//            $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful', 'activation_email_unsuccessful'));
//            $this->set_error('activation_email_unsuccessful');
//            return FALSE;
        }
    }
    
    /*
     * inviting the new end users who will get chance to give answers to the templates they have been provided
     * 
     */
     public function invitation($email, $additional_data = array()) { //need to test email activation
        
         $this->ion_auth_model->trigger_events('pre_account_creation');

        $email_activation = $this->config->item('email_activation', 'ion_auth');

        if (!$email_activation) {
            $id = $this->ion_auth_model->invite($email, $additional_data);//register
            if ($id !== FALSE) {
                $this->set_message('account_creation_successful');
                $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful'));
                return $id;
            } else {
                $this->set_error('account_creation_unsuccessful');
                $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }
        } else {
            $id = $this->ion_auth_model->invite($email, $additional_data);

            if (!$id) {
                $this->set_error('account_creation_unsuccessful');
                return FALSE;
            }

            //deactivate so the user much follow the activation flow
            $deactivate = $this->ion_auth_model->invite_deactivate($id);

            //the deactivate method call adds a message, here we need to clear that
            $this->ion_auth_model->clear_messages();


            if (!$deactivate) {
                $this->set_error('deactivate_unsuccessful');
                $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful'));
                return FALSE;
            }

            $activation_code = $this->ion_auth_model->activation_code;
            $identity = $this->config->item('identity', 'ion_auth');
            $user = $this->ion_auth_model->end_user($id)->row();
       
            
            $user_token = $user->user_token;
            

            $data = array(
                'identity' => $user->{$identity},
                'end_user_id' => $user->end_user_id,
                'email' => $email,
                'activation' => $activation_code,
            );
            $identity = $user->{$identity};
            $end_user_id = $user->end_user_id;
            //$email= $email;
            $activation = $activation_code;
            if (!$this->config->item('use_ci_email', 'ion_auth')) {
                
                $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                $this->set_message('activation_email_successful');
                return $data;
            } else {
                $this->load->helper(array('email'));
                $this->load->library(array('email'));
                
//                $email_activation_heading = sprintf(lang('email_activate_heading'), $identity);
//                $email_activation_messages = sprintf(lang('email_activate_subheading'), anchor('signin/activate/'. $user_token .'/'. $activation, lang('email_activate_link')));
                //$message = $this->load->view($this->config->item('email_templates', 'ion_auth') . $this->config->item('email_activate', 'ion_auth'), $data, true);
                $email_activation_heading = sprintf(lang('email_activate_heading'), $identity);
                $email_activation_messages = sprintf(lang('email_activate_subheading'), anchor("signin/end_user_signup_complete/$user_token/$activation", lang('email_activate_link')));
                $message = "<html><body><h1>$email_activation_heading</h1><p>$email_activation_messages</p></body></html>";
                
                
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
                //$this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_activation_subject'));
                $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - User Registration' );
                $this->email->message($message);

                 //echo print_r($this->email->print_debugger(), true);die;

//                $this->email->clear();
//                $this->email->from($this->config->item('admin_email', 'ion_auth'), $this->config->item('site_title', 'ion_auth'));
//                $this->email->to($email);
//                $this->email->subject($this->config->item('site_title', 'ion_auth') . ' - ' . $this->lang->line('email_activation_subject'));
//                $this->email->message($message);

                if ($this->email->send() == true) {
                    $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_successful', 'activation_email_successful'));
                    $this->set_message('activation_email_successful');
                    return $id;
                }else{
                    //echo print_r($this->email->print_debugger(), true);
                    $this->set_message('activation_email_unsuccessful');
                   //die;
                }
                //$this->set_message('activation_email_successful');
                
            }

//            $this->ion_auth_model->trigger_events(array('post_account_creation', 'post_account_creation_unsuccessful', 'activation_email_unsuccessful'));
//            $this->set_error('activation_email_unsuccessful');
//            return FALSE;
        }
    }
    
    /**
     * creator count on users created by creator
     *
     * @return void
     * @author Menson
     * */
   
    public function add_user_count() { //need to test email activation
        $loginUserID = $this->ion_auth->get_user_id();
        
        $loginUserDetails = $this->login_user_details();
        $profileID = $loginUserDetails->profile_id;
        $profileDetails = $this->ion_auth_model->get_byId('profile','profile_id',$profileID);
                    $profile_users_capacity = $profileDetails->users;
                    $profileTitle = $profileDetails->profile_title;
        
        $userExist = $this->ion_auth_model->value_exist('profile_counter','user_id',$loginUserID,'profile_id',$profileID);
        
        if ($userExist == true) {
                $profileCounterDetails = $this->ion_auth_model->get_byId('profile_counter', 'user_id', $loginUserID, 'profile_id', $profileID);
                $old_users_count = $profileCounterDetails->users_count; //old users created count
                $present_c_users_count = $this->ion_auth_model->countTotal('users', 'c_user_id', $loginUserID);
             if(!empty($present_c_users_count)){   
                if ($profileTitle == 'demo') {
                    $add_user_count['profile_title'] ="demo";
                    if ($old_users_count < $profile_users_capacity) {
                        $add_user_count['can_add'] =true;
                        $add_user_count['old_users_count']= $old_users_count;
                        $add_user_count['profile_users_capacity']= $profile_users_capacity;
                        $add_user_count['users_count'] = $post['users_count'] =$present_users_count = $old_users_count + 1;
                        $this->ion_auth_model->update_profile('profile_counter', $post, 'user_id',$loginUserID,'profile_id',$profileID);
                        return $add_user_count;
                    } else {
                        $add_user_count['can_add'] =false;
                        $add_user_count['old_users_count']= $old_users_count;
                        $add_user_count['profile_users_capacity']= $profile_users_capacity;
                        return $add_user_count;
                    }
                } elseif ($profileTitle == 'paid') {
                    $add_user_count['profile_title'] ="paid";
                    $add_user_count['can_add'] =true;
                    $add_user_count['old_users_count']= $old_users_count;
                    $add_user_count['profile_users_capacity']= $profile_users_capacity;
                    $post['users_count'] =$present_users_count = $old_users_count + 1;
                    $this->ion_auth_model->update_profile('profile_counter', $post, 'user_id',$loginUserID,'profile_id',$profileID);
                    return $add_user_count;
                }
              }
            } else {
                $add_user_count['can_add'] = true;
                $post['user_id']=$loginUserID;
                $post['profile_id']=$profileID;
                $post['users_count'] =$present_users_count = 1;
                $this->ion_auth_model->insert_profile('profile_counter', $post);
                return $add_user_count;
            }
        }
        
         public function add_template_count() { //need to test email activation
        $loginUserID = $this->ion_auth->get_user_id();
        
        $loginUserDetails = $this->login_user_details();
        $profileID = $loginUserDetails->profile_id;
        $profileDetails = $this->ion_auth_model->get_byId('profile','profile_id',$profileID);
                    $profile_templates_capacity = $profileDetails->templates;
                    $profileTitle = $profileDetails->profile_title;
        
        $userExist = $this->ion_auth_model->value_exist('profile_counter','user_id',$loginUserID,'profile_id',$profileID);
        
        if ($userExist == true) {
                $profileCounterDetails = $this->ion_auth_model->get_byId('profile_counter', 'user_id', $loginUserID, 'profile_id', $profileID);
                $old_templates_count = $profileCounterDetails->templates_count; //old users created count
                $present_c_users_count = $this->ion_auth_model->countTotal('users_templates', 'c_user_id', $loginUserID);
             if(!empty($present_c_users_count)){   
                if ($profileTitle == 'demo') {
                    $add_user_count['profile_title'] ="demo";
                    if ($old_templates_count < $profile_templates_capacity) {
                        $add_user_count['can_add'] =true;
                        $add_user_count['old_templates_count']= $old_templates_count;
                        $add_user_count['profile_templates_capacity']= $profile_templates_capacity;
                        $add_user_count['users_count'] = $post['templates_count'] =$present_templates_count = $old_templates_count + 1;
                        $this->ion_auth_model->update_profile('profile_counter', $post, 'user_id',$loginUserID,'profile_id',$profileID);
                        return $add_user_count;
                    } else {
                        $add_user_count['can_add'] =false;
                        $add_user_count['old_templates_count']= $old_templates_count;
                        $add_user_count['profile_templates_capacity']= $profile_templates_capacity;
                        return $add_user_count;
                    }
                } elseif ($profileTitle == 'paid') {
                    $add_user_count['profile_title'] ="paid";
                    $add_user_count['can_add'] =true;
                    $add_user_count['old_templates_count']= $old_templates_count;
                    $add_user_count['profile_templates_capacity']= $profile_templates_capacity;
                    $post['templates_count'] =$present_templates_count = $old_templates_count + 1;
                    $this->ion_auth_model->update_profile('profile_counter', $post, 'user_id',$loginUserID,'profile_id',$profileID);
                    return $add_user_count;
                }
              }
            } else {
                $add_user_count['can_add'] = true;
                $post['user_id']=$loginUserID;
                $post['profile_id']=$profileID;
                $post['templates_count'] =$present_templates_count = 1;
                $this->ion_auth_model->insert_profile('profile_counter', $post);
                return $add_user_count;
            }
        }
    
    /**
     * logout
     *
     * @return void
     * @author Mathew
     * */
    public function logout() {
        $this->ion_auth_model->trigger_events('logout');

        $identity = $this->config->item('identity', 'ion_auth');
        $this->session->unset_userdata(array($identity => '', 'user_id' => '', 'user_id' => ''));

        //delete the remember me cookies if they exist
        if (get_cookie($this->config->item('identity_cookie_name', 'ion_auth'))) {
            delete_cookie($this->config->item('identity_cookie_name', 'ion_auth'));
        }
        if (get_cookie($this->config->item('remember_cookie_name', 'ion_auth'))) {
            delete_cookie($this->config->item('remember_cookie_name', 'ion_auth'));
        }

        //Destroy the session
        $this->session->sess_destroy();

        //Recreate the session
        if (substr(CI_VERSION, 0, 1) == '2') {
            $this->session->sess_create();
        } else {
            $this->session->sess_regenerate(TRUE);
        }

        $this->set_message('logout_successful');
        return TRUE;
    }

    /**
     * logged_in
     *
     * @return bool
     * @author Mathew
     * */
    public function logged_in() {
        $this->ion_auth_model->trigger_events('logged_in');

        return (bool) $this->session->userdata('identity');
    }

    /**
     * END USER logged_in
     *
     * @return bool
     * @author Mathew
     * */
    public function end_user_logged_in() {
        $this->ion_auth_model->trigger_events('logged_in');

        return (bool) $this->session->userdata('user_identity');
    }
    /**
     * logged_in
     *
     * @return integer
     * @author jrmadsen67
     * */
    public function get_user_id() {
        $user_id = $this->session->userdata('user_id');
        if (!empty($user_id)) {
            return $user_id;
        }
        return null;
    }
    /**
     * logged_in
     *
     * @return integer
     * @author jrmadsen67
     * */
    public function login_user_details($loginUserId=null) {
        $user_id = $this->session->userdata('user_id');
        if (!empty($user_id)) {
            $user_details = $this->ion_auth_model->get_users_details($user_id);
            return $user_details;
        }elseif (!empty($loginUserId)) {
            $user_details = $this->ion_auth_model->get_users_details($loginUserId);
            return $user_details;
        }
        return null;
    }

    /**
     * is_admin
     *
     * @return bool
     * @author Ben Edmunds
     * */
    public function is_admin($id = false) {
        $this->ion_auth_model->trigger_events('is_admin');

        $admin_group = $this->config->item('admin_group', 'ion_auth');

        return $this->in_group($admin_group, $id);
    }

    /**
     * in_group
     *
     * @param mixed group(s) to check
     * @param bool user id
     * @param bool check if all groups is present, or any of the groups
     *
     * @return bool
     * @author Phil Sturgeon
     * */
    public function in_group($check_group, $id = false, $check_all = false) {
        $this->ion_auth_model->trigger_events('in_group');

        $id || $id = $this->session->userdata('user_id');

        if (!is_array($check_group)) {
            $check_group = array($check_group);
        }

        if (isset($this->_cache_user_in_group[$id])) {
            $groups_array = $this->_cache_user_in_group[$id];
        } else {
            $users_groups = $this->ion_auth_model->get_users_groups($id)->result();
            $groups_array = array();
            foreach ($users_groups as $group) {
                $groups_array[$group->group_id] = $group->name;
            }
            $this->_cache_user_in_group[$id] = $groups_array;
        }
        foreach ($check_group as $key => $value) {
            $groups = (is_string($value)) ? $groups_array : array_keys($groups_array);

            /**
             * if !all (default), in_array
             * if all, !in_array
             */
            if (in_array($value, $groups) xor $check_all) {
                /**
                 * if !all (default), true
                 * if all, false
                 */
                return !$check_all;
            }
        }

        /**
         * if !all (default), false
         * if all, true
         */
        return $check_all;
    }
    
    
    
    
    /**
	 * function that checks that the user has the required permissions
	 *
	 * @param string $controller
	 * @param array $required_permissions_action
	 * @param integer $user_id
	 * @return boolean
         * @author Menson
     * */
	public function has_permission($controller, $required_permissions_actionName, $user_id = NULL)
	{
            
            //var_dump($controller,$required_permissions_actionName,$user_id);
		/* make sure that the required permissions is an array */
		if (!is_array($required_permissions_actionName))
		{
			$required_permissions_actionName = explode( ',', $required_permissions_actionName);	
                }
			
        ////// for checking the user session id's have groups and their details
                $user_roles = $users_groups = $this->ion_auth_model->get_users_groups($user_id)->row_array();
                //$groups_array = array();
                //foreach ($users_groups as $group) {
                //$groups_array[$group->group_id] = $group->name;
                //}
                //$cache = $this->_cache_user_in_group[$user_id] = $groups_array;
                
        ////// for checking the user session id's have groups and their details
		/* Get the vars from ci_session */
		//$role_id= $this->_CI->session->userdata('role_id');
                //$user_roles=$this->_CI->db->query("select * from tbl_groups where group_id=$role_id")->row_array();
		/* Shouldn't happen but if we stick to belt and braces we should be OK */
		if ( ! $user_id OR ! $user_roles)
		{
			return FALSE;		
		}	

		/* set empty array */
		$permissions = array();

               
                
		/* Load the permissions config */
//                echo '<pre>';
//                print_r($user_roles);
                // $this->acl["$controller"] // return config array of the controller class // dashboard
                // $actions == > return function/action of the related controller class // index, create, edit, delete, update_status
                // $roles == > return list of roles name authorized to access the action of the controller class // admin, member, clients
		
                foreach ($this->acl["$controller"] as $actions => $roles)
		{   //$user_roles == > gives the group of the current login user from user_id sessioned
                    
                    foreach ($user_roles as $user_role)
                    {
                        
                        if (in_array( $user_role, $roles ))
                        {   //checking for the exist of the roles (group) // admin
                            //of the user who loggedIn inside the list ofpermission roles(groups)== > admin, member, clients
                            //for the permitted controller class == > dashboard
                            $permissions[$actions] = $roles; // the action has permissoin of // function index() has permission of (admin, clients) only

                           
                        }					
                    }
                    
                    //echo "==action =>";print_r($actions);
                    //echo "==roles=>";print_r($roles);
		}
               
                
		foreach ($permissions as $action => $role)
		{   //checking for the action name is in configured permission action list or not 
                    // $permissions config details of action and its groups
                    //$action == > function name
                    //$role == > group names
//                    echo "<<-actions->>";print_r($action);echo '<br/>';
//                    echo "<<-roles->>";print_r($role);echo '<br/>';
//                    echo "<<-permissoin action name->>";print_r($required_permissions_actionName);echo '<br/>';
                           
			if (in_array($action, $required_permissions_actionName))
			{                     
                            
//				if (($action == 'edit own' OR $action == 'delete own') && ( ! isset($user_id) OR $user_id != $user_id))
//				{
//					return FALSE;
//				}
				return TRUE;
			}
		}
                //die;
	}
        /**
	 * function that checks that the user has the dashboard according to their users accout type/name group
	 *
	 * @param string $controller
	 * @return boolean
         * @author Menson
     * */
        public function has_dashboard($user_id = NULL){
            $user_roles = $users_groups = $this->ion_auth_model->get_users_groups($user_id)->row_array();
            //return $user_roles;
            return $user_roles['group_type'];
        }
        public function has_group_name($user_id = NULL){
            $user_roles = $users_groups = $this->ion_auth_model->get_users_groups($user_id)->row_array();
            //return $user_roles;
            $groupName = lcfirst($user_roles['name']);
            return $groupName;
        }
        
        
      
        
        ///////////////////////////////////////// Extend my custom Auth guard by adding impersonation methods:
//        public function impersonate1() {
//            if ($id = $this->session->get('impersonate_member')) {
//                $this->onceUsingId($id);
//                return true;
//            }
//            return false;
//        }
//
//        public function isImpersonating() {
//            return $this->can('sys_user') && $this->session->has('impersonate_member');
//        }
//
//        public function setUserToImpersonate(User $user) {
//            $this->session->put('impersonate_member', $user->profile_slug);
//        } 
//        
//        /////////////////////////////////////Create an admin route to trigger the user impersonation:
//        public function postImpersonate()
//        {
//         $memberId = $this->request->get('member_id');
//         $user = \Repo::users()->findOrFail($memberId);
//         $this->auth->setUserToImpersonate($user);
//         return $this->handler->route(['account.profile', $memberId]);
//        }
//        ////////////////////////////////////Create a filter that runs before a member page is shown. This filter will detect if a user should be impersonated, and if so, logins in the user:
//        public function filter($route, $request)
//        {
//            if (\Auth::isImpersonating()) \Auth::impersonate();
//        }
       //=================== login as other user end   IMPORSONATE methods

}
