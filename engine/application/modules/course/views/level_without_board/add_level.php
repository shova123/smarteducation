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
                                                                                
        if (chosen == "subcontent" || chosen == "subcontentvideo" || chosen == "subcontentpricing") {
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
                        
                
                        <span class="section">Please Complete the information below</span>

                                                
                         <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Level Type<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="level_type"  id="page_type" class='select2_single form-control' tab-index="-1" data-rule-required="true">
                                    <option value="" selected="selected">---Select Type---</option>
                                   <option value="academic" <?php if (($isEdit) && ($details->level_type == 'academic')){echo "selected";}?>> Academic </option>
                                    <option value="general" <?php if (($isEdit) && ($details->level_type == 'general')){echo "selected";}?>> General</option>
                                     </select>
                            </div>
                        </div>
                        
                        
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Level Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="level_name" id="page_title" value="<?php if (@$isEdit) {echo $details->level_name;}?>" class="slug_name form-control col-md-7 col-xs-12" placeholder="Level Name" data-rule-required="true" data-rule-minlength="2">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Level Slug<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="level_slug" id="page_slug" value="<?php if (@$isEdit) {echo $details->level_slug;}?>" class="form-control col-md-7 col-xs-12" readonly>
                            </div>
                        </div>
                                              
                                                                        
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Order</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" placeholder="Only numbers" name="order" value="<?php if (@$isEdit) echo $details->order; ?>" id="numberfield" data-rule-number="true" class="form-control" data-rule-required="true">
                                </div>
                        </div>
                        
                                             

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="status" id="select" class='select2_single form-control' tabindex="-1" >
                                    <option value="1" <?php if (($isEdit) && ($details->status == '1')){echo "selected";}?>> Active </option>
                                    <option value="0" <?php if (($isEdit) && ($details->status == '0')){echo "selected";}?>> InActive </option>
                                </select>
                            </div>
                        </div>
                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <input type="submit" name="submit" class="btn btn-success" value="Save">
                                <button type="button" onclick="history.go(-1);" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>