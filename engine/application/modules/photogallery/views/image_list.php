<script src="<?php echo base_url()?>assets/uploadify/jquery.uploadify.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/uploadify/swfobject.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>assets/uploadify/uploadify.css">
<script>
<?php $timestamp = time();?>
$(function(){
	$('#home_image').uploadify({
		formData     	: {
					'timestamp' : '<?php echo $timestamp;?>',
					'targetFolder' : 'lifepartner/uploads/gallery',
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
					alert(result);
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
<?php if($this->session->flashdata('display_message')!="")
	$display = '';
else 
	$display = 'none'?>
  <div class="titlebar" align="center" >
        <h1 align="left"><?=$parentName?> - images
         <span>View, edit or delete existing Images and
            <a href="<?php echo base_url('admin/photogallery/addimage/'.$gid)?>" class="btn create-add" id="CreateNew">Add new  Images</a>  	 as well.
            </span>
        </h1>
        <div class="message" id="message" style="display:<?php echo $display?>">
            <div class="messages">
                <div class="icon-messages icon-success"></div>
                <div id="displayMsg"><?php echo @$this->session->flashdata('display_message')?></div>
                <a href="#" onclick="javascript:getElementById('message').style.display='none'" class="close-msg" title="close">Close</a>
            </div>               
        </div>
  </div>
  <div style="clear:both;height:1px"></div>
  <div class="table-wrapper form-wrapper" style="clear:left;">	
  <div >
  	<form name="frmSetting" id="frmSetting">
    
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
      <thead>
        <tr>
          <th style="text-align:left;" width="3%">Sn.</th>                
          <th width="34%">Image Preview</th>
          <th width="23%">Order</th>
          <th width="16%">Status</th>
          <th width="24%" style="text-align:center">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php 
		if(!empty($details)){				
			$count = 1;
			foreach($details as $row):				
		?>
			<tr class="<?php echo ($count%2==0)?'even':'odd'?>">
			  <td style="text-align:left;"><?php echo $count?></td>            	
				<td><a href="#" title="<?php echo $row->imgname;?>" class="img-wrap"><img src="<?php echo base_url()?>uploads/gallery/<?php echo $row->imgname;?>" width="150" height="110" alt="<?php echo $row->imgname;?>" /></a></td>
				<td><?php echo $row->order?></td>
				<td class="publish_status"><a href="javascript:void();" id="<?php echo $row->id?>"><?=$row->status?></a></td>
				<td>
                	<span class="table-icons">
                    	<a href="<?php echo base_url()?>admin/photogallery/edit/<?php echo $row->id?>" class="edit editRow icons-table-actions icon-edit-table-action" title="Edit">Edit</a>&nbsp;&nbsp;<a href="<?php echo base_url()?>admin/photogallery/delete/<?php echo $row->id?>" class="deleteRow icons-table-actions icon-delete-table-action" title="Delete" onclick="return confirm('Are you sure')">Delete</a>
                        </span>
                </td>
                </tr>
    <?php
			$count++;
			endforeach;
		}
		else
		{
		?>
        <tr><td colspan="5" style="text-align:center">No Images Added.</td></tr>
        <?php	
		}
	  ?>
     </tbody>
    </table> 
     
    </form>
    </div><div style="clear:both;height:1px"></div>
    <div class="table-footer">
          		<div class="table-pagination">
		<?php echo $this->pagination->create_links(); ?>
	</div> 
    </div>
  </div>
</div>
<script>
$(function(){
	$('#message').delay(3000).fadeOut();
});
</script>