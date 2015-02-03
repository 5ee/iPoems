<!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6">
<![endif]-->
<!--[if IE 7]>
<html id="ie7">
<![endif]-->
<!--[if IE 8]>
<html id="ie8">
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html>
<!--<![endif]-->
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width">
    
    <title><?php echo $this->page_title; ?></title>
    
    <link type="text/css" rel="stylesheet" href="<?php echo main_url ?>/themes/adminarea/css/cosmo.css">
    <link type="text/css" rel="stylesheet" href="<?php echo main_url ?>/themes/adminarea/css/font-awesome.css">
    <link type="text/css" rel="stylesheet" href="<?php echo main_url ?>/themes/adminarea/css/font-awesome-ie7.css">
    
    <!--[if lte IE 8]>
    <link type="text/css" rel="stylesheet" href="<?php echo main_url ?>/themes/adminarea/css/ie.css">
    <script type="text/javascript" src="<?php echo main_url ?>/themes/adminarea/js/modernizr.min.js"></script>
    <![endif]-->
    
    <!--[if lte IE 6]>
    <script type="text/javascript" src="<?php echo main_url ?>/themes/adminarea/js/belated.js"></script>
    <![endif]-->
    
    <script type="text/javascript" src="<?php echo main_url ?>/themes/adminarea/js/jquery.js"></script>
    <script type="text/javascript" src="<?php echo main_url ?>/themes/adminarea/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo main_url ?>/libs/parsley-js-validations/parsley.min.js"></script>
    <script type="text/javascript" src="<?php echo main_url ?>/libs/bootstrap-paginator/bootstrap-paginator.js"></script>
    <script type="text/javascript" src="<?php echo main_url ?>/libs/ckeditor/ckeditor.js"></script>
    
   <!-- <link href="<?php echo main_url ?>/libs/bootstrap-fileupload/bootstrap-fileupload.min.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo main_url ?>/libs//bootstrap-fileupload/bootstrap-fileupload.min.js"></script>-->
    <link href="<?php echo main_url ?>/libs/jasny-bootstrap/css/jasny-bootstrap.css" rel="stylesheet" />
	<script type="text/javascript" src="<?php echo main_url ?>/libs/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
    
    <script type="text/javascript">
		$(document).ready(function() {
			$("[data-toggle=tooltip]").tooltip();
			
			var height = $(document).height();;
			$(".sidebarheight").css("height",height-60);
			
		});
	</script>
    <style>
	body{padding-top:60px;
	font-size:13px;}
	.pagination {
		display: inline-block;
		padding-left: 0;
		margin: 0px 0;
		border-radius: 0;
	}
	
	.has-warning .help-block,
.has-warning .control-label {
  color: #ff7518;
}

.has-warning .form-control,
.has-warning .form-control:focus {
  border: 1px solid #ff7518;
}

.has-error .help-block,
.has-error .control-label {
  color: #ff0039;
}

.has-error .form-control,
.has-error .form-control:focus {
  border: 1px solid #ff0039;
}

.has-success .help-block,
.has-success .control-label {
  color: #3fb618;
}

.has-success .form-control,
.has-success .form-control:focus {
  border: 1px solid #3fb618;
}
.parsley-success{
	color:green;
}
.parsley-error{
	color:red;
}
ul.parsley-error-list{
	list-style:none;
	font-size:12px;
	margin-left:-40px;
	color:red;
}
li.parsley-error{
	list-style:none;
	color:red;
}
input.parsley-success, textarea.parsley-success {
        color: #468847 !important;
        background-color: #DFF0D8 !important;
        border: 1px solid #D6E9C6 !important;
}
input.parsley-error, textarea.parsley-error {
	color: #B94A48 !important;
	background-color: #F2DEDE !important;
	border: 1px solid #EED3D7 !important;
}
.panel-title {
margin-top: 0;
margin-bottom: 0;
font-size: 13px;
}
</style>

</head>

