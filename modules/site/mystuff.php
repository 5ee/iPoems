<?php

include(getcwd() . "/core/nocsrf.php");
$tpl = new bQuickTpl();
include(getcwd() . "/modules/site/common.php");
// Send SEO Data
$tpl->page_title = USER_STUFF;
$tpl->page_description =  site_seo_description;
$tpl->keywords =  site_seo_keywords;
$tpl->page_image       = main_url.website_logo;
// Send SEO Data
if (isset($_SESSION['user_id'])) {

//--get user id--//    
    $user_id = $_SESSION['user_id'];

//--delete favourite poem--//
    if ($vars[1] == "del_favourite_poem") {
        if ($vars[2]) {
            $module_id = $vars[2];
            $module_type = "poems";
            delete_favourite_poem($database, $module_id, $module_type, $user_id);
            header("location: " . get_url($database, "mystuff"));
        }
    }

//--delete favourite poet--//
    if ($vars[1] == "del_favourite_poet") {
        if ($vars[2]) {
            $module_id = $vars[2];
            $module_type = "author";
            delete_favourite_poem($database, $module_id, $module_type, $user_id);
            header("location: " . get_url($database, "mystuff"));
        }
    }

//--delete saved poem--//    
    if ($vars[1] == "del_saved_poem") {
        if ($vars[2]) {
            $module_id = $vars[2];
            $module_type = "poems";
            delete_saves_poem($database, $module_id, $module_type, $user_id);
            header("location: " . get_url($database, "mystuff"));
        }
    }

//--delete saved poet--//
    if ($vars[1] == "del_saved_poet") {
        if ($vars[2]) {
            $module_id = $vars[2];
            $module_type = "author";
            delete_saves_poem($database, $module_id, $module_type, $user_id);
            header("location: " . get_url($database, "mystuff"));
        }
    }

//--get poems rating given by user--//
    $get_user_given_ratings = user_given_ratings($database, $user_id);
    if (!empty($get_user_given_ratings['poems'])) {
        foreach ($get_user_given_ratings['poems'] as $k => $user_given_rating) {
            $get_user_given_ratings['poems']['poem'][] = get_poem($database, $user_given_rating['id']);
        }
    }
    $tpl->get_rating = $get_user_given_ratings['poems'];


//--get author rating given by user--//
    if (!empty($get_user_given_ratings['author'])) {
        foreach ($get_user_given_ratings['author'] as $k => $user_given_rating) {
            $get_user_given_ratings['author']['author'][] = get_author($database, $user_given_rating['id']);
        }
    }
    $tpl->get_author = $get_user_given_ratings['author'];


//--get poem saved by user--//
    $get_saved = saved_poems($database, $user_id);
    $get_saved_poems = $get_saved['poems'];
    $get_saved_poets = $get_saved['author'];
    if (!empty($get_saved_poems)) {
        foreach ($get_saved_poems as $k => $poem_id) {
            $get_saved_poems[$k] = get_poem($database, $poem_id);
        }
        $tpl->saved_poems = $get_saved_poems;
    }

//--get saved poets--//
    if (!empty($get_saved_poets)) {
        foreach ($get_saved_poets as $k => $poet_id) {
            $get_saved_poets[$k] = get_author($database, $poet_id);
        }
        $tpl->saved_poets = $get_saved_poets;
    }
} else {

    header("location: " . main_url);
}
echo $tpl->render("themes/site/" . theme_name . "/html/mystuff.php");
