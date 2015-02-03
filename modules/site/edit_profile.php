<?php

include(getcwd() . "/core/nocsrf.php");
$tpl = new bQuickTpl();
include(getcwd() . "/modules/site/common.php");

// Send SEO Data
$tpl->page_title = EDIT_PROFILE;
$tpl->page_description =  site_seo_description;
$tpl->keywords =  site_seo_keywords;
$tpl->page_image       = main_url.website_logo;
// Send SEO Data


//--checking session id--//
if (isset($_SESSION['user_id'])) {

    if (isset($_SESSION['user_id'])) {
        if (isset($_SESSION['user_id'])) {
            $user = $database->select("users", "*", array("id" => $_SESSION['user_id']));
        } elseif (isset($_SESSION['fbid'])) {
            $user = $database->select("users", "*", array("id" => $_SESSION['uid']));
        }
        $tpl->user_data = $user;
//pr($user);
//--explode fullname--//
        $fullname = explode(" ", $user[0]['fullname']);
        $tpl->firstname = $fullname[0];
        $tpl->lastname = $fullname[1];
//pr($fullname);

        $errmsg_arr = array();
        $errflag = false;

//--edit profile for user--//
        if (isset($_POST) && $_POST) {
            try {
                NoCSRF::check('csrf_token', $_POST, true, 60 * 10, false);
                //$result = 'CSRF check passed. Form parsed.';
                $firstname = clean($_POST['data']['firstname']);
                $lastname = clean($_POST['data']['lastname']);
                $user_email = clean($_POST['data']['user_email']);
                $birthdate = clean($_POST['data']['birthday']);
                $fullname = $firstname . " " . $lastname;
               
               // pr($_POST['data']);
                if (!$firstname) {
                    $errmsg_arr[] = 'Please enter firstname!';
                    $errflag = true;
                }
                if (!$lastname) {
                    $errmsg_arr[] = 'Please enter lastname!';
                    $errflag = true;
                }
                if (!$user_email) {
                    $errmsg_arr[] = 'Please enter user email!';
                    $errflag = true;
                }
                if (!$birthdate) {
                    $errmsg_arr[] = 'Please enter birthdate!';
                    $errflag = true;
                }            
                //--upload image--//
                if (isset($_FILES['data']['name']) and ($_FILES['data']['name']) and $_FILES['data']['name']['picture'] != "") {
                    $name_key = array_keys($_FILES['data']['name']);

                    foreach ($_FILES['data'] as $key => $value) {
                        $uploads[$name_key[0]][$key] = $value[$name_key[0]];
                    }
                    if ($name_key[0] == "picture") {
                        $image_path = upload_img2("", $uploads[$name_key[0]], "user_pics");
                    } elseif ($name_key[0] == "Video_URL") {
                        $image_path = upload_img2("", $uploads[$name_key[0]], "video_images");
                    } else {
                        $image_path = upload_img2("", $uploads[$name_key[0]], "misc");
                    }
                    $_POST['data'][$name_key[0]] = $image_path['urls'][0];
                    if ($_POST['data']['picture']) {
                        $_SESSION['picture'] = $_POST['data']['picture'];
                    }
                }
                if ($errflag) {
                    $tpl->errors = $errmsg_arr;
                } else {
                    $user_id = clean($_SESSION['user_id']);
                    $user_data = array();
                    $user_data['firstname'] = $firstname;
                    $user_data['lastname'] = $lastname;
                    $user_data['user_email'] = $user_email;
                    $user_data['birthday'] = $birthdate;
                    $user_data['fullname'] = $fullname;
                    //pr($user);
                    if ($_POST['data']['picture']){
                    $user_data['picture'] = clean($_POST['data']['picture']);
                    }else {
                       $user_data['picture'] = clean($user[0]['picture']) ;
                    }
                    echo $_POST['data']['picture'];
                    //pr($user_data);die;
                     
                    $edit_profile = edit_profile($database, $user_data, $user_id);
                   
                    if ($edit_profile) {
                        header("Location: " . main_url . "/edit_profile/success");
                    }
                    //}else{
                    
                    //If there are input validations, redirect back to the register form             
                }
            } catch (Exception $e) {
                // CSRF attack detected
                $result = $e->getMessage() . ' Form ignored.';
            }
        }
    } elseif (isset($_SESSION['fbid'])) {
        if (isset($_POST) && $_POST) {
            try {
                NoCSRF::check('csrf_token', $_POST, true, 60 * 10, false);
                        
                $firstname = clean($_POST['data']['firstname']);
                $lastname = clean($_POST['data']['lastname']);
                $user_email = clean($_POST['data']['user_email']);
                $birthdate = clean($_POST['data']['birthday']);
                $fullname = $firstname . " " . $lastname;
               
                if (!$firstname) {
                    $errmsg_arr[] = 'Please enter firstname!';
                    $errflag = true;
                }
                if (!$lastname) {
                    $errmsg_arr[] = 'Please enter lastname!';
                    $errflag = true;
                }
                if (!$user_email) {
                    $errmsg_arr[] = 'Please enter user email!';
                    $errflag = true;
                }
                if (!$birthdate) {
                    $errmsg_arr[] = 'Please enter birthdate!';
                    $errflag = true;
                }
                //--upload image--//
                if (isset($_FILES['data']['name']) and ($_FILES['data']['name']) and $_FILES['data']['name']['picture'] != "") {
                    $name_key = array_keys($_FILES['data']['name']);
                    foreach ($_FILES['data'] as $key => $value) {
                        $uploads[$name_key[0]][$key] = $value[$name_key[0]];
                    }
                    if ($name_key[0] == "picture") {
                        $image_path = upload_img2("", $uploads[$name_key[0]], "user_pics");
                    } elseif ($name_key[0] == "Video_URL") {
                        $image_path = upload_img2("", $uploads[$name_key[0]], "video_images");
                    } else {
                        $image_path = upload_img2("", $uploads[$name_key[0]], "misc");
                    }
                    $_POST['data'][$name_key[0]] = $image_path['urls'][0];
                    if ($_POST['data']['picture']) {
                        $_SESSION['picture'] = $_POST['data']['picture'];
                    }
                }
                if ($errflag) {
                    $tpl->errors = $errmsg_arr;
                } else {
                    $user_id = clean($_SESSION['user_id']);
                    $user_data = array();
                    $user_data['firstname'] = $firstname;
                    $user_data['lastname'] = $lastname;
                    $user_data['user_email'] = $user_email;
                    $user_data['birthday'] = $birthdate;
                    $user_data['fullname'] = $fullname;
                    $user_data['picture'] = clean($_POST['data']['picture']);

                    if (!$_POST['data']['picture'] == "") {
                    $edit_profile = edit_profile($database, $user_data, $user_id);
                   
                    if ($edit_profile) {
                        header("Location: " . main_url . "/edit_profile/success");
                    }
                    }else{
                    }
                    //If there are input validations, redirect back to the register form       
                }
            } catch (Exception $e) {
                // CSRF attack detected
                $result = $e->getMessage() . ' Form ignored.';
            }
        }
    } else {
        $result = 'No post data yet.';
    }
} else {
    header("location: " . main_url);
}
$token = NoCSRF::generate('csrf_token');
$tpl->formtoken = $token;
echo $tpl->render("themes/site/" . theme_name . "/html/edit_profile.php");
