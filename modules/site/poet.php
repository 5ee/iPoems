<?php

$tpl = new bQuickTpl();
include(getcwd() . "/modules/site/common.php");


//--get author id--//
$author_id = $vars[1];

//--for author id not found in author table--//
if(!$database->has("authors",array("id"=>$author_id))){
    header("Location: ".main_url."/404");exit;
}

foreach($vars as $var){
    if(strpos($var,'p:')===0){
        $page_no_var = $var;//get the current Page from URL
    }
}
//--PAGINATION--//
    $perpage = poems_by_author_per_page;
    $paginate = paginate($perpage, $page_no_var);
    $next_number = $paginate['next_number'];

//--get author informations--//
$author = get_author($database, $author_id);
$tpl->author_info = $author;

//--increment of author views--//
$update_poet = author_view_increment($database, $author_id);

//--get all poems of author--//
$page_poems = get_author_poems($database, $author_id, ['LIMIT'=>array($next_number,$perpage), 'COUNT' => true]);
$tpl->page_poems = $page_poems['data'];

$count_records = $page_poems['count'];
$total_pages = ceil($count_records / $perpage);
$current_count = count($page_poems['data']);

$page_array = array();
$page_array ['current_page']  = $paginate['page_no'];
$page_array ['total_pages']   = $total_pages;
$page_array ['total_records'] = $count_records;
$page_array ['current_count'] = $current_count;
$page_array ['param_vars']    = $vars;
$page_array ['page_no_var']    = $page_no_var;
$tpl->page_array = $page_array;


// Send SEO Data
        if(!$author['seo_title']){
            $tpl->page_title = $author['Author_name'];
        }else{
           $tpl->page_title = $author['seo_title'];
        }
        if(!$author['seo_description']){
            $tpl->page_description = site_seo_description;
        }else{
           $tpl->page_description = $author['seo_description'];
        }
         if(!$author['seo_keywords']){
            $tpl->keywords = site_seo_keywords;
        }else{
           $tpl->keywords = $author['seo_keywords'];
        }
        if(!$author['photo']){
            $tpl->page_image = main_url.website_logo;
        }else{
         $tpl->page_image = main_url.$author['photo'];
        }
        
        // $tpl->page_image = main_url.website_logo;
        // Send SEO Data
echo $tpl->render("themes/site/" . theme_name . "/html/poet.php");