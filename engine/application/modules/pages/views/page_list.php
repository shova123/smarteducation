<script>
$(function(){	
    $('.publish_status a').click(function(){ 
	
        var _id = $(this).attr('id');
        var _status = $(this).text();
		$('a#'+_id+'').removeClass(_status);
        $(this).html('<img src="<?php echo config_item('admin_images');?>ajax-loader.gif" />');
        var _this = $(this);//alert(_id);
        $.get('<?php echo admin_url('pages/update_status');?>', {id : _id, status : _status},
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
            <a class="btn btn-round btn-primary" href="<?php echo base_url("pages/add_page")?>"> Add new Page <i class="fa fa-plus"></i></a>
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
                                <th>Page Title</th>
                                <th>Page Type</th>
                                <th>SubContent Page</th>
                                <th class="hidden-phone">Order</th>
                                <th class="hidden-phone">Display Type</th>
                                <th class=" no-link last"><span class="nobr">Operation</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if(!empty($pages)){
                                    $count = 1;
                                        foreach($pages as $row){
                                            $edit_id = $row->page_id;
                                            $page_type = $row->page_type;
                                            $display_type = $row->display_type;
                                            $explodeDisplay = explode("||", $display_type);
                                            $subContentPage = $row->page_name;
                                            if($page_type == 'content'){
                                                $color = "info";
                                            }
                                            if($page_type == 'subcontent'){
                                                $color = "success";
                                            }
                                            if($page_type == 'subcontentvideo'){
                                                $color = "warning";
                                            }
                                            if($page_type == 'subcontentpricing'){
                                                $color = "danger";
                                            }
                                ?>

                                    <tr>
                                        <td style="text-align:left;"><?php echo $count?></td>
                                        <td><?php echo $row->page_title;?></td>
                                        <td>
                                            <?php if($page_type == 'subpage'){?>
                                                    <a class="btn btn-primary" href="<?php echo base_url("pages/subpages");?>"><?php echo ucfirst($page_type);?></a>
                                            <?php }else{?>
                                                    <a class="btn btn-<?php echo $color;?>"  href=""><?php echo ucfirst($page_type);?></a>
                                            <?php }?>
                                        </td>
                                        <td><?php echo $subContentPage;?></td>
                                        <td class="center hidden-phone"><?php echo $row->order;?></td>
                                        <td><?php if(!empty($explodeDisplay)){foreach($explodeDisplay as $displayes){if($displayes == "home"){$dis_type= 'default';}elseif($displayes == "header"){$dis_type= 'primary';}elseif($displayes == "container"){$dis_type= 'warning';} echo "<span class='label label-$dis_type'>$displayes</span> ";}};?></td>
<!--                                        <td class="publish_status">
                                            <a href="javascript:;" id="<?php echo $user->user_id;?>"  style="margin:5px; padding:5px 10px;<?php if(!empty($active)){?>background-color: #006600;<?php }?>" class="badge">
                                                <?php echo @$status; ?>
                                            </a>
                                        </td>-->
                                        
                                        <td>
                                            <a class="edit" href="<?php echo base_url("pages/edit_page/$edit_id")?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
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
                                                                Are you sure to delete the Page <strong><?php echo $row->page_title;?></strong>.<br/>
                                                            </p>
                                                        </div>
                                                        <!-- /.modal-body -->
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url("pages/delete_page/$edit_id") ?>" class="btn btn-danger">Delete</a>
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