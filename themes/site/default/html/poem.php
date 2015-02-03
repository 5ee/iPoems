<?php echo $this->render("themes/site/" . theme_name . "/html/elements/header.php"); ?>

<div class="container">
    <div class="row" style="margin-top:20px">
        <div class="col-md-8 col-sm-8">

            <h2><?php echo $this->poem['poem_title']; ?> <small><?php echo BY; ?> <?php echo $this->author_info['Author_name']; ?><?php //echo ($this->poem['poem_title'] ? $this->poem['poem_title'] : 'Singles');  ?></small></h2>

            <i class="fa fa-eye"></i> <?php echo VIEWS; ?> <b><?php echo $this->poem['views']; ?></b>
            <hr>
            <div class="pw-widget pw-counter-horizontal">
                <a class="pw-button-facebook pw-look-native"></a>
                <a class="pw-button-twitter pw-look-native"></a>
                <a class="pw-button-googleplus pw-look-native"></a>
                <a class="pw-button-pinterest pw-look-native"></a>
                <a class="pw-button-stumbleupon pw-look-native"></a>
                <a class="pw-button-post-share"></a>
            </div>
            <script src="http://i.po.st/static/v3/post-widget.js#publisherKey=2nfv4tkb046p82fbrurf&retina=true" type="text/javascript"></script>
            <hr>

            <div class="row">
                <div class="col-md-5">   
                    <div data-id="codebasket_rating" data-module_type="poems" data-module_id="<?php echo $this->poem['id']; ?>" data-main_url="<?php echo main_url ?>" data-bigger_stars="true" data-enable="true" data-show_text="true" data-text_size="3"></div>
                </div>

                <div class="col-md-7" >
                    <div  data-id="codebasket_like_dislike" data-module_type="poems" data-module_id="<?php echo $this->poem['id']; ?>" data-main_url="<?php echo main_url; ?>" data-show_text="true" data-button_size="2" data-enable="true" data-style="<?php echo like_dislike_style; ?>"></div>  
                </div>
            </div>

            <hr>





            <div class="row">

                <div class="col-md-12">


                    <div class="col-md-2">
                        <ul class="list-unstyled related-tools">
                            <?php if ($_SESSION['fbid']) { ?>
                                <li>
                                    <a href="javascript:void(0);" id="poem_post_facebook" poem_id="<?php echo $this->poem['id']; ?>">
                                        <span class="fa fa-facebook fa-2x"></span><br>
                                        <span><?php echo POST_TO_FACEBOOK; ?></span>

                                    </a><img src="<?php echo main_url; ?>/uploads/etc/loader.gif" width="20px" height="20px" style="display:none;" id="facebook_loader" class="pull-right">
                                </li>
                            <?php } ?>
                            <li>
                                <a href="#commenttitle">
                                    <span class="fa fa-comment fa-2x"></span><br>
                                    <span><?php echo COMMENTS; ?></span>
                                </a>
                            </li>


                            <?php if (!$this->database->has("saves", array("AND" => array("user_id" => $_SESSION['user_id'], "module_type" => "poems", "module_id" => $this->poem['id'])))) { ?>
                                <li>
                                    <a href="javascript:void(0);" <?php if (!$_SESSION['user_id']) { ?>data-toggle="modal" data-target="#loginmodal"<?php } else { ?>id="add_fav_poem" poem_id="<?php echo $this->poem['id']; ?>"<?php } ?>>
                                        <span class="fa fa-list-alt fa-2x"></span><br>
                                        <span><?php echo ADD_POEM; ?></span>
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if (!$this->database->has("saves", array("AND" => array("user_id" => $_SESSION['user_id'], "module_type" => "author", "module_id" => $this->author_info['id'])))) { ?>
                                <li>
                                    <a href="javascript:void(0);" <?php if (!$_SESSION['user_id']) { ?>data-toggle="modal" data-target="#loginmodal" <?php } else { ?> id="add_fav_poet" poet_id="<?php echo $this->author_info['id']; ?>"<?php } ?>>
                                        <span class="fa fa-user-md fa-2x"></span><br>
                                        <span><?php echo ADD_POET; ?></span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div  class="col-md-10" style="color: #333333;" >
                        <div><?php echo $this->poem['poem']; ?></div>







                        <?php if ($this->poem['topic_id']) { ?>
                            <div class="col-md-12">
                                <div class="tags-bar" style="padding:2px 2px 2px 0">
                                    <p><strong><?php echo TAGS; ?></strong><br />
                                        <?php foreach ($this->poem['topic_id'] as $topic_info) { ?>
                                            <a href="<?php echo get_url($this->database, "topic", $topic_info['topic_id'], $topic_info['topic_slug']) ?>" class="label label-info"><?php echo $topic_info['topic_name'] ?></a>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>


                    </div>
                </div>

            </div>
            <?php echo showad(3, $this->ads); ?> 
            <hr>



            <!--comment system-->
            <?php if (comment_system == "facebook" || comment_system == "disqus" || comment_system == "system") { ?>
                <div class="row" style="margin-left: 2px;" id="commenttitle">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="panel panel-default codebasket-comments">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><?php echo COMMENTS; ?></h3>
                                </div>
                                <div class="panel-body">
                                    <?php if (comment_system == "facebook") { ?>
                                        <div class="fb-comments" data-href="<?php echo current_url(); ?>" data-width="620"></div>
                                        <?php
                                    } else if (comment_system == "disqus") {
                                        ?>
                                        <div id="disqus_thread"></div>
                                        <script type="text/javascript">
                                            /* * * CONFIGURATION VARIABLES: EDIT BEFORE PASTING INTO YOUR WEBPAGE * * */
                                            var disqus_shortname = '<?php echo disqus_shortname; ?>'; // required: replace example with your forum shortname

                                            /* * * DON'T EDIT BELOW THIS LINE * * */
                                            (function() {
                                                var dsq = document.createElement('script');
                                                dsq.type = 'text/javascript';
                                                dsq.async = true;
                                                dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                                                (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                                            })();
                                        </script>
                                        <?php
                                    } else if (comment_system == "system") {
                                        ?>
                                        <div data-id="codebasket_comments" data-module_type="poems" data-module_id="<?php echo $this->poem['id']; ?>" data-main_url="<?php echo main_url; ?>" ></div>   

                                    <?php } else {
                                        ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
            <?php } ?>

            <!--end comment system-->



        </div>
        <div class="col-md-4  col-sm-4">

            <div class="row">
                <div class="media">

                    <?php
                    if (substr($this->author_info['photo'], 0, 7) == "http://") {
                        $src = $this->author_info['photo'];
                    } elseif ($this->author_info['photo']) {
                        $src = main_url . $this->author_info['photo'];
                    } else {
                        $src = "http://placehold.it/100&text=No+Photo";
                    }
                    $src = main_url . "/libs/timthumb/timthumb.php?w=100&h=100&src=" . $src;
                    ?>

                    <a class="pull-left" href="<?php echo get_url($this->database, "poet", $this->author_info['id'], $this->author_info['Author_slug']) ?>">
                        <img class="media-object dp img-circle" src="<?php echo $src ?>">
                    </a>
                    <div class="media-body">
                        <a href="<?php echo get_url($this->database, "poet", $this->author_info['id'], $this->author_info['Author_slug']) ?>"><h5 class="media-heading"><?php echo $this->author_info['Author_name']; ?> <small> </small></h5></a>
                        <div class="rating"  data-toggle="tooltip" data-placement="bottom" title="<?php echo get_ratings_text("author", $this->author_info['id'], $this->database) ?>"  style="font-size:16px; color: #e48a07;">
                            <?php show_ratings_html("author", $this->author_info['id'], $this->database, false, false); ?>
                        </div>
                        <hr style="margin:8px auto">





                    </div>
                </div>
            </div>
            <br/>



            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php echo MORE_FROM_POETS; ?></h3>
                </div>
                <div class="panel-body" style="padding:0px;">
                    <table class="table table-hover table-striped" style="margin: 0px">
                        <tbody>


                            <?php foreach ($this->author_poems as $author_poems) { ?>

                                <tr>
                                    <td width="500"><a href="<?php echo get_url($this->database, "poem", $author_poems['id'], $author_poems['poem_slug']) ?>"><?php echo $author_poems['poem_title']; ?></a>
                                        <a href="<?php echo get_url($this->database, "poet", $this->author_info['id'], $this->author_info['Author_slug']) ?>" style="color:#333"><p><small><?php echo $this->author_info['Author_name']; ?></small></p></a>
                                    </td>
                                    <td width="350">

                                        <div class="rating"  data-toggle="tooltip" data-placement="bottom" title="<?php echo get_ratings_text("poems", $author_poems['id'], $this->database) ?>"  style="font-size:16px; color: #e48a07;">
                                            <?php show_ratings_html("poems", $author_poems['id'], $this->database, false, false); ?>
                                        </div>



                                    </td>
                                </tr>

                            <?php } ?>


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>




    <!-- /container -->
    <?php echo $this->render("themes/site/" . theme_name . "/html/elements/footer.php"); ?>

    <!-- Modal 1-->
    <div class="modal fade" id="loginmodal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true"> 

        <div class="modal-dialog modal-sm" style="width:350px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo LOGIN; ?></h4>
                </div>

                <div class="panel-body">
                    <div class="alert-message alert-message-danger" id="add_poem_error_div" style="display:none">
                        <a class="close" data-dismiss="alert" href="#">&times;</a>
                        <div id="add_poem_error_show"></div>
                    </div>

                    <form method="post" name="csrf_form" action='' class="form" role="form" id="login_formctp" parsley-validate>

                        <div class="form-group">
                            <input type="text" name="" id="addpoem_email" placeholder="<?php echo EMAIL_ADDRESS; ?>" class="form-control" autocomplete="off">
                        </div>  
                        <div class="form-group">

                            <input type="password" name="" placeholder="<?php echo PASSWORD; ?>" id="addpoem_password" class="form-control"  autocomplete="off">
                        </div>

                        <button class="btn btn-info btn-block" id="addpoem_submit" type="button" value='' name=""/><?php echo LOGIN; ?></button>
                        <a href="<?php echo main_url; ?>/register" class="pull-right tp"><?php echo REGISTER; ?></a>
                        <a href="<?php echo main_url; ?>/forgotpassword" class="pull-left tp"><?php echo FORGOT_PASSWORD; ?></a>
                        </br>

                        <div class="login-or">
                            <hr class="hr-or">
                            <span class="span-or"><?php echo OR_LINE; ?></span>
                        </div>

                        <a href="<?php echo $this->loginUrl; ?>" class="btn btn-primary btn-block">
                            <i class="fa fa-facebook"></i> <?php echo CONNECT_WTIH_FACEBOOK; ?>
                        </a> 


                    </form>

                </div>


            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $(".lyrics p.verse").removeAttr('style');
            $(".lyrics p.verse").attr('style', "font-size:17px; color:#3e3e3e; line-height:25px;");
        });
    </script>