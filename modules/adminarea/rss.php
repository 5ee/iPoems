<?php
include(getcwd()."/modules/adminarea/common.php");


$getlists = $database->select("lists", "*",array("LIMIT"=>20,"ORDER"=>"id DESC"));
pr($getlists);
