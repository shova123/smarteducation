<?php
function shorten_stringDas($string, $wordsreturned){
    $retval = $string;
    $array = explode(" ", $string);
    if (count($array)<=$wordsreturned)
    {
    $retval = $string;
    }else
    {
    array_splice($array, $wordsreturned);
    $retval = implode(" ", $array);
    }
    return $retval; 
    }
?>
<script type="text/javascript" src="<?php echo base_url(); ?>gears/front_dashboard/js/json2.js"></script>
<script>
    $(document).ready(function(){
        $("#template_keywords").keyup(function(){
//            if($("#template_keywords").val().length>3){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("templates/search_templates"); ?>",
                    cache: false,
                    data:'template_keywords='+$("#template_keywords").val(),
                    success: function(response){
                        $('#finalResult').html("");
                        var obj = JSON.parse(response);
                        
                        if(obj.length>0){
                            try{
                                var items=[];
                                $.each(obj, function (i, val) {
                                    
                                    var templateView = '<?php echo base_url(); ?>teachers/view_templates/' + val.TOKEN;
                                    var templateEdit = '<?php echo base_url(); ?>teachers/templates_edit/' + val.TOKEN;
                                    var answerDownload = '<?php echo base_url(); ?>teachers/answer_download/' + val.TOKEN;
                                    
                                    var textOnly = $(val.TEMPLATE_DESCRIPTION).text();
                                    var templateDetails = textOnly.substring(0, 120);
                                    
                                    var imageLocation = '<?php echo base_url();?>gears/front_dashboard/images/wwd2.png';
                                    
                                    var myModal = '#myModal_template_'+val.TEMP_ID;
                                    var catTitle = val.CATEGORY_TITLE;
                                    var subCatTitle = val.SUBCATEGORY_TITLE;
                                    
                                
                                    //items.push('<li><a href="'+ templateView +'"><div class="list-content"><span class="title">'+ val.TEMPLATE_TITLE +'</span><span class="caption">'+ templateDetails +'</span></div></a><a href=""><div class="list-action-right"><ul class="list-unstyled"><li><a href="'+ templateView +'" data-toggle="tooltip" title="view"><i class="fa fa-eye"></i></a></li><li><a href="'+ templateEdit +'" data-toggle="tooltip" title="Edit Template"><i class="fa fa-edit"></i></a></li></ul></div></a></li>');
                                items.push('<li><a href="'+templateView+'"><div class="list-action-left"><img src="'+imageLocation+'" alt="img"></div><div class="list-content" style="margin-right:0px;width: 95%;"><span class="title">'+ val.TEMPLATE_TITLE +'</span><span class="caption">'+ templateDetails +'</span><span class="caption" style="font-style:italic;">'+catTitle+','+subCatTitle+'</span></div></a><div class="list-action-right" style="top:0% !important;"><a href="'+templateView+'" target="_blank" data-toggle="tooltip" title="View"><i class="fa fa-eye" style="font-size:14px;"></i></a><a href="'+answerDownload+'" data-toggle="tooltip" title="download"><i class="fa fa-download"></i></a><a href="'+templateEdit+'" data-toggle="tooltip" title="Edit"><i class="fa fa-edit" style="font-size:14px;"></i></a><a href="#" data-toggle="modal" data-target="'+myModal+'"><i class="fa fa-times" style="font-size:14px;"></i></a></div></li>');
                                });
                            $('#finalResult').append.apply($('#finalResult'), items);
                            } catch (e) {
                                alert('Exception while request..');
                            }
                        } else {
                            //$('#finalResult').html('<div class="search-result panel"><h2>No Data Found</h2></div>');
                            $('#finalResult').html($('<li/>').text("No Data Found"));
                        }
                    },
                    error: function () {
                        alert('Error while request..');
                    }
                });
//            }
//            return false;
        });
    });

