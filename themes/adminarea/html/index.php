<?php echo $this->render("themes/adminarea/html/elements/header.php")?>

<?php //pr($this->get_latest_status);?>
<h1><em>Welcome</em>, <strong><?php echo $_SESSION['admin_name'];?></strong></h1>
<hr />
<?php if($this->vars[2] == "success"){?>
<div class="alert-success" style="padding:5px;margin-bottom:20px">Done</div>

<?php }?>

  <div class="row">
   
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Recently Added 5 Poems</h3>
      </div>
      <div class="panel-body">
        
          <div class="list-group" style="margin-bottom:0px;">
         <?php  foreach($this->get_latest_status as $get_latest_status){?>
         
         
         
         <div class="row">

             <div class="col-md-12" >
                            <div class="caption">
                            <span class="badge pull-right"><?php echo $get_latest_status['views'];?> views</span>
                            <a href="<?php echo main_url.'/adminarea/detail/poems/rec:'.$get_latest_status['id']?>" ><h6 style="margin-bottom:0px"><b><?php echo text_limit(ucfirst($get_latest_status['poem_title']),30);?></b></h6></a>
                                
                                
                               
                            </div>
                        </div>
             
                    </div>
         
         
         
         
         
         
        
         <?php }?>
        
      </div>
      
      
        
        
      </div>
    </div>
                </div>
                
                <div class="col-md-6">
                     <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Top Rated Poems</h3>
      </div>
      <div class="panel-body">
        <div class="list-group" style="margin-bottom:0px;">
            <?php foreach($this->top_rated as $top_rated){?>
            
            <div class="row">
            <div class="col-md-12" >
                            <div class="caption">
                                <span class="badge pull-right"><?php echo $top_rated['ratings'];?>/5</span>
                                <a href="<?php echo main_url.'/adminarea/detail/poems/rec:'.$top_rated['id']?>" ><h6 style="margin-bottom:0px"><b><?php echo text_limit(ucfirst($top_rated['info']),30);?></b></h6></a>
                                
                                
                               
                            </div>
                        </div>
            
            </div>
            <?php }?>
		  
		</div>
      </div>
    </div>
                </div>
                
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Top Liked Poems</h3>
  </div>
    <div class="panel-body" style="padding:0px;">
    
      <table  class="table table-striped" style="margin-bottom:0px;">
          <tr><th>#</th><th>Poems Title</th><th>Likes</th><th>Dislikes</th></tr>
       <?php $count = 1; foreach($this->get_more_liked as $get_more_liked){?>
          <tr><th><?php echo $count;?></th><th><?php echo text_limit(ucfirst($get_more_liked['poem_title']),50);?></th><th><?php echo ucfirst($get_more_liked['like']);?></th><th><?php echo ucfirst($get_more_liked['dislike']);?></th></tr>
    <?php $count++;}?>
      </table>
      
  </div>
</div>
                </div>
            </div>
            
        </div>
      
        <div class="col-md-3">
            
            <div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Site Stats</h3>
  </div>
  <div class="panel-body">
    
      <ul class="nav nav-pills nav-stacked">
       <?php foreach($this->total as $k=>$v){?>
      
      
  <li>
    <a href="javascript:void(0);">
      <span class="badge pull-right"><?php echo $v;?></span>
          Total <?php echo ucfirst($k);?>
    </a>
  </li>


    
    
    <?php }?>
</ul>
      
  </div>
</div>
            
        </div>      
      
      
      
  
</div>


<?php echo $this->render("themes/adminarea/html/elements/footer.php")?>