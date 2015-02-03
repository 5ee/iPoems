<?php echo $this->render("themes/site/" . theme_name . "/html/elements/header.php"); ?>

<?php $now = new DateTime(); ?>
<link href="<?php echo main_url; ?>/libs/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">



<div class="container">
   <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-6 col-md-6 ">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"> <i class="fa fa-globe"></i> <?php echo SIGNUP; ?></h3>
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
                        echo "<li style='list-style:circle'>Registeration successfull! You can login now :)</li>";
                        ?>
                    </div>
                <?php } ?>

                <form method="post" name="csrf_form" action='' enctype="multipart/form-data" class="form" role="form"  parsley-validate>

                    <input type="hidden" name="csrf_token" value="<?php echo $this->formtoken; ?>">
                    <div class="row">
                        <div class="col-xs-6 col-md-6">
                            <input class="form-control" name="data[firstname]" placeholder="<?php echo FIRST_NAME; ?>" type="text"
                                   id="firstname"   value="" autocomplete="off" parsley-required="true" />
                        </div>
                        <div class="col-xs-6 col-md-6">
                            <input class="form-control" name="data[lastname]" placeholder="<?php echo LAST_NAME; ?>" type="text"  id="lastname"  value=""  autocomplete="off" parsley-required="true" />

                        </div>
                    </div>

                    <input class="form-control" name="data[user_email]" placeholder="<?php echo EMAIL_ADDRESS; ?>" type="email" id="user_email" parsley-type="email" parsley-trigger="change"  value="" autocomplete="off" parsley-required="true" />

                    <input class="form-control" name="data[password]" placeholder="<?php echo PASSWORD; ?>" type="password" id="password"  value="" autocomplete="off" parsley-minlength="6" parsley-maxlength="14" parsley-required="true"  />
                    <input class="form-control" name="data[r_password]" placeholder="<?php echo CONFIRM_PASSWORD; ?> " type="password" id="password"  value="" autocomplete="off" parsley-equalto="#password"  parsley-required="true"/>





                    <div class="row" >
                        <div class="col-md-3" style="padding-top: 5px; font-size: 14px; font-weight:bold; text-align: center;">
                            <center>
                                <input type="hidden" name="data[number1]" value="<?php echo $this->cap_numbers['number1']; ?>" />
                                <input type="hidden" name="data[number2]" value="<?php echo $this->cap_numbers['number2']; ?>" />        
                                <?php echo $this->cap_numbers['number1']; ?> + <?php echo $this->cap_numbers['number2']; ?>

                            </center>
                        </div>
                        <div class="col-md-9">
                            <input class="form-control" name="data[captchatotal]" placeholder="<?php echo ARE_YOU_A_HUMAN; ?>" type="text" id="password" parsley-required="true"  value="" autocomplete="off" />
                        </div>  

                    </div>
                    <input type="submit" class="btn btn-info btn-block sign-top" name="submit" value="<?php echo SIGNUP; ?>"/>
                </form>
            </div>
        </div>

    </div>










    <div class="col-md-2">
        <div class="login-or mr-top">
            <hr class="hr-or">
            <span class="span-or"><?php echo OR_LINE; ?></span>
        </div>
    </div>





    <div class="col-xs-12 col-sm-6 col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-globe"></i> <?php echo LOGIN; ?></h3>
            </div>
            <div class="panel-body">
                <?php if ($this->lerrors) {?>
                    <div class="alert-message alert-message-danger"><a class="close" data-dismiss="alert" href="#">&times;</a>
                        <?php
                        foreach ($this->lerrors as $value) {
                            echo "<li style='list-style:circle'>" . $value . "</li>";
                        }
                        ?>

                    </div>
                <?php } ?>

                <form method="post" name="csrf_form" action='' class="form" role="form" id="login_formctp" parsley-validate>
                    <input type="hidden" name="csrf_token" value="<?php echo $this->formtoken; ?>">
                    <div class="form-group">
                        <input type="text" name="ldata[email]" id="inputUsernameEmail" placeholder="<?php echo EMAIL_ADDRESS; ?>" class="form-control" parsley-required="true" autocomplete="off">
                    </div>  
                    <div class="form-group">

                        <input type="password" name="ldata[password]" placeholder="<?php echo PASSWORD; ?>" id="inputPassword" class="form-control" parsley-required="true" autocomplete="off">
                    </div>

                    <input class="btn btn-info btn-block" type="submit" value='<?php echo LOGIN; ?>' name="lsubmit"/>
                    <a href="<?php echo main_url; ?>/forgotpassword" class="pull-left tp"><?php echo FORGOT_PASSWORD; ?></a>

                    </br>

                    <div class="login-or">
                        <hr class="hr-or">
                        <span class="span-or">or</span>
                    </div>

                    <a href="<?php echo $this->loginUrl; ?>" class="btn btn-primary btn-block">
                        <i class="fa fa-facebook"></i> <?php echo CONNECT_WTIH_FACEBOOK; ?>
                    </a> 

                </form>

            </div>
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
                window.location = "<?php echo main_url ?>/register";
            }, 2000);
        });
    </script>
<?php
}?>