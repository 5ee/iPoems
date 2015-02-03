<?php

include(getcwd() . "/core/nocsrf.php");
$tpl = new bQuickTpl();
include(getcwd() . "/modules/site/common.php");
// Send SEO Data
$tpl->page_title = HOME;
$tpl->page_description =  site_seo_description;
$tpl->keywords =  site_seo_keywords;
$tpl->page_image       = main_url.website_logo;
// Send SEO Data

//auto_serialize($database, "poems", "categories", "category_id");
$get_recent_poems = $database->select("poems", "*", array('LIMIT' => recent_poems_count, "ORDER" => "id DESC"));
if (!empty($get_recent_poems)) {
    foreach ($get_recent_poems as $key => $recent_poem) {
        if ($recent_poem['author_id']) {
            $get_recent_poems[$key]['author_id'] = get_author($database, $recent_poem['author_id']);
        }
    }
}
$tpl->recent_poems = $get_recent_poems;

$get_popular = get_top_rated($database, array("LIMIT" => 5));
//pr($get_popular);
$popular_poets = $get_popular['author'];
if (!empty($popular_poets)) {
    $poet_info = array();
    foreach ($popular_poets as $poet_id) {
        $poet_info[] = get_author($database, $poet_id);
    }

    foreach ($poet_info as $key => $v) {
        $rating = avg_rating("author", $v['id'], $database);
        $poet_info[$key]['rating'] = $rating;
    }
    $poet_info = sortMultiArrayByKey($poet_info, "rating");
    $tpl->popular_poets = $poet_info;
}






$popular_poems = $get_popular['poems'];
if (!empty($popular_poems)) {
    $poem_info = array();
    foreach ($popular_poems as $poem_id) {
        $poem_info[] = get_poem($database, $poem_id);
    }
    foreach ($poem_info as $key => $v) {
        $rating = avg_rating("poems", $v['id'], $database);
        $poem_info[$key]['rating'] = $rating;
    }
    $poem_info = sortMultiArrayByKey($poem_info, "rating");
    $tpl->popular_poems = $poem_info;
}

echo $tpl->render("themes/site/" . theme_name . "/html/index.php");
