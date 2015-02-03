<?php

include(getcwd() . "/core/nocsrf.php");
$tpl = new bQuickTpl();
include(getcwd() . "/modules/site/common.php");
// Send SEO Data
$tpl->page_title = SUBMISSION;
$tpl->page_description =  site_seo_description;
$tpl->keywords =  site_seo_keywords;
$tpl->page_image       = main_url.website_logo;
// Send SEO Data

//--fetch all topics--//
$fetch_all_topics = all_topics($database);
$tpl->all_topics = $fetch_all_topics;

//--fetch all authors--//  
$fetch_all_authors = all_authors($database);
$tpl->all_authors = $fetch_all_authors;




foreach ($vars as $var) {
    if (strpos($var, 'p:') === 0) {
        $page_no_var = $var; //get the current Page from URL
    }
}
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $errmsg_arr = array();
    $errflag = false;

    if (isset($_POST) && $_POST) {
        try {
            NoCSRF::check('csrf_token', $_POST, true, 60 * 10, false);
            $title = clean($_POST['data']['poem_title']);
            $poem = clean($_POST['data']['poem']);
            $topic = clean($_POST['data']['topic']);
            $author = clean($_POST['data']['author']);

            //Form validate

            if (!$_POST['data']['poem_title']) {
                $errmsg_arr[] = 'Please enter Poem Title!';
                $errflag = true;
            }
            if (!$_POST['data']['poem']) {
                $errmsg_arr[] = 'Please enter Poem!';
                $errflag = true;
            }

            if ($errflag) {
                $tpl->errors = $errmsg_arr;
            } else {
                $data_insert = array();
                $data_insert['user_id'] = clean($user_id);
                $data_insert['author_id'] = $author;
                $data_insert['topic_id'] = $topic;
                $data_insert['poem_title'] = $title;
                $data_insert['poem'] = $poem;
                //$data_insert['picture'] = clean($_POST['data']['picture']);
                $userdata = insert_submission($database, $data_insert);
                if ($userdata) {
                    header("Location: " . main_url . "/submission/success");
                }
            }
        } catch (Exception $e) {
            // CSRF attack detected
            $result = $e->getMessage() . ' Form ignored.';
        }
    }
} else {

    header("location: " . main_url);
}

$token = NoCSRF::generate('csrf_token');
$tpl->formtoken = $token;
echo $tpl->render("themes/site/" . theme_name . "/html/submission.php");
