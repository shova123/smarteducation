<!--<script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/jquery-latest.js"></script>-->
<script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/jquery.stringToSlug.js"></script>
<script>
    $(document).ready(function () {
        $("#category_title").stringToSlug();
    });
</script>
<script src="<?php echo base_url();?>gears/admin/uploadifive/jquery.uploadifive-v1.0.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/admin/uploadifive/uploadifive.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>gears/admin/css/dim.css">
<!--STyles for inline select form-->
<style type="text/css">
    .inlineselect{
        border: none;
        line-height: inherit;
        font-size:inherit;
        display: inline-block;
        padding: 10px 10px 2px;
        background-color: #e3e3e3;
        margin-right:10px;
        color: #b14943;
        cursor: pointer;
        border-bottom: 1px dashed #b14943;
    }
    .inlineselect option{
        padding: 5px;
        background:#e3e3e3;
        border: 0px;
    }
    .parsley-error-list{
        list-style: none;
        color: #cc0000;
    }


    .uploadifive-button {
        float: left;
        margin-right: 10px;
    }
    #queue {
        border: 1px solid #E5E5E5;
        height: 177px;
        overflow: auto;
        margin-bottom: 10px;
        padding: 0 3px 3px;
        width: 300px;
    }
</style>


<script type="text/javascript">
<?php $timestamp = time();?>
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
                'timestamp': '<?php echo $timestamp;?>',
                'targetFolder': '/uploads/category/',
                'token': '<?php echo @md5('unique_salt' . $timestamp);?>'
            },
            'method': 'post', // The method to use when submitting the upload
            'multi': true, // Set to true to allow multiple file selections
            'queueID': 'queueImage', // The ID of the file queue
            'queueSizeLimit': 1, // The maximum number of files that can be in the queue
            'removeCompleted': false, // Set to true to remove files that have completed uploading
            'simUploadLimit': 0, // The maximum number of files to upload at once
            'truncateLength': 0, // The length to truncate the file names to
            'uploadLimit': 1, // The maximum number of files you can upload
            'uploadScript': '<?php echo base_url();?>gears/admin/uploadifive/uploadifive.php',
            'onUploadComplete': function (file, data, response) {
                //console.log(data);
                //alert(data);
                imagePath = "<?php echo str_replace("\\","/",ROOT);?>";
                $('.imagethumbs-form').prepend('<div class="imagethumb-form additional-file-input" id="add-image1" > <a class="close-msg" title="Delete" id="deleteImg">Delete</a> <a href="#" title="'+data+'" class="img-wrap"><img src="'+"<?php echo base_url();?>"+'gears/admin/createThumb/create_thumb.php?src='+imagePath+'uploads/category/'+data+'&w=150&h=150" alt="'+data+'" /></a></div>');
                if ($('#fileList').val() != '') {//alert('full');
                    $('#fileList').val($('#fileList').val() + ':' + data);
                } else {//alert('blank');
                    $('#fileList').val(data);
                }
//                                        $('#submitDetails').val('Submit');
            }
        });
    });
