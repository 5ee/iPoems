<?php
$tpl =  new bQuickTpl();
$tpl->page_title = "Admin Panel - Table Icons";
if(isset($_SESSION['admin_user_id']))
{
	if(isset($_POST) and $_POST)
	{
		$table=$_POST['table'];
		foreach($table as $table_name => $icon_class)
		{
			$database->update("table_icons",array('icon_class'=>$icon_class),array('table_name'=>$table_name));
		}
		header("Location: "._admin_url."/tableicons/success");
	}
}
else
{
	header("Location: ".$main_url."/adminarea/login");
	exit();
}
include(getcwd()."/modules/adminarea/common.php");
echo $tpl->render("themes/adminarea/html/tableicons.php");