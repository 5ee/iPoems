<?php echo $this->render("themes/adminarea/html/elements/header.php")?>
<div class="row">
  <div class="col-lg-12">
    <div class="panel panel-default">
	  <div class="panel-heading">
	    <div class="panel-title">
	      <h3 style="font-size:21px; padding:7px;">
		    <strong><i class="icon-edit"></i>Change Admin Password</strong>
		  </h3>
	    </div>
	  </div>
	  <div class="panel-body" style="padding:15px">
	    <?php if($this->errors){ ?>
		<div class="alert alert-danger">
		  <a class="close" data-dismiss="alert" href="#">&times;</a>
		  <?php foreach($this->errors as $msg) {
				echo "<li style='list-style:circle'>".$msg."</li>";
		  }?>
		</div>
		<?php }?>
        <?php if($this->success){ ?>
		<div class="alert alert-success">
		  <a class="close" data-dismiss="alert" href="#">&times;</a>
		  <?php foreach($this->success as $msg) {
				echo "<li style='list-style:circle'>".$msg."</li>";
		  }?>
		</div>
		<?php }?>
		<div class="col-lg-12">
		  <form class="form-horizontal col-lg-8" action="<?php echo _admin_url;?>/changepassword" method="post" role="form" data-validate="parsley">
    <div class="form-group">
       <label for="inputEmail1" class="col-lg-3 control-label">Old Pasword</label>
       <div class="col-lg-6">
      <input type="password" class="form-control" name="data[old_password]" id="old_password" data-required="true" />
      </div>
    </div>
    
    <div class="form-group">
    <label for="inputEmail1" class="col-lg-3 control-label">New Pasword</label>
      <div class="col-lg-6">
      <input type="password" class="form-control"  name="data[new_password]" id="new_password" data-required="true" />
      </div>
    </div>
    
    <div class="form-group">
        <label for="inputEmail1" class="col-lg-3 control-label">Repeat Pasword</label>
      <div class="col-lg-6">
      <input type="password" class="form-control" name="data[repeat_password]" id="repeat_password" data-required="true" data-equalto="#new_password" />
      </div>
    </div>
     
    <div class="form-group" style="margin-top:30px;width:78%">
          <div class="col-lg-11" style="text-align:left;margin-left:35px">
            <button type="submit" class="btn btn-primary btn-lg btn-block">Save Password</button>
          </div>
        </div> 
	  </form>
		</div>
	  </div>
	</div>
  </div>
</div>
<?php echo $this->render("themes/adminarea/html/elements/footer.php")?> 