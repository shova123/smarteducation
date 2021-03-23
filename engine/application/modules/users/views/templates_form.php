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
           
            $.get("<?php echo base_url(); ?>users/ajax",{val : path},function(d){
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
//@session_start();
if($this->session->flashdata('message')) 
{

	$display = 'block';
	$formClass = 'error';
        $formOuter = 'outererror';
        $formHead ='error';
        $color = '#fff';
        $message = $this->session->flashdata('message');
}else if(!empty($message)){
        $display = 'block';
	$formClass = 'error';
        $formOuter = 'outererror';
        $formHead ='error';
        $color = '#fff';
        $message = $message;
}else
{
	$display = 'none';
	$formClass = '';
        $formOuter = 'outer';
        $formHead ='head';
        $color = '#000';
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
                            <label for="textfield" class="control-label col-sm-2">Teacher</label>
                            <div class="col-sm-6">
                                <select name="user_id" id="select" class=' form-control' data-rel="chosen" required>
                                    <option value="" selected="selected">--select teacher---</option>
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


                        
                    </div>


                </div>
                <div class="box box-color box-bordered">
                    <div class="box-title">
                        <h3><i class="fa fa-edit"></i>Choose Your Template</h3>
                    </div>
                    <div class="box-content nopadding">
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Template Design</label>
                            <div class="col-sm-6">
                                <select name="template_path" id="template_path" class="form-control" data-rel="chosen">
                                    <option value="<?php if (!empty($template)) echo $template; ?>">
                                            <?php
                                            if (!empty($template)) {
                                                echo $template;
                                            } else {
                                                echo "No Template";
                                            }
                                            ?>
                                        </option>
                                        <?php
                                        if (!empty($folder)) {
                                            foreach ($folder as $k => $v) {
                                                ?>
                                                <optgroup id="templategroup" label="<?php echo $k; ?>">
                                                    <?php
                                                    if ($v) {
                                                        foreach ($v as $value => $l) {
                                                            ?>
<!--                                                            <option value="<?php echo $k . "/" . $value; ?><?php if (!empty($template)) echo $template; ?>">
                                                                <?php echo $value; ?>
                                                                <?php if (!empty($template)) echo $k."/".$value; ?>
                                                            </option>-->
                                                    
                                                            <option value="<?php echo $k . "/" . $value; ?>" <?php if (!empty($isEdit) && ($template == "$k/$value")){?>selected<?php }?>>
                                                                <?php echo $value; ?>
                                                                
                                                            </option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </optgroup>
                                                <?php
                                            }
                                        }
                                        ?> 
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12 " id="htmlEditor">
                                <textarea name="html_content" id="html_content" class="form-control myDevEditControl" rows="50">    
                                    <?php if (!empty($isEdit)) echo $template_details->html_content; ?>
                                </textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="box box-color green box-bordered">
                    <div class="box-title">
                        <h3><i class="fa fa-edit"></i>Template Question/Answer Submission Type</h3>
                    </div>
                    <div class="box-content nopadding">
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Storage Types</label>
                            <div class="col-sm-6">
                                <select name="storage_type" id="storage_type" class=' form-control' required>
                                    <option value="database" <?php if (($isEdit) && ($template_details->storage_type == "database")) echo "selected"; ?>> Database Storage </option>
                                    <option value="email" <?php if (($isEdit) && ($template_details->storage_type == "email")) echo "selected"; ?>> Email Send</option>
                                </select>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>
                
                
                <div class="box box-color green box-bordered">
                    <div class="box-title">
                        <h3><i class="fa fa-edit"></i>Question's & Options Details</h3>
                    </div>
                    <div class="box-content nopadding">
                        <?php
                            if (!empty($template_details)) {
                                $tempID = $template_details->temp_id;
                                $userID = @$login_userID;

                                $this->db->select("*");
                                $this->db->where("temp_id", $tempID);
                                $this->db->where("user_id", $userID);
                                $queryQuestion = $this->db->get("tbl_users_temp_question");
                                $resultQuestion = $queryQuestion->result();
                                $countQuestion = $queryQuestion->num_rows();

                                if (!empty($resultQuestion)) {
                                    $Q_ID = $resultQuestion[0]->q_id;
                                    $Q_order = $resultQuestion[0]->order;
                                    $Q_title = $resultQuestion[0]->q_title;
                                    $Q_type = $resultQuestion[0]->type;
                                }
                            }
                            ?>
                            <div id="featureHolder1">
                                <div class="panel panel-default" id="addMore1" style="<?php
                            if (!empty($resultQuestion)) {
                                echo "display:none;";
                            } else {
                                echo "";
                            }
                            ?>">
                                    <div class="panel-body alert alert-success">
                                        <div class="btn btn-primary submit-btn addFeatures" id="1"><i class="glyphicon glyphicon-plus"></i> Add More <i class="glyphicon glyphicon-plus"></i></div><!--onclick="addFeatures();"-->
                                    </div>
                                </div>
                                <div class="panel panel-default" >
                                    <div class="panel-body">
                                        <br/>
                                        <div class="row listContainer" id="myListsTable">
                                            <div class="col-md-2" style="width: 15%;">
                                                <select class="form-control" name="order[]">
                                                    <option value="">Q.Order</option>    
                                                    <?php for ($or = 1; $or <= 50; $or++) { ?>
                                                        <option value="<?php echo $or; ?>" <?php
                                                    if ($or == 1) {
                                                        echo "selected";
                                                    }
                                                        ?>><?php echo $or; ?></option>
                                                            <?php } ?>
                                                </select>
                                            </div>
                                            <div class="col-md-7">
                                                <div class="input-group">
                                                    <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Que</div>
                                                    <?php if (!empty($resultQuestion)) { ?><input type="text" name="questionID[]" value="<?php
                                                    if (!empty($resultQuestion)) {
                                                        echo $Q_ID;
                                                    }
                                                        ?>" hidden><?php } ?>
                                                    <input class="form-control" type="text" name="questionField[]" value="<?php
                                                           if (!empty($resultQuestion)) {
                                                               echo $Q_title;
                                                           }
                                                    ?>" placeholder="Enter Question">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <select name="type[]" class="form-control myselectbox" id="1">
                                                    <option value="">Select Type</option>
                                                    <option value="Text Entry" <?php
                                                           if (!empty($resultQuestion)) {
                                                               if ($Q_type == "Text Entry") {
                                                                   echo "selected";
                                                               }
                                                           }
                                                    ?>>Text Entry</option>
                                                    <option value="Image" <?php
                                                           if (!empty($resultQuestion)) {
                                                               if ($Q_type == "Image") {
                                                                   echo "selected";
                                                               }
                                                           }
                                                    ?>>Image</option>
                                                    <option value="Video" <?php
                                                           if (!empty($resultQuestion)) {
                                                               if ($Q_type == "Video") {
                                                                   echo "selected";
                                                               }
                                                           }
                                                    ?>>Video</option>
                                                    <option value="Drop Down" <?php
                                                            if (!empty($resultQuestion)) {
                                                                if ($Q_type == "Drop Down") {
                                                                    echo "selected";
                                                                }
                                                            }
                                                    ?>>Drop Down</option>
                                                    <option value="Radio Buttons" <?php
                                                            if (!empty($resultQuestion)) {
                                                                if ($Q_type == "Radio Buttons") {
                                                                    echo "selected";
                                                                }
                                                            }
                                                    ?>>Radio Buttons</option>
                                                    <option value="Checkboxes" <?php
                                                            if (!empty($resultQuestion)) {
                                                                if ($Q_type == "Checkboxes") {
                                                                    echo "selected";
                                                                }
                                                            }
                                                    ?>>Checkboxes</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr/>

                                        <?php
                                        if (!empty($Q_ID)) {
                                            $this->db->select("*");
                                            $this->db->where("q_id", $Q_ID);
                                            $queryOptions = $this->db->get("tbl_users_question_option");
                                            $resultOptions = $queryOptions->result();
                                            $countOptions = $queryOptions->num_rows();
                                        }
//echo $countOptions;
                                        ?>
                                        <div style="<?php
                                        if (!empty($countOptions)) {
                                            echo "display:none;";
                                        } else {
                                            echo "display:none;";
                                        }
                                        ?>" id="myrow1" class="1">
                                            <div class="col-md-2">
                                                <label>No. of Options</label>
                                            </div>
                                            <div class="col-md-2">
                                                <select id="option1" name="ansOptions[]" value="" class="selectoption">
                                                    <option value="">Option No.</option>
                                                    <option value="1" <?php
                                             if (!empty($countOptions)) {
                                                 if ($countOptions == 1) {
                                                     echo "selected";
                                                 }
                                             }
                                        ?>>1</option>
                                                    <option value="2" <?php
                                                            if (!empty($countOptions)) {
                                                                if ($countOptions == 2) {
                                                                    echo "selected";
                                                                }
                                                            }
                                        ?>>2</option>
                                                    <option value="3" <?php
                                                            if (!empty($countOptions)) {
                                                                if ($countOptions == 3) {
                                                                    echo "selected";
                                                                }
                                                            }
                                        ?>>3</option>
                                                    <option value="4" <?php
                                                            if (!empty($countOptions)) {
                                                                if ($countOptions == 4) {
                                                                    echo "selected";
                                                                }
                                                            }
                                        ?>>4</option>
                                                    <option value="5" <?php
                                                            if (!empty($countOptions)) {
                                                                if ($countOptions == 5) {
                                                                    echo "selected";
                                                                }
                                                            }
                                        ?>>5</option>
                                                    <option value="6" <?php
                                                            if (!empty($countOptions)) {
                                                                if ($countOptions == 6) {
                                                                    echo "selected";
                                                                }
                                                            }
                                        ?>>6</option>
                                                    <option value="7" <?php
                                                            if (!empty($countOptions)) {
                                                                if ($countOptions == 7) {
                                                                    echo "selected";
                                                                }
                                                            }
                                        ?>>7</option>
                                                    <option value="8" <?php
                                                            if (!empty($countOptions)) {
                                                                if ($countOptions == 8) {
                                                                    echo "selected";
                                                                }
                                                            }
                                        ?>>8</option>
                                                    <option value="9" <?php
                                                            if (!empty($countOptions)) {
                                                                if ($countOptions == 9) {
                                                                    echo "selected";
                                                                }
                                                            }
                                        ?>>9</option>
                                                    <option value="10" <?php
                                                            if (!empty($countOptions)) {
                                                                if ($countOptions == 10) {
                                                                    echo "selected";
                                                                }
                                                            }
                                        ?>>10</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                        <div id="myselect1" style="<?php
                                                            if (!empty($countOptions)) {
                                                                echo "";
                                                            } else {
                                                                echo "display:none;";
                                                            }
                                        ?>">
                                            <div>
                                                <?php
                                                if (!empty($countOptions)) {
                                                    $maxCount = $countOptions;
                                                    //$optIncr = 0;
                                                } else {
                                                    $maxCount = 10;
                                                }

                                                for ($optCount = 1; $optCount <= $maxCount; $optCount++) {
                                                    if (!empty($resultOptions)) {
                                                        $optIncr = $optCount - 1;
                                                        $opt_ID = $resultOptions[$optIncr]->option_id;
                                                    }
                                                    ?>
                                                    <?php if (!empty($resultOptions)) { ?><input type="text" name="answerID[]" value="<?php
                                                if (!empty($resultOptions)) {
                                                    echo $opt_ID;
                                                }
                                                        ?>" hidden><?php } ?>
                                                    <label id="label_1_<?php echo $optCount; ?>" class="col-md-12 input-group">
                                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option <?php echo $optCount; ?></div>
                                                        <input class="form-control" type="text" name="option_1_<?php echo $optCount; ?>" value="<?php
                                                       if (!empty($countOptions)) {
                                                           echo $resultOptions[$optIncr]->option_title;
                                                       }
                                                    ?>" id="opt_1_<?php echo $optCount; ?>" placeholder="Enter Your Option<?php echo $optCount; ?>">
                                                    </label>
                                                    <?php
                                                    //if(!empty($optIncr)){$optIncr++;}
                                                }
                                                ?>
                                                <!--                                    <label id="label_1_1" class="col-md-12 input-group">
                                                                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 1</div>
                                                                                        <input class="form-control" type="text" name="option_1_1" value="" id="opt_1_1" placeholder="Enter Your Option">
                                                                                    </label>					
                                                                                    <label id="label_1_2" class="col-md-12 input-group">
                                                                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 2</div>
                                                                                        <input class="form-control" type="text" name="option_1_2" value="" id="opt_1_2" placeholder="Enter Your Option">
                                                                                    </label>
                                                                                    <label id="label_1_3" class="col-md-12 input-group">
                                                                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 3</div>
                                                                                        <input class="form-control" type="text" name="option_1_3" value="" id="opt_1_3" placeholder="Enter Your Option">
                                                                                    </label>
                                                                                    <label id="label_1_4" class="col-md-12 input-group">
                                                                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 4</div>
                                                                                        <input class="form-control" type="text" name="option_1_4" value="" id="opt_1_4" placeholder="Enter Your Option">
                                                                                    </label>					
                                                                                    <label id="label_1_5" class="col-md-12 input-group">
                                                                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 5</div>
                                                                                        <input class="form-control" type="text" name="option_1_5" value="" id="opt_1_5" placeholder="Enter Your Option">
                                                                                    </label>
                                                                                    <label id="label_1_6" class="col-md-12 input-group">
                                                                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 6</div>
                                                                                        <input class="form-control" type="text" name="option_1_6" value="" id="opt_1_6" placeholder="Enter Your Option">
                                                                                    </label>
                                                                                    <label id="label_1_7" class="col-md-12 input-group">
                                                                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 7</div>
                                                                                        <input class="form-control" type="text" name="option_1_7" value="" id="opt_1_7" placeholder="Enter Your Option">
                                                                                    </label>					
                                                                                    <label id="label_1_8" class="col-md-12 input-group">
                                                                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 8</div>
                                                                                        <input class="form-control" type="text" name="option_1_8" value="" id="opt_1_8" placeholder="Enter Your Option">
                                                                                    </label>
                                                                                    <label id="label_1_9" class="col-md-12 input-group">
                                                                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 9</div>
                                                                                        <input class="form-control" type="text" name="option_1_9" value="" id="opt_1_9" placeholder="Enter Your Option">
                                                                                    </label>
                                                                                    <label id="label_1_10" class="col-md-12 input-group">
                                                                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 10</div>
                                                                                        <input class="form-control" type="text" name="option_1_10" value="" id="opt_1_10" placeholder="Enter Your Option">
                                                                                    </label>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (!empty($countQuestion)) {

                                if ($countQuestion > 1) {
                                    $max = $countQuestion + 1;
                                } else {
                                    $max = 50;
                                }
                                $max = $countQuestion;
                            } else {
                                $max = 50;
                            }

                            $optQuesIncr = 1;
                            for ($i = 2; $i <= $max; $i++) {

                                if (!empty($template_details)) {
                                    $tempIDArr = $template_details->temp_id;
                                    $userIDArr = @$login_userID;

                                    $this->db->select("*");
                                    $this->db->where("temp_id", $tempIDArr);
                                    $this->db->where("user_id", $userIDArr);
                                    $queryQuestionArr = $this->db->get("tbl_users_temp_question");
                                    $resultQuestionArr = $queryQuestionArr->result();
                                    //$countQuestionArr = $queryQuestionArr->num_rows();
                                    if (!empty($resultQuestionArr)) {
                                        $Q_IDArr = $resultQuestionArr[$optQuesIncr]->q_id;
                                        $Q_orderArr = $resultQuestionArr[$optQuesIncr]->order;
                                        $Q_titleArr = $resultQuestionArr[$optQuesIncr]->q_title;
                                        $Q_typeArr = $resultQuestionArr[$optQuesIncr]->type;
                                    }
                                }
                                ?>
                                <div id="featureHolder<?php echo $i; ?>" style="<?php
                            if (!empty($resultQuestionArr)) {
                                echo "";
                            } else {
                                echo "display:none;";
                            }
                                ?>">
                                    <div class="panel panel-default" id="addMore<?php echo $i; ?>" style="<?php
                                 if (!empty($resultQuestionArr)) {
                                     echo "display:none;";
                                 } else {
                                     echo "";
                                 }
                                ?>">
                                        <div class="panel-body alert alert-success">
                                            <div class="btn btn-primary submit-btn addFeatures" id="<?php echo $i; ?>"><i class="glyphicon glyphicon-plus"></i> Add More <i class="glyphicon glyphicon-plus"></i></div><!--onclick="addFeatures();"-->
                                        </div>
                                    </div>
                                    <div class="panel panel-default" >
                                        <div class="panel-body">
                                            <br/>
                                            <div class="row listContainer" id="myListsTable">
                                                <div class="col-md-2" style="width: 15%;">
                                                    <select class="form-control" name="order[]">
                                                        <option value="">Q.Order</option>    
                                                        <?php for ($or2 = 1; $or2 <= 50; $or2++) { ?>
                                                            <option value="<?php echo $or2; ?>" <?php
                                                    if ($or2 == $i) {
                                                        echo "selected";
                                                    }
                                                            ?>><?php echo $or2; ?></option>
                                                                <?php } ?>
                                                    </select>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="input-group">
                                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Que</div>
                                                        <?php if (!empty($resultQuestionArr)) { ?><input type="text" name="questionID[]" value="<?php
                                                    if (!empty($resultQuestionArr)) {
                                                        echo $Q_IDArr;
                                                    }
                                                            ?>" hidden><?php } ?>
                                                        <input class="form-control" type="text" name="questionField[]" value="<?php
                                                           if (!empty($resultQuestionArr)) {
                                                               echo $Q_titleArr;
                                                           }
                                                        ?>" placeholder="Enter Question">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <select name="type[]" class="form-control myselectbox" id="<?php echo $i; ?>">
                                                        <option value="">Select Type</option>
                                                        <option value="Text Entry" <?php
                                                           if (!empty($resultQuestionArr)) {
                                                               if ($Q_typeArr == "Text Entry") {
                                                                   echo "selected";
                                                               }
                                                           }
                                                        ?>>Text Entry</option>
                                                        <option value="Image" <?php
                                                           if (!empty($resultQuestionArr)) {
                                                               if ($Q_typeArr == "Image") {
                                                                   echo "selected";
                                                               }
                                                           }
                                                        ?>>Image</option>
                                                        <option value="Video" <?php
                                                           if (!empty($resultQuestionArr)) {
                                                               if ($Q_typeArr == "Video") {
                                                                   echo "selected";
                                                               }
                                                           }
                                                        ?>>Video</option>
                                                        <option value="Drop Down" <?php
                                                            if (!empty($resultQuestionArr)) {
                                                                if ($Q_typeArr == "Drop Down") {
                                                                    echo "selected";
                                                                }
                                                            }
                                                        ?>>Drop Down</option>
                                                        <option value="Radio Buttons" <?php
                                                            if (!empty($resultQuestionArr)) {
                                                                if ($Q_typeArr == "Radio Buttons") {
                                                                    echo "selected";
                                                                }
                                                            }
                                                        ?>>Radio Buttons</option>
                                                        <option value="Checkboxes" <?php
                                                            if (!empty($resultQuestionArr)) {
                                                                if ($Q_typeArr == "Checkboxes") {
                                                                    echo "selected";
                                                                }
                                                            }
                                                        ?>>Checkboxes</option>


                                                    </select>
                                                </div>
                                            </div>
                                            <hr/>
                                            <?php
                                            if (!empty($Q_IDArr)) {
                                                $this->db->select("*");
                                                $this->db->where("q_id", $Q_IDArr);
                                                $queryOptionsArr = $this->db->get("tbl_users_question_option");
                                                $resultOptionsArr = $queryOptionsArr->result();
                                                $countOptionsArr = $queryOptionsArr->num_rows();
                                            }
                                            //echo $countOptions;
                                            ?>

                                            <div style="<?php
                                        if (!empty($countOptionsArr)) {
                                            echo "display:none;";
                                        } else {
                                            echo "display:none;";
                                        }
                                            ?>" id="myrow<?php echo $i; ?>" class="<?php echo $i; ?>">
                                                <div class="col-md-2">
                                                    <label>No. of Options</label>
                                                </div>
                                                <div class="col-md-2">
                                                    <select id="option<?php echo $i; ?>" value="" class="selectoption" name="ansOptions[]">
                                                        <option value="">Option No.</option>
                                                        <option value="1" <?php
                                             if (!empty($countOptionsArr)) {
                                                 if ($countOptionsArr == 1) {
                                                     echo "selected";
                                                 }
                                             }
                                            ?>>1</option>
                                                        <option value="2" <?php
                                                            if (!empty($countOptionsArr)) {
                                                                if ($countOptionsArr == 2) {
                                                                    echo "selected";
                                                                }
                                                            }
                                            ?>>2</option>
                                                        <option value="3" <?php
                                                            if (!empty($countOptionsArr)) {
                                                                if ($countOptionsArr == 3) {
                                                                    echo "selected";
                                                                }
                                                            }
                                            ?>>3</option>
                                                        <option value="4" <?php
                                                            if (!empty($countOptionsArr)) {
                                                                if ($countOptionsArr == 4) {
                                                                    echo "selected";
                                                                }
                                                            }
                                            ?>>4</option>
                                                        <option value="5" <?php
                                                            if (!empty($countOptionsArr)) {
                                                                if ($countOptionsArr == 5) {
                                                                    echo "selected";
                                                                }
                                                            }
                                            ?>>5</option>
                                                        <option value="6" <?php
                                                            if (!empty($countOptionsArr)) {
                                                                if ($countOptionsArr == 6) {
                                                                    echo "selected";
                                                                }
                                                            }
                                            ?>>6</option>
                                                        <option value="7" <?php
                                                            if (!empty($countOptionsArr)) {
                                                                if ($countOptionsArr == 7) {
                                                                    echo "selected";
                                                                }
                                                            }
                                            ?>>7</option>
                                                        <option value="8" <?php
                                                            if (!empty($countOptionsArr)) {
                                                                if ($countOptionsArr == 8) {
                                                                    echo "selected";
                                                                }
                                                            }
                                            ?>>8</option>
                                                        <option value="9" <?php
                                                            if (!empty($countOptionsArr)) {
                                                                if ($countOptionsArr == 9) {
                                                                    echo "selected";
                                                                }
                                                            }
                                            ?>>9</option>
                                                        <option value="10" <?php
                                                            if (!empty($countOptionsArr)) {
                                                                if ($countOptionsArr == 10) {
                                                                    echo "selected";
                                                                }
                                                            }
                                            ?>>10</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="clearfix"></div>
                                            <div id="myselect<?php echo $i; ?>" style="<?php
                                                            if (!empty($countOptionsArr)) {
                                                                echo "";
                                                            } else {
                                                                echo "display:none;";
                                                            }
                                            ?>">
                                                <div>
                                                    <?php
                                                    if (!empty($countOptionsArr)) {
                                                        $maxCountArr = $countOptionsArr;
                                                    } else {
                                                        $maxCountArr = 10;
                                                    }
                                                    $optIncrArr = 0;
                                                    for ($optCountArr = 1; $optCountArr <= $maxCountArr; $optCountArr++) {
                                                        if (!empty($resultOptionsArr)) {
                                                            $optIncrArr = $optCountArr - 1;
                                                            $opt_IDArr = $resultOptionsArr[$optIncrArr]->option_id;
                                                        }
                                                        ?>
                                                        <?php if (!empty($resultOptionsArr)) { ?><input type="text" name="answerID[]" value="<?php
                                                if (!empty($resultOptionsArr)) {
                                                    echo $opt_IDArr;
                                                }
                                                            ?>" hidden><?php } ?>
                                                        <label id="label_<?php echo $i; ?>_<?php echo $optCountArr; ?>" class="col-md-12 input-group">
                                                            <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option <?php echo $optCountArr; ?></div>
                                                            <input class="form-control" type="text" name="option_<?php echo $i; ?>_<?php echo $optCountArr; ?>" value="<?php
                                                       if (!empty($countOptionsArr)) {
                                                           echo $resultOptionsArr[$optIncrArr]->option_title;
                                                       }
                                                        ?>" id="opt_<?php echo $i; ?>_<?php echo $optCountArr; ?>" placeholder="Enter Your Option<?php echo $optCountArr; ?>">
                                                        </label>
                                                        <?php
                                                        //$optIncrArr++;
                                                    }
                                                    ?>

                                            <!--                                    <label id="label_<?php echo $i; ?>_1" class="col-md-12 input-group">
                                                                                    <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 1</div>
                                                                                    <input class="form-control" type="text" name="option_<?php echo $i; ?>_1" value="" id="opt_<?php echo $i; ?>_1" placeholder="Enter Your Option">
                                                                                </label>					
                                                                                <label id="label_<?php echo $i; ?>_2" class="col-md-12 input-group">
                                                                                    <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 2</div>
                                                                                    <input class="form-control" type="text" name="option_<?php echo $i; ?>_2" value="" id="opt_<?php echo $i; ?>_2" placeholder="Enter Your Option">
                                                                                </label>
                                                                                <label id="label_<?php echo $i; ?>_3" class="col-md-12 input-group">
                                                                                    <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 3</div>
                                                                                    <input class="form-control" type="text" name="option_<?php echo $i; ?>_3" value="" id="opt_<?php echo $i; ?>_3" placeholder="Enter Your Option">
                                                                                </label>
                                                                                <label id="label_<?php echo $i; ?>_4" class="col-md-12 input-group">
                                                                                    <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 4</div>
                                                                                    <input class="form-control" type="text" name="option_<?php echo $i; ?>_4" value="" id="opt_<?php echo $i; ?>_4" placeholder="Enter Your Option">
                                                                                </label>					
                                                                                <label id="label_<?php echo $i; ?>_5" class="col-md-12 input-group">
                                                                                    <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 5</div>
                                                                                    <input class="form-control" type="text" name="option_<?php echo $i; ?>_5" value="" id="opt_<?php echo $i; ?>_5" placeholder="Enter Your Option">
                                                                                </label>
                                                                                <label id="label_<?php echo $i; ?>_6" class="col-md-12 input-group">
                                                                                    <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 6</div>
                                                                                    <input class="form-control" type="text" name="option_<?php echo $i; ?>_6" value="" id="opt_<?php echo $i; ?>_6" placeholder="Enter Your Option">
                                                                                </label>
                                                                                <label id="label_<?php echo $i; ?>_7" class="col-md-12 input-group">
                                                                                    <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 7</div>
                                                                                    <input class="form-control" type="text" name="option_<?php echo $i; ?>_7" value="" id="opt_<?php echo $i; ?>_7" placeholder="Enter Your Option">
                                                                                </label>					
                                                                                <label id="label_<?php echo $i; ?>_8" class="col-md-12 input-group">
                                                                                    <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 8</div>
                                                                                    <input class="form-control" type="text" name="option_<?php echo $i; ?>_8" value="" id="opt_<?php echo $i; ?>_8" placeholder="Enter Your Option">
                                                                                </label>
                                                                                <label id="label_<?php echo $i; ?>_9" class="col-md-12 input-group">
                                                                                    <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 9</div>
                                                                                    <input class="form-control" type="text" name="option_<?php echo $i; ?>_9" value="" id="opt_<?php echo $i; ?>_9" placeholder="Enter Your Option">
                                                                                </label>
                                                                                <label id="label_<?php echo $i; ?>_10" class="col-md-12 input-group">
                                                                                    <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 10</div>
                                                                                    <input class="form-control" type="text" name="option_<?php echo $i; ?>_10" value="" id="opt_<?php echo $i; ?>_10" placeholder="Enter Your Option">
                                                                                </label>-->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $optQuesIncr++;
                            }
                            ?>
                    </div>
                    
                    <div class="box-content nopadding">
                        <div class="form-group">
                            <?php 
                            $this->db->select("*");
                            $this->db->where("status", "Publish");
                            $queryTemplated = $this->db->get("tbl_users_templates");
                            $resultTemplated = $queryTemplated->result();
                            if(!empty($resultTemplated)){
                                $orderTemplate[]='';
                                foreach($resultTemplated as $templatedValue){
                                    $orderTemplate[] = $templatedValue->order;
                                }
                                $tempOrder =max($orderTemplate);
                            }else{
                                 $tempOrder = 0;
                            }
                                if($tempOrder>1){
                                   $hudgeOrder = $tempOrder+1; 
                                }else{
                                   $hudgeOrder = $tempOrder+1;
                                }
                            ?>
                            <label for="first_name" class="control-label col-sm-2">Order</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="temp_order" value="<?php if (@$isEdit){echo $template_details->order;}else{echo $hudgeOrder;}?>"/>
                                <!--<span class="help-block">This is just a Job Filed Type</span>-->
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="textfield" class="control-label col-sm-2">Status</label>
                            <div class="col-sm-2">
                                <select name="status" id="status" class='chosen-select form-control'>
                                    <option value="Publish" <?php
                                    if (($isEdit) && ($template_details->status == 'Publish')) {
                                        echo "selected";
                                    }
                                    ?>> Publish </option>
                                    <option value="Unpublish" <?php
                                    if (($isEdit) && ($template_details->status == 'Unpublish')) {
                                        echo "selected";
                                    }
                                    ?>> Unpublish </option>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" name="submitTemplate" class="btn btn-primary submit-btn pull-right" value="Submit Template">
                            <!--<button type="submit" class="btn btn-primary">Save changes</button>-->
                            <!--<button type="button" class="btn">Cancel</button>-->
                            <button type="button" onclick="history.go(-1);" class="btn btn-danger">Cancel</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php $this->load->view("include_dashboard/alert-message");?>
    </div>
        
</div>

<script>
    $(document).ready(function(){
        $('[data-rel="chosen"],[rel="chosen"]').chosen();
    });
</script>