<script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/jquery.slugit.js"></script>
<!--<script>
    $(document).on('keyup', '.slug_name', function(){
        var f_name = document.getElementById("first_name").value.toLowerCase();
        var l_name = document.getElementById("last_name").value.toLowerCase();
        var text = f_name + "_" + l_name;
        $("#username").val(text);     
    });
</script>-->
<script>
    $(function () {
        $('#page_title').slugIt({
            output: '#page_slug',
            separator: '_',
        });
        $('#page_title').keyup();
    });
</script>
<script src="<?php echo base_url();?>gears/admin/uploadifive/jquery.uploadifive-v1.0.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/admin/uploadifive/uploadifive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/admin/css/dim.css">
<script type="text/javascript">
<?php $timestamp = time(); ?>
    $(function () {
        $('#home_image').uploadifive({
            'auto': true, // Automatically upload a file when it's added to the queue
            'buttonClass': false, // A class to add to the UploadiFive button
            'buttonText': 'Upload Image', // The text that appears on the UploadiFive button
            'checkScript': false, // Path to the script that checks for existing file names 
            'dnd': true, // Allow drag and drop into the queue
            'dropTarget': false, // Selector for the drop target
            'fileSizeLimit': '153600', // Maximum allowed size of files to upload
            'fileType': false, // Type of files allowed (image, etc)
            'width': 180,
            'height': 30,
            'formData': {
                'timestamp': '<?php echo $timestamp; ?>',
                'targetFolder': '/smart/uploads/news/',
                'token': '<?php echo @md5('unique_salt' . $timestamp); ?>'
            },
            'method': 'post', // The method to use when submitting the upload
            'multi': true, // Set to true to allow multiple file selections
            'queueID': 'queueImage', // The ID of the file queue
            'queueSizeLimit': 1, // The maximum number of files that can be in the queue
            'removeCompleted': false, // Set to true to remove files that have completed uploading
            'simUploadLimit': 0, // The maximum number of files to upload at once
            'truncateLength': 0, // The length to truncate the file names to
            'uploadLimit': 1, // The maximum number of files you can upload
            'uploadScript': '<?php echo base_url(); ?>gears/admin/uploadifive/uploadifive.php',
            'onUploadComplete': function (file, data, response) {
                //console.log(data);//alert(data);
                imagePath = "<?php echo str_replace("\\","/",ROOT);?>";
                $('.imagethumbs-form').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" > <a class="close-msg" title="Delete" id="deleteImg">Delete</a> <a href="#" title="'+data+'" class="img-wrap"><img src="'+"<?php echo base_url();?>"+'gears/admin/createThumb/create_thumb.php?src='+imagePath+'uploads/news/'+data+'&w=150&h=150" alt="'+data+'" /></a></div>');
                if ($('#fileList').val() != '') {//alert('full');
                    $('#fileList').val($('#fileList').val() + ':' + data);
                } else {//alert('blank');
                    $('#fileList').val(data);
                }
                //$('#submitDetails').val('Submit');
            }
        });
    });

