<?php
$tpl =  new bQuickTpl();
$tpl->page_title = "Download CSV";
include(getcwd()."/modules/adminarea/common.php");


if(isset($_SESSION['admin_user_id'])){
	
  			if(isset($vars[3]) && $vars[3] == "true"){
				
				
			$file = $vars[2]."_"; 
			$csv_output = "";
			
			$result = $database->getColumns($vars[2]);
			$i = 0;
			foreach($result as $row){
				$csv_output .= $row['Field'].", ";
				$i++;
			}
			$csv_output .= "\n";	
			
			$values = $database->select($vars[2],"*");
			
						
			foreach($values as $value1){
				foreach($value1 as $k=>$v){
					$csv_output .= $v.",";
				}
				$csv_output .= "\n";
			}
			
			$filename = $file."_".date("d-m-Y_H-i",time());
			header("Content-type: application/vnd.ms-excel");
			header("Content-disposition: csv" . date("Y-m-d") . ".csv");
			header( "Content-disposition: filename=".$filename.".csv");
			print $csv_output;
			exit;
				
				
				
				
				
				
				
			}else{
				echo "Security!!";	
			}
 			
  
  
  
  

}else{
	header("Location: ".$main_url."/adminarea/login");
	exit();
}
//echo $tpl->render("themes/adminarea/html/download_csv.php");
