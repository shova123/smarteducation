<script>
$(function(){	
    $('.publish_status a').click(function(){ 
	
        var _id = $(this).attr('id');
        var _status = $(this).text();
		$('a#'+_id+'').removeClass(_status);
        $(this).html('<img src="<?php echo config_item('admin_images');?>ajax-loader.gif" />');
        var _this = $(this);//alert(_id);
        $.get('<?php echo base_url('pages/video_update_status');?>', {id : _id, status : _status},
		//alert(data);
            function(data){
                _this.text(data);
				$('a#'+_id+'').addClass(data);
				//$('.cross').hide();
        });
    });
});
</script>


<div class="">
    <div class="page-title">
        <div class="title_left">
            <a class="btn btn-round btn-primary" href="<?php echo base_url("pages/add_video")?>"> Add new video <i class="fa fa-plus"></i></a>
        </div>

<!--        <div class="title_right">
            <button class="btn btn-round btn-success" type="button">Add Group</button>
        </div>-->
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
                    <!--<table id="example" class="table table-striped responsive-utilities jambo_table">-->
                    <!--<table id="example" class="table table-striped responsive-utilities jambo_table dataTable dataTable-column_filter" data-column_filter_types="null,text,text,select,select,text,null" data-column_filter_dateformat="dd-mm-yy"  data-nosort="0" data-checkall="all">-->
                    <table id="example" class="table table-striped responsive-utilities jambo_table dataTable " >
                        <thead>
                            <tr class="headings">
<!--                                <th>
                                    <input type="checkbox" class="tableflat">
                                </th>-->
                                <th>Sn.</th>
                                <th>Video Preview</th>
                                <th>Video Title</th>
                               <th>Status</th>
                                <th class=" no-link last"><span class="nobr">Operation</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(!empty($videos)){
                                    $count = 1;
                                        foreach($videos as $row){
                                            $edit_id = $row->id;
                                            $videosID = $row->video_id;
                                           
                                ?>

                                    <tr>
                                        <td style="text-align:left;"><?php echo $count?></td>
                                        <td> 
                                            <iframe id="ytplayer" type="text/html" width="300" height="150"
    src="http://www.youtube.com/embed/<?php echo $videosID;?>?rel=0&showinfo=0&color=white&iv_load_policy=3"
    frameborder="0" allowfullscreen></iframe>
                                            
                                            <!--<object width="525" height="350" data="http://www.youtube.com/v/<?php echo $videosID;?>" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/<?php echo $videosID;?>" /></object>-->
                                 </td>
                                        <td><?php echo $row->video_title;?></td>
                                        
                                        <td class="publish_status">
                                            <a href="javascript:;" id="<?php echo $row->id;?>"  style="margin:5px; padding:5px 10px;<?php if(!empty($active)){?>background-color: #006600;<?php }?>" class="badge">
                                                <?php echo @$row->status; ?>
                                            </a>
                                        </td>
                                        
                                        <td>
                                            <a class="edit" href="<?php echo base_url("pages/edit_video/$edit_id")?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                            <a class="edit" href="#modal-<?php echo $count; ?>" role="button" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>

                                            <div id="modal-<?php echo $count; ?>" class="modal fade" role="dialog">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                            <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                                                        </div>
                                                        <!-- /.modal-header -->
                                                        <div class="modal-body">
                                                            <p>
                                                                Are you sure to delete the Page <strong><?php echo $row->video_title;?></strong>.<br/>
                                                            </p>
                                                        </div>
                                                        <!-- /.modal-body -->
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url("pages/video_delete/$edit_id") ?>" class="btn btn-danger">Delete</a>
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
                                    <?php
                                    $count++;
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>

        <br />
        <br />
        <br />

    </div>
</div>