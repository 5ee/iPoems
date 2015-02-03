<?php

$tpl = new bQuickTpl();
include(getcwd() . "/modules/site/common.php");


//--get poem id--//
$poem_id = $vars[1];

//--for poem id not found in poems table--//
if(!check_poem($database, $poem_id)){
    echo $tpl->render("themes/site/" . theme_name . "/html/404.php");exit;
}
foreach($vars as $var){
    if(strpos($var,'p:')===0){
        $page_no_var = $var;//get the current Page from URL
    }
}
//--increment views of poem--//
$update_poem = view_increment($database, $poem_id);

//--get poem information--//
$get_poem= get_poem($database, $poem_id);   


//--get topic information--//
if($get_poem['topic_id']){
    $poem_topics_array = array();    
    //get topic ids as array
    $poem_topics = unserialize($get_poem['topic_id']);
    foreach($poem_topics as $poem_topic_id){
        if(!array_key_exists($poem_topic_id, $poem_topics_array)){
            $poem_topic_array[$poem_topic_id] = get_topic($database, $poem_topic_id);
        }
    }
    $get_poem['topic_id'] = $poem_topic_array;
}

//--get author information--//
$author_id = $get_poem['author_id'];
if($get_poem['author_id']){
    $get_poem['author_id'] = get_author($database, $get_poem['author_id']);
    $tpl->author_info = $get_poem['author_id'];
}

$tpl->poem = $get_poem;

$get_author_poems = $database->query("select * from poems where author_id='$author_id' ORDER BY RAND() LIMIT 5")->fetchall();
$tpl->author_poems = $get_author_poems;


// Send SEO Data
        if(!$get_poem['seo_title']){
            $tpl->page_title = $get_poem['poem_title'];
        }else{
           $tpl->page_title = $get_poem['seo_title'];
        }
        if(!$author['seo_description']){
            $tpl->page_description = site_seo_description;
        }else{
           $tpl->page_description = $get_poem['seo_description'];
        }
         if(!$get_poem['seo_keywords']){
            $tpl->keywords = site_seo_keywords;
        }else{
           $tpl->keywords = $get_poem['seo_keywords'];
        }
        if(!$get_poem['picture']){
            $tpl->page_image = main_url.website_logo;
        }else{
         $tpl->page_image = main_url.$get_poem['picture'];
        }
        
        // $tpl->page_image = main_url.website_logo;
        // Send SEO Data
echo $tpl->render("themes/site/" . theme_name . "/html/poem.php");
