<?php
include(getcwd()."/core/nocsrf.php");
$tpl =  new bQuickTpl();

$token = NoCSRF::generate( 'csrf_token' );
$tpl->formtoken = $token;

echo $tpl->formtoken; 
exit;
?>
