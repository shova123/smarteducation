<?php
$isEdit = isset($template_details) ? true : false; 
require('html_form.class.php');
$active[$current] = "style='color:#b43f27;'";
if(!empty($isEdit)){
    $login_userID = $template_details->user_id;
    //$login_userTYPE = $this->session->userdata('users_user_type');
    //$login_userNAME = $this->session->userdata('users_name');

    if (!empty($login_userID)) {
        $this->db->select("*");
        $this->db->where("user_id", $login_userID);
        $queryUsers = $this->db->get("tbl_users");
        $resultUsers = $queryUsers->row();
        $userTOKEN = $resultUsers->user_token;
        $userFNAME = $resultUsers->first_name;
        $userLNAME = $resultUsers->last_name;
        $login_userFULLNAME = "$userFNAME $userLNAME";
        $login_userEMAIL = $resultUsers->email;
    }
}
?>
<!--<script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/jquery.stringToSlug.js"></script>


<script>
    $(document).ready(function () {
        $("#job_title").stringToSlug();
    });
</script>-->

<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>gears/admin/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>gears/admin/tinymce/jscripts/general.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("body").on("change","#template_path",function() {
            var name = $('#template_path').val();
            var path="./resources/email_templates/" + name +"/index.php";
           
            $.get("<?php echo base_url(); ?>teachers/ajax",{val : path},function(d){
                $("div#htmlEditor span").remove();
                $("textarea.myDevEditControl").show().val(d);
                
                tinyMCE.init({
                    // General options
                    mode : "specific_textareas",
                    editor_selector : "myDevEditControl",
                    theme : "advanced",
                    elements : "ajaxfilemanager",
                    plugins : "advimage,advlink,media,contextmenu,table,template,xhtmlxtras",
                    theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
                    theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
                    theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
                    theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
                    theme_advanced_toolbar_location : "top",
                    theme_advanced_toolbar_align : "left",
                    theme_advanced_statusbar_location : "bottom",
                    theme_advanced_toolbar_align : "left",
                    extended_valid_elements : "hr[class|width|size|noshade]",
                    file_browser_callback : "ajaxfilemanager",
                    paste_use_dialog : false,
                    theme_advanced_resizing : true,
                    theme_advanced_resize_horizontal : true,
                    apply_source_formatting : true,
                    force_br_newlines : true,
                    force_p_newlines : false,	
                    relative_urls : false,
                    convert_urls:false,
                    //                        remove_script_host : false,
                    //                        document_base_url : "http://websamplenow.com/80/email_mark/gears/admin/js/ajax_uploaded/",
                    // Example word content CSS (should be your site CSS) this one removes >paragraph margins
                    content_css : "../../../tinymce_obj/css/word.css",
                    // Drop lists for link/image/media/template dialogs
                    template_external_list_url : "../../../tinymce_obj/lists/template_list.js",
                    external_link_list_url : "../../../tinymce_obj/lists/link_list.js",
                    external_image_list_url : "../../../tinymce_obj/lists/image_list.js",
                    media_external_list_url : "../../../tinymce_obj/lists/media_list.js"
                });

                function ajaxfilemanager(field_name, url, type, win) {
                    alert(url);
                    var ajaxfilemanagerurl = "../../../../jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
                    switch (type) {
                        case "image":
                            break;
                        case "media":
                            break;
                        case "flash": 
                            break;
                        case "file":
                            break;
                        default:
                            return false;
                    }
                    tinyMCE.activeEditor.windowManager.open({
                        url: "../../../../jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
                        width: 782,
                        height: 440,
                        inline : "yes",
                        close_previous : "no"
                    },{
                        window : win,
                        input : field_name
                    });
                } 

            });
        });
    });
</script>





<!--<script type="text/javascript">
    $(document).ready(function(){
        $("body").on("change","#template_path",function() {
            var name = $('#template_path').val();
            var path="./resources/email_templates/" + name +"/index.php";
           
            $.get("<1?php echo base_url(); ?>email/emails/ajax",{val : path},function(d){
                $("div#htmlEditor span").remove();
                $("textarea.myDevEditControl").show().val(d);
            })
            });
            });
            </script>-->


