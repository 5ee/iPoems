


<hr>
</div><hr>
<div class="footer" style="background-color: #FFF;">
    <div class="container">
  <div class="row">
  <div class="col-md-12">
      <div class="row">

          <div class="col-md-8">
  <ul class="list-footer">
     <?php foreach ($this->all_pages as $pages) { ?>
      <li><a href="<?php echo main_url; ?>/<?php echo ($this->aliases_flip['page'] ? $this->aliases_flip['page'] : 'page') ?>/<?php echo $pages['id']; ?>/<?php echo $pages['page_slug']; ?>" style="cursor:pointer;"><?php echo $pages['page_title']; ?></a></li> 
            <?php } ?>
            
                        <li> <a href="<?php echo main_url; ?>/rss"><?php echo RSS;?></a></li>
                        <li> <a href="<?php echo main_url; ?>/sitemap"><?php echo SITEMAP;?></a></li> 
  
  </ul> 
          </div>  
                    <div class="col-md-4">
                        <a href="<?php echo main_url; ?>" class="navbar-brand pull-right" style="margin-right:-15px;">
            <img style="margin-top: -15px; " src="<?php echo main_url; ?><?php echo website_logo;?>" width="180" alt="logo" class="logo desaturate"></a> 
  
          </div>
      </div>   
  </div> 
      <div class="col-md-12">
          <hr> 
         
        
          <div class="row" style="margin-left: 1px;" >
       <p style="float: left;"><?php echo copyright;?></p>      
             <div class="pull-right rightsocialicons   hidden-xs hidden-sm" style="padding-top:px; color: #ffffff; margin-right:15px;">
     <a href="<?php echo fb_page_url?>" target="_blank"><i class="fa fa-2x fa-facebook-square fbbutton"></i></a>
     <a href="<?php echo twitter_url?>" target="_blank"><i class="fa fa-2x fa-twitter-square twitterbutton"></i></a>
     <a href="<?php echo googleplus_url?>" target="_blank"><i class="fa fa-2x fa-google-plus-square googlebutton"></i></a>
     <a href="<?php echo pinterest_url?>" target="_blank"><i class="fa fa-2x fa-pinterest-square pinterestbutton"></i></a>
    </div>
          
        </div>
        
        
          
      </div>
  </div>   
 </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo main_url; ?>/themes/site/<?php echo theme_name; ?>/js/jquery.js"></script> 
<script src="<?php echo main_url; ?>/libs/jquery-ui/jquery-ui.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="<?php echo main_url; ?>/themes/site/<?php echo theme_name; ?>/js/bootstrap.min.js"></script>

<script type="text/javascript" src="<?php echo main_url ?>/libs/bootstrap-paginator/bootstrap-paginator.js"></script>
<script src="<?php echo main_url; ?>/libs/jasny-bootstrap/js/jasny-bootstrap.min.js"></script>
<script src="<?php echo main_url; ?>/libs/parsley-js-validations/parsley.min.js"></script>
<script src="<?php echo main_url; ?>/themes/site/<?php echo theme_name; ?>/js/print.js"></script>


<script>
    $(document).ready(function(e) {
        //$('.dropdown-toggle').dropdown();
        $("[data-toggle=tooltip]").tooltip();
        $("[data-toggle=popover]").popover();
    });
</script>
<script type="text/javascript">
    // call date picker


    $(document).ready(function() {

<?php
$pagination_pages = array(
    "topic",
    "poets",
    "poet",
    "topics",
    "search"
);
foreach ($pagination_pages as $module) {
    if ($this->page_array['param_vars'][0] == alias_name($this->database, $module)) {
        ?>

                var options = {
                    currentPage: <?php echo $this->page_array['current_page']; ?>,
                    totalPages: <?php echo $this->page_array['total_pages']; ?>,
                    numberOfPages: 8,
                    alignment: "left",
                    pageUrl: function(type, page, current) {
                        var ret = '';
        <?php
        $param_vars = $this->page_array['param_vars'];
        $skip = false;
        $before = main_url;
        $after = '';
        foreach ($param_vars as $var) {
            if ($skip == false) {
                if ($var == $this->page_array['page_no_var']) {
                    $skip = true;
                } else {
                    $before.="/" . $var;
                }
            } else {
                $after.="/" . $var;
            }
        }
        ?>
                        ret += '<?php echo $before ?>/p:' + page;
                        ret += '<?php echo $after ?>';
                        return ret;
                    },
                    useBootstrapTooltip: true,
                    itemContainerClass: function(type, page, current) {
                        return (page === current) ? "active" : "pointer-cursor";
                    },
                    tooltipTitles: function(type, page, current) {
                        switch (type) {
                            case "first":
                                return "Go to First Page";
                            case "prev":
                                return "Go to Previous Page";
                            case "next":
                                return "Go to Next Page";
                            case "last":
                                return "Go to Last Page";
                            case "page":
                                return "Go to page " + page;
                        }
                    }
                }
                $('#pagination_top, #pagination_bottom').bootstrapPaginator(options);
        <?php
    }
}
?>
    });


