<?php

if (isset($_GET['action'])) {
    $tpl = new bQuickTpl();
    $vars = explode("/", $_GET['action']);
    $tpl->params = $vars;
}
$tpl->site_name = site_name;
require_once(getcwd() . "/includes/site-actions/site-actions.php");
require_once(getcwd() . "/includes/site_functions.php");
// update jokes views
//aliases
$tpl->aliases = $aliases;

//aliases_flip
$aliases_flip = array_flip($aliases);
$tpl->aliases_flip = $aliases_flip;

//Facebook Login Starts
require_once(getcwd() . "/core/Facebook/facebook.php");

$facebook = new Facebook(array(
    'appId' => fb_application_id,
    'secret' => fb_secret_key,
    'cookie' => true,
    'fileUpload' => true,
    '' => ''
        ));
$user = $facebook->getUser(); //get User ID
//Reidrecting the page to page after getting access from Facebook
if (isset($_GET['code']) and $_GET['code'] != '') {
    $user = $facebook->getUser();

    echo "<script type='text/javascript'>top.location.href = '" . main_url . "';</script>";
    exit;
}

//Redirecting the page to page after getting access from Facebook

if ($user) {
    if (isset($_SESSION['fbid']) && isset($_SESSION['uid']) && isset($_SESSION['uname'])) {
        $user_profile = $facebook->api('/me');
        $tpl->user_profile = $user_profile;
    } else {
        try {
            $user_profile = $facebook->api('/me');
            $tpl->user_profile = $user_profile;


            if (isset($user_profile) and ($user_profile)) {
                $existingUser = $database->select("users", array("id", "fb_id", "fullname"), array("fb_id" => $user));

                if (count($existingUser) == 0) {

                                       //insert data 
                    $data['fb_id']        = $user_profile['id'];
                    $data['firstname']    = $user_profile['first_name'];
                    $data['lastname']     = $user_profile['last_name'];
                    $data['fullname']     = $user_profile['name'];
                    $data['user_email']   = $user_profile['email'];
                    if($user_profile['birthday']){
                        $data['birthday']     = $user_profile['birthday']; 
                    }
                    if($user_profile['gender']){
                        $data['gender']     = $user_profile['gender']; 
                    }
                   
                 
                    $data['access_token'] = $facebook->getAccessToken();
                    $data['status']       = 1;
                    //insert data

                    $last_user_id = $database->insert("users", $data);
                    $userinfo = $database->select("users", array("id", "fb_id", "fullname"), array("id" => $last_user_id));
                    $_SESSION['user_id'] = $userinfo[0]['id'];
                    $_SESSION['uname'] = $userinfo[0]['fullname'];
                    $_SESSION['fbid'] = $userinfo[0]['fb_id'];

                    // post to wall facebook
                    $_attachment = array(
                        'message' => firsttime_registration_message,
                        'picture' => main_url . '/themes/site/' . theme_name . '/images/' . logo_post_fb,
                        'link' => main_url,
                        'name' => site_name,
                        'description' => description_post_fb,
                    );

                    $ret_obj = $facebook->api('/me/feed', 'POST', $_attachment);
                    //end post fb 
                } else {
                    $_SESSION['user_id'] = $existingUser[0]['id'];
                    $_SESSION['uname'] = $existingUser[0]['fullname'];
                    $_SESSION['fbid'] = $existingUser[0]['fb_id'];
                }
            }
        } catch (FacebookApiException $e) {
            error_log($e);
            $user = null;
        }
    }
}

// Login or logout url will be needed depending on current user state.
if ($user) {
    $logoutUrl = $facebook->getLogoutUrl(array(
        'next' => main_url,
        'access_token' => $facebook->getAccessToken()
    ));
    $tpl->logoutUrl = $logoutUrl;
} else {

    $loginUrl = $facebook->getLoginUrl(array(
        'scope' => 'email'
    ));
    $tpl->loginUrl = $loginUrl;
}
//Facebook Login Ends


