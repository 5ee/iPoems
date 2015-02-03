<?php
include(getcwd()."/modules/site/common.php");

if(isset($params[0]) && $params[0] == "xml_sitemap"){
    header("Content-Type: application/xml;");

    echo '<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" 
xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
xsi:schemaLocation="http://www.google.com/schemas/sitemap/0.84 
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
    // Get all Poems
    $get_all_poems = $database->select("poems","*",array("ORDER"=>"id DESC"));
    foreach ($get_all_poems as $poem) {
        echo '<url>
        <loc>'. main_url."/poem/".$poem['id']."/".$poem['poem_slug'] .'</loc>
        <lastmod>' . date("Y-m-d", strtotime($poem['created'])) . '</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.00</priority>
        </url>';
    }
    // Get all Authors
    $get_all_authors = $database->select("authors","*",array("ORDER"=>"id DESC"));
    foreach ($get_all_authors as $author) {
        echo '<url>
        <loc>'. main_url."/poet/".$author['id']."/".$author['Author_slug'] .'</loc>
        <lastmod>' . date("Y-m-d", strtotime($author['created'])) . '</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.00</priority>
        </url>';
    }
    
    // Get all Topics
     $get_all_topics = $database->select("topics","*",array("ORDER"=>"topic_id DESC"));
    foreach ($get_all_topics as $topic) {
        echo '<url>
        <loc>'. main_url."/topic/".$topic['topic_id']."/".$topic['topic_slug'] .'</loc>
        <changefreq>weekly</changefreq>
        <priority>1.00</priority>
        </url>';
    }
    
      // Get all Pages
    $get_all_pages = $database->select("pages","*",array("ORDER"=>"id DESC"));
    foreach ($get_all_pages as $page) {
        echo '<url>
        <loc>'. main_url."/page/".$page['id']."/".$page['page_slug'] .'</loc>
        <lastmod>' . date("Y-m-d", strtotime($page['created'])) . '</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.00</priority>
        </url>';
    }
    
    
 
    echo "</urlset>";

    
}else{
    header("location: ".main_url."/403");
    exit;
}

    
?>