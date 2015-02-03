<?php echo $this->render("themes/adminarea/html/elements/header.php") ?>

<?php if ($this->vars[2] == "lists" || $this->vars[2] == "items") { ?>
<?php } elseif ($this->vars[2] != "comments" && $this->vars[2] != "ratings" && $this->vars[2] != "saves") { ?>
    <a href="<?php echo _admin_url; ?>/add/<?php echo $this->vars[2]; ?>" class="btn pull-right btn-success"><i class="icon-plus"></i> Add a Record</a>
<?php } ?>

<!-- Split button -->

<?php
// Check if Table Exists in File Fields Array
$file_fields_array = array('image' => array(), 'file' => array());
if (array_key_exists($this->table, $this->file_fields)) {
    $file_fields = $this->file_fields[$this->table];
    foreach ($file_fields as $db_key => $field_info) {
        $file_fields_array[$field_info['type']][$db_key] = $field_info['field'];
    }
} else {
    $file_fields = $this->file_fields;
}

$rel_main_fields_array = array();
$rel_simple_fields_array = array();
//pr($this->get_another_data);
foreach ($this->get_another_data as $db_id => $rel_info) {
    if ($rel_info['is_multiple'] == 1 and $rel_info['main_table'] == $this->table)
        $rel_main_fields_array[] = $rel_info['main_field'];
    else
        $rel_simple_fields_array[] = $rel_info['main_field'];
}
//pr($rel_simple_fields_array);
?>


<h1><strong>Manage:</strong> <em><?php echo format_names($this->vars[2]); ?> (<?php echo $this->total_records; ?>)</em> </h1>
<hr />


<div class="col-lg-12" style="margin-top:0px; padding:0px">
    <div class="col-lg-3" style="padding:0px">
        <form action="<?php echo _admin_url; ?>/search/<?php echo $this->vars[2]; ?>"  name="csrf_form" method="post" style="padding:0px;">
            <input type="hidden" name="csrf_token" value="<?php echo $this->formtoken; ?>">

            <div class="input-group">
                <input type="text" style="padding:5px;height:34px" class="form-control input-sm" name="q" placeholder="Search for a Record...">
                <span class="input-group-btn">
                    <button class="btn btn-success" type="submit">Search!</button>
                </span> </div>
            <!-- /input-group -->
        </form>
    </div>
    <div class="col-lg-9" style="padding:0px">

        <div class="btn-group pull-right" style="margin-left:10px;">
            <button type="button" class="btn btn-primary">Bulk Actions</button>
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="javascript:void(0);" id="publishrecords">Publish</a></li>
                <li><a href="javascript:void(0);" id="unpublishrecords">Unpublish</a></li>
                <li class="divider"></li>
                <li><a href="javascript:void(0);" id="deleteselectedrecords"><i class="icon-remove"></i> Delete all</a></li>
            </ul>
        </div>
        <a style="margin-left:10px" data-toggle="tooltip" data-original-title="Download CSV" data-placement="top" href="<?php echo _admin_url; ?>/download_csv/<?php echo $this->vars[2]; ?>/true" class="btn btn-primary downloadcsv"><i class="icon-download-alt  icon-white"></i> Download CSV</a> 
<?php if ($this->vars[2] != "comments" && $this->vars[2] != "ratings" && $this->vars[2] != "saves") { ?>
            <a data-toggle="tooltip" data-original-title="Upload data using CSV" data-placement="top" href="<?php echo _admin_url; ?>/upload_csv/<?php echo $this->vars[2]; ?>" class="btn btn-success"><i class="icon-upload icon-white"></i> Upload CSV</a> 
        <?php } ?>