</script>



<script type="text/javascript">

    // call date picker
    $(document).ready(function() {
        function error(e) {
            console.log(e);
        }
        function disable(e) {
            e.prop("disabled", true)
        }
        function enable(e) {
            e.prop("disabled", false)
        }

        $("#datepicker").datepicker({
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            dateFormat: 'yy-mm-dd',
            yearRange: "-100:+0", // last hundred years
        });

//        $('span[data-id="topic_quotes_count"]').each(function() {
//            var topic_id = $(this).attr('data-topic_id');
//            $.post('<?php echo main_url ?>/common', {action: 'get_topic_quotes_count', topic_id: topic_id}, function(data) {
//                $('span[data-topic_id="' + topic_id + '"]').text(data);
//            });
//        });// update jokes views with ajax
//
//        $("a#poems_views").click(function() {
//            var poems_id = $(this).attr("data-poems_id");
//            var next = $(this).attr("data-href");
//            $.post('<?php echo main_url ?>/common', {action: 'increment picture views', poems_id: poems_id}, function(data) {
//                window.location = next;
//            });
//        });
        // end update views
        // for add poem in poem list
        $("#addpoem_submit").click(function() {
            var email = $("#addpoem_email").val();
            var password = $("#addpoem_password").val();
            var err_arr = [];
            var err_trgr = false;
            if (!email) {
                err_arr.push("User email is missing");
                err_trgr = true;
            }
            if (!password) {
                err_arr.push("Password is missing");
                err_trgr = true;
            }
            if (err_trgr === false) {
                $.post('<?php echo main_url; ?>/common', {action: 'add_poem', email: email, password: password}, function(data) {
                    data = $.parseJSON(data);
                    if (data['status'] == 'success') {
                        window.location = "<?php echo main_url; ?>/mystuff";
                    }
                    if (data['status'] == 'error') {
                        $("#add_poem_error_div").show();
                        $("#add_poem_error_show").html('');
                        $.each(data['error'], function(l, v) {
                            $("#add_poem_error_show").append("<li>" + v + "</li>");
                        });
                    }
                });
            } else {
                $("#add_poem_error_div").show();
                $("#add_poem_error_show").html('');
                $.each(err_arr, function(l, v) {
                    $("#add_poem_error_show").append("<li>" + v + "</li>");
                });
            }
        });

        $('#add_fav_poem').click(function() {
            var poem_id = $(this).attr('poem_id');
            $.post("<?php echo main_url; ?>/common", {action: "add_fav_poem", poem_id: poem_id}, function(data) {
                if (data == '1')
                    alert("<?php echo SUCCESS_ALERT_ADD_POEM; ?>");
                window.location = "<?php echo main_url; ?>/poem/"+poem_id;
            });
        });

        $('#add_fav_poet').click(function() {
            var poet_id = $(this).attr('poet_id');
            $.post("<?php echo main_url; ?>/common", {action: "add_fav_poet", poet_id: poet_id}, function(data) {
                if (data == '1')
                   alert("<?php echo SUCCESS_ALERT_ADD_POET; ?>");
               location.reload();
            });
        });
        
        $('#poem_post_facebook').click(function() {
         $("#facebook_loader").css("display","block");
            var poem_id = $(this).attr('poem_id');
            $.post("<?php echo main_url; ?>/common", {action: "post_to_facebook", poem_id: poem_id}, function(data) {
                if(data)
                    $("#facebook_loader").css("display","none");
                    alert("Successfully posted to facebook");
            });
            
        });


// end for add poem in favourite poems list
        
        //delete fav poem from my stuff
        $("a#del_favourite_poem").click(function(){
            var poem_id = $(this).attr('poem_id');
            alert(poem_id);
        });
    });


    // Javascript to enable link to tab
    var url = document.location.toString();
    if (url.match('#')) {
            $('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
    } 

    $('.nav-tabs a').on('click', function (e) {
            window.location.hash = e.target.hash;
    })

    // Change hash for page-reload
    $('.nav-tabs a').on('shown', function (e) {
            window.location.hash = e.target.hash;
    })



</script>


<script type="text/javascript" src="<?php echo main_url; ?>/includes/site-actions/site-actions.js"></script>
</body>
</html>
