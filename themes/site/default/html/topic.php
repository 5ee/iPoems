<?php echo $this->render("themes/site/".theme_name."/html/elements/header.php");
$topic_info = $this->topic_info;
//pr($topic_info);

?>
<div class="container">
<div class="row" style="margin-top:20px">
    <div class="col-md-8">
        <h1 style="margin:0px; font-weight: 100">
        <?php echo TOPIC;?><b><?php echo $topic_info['topic_name'];?></b>
                        </h1>
         <hr />
        <?php echo showad(3,$this->ads);?> 
         <br/>
   
     <div class="panel panel-default">
       <div class="panel-heading">
        <h3 class="panel-title"><?php echo SHOWING;?> <?php echo $this->page_array['current_count']; ?> <?php echo OF;?> <?php echo $this->page_array['total_records']; ?> <?php echo POEMS;?></h3>
      </div>
         <!-- Pagination -->

      <div class="panel-body">
          <?php if($this->topic_poems_info){?>
                  
          
         <?php if($this->page_array['total_records'] > poems_by_topic_per_page){ ?>
                    <div id="pagination_top" style="margin-top: 5px;"></div>
            <?php }?>
          
         
          <table class="table table-striped table-hover" style="margin-top: 1px;">
              <thead>
                  <tr style="background-color: #dddddd">
                      <th style="width:20%"><?php echo SR_NO;?></th>
                      <th><?php echo POEM_TITLE;?></th>
                      <th><?php echo RATING;?></th>
                  </tr>
              </thead>
              <tbody>
                   <?php $count=1;foreach($this->topic_poems_info as $page_poems) {//pr($page_poems);?> 
		 <tr>
                 <td><?php echo $count;$count++;?></td>
                 <td><a href="<?php echo get_url($this->database, "poem", $page_poems['id']."/".$page_poems['poem_slug'])?>"><?php echo text_limit($page_poems['poem_title'],35)?>...</a></td>
                 <td style="font-size:18px;text-align:left;margin-left:-10px">
                      <div class="rating"  data-toggle="tooltip" data-placement="bottom" title="<?php echo get_ratings_text("poems", $page_poems['id'], $this->database) ?>"  style="font-size:16px; color: #e48a07;">
                     <?php show_ratings_html("poems", $page_poems['id'], $this->database, false,false); ?>
                    </div> 
                     
                     
                 </td>
         	 </tr>
                   <?php } ?>
             </tbody>
          </table>

            
          
          <?php if($this->page_array['total_records'] > poems_by_topic_per_page){ ?>
                    <div id="pagination_bottom" style="margin-top: 5px;"></div>
            <?php }?>
                    
           <?php } else {?>
    <div class="alert-message alert-message-danger" style="margin-right: 10px; margin-left: 10px;">
                   

                    <h4>
                        <?php echo WOOPS;?></h4>
                    <p class="txt font-16">
                        <?php echo NO_POEMS_OF_TOPIC;?> <br /><br />
                    </p>
                </div>
           <?php }?>

            </div>
           <!-- Pagination -->
          
      </div>
      
    </div>
    
 <?php echo $this->render("themes/site/".theme_name."/html/elements/sidebar_custom.php");?>
</div>
 


  <?php echo $this->render("themes/site/".theme_name."/html/elements/footer.php");?>