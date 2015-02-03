<?php
include(getcwd() . "/core/nocsrf.php");
$tpl =  new bQuickTpl();
include(getcwd()."/modules/site/common.php");


//--get page information--//
$page_id=$params[1];
$page_info = page_info($database, $page_id);
$tpl->page_info=$page_info[0];



// Send SEO Data
        if(!$page_info[0]['seo_title']){
            $tpl->page_title = $page_info[0]['page_title'];
        }else{
           $tpl->page_title = $page_info[0]['seo_title'];
        }
        if(!$page_info[0]['seo_description']){
            $tpl->page_description = site_seo_description;
        }else{
           $tpl->page_description = $page_info[0]['seo_description'];
        }
         if(!$page_info[0]['seo_keywords']){
            $tpl->keywords = site_seo_keywords;
        }else{
           $tpl->keywords = $page_info[0]['seo_keywords'];
        }
        if(!$page_info[0]['page_image']){
            $tpl->page_image = main_url.website_logo;
        }else{
         $tpl->page_image = main_url.$page_info[0]['page_image'];
        }
        
        // $tpl->page_image = main_url.website_logo;
        // Send SEO Data
echo $tpl->render("themes/site/".theme_name."/html/page.php");
