<?php echo $this->render("themes/site/" . theme_name . "/html/elements/header.php") ?>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-sm-8">
            <h1><?php echo SITEMAP;?></h1>
            <hr />
            
            <h3><?php echo POEMS;?></h3>
            <hr>
            <ul>    
                <?php foreach($this->poem_urls as $url){?>
                <li><a href="<?php echo $url['url'];?>" target="_blank"><?php echo $url['title'];?></a></li>
                <?php }?>
                
            </ul><h3><?php echo AUTHOR_NAME;?></h3>
            <hr>
            <ul>    
                <?php foreach($this->author_urls as $url){?>
                <li><a href="<?php echo $url['url'];?>" target="_blank"><?php echo $url['title'];?></a></li>
                <?php }?>
                
            </ul>
            
             </ul><h3><?php echo TOPICS;?></h3>
            <hr>
            <ul>    
                <?php foreach($this->topic_urls as $url){?>
                <li><a href="<?php echo $url['url'];?>" target="_blank"><?php echo $url['title'];?></a></li>
                <?php }?>
                
            </ul>
            
           
            
            
            <h3><?php echo PAGES;?></h3>
            <hr>
            <ul>    
                <?php foreach($this->page_urls as $url){?>
                <li><a href="<?php echo $url['url'];?>" target="_blank"><?php echo $url['title'];?></a></li>
                <?php }?>
                
            </ul>
            
            
            
            
            
            
            
            
            
        </div> 
         
            <?php echo $this->render("themes/site/" . theme_name . "/html/elements/sidebar.php") ?> 
        
    </div>
</div>
<!-- /container --> 



<?php echo $this->render("themes/site/" . theme_name . "/html/elements/footer.php") ?>