if (isset($_POST['action'])) {
    extract($_POST);
    if ($action == 'get_topic_quotes_count') {
        echo get_topic_quotes($database, $topic_id, array('ONLYCOUNT' => true));
    }
    //--login for save poem--//
    if ($action == 'add_poem') {//username, password
        $errmsg_arr = array();
        $error_trgr = false;
        $return_array = array();
        //Clean the input data
        $email = clean($_POST['email']);
        $password = clean($_POST['password']);
        if (!$email) {
            $errmsg_arr[] = 'User email is missing';
            $error_trgr = true;
        }
        if (!$password) {
            $errmsg_arr[] = 'Password is missing';
            $error_trgr = true;
        }
        if ($error_trgr == false) {
            $get_user = $database->get("users", "*", array("AND" => array("user_email" => $email, "password" => md5($password), "status" => '1')));
            if (!empty($get_user)) {
                //Set session
                $return_array['status'] = "success";
                $_SESSION['user_id'] = $get_user['id'];
                $_SESSION['full_name'] = $get_user['fullname'];
                $_SESSION['user_email'] = $get_user['user_email'];
            } else {
                $errmsg_arr[] = 'No such User found in Database!';
                $return_array['status'] = "error";
                $return_array['error'] = $errmsg_arr;
            }
        } else {
            $return_array['status'] = "error";
            $return_array['error'] = $errmsg_arr;
        }
        echo json_encode($return_array);
    }

    //--save favourites poem--//
    if ($action == "add_fav_poem") {
        $user_id = $_SESSION['user_id'];
        if ($user_id) {
            if (!$database->has("saves", array("AND" => array("user_id" => $user_id, "module_type" => "poems", "module_id" => $poem_id)))) {
                $ins_id = $database->insert("saves", array("user_id" => $user_id, "module_type" => "poems", "module_id" => $poem_id, "ip" => getRealIp()));
                if ($ins_id)
                    echo 1;
                else
                    echo 0;
            }
        }
    }

    //--save favourites poet--//
    if ($action == "add_fav_poet") {
        $user_id = $_SESSION['user_id'];
        if ($user_id) {
            if (!$database->has("saves", array("AND" => array("user_id" => $user_id, "module_type" => "author", "module_id" => $poet_id)))) {
                $ins_id = $database->insert("saves", array("user_id" => $user_id, "module_type" => "author", "module_id" => $poet_id, "ip" => getRealIp()));
                if ($ins_id)
                    echo 1;
                else
                    echo 0;
            }
        }
    }

    //--poem post to facebook--//
    if ($action == 'post_to_facebook') {
        $fbid = $_SESSION['fbid'];
        if ($fbid) {
            $poem_for_post = $database->get("poems", "*", array("id" => $poem_id));
            $_share = array(
                'message' => clean($poem_for_post['poem_title']),
                'link' => clean(get_url($database, "poem", $poem_id, $poem_for_post['poem_slug'])),
                'name' => clean(site_name),
                'description' => clean(strip_tags($poem_for_post['poem'])),
            );
            $access_token = $facebook->getAccessToken();

            $uploadPhoto = $facebook->api('/me/feed', 'POST', $_share);

            if ($uploadPhoto) {
                //$database->insert('cover_applies',array('cover_id' => $cover_id, 'user_id' => $user));
                $jsonurl = "https://graph.facebook.com/" . $uploadPhoto["id"] . "&?access_token=" . $access_token;
                $json = file_get_contents($jsonurl, 0, null, null);
                $json_output = json_decode($json);
                echo $uploadPhoto["id"];
            }
        }
    }
    //end post fb
}

//--fetch all pages--// 
$all_pages = all_pages($database);
$tpl->all_pages = $all_pages;

//--fetch all topic with limit--//
$get_topics = all_topic($database);
$tpl->all_topics = $get_topics;

//--fetch all author with limit--//
$get_author = all_author($database);
$tpl->all_author = $get_author;

//--get poem of the day--//
$get_poem_of_day = poem_of_day($database);
$tpl->poem_of_day = $get_poem_of_day;

//--get user information--//
$user_image = get_user_info($database);
$tpl->user_image = $user_image;

//--get ad_zones--//
$getads = get_ad_zones($database);
$tpl->ads = $getads;

function showad($id, $getads) {
    foreach ($getads as $k => $v) {
        if (array_key_exists('id', $v)) {
            if ($v['id'] == $id) {
                 echo "<center>".$v['Ad_Code']."</center>";
            }
        }
    }
}

?>
