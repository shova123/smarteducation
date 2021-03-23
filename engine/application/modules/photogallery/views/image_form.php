<script src="<?php echo base_url()?>assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/uploadify/swfobject.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/uploadify/uploadify.css">
<script>
<?php $timestamp = time();?>
$(function(){
	$('#home_image').uploadify({
		formData     	: {
					'timestamp' : '<?php echo $timestamp;?>',
					'targetFolder' : '/ticino/uploads/gallery/',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
		height        	: 30,
		swf           	: '<?php echo base_url()?>assets/uploadify/uploadify.swf',
		uploader      	: '<?php echo base_url()?>assets/uploadify/uploadify.php',
		width         	: 120,
		cancelImg 	  	: '<?php echo base_url() ?>assets/uploadify/cancel.png',
		buttonText 		: 'Upload Image',
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
						if(result=='yes'){
						$('.imagethumbs-form').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" title="bkesh"> <a class="close-msg" title="Delete" id="deleteImg">Delete</a> <a href="#" title="'+data+'" class="img-wrap"> <img id="imgThumb" src="'+"<?php echo base_url()?>"+'uploads/gallery/'+data+'" width="150" height="110" alt="'+data+'" /></a></div>');	
						}
					});
			}
  });
});
</script>
<script>
$(function(){	
    $('.publish_status a').click(function(){ 
	
        var _id = $(this).attr('id');
        var _status = $(this).text();
		$('a#'+_id+'').removeClass(_status);
        $(this).html('<img src="<?php echo config_item('admin_images');?>ajax-loader.gif" />');
        var _this = $(this);//alert(_id);
        $.get('<?php echo admin_url('photogallery/update_status');?>', {id : _id, status : _status},
		//alert(data);
            function(data){
                _this.text(data);
				$('a#'+_id+'').addClass(data);
				//$('.cross').hide();
        });
    });
});
</script>
<?php $isEdit = isset($details) ? true : false;?>
<div class="titlebar" align="center"><h1 align="left"><?php echo $page_title?></h1></div>
<div class="table-wrapper form-wrapper">
<?php echo form_open_multipart('',array('id'=>'addEditform','name'=>'addEditform','class'=>'userpane'));?>
<table border="0" cellpadding="5" cellspacing="0" width="100%">
<tr>
  <td width="15%" valign="top"><strong>Image:</strong></td>
  <td width="85%"><input type="file" name="home_image" id="home_image" />
<div class="imagethumbs-form">
</div>
</tr>
<tr>
  <td >&nbsp;</td>
  <td><a class="btn front-next" href="javascript:history.back(-1)">Go Back</a></td>
</tr>   
</table>  
<?php echo form_close();?> 
</div>