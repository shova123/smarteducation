<script>
$(function(){	
    $('.publish_status a').click(function(){ 
	
        var _id = $(this).attr('id');
        var _status = $(this).text();
		$('a#'+_id+'').removeClass(_status);
        $(this).html('<img src="<?php echo config_item('admin_images');?>ajax-loader.gif" />');
        var _this = $(this);//alert(_id);
        $.get('<?php echo admin_url('admin/image_update_status');?>', {id : _id, status : _status},
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
          <h2>Manage Pages</h2>
        </div><!--/col-md-12--> 
      </div><!--/row-->
      
      <div class="row">
        <div class="col-md-12">
          <div class="block-web">
            <div class="header">
              <div class="actions"> 
                  <a class="minimize" href="#"><i class="fa fa-chevron-down"></i></a> 
              </div>
              <h3 class="content-header">View / Edit existing pages</h3>
            </div>
         <div class="porlets-content">
          <div class="adv-table editable-table ">
                          <div class="clearfix">
                              <div class="btn-group">
                                  <a class="btn btn-primary" href="<?php echo base_url('admin/links/image_add')?>">Create/add new Images <i class="fa fa-plus"></i></a>
                                  
                              </div>
                          </div>
                          <div class="margin-top-10"></div>
<!--                            <table class="table table-striped table-hover table-bordered" id="editable-sample">-->
                        <table class="table table-striped table-hover table-bordered">
                              <thead>
                              <tr>
                                    <th>Sn.</th>
                                    <th>Image Thumb</th>
                                    <th>Image Title</th>
                                    <th class="hidden-phone">Order</th>
                                    <th class="hidden-phone">Status</th>
<!--                                    <th class="hidden-phone">Operation</th>-->
                                    <th>Edit</th>
                                    <th>Delete</th>
                              </tr>
                              </thead>
                              <tbody>
                               <?php if(!empty($pages)){
                        $count = 1;
                            foreach($pages as $row){
                                $edit_id = $row->id;
                                $imgname = $row->home_image;
                    ?>
                      
                    <tr class="gradeA"><!--gradeA, gradeC, gradeX, gradeU -->
                        <td style="text-align:left;"><?php echo $count?></td> 
                        <td class="center hidden-phone">
                            <img src="<?php echo base_url()?>assets/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/footer_images/<?php echo $imgname;?>"> 
                        </td>
                        <td><?php echo $row->image_title;?></td>
                        <td class="center hidden-phone"><?php echo $row->order;?></td>
                        <td class="center hidden-phone"><a href="javascript:void();" id="<?php echo $row->id?>"><?php echo $row->status?></a></td>
                        <td  class="text-center"><a class="edit" href="<?php echo base_url("admin/links/image_edit/$edit_id")?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a></td>
                        <td class="text-center"><a class="delete" href="<?php echo base_url("admin/links/image_delete/$edit_id")?>"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a></td>
                    </tr>
                    <?php $count++;}}?>
                             
                             
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
 
 
 
 
 
 
 
 
 
      