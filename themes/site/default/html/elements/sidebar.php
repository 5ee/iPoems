    <div class="col-md-4">
<?php echo showad(1,$this->ads);?> 
        <br/>
      <?php if(isset($_SESSION['user_id'])){ ?>
     <div style="margin-bottom: 15px;"><a href="<?php echo get_url($this->database, "submission"); ?>" class=" btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i><?php echo SUBMIT_POEMS;?></a></div> 
      <?php }else{ ?>
     <div style="margin-bottom: 15px;"><a href="<?php echo get_url($this->database, "register"); ?>" class=" btn btn-success btn-lg btn-block"><i class="fa fa-plus"></i> <?php echo SUBMIT_POEMS;?></a></div> 
      <?php } ?>
     
     
     
     
     
     
  <?php if($this->all_author){ ?> 
      <div class="panel panel-warning">
        <div class="panel-heading">
          <h3 class="panel-title"><?php echo POEMS_BY_POETS;?></h3>
        </div>
        <ul class="list-group">
          <div class="list-group"> 
                <?php foreach ($this->all_author as $all_author) { ?>
              <a class="list-group-item" href="<?php echo get_url($this->database, "poet", $all_author['id'], $all_author['Author_slug'])?>">
                  <i class="fa fa-user pull-right"></i> <?php echo substr(ucwords($all_author['Author_name']), 0, 15);?> (<?php echo get_author_poems($this->database, $all_author['id'], array("ONLYCOUNT" =>true))?> <?php echo POEMS; ?>) 
              <?php } ?></a> 
              <a class="list-group-item active" href="<?php echo main_url; ?>/poets">
                 <i class="fa fa-user pull-right"></i><?php echo ALL_AUTHORS; ?>
                
              </a> 
               </div>
        </ul>
      </div>
  <?php } ?> 
     
</div>



