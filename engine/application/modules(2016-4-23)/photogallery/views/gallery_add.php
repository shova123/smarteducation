<!--<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-latest.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.stringToSlug.js"></script>
<script src="<?php  echo base_url();?>assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<script src="<?php  echo base_url();?>assets/uploadify/swfobject.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/uploadify/uploadify.css">

<script>
    $(document).ready(function () {
        $("#title").stringToSlug();
    });
</script>

<script>
<?php $timestamp = time();?>
$(function(){
	$('#home_image').uploadify({
		formData     	: {
					'timestamp' : '<?php echo $timestamp;?>',
					'targetFolder' : '/nepalwellness/uploads/gallery/',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
		height        	: 30,
		swf           	: '<?php echo base_url()?>assets/uploadify/uploadify.swf',
		uploader      	: '<?php echo base_url()?>assets/uploadify/uploadify.php',
		width         	: 120,
		cancelImg 	: '<?php echo base_url() ?>assets/uploadify/cancel.png',
		buttonText 	: 'Upload Image',
		buttonCursor 	: 'hand',
		fileTypeDesc 	: 'Images Only',
		fileSizeLimit 	: '2048KB',
		queueSizeLimit 	: 50,
                    fileTypeExts 	: '*.gif; *.jpg; *.JPEG; *.png', 
		checkExisting 	: '<?php echo base_url()?>assets/uploadify/check-exists.php',	
  		onUploadSuccess : function(file, data, response) {	//alert(data);
					var _gid = <?php echo $gid;?>;
					$('#submitDetail').removeAttr('disabled');
					$('#submitDetail').val('Submit');
					$.post("<?php echo admin_url("photogallery/insertImg");?>",{gid:_gid,imgname:data},
					function(result){
						//alert(result);
						if(result!=''){
							imagePath = "<?php echo str_replace("\\","/",ROOT);?>";
                                                $('.imagethumbs-form').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" title="menson"><ul class="gallery"><li><a class="close-msg" title="Delete" id="deleteImg">Delete</a><a href="#" title="'+data+'" class="img-wrap"><img src="'+"<?php echo base_url()?>"+'assets/createThumb/create_thumb.php?src='+imagePath+'uploads/gallery/'+data+'&w=150&h=150" alt="'+data+'" /></a><span title="'+result+'"></span><div class="extras"><div class="extras-inner"><a class="colorbox-image" rel="group-1" href="'+"<?php echo base_url()?>"+'uploads/gallery/'+data+'" ><i class="fa fa-search"></i></a></div></div></li></ul></div>');	
                                                //$('.imagethumbs-form').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" title="menson"><ul class="gallery"><li> <a class="close-msg" title="Delete" id="deleteImg">Delete</a><a href="#" title="'+data+'" class="img-wrap"><img src="'+"<?php echo base_url()?>"+'assets/createThumb/create_thumb.php?src='+imagePath+'uploads/gallery/'+data+'&w=150&h=150" alt="'+data+'" /></a>  <span title="'+result+'"></span><div class="extras"><div class="extras-inner"><a href="'+"<?php echo base_url()?>"+imagePath+'uploads/gallery/'+data+'" class='colorbox-image' rel="group-1"><i class="fa fa-search"></i></a></div></div></li></ul>');
                                                
						}
					});
			}
  });
});
</script>

<script>
//THIS FUNCTION IS TRIGGERED WHILE UPLOADED IMAGE, IS REQUIRED TO DELETE:
$(document).on('click', 'a#deleteImg', function () {		
		var _id = $(this).next().next().attr("title");//alert(_id);
		var _img = $(this).next().attr("title");//alert(_img);
		var _this = $(this).parent();
		$.post("<?php echo admin_url("photogallery/delete_image");?>",{imgName:_img,id:_id},
		function(data){
			$("i.info").text(data).fadeOut(1000);
			_this.fadeOut(1000, function () {			
			_this.remove();
			$("i.info").text('');
			$("i.info").removeAttr('style');
			  });
			});
		//$(this).parent().fadeOut(2500);
		//alert($('#fileList').val());
	});	

</script>



<?php $isEdit = isset($details) ? true : false;?>
<div class="container-fluid">
    <div class="page-header">
        <div class="pull-left">
            <h1>Gallery &amp; Thumbs</h1>
        </div>
        
    </div>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="<?php echo base_url("admin/dashboard");?>">Dashboard</a>
                <i class="fa fa-angle-right"></i>
            </li>
        </ul>
        <div class="close-bread">
            <a href="#">
                <i class="fa fa-times"></i>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="box">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-picture"></i>
                        Image gallery
                    </h3>
                </div>
                <div class="box-content nopadding">
                    <div class="highlight-toolbar">
                        <div class="pull-left">
                            <div class="btn-toolbar">
                                <div class="form-group">
                                    <!--<label class="col-sm-2 control-label"><strong>Gallery Image</strong></label>-->
                                    <div class="col-sm-12">
                                        <input type="file" name="home_image" id="home_image" /><!--class="form-control"-->
                                        <div class="imagethumbs-form">
                                            <?php
                                            if (!empty($img_details)) {
                                                foreach ($img_details as $row):
                                                    ?>
                                                    <div class="imagethumb-form additional-file-input" id="add-image1" title="menson">
                                                        <ul class="gallery">
                                                            <li>
                                                                <a class="close-msg" title="Delete" id="deleteImg">
                                                                    Delete
                                                                </a>
                                                                <a href="#" title="<?php echo $row->imgname; ?>" class="img-wrap">
                                                                    <img src="<?php echo base_url() ?>assets/createThumb/create_thumb.php?src=<?php echo ROOT; ?>uploads/gallery/<?php echo $row->imgname; ?>&w=150&h=150" />
                                                                </a>  <span title="<?php echo $row->id; ?>"></span>
                                                                <div class="extras">
                                                                    <div class="extras-inner">
                                                                        <a href="<?php echo base_url() ?>uploads/gallery/<?php echo $row->imgname; ?>" class='colorbox-image' rel="group-1">
                                                                            <i class="fa fa-search"></i>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                        
                                                    </div>
                                                    <?php
                                                endforeach;
                                            }
                                            ?>
                                        </div>
                                        
                                        
                                       
                                    </div>
    <!--                                <span style="color: #ff0000;">Choose an image to display as page banner (Only one).</span>-->

                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>

</div>