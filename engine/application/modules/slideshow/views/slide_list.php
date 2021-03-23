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


$(document).ready(function() {


    if ($(".gallery-dynamic").length > 0) {
        $(".gallery-dynamic").imagesLoaded(function() {
            $(".gallery-dynamic").masonry({
                itemSelector: 'li',
                columnWidth: 201,
                isAnimated: true
            });
        });
    }
    
    if ($(".colorbox-image").length > 0) {
		$(".colorbox-image").colorbox({
			maxWidth : "90%",
			maxHeight: "90%",
			rel      : $(this).attr("rel")
		});
	}

});
</script>
 <!--image view popup-->
<link rel="stylesheet" href="<?php echo base_url();?>gears/admin/js/plugins/colorbox/colorbox.css">
<link rel="stylesheet" href="<?php echo base_url();?>gears/admin/js/plugins/masonry/masonry.css">
<script src="<?php echo base_url();?>gears/admin/js/plugins/colorbox/jquery.colorbox-min.js"></script>
<script src="<?php echo base_url();?>gears/admin/js/plugins/masonry/jquery.masonry.min.js"></script>
<script src="<?php echo base_url();?>gears/admin/js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
<div class="">
    <div class="page-title">
        <div class="title_left">
            <a class="btn btn-round btn-primary" href="<?php echo base_url("admin/slideshow/add")?>"> Add new Slide <i class="fa fa-plus"></i></a>
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
                    <table id="example" class="table table-striped responsive-utilities jambo_table">
                        <thead>
                            <tr class="headings">
<!--                                <th>
                                    <input type="checkbox" class="tableflat">
                                </th>-->
                                <th style="width: 150px">Image</th>
                                <th>Description</th>
                                <th>Order</th><!--
                                <th>File info</th>-->
                                <th class=" no-link last"><span class="nobr">Operation</span></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            if (!empty($details)) {
                                $count = 1;
                                foreach ($details as $row) {
                                    $imgname = $row->imgname;
                                    $img = explode(':', $imgname);
                                    $imgname = $img['0'];
                            ?>

                                    <tr>
                                        <td>
                                            <ul class="gallery">
                                                <li>
                                                    <a href="#">
                                                        <img src="<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/slides/<?php echo $imgname;?>" alt="">
                                                    </a>
                                                    <div class="extras">
                                                        <div class="extras-inner">
                                                            <a href="<?php echo base_url();?>uploads/slides/<?php echo $imgname;?>" class='colorbox-image' rel="group-1">
                                                                <i class="fa fa-search"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </td>
                                        <td><a title="" href="javascript:;"><?php echo $row->title; ?></a>
                                            <p><?php echo $row->describe; ?></p>
                                        </td>
                                        <td><?php echo $row->order; ?></td>
                                        
                                        
                                        <td>
                                            <a class="edit" href="<?php echo base_url()?>admin/slideshow/edit/<?php echo $row->id ?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
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
                                                                Are you sure to delete the Slide <strong><?php echo $row->title;?></strong>.<br/>
                                                            </p>
                                                        </div>
                                                        <!-- /.modal-body -->
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url();?>admin/slideshow/delete/<?php echo $row->id ?>" class="btn btn-danger">Delete</a>
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