</script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Define any icon actions before calling the toolbar
        <?php
        if (!empty($templates_list)) {
            $countteachers = 1;
            foreach ($templates_list as $templatesDETAILS) {
                $temp_id = $templatesDETAILS->temp_id;
        ?>
        
        $('div[data-toolbar="template-list-option<?php echo $temp_id;?>"]').toolbar({
            content: '#template-list-options<?php echo $temp_id;?>',
            position: 'left',
            style: 'dark',
            event: 'click',
            hideOnClick: true
        });
        <?php }}?>
    });
    
</script>
<div class="clearfix"></div>
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
<?php if(@$message){?>
<script type="text/javascript">
    $(window).load(function(){
        $('#errorModal').modal('show');
    });
</script>

<div class="modal fade" id="errorModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <!--<h4 class="modal-title" id="myModalLabel">Information</h4>-->
              </div>
              <div class="modal-body">
                  <?php echo @$message;?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
              </div>
            </div>
          </div>
        </div>
<?php }?>

<div class="row">
    <div class="col-sm-12">
        <div class="temp-list <?php if($bootstropID4 >=0){?>bootstro<?php }?>" <?php if($bootstropID4 >=0){?>
                        data-bootstro-title='Template List' 
                        data-bootstro-content="Lists of all Created/Assined Templates <br>
                        <strong>Search Icon</strong>(<i class='fa fa-search'></i>)<br>
                        Click it to open search box (<strong>Note </strong>: Templates can be searched under Template Title, Tags keywords, Category, Subcategory, Username, First name, Last name & Email.)
                        & <br>
                        <strong> Gear Icon</strong>(<div class='btn btn-toolbar-dark'><i class='fa fa-cog'></i></div>)<br>
                        Click it for Actions Like Edit, Delete & view"
                        data-bootstro-width="600px" 
                        data-bootstro-placement='left' data-bootstro-step='<?php echo $bootstropID4;?>'<?php }?>>
            <div class="sample">
                <h1><small><i class="fa fa-list-ol"></i> </small> Template List