</script>
<script>
//THIS FUNCTION IS TRIGGERED WHILE UPLOADED IMAGE, IS REQUIRED TO DELETE:
    $(document).on('click', 'a#deleteImg', function () {
        var _img = $(this).next().attr("title");//alert(_img);
        var _this = $(this).parent();
        delete_image(_img);
        $.post("<?php echo admin_url("category/delete_category_image");?>", {imgName: _img},
        function (data) {
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
    function delete_image(name) {
        var filelist = $('#fileList').val();
        var filenames = filelist.split(':'); //alert(filenames.length);
        $('#fileList').val('');
        for (var i = 0; i < filenames.length; i++)
        {
            if (filenames[i] != name)
            {
                if ($('#fileList').val() == '')
                    $('#fileList').val(filenames[i]);
                else
                    $('#fileList').val($('#fileList').val() + ':' + filenames[i]);
            }
        }
    }
</script>

<?php $isEdit = isset($details) ? true : false; ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-color box-bordered">
                <div class="box-title">
                    <h3>
                        <i class="fa fa-edit"></i><?php echo $page_title;?></h3>
                </div>
                <div class="box-content nopadding">
                    <form action="" method="POST" class="form-horizontal form-bordered form-validate" enctype='multipart/form-data' >
                        <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="token" />
<!--<input type="hidden" id="fileList" name="fileList" value="<?php if($isEdit) echo $details->home_image;?>" />-->
                            
                        
<!--                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Sub Menu Type</label>
                            <div class="col-sm-4">
                                <select name="category_type" id="select" class='chosen-select form-control'>
                                    <option value="" <?php if (($isEdit) && ($details->category_type == '')) echo "selected"; ?>> Select Menu Type</option>
                                    <option value="package" <?php if (($isEdit) && ($details->category_type == 'package')) echo "selected"; ?>> Package ( single page ) </option>
                                    <option value="region" <?php if (($isEdit) && ($details->category_type == 'region')) echo "selected"; ?>> Region ( Double Page ) </option>
                                </select>
                                <span class="help-block">Choose option to publish or unpublish the page.</span>
                            </div>
                        </div>-->
                            
                        
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">Category Title</label>
                                <div class="col-sm-10">
                                        <input type="text" name="category_title" id="category_title" value="<?php if (@$isEdit) echo $details->category_title; ?>" class="form-control">
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">Category Slug</label>
                                <div class="col-sm-10">
                                    <input type="text" name="category_slug" id="permalink" value="<?php if (@$isEdit) echo $details->category_slug; ?>" class="form-control slug" readonly>
                                    <span class="help-block">This is page slug recognization</span>
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Category Type</label>
                            <div class="col-sm-4">
                                <select name="category_type" id="category_type" class='chosen-select form-control'>
                                    <option value="" <?php if (($isEdit) && ($details->category_type == '')) echo "selected"; ?>> Category Type</option>
                                    <option value="none" <?php if (($isEdit) && ($details->category_type == 'none')){echo "selected";}?>> Category Only </option>
                                    <option value="sub_category" <?php if (($isEdit) && ($details->category_type == 'sub_category')){echo "selected";}?>> Sub Category </option>
                                </select>
                                <span class="help-block">Choose option to publish or unpublish the page.</span>
                            </div>
                        </div>
                            
<!--                        <div class="form-group">
                            <label class="col-sm-2 control-label">Display Type</label>
                            <div class="col-sm-10">
                                <?php  if(!empty($isEdit)){$checkboxd = explode("||",$details->display_type);}?>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="default" id="inlinecheckbox1" class='icheck-me' data-skin="square" data-color="red" name="display_type[]" <?php if(@$isEdit){ foreach($checkboxd as $chkd){ if($chkd =='default'){?> checked<?php }}}else{echo "checked";}?>>
                                    <span class="custom-checkbox"></span> Default 
                                </label>
                                <label class="checkbox-inline">
                                    <input type="checkbox" value="popular" id="inlinecheckbox1" class='icheck-me' data-skin="square" data-color="red" name="display_type[]" <?php if(@$isEdit){ foreach($checkboxd as $chkd1){ if($chkd1 =='popular'){?> checked<?php }}}?>>
                                    <span class="custom-checkbox"></span> Popular 
                                </label>
                            </div>
                        </div>-->
<!--                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">HTML Title</label>
                                <div class="col-sm-10">
                                        <input type="text" name="html_title" id="html_title" value="<?php if (@$isEdit) echo $details->html_title; ?>" class="form-control">
                                        <span class="help-block">This is HTML title for SEO</span>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">Html Keywords</label>
                                <div class="col-sm-10">
                                        <input type="text" name="html_keyword" value="<?php if (@$isEdit) echo $details->html_keyword; ?>" id="textfield" class="form-control">
                                        <span class="help-block">This is page slug recognization</span>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">Html Description</label>
                                <div class="col-sm-10">
                                        <textarea name="html_describe" id="textarea" class="form-control"><?php if (@$isEdit) echo $details->html_describe; ?></textarea>
                                        <span class="help-block">This is page slug recognization</span>
                                </div>
                        </div>-->
                        <div class="form-group">
                                <label for="textfield" class="control-label col-sm-2">Category Description</label>
                                <div class="col-sm-10">
                                        <textarea name="category_description" id="category_description" class="form-control ckeditor"><?php if (@$isEdit) echo $details->category_description; ?></textarea>
                                        <span class="help-block">This is page slug recognization</span>
                                </div>
                        </div>
                        <div class="form-group">
                                <label for="numberfield" class="control-label col-sm-2">Order</label>
                                <div class="col-sm-2">
                                        <input type="text" placeholder="Only numbers" name="order" value="<?php if (@$isEdit) echo $details->order; ?>" id="numberfield" data-rule-number="true" class="form-control">
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Status</label>
                            <div class="col-sm-2">
                                <select name="status" id="select" class='chosen-select form-control'>
                                   <option value="Publish" <?php if (($isEdit) && ($details->status == 'Publish')){echo "selected";}?>> Publish </option>
                                    <option value="Unpublish" <?php if (($isEdit) && ($details->status == 'Unpublish')){echo "selected";}?>> Unpublish </option>
                                </select>
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Image</label>
                            <div class="col-sm-10">
                                <span class="help-block">Image extension ( .jpg, .jpeg,.gif,.png)</span>
                                <div id="queueImage"></div>
                                <input id="home_image" name="home_image" type="file" multiple="true">
                                <div class="imagethumbs-form">
                                    <?php
                                    if ($isEdit) {
                                        $imgname = $details->home_image;
                                        $img = explode(':', $imgname);
                                        if (!empty($imgname)) {
                                            echo '';
                                            foreach ($img as $i) {
                                                ?>
                                                <div class="imagethumb-form additional-file-input" id="add-image1">
                                                    <a class="close-msg" title="Delete" id="deleteImg">Delete</a>
                                                    <a href="#" title="<?php echo $i;?>" class="img-wrap">
                                                        <img src="<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/category/<?php echo $i;?>&w=150&h=150" />
                                                    </a>  
                                                </div>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                            
                        </div>-->

                        
                        <div class="form-actions">
                            <input type="submit" name="submitDetail" class="btn btn-primary" value="SUBMIT">
                            <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                             <button type="button" onclick="history.go(-1);" class="btn btn-danger">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>