<body id="page-name">

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <!-- Brand and toggle get grouped for better mobile display -->
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
                  <a class="navbar-brand" href="<?php echo _admin_url; ?>/index"><i class="icon-home"></i> Administration</a>
  </div>
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav">
      <li class="<?php if($this->vars[1]=='index'){echo 'active';}?>"><a href="<?php echo _admin_url; ?>/index">Dashboard</a></li>
       <li class="<?php if($this->vars[1]=='website_settings'){echo 'active';}?>"><a href="<?php echo _admin_url; ?>/website_settings">Website Settings</a></li>
      
      <!--<li><a href="#">Link</a></li>
      <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
        <ul class="dropdown-menu">
          
         
        </ul>
      </li>-->
    </ul>
    <!--<form class="navbar-form navbar-left" role="search">
      <div class="form-group">
        <input type="text" class="form-control" placeholder="Search">
      </div>
      <button type="submit" class="btn btn-default">Submit</button>
    </form>-->
    <ul class="nav navbar-nav navbar-right">
     <!-- <li><a href="#">Link</a></li>-->
      <li class="dropdown">
         <a href="#" class="dropdown-toggle" data-toggle="dropdown">Welcome, <strong><?php echo $_SESSION['admin_name']; ?></strong> <b class="caret"></b></a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo _admin_url; ?>/changepassword"> Change Password</a></li>
                          <li><a href="<?php echo _admin_url; ?>/managefields"> Manage Fields</a></li>
						  <li><a href="<?php echo _admin_url; ?>/tableicons"> Module Icons</a></li>
                          <li class="divider"></li>
                          <li><a href="<?php echo _admin_url; ?>/alias_management"> Alias Management</a></li>
                          <li class="divider"></li>
                          <li><a href="<?php echo _admin_url; ?>/logout">Logout</a></li>
        </ul>
      </li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>



            
            
            
            <div class="container-fluid">
            
            <div class="row-fluid">
          <div class="col-12 col-lg-2 sidebarheight" style="border-right:1px dashed #cccccc">
          	<?php echo $this->render("themes/adminarea/html/elements/sidebarleft.php")?>
          </div>
          <div class="col-12 col-lg-10">
          	<div class="row-fluid">
          <ol class="breadcrumb">
        <li><a href="<?php echo _admin_url?>">Home</a></li>
		<?php 
		switch($this->vars[1])
		{
			case 'index':
			echo '<li class="active">Dashboard</li>';
			break;
			case 'website_settings':
			echo '<li class="active">Website Settings</li>';
			break;
			case 'adminarea_settings':
			echo '<li class="active"><i class="icon-lock"></i> Admin Area Settings</li>';
			break;
			case 'table':
			{
				echo '<li class="active">Manage Table ('.ucfirst(format_names($this->vars[2])).')</li>';
				break;
			}//case table ends
			case 'upload_csv':
			{
				echo '<li class="active">Upload CSV ('.ucfirst(format_names($this->vars[2])).')</li>';
				break;
			}//case upload_csv ends
			case 'changepassword':
			{
				echo '<li class="active">Change Password</li>';
				break;
			}//case changepassword ends
			case 'managefields':
			{
				echo '<li class="active">Manage Fields</li>';
				break;
			}//case changepassword ends
			case 'add':
			{
				echo '<li><a href="'.main_url.'/adminarea/table/'.$this->vars[2].'">Manage Table ('.ucfirst(format_names($this->vars[2])).')</a></li>';
				echo '<li class="active">Add Record</li>';
				break;
			}//case add ends
			case 'edit':
			{
				echo '<li><a href="'.main_url.'/adminarea/table/'.$this->vars[2].'">Manage Table ('.ucfirst(format_names($this->vars[2])).')</a></li>';
				echo '<li class="active">Edit Record ('.ucfirst($this->vars[3]).')</li>';
				break;
			}//case edit ends
			case 'tableicons':
			{
				echo '<li class="active">Module Icons</li>';
				break;
			}//case edit ends
			case 'search':
			{
				echo '<li class="active">Search Results in "'.ucfirst(format_names($this->vars[2])).'"</li>';
				break;
			}//case search ends
			case 'detail':
			{
				echo '<li><a href="'.main_url.'/adminarea/table/'.$this->vars[2].'">Manage Table ('.ucfirst(format_names($this->vars[2])).')</a></li>';
				echo '<li class="active">Record Details ('.ucfirst($this->vars[3]).')</li>';
				break;
			}//case detail ends
			case 'backup_restore':
			{
				echo '<li class="active">Backup &amp; Restore</li>';
			}//case backup_restore ends
			case 'alias_management':
			{
				echo '<li class="active">Alias Management</li>';
			}//case alias_management ends
		}//switch ends
		?>
      </ol>
