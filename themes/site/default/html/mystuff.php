<?php echo $this->render("themes/site/".theme_name."/html/elements/header.php"); ?>
<?php $user_data = $this->user_data;$user_data = $user_data[0];?>
<?php $firstname = $this->firstname; ?>
<?php //pr($user_data); ?>
<link href="<?php echo main_url; ?>/libs/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">

<div class="container">
<div class="row" style="margin-top:20px">
    <div class="col-md-12">
        <div class="panel panel-default">
        <div class="panel-heading" style="padding-bottom: 0px;"><ul class="nav nav-tabs" id="myTab" style="border-bottom:0px">
        <li class="active"><a href="#ms" data-toggle="tab"><?php echo MY_FAVOURITE_POEMS;?></a></li>
        <li class=""><a href="#jo" data-toggle="tab"><?php echo MY_FAVOURITE_POETS;?></a></li>
        <li class=""><a href="#rp" data-toggle="tab"><?php echo SAVED_POEMS;?></a></li>
        <li class=""><a href="#sp" data-toggle="tab"><?php echo SAVED_POETS;?></a></li>
        


      </ul></div>
        <div class="panel-body">

      <div class="tab-content">
        <div class="tab-pane active" id="ms">

        <div class="row">
<?php if(!$this->get_rating['poem']) {?>
            <div class="alert-message alert-message-danger" style="margin-right: 10px; margin-left: 10px;">
                   

                    <h4>
                        <?php echo WOOPS;?></h4>
                    <p class="txt font-16">
                        <?php echo NO_FAVOURITE_POEMS;?><br /><br />
                    </p>
                </div>
<?php } else {?>
            <table class="table table-striped table-hover">
              <thead>
                <tr style="background:#ddd;">
                  <th>#</th>
                  <th style="width:40%"><?php echo POEMS;?></th>
                  <th style="width:20%"><?php echo POETS;?></th>
                  <th><?php echo RATINGS;?></th>
                  <th><?php echo CREATED;?></th>
                  <th><?php echo DELETE;?></th>
            </tr>
              </thead>
              <tbody>



             <?php $count = 1; foreach($this->get_rating['poem'] as $fetch_poem){ 
                 if($fetch_poem['author_id']){
                     $fetch_poem['author_id'] = get_author($this->database, $fetch_poem['author_id']);
                 }
//pr($fetch_poem);
                 ?>

                  <tr>
                      
                  <td><?php echo $count;$count++; ?></td>
             <td> <a href="<?php echo get_url($this->database, 'poem', $fetch_poem['id']."/".$fetch_poem['poem_slug']);?>"><?php echo $fetch_poem['poem_title'] ?></a></td>
                 
             <td><a href="<?php echo get_url($this->database, "poet",$fetch_poem['author_id']['id'],$fetch_poem['author_id']['Author_slug']); ?>"><?php echo (isset($fetch_poem['author_id']['Author_name'])?$fetch_poem['author_id']['Author_name']:'No Poet') ?></a></td>
                  <td><div class="rating"  data-toggle="tooltip" data-placement="bottom" title="<?php echo get_ratings_text("poems", $fetch_poem['id'], $this->database) ?>"  style="font-size:16px; color: #e48a07;">
                <?php  show_ratings_html("poems",$fetch_poem['id'],$this->database,false,false);?>
                      </div>
                   </td>
                   <td><?php echo $fetch_poem['created']; ?> </td>
                   <td><a href="<?php echo get_url($this->database,"mystuff","del_favourite_poem",$fetch_poem['id']); ?>" id="del_favourite_poem" poem_id="<?php echo $fetch_poem['id'];?>"><div class="btn btn-primary"><?php echo DELETE;?></div></a></td>
                      
                </tr>
<?php } ?>
        
  </tbody>
            </table>
<?php }?>
      </div>           
        </div>
        
          <div class="tab-pane" id="jo">  

       <div class="row"> 
<?php if(!$this->get_author['author']) {?>
            <div class="alert-message alert-message-danger" style="margin-right: 10px; margin-left: 10px;">
                   

                    <h4>
                        <?php echo WOOPS;?></h4>
                    <p class="txt font-16">
                       <?php echo NO_FAVOURITE_POETS;?><br /><br />
                    </p>
                </div>
<?php } else {?>
            <table class="table table-striped table-hover">
              <thead>
                <tr style="background:#ddd;">
                  <th>#</th>
                  <th style="width:40%"><?php echo TITLE;?></th>
                  <th><?php echo VIEWS;?></th>
                  <th><?php echo RATINGS;?></th>
                  <th><?php echo DELETE;?></th>
                 
                </tr>
              </thead>
              <tbody>

        <?php $count = 1; foreach($this->get_author['author'] as $get_author){ ?>
               <tr>
                  <td><?php echo $count;$count++; ?></td>
                  <td><a href="<?php echo get_url($this->database, "poet",$get_author['id'],$get_author['Author_slug']); ?>"><?php echo $get_author['Author_name'];?></a></td>
                  <td><?php echo $get_author['views'];?></td>
                  <td> 
                      <div class="rating"  data-toggle="tooltip" data-placement="bottom" title="<?php echo get_ratings_text("poems", $get_author['id'], $this->database) ?>"  style="font-size:16px; color: #e48a07;">
                      <?php  show_ratings_html("author",$get_author['id'],$this->database,false,false);?>
                      </div>
                      </td>
                  <td><a href="<?php echo get_url($this->database,"mystuff","del_favourite_poet",$get_author['id']); ?>"><div class="btn btn-primary"><?php echo DELETE;?></div></a></td>
                </tr>
        <?php } ?>
            </tbody>
</table>
<?php }?>
</div>     
            
        </div>
        <div class="tab-pane" id="rp">

        <div class="row">
