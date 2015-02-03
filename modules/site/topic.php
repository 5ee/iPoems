<?php


$tpl = new bQuickTpl();
include(getcwd() . "/modules/site/common.php");


//--check if topic id is received--//
if (isset($vars[1]) && $vars[1]) {
    $topic_id = $vars[1];
} else {
    echo $tpl->render("themes/site/" . theme_name . "/html/404.php");
    exit;
}

//--check if topic exists--//
if (!is_topic($database, $topic_id)) {
    echo $tpl->render("themes/site/" . theme_name . "/html/404.php");
    exit;
}
//--get topic information--//
$get_topic_info = get_topic($database, $topic_id);
$tpl->topic_info = $get_topic_info;

//--pagination--//
foreach ($vars as $var) {
    if (strpos($var, 'p:') === 0) {
        $page_no_var = $var; //get the current Page from URL
    }
}
$perpage = poems_by_topic_per_page;
$paginate = paginate($perpage, $page_no_var);
$next_number = $paginate['next_number'];



//--get poems by topics--//
$get_topic_poems = get_topic_poems($database, $topic_id, array("COUNT" => true, "LIMIT" => array($next_number, $perpage)));

$count_records = $get_topic_poems['count'];
$total_pages = ceil($count_records / $perpage);
$current_count = $get_topic_poems['present_count'];

$page_array = array();
$page_array ['current_page'] = $paginate['page_no'];
$page_array ['total_pages'] = $total_pages;
$page_array ['total_records'] = $count_records;
$page_array ['current_count'] = $current_count;
$page_array ['param_vars'] = $vars;
$page_array ['page_no_var'] = $page_no_var;
$tpl->page_array = $page_array;


//--get poem data--//
if (!empty($get_topic_poems['data'])) {
    $topic_poems_info = array();
    //get poems information for each poem received
    foreach ($get_topic_poems['data'] as $poem_id) {
        if (check_poem($database, $poem_id)) {
            $topic_poems_info[] = get_poem($database, $poem_id);
        }
    }
}
$tpl->topic_poems_info = $topic_poems_info;

//--get all topics and count poem of topic--//
$get_sidebar_topics = all_topic($database);
//--count sidebar topics poems--//
if (!empty($get_sidebar_topics)) {
    foreach ($get_sidebar_topics as $key => $sidebar_topic) {
        $sidebar_topic_id = $sidebar_topic['topic_id'];
        $get_sidebar_topics[$key]['poems_count'] = get_topic_poems($database, $sidebar_topic_id, array("ONLYCOUNT" => TRUE));
    }
}
$tpl->sidebar_topics = $get_sidebar_topics;


// Send SEO Data
        if(!$get_topic_info['seo_title']){
            $tpl->page_title = $get_topic_info['topic_name'];
        }else{
           $tpl->page_title = $get_topic_info['seo_title'];
        }
        if(!$get_topic_info['seo_description']){
            $tpl->page_description = site_seo_description;
        }else{
           $tpl->page_description = $get_topic_info['seo_description'];
        }
         if(!$get_topic_info['seo_keywords']){
            $tpl->keywords = site_seo_keywords;
        }else{
           $tpl->keywords = $get_topic_info['seo_keywords'];
        }
        if(!$get_topic_info['picture']){
            $tpl->page_image = main_url.website_logo;
        }else{
         $tpl->page_image = main_url.$get_topic_info['picture'];
        }
        
        // $tpl->page_image = main_url.website_logo;
        // Send SEO Data
echo $tpl->render("themes/site/" . theme_name . "/html/topic.php");
