<?php

include(getcwd() . "/modules/site/common.php");

if (isset($params[0]) && $params[0] == "sitemap") {

    //Get all Poems
    $array_record = array();
    $get_all_poem = $database->select("poems", "*", array("ORDER" => "id DESC"));
    foreach ($get_all_poem as $poem) {
        $array_sub = array();
        $array_sub['title'] = text_limit($poem['poem_title'], 100);
        $array_sub['url'] = main_url . "/poem/" . $poem['id'] . "/" . $poem['poem_slug'];
        $array_record[] = $array_sub;
    }

    $tpl->poem_urls = $array_record;

    // Get all Authors
    $array_record = array();
    $get_all_author = $database->select("authors", "*", array("ORDER" => "id DESC"));
    foreach ($get_all_author as $author) {
        $array_sub = array();
        $array_sub['title'] = $author['Author_name'];
        $array_sub['url'] = main_url . "/poet/" . $author['id'] . "/" . $author['Author_slug'];
        $array_record[] = $array_sub;
    }
    $tpl->author_urls = $array_record;


    // Get all Topics
    $array_record = array();
    $get_all_topic = $database->select("topics", "*", array("ORDER" => "topic_id DESC"));
    foreach ($get_all_topic as $topic) {
        $array_sub = array();
        $array_sub['title'] = $topic['topic_name'];
        $array_sub['url'] = main_url . "/topic/" . $topic['topic_id'] . "/" . $topic['topic_slug'];
        $array_record[] = $array_sub;
    }
    $tpl->topic_urls = $array_record;
  

    // Get all Pages
    $array_pages = array();
    $get_all_pages = $database->select("pages", "*", array("ORDER" => "id DESC"));
    foreach ($get_all_pages as $page) {
        $array_sub = array();
        $array_sub['title'] = $page['page_title'];
        $array_sub['url'] = main_url . "/page/" . $page['id'] . "/" . $page['page_slug'];
        $array_pages[] = $array_sub;
    }
    $tpl->page_urls = $array_pages;


    $tpl->page_title = "Sitemap";
    echo $tpl->render("themes/site/" . theme_name . "/html/sitemap.php");
} else {
    header("location: " . main_url . "/403");
    exit;
}
?>