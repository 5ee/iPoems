<?php

include(getcwd() . "/core/nocsrf.php");
$tpl = new bQuickTpl();
include(getcwd() . "/modules/site/common.php");

include(getcwd() . "/libs/helper/mail.php");
include(getcwd() . "/libs/helper/common.php");
$tpl->loginUrl = $loginUrl;
// Send SEO Data
$tpl->page_title = FORGOT_PASSWORD;
$tpl->page_description =  site_seo_description;
$tpl->keywords =  site_seo_keywords;
$tpl->page_image       = main_url.website_logo;
// Send SEO Data

//--for send password--//  
if (isset($_POST) && $_POST) {
    try {
        $result = 'CSRF check passed. Form parsed.';
        $userEmail = clean($_POST['data']['user_email']);

        $get_user = $database->select("users", "*", array("user_email" => $userEmail));

        if ($get_user) {
            $update = $database->update('users',array('password'=>md5($newpass)),array('user_email'=>$userEmail));
                $to = $userEmail;
                
                $subject = 'Forgotten Password Retrieval';
                $message = 'Hello '.$get_user["firstname"].'<br><br>This email was sent automatically by '.site_name.'
  in response to your request to recover your password. Your new password to access the site is: '.$newpass.'<br>Thanks<br>'.site_name;

                $sendmail =  sendEmail($to, $subject, $message, $shortcodes = null, $from = null,$mail);
                if($sendmail){
                    header("Location: " . main_url . "/forgotpassword/success");
                    exit();
                }
        } else {
            $errmsg_arr[] = 'No such User found in Database!';
            $errflag = true;
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
$tpl->result = $result;
$tpl->errors = $errmsg_arr;
echo $tpl->render("themes/site/" . theme_name . "/html/forgotpassword.php");
