<?php 
$tpl = new bQuickTpl();
include(getcwd()."/modules/site/common.php");
// Send SEO Data
$tpl->page_title = TOPICS;
$tpl->page_description =  site_seo_description;
$tpl->keywords =  site_seo_keywords;
$tpl->page_image       = main_url.website_logo;
// Send SEO Data

//--get category id--//
$category_id = $vars[1];

//--pagination--//
foreach($vars as $var){
    if(strpos($var,'p:')===0){
        $page_no_var = $var;//get the current Page from URL
    }
}

//$perpage = poems_per_page;
//$paginate = paginate($perpage, $page_no_var);
//$next_number = $paginate['next_number'];

//--get all topics--//
$all_topics = all_topics($database);
$tpl->topicss = $all_topics;


$count_records = $database->count("topics"); 
//$total_pages = ceil($count_records / $perpage); 
$current_count = count($all_topics);

$page_array = array();
$page_array ['current_page']  = $page_no;
$page_array ['total_pages']   = $total_pages;
$page_array ['total_records'] = $count_records;
$page_array ['current_count'] = $current_count;
$page_array ['param_vars']    = $vars;
$page_array ['page_no_var']    = $page_no_var;
$tpl->page_array = $page_array;

echo $tpl->render("themes/site/".theme_name."/html/topics.php");    