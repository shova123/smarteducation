<?php
function shorten_string($string, $wordsreturned){
    $retval = $string; // Just in case of a problem
    $array = explode(" ", $string);
    /* Already short enough, return the whole thing */
    if (count($array) <= $wordsreturned) {
        $retval = $string;
    }
    /* Need to chop of some words */ else {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array) . " ...";
    }
    return $retval;
}
?>

<script>
    $(function () {
        $('.publish_status a').click(function () {

            var _id = $(this).attr('id');
            var _status = $(this).text();
           
            $('a#' + _id + '').removeClass(_status);
            $(this).html('<img src="<?php echo config_item('admin_images'); ?>ajax-loader.gif" />');
            var _this = $(this);

            $.get('<?php echo base_url("admin/pages/update_testimonial_status"); ?>', {id: _id, status: _status},
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
            <div class="btn-group">
               <a class="btn btn-primary" href="<?php echo base_url("admin/pages/add_testimonial")?>">Create/add new Testimonial <i class="fa fa-plus"></i></a>

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
                               <th>Author Title</th>
                               <th>Content</th>
                               <th class="hidden-phone">Order</th>
                               <th class="hidden-phone">Status</th>
                               <th class="hidden-phone">Operation</th>

                             </tr>
                         </thead>
                         <tbody>
                                <?php if(!empty($pages)){
                                    $count = 1;
                                        foreach($pages as $row){
                                            $edit_id = $row->testimonial_id;
                                            $status = $row->status;
                                ?>

                                 <tr><!--gradeA, gradeC, gradeX, gradeU -->
                                    <td style="text-align:left;"><?php echo $count?></td> 
                                    <td><?php echo $row->author_title;?></td>
                                    <td>
                                        <a href="#" rel="popover" data-trigger="hover" title="Full Address" data-placement="bottom" data-content="<?php echo strip_tags(shorten_string($row->content,50));?>"><?php echo strip_tags(shorten_string($row->content,5));?></a>
                                    </td>
                                    <td class="center hidden-phone"><?php echo $row->order;?></td>
                                    <td class="publish_status">
                                        <a href="javascript:;" id="<?php echo $edit_id;?>"  style="margin:5px; padding:5px 10px;">
                                            <?php echo @$status; ?>
                                        </a>
                                    </td>
<!--                    <td class="center hidden-phone"><a href="javascript:void();" id="<1?php echo $catTrek->id?>"><1?php echo $catTrek->status?></a></td>-->
                                    <td>
                                        <a class="edit" href="<?php echo base_url("admin/pages/edit_testimonial/$edit_id")?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
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
                                                                    Are you sure to delete the testimonial of <strong><?php echo $row->author_title;?></strong>.<br/>
                                                                </p>
                                                            </div>
                                                            <!-- /.modal-body -->
                                                            <div class="modal-footer">
                                                                <a href="<?php echo base_url("admin/pages/delete_testimonial/$edit_id");?>" class="btn btn-danger">Delete</a>
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