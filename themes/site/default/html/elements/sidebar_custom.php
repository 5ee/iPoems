
<div class="col-md-4">
<?php echo showad(1,$this->ads);?> 
    <br/>
  <?php if($this->sidebar_topics){ ?> 
<?php if($this->params[0] == alias_name($this->database, "topic") && $this->sidebar_topics){?>
<div class="panel panel-info">
        <div class="panel-heading">
          <h3 class="panel-title"><?php echo POEMS_BY_TOPIC;?></h3>
        </div>
        <ul class="list-group">
          <div class="list-group">
              <?php foreach($this->sidebar_topics as $topics){?>
              <a class="list-group-item" href="<?php echo get_url($this->database, "topic",$topics['topic_id'],$topics['topic_slug']); ?>"><i class="fa fa-chevron-circle-right pull-right"></i> <?php echo $topics['topic_name'];?> (<?php echo ($topics['poems_count']?$topics['poems_count']:"0")?>)</a> 
              <?php } ?>
              <a class="list-group-item active" href="<?php echo main_url; ?>/topics"><i class="fa fa-chevron-circle-right pull-right" ></i><?php echo ALL_TOPICS;?></a> 
          </div>
        </ul>
      </div>
<?php }?>
 <?php } ?>

</div>
 