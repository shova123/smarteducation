<!--<script src="<!?php echo base_url();?>assets/js/jquery-2.0.2.min.js"></script> -->
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-latest.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.stringToSlug.js"></script>
<script src="<?php  echo base_url();?>assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<script src="<?php  echo base_url();?>assets/uploadify/swfobject.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/uploadify/uploadify.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dim.css">

<script>
$(document).ready( function() {
		$("#page_title").stringToSlug();
	});
</script>
<script>
window.onload = function(){
	CKEDITOR.replace('content');
};
</script>
<script>
<?php $timestamp = time();?>
$(function(){
	$('#home_image').uploadify({
		formData     	: {
					'timestamp' : '<?php echo $timestamp;?>',
					'targetFolder' : '/uploads/important_links/',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
		height        	: 30,
		swf           	: '<?php echo base_url();?>assets/uploadify/uploadify.swf',
		uploader      	: '<?php echo base_url();?>assets/uploadify/uploadify.php',
		width         	: 120,
		cancelImg 	: '<?php echo base_url();?>assets/uploadify/cancel.png',
		buttonText 	: 'Upload Image',
		buttonCursor 	: 'hand',
		multi		: false,
		fileTypeDesc 	: 'Images Only',
		fileSizeLimit 	: '2048KB',
		queueSizeLimit 	: 50,
                fileTypeExts 	: '*.gif; *.jpg; *.JPEG; *.png', 
		checkExisting 	: '<?php echo base_url();?>assets/uploadify/check-exists.php',
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
						imagePath = "<?php echo str_replace("\\","/",ROOT);?>";
					$('.imagethumbs-form').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" > <a class="close-msg" title="Delete" id="deleteImg">Delete</a> <a href="#" title="'+data+'" class="img-wrap"><img src="'+"<?php echo base_url();?>"+'assets/createThumb/create_thumb.php?src='+imagePath+'uploads/important_links/'+data+'&w=150&h=150" alt="'+data+'" /></a></div>');
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
		$.post("<?php echo admin_url("links/link_delete_image");?>",{imgName:_img},
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
</script>
<?php $isEdit = isset($details) ? true : false;?>
<div class="page-content">
    <div class="row">
        <div class="col-md-12">
        <h2><?php echo $page_title?></h2>
        </div><!--/col-md-12--> 
    </div><!--/row-->

<?php echo form_open_multipart('',array('id'=>'addEditform','name'=>'addEditform','class'=>'form-horizontal row-border'));?>
    
    
    <div class="row">
        <div class="col-md-12">
            <div class="block-web">
                <div class="header">
                    <div class="actions"> 
                        <a href="#" class="minimize"><i class="fa fa-chevron-down"></i></a> 
<!--                        <a href="#" class="refresh"><i class="fa fa-repeat"></i></a> 
                        <a href="#" class="close-down"><i class="fa fa-times"></i></a> -->
                    </div>
                    <h3 class="content-header">Page Details</h3>
                </div>
                
                <div class="porlets-content">
                    <div class="form-horizontal row-border" ><!--form start-->
                            <input type="hidden" id="fileList" name="fileList" value="<?php if($isEdit) echo $details->home_image;?>" />
                            
<!--                            <div class="form-group">
                                <label class="col-sm-2 control-label"><strong>Page Segment Type</strong></label>
                                <div class="col-sm-2">
                                <select id="source" class="form-control" name="pc_id">
                                    <1?php
                                        $this->db->order_by('order','ASC');
                                        $query = $this->db->get('tbl_static_pages_category');
                                        //printquery();
                                        foreach($query->result() as $q):
                                    ?>
                                    <option value="<1?php echo $q->id?>" <1?php if($this->input->get('pc_id') == $q->pc_name) echo $selected;?>><1?php echo ucwords($q->pc_name);?></option>
                                    <1?php endforeach;?>
                                </select>
                                </div>/col-sm-2 
                            </div>/form-group -->
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><strong>Page Title</strong></label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="page_title" id="page_title" value="<?php if(@$isEdit) echo $details->page_title;?>"/>
                                </div>
                            </div><!--/form-group-->
                            
                            <div class="form-group" >
                                <label class="col-sm-2 control-label">Page Slug</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="page_slug" id="permalink" value="<?php if(@$isEdit) echo $details->page_slug;?>" readonly/>
                                </div>
                            </div><!--/form-group-->
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><strong>HTML Keyword</strong></label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="html_keyword" id="html_keyword" value="<?php if(@$isEdit) echo $details->html_keyword;?>"/>
                                </div>
                                <span style="color: #ff0000;">Keywords that help the page to be found in search engines.</span>
                            </div><!--/form-group-->
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><strong>HTML Description</strong></label>
                                <div class="col-sm-4">
                                    <textarea name="html_describe" class="form-control" ><?php if($isEdit) echo $details->html_describe;?></textarea>
                                </div>
                                <span style="color: #ff0000;">A short Description that help the page to be found in search engines.</span>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2"><strong>Page Content</strong></label>
                                <div class="col-sm-10">
                                <textarea class="form-control ckeditor" name="content" id="content" rows="6"><?php if(@$isEdit){echo $details->content;}?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><strong>Order</strong>(only integers)</label>
                                <div class="col-sm-4">
                                <input type="text" class="form-control" name="order" id="page_title" value="<?php if(@$isEdit) echo $details->order;?>"/>
                                </div>
                                <span style="color: #ff0000;">Arrange the order of page.</span>
                            </div><!--/form-group-->
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><strong>Status</strong></label>
                                <div class="col-sm-2">
                                    <select id="source" class="form-control" name="status">
                                        <option value="Publish" <?php if(($isEdit) && ($details->status=='Publish')) echo "selected";?>> Publish </option>
                                        <option value="Unpublish" <?php if(($isEdit) && ($details->status=='Unpublish')) echo "selected";?>> Unpublish </option>
                                    </select>
                                </div><!--/col-sm-1--> 
                                <span style="color: #ff0000;">Choose option to publish or unpublish the page.</span>
                            </div><!--/form-group--> 
                            
                            <div class="form-group">
                                <label class="col-sm-2 control-label"><strong>Banner Image</strong></label>
                                <div class="col-sm-4">
                                <input type="file" name="home_image" id="home_image" /><!--class="form-control"-->
                                <div class="imagethumbs-form">
                            <?php 
                                    if($isEdit){
                                            $imgname = $details->home_image;
                                            $img = explode(':',$imgname);
                                            //dumparray($img);
                                            if(!empty($imgname)){
                                    echo '';
                                                    foreach($img as $i):
                            ?>
                                <div class="imagethumb-form additional-file-input" id="add-image1">
                                            <a class="close-msg" title="Delete" id="deleteImg">
                                            Delete
                                        </a>
                                        <a href="#" title="<?php echo $i;?>" class="img-wrap">
                                            <img src="<?php echo base_url();?>assets/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/important_links/<?php echo $i;?>&w=150&h=150" />
                                        </a>  
                                </div>
                            <?php endforeach;} }?>
                            </div>
                                </div>
                                <span style="color: #ff0000;">Choose an image to display as page banner (Only one).</span>
                                
                            </div>

                            &nbsp;&nbsp;
                            <div class="form-group">
                                <label class="col-sm-2 col-sm-2"></label>
                                <div class="col-sm-10">
                                <input type="submit" name="submitDetail" value="<?php if(@$isEdit){echo 'Edit Page';}else{echo 'Add Page';}?>" class="btn btn-primary"/>
                                </div>
                            </div>
                            
                               
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo form_close();?> 
</div>