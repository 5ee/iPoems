<?php echo $this->render("themes/site/" . theme_name . "/html/elements/header.php"); ?>
<link href="<?php echo main_url; ?>/libs/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
<div class="container">
    <div class="row" style="margin-top:20px">
        <div class="col-md-12 col-sm-12">

            <!-- Modal -->

            <div class="panel panel-default" style="margin-top: 15px;">
                <div class="panel-heading">
                    <h3 class="panel-title">  <?php echo SUBMIT_POEMS;?></h3>
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8">

                            <div class="alert alert-danger" id="send_poem_error_div" style="display:none">
                                <a class="close" data-dismiss="alert" href="#">&times;</a>
                                <div id="send_poem_error_show"></div>
                            </div>
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
                                    echo "<li style='list-style:circle'>Submit Poem Successfully:)</li>";
                                    ?>
                                </div>     
                            <?php } ?>       
                            <form method="post"  action='' enctype="multipart/form-data" class="form" role="form"  parsley-validate>
                                <input type="hidden" name="csrf_token" value="<?php echo $this->formtoken; ?>">
                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">  <?php echo POEM_TITLE;?></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="data[poem_title]" placeholder="" autocomplete="off" parsley-required="true">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">  <?php echo POEM;?></label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control counted" name="data[poem]" placeholder="" rows="5" style="margin-bottom:10px;" autocomplete="off" parsley-required="true"></textarea>    
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">  <?php echo TOPIC_NAME;?></label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="data[topic]" placeholder="">
                                            <?php foreach ($this->all_topics as $topics) { ?>
                                                <option value="<?php echo $topics['topic_id']; ?>"><?php echo $topics['topic_name']; ?></option>
                                            <?php } ?>
                                        </select> 
                                    </div>
                                </div> 


                                <div class="form-group">
                                    <label for="inputPassword3" class="col-sm-3 control-label">  <?php echo AUTHOR_NAME;?></label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="data[author]" placeholder="">
                                            <?php foreach ($this->all_authors as $authors) { ?>
                                                <option value="<?php echo $authors['id']; ?>"><?php echo $authors['Author_name']; ?></option>
                                            <?php } ?>
                                        </select>  
                                    </div>
                                </div>    

                                <div class="form-group">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-success btn-lg" name="submit">  <?php echo SUBMIT_POEMS;?></button>
                                    </div>
                                </div>
                            </form>  
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>  




    <?php echo $this->render("themes/site/" . theme_name . "/html/elements/footer.php"); ?>
    <script src="<?php echo main_url; ?>/libs/parsley-js-validations/parsley.min.js"></script>
    <?php if ($this->params[1] == 'success') { ?>
        <script>
            $(function() {
                setTimeout(function() {
                    window.location = "<?php echo main_url ?>/submission";
                }, 2000);
            });
        </script>
    <?php } ?>
