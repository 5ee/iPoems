<?php
$tpl =  new bQuickTpl();
include(getcwd()."/modules/adminarea/common.php");

$table_name = $vars[2];
$record_id = $vars[3];
$record_id = str_replace("rec:","",$record_id);

$primary_key = $database->getPKID($table_name);

$getrecord_info = $database->select($table_name, "*", array($primary_key => $record_id));

$getleast_id =  $database->select($table_name, $primary_key, array("ORDER"=> $primary_key." ASC", "LIMIT" => 1));
$gethighest_id =  $database->select($table_name, $primary_key, array("ORDER"=> $primary_key." DESC", "LIMIT" => 1));

$last_id = $database->select($table_name, $primary_key, array($primary_key."[<]" => $record_id,"ORDER"=> $primary_key." DESC", "LIMIT" => 1));


$next_id = $database->select($table_name, $primary_key, array($primary_key."[>]" => $record_id,"ORDER"=> $primary_key." ASC", "LIMIT" => 1));

$next = "";
$last = "";
if(isset($last_id[0]) && $last_id[0]){
	$last = $last_id[0];
	}
if(isset($next_id[0]) && $next_id[0]){
	$next = $next_id[0];
	}
$custom_data= array();
//pr($get_another_data);exit;
foreach($get_another_data as $stuff){
	if($stuff['main_table'] == $table_name){
		$query_complete = $database->select($stuff['secondary_table'],"*");
		$custom_data[$stuff['main_field']]['data'] = $query_complete;
		$custom_data[$stuff['main_field']]['attributes']['seconday_field'] = $stuff['secondary_field'];
		$custom_data[$stuff['main_field']]['attributes']['value'] = $stuff['value'];
		$custom_data[$stuff['main_field']]['attributes']['secondary_table'] = $stuff['secondary_table'];
	}
}	


$tpl->lowest_id = $getleast_id[0];
$tpl->highest_id = $gethighest_id[0];
$tpl->last_id = $last;
$tpl->next_id = $next;

$tpl->current_record = $record_id;


$tpl->page_title = "Detail Page";
$tpl->tb_primaryid =  $primary_key;
$tpl->record_info =  $getrecord_info[0];
$tpl->table_name =  $table_name;
$tpl->custom_data = $custom_data;





include(getcwd()."/modules/adminarea/common.php");
echo $tpl->render("themes/adminarea/html/detail.php");
