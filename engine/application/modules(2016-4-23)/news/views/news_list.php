<script>
$(function(){	
    $('.publish_status a').click(function(){ 
	
        var _id = $(this).attr('id');
        var _status = $(this).text();
		$('a#'+_id+'').removeClass(_status);
        $(this).html('<img src="<?php echo config_item('admin_images');?>ajax-loader.gif" />');
        var _this = $(this);
        $.get('<?php echo admin_url('news/update_status');?>', {id : _id, status : _status},
		//alert(data);
            function(data){
                _this.text(data);
				$('a#'+_id+'').addClass(data);
				//$('.cross').hide();
        });
    });
});
</script>
<?php if($this->session->flashdata('display_message')!="")
	$display = '';
else 
	$display = 'none'?>
  

        <div class="message" id="message" style="display:<?php echo $display?>">
            <div class="messages">
                <div class="icon-messages icon-success"></div>
                <div id="displayMsg"><?php echo @$this->session->flashdata('display_message')?></div>
                <a href="#" onclick="javascript:getElementById('message').style.display='none'" class="close-msg" title="close">Close</a>
            </div>               
        </div>
        
  
  
  <div style="clear:both;height:1px"></div>
  
<div class="page-content">
      <div class="row">
        <div class="col-md-12">
          <h2><?php echo @$page_title;?></h2>
        </div><!--/col-md-12--> 
      </div><!--/row-->
      
      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            <div class="header">
              <div class="actions"> 
                  <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> 
              </div>
              <h3 class="content-header">View / Edit existing News</h3>
            </div>
         <div class="porlets-content">
          <div class="adv-table editable-table ">
                          <div class="clearfix">
                              <div class="btn-group">
                                  <a class="btn btn-primary" href="<?php echo base_url("admin/news/news_add")?>">Create/add new Package <i class="fa fa-plus"></i></a>
                                  
                              </div>
                          </div>
                          <div class="margin-top-10"></div>
<!--                            <table class="table table-striped table-hover table-bordered" id="editable-sample">-->
                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                              <thead>
                              <tr>
                                    <th>Heading</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                   
                              </tr>
                              </thead>
                              <tbody>
                               <?php if(!empty($page)){
                                   foreach($page as $ipage){
                                $edit_id = $ipage->id;
                                $status=$ipage->status;
                    ?>
                      
                    <tr class="gradeC"><!--gradeA, gradeC, gradeX, gradeU -->
                        
                        <td><?php echo $ipage->heading;?></td>
                        <td><?php echo $ipage->date;?></td>
                       <td class="publish_status"><a href="javascript:;" id="<?php echo $ipage->id; ?>"><?php echo $status;?></a></td>
                      <td  class="text-center"><a class="edit" href="<?php  echo base_url("admin/news/news_edit/$edit_id")?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a></td>
                      <td class="text-center"><a class="delete" href="<?php echo base_url("admin/news/news_delete/$edit_id")?>"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a></td>
                    </tr>
                    <?php }}?>
                             
                             
                              </tbody>
                          </table>
                      </div>
 
            </div><!--/porlets-content-->  
          </div><!--/block-web--> 
        </div><!--/col-md-12--> 
      </div><!--/row-->
       
    </div><!--/page-content end--> 
 
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="<?php echo base_url();?>assets/js/jquery-2.0.2.min.js"></script> 
<script src="<?php echo base_url();?>assets/plugins/data-tables/jquery.dataTables.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/plugins/data-tables/DT_bootstrap.js" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/plugins/data-tables/dynamic_table_init.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/edit-table/edit-table.js" type="text/javascript"></script>

<script>
          jQuery(document).ready(function() {
              EditableTable.init();
          });
 </script>
 
 
 
 
 
 
 
 
 
      