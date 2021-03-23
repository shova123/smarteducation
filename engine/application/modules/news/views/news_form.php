<!--<script src="<!?php echo base_url();?>assets/js/jquery-2.0.2.min.js"></script> -->
<!--<script src="<?php //  echo base_url();?>assets/js/add-more.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php // echo base_url();?>assets/js/jquery-latest.js"></script>
<script type="text/javascript" src="<?php // echo base_url();?>assets/js/jquery.stringToSlug.js"></script>
<script src="<?php //  echo base_url();?>assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<script src="<?php //  echo base_url();?>assets/uploadify/swfobject.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php // echo base_url();?>assets/uploadify/uploadify.css">
<link rel="stylesheet" type="text/css" href="<?php // echo base_url();?>assets/css/dim.css">-->

<!--<script>
$(document).ready( function() {
		$("#page_title").stringToSlug();
	});
</script>-->
<script>
window.onload = function(){
	CKEDITOR.replace('content');
};
</script>

<!--<script>
<?php // $timestamp = time();?>
$(function(){
	$('#see_on_map').uploadify({
		formData     	: {
					'timestamp' : '<?php // echo $timestamp;?>',
					'targetFolder' : 'meghauli/uploads/package/',
					'token'     : '<?php // echo md5('unique_salt' . $timestamp);?>'
				},
		height        	: 30,
		swf           	: '<?php // echo base_url();?>assets/uploadify/uploadify.swf',
		uploader      	: '<?php // echo base_url();?>assets/uploadify/uploadify.php',
		width         	: 120,
		cancelImg 	: '<?php // echo base_url();?>assets/uploadify/cancel.png',
		buttonText 	: 'Upload Image',
		buttonCursor 	: 'hand',
		multi		: false,
		fileTypeDesc 	: 'Images Only',
		fileSizeLimit 	: '2048KB',
		queueSizeLimit 	: 50,
                fileTypeExts 	: '*.gif; *.jpg; *.JPEG; *.png', 
		checkExisting 	: '<?php // echo base_url();?>assets/uploadify/check-exists.php',
		onSelect		: function(file){
					//if($('#fileList').val()=='') return true; else return false;
					//alert('a');
					$('#submitDetail').val('Please wait while uploading...');
					$('#submitDetail').val('disabled','disabled');
    		},
	/*	//Default as provided by site: ITS ALWAYS SAME, THE ORDER NEEDS TO REMAIN SAME, NO MATTER THE NAME OF VARIABLE!
		onUploadSuccess : function(file, data, response) {
            alert('The file ' + file.name + ' was successfully uploaded with a response of ' + response + ':' + data);
        } */
  		onUploadSuccess : function(file, data, response) {	//alert(file.name);
					if($('#fileList').val()!=''){//alert('full');
						$('#fileList').val($('#fileList').val()+':'+data);}
					else{//alert('blank');
						$('#fileList').val(data);}
						imagePath = "<?php // echo str_replace("\\","/",ROOT);?>";
					$('.imagethumbs-form').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" > <a class="close-msg" title="Delete" id="deleteImg">Delete</a> <a href="#" title="'+data+'" class="img-wrap"><img src="'+"<?php echo base_url();?>"+'assets/createThumb/create_thumb.php?src='+imagePath+'uploads/package/'+data+'&w=150&h=150" alt="'+data+'" /></a></div>');
					//alert($('#fileList').val());					
					$('#submitDetail').removeAttr('disabled');
					$('#submitDetail').val('Submit');
			}
  });
});
</script>
<script>
//THIS FUNCTION IS TRIGGERED WHILE UPLOADED IMAGE, IS REQUIRED TO DELETE:
$(function(){
	$('a#deleteImg').live('click',function(){		
		var _img = $(this).next().attr("title");//alert(_img);
		var _this = $(this).parent();
		delete_image(_img);
		$.post("<?php // echo admin_url("package/delete_map_image");?>",{imgName:_img},
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

//THIS IS COMMON FUNCTION FOR DELETING FILE FORM THE LIST:
function delete_image(name){
	var filelist = $('#fileList').val();
	var filenames = filelist.split(':'); //alert(filenames.length);
	$('#fileList').val('');
	for(var i=0;i<filenames.length;i++)
	{
		if(filenames[i] != name)
		{	
			if($('#fileList').val()=='')
				$('#fileList').val(filenames[i]);
			else		
				$('#fileList').val($('#fileList').val()+':'+filenames[i]);
		}	
	}
}
</script>-->
<!-- gallery images for packages start                            -->

<!--   gallery images for packages end                            -->

<?php $isEdit = isset($details) ? true : false;?>
<div class="page-content">
    <div class="row">
        <div class="col-md-12">
        <h2><?php echo @$page_title;?> </h2>
        </div><!--/col-md-12--> 
    </div><!--/row-->

<form class="form-horizontal row-border" method="post" enctype="multipart/form-data" name="addEditform" id="addEditform" action="" parsley-validate novalidate>    

 
    
    <div class="row">
            <div class="col-md-12">
                <div class="block-web">
                <div class="header">
                    <div class="actions"> 
                        <a href="#" class="minimize"><i class="fa fa-chevron-down"></i></a> 
<!--                        <a href="#" class="refresh"><i class="fa fa-repeat"></i></a> 
                        <a href="#" class="close-down"><i class="fa fa-times"></i></a> -->
                    </div>
                    <h3 class="content-header">News Details</h3>
                </div>
                <div class="porlets-content">
                    <div class="form-horizontal row-border" ><!--form start-->

                        
                            <div class="form-group">
                                <label class="col-sm-2 control-label">News Heading</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="heading" id="heading" value="<?php if(@$isEdit) echo $details->heading;?>" required/>
                                </div>
                            </div><!--/form-group-->
                            
                            
                           
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><strong>News Description</strong></label>
                                <div class="col-sm-10">
                                <textarea class="form-control ckeditor" name="content" rows="6" ><?php if(@$isEdit){echo $details->content;}?></textarea>
                                </div>
                            </div>
                           
                            
                        </div><!--/form end-->
                </div><!--/porlets-content-->
                </div><!--/block-web--> 
            </div><!--/col-md-6-->
        </div><!--/row-->
        
        <div class="form-group">
                                <label class="col-sm-2 col-sm-2"></label>
                                <div class="col-sm-10">
                                <input type="submit" name="submitDetail" value="<?php if(@$isEdit){echo 'Edit Package';}else{echo 'Add Page';}?>" class="btn btn-primary"/>
                                </div>
                            </div>
    </form>    

</div>