<?php echo $this->render("themes/site/".theme_name."/html/elements/header.php"); ?>

<!-- /container --> 

<div class="container">
 <div class="row" style="margin-top:20px">
  <div class="col-md-8">
      <h2><?php echo SEARCH_RESULT_FOR_KEYWORD; ?> '<?php echo $this->keyword;?>'</h2>
    <div class="panel panel-default" style="margin-top: 30px;">
     
       <div class="panel-body">
          <?php if($this->search_results){?> 
      
       <table class="table table-striped table-hover" style="margin-top: 0px;">
              <thead>
                  <tr style="background-color: #dddddd">
                      <th style="width:10%"><?php echo SR_NO;?></th>
                      <th><?php echo POEM_TITLE;?></th>
                      <th><?php echo RATING;?></th>
                  </tr>
              </thead>
              <tbody>
                   <?php $count=1;foreach($this->search_results as $page_poems) {//pr($page_poems);?> 
		 <tr>
                 <td><?php echo $count;$count++;?></td>
                 <td><a href="<?php echo get_url($this->database, "poem", $page_poems['id']."/".$page_poems['poem_slug'])?>"><?php echo text_limit($page_poems['poem_title'],35)?>...</a></td>
                 <td style="font-size:18px;text-align:left;margin-left:-10px">
                      <div class="rating"  data-toggle="tooltip" data-placement="bottom" title="<?php echo get_ratings_text("poems", $page_poems['id'], $this->database) ?>"  style="font-size:16px; color: #e48a07;">
                     <?php  show_ratings_html("poems",$page_poems['id'],$this->database,false,false);?>
                      </div>
                     </td>
         	 </tr>
                   <?php } ?>
             </tbody>
          </table>
       <?php } else {?>
       <div class="alert-message alert-message-danger" style="margin-right: 10px; margin-left: 10px;">
                  

                    <h4>
                       <?php echo WOOPS;?></h4>
                    <p class="txt font-16">
                        <?php echo NO_POEM_OF_KEYWORD;?> <br /><br />
                    </p>
                </div>
           <?php }?>

            </div>
        
       </div> 
      <?php echo showad(3,$this->ads);?>
      <div id="pagination_bottom"></div>
   </div>


<?php echo $this->render("themes/site/".theme_name."/html/elements/sidebar.php"); ?>  
 </div>
<?php echo $this->render("themes/site/".theme_name."/html/elements/footer.php"); ?>
