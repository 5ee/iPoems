<?php echo $this->render("themes/adminarea/html/elements/header.php")?>
<script>
$(function(){
	
	function alias_cancel(){
		$('span#alias_input').hide(300);
		$('span#alias_name').show(300);
	}
	
	$('span#alias_name').click(function(){
		alias_cancel();
		$(this).hide(300).next().show(300);
	});

	$('button#cancel_update_alias').click(function(){
		alias_cancel();
	});
	
	$('button#done_update_alias').click(function(){
		$('button').prop('disabled',true);
		var db_id = $(this).next().next().val();
		var alias_val = $(this).prev().val();
		$.post('<?php echo _admin_url?>/ajax',{action:'update_alias',db_id:db_id,alias_val:alias_val},function(data){
			$('button').prop('disabled',false);
			$('tr#'+db_id).find('span#alias_name').html(data);
			alias_cancel();
		});
	});
});


</script>
<h1><strong>Alias Management</strong></h1>
<hr />
<?php 
if($this->aliases){?>
	<table class="table table-bordered table-hover">
	<thead>
	<tr class="active">
	<th width="10%">S.No</th>
	<th width="20%">Module</th>
	<th>Alias</th>
	</tr>
	</thead>
	<tbody>
	<?php $i=1;foreach($this->aliases as $alias){?>
		<tr id="<?php echo $alias['id']?>">
		<th><?php echo $i?></th>
		<th><?php echo $alias['module_name']?></th>
		<th>
			<span id="alias_name"><?php echo $alias['alias_name']?></span>
			<span id="alias_input" hidden>
				<input type="text" style="padding-left:7px" value="<?php echo $alias['alias_name']?>" placeholder="Enter Alias Name">
				<button class="btn btn-success btn-xs" id='done_update_alias'><i class="icon-check"></i> Update</button>&nbsp;
				<button class='btn btn-primary btn-xs' id="cancel_update_alias"><i class="icon-exclamation"></i> Cancel</button>
				<input type='hidden' value='<?php echo $alias['id']?>' id='alias_db_id' />
			</span>
		</th>
		</tr>
	<?php $i++;}?>
	</tbody>
	</table>
<?php }?>







<?php echo $this->render("themes/adminarea/html/elements/footer.php")?>
