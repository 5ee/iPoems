<?php echo $this->render("themes/adminarea/html/elements/header.php")?>
<?php $now = new DateTime(); ?>
    <link type="text/css" rel="stylesheet" href="<?php echo main_url ?>/libs/jquery-ui/jquery-ui.css">
	<script type="text/javascript" src="<?php echo main_url ?>/libs/chosen-jquery/chosen.jquery.min.js"></script>
    <link type="text/css" rel="stylesheet" href="<?php echo main_url ?>/libs/chosen-jquery/chosen.css">
    <script type="text/javascript" src="<?php echo main_url ?>/libs/jquery-ui/jquery-ui.js"></script>

<?php
if($this->table =="settings"){
?>
<h1><strong>Website</strong> <i><?php echo format_names($this->table);?></i></h1>

<?php } else {?>
<h1><strong>Edit a Record:</strong> <i><?php echo format_names($this->table);?> [<?php echo $this->record_id;?>]</i></h1>

<?php }?>
<?php if(is_array($this->error_message)){?>
<div class="panel panel-danger">
  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
  <div class="panel-heading"><strong>Warning!</strong></div>
  <div class="panel-body">
	  <ul class="" type="circle">
  <?php foreach($this->error_message as $k=>$err){?>
	  <li><?=$err?></li>
	  <?php }?>
	  </ul>
  </div>
</div>
<?php }?>
<hr />
<script>
$(document).ready(function() {
	var slug = function(str) {
	  str = str.replace(/^\s+|\s+$/g, ''); // trim
	  str = str.toLowerCase();
	
	  // remove accents, swap ñ for n, etc
	  var from = 'ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;';
	  var to   = 'aaaaaeeeeeiiiiooooouuuunc------';
	  for (var i=0, l=from.length ; i<l ; i++) {
		str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	  }
	
	  str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
		.replace(/\s+/g, '-') // collapse whitespace and replace by -
		.replace(/-+/g, '-'); // collapse dashes
	
	  return str;
	};

	<?php 
	$fields = array();
	foreach($this->columns as $key=>$value){
		$field = $value['Field'];
		$fields[] = $field;
	}


// Check if Table Exists in Required Fields Array
	if (array_key_exists($this->table, $this->required_fields)) {
		$required_fields = $this->required_fields[$this->table];
	}else{
		$required_fields = $this->required_fields;
	}

	// Check if Table Exists in File Fields Array
	$file_fields_names=array();
	if (array_key_exists($this->table, $this->file_fields)) {
		$file_fields = $this->file_fields[$this->table];
		foreach($file_fields as $db_key => $field_info){
			$file_fields_names[$db_key]=$field_info['field'];
		}
	}else{
		$file_fields = $this->file_fields;
	}

	// Validation of Reqired Fields Array
	foreach($required_fields as $required){
		
		if (in_array($required, $fields)) {
		echo "
		$('#".$required."').attr('data-trigger','change');
		$('#".$required."').attr('data-required','true');
		$('#".$required."').addClass('parsley-validated');
			";
		}
	}


	// Check if Table Exists in Slug Fields
	if (array_key_exists($this->table, $this->slug_fields)) {
		$slug_fields = $this->slug_fields[$this->table];
	}else{
		$slug_fields  = "";
	}	

	if (array_key_exists($this->table, $this->date_fields)) {
		$date_fields = $this->date_fields[$this->table];
	}else{
		$date_fields  = array();
	}	
	
	
	foreach($slug_fields as $key=>$value){
	//pr($slug_fields);
	
	if (array_key_exists('main', $value)) {
	echo "
		$('#".$value['secondary']."').attr('readonly','readonly');
		$('#".$value['main']."').live('keyup',function(){
			var slugval = slug($('#".$value['main']."').attr('value'));
			$('#".$value['secondary']."').attr('value',slugval);
		});";
	}
	};
	
	//relationship fields
	$rel_main_fields_array=array();
	foreach($this->get_another_data as $db_id=>$rel_info)
	{
		if($rel_info['is_multiple']==1)
		$rel_main_fields_array[]=$rel_info['main_field'];
	}



	?> 
});	 	
</script>

<script>

  $(document).ready(function() {
$( "#release_date" ).datepicker();

	$(".chosen-select").chosen();
	

  });


</script>
  	<?php //echo $this->result;?>


