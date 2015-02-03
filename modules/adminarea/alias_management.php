<?php
$tpl =  new bQuickTpl();
$tpl->page_title = "Admin Panel - Alias Management";
if(!isset($_SESSION['admin_user_id'])){
	header("Location: "._admin_url."/login");
	exit();
}
include(getcwd()."/modules/adminarea/common.php");

$get_aliases = $database->select('module_alias','*');
$tpl->aliases = $get_aliases;





echo $tpl->render("themes/adminarea/html/alias_management.php");
