<?php $user_image = $this->user_image;
$user_image = $user_image[0]
?>
<?php //pr($user_image);   ?>
<?php $user_profile = $this->user_profile; ?>

<!DOCTYPE html>
<html>
    <head>
        <!-- All meta content -->
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width">

        <title><?php echo $this->page_title; ?> | <?php echo site_name; ?></title>
        <meta name="title" content="<?php echo $this->page_title; ?>"  />
        <meta name="description" content="<?php echo $this->page_description; ?>"  />
        <meta name="keywords" content="<?php echo $this->keywords; ?>"  />

        <meta property="og:title" content="<?php echo $this->page_title; ?> | <?php echo site_name; ?>"/> 
        <meta property="og:url" content="<?php echo current_url(); ?>"/>
        <meta property="og:image" content="<?php echo $this->page_image; ?>" />
        <meta property="og:site_name" content="<?php echo site_name; ?>"/>
        <meta property="og:description" content="<?php echo $this->page_description; ?>" />
        <meta property="og:type" content="website">
        <meta property="fb:app_id" content="<?php echo fb_application_id; ?>">

        <meta property="fb:admins" content="<?php echo fb_admin_id; ?>" />
        <meta name="google-site-verification" content="<?php echo google_webmasters_verification_code; ?>" />
        <meta name="msvalidate.01" content="<?php echo bing_webmasters_verification_code; ?>" /> 
        <script type="text/javascript">

            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', ' <?php echo google_analytics_code; ?>']);
            _gaq.push(['_trackPageview']);

            (function() {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(ga);
            })();

        </script>

        <link rel="shortcut icon" href="<?php echo main_url; ?>/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo main_url; ?>/favicon.ico" type="image/x-icon">
        <link rel="canonical" href="<?php echo main_url; ?>">
         <link rel="alternate" type="application/rss+xml" title="<?php echo site_name; ?>  RSS Feed" href="<?php echo main_url; ?>/rss" />
        <meta content="1 days" name="revisit" /> 
        <meta content="index, follow" name="robots" /> 
        <meta name="robots" content="index,follow"> 

        <!-- All meta content -->


        <!-- Bootstrap -->
        <link href="<?php echo main_url; ?>/themes/site/<?php echo theme_name; ?>/css/bootstrap.css" rel="stylesheet">
        <link href="<?php echo main_url; ?>/themes/site/<?php echo theme_name; ?>/css/style.css" rel="stylesheet">
        <link href="<?php echo main_url; ?>/libs/jasny-bootstrap/css/jasny-bootstrap.min.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="<?php echo main_url; ?>/themes/site/<?php echo theme_name; ?>/css/datepicker.css">
        <link href="<?php echo main_url; ?>/themes/site/<?php echo theme_name; ?>/css/rtl.css" rel="stylesheet">
        <link href="<?php echo main_url; ?>/themes/site/<?php echo theme_name; ?>/css/font-awesome.css" rel="stylesheet">
        <link href="<?php echo main_url; ?>/themes/site/<?php echo theme_name; ?>/css/kMyR.css" rel="stylesheet" type="text/css">
        <link href="<?php echo main_url; ?>/libs/jquery-ui/jquery-ui.css" rel="stylesheet">




        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
              <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
            <![endif]-->
    </head> 

    <body id="page-name">
          <div id="fb-root"></div>
        <script>(function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo fb_application_id;?>";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>



        <!-- Fixed navbar -->
        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="fa fa-bar"></span> <span class="fa fa-bar"></span> <span class="fa fa-bar"></span> </button>
                    <a class="navbar-brand" style="padding:11px;" href="<?php echo main_url; ?>"><img width="210" src="<?php echo main_url . website_logo ?>"></a> </div>
                <div class="navbar-collapse collapse">

                    <ul class="nav navbar-nav">
                        <li class="<?php
                            if (!$this->params[0]) {
                                echo "active";
                            }
                            ?>"><a href="<?php echo main_url; ?>"><?php echo HOME; ?></a></li>
                        <li class="<?php
                        if ($this->params[0] == "topics") {
                            echo "active";
                        }
                        ?>"><a href="<?php echo main_url; ?>/topics"><?php echo TOPICS; ?></a></li>
                        <li class="<?php
                    if ($this->params[0] == "poets") {
                        echo "active";
                    }
                    ?>"><a href="<?php echo main_url; ?>/poets"><?php echo POETS; ?></a></li>
                    </ul>


<?php //pr($_SESSION);   ?> 

<?php if (isset($_SESSION['fbid'])) { ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">     
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding: 10px;">
                                    <img  width="30" height="30" class="img-circle" src="https://graph.facebook.com/<?php echo $_SESSION['fbid']; ?>/picture?type=small" alt=""> 
                                    <span><?php echo ucwords($_SESSION['uname']); ?></span>&nbsp;<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo main_url; ?>/mystuff"><?php echo USER_STUFF; ?></a></li>
                                    <li><a href="<?php echo main_url; ?>/edit_profile"><?php echo EDIT_PROFILE; ?></a></li>

                                    <li class="divider"></li>
                                    <li ><a href="<?php echo main_url; ?>/logout"><?php echo LOGOUT; ?></a></li>
                                </ul>
                            </li>
                        </ul>
                        <?php
                    } elseif (isset($_SESSION['user_id'])) {

                        if ($user_image['picture'] == "") {
                            $user_image['picture'] = "http://placehold.it/40x40&text=No+Image";
                        } else {
                            $user_image['picture'] = main_url . "/uploads/user_pics/" . $user_image['picture'];
                        }
                        ?>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">     
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding: 10px;">


                                    <img  width="30" height="30" class="img-circle" src="<?php echo main_url; ?>/libs/timthumb/timthumb.php?w=30&h=30&src=<?php echo $user_image['picture']; ?>" alt=""> 




                                    <span><?php echo ucwords($_SESSION['full_name']); ?></span>&nbsp;<b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo main_url; ?>/mystuff"><?php echo USER_STUFF; ?></a></li>
                                    <li><a href="<?php echo main_url; ?>/edit_profile"><?php echo EDIT_PROFILE; ?></a></li>
                                    <li><a href="<?php echo main_url; ?>/changepassword"><?php echo CHANGE_PASSWORD; ?></a></li>
                                    <li class="divider"></li>
                                    <li ><a href="<?php echo main_url; ?>/logout"><?php echo LOGOUT; ?></a></li>
                                </ul>
                            </li>
                        </ul>

                        <?php } else { ?>
                        <ul class="nav navbar-nav navbar-right">
    <?php //if($this->params[0] != "login"){  ?>
                            <li><a href="<?php echo main_url; ?>/register"><?php echo LOGIN_REGISTER; ?></a></li>
    <?php //}if($this->params[0] != "register"){ ?>
    <!--                                  <li ><a href="<?php //echo main_url;   ?>register">Login/Register</a></li>-->

<?php } ?>
<?php //}   ?>
                    </ul>     
                </div>
                <!--/.nav-collapse -->
            </div>
        </div>

