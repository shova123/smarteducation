<?php // echo ROOT?>
<script type="text/javascript" src="<?php echo base_url()?>assets/js/jquery.stringToSlug.js"></script>
<script src="<?php echo base_url()?>assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/uploadify/swfobject.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/uploadify/uploadify.css">
<script>
$(document).ready( function() {
		$("#gallery_name").stringToSlug();
	});
</script>

<script>
$(function(){
	$('#addEditform').validate();
});
</script>
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
						//alert(result);
						if(result!=''){
							imagePath = "<?php echo str_replace("\\","/",ROOT);?>";
						$('.imagethumbs-form').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" title="bkesh"> <a class="close-msg" title="Delete" id="deleteImg">Delete</a> <a href="#" title="'+data+'" class="img-wrap"> <img src="'+"<?php echo base_url()?>"+'assets/createThumb/create_thumb.php?src='+imagePath+'uploads/gallery/'+data+'&w=150&h=150" alt="'+data+'" /></a><span title="'+result+'"></span></div>');	

						}
					});
			}
  });
});
</script>
<script>
//THIS FUNCTION IS TRIGGERED WHILE UPLOADED IMAGE, IS REQUIRED TO DELETE:
$(function(){
	$('a#deleteImg').live('click',function(){		
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
});
</script>
<?php $isEdit = isset($details) ? true : false;?>
<div class="titlebar" align="center"><h1 align="left"><?php echo $page_title?></h1></div>
<div class="table-wrapper form-wrapper">
<?php echo form_open_multipart('',array('id'=>'addEditform','name'=>'addEditform','class'=>'userpane'));?>
<table border="0" cellpadding="5" cellspacing="0" width="100%">
<tr>
  <td ><strong>Gallery Name</strong></td>
  <td><input name="gallery_name" type="text" class="required txtinput" id="gallery_name" value="<?php if($isEdit) echo $details->gallery_name;?>" size="75"/></td>
</tr>
<tr style="display:none">
  <td ><strong>Gallery Slug</strong></td>
  <td><input type="text" id="permalink" name="gallery_slug" class="required txtinput" value="<?php if($isEdit) echo $details->gallery_slug;?>" size="50"/></td>
</tr>
<tr>
  <td style="vertical-align:top;width:150px;"><strong>gallery Content</strong></td>
  <td><textarea id="content" name="content" class="required txtinput" style="height:100px;width:400px;" ><?php if($isEdit) echo $details->content;?></textarea></td>
</tr> 
<tr>
  <td valign="top"><strong>Order:</strong></td>
  <td><input type="text" name="order" class="inp-form required number" value="<?php if($isEdit) echo $details->order;?>"/>
    <span style="margin-left:20px;">only integers</span></td>
</tr>
<tr>
  <td valign="top"><strong>Status:</strong></td>
  <td><select name="status" class="selectType">
    <option value="Publish" <?php if(($isEdit) && ($details->status=='Publish')) echo "selected";?>>Publish</option>
    <option value="Unpublish" <?php if(($isEdit) && ($details->status=='Unpublish')) echo "selected";?>>Unpublish</option>
  </select></td>
</tr>
<tr>
  <td >&nbsp;</td>
  <td><input type="submit" name="submitDetail" id="submitDetail" value="Submit" class="btn front-next" /><?php echo form_close();?> </td>
</tr>
<tr>
  <td ><strong>Gallery Images:</strong></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td height="1" colspan="2" style="background-color:#0B6EB3; padding:0" > </td>
  </tr>
<tr>
  <td colspan="2" >
  <?php echo form_open_multipart('',array('id'=>'addEditform','name'=>'addEditform','class'=>'userpane'));?>
  	<input type="file" name="home_image" id="home_image" />
    <div class="imagethumbs-form">
<?php 
if(!empty($img_details)){				
	foreach($img_details as $row):				
?>
      <div class="imagethumb-form additional-file-input" id="add-image1" title="bkesh">
        	<a class="close-msg" title="Delete" id="deleteImg">
            	Delete
            </a>
            <a href="#" title="<?php echo $row->imgname;?>" class="img-wrap">
                <img src="<?php echo base_url()?>assets/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/gallery/<?php echo $row->imgname;?>&w=150&h=150" />
            </a>  <span title="<?php echo $row->id;?>"></span>
        </div>
<?php endforeach;}?>
    </div>
  <?php echo form_close();?> 
  </td>
  </tr>
<tr>
  <td colspan="2" ><i class="info"></i></td>
</tr>   
</table>  
</div>