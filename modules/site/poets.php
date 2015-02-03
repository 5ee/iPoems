<?php

$tpl = new bQuickTpl();
include(getcwd() . "/modules/site/common.php");
// Send SEO Data
$tpl->page_title = POETS;
$tpl->page_description =  site_seo_description;
$tpl->keywords =  site_seo_keywords;
$tpl->page_image       = main_url.website_logo;
// Send SEO Data

//--PAGINATION--//
foreach($vars as $var){
    if(strpos($var,'p:')===0){
        $page_no_var = $var;//get the current Page from URL
    }
}
    $perpage = poets_per_page;
    $paginate = paginate($perpage, $page_no_var);
    $next_number = $paginate['next_number'];

//--get all authors--//
$get_poet = get_all_authors($database, $next_number, $perpage); 
$tpl->all_poets = $get_poet;

$count_records = $database->count("authors"); 
$total_pages = ceil($count_records / $perpage); 
$current_count = count($get_poet);

$page_array = array();
$page_array ['current_page']  = $paginate['page_no'];
$page_array ['total_pages']   = $total_pages;
$page_array ['total_records'] = $count_records;
$page_array ['current_count'] = $current_count;
$page_array ['param_vars']    = $vars;
$page_array ['page_no_var']    = $page_no_var;
$tpl->page_array = $page_array;

//$all_topics = $database->select("authors","*", array('status'=>1));
//
//$alphabetically = alphabetically($all_topics,['MAX'=>authors_per_alphabet, 'COUNT'=>true]);
//$tpl->alphabetically = $alphabetically;


echo $tpl->render("themes/site/" . theme_name . "/html/poets.php");


