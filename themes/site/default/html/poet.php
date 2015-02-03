<?php echo $this->render("themes/site/".theme_name."/html/elements/header.php");?>
<?php $aliases_flip = $this->aliases_flip;?>
<?php //$user_data = $this->user_data;$user_data = $user_data[0];?>
<?php $author= $this->author;?>
<?php //pr($author);die; ?>
<?php //pr($this->page_poems[0]);?>


<div class="container">
<div class="row" style="margin-top:20px">
    <div class="col-md-8 ">
        <?php 
                if(substr($this->author_info['photo'],0,7) == "http://"){
                    $src = $this->author_info['photo'];
                } elseif($this->author_info['photo']){
                    $src = main_url.$this->author_info['photo'];
                } else {
                    $src = "http://placehold.it/100&text=No+Photo";
                }
                $src = main_url."/libs/timthumb/timthumb.php?w=150&h=150&src=".$src;
            ?>
<div class="row">
            
            <div class="col-xs-3 col-md-3 text-center">
                <img  src="<?php echo $src ?>" alt="bootsnipp" class="img-rounded img-responsive img-thumbnail img-circle">
            </div>
            
            <div class="col-xs-9 col-md-9 section-box">
                <h2><?php echo $this->author_info['Author_name'];?>
                  
                         <div class="rating pull-right"  data-toggle="tooltip" data-placement="bottom" title="<?php echo get_ratings_text("author", $this->author_info['id'], $this->database) ?>"  style="font-size:16px; color: #e48a07;">
                        <?php show_ratings_html("author", $this->author_info['id'], $this->database, false,false); ?></div>
                </h2>
                
                <i class="fa fa-eye"></i> <?php echo VIEWS; ?><b><?php echo $this->author_info['views'];?></b>
                  <hr>
                 <div class="pw-widget pw-counter-horizontal">
 <a class="pw-button-facebook pw-look-native"></a>
 <a class="pw-button-twitter pw-look-native"></a>
 <a class="pw-button-googleplus pw-look-native"></a>
 <a class="pw-button-pinterest pw-look-native"></a>
 <a class="pw-button-post-share"></a>
</div>
<script src="http://i.po.st/static/v3/post-widget.js#publisherKey=2nfv4tkb046p82fbrurf&retina=true" type="text/javascript"></script>
                <hr />
                <?php echo substr($this->author_info['biography'], 0, 700);?>
                <hr />
                <div class="row">
                    <div class="pull-left">
                        <div data-id="codebasket_rating" data-module_type="author" data-module_id="<?php echo $this->author_info['id']; ?>" data-main_url="<?php echo main_url ?>" data-bigger_stars="true" data-enable="true" data-show_text="true" data-text_size="3"></div>
                    </div>
                    <div class="pull-right">
                        <div data-id="codebasket_like_dislike" data-module_type="author" data-module_id="<?php echo $this->author_info['id'];?>" data-main_url="<?php echo main_url; ?>" data-show_text="true" data-button_size="2" data-enable="true" data-style="<?php echo like_dislike_style; ?>"></div>
                    </div>
                </div>
             
                
            </div>

</div>
      
        <div class="row">
            
    <hr />
    <?php echo showad(3,$this->ads);?>
    <br/>
   <div class="col-md-12"> 
<h1 style="margin:0px; font-weight: 100">
        <?php echo POEMS_BY; ?> <b><?php echo ucwords($this->author_info['Author_name']); ?></b>
                        </h1>
    </div>
                <hr />
                <div class="clearfix"></div>
                <div class="panel panel-default" style="margin-left: 10px;">
       <div class="panel-heading">
        <h3 class="panel-title"><?php echo SHOWING; ?> <?php echo $this->page_array['current_count']; ?> <?php echo OF; ?> <?php echo $this->page_array['total_records']; ?> <?php echo POEMS; ?>
                </h3>
      </div>
         
         <!-- Pagination -->

      <div class="panel-body">
           <?php if($this->page_poems){?>
          
          <?php if($this->page_array['total_records'] > poems_by_author_per_page){ ?>
          <div id="pagination_top" style="margin-top: 5px;"></div>
          <?php } ?>
          
       <table class="table table-striped" style="margin-top: 1px;">
                <thead><tr style="background-color: #dddddd">
                	<th><?php echo SR_NO; ?></th>
                    <th><?php echo POEM_TITLE; ?></th>
                    <th><?php echo RATING; ?></th>
                
                </tr>
              
                </thead><tbody>
                    <?php //pr($this->page_poems) ?>
                   <?php $count=1;foreach($this->page_poems as $page_poems) {?> 
		 <tr>
                 <td><?php echo $count;$count++;?></td>
                 <td><a href="<?php echo get_url($this->database, "poem",$page_poems['id'],$page_poems['poem_slug']); ?>"><?php echo text_limit($page_poems['poem_title'],20); ?></a></td>
                 
                <td>
                    
                  <div class="rating"  data-toggle="tooltip" data-placement="bottom" title="<?php echo get_ratings_text("poems", $page_poems['id'], $this->database) ?>"  style="font-size:16px; color: #e48a07;">
                      <?php show_ratings_html("poems", $page_poems['id'], $this->database, false,false); ?>
                    </div>   
                    
                </td>
         	 </tr>
                   <?php } ?>
       
             </tbody>
</table>

   <?php } else {?>
    <div class="alert-message alert-message-danger" style="margin-right: 10px; margin-left: 10px;">
                   

                    <h4>
                       <?php echo WOOPS; ?></h4>
                    <p class="txt font-16">
                        <?php echo NO_POEM_OF_POET; ?><br /><br />
                    </p>
                </div>
   <?php } ?>
            </div>
           <!-- Pagination -->
           <?php if($this->page_array['total_records'] > poems_by_author_per_page){ ?>
           <div id="pagination_bottom" style="margin-left: 15px;"></div>
          <?php } ?>
  </div>
        </div>          
                
   </div>             

   
    
     <?php echo $this->render("themes/site/".theme_name."/html/elements/sidebar.php");?>
    </div>
    <div class="clearfix"></div>
  <?php echo $this->render("themes/site/".theme_name."/html/elements/footer.php");?>