//THIS FUNCTION IS TRIGGERED WHILE UPLOADED IMAGE, IS REQUIRED TO DELETE:
$(document).on('click', 'a#deleteImg', function () {
   		var _img = $(this).next().attr("title");//alert(_img);
		var _this = $(this).parent();
                delete_image(_img);
		$.post("<?php echo base_url("pages/delete_news_image");?>",{imgName:_img},
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
<script>
    function setOptions(chosen) {
        var selbox = document.addEditform.page_name;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = 
                new Option('--Select--',' ');

        }
        <?php
        if (!empty($all_pages)) {
            foreach ($all_pages as $allPage) {
                $page_title = $allPage->page_title;
        ?>
                                                                                
        if (chosen == "subpage" || chosen == "subcontent" || chosen == "subcontentvideo" || chosen == "subcontentpricing") {
        <?php $page_slug = $allPage->page_slug;?>
            selbox.options[selbox.options.length] = new Option('<?php echo $page_title; ?>','<?php echo $page_slug; ?>');
        }
        <?php
    }
}
?>
        
    }
</script>
<script>
$(document).ready(function(){
        $('#page_type').change(function(){
            var typeVal = $(this).val();
            if(typeVal == ''){
                //document.getElementById("label_" + incr + "_" + i).style.display = disp;//label_1_1
                $('#page_name').hide();
                $('#tutorialRow').hide();
                $('#videoiframe').hide();
                
            }else if(typeVal == 'subcontentvideo'){
                //document.getElementById("label_" + incr + "_" + i).style.display = disp;//label_1_1
                $('#tutorialRow').show();
                $('#videoiframe').show();
                
            }else
            {
                $('#videoiframe').hide();
                $('#tutorialRow').hide();
            }
            if(typeVal == 'subcontentpricing'){
                //document.getElementById("label_" + incr + "_" + i).style.display = disp;//label_1_1
                $('#pricingTable').show();
                
                
            }else
            {
                $('#pricingTable').hide();
                
            }
            
        });
        
        $('#youtube_link').keyup(function(){
            var youtube_linkVal = $(this).val();
            if(youtube_linkVal.length >0){
            $('#media_image').hide();
            //$('#videoiframe').html("");
            $('#videoiframe').html('<img src="<?php echo config_item('admin_images'); ?>ajax-loader.gif" />');
            var items=[];    
                var arr = youtube_linkVal.split('?'),i;
                for(i in arr){
                     var videoIDval = arr[1];
                }
                var idstrlength = videoIDval.length; //finding $video[1] length
                var videoID = videoIDval.substring(2, idstrlength); 
                //var ytApiKey = "AIzaSyCV_Xf4m8RN4rS554u-u9XozKTYOQOxZvM";
                //var getData ="https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" + videoID + "&key=" + ytApiKey;
                //alert(getData);
//                $.get(getData, function(data) {
//                  alert(data.items[0].snippet.title);
//                });
//                var url = 'https://www.googleapis.com/youtube/v3/videos?id='+videoID+'&key='+API_keys+'&fields=items(snippet(title))&part=snippet';
//                alert(data.items[0].snippet.title);
                //var url = "http://gdata.youtube.com/feeds/api/videos/"+videoID;
                //document.load(url);
                //var title = document.getElementsByTagName("title").items[0];
                //alert(title);

                items.push('<object width="525" height="350" data="http://www.youtube.com/v/'+videoID+'" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/'+videoID+'" /></object>');
                $('#videoiframe').append.apply($('#videoiframe'), items);
                
            }else {
                $('#media_image').show();
                $('#videoiframe').html($('<object/>').text("No Data Found"));
            }
           
        });
    });
</script>

<?php $isEdit = isset($details) ? true : false; ?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <?php echo $page_title;?>
            </h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                
                <div class="x_content">

                    <form action="" method="post" name="addEditform" id="addEditform" class="form-horizontal form-label-left form-validate" enctype='multipart/form-data' >
                        <input type="hidden" id="fileList" name="fileList" value="<?php if($isEdit) echo $details->home_image;?>" />
                        
                        
                
                        <span class="section">Please Complete the information below</span>

                                     
                       
                        

                       
                        
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">News Title<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="heading" id="page_title" value="<?php if (@$isEdit) {echo $details->heading;}?>" class="slug_name form-control col-md-7 col-xs-12" placeholder="Page Name" data-rule-required="true" data-rule-minlength="2">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">News Slug<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="slug" id="page_slug" value="<?php if (@$isEdit) {echo $details->slug;}?>" class="form-control col-md-7 col-xs-12" readonly>
                            </div>
                        </div>
                        
                       
                        
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">News Content</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <textarea name="content" id="content" class="ckeditor form-control col-md-7 col-xs-12">
                                    <?php
                                    if (@$isEdit) {
                                        echo $details->content;
                                    }
                                    ?>
                                </textarea>
                            </div>
                        </div>
                        
<!--                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Order</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" placeholder="Only numbers" name="order" value="<?php if (@$isEdit) echo $details->order; ?>" id="numberfield" data-rule-number="true" class="form-control">
                                </div>
                        </div>
                        -->
                          <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Date</label>
                            <div class='input-group date' id='datetimepicker1'>
                                <input type='text' class="form-control" name="date" value="<?php if (@$isEdit) echo $details->date; ?>"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                          </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="number">News Image <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="queueImage"></div>
                                <input id="home_image" name="home_image" type="file" multiple="true" data-rule-imagevalidation="true">
                                <div class="imagethumbs-form">
                                <?php 
                                if($isEdit){
                                        $imgname = $details->home_image;
                                        $img = explode(':',$imgname);
                                        //dumparray($img);
                                        if(!empty($imgname)){
                                            echo '';
                                            foreach($img as $i){
                                ?>
                                    <div class="imagethumb-form additional-file-input" id="add-image1">
                                        <a class="close-msg" title="Delete" id="deleteImg">Delete</a>
                                        <a href="#" title="<?php echo $i;?>" class="img-wrap">
                                            <img src="<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/news/<?php echo $i;?>&w=150&h=150" />
                                        </a>  
                                    </div>
                                <?php       
                                            }
                                        } 
                                }
                                ?>
                                </div>
                            </div>
                        </div>

                        

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="status" id="select" class='select2_single form-control' tabindex="-1" >
                                    <option value="Publish" <?php if (($isEdit) && ($details->status == 'Publish')){echo "selected";}?>> Publish </option>
                                    <option value="Unpublish" <?php if (($isEdit) && ($details->status == 'Unpublish')){echo "selected";}?>> Unpublish </option>
                                </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <input type="submit" name="submitDetail" class="btn btn-success" value="Save">
                                <button type="button" onclick="history.go(-1);" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<link href="<?php echo base_url();?>gears/front/css/bootstrap-datetimepicker.css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo base_url();?>gears/front/js/bootstrap-datetimepicker.js"></script>
<script type="text/javascript">
            $(function () {
                $('#datetimepicker1').datetimepicker();
            });
</script>