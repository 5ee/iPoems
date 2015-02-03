<?php
require_once(getcwd() . "/core/Facebook/facebook.php");
$facebook = new Facebook(array(
            'appId'  => fb_application_id,
            'secret' => fb_secret_key,
            'cookie' => true,
        ));
$user = $facebook->getUser();

if ($_SESSION['fbid']) {
    $logoutUrl = $facebook->getLogoutUrl(array(
        'next'         => main_url,
        'access_token' => $facebook->getAccessToken()
            ));
    unset($_SESSION['user_id']);
    unset($_SESSION['uname']);
    unset($_SESSION['fbid']);
    session_destroy();
    header("Location: " . $logoutUrl);
}
else {
    unset($_SESSION['user_id']);
    unset($_SESSION['user_name']);
    unset($_SESSION['fullname']);
    session_destroy();
    header("Location: " . main_url);
}
?>