<?php

include(getcwd() . "/core/nocsrf.php");
$tpl = new bQuickTpl();
include(getcwd() . "/modules/site/common.php");
include(getcwd() . "/includes/common.php");
// Send SEO Data
$tpl->page_title = CHANGE_PASSWORD;
$tpl->page_description =  site_seo_description;
$tpl->keywords =  site_seo_keywords;
$tpl->page_image       = main_url.website_logo;
// Send SEO Data

$errmsg_arr = array();
$errflag = false;

if (isset($params[2]) && $params[2] == "error") {
    $tpl->errors = $_SESSION['ERRMSG_ARR'];
}
if (isset($_SESSION['user_id'])) {

    if (isset($_POST) && $_POST['change_password']) {
        try {
            NoCSRF::check('csrf_token', $_POST, true, 60 * 10, false);
            $old_password = clean($_POST['data']['old_password']);
            $new_password = clean($_POST['data']['new_password']);
            $repeat_password = clean($_POST['data']['r_password']);

            $checkpassword = clean(md5($old_password));
            //Input Validations
            if ($old_password == '') {
                $errmsg_arr[] = 'Old Password Field Value is missing!';
                $errflag = true;
            }
            if ($new_password == '') {
                $errmsg_arr[] = 'New Password Field Value is missing!';
                $errflag = true;
            }
            if ($repeat_password == '') {
                $errmsg_arr[] = 'Repeat Password Field Value is missing!';
                $errflag = true;
            }
            if ($new_password != $repeat_password) {
                $errmsg_arr[] = 'Repeat Password Field Value doesnot match with New Password';
                $errflag = true;
            }
            if ($new_password == $old_password && $old_password) {
                $errmsg_arr[] = 'New Password cannot be same as Old Password';
                $errflag = true;
            }
            if ($errflag == true) {
                $tpl->errors = $errmsg_arr;
            } else {
                $user_email = clean($_SESSION['user_email']);
                $get_user = select_password($database, $user_email, $checkpassword);
                if ($get_user) {
                    $newpass = clean(md5($new_password));
                    $updatepassword = update_password($database, $newpass, $user_email);
                    if ($updatepassword) {
                        header("Location: " . main_url . "/changepassword/success");
                    }
                } else {
                    $errmsg_arr[] = 'Old Password is Wrong!';
                    $errflag = true;
                    $tpl->errors = $errmsg_arr;
                }
            }
            //If there are input validations, redirect back to the login form
        } catch (Exception $e) {
            // CSRF attack detected
            $result = $e->getMessage() . ' Form ignored.';
        }
    } else {
        //$result = 'No post data yet.';
    }
} else {

    header("location: " . main_url);
}
$token = NoCSRF::generate('csrf_token');
$tpl->formtoken = $token;
echo $tpl->render("themes/site/" . theme_name . "/html/changepassword.php");
