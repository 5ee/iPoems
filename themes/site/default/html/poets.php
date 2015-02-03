<?php echo $this->render("themes/site/".theme_name."/html/elements/header.php");?>
<?php $aliases_flip = $this->aliases_flip;?>

<!-- /container --> 

  <div class="container">
   <div class="row" style="margin-top:20px">
     <div class="col-md-8">
         
         
         
         
         <div class="row">
             <div class="col-md-12">

          <div class="well">    
       <h2 style="text-align:center;"><?php echo SEARCH_POETS;?></h2>
       <hr>
          <div class="row">
            <form action="<?php echo main_url; ?>/search_poet" name="csrf_form" method="post">
              <div class="form-group">

			<div class="col-md-1"></div>
                <div class="col-md-10 col-sm-6 col-xs-12" style="margin-top: -10px;">
                  <div class="input-group">
                      <input type="text" class="form-control" placeholder="<?php echo SEARCH_KEYWORD_1;?>..." name="keyword1" id="srch-term" style="" autocomplete="off">
                    <div class="input-group-btn">
                      <button class="btn btn-danger" name="searched" type="submit"><i class="fa fa-search"></i> &nbsp;<?php echo SEARCH; ?></button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
      </div>
             </div>
         </div>
         <?php if($this->all_poets){ ?>
          <div class="row">
             <div class="col-md-12">
                 <?php echo showad(3,$this->ads);?>
                 <br/>
         <div class="pull-right" style="margin-top: -10px; margin-right: 10px;"><h4><?php echo SHOWING;?> <?php echo $this->page_array['current_count']; ?> <?php echo FROM;?> <?php echo $this->page_array['total_records']; ?> <?php echo POETS;?></h4></div>
         
         <?php if($this->page_array['total_records'] > poets_per_page){ ?>
          <div id="pagination_top" style="margin-top: 0px;"></div>
          <?php } ?>
         

             </div>
          </div>

        <div class="row">
                
                <?php $count=poets_per_page*($this->page_array['current_page']-1 ) +1; foreach($this->all_poets as $all_poets) { ?>
                 <?php 
                if(substr($all_poets['photo'],0,7) == "http://"){
                    $src = $all_poets['photo'];
                } elseif($all_poets['photo']){
                    $src = main_url.$all_poets['photo'];
                } else {
                    $src = "http://placehold.it/100&text=No+Photo";
                }
                $src = main_url."/libs/timthumb/timthumb.php?w=50&h=50&src=".$src;
                ?>
                <div class="col-md-6" style="padding:10px;border-bottom:dotted 2px lightgray;">
                    <div class="row">
                        <div style="width:8%;float:left;margin-left:5%">
                            <?php echo $count;?>.
                        </div>
                        
                        <div style="width:22%;float:left">
                            <a href="<?php echo get_url($this->database, "poet",$all_poets['id'],$all_poets['Author_slug']); ?>">  <img class="img img-thumbnail img-responsive" src="<?php echo $src; ?>"  /></a>
                        </div>
                        
                        <div class="pull-left">
                            <a href="<?php echo get_url($this->database, "poet",$all_poets['id'],$all_poets['Author_slug']); ?>"><?php echo text_limit($all_poets['Author_name'],20); ?></a> <br>
                            <small>(<?php echo get_author_poems($this->database, $all_poets['id'], array("ONLYCOUNT" =>true))?> <?php echo POEMS; ?>) </small>
                        </div>
                    </div>
                </div>
                <?php $count++;?>
                 <?php }?>
            </div>

        
         <?php if($this->page_array['total_records'] > poets_per_page){ ?>
          <div id="pagination_bottom" style="margin-top: 15px;"></div>
          <?php } ?>
         
         
         
          <?php }else{ ?>
         <div class="alert-message alert-message-danger" style="margin-right: 10px; margin-left: 10px;">
                   

                    <h4>
                        <?php echo WOOPS; ?></h4>
                    <p class="txt font-16">
                       <?php echo NO_POETS; ?> <br /><br />
                    </p>
                </div>
         <?php } ?>
          <?php echo showad(3,$this->ads);?>
     </div>
       
 <?php echo $this->render("themes/site/".theme_name."/html/elements/sidebar.php");?>
   </div>
<?php echo $this->render("themes/site/".theme_name."/html/elements/footer.php");?>



<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery.js"></script> 
  
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>
</body>
</html>
