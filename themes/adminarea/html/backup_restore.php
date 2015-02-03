<?php echo $this->render("themes/adminarea/html/elements/header.php")?>
<script>
$(function(){
	
	$(document).ajaxStart(function() {
		$('div#ajax-loader').show();
	}).ajaxStop(function() {
		$('div#ajax-loader').hide();
	});;
	
	$('button#btn_backup').on('click',function(){
		$('button').prop("disabled",true);
		$('div#alert_success').hide().find('span').hide();
		$('div#alert_danger').hide().find('span').hide();
		$('div#div_restoration_points').hide();
		$.post('<?php echo _admin_url?>/ajax',{action:'make_backup'},function(data){
			$('button').prop("disabled",false);
			if(data == '1'){
				//show success
				$('div#alert_success').show().find('span#backup_success').show();
				$('div#alert_success').delay(3000).fadeOut(300);
				get_restore_dates();
			}else{
				//show error
				$('div#alert_danger').show().find('span#backup_danger').show();
				$('div#alert_danger').delay(3000).fadeOut(300);
			}
		});
	});

	function get_restore_dates(){
		$('div#div_restore_dates').html('<center><font size="+2">Please Wait&nbsp;</font><img src="<?php echo main_url;?>/themes/adminarea/images/ajax-loader.gif" /></center>');
		$.post('<?php echo _admin_url?>/ajax',{action:'get_restore_dates'},function(data){
			$('div#div_restore_dates').html(data);
			$('a#view_restore_points').on('click',function(){
				$('tbody#tbody_restore_pts').find('tr').removeClass("active");
				$(this).parent().parent().addClass('active');
				var got_date = $(this).find('input').val();
				$('div#div_restoration_points').show(300).find('span#got_restore_date').text(got_date);
				get_restore_points(got_date);
			});
			$('button#del_backup_date').click(function(){
				$('button').prop("disabled",true);
				var del_path = $(this).prev().val();
				var confir = confirm("Are you sure, You want to delete all backups of this date???\n\n It cannot be reverted back..!!");
				if(confir){
					$('div#div_restoration_points').hide(300);
					$.post('<?php echo _admin_url?>/ajax',{action:'del_restore_point',del_path:del_path},function(data){
						$('button').prop("disabled",false);
						get_restore_dates();
					});
				}else{
					$('button').prop('disabled',false);
				}
			});
		});
	}

	function get_restore_points(got_date){
		$('div#div_restore_pts').html('<center><font size="+2">Please Wait&nbsp;</font><img src="<?php echo main_url;?>/themes/adminarea/images/ajax-loader.gif" /></center>');
		$.post('<?php echo _admin_url?>/ajax',{action:'get_restore_points',got_date:got_date},function(data){
			$('div#div_restore_pts').html(data);
			$('button#btn_restore').on('click',function(){
				var res_path = $(this).prev().val();
				$('div#alert_success').hide().find('span').hide();
				$('div#alert_danger').hide().find('span').hide();
				$('button').prop("disabled",true);
				console.log(res_path);
				$.post('<?php echo _admin_url?>/ajax',{action:'restore_db',res_path:res_path},function(data){
					$('button').prop("disabled",false);
					if(data == '1'){
						//show success
						$('div#alert_success').show().find('span#restore_success').show();
						$('div#alert_success').delay(3000).fadeOut(300);
					}else{
						//show error
						$('div#alert_danger').show().find('span#restore_danger').show();
						$('div#alert_danger').delay(3000).fadeOut(300);
					}
				});
			});
			$('button#del_restore_point').click(function(){
				$('button').prop("disabled",true);
				var del_path = $(this).prev().prev().val();
				var got_date = $(this).next().val();
				var confir = confirm("Are you sure, You want to delete this backup???\n\n It cannot be reverted back..!!");
				if(confir){
					$.post('<?php echo _admin_url?>/ajax',{action:'del_restore_point',del_path:del_path},function(data){
						$('button').prop("disabled",false);
						get_restore_points(got_date);
					});
				}else{
					$('button').prop('disabled',false);
				}
			});
		});
	}
	get_restore_dates();
});
</script>
<div id="ajax-loader" style="position:absolute;top:0px;right:16px;padding:7px;padding-right:10px;width:auto;background-color:#f5f5f5" hidden>Please Wait&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="<?php echo main_url;?>/themes/adminarea/images/ajax-loader.gif" /></div>
<span class="pull-right" style="margin-right:10px" title="Create Database Backup"><button class="btn btn-success btn-lg" id="btn_backup">Backup Now!!</button></span>
<h1>Backup &amp; Restore Page</h1>
<hr />
<div class="alert alert-success" id="alert_success" hidden>
<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
<strong>Success !!</strong>
<span id="backup_success" hidden>&nbsp;Backup Taken Successfully...</span>
<span id="restore_success" hidden>&nbsp;Restoration Complete...</span>
</div>
<div class="alert alert-danger" id="alert_danger" hidden>
<a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
<strong>Error !!</strong>
<span id="backup_danger" hidden>&nbsp;Backup Not Successfully...</span>
<span id="restore_danger" hidden>&nbsp;Restoration Failed...</span>
</div>

<div class="row">
  <div class="col-lg-6">
    <div class="panel panel-primary">
	  <div class="panel-heading">
		<h3 class="panel-title"><font size="+1">Current Restoration Dates</font></h3>
	  </div>
	  <div class="panel-body" id="div_restore_dates">
	  </div>
	</div>
  </div>
  <div class="col-lg-6" id="div_restoration_points" hidden>
    <div class="panel panel-primary">
	  <div class="panel-heading">
		<h3 class="panel-title"><font size="+1">Restoration Points for <span id="got_restore_date"></span></font></h3>
	  </div>
	  <div class="panel-body" id="div_restore_pts">
	  </div>
	</div>
  </div>
</div>
<?php echo $this->render("themes/adminarea/html/elements/footer.php")?>