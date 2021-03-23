<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
$CI = &get_instance();

$hostname = $CI->db->hostname;
$username = $CI->db->username;
$password = $CI->db->password;
$databaseName = $CI->db->database;
$dbprefix = $CI->db->dbprefix;

$connect = mysqli_connect("localhost", "root", "", "smartsikshya");
if (mysqli_connect_error()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
/**
 * Name:  Ion Auth
 * * Version: 2.5.2
 * * Author: Ben Edmunds
 *	  ben.edmunds@gmail.com
 *        @benedmunds
 * * Added Awesomeness: Phil Sturgeon
 * * Location: http://github.com/benedmunds/CodeIgniter-Ion-Auth
 * * Created:  10.01.2009
 *
 * Description:  Modified auth system based on redux_auth with extensive customization.  This is basically what Redux Auth 2 should be.
 * Original Author name has been kept but that does not mean that the method has not been modified.
 *
 * Requirements: PHP5 or above
 */
/*
  | -------------------------------------------------------------------------
  | Tables.
  | -------------------------------------------------------------------------
  | Database table names.
 */
$config['tables']['users'] = 'users';
$config['tables']['end_users'] = 'end_users';
$config['tables']['groups'] = 'groups';
$config['tables']['users_groups'] = 'users_groups';
$config['tables']['login_attempts'] = 'login_attempts';
/*
  | Users table column and Group table column you want to join WITH.
  | Joins from users.id
  | Joins from groups.id
 */
$config['join']['users'] = 'user_id';
$config['join']['groups'] = 'group_id';
/*
  | -------------------------------------------------------------------------
  | Hash Method (sha1 or bcrypt)
  | -------------------------------------------------------------------------
  | Bcrypt is available in PHP 5.3+
  |
  | IMPORTANT: Based on the recommendation by many professionals, it is highly recommended to use
  | bcrypt instead of sha1.
  |
  | NOTE: If you use bcrypt you will need to increase your password column character limit to (80)
  |
  | Below there is "default_rounds" setting.  This defines how strong the encryption will be,
  | but remember the more rounds you set the longer it will take to hash (CPU usage) So adjust
  | this based on your server hardware.
  |
  | If you are using Bcrypt the Admin password field also needs to be changed in order to login as admin:
  | $2y$: $2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa
  | $2a$: $2a$08$6TTcWD1CJ8pzDy.2U3mdi.tpl.nYOR1pwYXwblZdyQd9SL16B7Cqa
  |
  | Be careful how high you set max_rounds, I would do your own testing on how long it takes
  | to encrypt with x rounds.
  |
  | salt_prefix: Used for bcrypt. Versions of PHP before 5.3.7 only support "$2a$" as the salt prefix
  | Versions 5.3.7 or greater should use the default of "$2y$".
 */
$config['hash_method'] = 'bcrypt'; // sha1 or bcrypt, bcrypt is STRONGLY recommended
$config['default_rounds'] = 8;  // This does not apply if random_rounds is set to true
$config['random_rounds'] = FALSE;
$config['min_rounds'] = 5;
$config['max_rounds'] = 9;
$config['salt_prefix'] = version_compare(PHP_VERSION, '5.3.7', '<') ? '$2a$' : '$2y$';

/*==========SQL syntax for getting email of superAdmin ======*/
$sqlEmail ="SELECT u.email";
$sqlEmail.=" FROM ".$dbprefix."users u";
$sqlEmail.=" INNER JOIN ".$dbprefix."users_groups ug on u.user_id = ug.user_id";
$sqlEmail.=" INNER JOIN ".$dbprefix."groups g on ug.group_id = g.group_id";
$sqlEmail.=" WHERE g.group_type='superAdmin' AND g.name='admin'";

$adminEmail = mysqli_query($connect, "$sqlEmail");
$adminEmailResult = $adminEmail->fetch_assoc();
$admin_email = $adminEmailResult['email'];

/*==========SQL syntax for getting email of superAdmin ======*/
/*
  | -------------------------------------------------------------------------
  | Authentication options.
  | -------------------------------------------------------------------------
  | maximum_login_attempts: This maximum is not enforced by the library, but is
  | used by $this->ion_auth->is_max_login_attempts_exceeded().
  | The controller should check this function and act
  | appropriately. If this variable set to 0, there is no maximum.
 */
$config['site_title'] = "Smartshikshya";       // Site Title, example.com
$config['admin_email'] = "$admin_email"; // Admin Email, admin@example.com
$config['default_group'] = 'users';           // Default group, use name
$config['admin_group'] = 'admin';             // Default administrators group, use name
$config['identity'] = 'email';             // A database column which is used to login with
$config['min_password_length'] = 8;                   // Minimum Required Length of Password
$config['max_password_length'] = 20;                  // Maximum Allowed Length of Password
$config['email_activation'] = TRUE;               // Email Activation for registration
$config['invitation_activation'] = TRUE;               // Email Activation for invitation
$config['manual_activation'] = FALSE;               // Manual Activation for registration
$config['remember_users'] = TRUE;                // Allow users to be remembered and enable auto-login
$config['user_expire'] = 86500;               // How long to remember the user (seconds). Set to zero for no expiration
$config['user_extend_on_login'] = FALSE;               // Extend the users cookies every time they auto-login
$config['track_login_attempts'] = TRUE;               // Track the number of failed login attempts for each user or ip.
$config['track_login_ip_address'] = TRUE;                // Track login attempts by IP Address, if FALSE will track based on identity. (Default: TRUE)
$config['maximum_login_attempts'] = 5;                   // The maximum number of failed login attempts.
$config['lockout_time'] = 6;                 // The number of seconds to lockout an account due to exceeded attempts
$config['forgot_password_expiration'] = 0;                   // The number of milliseconds after which a forgot password request will expire. If set to 0, forgot password requests will not expire.

/*
  | -------------------------------------------------------------------------
  | Cookie options.
  | -------------------------------------------------------------------------
  | remember_cookie_name Default: remember_code
  | identity_cookie_name Default: identity
 */
$config['remember_cookie_name'] = 'remember_code';
$config['identity_cookie_name'] = 'identity';

/*
  | -------------------------------------------------------------------------
  | Email options.
  | -------------------------------------------------------------------------
  | email_config:
  | 	  'file' = Use the default CI config or use from a config file
  | 	  array  = Manually set your email config settings
 */
$config['use_ci_email'] = TRUE; // Send Email using the builtin CI email class, if false it will return the code and the identity
$config['email_config'] = array(
    'mailtype' => 'html',
);

/*
  | -------------------------------------------------------------------------
  | Email templates.
  | -------------------------------------------------------------------------
  | Folder where email templates are stored.
  | Default: signin/
 */
$config['email_templates'] = 'signin/'; //APPPATH . 'modules/signin/views/email/'; //'signin/email/';

/*
  | -------------------------------------------------------------------------
  | Activate Account Email Template
  | -------------------------------------------------------------------------
  | Default: activate.tpl.php
 */
$config['email_activate'] = 'activate.tpl.php'; //inside modules/signin/views/email/activate.tpl.php//

/*
  | -------------------------------------------------------------------------
  | Forgot Password Email Template
  | -------------------------------------------------------------------------
  | Default: forgot_password.tpl.php
 */
$config['email_forgot_password'] = 'forgot_password.tpl.php'; //inside modules/signin/views/email/forgot_password.tpl.php//

/*
  | -------------------------------------------------------------------------
  | Forgot Password Complete Email Template
  | -------------------------------------------------------------------------
  | Default: new_password.tpl.php
 */
$config['email_forgot_password_complete'] = 'new_password.tpl.php'; //inside modules/signin/views/email/new_password.tpl.php//


/*
  | -------------------------------------------------------------------------
  | Email Activation details.
  | -------------------------------------------------------------------------
  | Email activation header and footer
 
 */
$sqlEmailActivation ="SELECT *";
$sqlEmailActivation.=" FROM ".$dbprefix."settings";
$sqlEmailActivation.=" WHERE status='Publish'";

$emailActivation = mysqli_query($connect, "$sqlEmailActivation");
while ($emailActivationResult = $emailActivation->fetch_assoc()) {
    $settingTYPE = $emailActivationResult['setting_type'];
    $settingACTION = $emailActivationResult['setting_action'];

    if ($settingTYPE == 'activation' && $settingACTION == 'register') {
        $config['email_activation_title'] = 'Signup Activation';
        $config['email_activate_header'] = $emailActivationResult['header'];
        $config['email_activate_footer'] = $emailActivationResult['footer'];
    }
    
    if ($settingTYPE == 'alert' && $settingACTION == 'forgotton_password') {
        $config['email_forget_password_title'] = 'Password Recovery';
        $config['email_forget_password_header'] = $emailActivationResult['header'];
        $config['email_forget_password_footer'] = $emailActivationResult['footer'];
    }
    if ($settingTYPE == 'alert' && $settingACTION == 'forgotten_password_complete') {
        $config['email_new_password_title'] = 'Password Recovery Complete';
        $config['email_new_password_header'] = $emailActivationResult['header'];
        $config['email_new_password_footer'] = $emailActivationResult['footer'];
    }
    
    if ($settingTYPE == 'automation') {
        $config['email_automation_title'] = 'Email Reminder';
        $config['email_automation_header'] = $emailActivationResult['header'];
        $config['email_automation_footer'] = $emailActivationResult['footer'];
    }
}
/*
  | -------------------------------------------------------------------------
  | Salt options
  | -------------------------------------------------------------------------
  | salt_length Default: 22
  |
  | store_salt: Should the salt be stored in the database?
  | This will change your password encryption algorithm,
  | default password, 'password', changes to
  | fbaa5e216d163a02ae630ab1a43372635dd374c0 with default salt.
 */
$config['salt_length'] = 22;
$config['store_salt'] = FALSE;

/*
  | -------------------------------------------------------------------------
  | Message Delimiters.
  | -------------------------------------------------------------------------
 */
$config['delimiters_source'] = 'config';  // "config" = use the settings defined here, "form_validation" = use the settings defined in CI's form validation library
$config['message_start_delimiter'] = '<p>';  // Message start delimiter
$config['message_end_delimiter'] = '</p>';  // Message end delimiter
$config['error_start_delimiter'] = '<p>';  // Error message start delimiter
$config['error_end_delimiter'] = '</p>'; // Error message end delimiter


/*
  | -------------------------------------------------------------------------
  | ACL permission with respect to controller class and their actions
  | -------------------------------------------------------------------------
 */
/*
 * array(
  "signin" => array(
  "index"               => array("superAdmin","teachers","clients","manager"),
 *                                ),
 *      );
 */



$permissionSql = mysqli_query($connect, "SELECT * FROM ".$dbprefix."permissions WHERE status = 'Publish' ");

while ($permissionResult = @$permissionSql->fetch_assoc()) {
    $resultModuleController[] = $permissionResult['controller'];
}
$uniqModuleControllers = array_unique($resultModuleController);

foreach ($uniqModuleControllers as $moduleControllersKeys => $moduleControllersValues) {
    $moduleControllerSql = mysqli_query($connect, "SELECT * FROM ".$dbprefix."permissions WHERE controller LIKE '%$moduleControllersValues%' ");

    while ($moduleControllerResults = @$moduleControllerSql->fetch_assoc()) {
        $actions = $moduleControllerResults['actions'];
        $explodedAction = explode(",", $actions);
        foreach ($explodedAction as $actionVal) {
            $groups = $moduleControllerResults['groups'];
            $explodedGroup = explode(",", $groups);
            foreach ($explodedGroup as $groupsKey => $groupVal) {
                $groupss["$groupsKey"] = '"' . $groupVal . '"';
            }
            $groups = implode(',', $groupss);
            $data["$actionVal"] = $explodedGroup;
        }
        
        
    }
    $controlledData["$moduleControllersValues"] = $data;
}

//echo '<pre>';
//print_r($controlledData);die;
$config['permission'] = $controlledData;

//echo "<pre>";
//print_r($config['permission']);die;
//$config['permission'] = 
//        array(
//                "signin/signin" => array(
//                            "index"               => array("superAdmin", "teachers", "manager","clients"),
//                            "dashboard"           => array("admin", "teachers","clients"),
//                            "users"               => array("superAdmin","teachers","manager"),
//                            "send_user_email"     => array("superAdmin","teachers","manager"),
//                            "superAdmin_dashboard"=> array("superAdmin"),
//                            "manger_dashboard"    => array("superAdmin","manager"),
//                            "clients_dashboard"   => array("superAdmin","clients","manager"),
//                            "login"               => array("superAdmin","teachers","manager","clients"),
//                            "logout"              => array("superAdmin","teachers","manager","clients"),
//                            "change_password"     => array("superAdmin","teachers","manager","clients"),
//                            "forgot_password"     => array("superAdmin","teachers","manager","clients"),
//                            "reset_password"      => array("superAdmin","teachers","manager","clients"),
//                            "activate"            => array("superAdmin","teachers","manager"),
//                            "deactivate"          => array("superAdmin","teachers","manager"),
//                            "create_user"         => array("superAdmin","manager","clients"),
//                            "edit_user"           => array("superAdmin","manager","clients"),
//                            "delete_user"         => array("superAdmin","manager","clients"),
//                            "delete_user_image"   => array("superAdmin","manager","clients"),
//                            "update_user_status"  => array("superAdmin","manager","clients"),
//                            "list_group"          => array("superAdmin","teachers","manager","clients"),
//                            "create_group"        => array("superAdmin","teachers","manager","clients"),
//                            "edit_group"          => array("superAdmin","teachers","manager","clients"),
//                            "delete_group"        => array("superAdmin"),
//                ),
//                "permissions/permissions" => array(
//                            "index"                         => array("superAdmin","clients" ,"manager"),
//                            "create_permissions"            => array("superAdmin","clients" ,"manager"),
//                            "edit_permissions"              => array("superAdmin","clients" ,"manager"),
//                            "delete_permissions"            => array("superAdmin","clients" ,"manager"),
//                ),
//                "home/home"  => array(
//                            "index"                         => array("superAdmin","teachers","clients","manager"),
//                            "admin"                         => array("admin"),
//                            "manager"                       => array("Teachers")
//                ),
//                "teachers/teachers"  => array(
//                            "index"                         => array("superAdmin","teachers","clients","manager"),
//                            "login"                         => array("superAdmin","teachers"),
//                            "teachers_dashboard"            => array("superAdmin","teachers"),
//                            "teacher_template_list"            => array("superAdmin","teachers"),
//                            "template_add"            => array("superAdmin","teachers"),
//                            "template_edit"            => array("superAdmin","teachers"),
//                            "template_delete"            => array("superAdmin","teachers"),
//                ),
//                
//            );

/**
 * You can have as many roles as you like, each user or object can have multiple roles.
 */
//$config['roles'] = array('admin', 'Teachers', 'Clients', 'Content_creator');

/* End of file ion_auth.php */
/* Location: ./application/config/ion_auth.php */
?>