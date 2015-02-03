<?php echo $this->render("themes/adminarea/html/elements/loginpage-header.php")?>
<div class="container">
	
<div class="row">
  <div class="col-6 col-lg-4"></div>
  <div class="col-6 col-lg-4 well well-large" style="background:#ffffff">
  
  	 <div class="col-12 col-lg-12">
	 <center><h1 style="margin:0px; font-size:24px">
	 <?php 
	 if(file_exists(main_url.website_logo)){
	 ?>
	 <a href="<?php echo main_url; ?>" class="logo"><img src="<?php echo main_url; ?><?php echo website_logo ?>" width="200" style="margin-top:8px;" alt=""></a><?php }else{?>
Administration<?php }?></h1></center>
	 <hr />
	<?php if($this->errors){ ?>
		<div class="alert alert-danger"><a class="close" data-dismiss="alert" href="#">&times;</a>
			<?php foreach($this->errors as $msg) {
				echo "<li style='list-style:circle'>".$msg."</li>";
			}?>
		
		</div>
	<?php }?>
	
	 </div>
  	<?php //echo $this->result;?>
  
  
  <form action="<?php echo _admin_url;?>/login" name="csrf_form" id="loginform" method="post" data-validate="parsley">
      <input type="hidden" name="csrf_token" value="<?php echo $this->formtoken; ?>">

  
  <fieldset>
    <div class="form-group">
      <label for="exampleInputEmail">Username</label>
      <input type="text" class="form-control" id="username" placeholder="Enter Username" name="data[username]" autocomplete="off" data-required="true">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Enter Password" name="data[password]" autocomplete="off" data-required="true"s>
    </div>
    
    
    <input type="submit" class="btn btn-primary btn-block" value="Login">
  </fieldset>
</form>

	
	 



</div>
  <div class="col-6 col-lg-4"></div>
  
  
</div>
	
	
</div>