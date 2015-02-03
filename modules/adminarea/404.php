<?php
$tpl =  new bQuickTpl();
include(getcwd()."/modules/adminarea/common.php");
echo $tpl->render("themes/adminarea/html/elements/header.php");
echo $tpl->render("themes/adminarea/html/404.php");
echo $tpl->render("themes/adminarea/html/elements/footer.php");