<!--   <a href="javascript:void();" style="margin-left:10px;" data-toggle="tooltip" data-original-title="Delete All Records from this Table" data-placement="top" class="btn btn-danger deleteallrecords"><i class="icon-trash icon-white"></i> </a> -->
        <?php if ($this->vars[2] == "submission") { ?>

            <a style="margin-left:10px" data-toggle="tooltip" data-original-title="Download CSV" data-placement="top" class="btn btn-primary approvesubmissions"><i class="icon-check  icon-white"></i>Approve Selected</a> 

<?php } ?>


        <i class="icon-spinner icon-spin icon-large contentloader" style="display:none"></i>

    </div>
</div>

<br /><br /><br />
<!-- /.row -->

<div class="col-lg-12" style="margin-top:0px; padding:0px">
    <div class="well well-small" style="background:#ffffff">
<?php
//pr($this->records);
if ($this->total_records == 0) {
    ?>
            <div class="alert alert-block alert-danger fade in">
                <h4>Oh snap! Theres no Data over here!</h4>
                <p>Please add some data to show it here! Hit the Add a Record button to add a new item in this table!</p>
            <?php if ($this->vars[2] != "comments" && $this->vars[2] != "ratings" && $this->vars[2] != "saves") { ?>
                    <p> <a href="<?php echo _admin_url; ?>/add/<?php echo $this->vars[2]; ?>" class="btn btn-success"><i class="icon-plus"></i> Add a Record</a> </p>
    <?php } ?> 
            </div>
            <?php } else {
                ?>
            <div class="well well-small pull-right" style="padding:6px;"> Per Page:
                <select class="show-per-page">
                    <option value="10" <?php if ($this->perpage == 10) {
                    echo "selected='selected'";
                } ?>>10</option>
                    <option value="25" <?php if ($this->perpage == 25) {
                    echo "selected='selected'";
                } ?>>25</option>
                    <option value="50" <?php if ($this->perpage == 50) {
                    echo "selected='selected'";
                } ?>>50</option>
                    <option value="100" <?php if ($this->perpage == 100) {
                    echo "selected='selected'";
                } ?>>100</option>
                    <option value="250" <?php if ($this->perpage == 250) {
                    echo "selected='selected'";
                } ?>>250</option>
                    <option value="all" <?php if ($this->perpage == 'all') {
                    echo "selected='selected'";
                } ?>>all</option>
                </select>

            </div>
            <div id="pagination_top"></div>

            <table class="table table-striped table-bordered table-hover table-responsive" style="padding:10px;" id="myTable">
                <thead>
                    <tr >
                        <th><center>
                    <i class="icon-check checkall"></i>
                </center></th>
                        <?php
                        foreach ($this->table_headers as $header) {
                            ?>
                    <th><a href="javascript:void(0);" class="sortbyASC" fieldname="<?php echo $header; ?>" method="<?php if ($this->current_order == "ASC") {
                echo "DESC";
            } else {
                echo "ASC";
            } ?>"><?php echo format_names($header); ?>
                    <?php if ($this->current_order == "ASC") { ?>
                                <i class="icon-sort-by-attributes"></i>
                    <?php } else { ?>
                                <i class="icon-sort-by-attributes-alt"></i>
        <?php } ?>
                        </a>
                    </th>
                    <?php } ?>
                    <?php if ($this->vars[2] == "ad_zones") { ?>
                    <th>Get Code</th>
                    <?php } ?>

    <?php if ($this->vars[2] == "submission") { ?>
                    <th>Approve?</th>
                <?php } ?>
                <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($this->records as $record => $value) {
                    $id = $value[$this->tb_primaryid];
                    ?>
                        <tr record_id="<?php echo $id; ?>" id="row_<?php echo $id; ?>">
                            <td width="40"><center>
                        <input type="checkbox" class="checkrecord" id="<?php echo $id; ?>" />
                    </center></td>
                    <?php
                    foreach ($value as $key => $val) {

                        if (in_array($key, $file_fields_array['file'])) {
                            $cur_dir = getcwd();
                            if (file_exists($cur_dir . $val))
                                $val = '<a class="btn btn-xs btn-primary" href="' . main_url . $val . '" target="_blank">Preview</a>';
                            else
                                $val = '<span style="cursor:pointer" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="File not Found">&nbsp;&nbsp;&nbsp;Error&nbsp;&nbsp;&nbsp;</span>';
                        }

                        if (in_array($key, $file_fields_array['image'])) {
                            $cur_dir = getcwd();
                            if (file_exists($cur_dir . $val) and $val)
                                $val = '<a href="' . main_url . $val . '" target="_blank"><img class="img-thumbnail" src="' . main_url . $val . '" width="150" /></a>';
                            else
                                $val = '<span style="cursor:pointer" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="" data-original-title="File not Found">&nbsp;&nbsp;&nbsp;Error&nbsp;&nbsp;&nbsp;</span>';
                        }
                        if (in_array($key, $rel_main_fields_array)) {
                            $got_db_result = unserialize($val);
                            $content = $value;
                            $val = '';
                            $val = '<div class="list-group">';
                            foreach ($this->custom_data[$key]['data'] as $key_option => $val_option) {
                                if (in_array($val_option[$this->custom_data[$key]['attributes']['value']], $got_db_result)) {
                                    //pr($this->custom_data[$key]);exit;
                                    $val.='<a class="list-group-item" href="' . _admin_url . "/detail/" . $this->custom_data[$key]['attributes']['secondary_table'] . '/rec:' . $val_option[$this->custom_data[$key]['attributes']['value']] . '">' . $val_option[$this->custom_data[$key]['attributes']['seconday_field']] . '</a>';
                                }
                            }
                            $val.="</div>";
                        } elseif (in_array($key, $rel_simple_fields_array)) {
                            $content = $value;
                            foreach ($this->custom_data[$key]['data'] as $key_option => $val_option) {
                                if ($val_option[$this->custom_data[$key]['attributes']['value']] == $content[$key]) {
                                    $val = '<a href="' . _admin_url . "/detail/" . $this->custom_data[$key]['attributes']['secondary_table'] . '/rec:' . $val_option[$this->custom_data[$key]['attributes']['value']] . '">' . $val_option[$this->custom_data[$key]['attributes']['seconday_field']] . '</a>';
                                }
                            }
                        }

                        if ($key == "Status" && $val == "1") {
                            $val = '<span style="cursor:pointer" record_id="' . $id . '" id="publish_' . $id . '" action="publish" class="label label-success publish" data-toggle="tooltip" data-placement="top" title="" data-original-title="Make Inactive">Active</span>';
                        } else if ($key == "Status" && $val == "0") {
                            $val = '<span style="cursor:pointer" record_id="' . $id . '" id="unpublish_' . $id . '" action="unpublish" class="label label-danger unpublish" data-toggle="tooltip" data-placement="top" title="" data-original-title="Make Active">Inactive</span>';
                        }

                        if ($key == "status" && $val == "1") {
                            $val = '<span style="cursor:pointer" record_id="' . $id . '" id="publish_' . $id . '" action="publish" class="label label-success publish" data-toggle="tooltip" data-placement="top" title="" data-original-title="Make Inactive">Active</span>';
                        } else if ($key == "status" && $val == "0") {
                            $val = '<span style="cursor:pointer" record_id="' . $id . '" id="unpublish_' . $id . '" action="unpublish" class="label label-danger unpublish" data-toggle="tooltip" data-placement="top" title="" data-original-title="Make Active">Inactive</span>';
                        } else if ($key == "featured" && $val == "1") {
                            $val = '<span style="cursor:pointer" record_id="' . $id . '" id="featured_' . $id . '" action="featured" class="label label-success featured" data-toggle="tooltip" data-placement="top" title="" data-original-title="Make UnFeatured">Featured</span>';
                        } else if ($key == "featured" && $val == "0") {
                            $val = '<span style="cursor:pointer" record_id="' . $id . '" id="unfeatured_' . $id . '" action="unfeatured" class="label label-danger unfeatured" data-toggle="tooltip" data-placement="top" title="" data-original-title="Make Featured">Unfeatured</span>';
                        } else if ($key == "Popular" && $val == "1") {
                            $val = '<span style="cursor:pointer" record_id="' . $id . '" id="featured_' . $id . '" action="featured" class="label label-success featured" data-toggle="tooltip" data-placement="top" title="" data-original-title="Make UnFeatured">Active</span>';
                        } else if ($key == "Popular" && $val == "0") {
                            $val = '<span style="cursor:pointer" record_id="' . $id . '" id="unfeatured_' . $id . '" action="unfeatured" class="label label-danger unfeatured" data-toggle="tooltip" data-placement="top" title="" data-original-title="Make Featured">Inactive</span>';
                        } else if ($key == "Poem_of_Day" && $val == "1") {
                            $val = '<span style="cursor:pointer" record_id="' . $id . '" id="featured_' . $id . '" action="featured" class="label label-success featured" data-toggle="tooltip" data-placement="top" title="" data-original-title="Make UnFeatured">Active</span>';
                        } else if ($key == "Poem_of_Day" && $val == "0") {
                            $val = '<span style="cursor:pointer" record_id="' . $id . '" id="unfeatured_' . $id . '" action="unfeatured" class="label label-danger unfeatured" data-toggle="tooltip" data-placement="top" title="" data-original-title="Make Featured">Inactive</span>';
                        }
                        ?>
                        <td><?php echo $val; ?></td>
                    <?php } ?>
                        <?php if ($this->vars[2] == "ad_zones") { ?>
                        <td width="200"><textarea type="text" rows="1" cols="30">&lt;?php echo showad(<?php echo $id; ?>,$this->ads);?&gt; </textarea></td>
        <?php } ?>

                    <?php if ($this->vars[2] == "submission") { ?>

                        <td>
                            <button name="user_submit_poem" value="1" class="btn btn-primary approve_poem" record_id="<?php echo $id; ?>">
                                <i class="icon icon-check"> Approve</i></button>
                        </td>

                <?php } ?> 
                    <td width="175"><div class="btn-group btn-group-sm"> <a href="<?php echo _admin_url; ?>/edit/<?php echo $this->vars[2]; ?>/rec:<?php echo $id; ?>" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Record"><i class="icon-edit"></i></a> <a href="<?php echo _admin_url; ?>/detail/<?php echo $this->vars[2]; ?>/rec:<?php echo $id; ?>" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="" data-original-title="Record Details"><i class="icon-list-alt"></i></a> 
                            <a href="javascript:void(0);" class="btn btn-success deletebtn" record_id="<?php echo $id; ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Record"><i class="icon-remove"></i></a> </div></td>
                    </tr>
    <?php } ?>
                </tbody>
            </table>

    <?php if ($this->total_pages > 1) { ?>
                <div id="pagination_top"></div>
            <?php } ?>      <div class="clearfix"></div>

        <?php } ?>
    </div>




