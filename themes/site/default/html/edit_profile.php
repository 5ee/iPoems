<?php echo $this->render("themes/site/" . theme_name . "/html/elements/header.php"); ?>
<?php $user_data = $this->user_data;
$user_data = $user_data[0]; ?>
<?php $firstname = $this->firstname; ?>
<link href="<?php echo main_url; ?>/libs/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
<div class="container">
   <div class="row" style="margin-top:20px">
    <div class="col-md-8">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php echo EDIT_ACCOUNT; ?></h3>
                    </div>
                    <div class="panel-body">                                 
                            <?php if ($this->errors) { ?>
                            <div class="alert-message alert-message-danger"><a class="close" data-dismiss="alert" href="#">&times;</a>
                                <?php
                                foreach ($this->errors as $value) {
                                    echo "<li style='list-style:circle'>" . $value . "</li>";
                                }
                                ?>
                            </div>
                        <?php } ?>
                            <?php if ($this->params[1] == 'success') { ?>
                            <div class="alert-message alert-message-success" id="success_div"><a class="close" data-dismiss="alert" href="#">&times;</a>
                                <?php
                                echo "<li style='list-style:circle'>Edit Profile successfully ! :)</li>";
                                ?>
                            </div>
<?php } ?>
                        <form method="post" name="csrf_form" action='' enctype="multipart/form-data" class="form" role="form" parsley-validate>
                            <input type="hidden" name="csrf_token" value="<?php echo $this->formtoken; ?>">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-3 control-label" ><?php echo FIRST_NAME; ?></label>
                                <div class="col-sm-9">
                                    <input type="text" name="data[firstname]" class="form-control"  value="<?php echo $this->firstname; ?>" autocomplete="off" id="firstname"  parsley-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label"> <?php echo LAST_NAME; ?></label>
                                <div class="col-sm-9">
                                    <input type="text" name="data[lastname]" class="form-control" value="<?php echo $this->lastname; ?>" autocomplete="off" id="fullname"  parsley-required="true">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-3 control-label"><?php echo EMAIL; ?></label>
                                <div class="col-sm-9">
                                    <input name="data[user_email]"class="form-control"  value="<?php echo $user_data['user_email']; ?>" autocomplete="off" parsley-type="email" parsley-trigger="change" parsley-required="true">
                                </div>
                            </div>
                            <div class="form-group">           
                                <label for="inputPassword3" class="col-sm-3 control-label"><?php echo BIRTHDAY; ?></label>          
                                <div class="col-sm-9">   
                                    <p> 
                                        <input class="form-control" name="data[birthday]" id="datepicker" type="text" value="<?php echo $user_data['birthday']; ?>" autocomplete="off"/>
                                    </p>           
                                </div>
                            </div>
                            <div class="form-group">       
                                <label for="inputPassword3" class="col-sm-3 control-label"><?php echo USER_IMAGE; ?></label>
                                <div class="col-sm-9">
                                    <div class="row" >        
                                        <div class="col-md-10">
                                            <?php
                                            if (isset($_SESSION['user_id'])) {
                                                if ($user_data['fb_id'] != "") {
                                                    $image = "https://graph.facebook.com/" . $_SESSION['fbid'] . "/picture?type=large";
                                                } elseif ($user_data['picture'] != "") {
                                                    $image = main_url . "/uploads/user_pics/" . $user_data['picture'];
                                                } else {
                                                    $image = "http://placehold.it/250x200&text=No+image";
                                                }
                                                ?>               
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 180px; height: 150px;">
                                                        <img src="<?php echo $image; ?>" alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 180px; max-height: 150px;"></div> 
    <?php if ($user_data['fb_id'] == "") { ?>
                                                        <div>
                                                            <span class="btn btn-default btn-file"><span class="fileinput-new"><?php echo SELECT_IMAGE; ?></span><span class="fileinput-exists"><?php echo CHANGE; ?></span><input type="file" name="data[picture]"></span>
                                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"><?php echo REMOVE; ?></a>
                                                        </div>
                                                <?php } ?> 
                                                </div>
<?php } ?> 
                                        </div>              
                                    </div>
                                </div>
                            </div>
                            <div class="form-group last">
                                <div class="col-sm-offset-3 col-sm-9">
                                    <button type="submit"  class="btn btn-primary" name="submit"><i class="fa fa-save"></i> <?php echo SAVE; ?></button>
                                    <button type="reset" class="btn btn-default">
                                        <i class="fa fa-chevron-left"></i> <?php echo CANCEL_BACK; ?></button>
                                </div>
                            </div>
                        </form>                        
                    </div>
                </div>          
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</div>
<?php echo $this->render("themes/site/" . theme_name . "/html/elements/footer.php"); ?>
<script src="<?php echo main_url; ?>/libs/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo main_url; ?>/libs/parsley-js-validations/parsley.min.js"></script>

<?php if ($this->params[1] == 'success') { ?>
    <script>
        $(function() {
            setTimeout(function() {
                window.location = "<?php echo main_url ?>/login";
            }, 2000);
        });
    </script>
<?php } ?>

