<?php
$tpl =  new bQuickTpl();
$tpl->page_title = "Admin Panel - Backup &amp; Restore";

if(!isset($_SESSION['admin_user_id'])){
	header("Location: "._admin_url."/login");
	exit();
}
//get contents of backup folder
$backup_files = directory_contents(getcwd()."/config/backup_restore" , "sql");
//pr($params);
if(isset($params[2]) && $params[2]=='backup'){
	$backup = backup_db($database);
	if($backup)
	header("Location: "._admin_url."/backup_restore/success/backup");
	else
	header("Location: "._admin_url."/backup_restore/error/backup");
}

if(isset($params[2]) && $params[2]=='restore'){
	$restore = restore_db($database);
	if($restore)
	header("Location: "._admin_url."/backup_restore/success/restore");
	else
	header("Location: "._admin_url."/backup_restore/error/restore");
}

$tpl->backup_files = $backup_files;
include(getcwd()."/modules/adminarea/common.php");
echo $tpl->render("themes/adminarea/html/backup_restore.php");
