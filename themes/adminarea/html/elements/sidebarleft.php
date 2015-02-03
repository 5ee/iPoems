<div class="panel-group" id="accordion">
        
        <div class="panel panel-primary" style="margin-bottom:5px;">
          <div class="panel-heading">
            <h4 class="panel-title"> <a href="<?php echo _admin_url;?>/index"> <i class="icon-home"></i> &nbsp;Dashboard </a> </h4>
          </div>
          
        </div>
        
        <script>
		$(document).ready(function() {
            $(".panel-title a").click(function(){
				var tab = $(this).attr("table");	
				$( ".sidebartables" ).each(function() {
				 	$(".panel-collapse").addClass("collapse");
					$(".panel-collapse").removeClass("collapsed");
				 	$(".panel-collapse").removeClass("in");
				});
				$("#collap_"+tab).addClass("collapsed");
				$("#collap_"+tab).removeClass("collapse");
			});	
        });
		</script>
        
        <?php 
		if(is_array($this->table_icons))
		{
			$table_icons=$this->table_icons;
			foreach($this->tables as $table){
				if(!in_array($table,$this->skipped_tables))
				{
					$iconclass=$table_icons[$table];
				?>
        <div class="panel panel-default sidebartables">
          <div class="panel-heading">
            <h4 class="panel-title"> <a class="accordion-toggle" table="<?php echo $table;?>" data-toggle="collapse" data-parent="#accordion" href="#collap_<?php echo $table;?>"><i class="<?php echo $iconclass;?>"></i> &nbsp;<?php echo format_names($table);?> </a> </h4>
          </div>
          <div id="collap_<?php echo $table;?>" class="panel-collapse collapse <?php if(isset($this->vars[2]) && $this->vars[2]== $table){echo "in";}?>">
            <div class="panel-body" style="padding:0px;">
              <ul class="nav nav-pills nav-stacked">
                <li class="<?php if(isset($this->vars[2]) && $this->vars[1] == "table" && $this->vars[2]== $table){echo "active";}?>"><a href="<?php echo _admin_url;?>/table/<?php echo $table; ?>"><i class="icon-list"></i> &nbsp; Manage Records</a></li>
                <?php if($table !="comments" && $table!="ratings" && $table!="saves" && $table!="submission"){?>
                <li class="<?php if(isset($this->vars[1]) && $this->vars[1]== "add" && $this->vars[2]== $table){echo "active";}else{}?>"><a href="<?php echo _admin_url;?>/add/<?php echo $table; ?>"><i class="icon-plus"></i> &nbsp; Add a Record</a></li>
                <?php }?>
              </ul>
            </div>
          </div>
        </div>
        
        <?php }}}?>
        
        
      </div>
