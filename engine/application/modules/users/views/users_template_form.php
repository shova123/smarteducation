<?php
require('html_form.class.php');
$active[$current] = "style='color:#b43f27;'";

$login_userID = $this->session->userdata('users_user_id');
$login_userTYPE = $this->session->userdata('users_user_type');
$login_userNAME = $this->session->userdata('users_name');

if (!empty($login_userID)) {
    $this->db->select("*");
    $this->db->where("user_id", $login_userID);
    $queryUsers = $this->db->get("tbl_users");
    $resultUsers = $queryUsers->row();
    $userTOKEN = $resultUsers->user_token;
    $login_userFULLNAME = $resultUsers->user_fullname;
    $login_userEMAIL = $resultUsers->user_email;
}
?>
<!--<script src="<?php echo base_url(); ?>gears/admin/js/jquery-2.0.2.min.js"></script>-->
<script src="<?php echo base_url(); ?>gears/admin/js_front/jquery-1.7.2.min.js"></script>
<script src="<?php echo base_url(); ?>gears/admin/plugins/validation/parsley.min.js"></script>
<!--<script src="<1?php echo base_url(); ?>gears/admin/js_front/jquery.chosen.min.js"></script>-->
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
           
            $.get("<?php echo base_url(); ?>email/emails/ajax",{val : path},function(d){
                $("div#htmlEditor span").remove();
                $("textarea.myDevEditControl").show().val(d);
            })
            });
            });
            </script>-->


<!--<script type="text/javascript" src="<?php echo base_url(); ?>gears/admin/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>-->
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
<?php $isEdit = isset($template_details) ? true : false; ?>
<!--<script src="<1?php  echo base_url();?>gears/admin/js_front/add-more.js" type="text/javascript"></script>-->
<section class="main-content">
    <div class="title-page">
        <div class="container">
            <h1>Edit </h1>
        </div>
    </div>
    <div class="container">
        <div class="content-area">
            <div class="row">
                 <?php $this->load->view('common_front/login_header');?>
                
<form class="form-horizontal" action="" method="post" parsley-validate novalidate>
                <input type="hidden" value="<?php echo md5(uniqid(mt_rand(), True)); ?>" name="token" />
                
                <div class="col-md-3">
                    <div class="subject-area">
                        <label>Template Title</label>
                        <input type="text" name="template_title" value="<?php if (!empty($isEdit)) echo $template_details->template_title;?>" class="form-control" placeholder="input thing one"/>
                        <label>Template Design</label>
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
                                                <option value="<?php echo $k . "/" . $value; ?><?php if (!empty($template)) echo $template; ?>"><?php echo $value; ?><?php if (!empty($template)) echo $template; ?></option>
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
                        <label>Template Description</label>
                        <textarea class="form-control" rows="6"></textarea>
                        <label>Template Order</label>
                         <input type="text" name="temp_order" class="form-control" value="<?php if (!empty($isEdit)) echo $template_details->order;?>" placeholder="Template Order"/>
                    </div>
                </div>
                <div class="col-md-9">
                        <div id="htmlEditor" class="controls">
                            <textarea name="html_content" id="html_content" class="form-control myDevEditControl" rows="50" >    
                                <?php if (!empty($isEdit)) echo $template_details->html_content; ?>
                            </textarea>
                        </div> <br /><br />  
                    
<!--                    <textarea rows="50" class="form-control" placeholder="this is the area for ck editer"></textarea>-->
                    <hr/>
<?php 
    if(!empty($template_details)){
        $tempID = $template_details->temp_id;
        $userID = @$login_userID;
        
            $this->db->select("*");
            $this->db->where("temp_id", $tempID);
            $this->db->where("user_id", $userID);
            $queryQuestion= $this->db->get("tbl_users_temp_question");
            $resultQuestion= $queryQuestion->result();
            $countQuestion = $queryQuestion->num_rows();
        
            if(!empty($resultQuestion)){
                $Q_ID = $resultQuestion[0]->q_id;
                $Q_order = $resultQuestion[0]->order;
                $Q_title = $resultQuestion[0]->q_title;
                $Q_type = $resultQuestion[0]->type;
            }
    }
