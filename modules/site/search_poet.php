<?php

include(getcwd() . "/core/nocsrf.php");
$tpl = new bQuickTpl();
include(getcwd() . "/modules/site/common.php");
//setting site information
// Send SEO Data
$tpl->page_title = SEARCH_POET;
$tpl->page_description =  site_seo_description;
$tpl->keywords =  site_seo_keywords;
$tpl->page_image       = main_url.website_logo;
// Send SEO Data

//pagination
if (isset($vars[1]) && $vars[1]) {
    $page_no_var = $vars[1];
}

$perpage = search_poems_per_page;
$paginate = paginate($perpage, $page_no_var);
$next_number = $paginate['next_number'];

if (isset($_POST) && $_POST) {
//    try {
//        NoCSRF::check('csrf_token', $_POST, true, 60 * 10, false);
//        $result = 'CSRF check passed. Form parsed.';

    $keyword = clean($_POST['keyword1']);
    if (!$keyword) {
        header("location:" . main_url . "/poets/search_error");
    }
    $_SESSION['keyword'] = $keyword;
    if ($keyword != "") {
        $query_count = "select * from authors where Author_name like '%$keyword%'";
        $get_count_records = $database->query($query_count)->fetchAll();

        $query_search = "select * from authors where Author_name like '%$keyword%' LIMIT $next_number, $perpage";
        $get_records = $database->query($query_search)->fetchAll();

        $tpl->page_title = "Search Results For" . ' "' . $keyword . '"';
    } else {
        $errmsg_arr = "You have not entered any keyword. Please enter keyword and try again !.";
        $tpl->errors = $errmsg_arr;
    }
    $tpl->keyword = $keyword;
    //pr($query_search);
//    }
//    catch (Exception $e) {
//        // CSRF attack detected
//        $result = $e->getMessage() . ' Form ignored.';
//    }
} else {
    // $result = 'No post data yet.';

    if (isset($_SESSION['keyword']) && $_SESSION['keyword']) {
        //When use pagination for search result
        $keyword_pagination = $_SESSION['keyword'];
        $query_count = "select * from authors where Author_name like '%$keyword_pagination%'";
        $get_count_records = $database->query($query_count)->fetchAll();

        $query_search = "select * from authors where Author_name like '%$keyword_pagination%' LIMIT $next_number, $perpage";
        $get_records = $database->query($query_search)->fetchAll();

        $tpl->page_title = "Search Results For" . ' "' . $keyword_pagination . '"';
    }
    $tpl->keyword = $keyword_pagination;
}

$tpl->search_results = $get_records;
$token = NoCSRF::generate('csrf_token');
$tpl->formtoken = $token;

echo $tpl->render("themes/site/" . theme_name . "/html/search_poet.php");
?>
