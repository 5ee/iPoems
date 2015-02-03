<?php
$tpl =  new bQuickTpl();
$tpl->page_title = "Admin Panel";
$status = "none";
$tpl->status = $status; 
function sortMultiArrayByKey($argArray, $argKey, $argOrder=SORT_DESC ){
        foreach ($argArray as $key => $row){
        $key_arr[$key] = $row[$argKey];
        }
        array_multisort($key_arr, $argOrder, $argArray);
        return $argArray;
 }

if(!isset($_SESSION['admin_user_id'])){
	header("Location: "._admin_url."/login");
	exit();
}
//$a = export($database);

//Poems
$poems = $database->count("poems",array("status"=>"1"));
$comments = $database->count("comments",array("status"=>"1"));
$users = $database->count("users",array("status"=>"1"));
$likes = $database->count("like_dislike",array("liked"=>"1"));
$dislikes = $database->count("like_dislike",array("dislike"=>"1"));
//$categories = $database->count("poems_topics",array("status"=>"1"));echo $categories;

$total['poems'] = $poems;
$total['comments'] = $comments;
$total['users'] = $users;
$total['likes'] = $likes;
$total['dislikes'] = $dislikes;
//$total['categories'] = $categories;


$tpl->total = $total;

 


$get_more_liked = $database->select('like_dislike','*',array("dislike"=>"1"));//pr($get_more_liked);


$total_likes = $database->select("like_dislike","module_id",array("liked"=>"1"));
$total_likes_count = array_count_values($total_likes);
$get_poems = $database->select("poems","*",array("status"=>"1"));
//pr($get_poems);
foreach($get_poems as $key =>$val){
    $get_poems[$key]["like"] = $total_likes_count[$val['id']];
    $get_poems[$key]["dislike"] = $database->count("like_dislike",array("AND"=>array("module_id"=>$val['id'],"dislike"=>1)));
}
$a = sortMultiArrayByKey($get_poems,"like");
$b = array_slice($a,0,5);
$tpl->get_more_liked = $b;//pr($b);   



//sort($count_module, ksort($count_module));


//pr($count_module);

 //$get_more_liked1 = sortMultiArrayByKey($get_more_liked, 'liked');
//$tpl->get_more_liked = $get_more_liked;
if($params[2] == 'export_data'){ 
	$file = fopen('config/installer/'.$a['file_name'],'w');
	fwrite($file,$a['file_contents']);
	header('Location: '._admin_url."/index/success");
}


//get latest status
$get_latest_status = $database->select("poems","*",array("status"=>"1","ORDER"=>"id DESC","LIMIT"=>5));
$tpl->get_latest_status = $get_latest_status;
//pr($get_latest_status);
//top rated riddles

$get_all_reviews = $database->select("ratings","module_id");
$b = array_unique($get_all_reviews);
foreach($b as $k=>$v){
    $get_value = $database->select("ratings","value",array("module_id"=>$v));
    $m = array_sum($get_value)/count($get_value);
    $get_ratings[$v]["id"] = $v;
    $get_ratings[$v]["ratings"] = $m;
}

$arr2 = sortMultiArrayByKey($get_ratings,"ratings");
$top_rated = array_slice($arr2,0,5);
foreach($top_rated as $ke=>$va){
    $top_rated_status = $database->get("poems","poem_title",array("id"=>$va['id']));
    $top_rated[$ke]['info'] =  $top_rated_status;
}
//pr($top_rated);
$tpl->top_rated = $top_rated;
include(getcwd()."/modules/adminarea/common.php");
echo $tpl->render("themes/adminarea/html/index.php");