</div>


<script>
    $(document).ready(function() {

        /*Pagination Coding Starts*/
        var options = {
            currentPage: <?php echo $this->currentpage; ?>,
            totalPages: <?php echo $this->total_pages; ?>,
            numberOfPages: 8,
            alignment: "right",
            pageUrl: function(type, page, current) {
                return "<?php echo _admin_url; ?>/table/<?php echo $this->vars[2]; ?>/p:" + page;
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
        /*Pagination Coding Ends*/

        /* Select Which page to go*/
        $('.show-per-page').change(function() {
            var noofitems = $(this).val();

            document.location.href = '<?php echo _admin_url; ?>/table/<?php echo $this->vars[2]; ?>/p:1/perpage:' + noofitems;

        });

        $('.sortbyASC').live('click', function() {
            var fieldname = $(this).attr("fieldname");
            var method = $(this).attr("method");
            document.location.href = '<?php echo _admin_url; ?>/table/<?php echo $this->vars[2]; ?>/p:1/perpage:<?php echo $this->perpage; ?>/sortby:' + fieldname + ':' + method;
        });

        $('.sortbyDESC').live('click', function() {
            var fieldname = $(this).attr("fieldname");
            var method = $(this).attr("method");
            document.location.href = '<?php echo _admin_url; ?>/table/<?php echo $this->vars[2]; ?>/p:1/perpage:<?php echo $this->perpage; ?>/sortby:' + fieldname + ':' + method;
        });

        /* Check All*/

        var array = [];

        $('.checkall').live('click', function() {
            $('#myTable input[type="checkbox"]').trigger('click');
            $(this).addClass("removeCheckall");
            $(this).removeClass("checkall");
            console.log(array);

        });

        $('.removeCheckall').live('click', function() {

            $('#myTable input[type="checkbox"]').trigger('click');
            array = [];
            $(this).addClass("checkall");
            $(this).removeClass("removeCheckall");
            console.log(array);
        });

        $('#myTable input[type="checkbox"]').click(function() {
            var value = $(this).attr("id");
            $(this).attr("checked", this.checked);
            array.push(value);
        });



        //deleteselectedrecords
        $("#deleteselectedrecords").live('click', function() {
            console.log(array);
            var blkstr = [];

            $.each(array, function(key, val) {
                var str = val;
                blkstr.push(str);
            });

            var record_ids = blkstr.join(",");
            var table_name = "<?php echo $this->vars[2] ?>";
            $(".contentloader").show();
            var alertconfirm = confirm("Are you sure you want to delete this record?");
            if (alertconfirm) {
                $.post('<?php echo _admin_url; ?>/common/actions', {method: "deletearecord", table: table_name, records: record_ids}, function(data) {
                    if (data == 1) {
                        location.reload();
                    } else {
                        alert("Record was not deleted. Please check again!");
                        $(".contentloader").hide();
                    }
                });
            }
            else {
                $(".contentloader").hide();
                return false;
            }
        });





        //Delete Button


        $(".deletebtn").live('click', function() {
            var record_ids = $(this).attr('record_id');
            var table_name = "<?php echo $this->vars[2] ?>";
            $(".contentloader").show();
            var alertconfirm = confirm("Are you sure you want to delete this record?");
            if (alertconfirm) {
                $.post('<?php echo _admin_url; ?>/common/actions', {method: "deletearecord", table: table_name, records: record_ids}, function(data) {
                    if (data == 1) {
                        //alert("Record was succesfully deleted!");
                        $("#myTable #row_" + record_ids + " td").css("background-color", "#f2dede");
                        $("#myTable #row_" + record_ids + " td").css("border", "1px solid #eed3d7");
                        $("#myTable #row_" + record_ids).fadeOut(900);
                        $(".contentloader").hide();
                        //location.reload();
                    } else {
                        alert("Record was not deleted. Please check again!");
                        $(".contentloader").hide();
                    }
                });
            }
            else {
                $(".contentloader").hide();
                return false;
            }
        });

        //Publish Record
        $('.publish').live('click', function() {
            var table_name = "<?php echo $this->vars[2] ?>";
            var record_ids = $(this).attr('record_id');

            $.post('<?php echo _admin_url; ?>/common/actions', {method: "unpublish", table: table_name, records: record_ids}, function(data) {

                $('#publish_' + record_ids).removeClass('label-success');
                $('#publish_' + record_ids).addClass('label-danger');
                $('#publish_' + record_ids).addClass('unpublish');
                $('#publish_' + record_ids).text('Inactive');
                $('#publish_' + record_ids).attr('id', 'unpublish_' + record_ids);
                $('#publish_' + record_ids).removeClass('publish');

            });
        });

        //Unpublish Record
        $('.unpublish').live('click', function() {
            var table_name = "<?php echo $this->vars[2] ?>";
            var record_ids = $(this).attr('record_id');

            $.post('<?php echo _admin_url; ?>/common/actions', {method: "publish", table: table_name, records: record_ids}, function(data) {

                $('#unpublish_' + record_ids).removeClass('label-danger');
                $('#unpublish_' + record_ids).addClass('label-success');
                $('#unpublish_' + record_ids).addClass('publish');
                $('#unpublish_' + record_ids).text('Active');
                $('#unpublish_' + record_ids).attr('id', 'publish_' + record_ids);
                $('#unpublish_' + record_ids).removeClass('unpublish');


            });
        });


        //Publish Records
        //publishrecords
        //unpublishrecords

        //Publish Record
        $('#publishrecords').live('click', function() {

            console.log(array);
            var blkstr = [];

            $.each(array, function(key, val) {
                var str = val;
                blkstr.push(str);
            });


            var table_name = "<?php echo $this->vars[2] ?>";
            var record_ids = blkstr.join(",");

            $.post('<?php echo _admin_url; ?>/common/actions', {method: "publish", table: table_name, records: record_ids}, function(data) {
                location.reload();
            });
        });

        //Unpublish Record
        $('#unpublishrecords').live('click', function() {

            console.log(array);
            var blkstr = [];

            $.each(array, function(key, val) {
                var str = val;
                blkstr.push(str);
            });

            var table_name = "<?php echo $this->vars[2] ?>";
            var record_ids = blkstr.join(",");

            $.post('<?php echo _admin_url; ?>/common/actions', {method: "unpublish", table: table_name, records: record_ids}, function(data) {
                location.reload();
            });
        });





        //Delete All Records

        $(".deleteallrecords").click(function() {
            $(".contentloader").show();
            var table_name = "<?php echo $this->vars[2] ?>";

            var alertconfirm = confirm("Caution! This will delete all records from Database and this action is irrevocable. Are you sure you want to play with this Action?");

            if (alertconfirm) {

                $.post('<?php echo _admin_url; ?>/common/actions', {method: "deleteallrecords", table: table_name}, function(data) {
                    //$('.result').html(data);
                    if (data == 1) {
                        alert("Data was succesfully deleted!");
                        $(".contentloader").hide();
                        location.reload();
                    } else {
                        alert("Data was not deleted. Please check again!");
                        $(".contentloader").hide();
                    }
                });

            }
            else {
                $(".contentloader").hide();
                return false;
            }
        });

        
        // Approve Records
        $(".approvesubmissions").click(function() {
            $(".contentloader").show();


            var blkstr = [];

            $.each(array, function(key, val) {
                var str = val;
                blkstr.push(str);
            });



            var table_name = "<?php echo $this->vars[2] ?>";
            var record_ids = blkstr.join(",");


            var alertconfirm = confirm("Are you sure you want to approve these items?");

            if (alertconfirm) {

                $.post('<?php echo _admin_url; ?>/common/actions', {method: "approve", table: table_name, records: record_ids}, function(data) {


                    //console.log(data);


                    if (data == 1) {



                        alert("Records were succesfully Approved!");
                        $(".contentloader").hide();
                        location.reload();
                    } else {
                        alert("Records were not Approved. Please check again!");
                        $(".contentloader").hide();
                    }




                });

            }
            else {
                $(".contentloader").hide();
                return false;
            }
        });


        // Approve Records
        $(".approve_poem").click(function() {
            var table_name = "<?php echo $this->vars[2] ?>";
            var record_id = $(this).attr('record_id');
            var alertconfirm = confirm("Are you sure you want to approve these items?");

            $.post('<?php echo _admin_url; ?>/common/actions', {method: "approve", table: table_name, records: record_id}, function(data) {
                //console.log(data);
                if (data == 1) {
                    alert("Records were succesfully Approved!");
                    location.reload();
                }
            });
        });

    });
</script> 
<?php echo $this->render("themes/adminarea/html/elements/footer.php") ?> 
