<?php echo $this->render("themes/site/" . theme_name . "/html/elements/header.php"); ?>
<!-- /container --> 
<div class="container">
   <div class="row" style="margin-top:20px">
        <div class="col-xs-12 col-sm-6 col-md-5">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-globe"></i> <?php echo CHANGE_PASSWORD; ?></h3>
                </div>
                <div class="panel-body">
                    <?php if ($this->errors) { ?>
                        <div class="alert-message alert-message-danger" id="errors"><a class="close" data-dismiss="alert" href="#">&times;</a>
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
                            echo "<li style='list-style:circle'>Change password successfully.</li>";
                            ?>
                        </div>
                    <?php } ?>                  
                    <form method="post" name="csrf_form" action='' class="form" role="form" id="login_formctp"  parsley-validate>
                        <input type="hidden" name="csrf_token" value="<?php echo $this->formtoken; ?>">             
                        <div class="form-group">
                            <label for="inputUsernameEmail"><?php echo OLD_PASSWORD; ?></label>
                            <input type="password" name="data[old_password]" id="old_password" placeholder="" class="form-control" parsley-required="true">
                        </div>  
                        <div class="form-group">       	 
                            <label for="inputPassword"><?php echo NEW_PASSWORD; ?></label>
                            <input type="password" name="data[new_password]" id="new_password" placeholder="" class="form-control" parsley-required="true" parsley-minlength="6" parsley-maxlength="14">
                        </div>             
                        <div class="form-group">       	 
                            <label for="inputPassword"><?php echo REPEAT_PASSWORD; ?></label>
                            <input type="password" name="data[r_password]" id="r_password" placeholder="" class="form-control" parsley-required="true" parsley-equalto="#new_password">
                        </div>           
                        <Div style="margin-top:20px;"></Div>                      
                        <input type="submit" class="btn btn-info btn-block" name="change_password" value="<?php echo SAVE_PASSWORD; ?>">  		 
                    </form>
                </div>
            </div>
        </div>      
    </div>

<div style="margin-top:20px;"></div>
<?php echo $this->render("themes/site/" . theme_name . "/html/elements/footer.php"); ?>
<script src="<?php echo main_url; ?>/libs/parsley-js-validations/parsley.min.js"></script>

<?php if ($this->params[1] == 'success') { ?>
    <script>
        $(function() {
            setTimeout(function() {
                window.location = "<?php echo main_url ?>";
            }, 3000);
        });
    </script>
<?php } ?>