?>
            <div id="featureHolder1">
                    <div class="panel panel-default" id="addMore1" style="<?php if(!empty($resultQuestion)){echo "display:none;";}else{echo "";}?>">
                        <div class="panel-body">
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
                                        <?php for($or=1;$or<=50;$or++){?>
                                            <option value="<?php echo $or;?>" <?php if($or==1){echo "selected";}?>><?php echo $or;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Que</div>
                                        <?php if(!empty($resultQuestion)){?><input type="text" name="questionID[]" value="<?php if(!empty($resultQuestion)){ echo $Q_ID;}?>" hidden><?php }?>
                                        <input class="form-control" type="text" name="questionField[]" value="<?php if(!empty($resultQuestion)){ echo $Q_title;}?>" placeholder="Enter Question">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select name="type[]" class="form-control myselectbox" id="1">
                                        <option value="">Select Type</option>
                                        <option value="Text Entry" <?php if(!empty($resultQuestion)){if($Q_type == "Text Entry"){echo "selected";}}?>>Text Entry</option>
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
                                        <option value="Drop Down" <?php if(!empty($resultQuestion)){if($Q_type == "Drop Down"){echo "selected";}}?>>Drop Down</option>
                                        <option value="Radio Buttons" <?php if(!empty($resultQuestion)){if($Q_type == "Radio Buttons"){echo "selected";}}?>>Radio Buttons</option>
                                        <option value="Checkboxes" <?php if(!empty($resultQuestion)){if($Q_type == "Checkboxes"){echo "selected";}}?>>Checkboxes</option>
                                    </select>
                                </div>
                            </div>
                            <hr/>
                            
                            <?php 
                            if(!empty($Q_ID)){
                                $this->db->select("*");
                                $this->db->where("q_id", $Q_ID);
                                $queryOptions= $this->db->get("tbl_users_question_option");
                                $resultOptions = $queryOptions->result();
                                $countOptions = $queryOptions->num_rows();
                            }
                            //echo $countOptions;
                            ?>
                            <div style="<?php if(!empty($countOptions)){echo "display:none;";}else{echo "display:none;";}?>" id="myrow1" class="1">
                                <div class="col-md-2">
                                    <label>No. of Options</label>
                                </div>
                                <div class="col-md-2">
                                    <select id="option1" name="ansOptions[]" value="" class="selectoption">
                                        <option value="">Option No.</option>
                                        <option value="1" <?php if(!empty($countOptions)){if($countOptions == 1){echo "selected";}}?>>1</option>
                                        <option value="2" <?php if(!empty($countOptions)){if($countOptions == 2){echo "selected";}}?>>2</option>
                                        <option value="3" <?php if(!empty($countOptions)){if($countOptions == 3){echo "selected";}}?>>3</option>
                                        <option value="4" <?php if(!empty($countOptions)){if($countOptions == 4){echo "selected";}}?>>4</option>
                                        <option value="5" <?php if(!empty($countOptions)){if($countOptions == 5){echo "selected";}}?>>5</option>
                                        <option value="6" <?php if(!empty($countOptions)){if($countOptions == 6){echo "selected";}}?>>6</option>
                                        <option value="7" <?php if(!empty($countOptions)){if($countOptions == 7){echo "selected";}}?>>7</option>
                                        <option value="8" <?php if(!empty($countOptions)){if($countOptions == 8){echo "selected";}}?>>8</option>
                                        <option value="9" <?php if(!empty($countOptions)){if($countOptions == 9){echo "selected";}}?>>9</option>
                                        <option value="10" <?php if(!empty($countOptions)){if($countOptions == 10){echo "selected";}}?>>10</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="clearfix"></div>
                            
                            <div id="myselect1" style="<?php if(!empty($countOptions)){echo "";}else{echo "display:none;";}?>">
                                <div>
                                    <?php 
                                    if(!empty($countOptions)){
                                        $maxCount=$countOptions;
                                        //$optIncr = 0;
                                    }else{
                                        $maxCount=10;
                                    }    
                                    
                                        for($optCount= 1;$optCount<=$maxCount;$optCount++){
                                           if(!empty($resultOptions)){
                                            $optIncr = $optCount-1;
                                            $opt_ID = $resultOptions[$optIncr]->option_id;
                                           }
                                    ?>
                                    <?php if(!empty($resultOptions)){?><input type="text" name="answerID[]" value="<?php if(!empty($resultOptions)){ echo $opt_ID;}?>" hidden><?php }?>
                                        <label id="label_1_<?php echo $optCount;?>" class="col-md-12 input-group">
                                            <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option <?php echo $optCount;?></div>
                                            <input class="form-control" type="text" name="option_1_<?php echo $optCount;?>" value="<?php if(!empty($countOptions)){echo $resultOptions[$optIncr]->option_title;}?>" id="opt_1_<?php echo $optCount;?>" placeholder="Enter Your Option<?php echo $optCount;?>">
                                        </label>
                                    <?php //if(!empty($optIncr)){$optIncr++;}
                                    }?>
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
if(!empty($countQuestion)){
    
    if($countQuestion>1){
        $max = $countQuestion+1;
    }else{
        $max=50;
    }
    $max=$countQuestion;
}else{
    $max=50;
}

$optQuesIncr=1;
for($i=2;$i<=$max;$i++){
    
     if(!empty($template_details)){
        $tempIDArr = $template_details->temp_id;
        $userIDArr = @$login_userID;
        
            $this->db->select("*");
            $this->db->where("temp_id", $tempIDArr);
            $this->db->where("user_id", $userIDArr);
            $queryQuestionArr= $this->db->get("tbl_users_temp_question");
            $resultQuestionArr= $queryQuestionArr->result();
            //$countQuestionArr = $queryQuestionArr->num_rows();
        if(!empty($resultQuestionArr)){
                $Q_IDArr = $resultQuestionArr[$optQuesIncr]->q_id;
                $Q_orderArr = $resultQuestionArr[$optQuesIncr]->order;
                $Q_titleArr = $resultQuestionArr[$optQuesIncr]->q_title;
                $Q_typeArr = $resultQuestionArr[$optQuesIncr]->type;
        }
    }
?>
                <div id="featureHolder<?php echo $i;?>" style="<?php if(!empty($resultQuestionArr)){echo "";}else{echo "display:none;";}?>">
                    <div class="panel panel-default" id="addMore<?php echo $i;?>" style="<?php if(!empty($resultQuestionArr)){echo "display:none;";}else{echo "";}?>">
                        <div class="panel-body">
                            <div class="btn btn-primary submit-btn addFeatures" id="<?php echo $i;?>"><i class="glyphicon glyphicon-plus"></i> Add More <i class="glyphicon glyphicon-plus"></i></div><!--onclick="addFeatures();"-->
                        </div>
                    </div>
                    <div class="panel panel-default" >
                        <div class="panel-body">
                            <br/>
                            <div class="row listContainer" id="myListsTable">
                                <div class="col-md-2" style="width: 15%;">
                                    <select class="form-control" name="order[]">
                                        <option value="">Q.Order</option>    
                                        <?php for($or2=1;$or2<=50;$or2++){?>
                                            <option value="<?php echo $or2;?>" <?php if($or2==$i){echo "selected";}?>><?php echo $or2;?></option>
                                        <?php }?>
                                    </select>
                                </div>
                                <div class="col-md-7">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Que</div>
                                        <?php if(!empty($resultQuestionArr)){?><input type="text" name="questionID[]" value="<?php if(!empty($resultQuestionArr)){ echo $Q_IDArr;}?>" hidden><?php }?>
                                        <input class="form-control" type="text" name="questionField[]" value="<?php if(!empty($resultQuestionArr)){ echo $Q_titleArr;}?>" placeholder="Enter Question">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <select name="type[]" class="form-control myselectbox" id="<?php echo $i;?>">
                                        <option value="">Select Type</option>
                                        <option value="Text Entry" <?php if(!empty($resultQuestionArr)){if($Q_typeArr == "Text Entry"){echo "selected";}}?>>Text Entry</option>
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
                                        <option value="Drop Down" <?php if(!empty($resultQuestionArr)){if($Q_typeArr == "Drop Down"){echo "selected";}}?>>Drop Down</option>
                                        <option value="Radio Buttons" <?php if(!empty($resultQuestionArr)){if($Q_typeArr == "Radio Buttons"){echo "selected";}}?>>Radio Buttons</option>
                                        <option value="Checkboxes" <?php if(!empty($resultQuestionArr)){if($Q_typeArr == "Checkboxes"){echo "selected";}}?>>Checkboxes</option>
                                        
                                        
                                    </select>
                                </div>
                            </div>
                            <hr/>
                            <?php 
                            if(!empty($Q_IDArr)){
                                $this->db->select("*");
                                $this->db->where("q_id", $Q_IDArr);
                                $queryOptionsArr= $this->db->get("tbl_users_question_option");
                                $resultOptionsArr = $queryOptionsArr->result();
                                $countOptionsArr = $queryOptionsArr->num_rows();
                              
                            }
                            //echo $countOptions;
                            ?>
                            
                            <div style="<?php if(!empty($countOptionsArr)){echo "display:none;";}else{echo "display:none;";}?>" id="myrow<?php echo $i;?>" class="<?php echo $i;?>">
                                <div class="col-md-2">
                                    <label>No. of Options</label>
                                </div>
                                <div class="col-md-2">
                                    <select id="option<?php echo $i;?>" value="" class="selectoption" name="ansOptions[]">
                                        <option value="">Option No.</option>
                                        <option value="1" <?php if(!empty($countOptionsArr)){if($countOptionsArr == 1){echo "selected";}}?>>1</option>
                                        <option value="2" <?php if(!empty($countOptionsArr)){if($countOptionsArr == 2){echo "selected";}}?>>2</option>
                                        <option value="3" <?php if(!empty($countOptionsArr)){if($countOptionsArr == 3){echo "selected";}}?>>3</option>
                                        <option value="4" <?php if(!empty($countOptionsArr)){if($countOptionsArr == 4){echo "selected";}}?>>4</option>
                                        <option value="5" <?php if(!empty($countOptionsArr)){if($countOptionsArr == 5){echo "selected";}}?>>5</option>
                                        <option value="6" <?php if(!empty($countOptionsArr)){if($countOptionsArr == 6){echo "selected";}}?>>6</option>
                                        <option value="7" <?php if(!empty($countOptionsArr)){if($countOptionsArr == 7){echo "selected";}}?>>7</option>
                                        <option value="8" <?php if(!empty($countOptionsArr)){if($countOptionsArr == 8){echo "selected";}}?>>8</option>
                                        <option value="9" <?php if(!empty($countOptionsArr)){if($countOptionsArr == 9){echo "selected";}}?>>9</option>
                                        <option value="10" <?php if(!empty($countOptionsArr)){if($countOptionsArr == 10){echo "selected";}}?>>10</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="clearfix"></div>
                            <div id="myselect<?php echo $i;?>" style="<?php if(!empty($countOptionsArr)){echo "";}else{echo "display:none;";}?>">
                                <div>
                                    <?php 
                                    if(!empty($countOptionsArr)){
                                        $maxCountArr=$countOptionsArr;
                                        
                                    }else{
                                        $maxCountArr=10;
                                    }    
                                        $optIncrArr = 0;
                                        for($optCountArr=1 ; $optCountArr  <= $maxCountArr ; $optCountArr++ ){
                                            if(!empty($resultOptionsArr)){
                                                $optIncrArr = $optCountArr - 1;
                                                $opt_IDArr = $resultOptionsArr[$optIncrArr]->option_id;
                                            }
                                    ?>
                                    <?php if(!empty($resultOptionsArr)){?><input type="text" name="answerID[]" value="<?php if(!empty($resultOptionsArr)){ echo $opt_IDArr;}?>" hidden><?php }?>
                                        <label id="label_<?php echo $i;?>_<?php echo $optCountArr;?>" class="col-md-12 input-group">
                                            <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option <?php echo $optCountArr;?></div>
                                            <input class="form-control" type="text" name="option_<?php echo $i;?>_<?php echo $optCountArr;?>" value="<?php if(!empty($countOptionsArr)){echo $resultOptionsArr[$optIncrArr]->option_title;}?>" id="opt_<?php echo $i;?>_<?php echo $optCountArr;?>" placeholder="Enter Your Option<?php echo $optCountArr;?>">
                                        </label>
                                    <?php //$optIncrArr++;
                                    }?>
                                    
<!--                                    <label id="label_<?php echo $i;?>_1" class="col-md-12 input-group">
                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 1</div>
                                        <input class="form-control" type="text" name="option_<?php echo $i;?>_1" value="" id="opt_<?php echo $i;?>_1" placeholder="Enter Your Option">
                                    </label>					
                                    <label id="label_<?php echo $i;?>_2" class="col-md-12 input-group">
                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 2</div>
                                        <input class="form-control" type="text" name="option_<?php echo $i;?>_2" value="" id="opt_<?php echo $i;?>_2" placeholder="Enter Your Option">
                                    </label>
                                    <label id="label_<?php echo $i;?>_3" class="col-md-12 input-group">
                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 3</div>
                                        <input class="form-control" type="text" name="option_<?php echo $i;?>_3" value="" id="opt_<?php echo $i;?>_3" placeholder="Enter Your Option">
                                    </label>
                                    <label id="label_<?php echo $i;?>_4" class="col-md-12 input-group">
                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 4</div>
                                        <input class="form-control" type="text" name="option_<?php echo $i;?>_4" value="" id="opt_<?php echo $i;?>_4" placeholder="Enter Your Option">
                                    </label>					
                                    <label id="label_<?php echo $i;?>_5" class="col-md-12 input-group">
                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 5</div>
                                        <input class="form-control" type="text" name="option_<?php echo $i;?>_5" value="" id="opt_<?php echo $i;?>_5" placeholder="Enter Your Option">
                                    </label>
                                    <label id="label_<?php echo $i;?>_6" class="col-md-12 input-group">
                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 6</div>
                                        <input class="form-control" type="text" name="option_<?php echo $i;?>_6" value="" id="opt_<?php echo $i;?>_6" placeholder="Enter Your Option">
                                    </label>
                                    <label id="label_<?php echo $i;?>_7" class="col-md-12 input-group">
                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 7</div>
                                        <input class="form-control" type="text" name="option_<?php echo $i;?>_7" value="" id="opt_<?php echo $i;?>_7" placeholder="Enter Your Option">
                                    </label>					
                                    <label id="label_<?php echo $i;?>_8" class="col-md-12 input-group">
                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 8</div>
                                        <input class="form-control" type="text" name="option_<?php echo $i;?>_8" value="" id="opt_<?php echo $i;?>_8" placeholder="Enter Your Option">
                                    </label>
                                    <label id="label_<?php echo $i;?>_9" class="col-md-12 input-group">
                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 9</div>
                                        <input class="form-control" type="text" name="option_<?php echo $i;?>_9" value="" id="opt_<?php echo $i;?>_9" placeholder="Enter Your Option">
                                    </label>
                                    <label id="label_<?php echo $i;?>_10" class="col-md-12 input-group">
                                        <div class="input-group-addon" style="background-color:#357ebd; color:white; border-color:#357ebd">Option 10</div>
                                        <input class="form-control" type="text" name="option_<?php echo $i;?>_10" value="" id="opt_<?php echo $i;?>_10" placeholder="Enter Your Option">
                                    </label>-->
                                </div>
                             </div>
                        </div>
                    </div>
                </div>
<?php $optQuesIncr++;}?>

<!--                <div><div id="featureHolder"><div class="panel panel-default"><div class="panel-body"><div id="2" class="btn btn-primary submit-btn addFeatures"><i class="glyphicon glyphicon-ok"></i>++ Add More ++</div></div></div><div class="panel panel-default"><div class="panel-body"><br><div id="myListsTable" class="row listContainer"><div style="width: 15%;" class="col-md-2"><select name="order[]" class="form-control"><option value="">Q.Order</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></div><div class="col-md-7"><div class="input-group"><div style="background-color:#357ebd; color:white; border-color:#357ebd" class="input-group-addon">Que</div><input type="text" placeholder="Enter Question" name="questionField[]" class="form-control"></div></div><div class="col-md-3"><select id="2" class="form-control myselectbox" name="type[]"><option value="Text Entry">Text Entry</option><option value="Drop Down">Drop Down</option><option value="Radio Buttons">Radio Buttons</option><option value="Checkboxes">Checkboxes</option></select></div></div><hr><div class="2" id="myrow2" style="display:none;"><div class="col-md-2"><label>No. of Options</label></div><div class="col-md-2"><select name="select" class="selectoption" value="" id="option2"><option value="">Option No.</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option></select></div></div><div class="clearfix"></div><div style="display:none;" id="myselect2"><div><label class="col-md-12 input-group" id="label_2_1"><div style="background-color:#357ebd; color:white; border-color:#357ebd" class="input-group-addon">Option 1</div><input type="text" placeholder="Enter Your Option" id="opt_2_1" value="" name="option_2_1" class="form-control"></label><label class="col-md-12 input-group" id="label_2_2"><div style="background-color:#357ebd; color:white; border-color:#357ebd" class="input-group-addon">Option 2</div><input type="text" placeholder="Enter Your Option" id="opt_2_2" value="" name="option_2_2" class="form-control"></label><label class="col-md-12 input-group" id="label_2_3"><div style="background-color:#357ebd; color:white; border-color:#357ebd" class="input-group-addon">Option 3</div><input type="text" placeholder="Enter Your Option" id="opt_2_3" value="" name="option_2_3" class="form-control"></label><label class="col-md-12 input-group" id="label_2_4"><div style="background-color:#357ebd; color:white; border-color:#357ebd" class="input-group-addon">Option 4</div><input type="text" placeholder="Enter Your Option" id="opt_2_4" value="" name="option_2_4" class="form-control"></label><label class="col-md-12 input-group" id="label_2_5"><div style="background-color:#357ebd; color:white; border-color:#357ebd" class="input-group-addon">Option 5</div><input type="text" placeholder="Enter Your Option" id="opt_2_5" value="" name="option_2_5" class="form-control"></label><label class="col-md-12 input-group" id="label_2_6"><div style="background-color:#357ebd; color:white; border-color:#357ebd" class="input-group-addon">Option 6</div><input type="text" placeholder="Enter Your Option" id="opt_2_6" value="" name="option_2_6" class="form-control"></label><label class="col-md-12 input-group" id="label_2_7"><div style="background-color:#357ebd; color:white; border-color:#357ebd" class="input-group-addon">Option 7</div><input type="text" placeholder="Enter Your Option" id="opt_2_7" value="" name="option_2_7" class="form-control"></label><label class="col-md-12 input-group" id="label_2_8"><div style="background-color:#357ebd; color:white; border-color:#357ebd" class="input-group-addon">Option 8</div><input type="text" placeholder="Enter Your Option" id="opt_2_8" value="" name="option_2_8" class="form-control"></label><label class="col-md-12 input-group" id="label_2_9"><div style="background-color:#357ebd; color:white; border-color:#357ebd" class="input-group-addon">Option 9</div><input type="text" placeholder="Enter Your Option" id="opt_2_9" value="" name="option_2_9" class="form-control"></label><label class="col-md-12 input-group" id="label_2_10"><div style="background-color:#357ebd; color:white; border-color:#357ebd" class="input-group-addon">Option 10</div><input type="text" placeholder="Enter Your Option" id="opt_2_10" value="" name="option_2_10" class="form-control"></label></div></div></div></div></div></div>-->
                
                <div class="panel panel-default">
                    <div class="panel-body">
                        <input type="submit" name="submitTemplate" value="Submit Template" class="btn btn-success submit-btn pull-right"/>
<!--                        <div class="btn btn-success submit-btn" id="1"><i class="glyphicon glyphicon-plus"></i> Add More <i class="glyphicon glyphicon-plus"></i></div>onclick="addFeatures();"-->
                    </div>
                </div>
                </div>
                </form>
            </div>
            <div class="row">
                <?php $this->load->view("include_dashboard/alert-message");?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
</section>