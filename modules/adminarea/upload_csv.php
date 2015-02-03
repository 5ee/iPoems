<?php
$tpl =  new bQuickTpl();
$tpl->page_title = "Upload CSV";
include(getcwd()."/modules/adminarea/common.php");

  $tpl->update = 3;

if(isset($_SESSION['admin_user_id'])){
	

if(isset($_POST) && $_POST)
	{
		$error1 = 0;
		
		$csv = $_FILES['csv_file']['name'];
		if(empty($csv))
		{
			$error1 = 1;
			 $tpl->update = 0;
			$tpl->errormessage =  "Please Select a CSV file";
		}
		if(!empty($csv))
		{
			$allowedExts = array("csv");
			$extension = end(explode(".", $_FILES["csv_file"]["name"]));
			
			if(!in_array($extension, $allowedExts))
			{
				$error1 = 1;
				$tpl->update = 0;
				$tpl->errormessage =   "File format not supported except .csv";
			}
		}
		
		if($error1!='1'){
			
			
			if (($handle = fopen($_FILES['csv_file']['tmp_name'], "r")) !== FALSE) {
					$j=1;	
				while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
					
					$d=array();
					$getcolumns_title = $database->getColumns($vars[2]);
					
					if (count($getcolumns_title) > 0) {
						$i=0;	
						
						foreach($getcolumns_title as $row){
							if($row['Field'] == 'id'){
								unset($row['Field']);
							}
							else{
								$d[$row['Field']] = $data[$i];
							}
							
							//$csv_output .= $row['Field'].", ";
							$i++;
						}
					}

					if($j!='1'){
						$savedata = $database->insert($vars[2], $d);
					}
					$j++;
					
					/*if($savedata){
							echo '<script>$(document).ready(function(){
								$.ambiance({message: "The CSV was sucessfully to your", 
									title: "Success!",
									type: "success"});
								});</script>';
								
								
					}*/
				}
				fclose($handle);
				}
			
			$tpl->update = 1;
			
			
		
		}else{
			$error1 = 1;
			//$tpl->update = 0;
			//$tpl->errormessage = "It was not possible to save this CSV!";
		}
		
		
		
		
		
	}
  
  

	
}else{
	header("Location: ".$main_url."/adminarea/login");
	exit();
}
echo $tpl->render("themes/adminarea/html/upload_csv.php");
