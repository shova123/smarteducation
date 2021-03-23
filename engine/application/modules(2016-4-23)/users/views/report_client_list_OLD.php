<?php 

  function shorten_string($string, $wordsreturned){
    $retval = $string;
    $array = explode(" ", $string);
    if (count($array)<=$wordsreturned)
    {
    $retval = $string;
    }
    else
    {
    array_splice($array, $wordsreturned);
    $retval = implode(" ", $array);
    }
    return $retval; 
    }
?>
<script type="text/javascript" src="<?php echo base_url(); ?>gears/front/js/json2.js"></script>
<script>
    $(document).ready(function(){
        $("#template_keywords").keyup(function(){
//            if($("#template_keywords").val().length>3){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("report/search_report"); ?>",
                    cache: false,
                    data:'template_keywords='+$("#template_keywords").val(),
                    success: function(response){
                        $('#finalResult').html("");
                        var obj = JSON.parse(response);
                        
                        if(obj.length>0){
                            try{
                                var items=[];
                                $.each(obj, function (i, val) {
                                    
                                    var templateView = '<?php echo base_url(); ?>report/view_report/' + val.TOKEN;
                                    var templateEdit = '<?php echo base_url(); ?>report/report_edit/' + val.TOKEN;
                                    var answerDownload = '<?php echo base_url(); ?>report/answer_download/' + val.TOKEN;
                                    
                                    var textOnly = $(val.TEMPLATE_DESCRIPTION).text();
                                    var templateDetails = textOnly.substring(0, 120);
                                    
                                    var imageLocation = '<?php echo base_url();?>gears/front/images/wwd2.png';
                                    
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
        if (!empty($report_list)) {
            $countteachers = 1;
            foreach ($report_list as $reportDETAILS) {
                $r_id = $reportDETAILS->r_id;
        ?>
        $('div[data-toolbar="report-option<?php echo $r_id;?>"]').toolbar({
            content: '#report-options<?php echo $r_id;?>',
            position: 'left',
            style: 'dark',
            event: 'click',
            hideOnClick: true
        });
        <?php }}?>
    });
    
</script>
<div class="clearfix"></div>
<div class="row">
    <div class="col-sm-12">
        <div class="temp-list">
            <div class="sample">
                <h1><small><i class="fa fa-list-ol"></i> </small> Report Issues List
                    
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
                    if (!empty($report_list)) {
                        $countteachers = 1;
                        foreach ($report_list as $reportDETAILS) {
                            $r_id = $reportDETAILS->r_id;
                            $token = $reportDETAILS->report_token;
                            $category_id = $reportDETAILS->category_id;
                            $sub_cat_id = $reportDETAILS->sub_cat_id;
                            $user_id = $reportDETAILS->user_id;
                            $temp_id = $reportDETAILS->temp_id;
                            $subject = $reportDETAILS->subject;
                            $content_message = $reportDETAILS->content;
                            $template_title = $reportDETAILS->template_title;
                            $first_name = $reportDETAILS->first_name;
                            $last_name = $reportDETAILS->last_name;
                            $full_name = "$first_name $last_name";
                            
                            
//                                    $this->db->select("*");
//                                    $this->db->where('category_id', $category_id);
//                                    $queryCategory = $this->db->get("tbl_category");
//                                    $resultCategory = $queryCategory->row();
//                                            $catTitle = @$resultCategory->category_title;
//                                    $this->db->select("*");
//                                    $this->db->where('sub_cat_id', $sub_cat_id);
//                                    $queryCategorySub = $this->db->get("tbl_category_sub");
//                                    $resultCategorySub = $queryCategorySub->row();
//                                            $subCatTitle = @$resultCategorySub->subcategory_title;
                            ?>
                            <li>
                                <a href="<?php echo base_url("users/report_view/$token"); ?>">
                                    <div class="list-action-left">
                                        <img src="<?php echo base_url(); ?>gears/front/images/wwd2.png" alt="img">
                                    </div>
                                    <div class="list-content" style="margin-right:0px;width: 95%;">
                                        <span class="title"><?php echo $subject; ?></span>
                                        <span class="caption">
                                            <?php echo 'user and template information';//strip_tags(shorten_string($templateDESCRIPTION, 120)); ?>
                                        </span>
                                        <!--<span class="caption" style="font-style:italic;"><?php if(!empty($catTitle)){echo $catTitle;} echo ', '; if(!empty($subCatTitle)){echo $subCatTitle;}?></span>-->
                                    </div>
                                </a>
                                
                                
                                <div class="list-action-right">
                                    <div id="report-options<?php echo $r_id;?>" class="hidden">
                                       <a href="<?php echo base_url("users/report_view/$token");?>" ><i class="fa fa-edit" style="font-size:12px;"></i></a>
                                    </div>
                                    <div class="btn-toolbar btn-toolbar-dark" id="button" data-toolbar="report-option<?php echo $r_id;?>"><i class="fa fa-cog"></i></div>

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
    <?php $this->load->view("include_dashboard/alert-message");?>
</div><!--/list template info-->