<?php if(!$this->saved_poems) {?>
            <div class="alert-message alert-message-danger" style="margin-right: 10px; margin-left: 10px;">
                   

                    <h4>
                        <?php echo WOOPS;?></h4>
                    <p class="txt font-16">
                        <?php echo NO_SAVED_POEMS;?><br /><br />
                    </p>
                </div>
<?php } else {?>
            <table class="table table-striped table-hover">
              <thead>
                <tr style="background:#ddd;">
                  <th>#</th>
                  <th style="width:40%"> <?php echo POEMS;?></th>
                  <th style="width:20%"> <?php echo POETS;?></th>
                  <th> <?php echo RATINGS;?></th>
                  <th> <?php echo CREATED;?></th>
                  <th> <?php echo DELETE;?></th>
            </tr>
              </thead>
              <tbody>



             <?php $count = 1; foreach($this->saved_poems as $fetch_poem){ 
                 if($fetch_poem['author_id']){
                     $fetch_poem['author_id'] = get_author($this->database, $fetch_poem['author_id']);
                 }
//pr($fetch_poem);
                 ?>

                  <tr>
                      
                  <td><?php echo $count;$count++; ?></td>
             <td> <a href="<?php echo get_url($this->database, 'poem', $fetch_poem['id']."/".$fetch_poem['poem_slug']);?>"><?php echo $fetch_poem['poem_title'] ?></a></td>
                 
             <td><a href="<?php echo get_url($this->database, "poet",$fetch_poem['author_id']['id'],$fetch_poem['author_id']['Author_slug']); ?>"><?php echo (isset($fetch_poem['author_id']['Author_name'])?$fetch_poem['author_id']['Author_name']:'No Poet') ?></a></td>
                  <td> <div class="rating"  data-toggle="tooltip" data-placement="bottom" title="<?php echo get_ratings_text("poems", $fetch_poem['id'], $this->database) ?>"  style="font-size:16px; color: #e48a07;">
                <?php  show_ratings_html("poems",$fetch_poem['id'],$this->database,false,false);?>
                      </div>
                   </td>
                   <td><?php echo $fetch_poem['created']; ?> </td>
                   <td><a href="<?php echo get_url($this->database,"mystuff","del_saved_poem",$fetch_poem['id']); ?>"><div class="btn btn-primary"> <?php echo DELETE;?></div></a></td>
                      
                </tr>
<?php } ?>
        
  </tbody>
            </table>
<?php }?>
      </div>           
        </div>

          <div class="tab-pane" id="sp">
              <div class="row"> 
<?php if(!$this->saved_poets) {?>
           <div class="alert-message alert-message-danger" style="margin-right: 10px; margin-left: 10px;">
                 

                    <h4>
                         <?php echo WOOPS;?></h4>
                    <p class="txt font-16">
                         <?php echo NO_SAVED_POETS;?><br /><br />
                    </p>
                </div>
<?php } else {?>
            <table class="table table-striped table-hover">
              <thead>
                <tr style="background:#ddd;">
                  <th>#</th>
                  <th style="width:40%"> <?php echo TITLE;?></th>
                  <th> <?php echo VIEWS;?></th>
                  <th> <?php echo RATINGS;?></th>
                  <th> <?php echo DELETE;?></th>
                 
                </tr>
              </thead>
              <tbody>

        <?php $count = 1; foreach($this->saved_poets as $get_author){//pr($get_author); ?>
                
               <tr>
                  <td><?php echo $count;$count++; ?></td>
                  <td><a href="<?php echo get_url($this->database, "poet",$get_author['id'],$get_author['Author_slug']); ?>"><?php echo $get_author['Author_name'];?></a></td>
                  <td><?php echo $get_author['views'];?></td>
                  <td> 
                       <div class="rating"  data-toggle="tooltip" data-placement="bottom" title="<?php echo get_ratings_text("author", $get_author['id'], $this->database) ?>"  style="font-size:16px; color: #e48a07;">
                      <?php  show_ratings_html("author",$get_author['id'],$this->database,false,false);?>
                       </div>
                       </td>
                  <td><a href="<?php echo get_url($this->database,"mystuff","del_saved_poet",$get_author['id']); ?>"><div class="btn btn-primary"> <?php echo DELETE;?></div></a></td>
                </tr>
        <?php } ?>
            </tbody>
</table>
<?php }?>
</div>     
            
        </div>
      </div>
        </div>
      </div>
    </div>
    
</div>

<?php echo $this->render("themes/site/".theme_name."/html/elements/footer.php"); ?>
<script src="<?php echo main_url; ?>/libs/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo main_url; ?>/libs/parsley-js-validations/parsley.min.js"></script>


<?php if ($this->params[1] == 'success'){?>
<script>
$(function(){
    setTimeout(function(){
        window.location="<?php echo main_url?>/login";
    },2000);
});
</script>
<?php }?>

