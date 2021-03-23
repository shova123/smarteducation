<script src="<?php echo base_url(); ?>gears/admin/js/plugins/masonry/jquery.masonry.min.js"></script>
<script>
$(function(){	
    $('.publish_status a').click(function(){ 
	
        var _id = $(this).attr('id');
        var _status = $(this).text();
		$('a#'+_id+'').removeClass(_status);
        $(this).html('<img src="<?php echo config_item('admin_images');?>ajax-loader.gif" />');
        var _this = $(this);//alert(_id);
        $.get('<?php echo admin_url('admin/update_status');?>', {id : _id, status : _status},
		//alert(data);
            function(data){
                _this.text(data);
				$('a#'+_id+'').addClass(data);
				//$('.cross').hide();
        });
    });
});
</script>
<!-- dataTables -->
	<link rel="stylesheet" href="<?php echo base_url();?>gears/admin/css/plugins/datatable/TableTools.css">
        <!-- New DataTables -->
	<script src="<?php echo base_url();?>gears/admin/js/plugins/momentjs/jquery.moment.min.js"></script>
	<script src="<?php echo base_url();?>gears/admin/js/plugins/momentjs/moment-range.min.js"></script>
	<script src="<?php echo base_url();?>gears/admin/js/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>gears/admin/js/plugins/datatables/extensions/dataTables.tableTools.min.js"></script>
	<script src="<?php echo base_url();?>gears/admin/js/plugins/datatables/extensions/dataTables.colReorder.min.js"></script>
	<script src="<?php echo base_url();?>gears/admin/js/plugins/datatables/extensions/dataTables.colVis.min.js"></script>
	<script src="<?php echo base_url();?>gears/admin/js/plugins/datatables/extensions/dataTables.scroller.min.js"></script>
<?php 
    if($this->session->flashdata('display_message')!=""){
            $display = '';
    }else{ 
            $display = 'none';
    }
?>
 <div class="container-fluid">
     <div class="page-header">
         <div class="pull-left">
             <h1><?php echo @$page_title;?> List</h1>
         </div>
         <div class="pull-right">
            
            <div class="btn-group">
               <a class="btn btn-primary" href="<?php echo base_url("admin/category/category_add")?>">Create/add new Category <i class="fa fa-plus"></i></a>

            </div>              
         </div>
     </div>
     <style>.messages{margin-left:50%;}</style>
    <div class="message" id="message" style="display:<?php echo $display?>">
        <div class="messages">
            <div class="icon-messages icon-success"></div>
            <div id="displayMsg"><?php echo @$this->session->flashdata('display_message')?></div>
            <a href="#" onclick="javascript:getElementById('message').style.display='none'" class="close-msg" title="close">Close</a>
        </div>               
    </div>
<!--     <div class="breadcrumbs">
         <ul>
             <li>
                 <a href="more-login.html">Home</a>
                 <i class="fa fa-angle-right"></i>
             </li>
             <li>
                 <a href="tables-basic.html">Tables</a>
                 <i class="fa fa-angle-right"></i>
             </li>
             <li>
                 <a href="tables-advanced.html">Advanced tables</a>
             </li>
         </ul>
         <div class="close-bread">
             <a href="#">
                 <i class="fa fa-times"></i>
             </a>
         </div>
     </div>-->
     <div class="row">
         <div class="col-sm-12">
             <div class="box box-color box-bordered">
                 <div class="box-title">
                     <h3>
                         <i class="fa fa-table"></i>
                         <?php echo ucfirst(@$page_title);?>
                     </h3>
                 </div>
                 <div class="box-content nopadding">
                     <table class="table table-hover table-nomargin table-bordered dataTable">
                         <thead>
                             <tr>
                                <!--<th width="15%">Image</th>-->
                                <th>S.No</th>
                                <th>Category Title</th>
                                <th>Sub Category</th>
                                <th class="hidden-phone">Created Date</th>
                                <!--<th>Show Front In</th>-->
                                <th>Actions</th>
                             </tr>
                         </thead>
                         <tbody>
                                <?php if(!empty($category_list)){
                                      $count=1;
                                foreach($category_list as $catTrek){
                                   $edit_id = $catTrek->category_id;
                                   $category_type = $catTrek->category_type;
                                   
                                   
                                ?>

                                 <tr><!--gradeA, gradeC, gradeX, gradeU -->
<!--                                     <td>
                                         <ul class="gallery">
                                            <li>
                                                <a href="#">
                                                    <img src="<?php echo base_url() ?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT; ?>uploads/category/<?php echo $imgname; ?>" alt="" />
                                                </a>
                                                <div class="extras">
                                                    <div class="extras-inner">
                                                        <a href="<?php echo base_url(); ?>uploads/category/<?php echo $imgname; ?>" class='colorbox-image' rel="group-1">
                                                            <i class="fa fa-search"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                     </td>-->
                                    <td><?php echo $count;?></td>
                                    <td><strong><?php echo $catTrek->category_title;?></strong></td>
                                    <td>
                                        <?php 
                                        if(!empty($category_type) && $category_type == "sub_category"){
                                        ?>
                                        <a href="<?php echo base_url("category/category_sub/$edit_id");?>">Sub category</a>
                                        <?php }else{
                                            echo "No Sub Category";
                                        }?>
                                    </td>
                                    <td><?php echo $catTrek->date;?></td>
            <!--                    <td class="center hidden-phone"><a href="javascript:void();" id="<1?php echo $catTrek->id?>"><1?php echo $catTrek->status?></a></td>-->
                                    <!--<td><?php echo $catTrek->display_type; ?></td>-->
                                    <td>
                                        <a class="edit" href="<?php echo base_url("admin/category/category_edit/$edit_id")?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
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
                                                                    Are you sure to delete this Activity (<strong><?php echo $catTrek->category_title;?></strong>).
                                                                </p>
                                                            </div>
                                                            <!-- /.modal-body -->
                                                            <div class="modal-footer">
                                                                <a href="<?php echo base_url("admin/category/category_delete/$edit_id");?>" class="btn btn-danger">Delete</a>
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
 
 
 
 
 
 
 
 
 
      