<?php 
  if(isset($this->vars[4]) && $this->vars[4] =="saved") {
  ?>
<div class="alert alert-success saved">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Well done!</strong> Record: <?php echo $this->record_id;?> was succesfully saved to database! </div>
<?php } else if(isset($this->vars[4]) && $this->vars[4] =="updated"){?>
<div class="alert alert-success updated">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Well done!</strong> Record: <?php echo $this->record_id;?> was succesfully updated! </div>
<?php }else if(isset($this->vars[4]) && $this->vars[4] =="error"){?>
<div class="alert alert-danger error">
  <button type="button" class="close" data-dismiss="alert">×</button>
  <strong>Error!</strong> Record: <?php echo $this->record_id;?> was not  updated!. <strong>Reason</strong>: <?php echo $this->vars[5];?></div>
<?php }?>




<div class="row">
<div class="col-lg-10">
  <form class="bs-example form-horizontal" name="csrf_form" data-validate="parsley" action="" method="post"  enctype="multipart/form-data">
    <fieldset>
            <input type="hidden" name="csrf_token" value="<?php echo $this->formtoken; ?>">

      <?php //echo pr($this->content); 
	  $keys = array_keys($this->custom_data);
	  $content = $this->content;
	  ?>
      <?php foreach($this->columns as $key=>$value){
				   $default_field_type = $value['Type'];
				   $field = $value['Field'];
				if(strstr($value['Type'], '(')){
						$field_type = strstr($value['Type'], '(', true);
						}
					else{
							$field_type = $value['Type'];
					}
					
				
				// Check if Table Exists in Hidden Fields Array
					if (array_key_exists($this->table, $this->hidden_fields)) {
						$hidden_fields = $this->hidden_fields[$this->table];
					}else{
						$hidden_fields = $this->hidden_fields;
					}
					
					
					if($field == $this->tb_primaryid)
					{
					}
					//hide from here
					elseif (in_array($field, $hidden_fields)) {
						
					}
					else {
		 ?>
      <div class="form-group" id="group_<?php echo $value['Field'];?>">
        <label for="input_<?php echo $value['Field'];?>" class="col-lg-2 control-label"><?php echo format_names($value['Field']);?></label>
        <div class="col-lg-10">
          <?php if($field_type == 'int' || $field_type == "varchar" || $field_type == "bigint") {?>
            <?php 
			//pr($this->get_another_data);
				if(in_array($value['Field'], $keys)){
					$multiple_true = "";
					$array_true = "";
					if(in_array($value['Field'],$rel_main_fields_array)){
					$multiple_true = "multiple";	
					$array_true = "[]";
				}
			?>
                    
        <select data-placeholder="Choose an option..." <?php echo $multiple_true;?> class="form-control chosen-select" style="width:400px;" name="data[<?php echo $value['Field'];?>]<?php echo $array_true;?>" id="<?php echo $value['Field'];?>">  
            
			<?php 
			if(in_array($value['Field'],$rel_main_fields_array)){
			$got_db_result=unserialize($content[$value['Field']]);
			foreach($this->custom_data[$value['Field']]['data'] as $key_option=>$val_option)  {
				if(in_array($val_option[$this->custom_data[$value['Field']]['attributes']['value']],$got_db_result)){?>
     		 <option selected value="<?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['value']];?>"><?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['seconday_field']];?></option>
            <?php }else
			{?>
     		 <option value="<?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['value']];?>"><?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['seconday_field']];?></option>
			<?php }}}else
			{
				foreach($this->custom_data[$value['Field']]['data'] as $key_option=>$val_option)  {
					if($val_option[$this->custom_data[$value['Field']]['attributes']['value']] == $content[$value['Field']]){?>
			
     		 <option selected value="<?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['value']];?>"><?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['seconday_field']];?></option>
			<?php }else
			{?> 
     		 <option value="<?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['value']];?>"><?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['seconday_field']];?></option>
			<?php }}}?>
        </select>
          <?php }else if($field == "password") {?>
          <input type="password" name="data[<?php echo $value['Field'];?>]" class="form-control" id="<?php echo $value['Field'];?>" placeholder="" value="<?php echo  $content[$value['Field']];?>" autocomplete="off">
          
          <?php }else if(in_array($field,$date_fields)) {
				?>
          <input type="text" name="data[<?php echo $value['Field'];?>]" class="form-control" id="<?php echo $value['Field'];?>" placeholder=""  value="<?php echo  $content[$value['Field']];?>">
		  <script>
		  $(function(){
			$( "#<?php echo $value['Field'];?>" ).datepicker({
				dateFormat:"yy-mm-dd"
				});
		  });
		  </script>
		  
		  
            <?php }elseif(in_array($field,$file_fields_names)) {
				$db_key='';
				foreach($file_fields_names as $db => $file_field_name){
					if($field == $file_field_name){$db_key=$db;}
				}
				$file_field_info=$file_fields[$db_key];
				if($file_field_info['type']=="image")
				{
					
					if($content[$value['Field']] != ""){
							$img_src = main_url.$content[$value['Field']];	 
						}else{
							$img_src = "http://placehold.it/270x200&text=No Image";	
						}
					
					
				?>
<div class="fileinput fileinput-new" data-provides="fileinput">
  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
	<img id="<?php echo $value['Field'];?>" src="<?php echo $img_src; ?>" alt="...">
  </div>
  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
  <div>
    <span class="btn-file"><span class="fileinput-new btn btn-success"><i class="icon-refresh"></i> Change</span><span class="fileinput-exists  btn btn-success"><i class="icon-refresh"></i> Change</span><input type="file" name="data[<?php echo $value['Field'];?>]"></span>
    <a href="#" style="margin-top:5px;" class="btn btn-danger fileinput-exists" data-dismiss="fileinput"><i class="icon-remove"></i> Remove</a>
  </div>
</div>
  		<?php }elseif($file_field_info['type']=="file"){?>
<?php 
$f_name=explode('/',$content[$value['Field']]);
$f_name=end($f_name);
?>

<div class="fileinput fileinput-new" data-provides="fileinput">
  <span class="btn-file"><span class="fileinput-new btn btn-danger">Change</span><span class="fileinput-exists btn btn-danger">Change</span><input type="file" name="data[<?php echo $value['Field'];?>]" value=""></span>
  <span class="fileinput-filename"><?php echo  $f_name;?></span>
  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
</div>
            <?php }}else {?>
          
          
          <input type="text" name="data[<?php echo $value['Field'];?>]" class="form-control" id="<?php echo $value['Field'];?>" placeholder="" value="<?php echo  $content[$value['Field']];?>" autocomplete="off">
          <?php }?>
           <?php }else if($field_type == 'text'){
			
				// Check if Table Exists in Editor Fields
				if (array_key_exists($this->table, $this->ckeditor_fields)) {
					$ckeditor_fields = $this->ckeditor_fields[$this->table];
				}else{
					$ckeditor_fields = $this->ckeditor_fields;
				}		
				//Put the fields												
				if (in_array($field, $ckeditor_fields)) {
			?>
		<textarea class='ckeditor span6' id='<?php echo $value['Field'];?>' cols='80'  rows='7'  name='data[<?php echo $value['Field'];?>]' type='text' value=''><?php echo $content[$value['Field']];?></textarea>    
        
        
                
            <?php }elseif(in_array($value['Field'], $keys)){
					$multiple_true = "";
					$array_true = "";
					if(in_array($value['Field'],$rel_main_fields_array)){
					$multiple_true = "multiple";	
					$array_true = "[]";
				}
			?>
                    
        <select data-placeholder="Choose an option..." <?php echo $multiple_true;?> class="form-control chosen-select" style="width:400px;" name="data[<?php echo $value['Field'];?>]<?php echo $array_true;?>" id="<?php echo $value['Field'];?>">  
            
			<?php 
			if(in_array($value['Field'],$rel_main_fields_array)){
			$got_db_result=unserialize($content[$value['Field']]);
			foreach($this->custom_data[$value['Field']]['data'] as $key_option=>$val_option)  {
				if(in_array($val_option[$this->custom_data[$value['Field']]['attributes']['value']],$got_db_result)){?>
     		 <option selected value="<?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['value']];?>"><?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['seconday_field']];?></option>
            <?php }else
			{?>
     		 <option value="<?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['value']];?>"><?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['seconday_field']];?></option>
			<?php }}}else
			{
				foreach($this->custom_data[$value['Field']]['data'] as $key_option=>$val_option)  {
					if($val_option[$this->custom_data[$value['Field']]['attributes']['value']] == $content[$value['Field']]){?>
			
     		 <option selected value="<?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['value']];?>"><?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['seconday_field']];?></option>
			<?php }else
			{?> 
     		 <option value="<?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['value']];?>"><?php echo $val_option[$this->custom_data[$value['Field']]['attributes']['seconday_field']];?></option>
			<?php }}}?>
        </select>
          <?php }elseif(in_array($field,$file_fields_names)) {
				$db_key='';
				foreach($file_fields_names as $db => $file_field_name){
					if($field == $file_field_name){$db_key=$db;}
				}
				$file_field_info=$file_fields[$db_key];
				if($file_field_info['type']=="image")
				{
				?>
<div class="fileinput fileinput-new" data-provides="fileinput">
  <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
	<img id="<?php echo $value['Field'];?>" src="<?php echo  main_url.$content[$value['Field']];?>" alt="...">
  </div>
  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
  <div>
    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="data[<?php echo $value['Field'];?>]"></span>
    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
  </div>
</div>
  		<?php }elseif($file_field_info['type']=="file"){?>
<?php 
$f_name=explode('/',$content[$value['Field']]);
$f_name=end($f_name);
?>

<div class="fileinput fileinput-new" data-provides="fileinput">
  <span class="btn-file"><span class="fileinput-new btn btn-danger">Change</span><span class="fileinput-exists btn btn-danger">Change</span><input type="file" name="data[<?php echo $value['Field'];?>]" value=""></span>
  <span class="fileinput-filename"><?php echo  $f_name;?></span>
  <a href="#" class="close fileinput-exists" data-dismiss="fileinput" style="float: none">&times;</a>
</div>
            <?php }}else {?>
                        <textarea class="form-control" rows="3" name="data[<?php echo $value['Field'];?>]" id="<?php echo $value['Field'];?>"><?php echo  $content[$value['Field']];?></textarea>

            
            <?php }?>
        
        
        
          <?php }else if($field_type == 'enum'){
				 
				$val = str_replace("enum(","",$default_field_type);
				$val = str_replace(")","",$val);
				$val = str_replace("'","",$val);
				$values = explode(",", $val);
				?>
          <?php foreach($values as $key=>$val1){ 
					if($val1 == "1"){
				?>
          <div class="radio">
            <label class="radio">
              <input type="radio"  <?php if($content[$value['Field']] == 1) {echo "checked";}  ?>   name="data[<?php echo $value['Field'] ?>]" id="opt_<?php echo $value['Field']?>" value="<?php echo $val1; ?>">
              Active</label>
          </div>
          <?php }else {?>
          <div class="radio">
            <label class="radio">
              <input type="radio" <?php if($content[$value['Field']] == 0) {echo "checked";}  ?> name="data[<?php echo $value['Field'] ?>]" id="opt_<?php echo $value['Field']?>" value="<?php echo $val1; ?>">
              Inactive</label>
          </div>
          <?php   } ?>
          <?php }?>
          <?php }else if($field_type == 'timestamp' || $field_type == 'datetime' || $field_type == 'date'){?>
          <input readonly="readonly" type="text" name="data[<?php echo $value['Field'];?>]" class="form-control" id="<?php echo $value['Field'];?>" placeholder=""  value="<?php echo  $content[$value['Field']];?>">
          
          
          <?php }else {?>
          Need to Add Widget (<?php echo $field_type;?>)
          <?php }?>
        </div>
      </div>
      <?php } }?>
      <div class="form-group" style="background:#eeeeee; margin-left:5px; padding:15px;">
        <div class="col-lg-12" style="text-align:left">
            <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Save</button>
           <?php if($this->vars[2]!="comments" && $this->vars[2]!="ratings" && $this->vars[2]!="saves") {?>
          <a href="<?php echo main_url;?>/adminarea/add/<?php echo $this->table;?>" class="btn btn-success pull-right"><i class="icon-plus"></i> Add a new Record</a>
          <?php }?>
        </div>
      </div>
    </fieldset>
  </form>
</div>
<script type="text/javascript">
$(document).ready(function() {
    setTimeout(function(){
		$(".saved, .updated, .error").fadeOut();
	},3000);
});
</script> 
<?php echo $this->render("themes/adminarea/html/elements/footer.php")?> 
