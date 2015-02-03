<?php
include(getcwd()."/core/nocsrf.php");

$tpl =  new bQuickTpl();

$tpl->page_title = "Admin Panel";

//pr($_SESSION);

if(isset($_SESSION['admin_user_id'])){
	header("Location: "._admin_url."/index");
}

$errmsg_arr = array();
$errflag = false;

//Defaults
$database->query("CREATE TABLE IF NOT EXISTS `admin_user`(`id` int(250) NOT NULL AUTO_INCREMENT,`username` varchar(250) NOT NULL,`password` varchar(250) NOT NULL,`name` varchar(250) NOT NULL,PRIMARY KEY (`id`)) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1");
$num=$database->count('admin_user');
if($num==0){
	
	//default username=admin,password=admin
	$database->insert('admin_user',array('username'=>'admin','password'=>'21232f297a57a5a743894a0e4a801fc3','name'=>'Administrator'));
	header("Location: "._admin_url);
}

if(isset($params[2]) && $params[2] == "error"){
	$tpl->errors = $_SESSION['ERRMSG_ARR'];
}

if($_POST){
try
    {
        // Run CSRF check, on POST data, in exception mode, for 10 minutes, in one-time mode.
        NoCSRF::check( 'csrf_token', $_POST, true, 60*10, false );
        // form parsing, DB inserts, etc.
        // ...
        $result = 'CSRF check passed. Form parsed.';
	//Clean the input data
	$username = clean($_POST['data']['username']);
	$password = clean($_POST['data']['password']);
	
	//Input Validations
    if($username == '') {
        $errmsg_arr[] = 'Username is missing';
        $errflag = true;
    }
    if($password == '') {
        $errmsg_arr[] = 'Password is missing';
        $errflag = true;
    }
	
	//Find the user in Database
	$get_user = $database->select("admin_user", "*", array(
			"AND" => array(
				"username" => $username,
				"password" => md5($password),
			)
		));
		
		
	if($get_user){
		//Set session
		$_SESSION['admin_user_id'] = $get_user[0]['id'];
		//Put name in session
		$_SESSION['admin_name'] = $get_user[0]['name'];
		$_SESSION['admin_username'] = $get_user[0]['username'];
		//Close session writing
		session_write_close();
		//Redirect to user's page
		 header("Location: "._admin_url."/index");
		 exit();
	}else{
		$errmsg_arr[] = 'No such User found in Database!';
        $errflag = true;
	}
	//If there are input validations, redirect back to the login form
    if($errflag) {
        $_SESSION['ERRMSG_ARR'] = $errmsg_arr;
        session_write_close();
        header("Location: "._admin_url."/login/error");
        exit();
    }
	
	}
    catch ( Exception $e )
    {
        // CSRF attack detected
        $result = $e->getMessage() . ' Form ignored.';
    }
	
	
}	
else
{
    $result = 'No post data yet.';
}
$token = NoCSRF::generate( 'csrf_token' );
$tpl->formtoken = $token;
$tpl->result = $result;

echo $tpl->render("themes/adminarea/html/login.php"); 