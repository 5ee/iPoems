<?php
include(getcwd()."/modules/site/common.php");
header("Content-Type: application/xml;");
echo "<?xml version='1.0' encoding='UTF-8'?>";

if(isset($params[0]) && $params[0] == "rss"){
   echo "<rss version='2.0' xmlns:atom='http://www.w3.org/2005/Atom'>
        <channel>
        <title>".site_name." | RSS</title>
        <link>".main_url."</link>
        <description>RSS for ".site_name."</description>
        <language>en-us</language>"; 
   
   
   
   
   $get_latest_poems = $database->select("poems","*",array("ORDER"=>"id DESC","LIMIT"=>rss_items));
   foreach($get_latest_poems as $poem){
        echo '<item>';
        echo '<guid>'. main_url."/poem/".$poem['id']."/".$poem['poem_slug'] .'</guid>';
        echo '<title>' . $poem['poem_title'] . '</title>';
        echo '<description><![CDATA[' . strip_tags($poem['poem']) . ']]></description>';
        echo '<link>'. main_url."/poem/".$poem['id']."/".$poem['poem_slug'] .'</link>';
        echo '<atom:link href="' . main_url.'/rss" rel="self" type="application/rss+xml" />';
        echo '<pubDate>' . date("D, d M Y H:i:s O", strtotime($poem['created'])) . '</pubDate>';
        echo '</item>';
    }
    
   
   
   echo "</channel></rss>"; 
   
}else{
    header("location: ".main_url."/403");
    exit;
}
