<script>
$(function () { 
	$('a.delete_link').bind('click',function()
	{
		return confirm('Are you sure you want to delete this?');
	});
	$('a.no_delete').bind('click',function()
	{
		alert('You cannot delete, Untill there are images inside!');
		return false;
	});
});
</script>
<script>
$(function(){	
    $('.publish_status a').click(function(){ 
	
        var _id = $(this).attr('id');
        var _status = $(this).text();
		$('a#'+_id+'').removeClass(_status);
        $(this).html('<img src="<?php echo config_item('admin_images');?>ajax-loader.gif" />');
        var _this = $(this);//alert(_id);
        $.get('<?php echo admin_url('photogallery/update_status');?>', {id : _id, status : _status},
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
          <h2><?php echo @$page_title;?> Manage</h2>
        </div><!--/col-md-12--> 
      </div><!--/row-->
      
      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            <div class="header">
              <div class="actions"> 
                  <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> 
              </div>
              <h3 class="content-header">View / Edit existing Packages</h3>
            </div>
         <div class="porlets-content">
          <div class="adv-table editable-table ">
                          <div class="clearfix">
                              <div class="btn-group">
                                  <a class="btn btn-primary" href="<?php echo base_url("admin/photogallery/add")?>">Create/add new Package <i class="fa fa-plus"></i></a>
                                  
                              </div>
                          </div>
                          <div class="margin-top-10"></div>
<!--                            <table class="table table-striped table-hover table-bordered" id="editable-sample">-->
                        <table class="table table-striped table-hover table-bordered" id="editable-sample">
                              <thead>
                              <tr>
                                    <th>Sn.</th>                
                                    <th>Gallery name</th>
                                    <th>Gallery Slug</th>
                                    <th>Order</th>
                                    <th>Status</th>
                                    <th>Action</th>
                              </tr>
                              </thead>
                              <tbody>
                               <?php 
                                if(!empty($details)){				
                                        $count = 1;
                                        foreach($details as $row){
                                        $where=array("gid"=>$row->id);
                                        $imgNum = $this->general_db_model->countTotal('tbl_gallery_images',$where);

                                ?>
                      
                    <tr class="gradeA"><!--gradeA, gradeC, gradeX, gradeU -->
                        
                        <td style="text-align:left;"><?php echo $count?></td>            	
                        <td style="text-align:left;"><?php echo $row->gallery_name?></td>
                        <td><?php echo $row->gallery_slug?></td>
                        <td><?php echo $row->order?></td>
                        <td class="publish_status"><a href="javascript:void();" id="<?php echo $row->id?>"><?php echo $row->status?></a></td>
                        <td  class="text-center">
                            <a class="edit" href="<?php echo base_url("admin/photogallery/edit/$row->id")?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                        </td>
                        <td class="text-center">
                            <a class="delete" href="<?php echo base_url("admin/photogallery/delete/$row->id")?>"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>
                        </td>
                      
                    </tr>
                    <?php $count++;}}else
		{
		?>
        <tr><td colspan="6" style="text-align:center">No Gallery Added.</td></tr>
        <?php	
		}
	  ?>     
                             
                             
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
<script>
$(function(){
	$('#message').delay(3000).fadeOut();
});
</script>
 
 
 
 
 
 
 
 
 
      