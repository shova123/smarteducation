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
	<link rel="stylesheet" href="<?php echo base_url();?>assets/css/plugins/datatable/TableTools.css">
        <!-- New DataTables -->
	<script src="<?php echo base_url();?>assets/js_admin/plugins/momentjs/jquery.moment.min.js"></script>
	<script src="<?php echo base_url();?>assets/js_admin/plugins/momentjs/moment-range.min.js"></script>
	<script src="<?php echo base_url();?>assets/js_admin/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>assets/js_admin/plugins/datatables/extensions/dataTables.tableTools.min.js"></script>
	<script src="<?php echo base_url();?>assets/js_admin/plugins/datatables/extensions/dataTables.colReorder.min.js"></script>
	<script src="<?php echo base_url();?>assets/js_admin/plugins/datatables/extensions/dataTables.colVis.min.js"></script>
	<script src="<?php echo base_url();?>assets/js_admin/plugins/datatables/extensions/dataTables.scroller.min.js"></script>
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
            <?php 
            if($link == 'info'){
                $direction_add = "travel_info_add";
                $direction_edit= "travel_info_edit";
                $direction_delete= "travel_info_delete";
            }elseif($link == 'news'){
                $direction_add= "travel_news_add";
                $direction_edit= "travel_news_edit";
                $direction_delete= "travel_news_delete";
            }
            ?>
            <div class="btn-group">
               <a class="btn btn-primary" href="<?php echo base_url("admin/pages/$direction_add")?>">Create/add new Travel <?php echo ucfirst($link);?> <i class="fa fa-plus"></i></a>

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
                               <th>Sn.</th>
                               <th>Page Title</th>
                               <th>Page Slug</th>
                               <th class="hidden-phone">Order</th>

                               <th class="hidden-phone">Operation</th>

                             </tr>
                         </thead>
                         <tbody>
                                <?php if(!empty($pages)){
                                    $count = 1;
                                        foreach($pages as $row){
                                            $edit_id = $row->id;
                                            
                                ?>

                                 <tr><!--gradeA, gradeC, gradeX, gradeU -->
                                    <td style="text-align:left;"><?php echo $count?></td> 
                                    <td><?php echo $row->page_title;?></td>
                                    <td><?php echo $row->page_slug;?></td>
                                    <td class="center hidden-phone"><?php echo $row->order;?></td>

<!--                    <td class="center hidden-phone"><a href="javascript:void();" id="<1?php echo $catTrek->id?>"><1?php echo $catTrek->status?></a></td>-->
                                    <td>
                                        <a class="edit" href="<?php echo base_url("admin/pages/$direction_edit/$edit_id/$link")?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                        <a href="#modal-<?php echo $count;?>" role="button" class="btn" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>
                                        
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
                                                                    Are you sure to delete this Travel Information <strong><?php echo $row->page_title;?></strong>.<br/>
                                                                </p>
                                                            </div>
                                                            <!-- /.modal-body -->
                                                            <div class="modal-footer">
                                                                <a href="<?php echo base_url("admin/pages/$direction_delete/$edit_id/$link");?>" class="btn btn-danger">Delete</a>
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