<!--<script type="text/javascript" src="<1?php echo base_url(); ?>gears/admin/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>-->
<script type="text/javascript">
    tinyMCE.init({
        // General options
        mode : "specific_textareas",
       
        editor_selector : "myDevEditControl",
        theme : "advanced",
        elements : "ajaxfilemanager",
        plugins : "advimage,advlink,media,contextmenu,table,template,xhtmlxtras",
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_toolbar_align : "left",
        extended_valid_elements : "hr[class|width|size|noshade]",
        file_browser_callback : "ajaxfilemanager",
        paste_use_dialog : false,
        theme_advanced_resizing : true,
        theme_advanced_resize_horizontal : true,
        apply_source_formatting : true,
        force_br_newlines : true,
        force_p_newlines : false,	
        relative_urls : false,
        convert_urls:false,
        //                        remove_script_host : false,
        //                        document_base_url : "http://websamplenow.com/80/email_mark/gears/admin/js/ajax_uploaded/",
        // Example word content CSS (should be your site CSS) this one removes >paragraph margins
        content_css : "../../../tinymce_obj/css/word.css",
        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "../../../tinymce_obj/lists/template_list.js",
        external_link_list_url : "../../../tinymce_obj/lists/link_list.js",
        external_image_list_url : "../../../tinymce_obj/lists/image_list.js",
        media_external_list_url : "../../../tinymce_obj/lists/media_list.js"

    });

    function ajaxfilemanager(field_name, url, type, win) {
        var ajaxfilemanagerurl = "../../../../jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php";
        switch (type) {
            case "image":
                break;
            case "media":
                break;
            case "flash": 
                break;
            case "file":
                break;
            default:
                return false;
        }
        tinyMCE.activeEditor.windowManager.open({
            url: "../../../../jscripts/tiny_mce/plugins/ajaxfilemanager/ajaxfilemanager.php",
            width: 782,
            height: 440,
            inline : "yes",
            close_previous : "no"
        },{
            window : win,
            input : field_name
        });
    }
  
    
</script>


<script>
    $(document).ready(function(){
        $('.myselectbox').change(function(){
            listval = $(this).val();
            incr = $(this).attr('id');
            if(listval == 'Text Entry' || listval == 'Image' || listval == 'Video'){
                $('#myrow'+incr).hide();
                $('#myselect'+incr).hide();
            }else
            {
                $('#myrow'+incr).show();
            }
        });
        // class="selectoption"
        $('.myselectbox').change(function(){
            incr = $(this).attr('id');
            $('#option'+incr).change(function(){
                list = $(this).val();
                ids = $(this).attr('id');
                if(list)
                {
                    $('#myselect'+incr).show(); 
                    var count=list;
                    max=50;
                    for(i=1 ; i<=max; i++) {
                        if(i <= count) {
                            disp = "";
                        } 
                        else{
                            disp = "none";
                        }
                        document.getElementById("label_"+incr+"_"+i).style.display = disp;//label_1_1
                        document.getElementById("opt_"+incr+"_"+i).style.display = disp;//opt_1_1
                    }             
                }
            });
        });
        // class="selectoption"
        $('.selectoption').change(function(){
            var string = $(this).attr('id');
            var length = string.length
            var trimmedString = string.substring(6, length);
            incr = trimmedString;
                
            $('#option'+incr).change(function(){
                list = $(this).val();
                ids = $(this).attr('id');
                if(list)
                {
                    $('#myselect'+incr).show(); 
                    var count=list;
                    max=50;
                    for(i=1 ; i<=max; i++) {
                        if(i <= count) {
                            disp = "";
                        } 
                        else{
                            disp = "none";
                        }
                        document.getElementById("label_"+incr+"_"+i).style.display = disp;//label_1_1
                        document.getElementById("opt_"+incr+"_"+i).style.display = disp;//opt_1_1
                    }             
                }
            });
        });
    
    
        /////////////////////  additoinal divisions start
        $('.addFeatures').click(function(){
            incr = $(this).attr('id');
            var addClickId= ++incr;
            //alert(addClickId);
            for(j=1 ; j<=addClickId; j++) {
                document.getElementById("featureHolder"+j).style.display = "";//label_1_1
                if(j == addClickId){
                    document.getElementById("addMore"+j).style.display = "";//label_1_1
                }else{
                    document.getElementById("addMore"+j).style.display = "none";//label_1_1
                }
            }
        });
        /////////////////////  additoinal divisions end
    });