<!--                    <div class="pull-right">
                        <div class="btn-group">
                            <a class="btn btn-success" href="<?php echo base_url('templates/templates_add') ?>">Create Templates <i class="fa fa-plus"></i></a>
                        </div>
                    </div>-->
                </h1>
                <form class="search-item">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span>
                        <input type="text" name="template_keywords" id="template_keywords" class="form-control" placeholder="Search for...">
                    </div><!-- /input-group -->
                </form>
                <ul class="project-listings" id="finalResult">
                    <?php
                    if (!empty($templates_list)) {
                        $countteachers = 1;
                        foreach ($templates_list as $templatesDETAILS) {
                            $temp_id = $templatesDETAILS->temp_id;
                            $category_id = $templatesDETAILS->category_id;
                            $sub_cat_id = $templatesDETAILS->sub_cat_id;
                            $storage_type = $templatesDETAILS->storage_type;
                            $templateTITLE = $templatesDETAILS->template_title;
                            $templateDESCRIPTION = $templatesDETAILS->template_description;
                            $templatePATH = $templatesDETAILS->template_path;
                            $templateTOKEN = $templatesDETAILS->token;
                            $status = $templatesDETAILS->status;
                            
                                    $this->db->select("*");
                                    $this->db->where('category_id', $category_id);
                                    $queryCategory = $this->db->get("tbl_category");
                                    $resultCategory = $queryCategory->row();
                                            $catTitle = @$resultCategory->category_title;
                                    $this->db->select("*");
                                    $this->db->where('sub_cat_id', $sub_cat_id);
                                    $queryCategorySub = $this->db->get("tbl_category_sub");
                                    $resultCategorySub = $queryCategorySub->row();
                                            $subCatTitle = @$resultCategorySub->subcategory_title;
                            ?>
                            <li>
                                <a href="<?php echo base_url("teachers/template_view/$templateTOKEN"); ?>">
                                    <div class="list-action-left">
                                        <img src="<?php echo base_url(); ?>gears/front_dashboard/images/wwd2.png" alt="img">
                                    </div>
                                    <div class="list-content" style="margin-right:0px;width: 95%;">
                                        <span class="title"><a href="<?php echo base_url("teachers/template_view/$templateTOKEN"); ?>"><?php echo $templateTITLE; ?></a></span>
                                        <span class="caption">
                                            <?php echo strip_tags(shorten_stringDas($templateDESCRIPTION, 120)); ?>
                                        </span>
                                        <span class="caption" style="font-style:italic;"><?php if(!empty($catTitle)){echo $catTitle;} echo ', '; if(!empty($subCatTitle)){echo $subCatTitle;}?></span>
                                    </div>
                                </a>
                                <div class="list-action-right" style='top:0% !important;'>
                                    <div id="template-list-options<?php echo $temp_id;?>" class="hidden">
                                        <a href="<?php echo base_url("templates/view_templates/$templateTOKEN"); ?>" target="_blank" data-toggle="tooltip" title="View"><i class="fa fa-eye" style='font-size:14px;'></i></a>
                                        <a href="<?php echo base_url("teachers/answer_download/$templateTOKEN"); ?>" data-toggle="tooltip" title="download"><i class="fa fa-download"></i></a>
                                        <a href='<?php echo base_url("templates/templates_edit/$templateTOKEN");?>' data-toggle='tooltip' title='Edit'><i class='fa fa-edit' style='font-size:14px;'></i></a>
                                        <a href='#' data-toggle='modal' data-target='#myModal<?php echo "_template_$temp_id";?>'><i class='fa fa-times' style='font-size:14px;'></i></a>
                                    </div>
                                    <div class="btn-toolbar btn-toolbar-dark" id="button" data-toolbar="template-list-option<?php echo $temp_id;?>"><i class="fa fa-cog"></i></div>
                                    
                                    
                                </div>
                            </li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div><!--/template list-->
    <style type="text/css">
            .mystyle{
                    background-color: #90b941;
                background-image: linear-gradient(90deg, transparent 50%, rgba(152, 195, 68, 1) 50%);
                background-size: 3px 3px;
                border-bottom: 1px dashed #d2d3cf;
                border-top: 1px dashed #d2d3cf;
                box-shadow: 0 0 0 5px #90b941, 2px 1px 6px 4px rgba(10, 10, 0, 0.3);
                color: #fff;
                font-size: 14px;
                height: auto;
                line-height: 1em;
                margin: 15px auto;
                padding: 9px 0 !important;
                text-align: center;
                width: 100%;
            }
    </style>
<!--    <div class="col-md-12">
        <div class="mystyle">something important message here</div>
    </div>-->
</div><!--/list template info-->

  <?php
    if (!empty($templates_list)) {
        $countteachers = 1;
        foreach ($templates_list as $templatesDETAILS) {
            $temp_id = $templatesDETAILS->temp_id;
            $user_ids = $templatesDETAILS->user_id;
            $templateTITLE1 = $templatesDETAILS->template_title;
            $templateTOKEN = $templatesDETAILS->token;
            $status = $templatesDETAILS->status;
            
                    $this->db->select("*");
                    $this->db->where("user_id", $user_ids);
                    $queryUsers1 = $this->db->get("users");
                    $resultUsers1 = $queryUsers1->row();

                    $userFirstName1 = @$resultUsers1->first_name;
                    $userLastName1 = @$resultUsers1->last_name;
                    $userFullName1 = "$userFirstName1 $userLastName1";
    ?>
    <!-- Modal -->
        <div class="modal fade" id="myModal<?php echo "_template_$temp_id";?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Template Delete Information</h4>
              </div>
              <div class="modal-body">
                  Are you sure to delete the Template <strong><?php echo $templateTITLE1;?> of User <?php echo $userFullName1;?> </strong>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="<?php echo base_url("templates/templates_delete/$templateTOKEN");?>" class="btn btn-danger">Delete</a>
              </div>
            </div>
          </div>
        </div>
    <?php
            }
        }
    ?>