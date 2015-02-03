<?php echo $this->render("themes/site/".theme_name."/html/elements/header.php"); 
$poems_count = $this->database->count("poems");
$authors_count = $this->database->count("authors");

?>

<!-- /container --> 
<div class="container">
<div class="row"  style="margin-top:20px">
<div class="col-md-8">
      <div class="row" style="padding: 10px; text-align:justify;">
    <h1><?php echo $this->page_info['page_title'];?></h1>
    <hr>
        <?php echo $this->page_info['page_content'];?>
    </div>
     
      
    </div>

<?php echo $this->render("themes/site/".theme_name."/html/elements/sidebar.php"); ?>
</div>

<?php echo $this->render("themes/site/".theme_name."/html/elements/footer.php"); ?>
