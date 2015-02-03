<?php echo $this->render("themes/adminarea/html/elements/header.php")?>
<?php error_reporting(0);?>
<script>
	$(document).ready(function(){
		$(".savefields").click(function(){
		var table_name = $(this).attr("table_name");
			var items = [];
			var field_item = $("#"+table_name+" input[type=checkbox]").each(function(){
				if(this.checked){
					var it_val = $(this).val();
					items.push(it_val);
				}
				});
			console.log(table_name+" : "+items);
			
			
			$.post('<?php echo _admin_url;?>/common/manage_fields', { table_name: table_name, fields: items}, function(data) {
			  console.log(data);
			  $("#success_message .messagetext").text("Fields for ["+table_name+"] were sucessfully Saved!");
			  $("#success_message").show();
				
				setTimeout(function(){
					$('#success_message').hide(100);
					}, 3000);
			});
			
			
			
		});
		$(".saveallfields").click(function(){
				var aftertext = $(".savefields").trigger('click');
				
				$("#success_message2 .messagetext").text("All fields were sucessfully Saved!");
				$("#success_message2").show();
				
				setTimeout(function(){
					$('#success_message2').hide(300);
					},5000);
		});
	});
	</script>
<div class="row">
  <div class="col-lg-12">
	  <div class="panel">
	  <div class="panel-heading"><a href="javascript:void(0)" class="btn btn-danger pull-right saveallfields"><i class="icon-save"></i> &nbsp;Save All Fields</a>
    <h3 class="panel-title" style="font-size:21px; padding:7px;"><strong><i class="icon-edit"></i> Fields to show on Data Tables Panel</strong> </h3>
	  </div>
      
      <div class="alert alert-success" id="success_message" style="display:none">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> <span class="messagetext"></span> </div>
      <div class="alert alert-success" id="success_message2" style="display:none">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Success!</strong> <span class="messagetext"></span> </div>
      
	  <table class="table table-striped table-hover table-bordered" style="font-size:120%;">
        <tbody>
        <tr>
        	<td  style="background:#007fff; color:#ffffff;"> <strong>Table Name</strong></td>
            <td  style="background:#007fff; color:#ffffff">Fields</td>
        </tr>  
        
        <?php //pr($this->db_fields);
		
		?>
      <?php foreach($this->manage_fields as $key=>$value){
			
		 ?>
       <?php if(!in_array($key,$this->skipped_tables)){?>
         <tr class="tablefieldinfo" table_name="<?php echo $key; ?>">
        	<td width="120"><strong><?php echo $key;?> </strong></td>
            <td id="<?php echo $key; ?>" style="word-wrap: break-word">
			<a style="margin-left:30px;" href="javascript:void(0)" class="btn btn-small btn-success savefields pull-right" table_name="<?php echo $key; ?>">Save Fields</a>
			<?php foreach($value as $key1=>$value) {
				
				
				$values = unserialize($this->db_fields[$key]);
				if (in_array($value['Field'], $values[0])) {
				?>
                
                <label class="checkbox-inline" style="margin-left:0px; margin-right:20px;float:none; line-height:30px;">
              <input type="checkbox" id="inlineCheckbox1" checked="checked" field_name="<?php echo  $value['Field']; ?>" value="<?php echo  $value['Field']; ?>">
              <?php echo $value['Field'];?>
             </label>
                <?php } else {
					
					?>
                    
                    <label class="checkbox-inline" style="margin-left:0px; margin-right:20px;float:none; line-height:30px;">
              <input type="checkbox" id="inlineCheckbox1" field_name="<?php echo  $value['Field']; ?>" value="<?php echo  $value['Field']; ?>"><?php echo $value['Field'];?></label>
			<?php 
				}
			}
			?>
            </td>
        </tr>
		<?php 
	   }
	  }
	  ?>
        </tbody>
        </table>
	</div>
  </div>
</div>

<?php echo $this->render("themes/adminarea/html/elements/footer.php")?> 