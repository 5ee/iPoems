<?php

include(getcwd() . "/core/nocsrf.php");
$tpl = new bQuickTpl();
include(getcwd() . "/modules/site/common.php");
include(getcwd() . "/includes/common.php");
include(getcwd() . "/libs/recaptcha/recaptchalib.php");

// Send SEO Data
$tpl->page_title = REGISTER;
$tpl->page_description =  site_seo_description;
$tpl->keywords =  site_seo_keywords;
$tpl->page_image       = main_url.website_logo;
// Send SEO Data


$rand_num1 = rand(1, 20);
$rand_num2 = rand(1, 20);

$cap_numbers = array();
$cap_numbers['number1'] = $rand_num1;
$cap_numbers['number2'] = $rand_num2;

$tpl->cap_numbers = $cap_numbers;


if (isset($_SESSION['user_id'])) {
    header("Location: " . main_url . "");
    exit();
}

$errmsg_arr = array();
$errflag = false;

//--user registration--//
if (isset($_POST) && $_POST['submit']) {
    try {
        NoCSRF::check('csrf_token', $_POST, true, 60 * 10, false);
        //$result = 'CSRF check passed. Form parsed.';
        $first_name = clean($_POST['data']['firstname']);
        $last_name = clean($_POST['data']['lastname']);
        $user_email = clean($_POST['data']['user_email']);
        $password = clean($_POST['data']['password']);
        $r_password = clean($_POST['data']['r_password']);
        $sum_of_numbers = clean($_POST['data']['captchatotal']);
        $fullname = $first_name . " " . $last_name;

        //Form validate
        $exits_email = $database->select("users", "*", array("user_email" => $user_email));

        if ($exits_email) {
            $errmsg_arr[] = 'User email is already exits';
            $errflag = true;
        }
        if (!$first_name) {
            $errmsg_arr[] = 'Please enter firstname!';
            $errflag = true;
        }
        if (!$last_name) {
            $errmsg_arr[] = 'Please enter lastname!';
            $errflag = true;
        }
        if (!$user_email) {
            $errmsg_arr[] = 'Please enter your email address!';
            $errflag = true;
        }

        //check repeat password
        if (!$password) {
            $errmsg_arr[] = 'Please enter password!';
            $errflag = true;
        }
        if (!$r_password) {
            $errmsg_arr[] = 'Please enter Confirm password!';
            $errflag = true;
        } else if ($r_password != $password) {
            $errmsg_arr[] = 'Confirm Password does not match';
            $errflag = true;
        } else {
            // hash md5 password
            $n_password = md5(clean($_POST['data']['password']));
            unset($_POST['data']['r_password']);
        }

        if (!$sum_of_numbers) {
            $errmsg_arr[] = 'Please enter Result of two number!';
            $errflag = true;
        } else if (!is_numeric($sum_of_numbers)) {
            $errmsg_arr[] = 'Answer you provide is not Numeric';
            $errflag = true;
        }
        $session_number_total = clean($_POST['data']['number1']) + clean($_POST['data']['number2']);


        if(!$sum_of_numbers == ""){
        if ($sum_of_numbers != $session_number_total) {
            $errmsg_arr[] = 'You are not a human! Please check your total again!';
            $errflag = true;
        }
        }

        //If there are input validations, redirect back to the register form
        if ($errflag) {
            $tpl->errors = $errmsg_arr;
        } else {
            // insert to database

            unset($_POST['data']['number1']);
            unset($_POST['data']['number2']);
            unset($_POST['data']['captchatotal']);

            $data = array();
            $data["firstname"] =$first_name;
            $data["lastname"] = $last_name;
            $data["fullname"] = clean($fullname);
            $data["password"] = $n_password;
            $data["user_email"] = $user_email;
            $userdata = user_insert($database, $data);
            if ($userdata) {
                // Send password to email
                $to = $user_email;
                $subject = 'Registration Successfull at '.site_name;
               $message = 'Hello ' . $first_name .'<br>You have successfully registered at '.site_name.'. If you have any questions, please do reply back to the same email.'.'<br>'.'Thanks '.'<br>'.site_name;
                        
                        
                $sendmail =  sendEmail($to, $subject, $message, $shortcodes = null, $from = null,$mail);
                if($sendmail){
                    header("Location: " . main_url . "/register/success");
                exit();
                
                }
            }
        }
    } catch (Exception $e) {
        // CSRF attack detected
        $result = $e->getMessage() . ' Form ignored.';
    }
} else {
    //$result = 'No post data yet.';
}

//--user login--//
if (isset($_POST) && $_POST['lsubmit']) {
    try {
        NoCSRF::check('csrf_token', $_POST, true, 60 * 10, false);
        $lusername = clean($_POST['ldata']['email']);
        $lpassword = clean($_POST['ldata']['password']);
        $lerrflag = false;
        if ($lusername == '') {
            $lerrmsg_arr[] = 'User email is missing';
            $lerrflag = true;
        }
        if ($lpassword == '') {
            $lerrmsg_arr[] = 'Password is missing';
            $lerrflag = true;
        }
        if ($lerrflag == false) {
            //Find the user in Database
            $get_user = $database->select("users", "*", array(
                "AND" => array(
                    "user_email" => $lusername,
                    "password" => md5($lpassword),
                    "status" => '1',
                )
            ));
            if ($get_user) {
                //Set session
                $_SESSION['user_id'] = $get_user[0]['id'];
                //Put name in session
                $_SESSION['full_name'] = $get_user[0]['fullname'];

                $_SESSION['user_email'] = $get_user[0]['user_email'];
                //$_SESSION['picture'] = $get_user[0]['picture'];
                //Close session writing
                session_write_close();
                //Redirect to user's page
                header("Location: " . main_url);
                exit();
            } else {
                $lerrmsg_arr[] = 'No such User found!';
                $lerrflag = true;
            }
        }
        if ($lerrflag) {
            $tpl->lerrors = $lerrmsg_arr;
        }
    } catch (Exception $e) {
        // CSRF attack detected
        $result = $e->getMessage() . ' Form ignored.';
    }
} else {
    //$result = 'No post data yet.';
}
$token = NoCSRF::generate('csrf_token');
$tpl->formtoken = $token;
echo $tpl->render("themes/site/" . theme_name . "/html/register.php");