</script>
<script>
    function setOptions(chosen) {
        var selbox = document.addEditform.sub_cat_id;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select--',' ');
        }
        <?php
        if (!empty($sub_category_list)) {
            foreach ($sub_category_list as $allSubCat) {
                $subCatID= $allSubCat->sub_cat_id;
                $catID= $allSubCat->category_id;
                $subCatTITLE= $allSubCat->subcategory_title;
                $subCatSLUG = $allSubCat->subcategory_slug;
        ?>
                                                                                
        if (chosen == "<?php echo $catID?>") {
            selbox.options[selbox.options.length] = new Option('<?php echo $subCatTITLE; ?>','<?php echo $subCatID; ?>');
        }
        <?php
    }
}
?>
        
    }
</script>
<style>
.map_canvas { 
  width: 100%; 
  height: 400px; 
  margin: 10px 20px 10px 0;
}
</style>

<!--<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places"></script>
<script src="<1?php echo base_url();?>gears/admin/js/jquery.geocomplete.js"></script> -->
<!--<script>
    $(function(){
        $("#geocomplete").geocomplete({
            map: ".map_canvas",
            details: "form"
        });
        
        $("#find").click(function(){
            $("#geocomplete").trigger("geocode");
        });
    });
    $(document).ready(function() {
        $("#geocomplete").trigger("geocode");
    });
</script>-->
<?php
@session_start();
if($this->session->flashdata('success_message') || ($this->session->flashdata('message')) || @$message) 
{
        $display = 'in';
        $formClass = 'error';
        $formOuter = 'outererror';
        $formHead ='error';
        $alertclass = 'success';
        $color = '#fff';
        if($this->session->flashdata('success_message')){
            $message = $this->session->flashdata('success_message');
        }else if($this->session->flashdata('message')){
            $message = $this->session->flashdata('message');
        }else if($message){
            $message = $message;
        }
        
}elseif(($this->session->flashdata('error_message')) || (@$error_message)) 
{
        $display = 'in';
        $formClass = 'error';
        $formOuter = 'outererror';
        $formHead ='error';
        $alertclass = 'danger';
        $color = '#fff';
        if($this->session->flashdata('error_message')){
            $message = $this->session->flashdata('error_message');
        }else{
            $message = @$error_message;
        }
        
}else
{
        $display = '';
        $formClass = '';
        $formOuter = 'outer';
        $formHead ='head';
        $alertclass = 'danger';
        $color = '#000';
        $message = $this->session->flashdata('error_message');
}
?>

<?php $isEdit = isset($template_details) ? true : false;?>
<div class="container-fluid">
    <div class="page-header">
        <div class="pull-right">
            <div class="btn-group">
               <?php echo $page_title . ' of ' . $link; ?>
<!--                <a class="btn btn-primary" href="<1?php echo base_url('signin/create_user') ?>"><1?php echo lang('index_create_user_link');?> <i class="fa fa-plus"></i></a>-->
            </div>
        </div>
    </div>
    
        <style>.messages{margin-left:50%;}</style>
        <div class="message" id="message" style="display:<?php echo $display ?>">
            <div class="messages">
                <div class="icon-messages icon-success"></div>
                <div id="displayMsg"><div id="infoMessage"><?php echo $message;?></div></div>
                <a href="#" onclick="javascript:getElementById('message').style.display = 'none'" class="close-msg" title="close">Close</a>
            </div>               
        </div>
    <div class="row">
        <div class="col-sm-12">
            <?php //if(@$isEdit){$userTokens = $template_details->user_token;}?>
            <?php //if(@$isEdit){uri_string();}else{echo base_url("signin/create_user");} ?>
            <form action="" method="post" name="addEditform" id="addEditform" class="form-horizontal form-bordered form-validate" enctype='multipart/form-data' accept-charset="utf-8">
                <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="token" />
                                
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3><i class="fa fa-edit"></i>Template Information</h3>
                    </div>


                    <div class="box-content nopadding">
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Category</label>
                            <div class="col-sm-6">
                                <!--<select class="form-control" name="package_activity" onchange="setOptions(document.addEditform.package_activity.options[ document.addEditform.package_activity.selectedIndex].value);">-->
                                <select name="category_id" id="category_id" onchange="setOptions(document.addEditform.category_id.options[ document.addEditform.category_id.selectedIndex].value);" id="select" class=' form-control'>
                                    <option value="">--select category--</option>
                                    <?php 
                                        if(!empty($category_list)){
                                            foreach($category_list as $listCateogry){
                                                $categoryID = $listCateogry->category_id;
                                                $categoryTITLE = $listCateogry->category_title;
                                    ?>
                                    <option value="<?php echo $categoryID;?>" <?php if (($isEdit) && ($template_details->category_id == $categoryID)){echo "selected";}?>> <?php echo ucfirst($categoryTITLE);?> </option>
                                    <?php }}?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Sub Category</label>
                            <div class="col-sm-6">
