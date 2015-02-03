<?php echo $this->render("themes/adminarea/html/elements/header.php")?>
<?php //echo $this->update;?>
<div class="row">
  <div class="col-lg-12">
	  
      <h1><strong>Upload CSV:</strong> <em><?php echo format_names($this->vars[2]);?></em> </h1>
		<hr />
      
      <?php 
	if($this->update == 1){
	?>
	<div class="alert alert-success">
	<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>

			<strong>Well done!</strong> Successfully inserted the data!
<p></p>            	     <a class="btn btn-small btn-success" href="<?php echo main_url;?>/adminarea/table/<?php echo $this->vars[2];?>" id="">Go to Table</a>

		  </div>
	<?php } else if($this->update == 3){?>
    
 
    
    
    <?php } else {?>
       <div class="alert alert-danger">
	<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>

			<strong>OOPS!!  </strong> <?php echo $this->errormessage;?>

		  </div>
    <?php }?> 
      
      
     <div class="modal-body alert  alert-active">
     <a class="btn btn-small btn-info pull-right" href="<?php echo main_url;?>/adminarea/download_csv/<?php echo $this->vars[2];?>/true" id="">Click here to Download Sample CSV</a>

    <p style="font-size:16px; font-weight:200">You can upload bulk data using CSV upload method. Remember to keep the headers of your CSV file as per the mySQL database column headers. You can download the existing CSV to have a look on how to create a CSV. 
    <p></p>

    </p>
  </div>
  
   <h3>Choose a file to upload.</h3>
  
  <form method="post" name="csrf_token" enctype="multipart/form-data" id="addcsvform" action="" style="background:#ffffff"> 
          <!--<input type="hidden" name="csrf_token" value="<?php echo $token; ?>">-->

  <div class="modal-body">
    
    <p>
    <div class="fileinput fileinput-new" data-provides="fileinput">
  <span class="btn-file"><span class="fileinput-new btn btn-primary">Select file</span><span class="fileinput-exists btn btn-danger">Change</span><input type="file" name="csv_file"></span>
  <span class="fileinput-filename"></span>
  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
</div>
    </p>
    
    
    
  </div>
  
  
  <div class="modal-footer" style="text-align:left; background:#f5f5f5">
    <input type="submit" value="Upload CSV" class="btn btn-primary opopawan" name="submit_csv"/>
    
  </div>
  
 
  
  </form>  
      
  
  
  </div>
  
</div>

<?php echo $this->render("themes/adminarea/html/elements/footer.php")?> 