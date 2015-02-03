<?php echo $this->render("themes/site/" . theme_name . "/html/elements/header.php"); ?>
<?php $aliases_flip = $this->aliases_flip; ?>

<!-- /container --> 
<div class="container">
    <div class="row" style="margin-top:20px">
        <div class="col-md-8">
            <?php echo showad(3,$this->ads);?> 
            <br/>
            <div class="panel panel-default">
                <div class="panel-heading">
                    
                    <h3 class="media-heading"> <?php echo TOPICS; ?><div class="pull-right" style="font-size:15px; margin-top: 1px;"><?php echo SHOWING; ?> <?php echo $this->page_array['current_count']; ?> <?php echo OF; ?> <?php echo $this->page_array['total_records']; ?> <?php echo TOPICS; ?></div></h3>
                </div>

                <?php if ($this->topicss) { ?>
                    <div class="panel-body">

                        <?php foreach ($this->topicss as $topic) { ?> 
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <ul class="list-unstyled" style="line-height:30px;">
                                    <li><a href="<?php echo get_url($this->database, "topic", $topic['topic_id'], $topic['topic_slug']); ?>"><?php echo $topic['topic_name'] ?> (<?php echo get_topic_poems($this->database, $topic['topic_id'], array("ONLYCOUNT" => true)) ?>)</a></li>

                                </ul>
                            </div>

                        <?php } ?>

                    </div>
                <?php } else { ?>
                    <div class="alert-message alert-message-danger" style="margin-right: 10px; margin-left: 10px;">
                       

                        <h4>
                            <?php echo WOOPS;?></h4>
                        <p class="txt font-16">
                            <?php echo NO_TOPICS;?> <br /><br />
                        </p>
                    </div>
                <?php } ?>

            </div>

        </div>



<?php echo $this->render("themes/site/".theme_name."/html/elements/sidebar.php"); ?>
    </div>



    <?php echo $this->render("themes/site/" . theme_name . "/html/elements/footer.php"); ?>



    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
  
    <!-- Include all compiled plugins (below), or include individual files as needed --> 
    <script src="js/bootstrap.min.js"></script>
</body>
</html>