<!--                            <select class="form-control" name="package_name" > name is used as value obtainer for select changes
                                    <option value="" selected="selected">---Select---</option> option place for javascript to be printed
                                </select>-->
                                
                                <select name="sub_cat_id" id="sub_cat_id" class='form-control'>
                                   <option value="" selected="selected">---Select Sub Category---</option>
                                    <?php
                                    if($isEdit){
                                    if (!empty($sub_category_list)) {
                                        foreach ($sub_category_list as $subCatList) {
                                            $subCatID= $subCatList->sub_cat_id;
                                            $subCatTITLE= $subCatList->subcategory_title;
                                            $subCatSLUG = $subCatList->subcategory_slug;
                                    ?>
                                   <option value="<?php echo $subCatID;?>" <?php if (($isEdit) && ($template_details->sub_cat_id == $subCatID)){echo "selected";}?>><?php echo $subCatTITLE;?></option>
                                    <?php }}}?>
                                </select>
                            </div>
                        </div>
                        
                        <?php
                            if ($isEdit) {
                                $teacherID = $template_details->user_id;
                            }
//                            $this->db->select("*");
//                            $this->db->where("active", "1");
//                            $queryUsers = $this->db->get("tbl_users");
//                            $resultUsers = $queryUsers->result();
                            //$countOptionsArr = $queryOptionsArr->num_rows();
                            if (!empty($users)) {
                        ?>
                        
                       <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Users</label>
                            <div class="col-sm-6">
                                <select name="user_id" id="select" class=' form-control' data-rel="chosen" required>
                                    <option value="" selected="selected">--select users---</option>
                                    <?php
                                        foreach ($users as $usersDetail) {
                                            $userIDs = $usersDetail->user_id;
                                            $userNAME = $usersDetail->username;
                                            $userFNAME = $usersDetail->first_name;
                                            $userLNAME = $usersDetail->last_name;
                                            $userFULLName = "$userFNAME $userLNAME";
                                            $userTOKEN = $usersDetail->user_token;
                                    ?>
                                        <option value="<?php echo $userIDs;?>" <?php if (($isEdit) && ($template_details->user_id == $userIDs)) echo "selected"; ?>> <?php echo $userFULLName; ?> </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                         <?php } ?>
                        
                        
                        
                        <div class="form-group">
                            
                            <label for="first_name" class="control-label col-sm-2">Template Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="template_title" value="<?php if (@$isEdit) echo $template_details->template_title; ?>"/>
                                <!--<span class="help-block">This is just a Job Filed Type</span>-->
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="information" class="control-label col-sm-2">Template Description</label>
                            <div class="col-sm-10">
                                <textarea name="template_description" id="template_description" class="form-control ckeditor"><?php
                                    if (@$isEdit) {
                                        echo $template_details->template_description;
                                    }
                                    ?></textarea>
                                <span class="help-block">This is page slug recognization</span>
                            </div>
                        </div>

                        <div class="form-actions">
                            <input type="submit" name="submitTemplate" class="btn btn-primary submit-btn pull-right" value="Submit Template">
                            <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                            <button type="button" class="btn">Cancel</button>
                        </div>
                        
                    </div>
                    

                </div>
               
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $('[data-rel="chosen"],[rel="chosen"]').chosen();
    });
</script>