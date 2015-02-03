<h1>404 Error: Page Not Found</h1>
<?php 
$vars=$this->vars;
echo '<h3>Can\'t find: <span class="text-danger">'.getcwd().'\modules\adminarea\\'.$vars[1].'.php</span></h3>';
echo '<h3>And This: <span class="text-danger">'.getcwd().'\themes\adminarea\html\\'.$vars[1].'.php</span></h3>';
?>
<a class="btn btn-primary" href="<?php echo _admin_url;?>">Go back to Homepage</a>