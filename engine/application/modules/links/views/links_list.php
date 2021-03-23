<script>
    $(function () {
        $('.publish_status a').click(function () {

            var _id = $(this).attr('id');
            var _status = $(this).text();
           
            $('a#' + _id + '').removeClass(_status);
            $(this).html('<img src="<?php echo config_item('admin_images'); ?>ajax-loader.gif" />');
            var _this = $(this);

            $.get('<?php echo admin_url("links/update_status"); ?>', {id: _id, status: _status},
            //alert(data);
            function (data) {
                _this.text(data);
                $('a#' + _id + '').addClass(data);
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
 <div class="container-fluid">
     <div class="page-header">
         <div class="pull-left">
             <h1><?php echo @$page_title;?> List</h1>
         </div>
         <div class="pull-right">
            
<!--            <div class="btn-group">
               <a class="btn btn-primary" href="<?php echo base_url("admin/pages/add")?>">Create/add new Package <i class="fa fa-plus"></i></a>

            </div>              -->
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
                                    <th>Link Title</th>
                                    <th>Fb, Tweet, Google Link</th>
                                    <th class="hidden-phone">Status</th>
                                    <th>Edit</th>
<!--                                    <th>Delete</th>-->
                              </tr>
                         </thead>
                         <tbody>
                                <?php if(!empty($links)){
                                    $count = 1;
                                        foreach($links as $row){
                                            $edit_id = $row->id;
                                            $status = $row->status;
                                ?>

                                 <tr><!--gradeA, gradeC, gradeX, gradeU -->
                                    <td style="text-align:left;"><?php echo $count?></td> 
                                    <td><?php echo $row->link_title;?></td>
                                    <td><?php echo $row->http_links;?></td>
                                    <!--<td class="center hidden-phone"><a href="javascript:void();" id="<?php echo $row->id?>"><?php echo $row->status?></a></td>-->
                                    <td class="publish_status">
                                        <a href="javascript:;" id="<?php echo $edit_id;?>"  style="margin:5px; padding:5px 10px;">
                                            <?php echo @$status; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="edit" href="<?php echo base_url("admin/links/edit/$edit_id")?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                        <!--<a class="delete" data-toggle="modal" data-target=".bs-example-modal-sm<?php echo $count;?>"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>-->
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