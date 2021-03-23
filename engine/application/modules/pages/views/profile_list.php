<!--<script>
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
</script>-->
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
             <h1><?php echo @$profile_title;?> </h1>
         </div>
<!--         <div class="pull-right">
            <div class="btn-group">
               <a class="btn btn-primary" href="<?php echo base_url("admin/pages/profile_add")?>">Create/add new Profile <i class="fa fa-plus"></i></a>
            </div>              
         </div>-->

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
                         <?php echo ucfirst(@$profile_title);?>
                     </h3>
                 </div>
                 <div class="box-content nopadding">
                     <table class="table table-hover table-nomargin table-bordered dataTable">
                         <thead>
                            <tr>
                               <th>Sn.</th>
                               <th>Profile Title</th>
                               <th>Users Capacity</th>
                               <th>Templates Capacity</th>
                               <th class="hidden-phone">Operation</th>

                             </tr>
                         </thead>
                         <tbody>
                                <?php if(!empty($profile)){
                                    $count = 1;
                                        foreach($profile as $row){
                                            $edit_id = $row->profile_id;
                                            $users = $row->users;
                                            $templates = $row->templates;
                                ?>

                                 <tr>
                                    <td style="text-align:left;"><?php echo $count?></td> 
                                    <td><?php echo $row->profile_title;?></td>
                                    <td><?php if(!empty($users)){echo $users;}else{echo "<strong>Unlimited</strong>";}?></td>
                                    <td><?php if(!empty($templates)){echo $templates;}else{echo "<strong>Unlimited</strong>";}?></td>
                                    <td>
                                        <a class="edit" href="<?php echo base_url("admin/pages/profile_edit/$edit_id")?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                        <!--<a class="delete" data-toggle="modal" data-target=".bs-example-modal-sm<?php echo $count;?>"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>-->
                                        
<!--                                        <a href="#modal-<?php echo $count;?>" role="button" class="btn" data-toggle="modal">
                                            <button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button>
                                        </a>
                                        
                                                <div id="modal-<?php echo $count;?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>
                                                                    Are you sure to delete This <strong><?php echo $row->profile_title;?></strong> Profile.<br/>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <a href="<?php echo base_url("admin/pages/profile_delete/$edit_id");?>" class="btn btn-danger">Delete</a>
                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>-->
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