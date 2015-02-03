<?php echo $this->render("themes/site/".theme_name."/html/elements/header.php"); 
$poems_count = $this->database->count("poems");
$authors_count = $this->database->count("authors");

?>

<!-- /container --> 
<div class="container">
<div class="row"  style="margin-top:20px">
<div class="col-md-8">
      <div class="well well-small" style="background:#f5f5f5; border:1px solid #cccccc; color:#333333">
        <center>
          <h1><?php echo HEADING_1; ?> <?php echo $poems_count; ?> <?php echo HEADING_2; ?> !</h1>
      
          <p><?php echo HEADING_3;?> <?php echo $poems_count; ?> <?php echo HEADING_4; ?> <?php echo $authors_count; ?> <?php echo HEADING_5; ?>.</p>
          <hr>
          <div class="row">
            <form action="<?php echo main_url; ?>/search" name="csrf_form" method="post">
              <div class="form-group">

			<div class="col-md-1"></div>
                <div class="col-md-10 col-sm-6 col-xs-12" style="margin-top: -10px;">
                  <div class="input-group">
                      <input type="text" class="form-control" placeholder="<?php echo SEARCH_PLACEHOLDER; ?>" name="keyword" id="srched" style="" autocomplete="off">
                    <div class="input-group-btn">
                      <button class="btn btn-danger" type="submit" name="searched"><i class="fa fa-search"></i> &nbsp;<?php echo SEARCH; ?></button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </center>
      </div>
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?php echo RECENTLY_ADDED; ?></h3>
        </div>
          
          <?php if($this->recent_poems){ ?>    
        <div class="panel-body">
          <div class="row">
               <div class="col-md-6">   
             
                  <table class="table table-hover table-striped">
                <tbody>
                    
              <?php $count = 1; foreach($this->recent_poems as $recent_poem){ //pr($recent_poem);?> 
                              
                  <tr>
                    <td width="10%" class="number text-center"><?php echo $count;?></td>
                    <td width="55%"><b><a href="<?php echo get_url($this->database, 'poem', $recent_poem['id']."/".$recent_poem['poem_slug']);?>"><?php echo text_limit($recent_poem['poem_title'],15);?></a></b>
                        <p><small><a href="<?php echo get_url($this->database, "poet",$recent_poem['author_id']['id'],$recent_poem['author_id']['Author_slug']); ?>" style="color:#333"><?php echo $recent_poem['author_id']['Author_name']?></a></small></p></td>
                    <td><div class="rating"  data-toggle="tooltip" data-placement="bottom" title="<?php echo get_ratings_text("poems", $recent_poem['id'], $this->database) ?>"  style="font-size:16px; color: #e48a07;">
                        <?php  show_ratings_html("poems",$recent_poem['id'],$this->database, false,false);?>
                        </div>
                    </td>
                    
                  </tr>
                  
              <?php if($count == recent_poems_count / 2) {?>
                  
                  
                  
                </tbody>
              </table>
            </div>
              
              
              
            <div class="col-md-6">
              <table class="table table-hover table-striped">
                <tbody>
                 
                    
              <?php } ?>
                    
                   
               
              
              <?php $count++; } ?>
              
               </tbody>
              </table>
            </div>
          </div>
        </div>
          <?php } else { ?>
          <div class="alert-message alert-message-danger" style="margin-right: 10px; margin-left: 10px;">
                    

                    <h4>
                        <?php echo WOOPS; ?></h4>
                    <p class="txt font-16">
                       <?php echo NO_RECENTLY_ADDED_POEMS; ?> <br /><br />
                    </p>
                </div>

            <?php } ?>
          
          
      </div>
      <div class="row">
          
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo POPULAR_POETS;?></h3>
            </div>
              
              
              <?php if($this->popular_poets){ ?> 
            <div class="panel-body">
              <table class="table table-hover table-striped">
                <tbody>
                    
                <?php $count= 1; foreach ($this->popular_poets  as $popular_poets) { ?>
                  <?php 
                if(substr($popular_poets['photo'],0,7) == "http://"){
                    $src = $popular_poets['photo'];
                } elseif($popular_poets['photo']){
                    $src = main_url.$popular_poets['photo'];
                } else {
                    $src = "http://placehold.it/100&text=No+Photo";
                }
                $src = main_url."/libs/timthumb/timthumb.php?w=50&h=50&src=".$src;
                ?>                       
                  <tr>
                    <td width="60" class="number text-center"><?php echo $count; ?></td>
                    <td width="500"><a href="<?php echo get_url($this->database, "poet",$popular_poets['id'],$popular_poets['Author_slug']) ?>"><b><?php echo text_limit($popular_poets['Author_name'],12); ?></b></a><br>
                        <div class="rating"  data-toggle="tooltip" data-placement="bottom" title="<?php echo get_ratings_text("author", $popular_poets['id'], $this->database) ?>"  style="font-size:16px; color: #e48a07;">
                        <?php  show_ratings_html("author",$popular_poets['id'],$this->database,false,false);?>
                        </div>
                    </td>
                    <td width="350"><img class="pull-right img-circle" src="<?php echo $src; ?>"></td>
                  </tr>
                    <?php $count++; ?>
                  <?php } ?>            
                  
                </tbody>
              </table>
            </div>
             <?php } else { ?>
          <div class="alert-message alert-message-danger" style="margin-right: 10px; margin-left: 10px;">
                   

                    <h4>
                         <?php echo WOOPS; ?></h4>
                    <p class="txt font-16">
                         <?php echo NO_POPULAR_POETS; ?><br /><br />
                    </p>
                </div>

            <?php } ?> 
              
              
          </div>
        </div>
        <div class="col-md-6">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><?php echo TOP_RATED_POEMS; ?></h3>
            </div>
              <?php if($this->popular_poems){ ?> 
            <div class="panel-body">
              <table class="table table-hover table-striped">
                <tbody>
                  
                  <?php $count = 1; foreach($this->popular_poems as $popular_poems){ ?>  
                    <?php if($popular_poems['author_id']){
                        $popular_poems['author_id'] = get_author($this->database, $popular_poems['author_id']);
                    } ?>
                    <tr>
                    <td width="30" class="number text-center"><?php echo $count; ?></td>
                    <td width="450"><b><a href="<?php echo get_url($this->database, "poem",$popular_poems['id'],$popular_poems['poem_slug']); ?>"><?php echo text_limit($popular_poems['poem_title'],10); ?> </a></b>
                       <p><small><a href="<?php echo get_url($this->database, "poet",$popular_poems['author_id']['id'],$popular_poems['author_id']['Author_slug']); ?>"style="color:#333"><?php echo $popular_poems['author_id']['Author_name']; ?></a> </p></small></td>
                    <td width="400">
                        <div class="rating"  data-toggle="tooltip" data-placement="bottom" title="<?php echo get_ratings_text("poems", $popular_poems['id'], $this->database) ?>"  style="font-size:16px; color: #e48a07;">
                      <?php  show_ratings_html("poems",$popular_poems['id'],$this->database,false,false);?>                          </div>
                    </td>
                  </tr>
                  
                  <?php $count++; ?>
                  <?php } ?>
                        
                </tbody>
              </table>
            </div>
                <?php } else { ?>
          <div class="alert-message alert-message-danger" style="margin-right: 10px; margin-left: 10px;">
                   

                    <h4>
                        <?php echo WOOPS; ?></h4>
                    <p class="txt font-16">
                       <?php echo NO_TOP_RATED_POEMS; ?> <br /><br />
                    </p>
                </div>
   
            <?php } ?>   
          </div>
        </div>
      </div>
    </div>

<?php echo $this->render("themes/site/".theme_name."/html/elements/sidebar.php"); ?>
</div>
<?php echo $this->render("themes/site/".theme_name."/html/elements/footer.php"); ?>
