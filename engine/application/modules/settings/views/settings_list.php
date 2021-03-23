<script src="<?php echo base_url(); ?>gears/admin/js/plugins/masonry/jquery.masonry.min.js"></script>
<script>
$(function(){	
    $('.publish_status a').click(function(){ 
	var _id = $(this).attr('id');
        
        var _status = $(this).text();
		$('a#'+_id+'').removeClass(_status);
        $(this).html('<img src="<?php echo config_item('admin_images');?>ajax-loader.gif" />');
        var _this = $(this);//alert(_id);
        $.get('<?php echo base_url('settings/settings_update_status');?>', {id : _id, status : _status},
		//alert(data);
            function(data){
                _this.text(data);
				$('a#'+_id+'').addClass(data);
				//$('.cross').hide();
        });
    });
});
</script>


<?php 
    if($this->session->flashdata('display_message')!=""){
            $display = '';
    }else{ 
            $display = 'none';
    }
?>
 <div class="">
     <div class="page-title">
        <div class="title_left">
            <a class="btn btn-round btn-primary" href="<?php echo base_url('settings/settings_add') ?>">Create/add Email Setting <i class="fa fa-plus"></i></a>
        </div>
    </div>
     
    <div class="clearfix"></div>
     
    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo ucfirst(@$page_title);?></h2>
                    
                    <div class="clearfix"></div>
                </div>
                 <div class="x_content">
                    <table id="example" class="table table-striped responsive-utilities jambo_table dataTable dataTable-column_filter" data-column_filter_types="null,text,text,null,null" data-column_filter_dateformat="dd-mm-yy"  data-nosort="0" data-checkall="all">
                         <thead>
                             <tr class="headings">
                                <!--<th width="15%">Image</th>-->
                                <th>S.No</th>
                                <th>Setting Title</th>
                                <th>Setting Category</th>
                                <th class="hidden-phone">Status</th>
                                <!--<th>Show Front In</th>-->
                                <th>Actions</th>
                             </tr>
                         </thead>
                         <tbody>
                                <?php if(!empty($settings_list)){
                                      $count=1;
                                foreach($settings_list as $setting){
                                   $setting_id = $setting->setting_id;
                                   $settings_type = $setting->setting_type;
                                   $settings_action = $setting->setting_action;
                                   $status = $setting->status;
                                   if($settings_type == 'activation'){
                                       $iconName = "envelope";
                                       $iconBoxColor = "primary";
                                   }
                                   if($settings_type == 'automation'){
                                       $iconName = "clock-o";
                                       $iconBoxColor = "info";
                                   }
                                   if($settings_type == 'failed'){
                                       $iconName = "exclamation-triangle";
                                       $iconBoxColor = "warning";
                                   }
                                   if($settings_type == 'alert'){
                                       $iconName = "bell";
                                       $iconBoxColor = "inverse";
                                   }
                                   
                                ?>

                                 <tr><!--gradeA, gradeC, gradeX, gradeU -->
<!--                                     <td>
                                         <ul class="gallery">
                                            <li>
                                                <a href="#">
                                                    <img src="<?php echo base_url() ?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT; ?>uploads/settings/<?php echo $imgname; ?>" alt="" />
                                                </a>
                                                <div class="extras">
                                                    <div class="extras-inner">
                                                        <a href="<?php echo base_url(); ?>uploads/settings/<?php echo $imgname; ?>" class='colorbox-image' rel="group-1">
                                                            <i class="fa fa-search"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                     </td>-->
                                    <td><?php echo $count;?></td>
                                    <td><strong><?php echo $setting->setting_title;?></strong></td>
                                    <td>
                                        <button class="btn btn-<?php echo $iconBoxColor;?> btn--icon">
                                            <i class="fa fa-<?php echo $iconName;?>"></i><?php echo $setting->setting_type;?>
                                        </button>
                                    </td>
                                    
                                <td class="center hidden-phone publish_status"><a href="javascript:void();" id="<?php echo $setting->setting_id?>"><?php echo $status;?></a></td>
                                    <td>
                                        <a class="edit" href="<?php echo base_url("settings/settings_edit/$setting_id")?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                        <!--<a class="delete" data-toggle="modal" data-target=".bs-example-modal-sm<?php echo $count;?>"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>-->
                                        <a href="#modal-<?php echo $count;?>" role="button" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>
                                        
                                                <div id="modal-<?php echo $count;?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                            </div>
                                                            <!-- /.modal-header -->
                                                            <div class="modal-body">
                                                                <p>
                                                                    Are you sure to delete this Settings (<strong><?php echo $setting->setting_title;?></strong>).
                                                                </p>
                                                            </div>
                                                            <!-- /.modal-body -->
                                                            <div class="modal-footer">
                                                                <a href="<?php echo base_url("settings/settings_delete/$setting_id");?>" class="btn btn-danger">Delete</a>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                            <!-- /.modal-footer -->
                                                        </div>
                                                        <!-- /.modal-content -->
                                                    </div>
                                                <!-- /.modal-dialog -->
                                                </div>
                                    </td>
                                </tr>
                               <?php $count++;}}?>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>
 
 
 
 
 
 
 
 
 
      