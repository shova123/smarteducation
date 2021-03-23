<script type="text/javascript" src="<?php echo base_url(); ?>gears/front_dashboard/js/json2.js"></script>
<script>
    $(document).ready(function(){
        $("#user_keywords").keyup(function(){
//            if($("#user_keywords").val().length>3){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("users/search_users"); ?>",
                    cache: false,
                    data:'user_keywords='+$("#user_keywords").val(),
                    success: function(response){
                        $('#finalResult').html("");
                        var obj = JSON.parse(response);
                        
                        if(obj.length>0){
                            try{
                                var items=[];
                                $.each(obj, function (i, val) {
                                    var userEdit = "<?php echo base_url(); ?>users/edit_user/" + val.USER_TOKEN;
                                    var fullName = val.FIRST_NAME + ' ' +val.LAST_NAME;
                                    var userIMAGE = val.HOME_IMAGE;
                                    var root = '<?php echo $this->config->item('site_root') ?>';
                                    
                                    if(userIMAGE != ''){var imagePath = 'profile/'+userIMAGE;}else{var imagePath = 'no-image.jpg';}
                                    
                                    var imageLocation = '<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src='+ root +'uploads/'+ imagePath +'&w=150&h=150';
                                    var myModal = '#myModal_users_'+val.USER_ID;
                                    var catTitle = val.CATEGORY_TITLE;
                                    var subCatTitle = val.SUBCATEGORY_TITLE;
                                    //var textOnly = $(val.TEMPLATE_DESCRIPTION).text();
                                    //var templateDetails = textOnly.substring(0, 160);
                                    //items.push('<li><a href="'+userEdit+'"><div class="list-action-left"><img src="'+imageLocation+'" /></div><div class="list-content" style="margin-right:0;padding: 15px;"><span class="title">'+fullName+'</span><span class="caption">'+catTitle+','+subCatTitle+'</span></div></a><div class="list-action-right"><div id="user-options-search" class="hidden"><a href="'+userEdit+'" ><i class="fa fa-edit" style="font-size:12px;"></i></a><a href="#" data-toggle="modal" data-target="'+myModal+'"><i class="fa fa-times" style="font-size:12px;"></i></a></div><div class="btn-toolbar btn-toolbar-dark" id="button" data-toolbar="user-option-search"><i class="fa fa-cog"></i></div></div></li>');
                                    items.push('<li><a href="'+userEdit+'"><div class="list-action-left"><img src="'+imageLocation+'" /></div><div class="list-content" style="margin-right:0;padding: 15px;"><span class="title">'+fullName+'</span><span class="caption">'+catTitle+','+subCatTitle+'</span></div></a><div class="list-action-right" style="top:0% !important;"><a href="'+userEdit+'" data-toggle="tooltip" title="Edit User"><i class="fa fa-edit" style="font-size:14px;"></i></a><a href="#" data-toggle="modal" data-target="'+myModal+'"><i class="fa fa-times" style="font-size:14px;"></i></a></div></li>');
                                    //items.push('<li><a href="'+userEdit+'"><div class="list-action-left"><img src="'+imageLocation+'" /></div><div class="list-content" style="margin-right:0"><span class="title">'+fullName+'</span></div></a><div class="list-action-right"><a data-container="body" data-toggle="popover" tabindex="0" role="button" data-trigger="focus" data-placement="left" data-content="'+dataContent+'"><i class="fa fa-cog"></i></a></div></li>');
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
        // scipr for templates view
        $("#template_keywords").keyup(function(){
//            if($("#template_keywords").val().length>3){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("templates/search_templates"); ?>",
                    cache: false,
                    data:'template_keywords='+$("#template_keywords").val(),
                    success: function(response){
                        $('#finalResultTemplate').html("");
                        var obj = JSON.parse(response);
                        
                        if(obj.length>0){
                            try{
                                var items=[];
                                $.each(obj, function (i, val) {
                                    
                                    var templateView = '<?php echo base_url(); ?>templates/view_templates/' + val.TOKEN;
                                    var templateEdit = '<?php echo base_url(); ?>templates/templates_edit/' + val.TOKEN;
                                    var answerDownload = '<?php echo base_url(); ?>templates/answer_download/' + val.TOKEN;
                                    
                                    var textOnly = $(val.TEMPLATE_DESCRIPTION).text();
                                    var templateDetails = textOnly.substring(0, 120);
                                    
                                    var imageLocation = '<?php echo base_url();?>gears/front_dashboard/images/wwd2.png';
                                    
                                    var myModal = '#myModal_template_'+val.TEMP_ID;
                                    var catTitle = val.CATEGORY_TITLE;
                                    var subCatTitle = val.SUBCATEGORY_TITLE;
                                    var fullName = val.FIRST_NAME + ' ' +val.LAST_NAME;
                                    
                                    
                                    //items.push('<li><a href="'+ templateView +'"><div class="list-content"><span class="title">'+ val.TEMPLATE_TITLE +'</span><span class="caption">'+ templateDetails +'</span></div></a><a href=""><div class="list-action-right"><ul class="list-unstyled"><li><a href="'+ templateView +'" data-toggle="tooltip" title="view"><i class="fa fa-eye"></i></a></li><li><a href="'+ templateEdit +'" data-toggle="tooltip" title="Edit Template"><i class="fa fa-edit"></i></a></li></ul></div></a></li>');
                                items.push('<li><a href="'+templateView+'" target="_blank"><div class="list-action-left"><img src="'+imageLocation+'" alt="img"></div><div class="list-content" style="margin-right:0px;width: 95%;"><span class="title">'+ val.TEMPLATE_TITLE +'</span><span class="caption">'+ fullName +'</span></div></a><div class="list-action-right" style="top:0% !important;"><a href="'+templateView+'" target="_blank" data-toggle="tooltip" title="View"><i class="fa fa-eye" style="font-size:14px;"></i></a><a href="'+templateEdit+'" data-toggle="tooltip" title="Edit"><i class="fa fa-edit" style="font-size:14px;"></i></a><a href="'+answerDownload+'" data-toggle="tooltip" title="Download Answers" data-placement="top"><i class="fa fa-download" ></i></a><a href="#" data-toggle="modal" data-target="'+myModal+'"><i class="fa fa-times" style="font-size:14px;"></i></a></div></li>');
                                });
                            $('#finalResultTemplate').append.apply($('#finalResultTemplate'), items);
                            } catch (e) {
                                alert('Exception while request..');
                            }
                        } else {
                            //$('#finalResultTemplate').html('<div class="search-result panel"><h2>No Data Found</h2></div>');
                            $('#finalResultTemplate').html($('<li/>').text("No Data Found"));
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
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
</script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Define any icon actions before calling the toolbar
        <?php
        if(!empty($users)){
            foreach($users as $user){
                $userID = $user->user_id;
        ?>
        $('div[data-toolbar="user-option<?php echo $userID;?>"]').toolbar({
            content: '#user-options<?php echo $userID;?>',
            position: 'left',
            style: 'dark',
            event: 'click',
            hideOnClick: true
        });
        <?php }}
        
        if (!empty($templates)) {
            $count = 1;
            foreach ($templates as $templatesDET) {
                $temp_id = $templatesDET->temp_id;
        ?>
        $('div[data-toolbar="template-option<?php echo $temp_id;?>"]').toolbar({
            content: '#template-options<?php echo $temp_id;?>',
            position: 'left',
            style: 'dark',
            event: 'click',
            hideOnClick: true
        });
        <?php }}?>
    });
    
</script>

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


<div class="clearfix"></div>
<div class="row">
    <div class="col-sm-6">
        <div class="user-list <?php if($bootstropID9 >=0){?>bootstro<?php }?>" <?php if($bootstropID9 >=0){?>
                        data-bootstro-title='Users List' 
                        data-bootstro-content="Lists of all Created Users <br>
                        <strong>Search Icon</strong>(<i class='fa fa-search'></i>)<br>
                        Click it to open search box (<strong>Note </strong>: Users can be searched under Category, Subcategory, Username, First name, Last name, Email & Address.)
                        & <br>
                        <strong> Gear Icon</strong>(<div class='btn btn-toolbar-dark'><i class='fa fa-cog'></i></div>)<br>
                        Click it for Actions Like Edit, Delete"
                        data-bootstro-width="400px" 
                        data-bootstro-placement='right' data-bootstro-step='<?php echo $bootstropID9;?>'<?php }?>>
            <div class="sample">
                <h1><small><i class="fa fa-users"></i> </small> Users List 
                    <span class="pull-right">
                        <a data-toggle="collapse" href="#search-collapse" aria-expanded="false"><i class="fa fa-search"></i></a>
                    </span>
                </h1>
                <div class="collapse" id="search-collapse">
                    <form class="search-item">
                        <div class="input-group">
                            <input type="text" name="user_keywords" id="user_keywords" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div><!-- /input-group -->
                    </form>
                </div>
                <ul class="project-listings" id="finalResult">
                    <?php
                        if(!empty($users)){
                            foreach($users as $user){
                                $userID = $user->user_id;
                                $userTOKEN = $user->user_token;
                                $userCatID = $user->category_id;
                                $userSubCatID = $user->sub_cat_id;
                                $userNAME = $user->username;
                                $userFNAME = $user->first_name;
                                $userLNAME = $user->last_name;
                                $userFULLNAME = "$userFNAME $userLNAME";
                                $userEMAIL = $user->email;
                                $userADDRESS = $user->address;
                                $userIMAGE = $user->home_image;
                                if(!empty($userIMAGE)){
                                    $imagePath = "profile/$userIMAGE";
                                }else{
                                    $imagePath = "no-image.jpg";
                                }
                                $this->db->select("*");
                                $this->db->where('category_id', $userCatID);
                                $queryCategory = $this->db->get("tbl_category");
                                $resultCategory = $queryCategory->row();
                                        $catTitle = @$resultCategory->category_title;
                                $this->db->select("*");
                                $this->db->where('sub_cat_id', $userSubCatID);
                                $queryCategorySub = $this->db->get("tbl_category_sub");
                                $resultCategorySub = $queryCategorySub->row();
                                        $subCatTitle = @$resultCategorySub->subcategory_title;
                                        
                    ?>

                    <li>
                            <a href="<?php echo base_url("users/edit_user/$userTOKEN"); ?>">
                                <div class="list-action-left">
                                    <img src="<?php echo base_url(); ?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT; ?>uploads/<?php echo $imagePath; ?>&w=150&h=150" />

                                </div>
                                <div class="list-content" style="margin-right:0;padding: 15px;">
                                    <span class="title"><?php if(!empty($userFNAME)){ echo $userFULLNAME; }else{echo $userEMAIL;?> <span class="label label-warning">Pending</span><?php }?></span>
                                    <span class="caption"><?php if(!empty($catTitle)){echo $catTitle;} echo ', '; if(!empty($subCatTitle)){echo $subCatTitle;}?></span>
                                </div>
                            </a>
                            <div class="list-action-right">
                                <div id="user-options<?php echo $userID;?>" class="hidden">
                                   <a href="<?php echo base_url("users/edit_user/$userTOKEN");?>" ><i class="fa fa-edit" style="font-size:12px;"></i></a>
                                   <a href="#" data-toggle="modal" data-target="#myModal<?php echo "_users_$userID";?>"><i class="fa fa-times" style="font-size:12px;"></i></a>
                                </div>
                                <div class="btn-toolbar btn-toolbar-dark" id="button" data-toolbar="user-option<?php echo $userID;?>"><i class="fa fa-cog"></i></div>

                            </div>
                        </li>
<!--Old thing here-->
<!--
<a href='<?php echo base_url("users/edit_user/$userTOKEN"); ?>' data-toggle='tooltip' title='Edit User'><i class='fa fa-edit' style='font-size:14px;'></i></a>
<a href='#' data-toggle='modal' data-target='#myModal<?php echo "_users_$userID"; ?>'><i class='fa fa-times' style='font-size:14px;'></i></a>-->
<!--
<a data-container="body" data-toggle="popover" tabindex="0" role="button" data-trigger="focus" data-placement="left" data-content="<a href='<?php echo base_url("users/edit_user/$userTOKEN"); ?>' data-toggle='tooltip' title='Edit User'><i class='fa fa-edit'></i></a><br><a href='#' data-toggle='modal' data-target='#myModal<?php echo $user_id; ?>'><i class='fa fa-times'></i></a>">
<i class="fa fa-cog"></i>
</a>
-->
                    <?php }} ?>
                </ul>
            </div>
        </div>
    </div><!--/template list-->
    <div class="col-sm-6">
        <div class="temp-list <?php if($bootstropID10 >=0){?>bootstro<?php }?>" <?php if($bootstropID10 >=0){?>
                        data-bootstro-title='Template List' 
                        data-bootstro-content="Lists of all Created Templates <br>
                        <strong>Search Icon</strong>(<i class='fa fa-search'></i>)<br>
                        Click it to open search box (<strong>Note </strong>: Templates can be searched under Template Title, Tags keywords, Category, Subcategory, Username, First name, Last name & Email.)
                        & <br>
                        <strong> Gear Icon</strong>(<div class='btn btn-toolbar-dark'><i class='fa fa-cog'></i></div>)<br>
                        Click it for Actions Like Edit, Delete & view"
                        data-bootstro-width="600px" 
                        data-bootstro-placement='left' data-bootstro-step='<?php echo $bootstropID10;?>'<?php }?>>
            <div class="sample">
                <h1><small><i class="fa fa-list-ol"></i> </small> Templates List <span class="pull-right"><a data-toggle="collapse" href="#user-search-collapse" aria-expanded="false"><i class="fa fa-search"></i></small></a></h1>
                <div class="collapse" id="user-search-collapse">
                    <form class="search-item">
                        <div class="input-group">
                            <input type="text" name="template_keywords" id="template_keywords" class="form-control" placeholder="Search for...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                            </span>
                        </div><!-- /input-group -->
                    </form>
                </div>
                <ul class="project-listings" id="finalResultTemplate">
                    <?php
                            if (!empty($templates)) {
                                $count = 1;
                                foreach ($templates as $templatesDET) {
                                    $temp_id = $templatesDET->temp_id;
                                    $category_id = $templatesDET->category_id;
                                    $sub_cat_id = $templatesDET->sub_cat_id;
                                    $userIDs = $templatesDET->user_id;
                                    $templateTITLE = $templatesDET->template_title;
                                    $templatePATHs = $templatesDET->template_path;
                                    $templateTOKEN = $templatesDET->token;
                                    $status = $templatesDET->status;

                                    $this->db->select("*");
                                    $this->db->where("user_id", $userIDs);
                                    $queryUsers = $this->db->get("tbl_users");
                                    $resultUsers = $queryUsers->row();

                                    $userFirstName = @$resultUsers->first_name;
                                    $userLastName = @$resultUsers->last_name;
                                    $userFullName = "$userFirstName $userLastName";
                        ?>
                        <li>
                                <div class="list-action-left">
                                    <img src="<?php echo base_url(); ?>gears/front_dashboard/images/wwd2.png" alt="img">
                                </div>
                                <div class="list-content">
                                    <a href="<?php echo base_url("templates/view_templates/$templateTOKEN"); ?>" target="_blank">
                                        <span class="title"><?php echo $templateTITLE;?></span>
                                        <span class="caption"><?php echo $userFullName;?></span>
                                    </a>
                                    <a href="<?php echo base_url("templates/generate_qrcode/$templateTOKEN");?>" ><i class="fa fa-qrcode fa-2x"></i></a>
                                </div>
                            
                            <div class="list-action-right">
                                <!--itoolbar options-->
                                <div id="template-options<?php echo $temp_id;?>" class="hidden">
                                   <a href="<?php echo base_url("templates/view_templates/$templateTOKEN"); ?>" target="_blank" data-toggle='tooltip' title='View' data-placement='left'><i class="fa fa-eye" style="font-size:12px;"></i></a>
                                   <a href='<?php echo base_url("templates/templates_edit/$templateTOKEN");?>' data-toggle='tooltip' title='Edit' data-placement='left'><i class="fa fa-edit" style="font-size:12px;"></i></a>
                                   <a href='<?php echo base_url("templates/answer_download/$templateTOKEN");?>' data-toggle='tooltip' title='Download Answers' data-placement='top'><i class="fa fa-download" ></i></a>
                                   <a href='#' data-toggle='modal' data-target='#myModal<?php echo "_template_$temp_id";?>'><i class="fa fa-times" style="font-size:12px;"></i></a>
                                </div>
                                <div class="btn-toolbar btn-toolbar-dark" id="button" data-toolbar="template-option<?php echo $temp_id;?>"><i class="fa fa-cog"></i></div>

                                <!--Old things here-->
                                <!--<a href="<?php echo base_url("templates/view_templates/$templateTOKEN"); ?>" target="_blank" data-toggle="tooltip" title="View"><i class="fa fa-eye" style='font-size:14px;'></i></a>
                                <a href='<?php echo base_url("templates/templates_edit/$templateTOKEN");?>' data-toggle='tooltip' title='Edit'><i class='fa fa-edit' style='font-size:14px;'></i></a>
                                <a href='#' data-toggle='modal' data-target='#myModal<?php echo "_template_$temp_id";?>'><i class='fa fa-times' style='font-size:14px;'></i></a>-->
                            </div>
                        </li>

                    <?php }} ?>
                </ul>
            </div>
        </div>
    </div><!--/template list-->
</div><!--/list template info-->


<?php
        if (!empty($users)) {
            foreach ($users as $usersDETAILS) {
                $user_idss = $usersDETAILS->user_id;
                $user_tokenss = $usersDETAILS->user_token;
                $first_namess = $usersDETAILS->first_name;
                $last_namess = $usersDETAILS->last_name;
                $userFULL_NAMEss = "$first_namess $last_namess";
    ?>
    <!-- Modal -->
        <div class="modal fade" id="myModal<?php echo "_users_$user_idss";?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">User Delete Information</h4>
              </div>
              <div class="modal-body">
                  Are you sure to delete the user <strong><?php echo $userFULL_NAMEss;?></strong>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="<?php echo base_url("users/delete_user/$user_tokenss");?>" class="btn btn-danger">Delete</a>
              </div>
            </div>
          </div>
        </div>
    <?php
            }
        }
    ?>

    
    <?php
    if (!empty($templates)) {
        foreach ($templates as $templatesDET) {
            $temp_id1 = $templatesDET->temp_id;
            $userIDs1 = $templatesDET->user_id;
            $templateTITLE1 = $templatesDET->template_title;
            $templatePATHs1 = $templatesDET->template_path;
            $templateTOKEN1 = $templatesDET->token;
            $status1 = $templatesDET->status;

            $this->db->select("*");
            $this->db->where("user_id", $userIDs1);
            $queryUsers1 = $this->db->get("tbl_users");
            $resultUsers1 = $queryUsers1->row();

            $userFirstName1 = @$resultUsers1->first_name;
            $userLastName1 = @$resultUsers1->last_name;
            $userFullName1 = "$userFirstName1 $userLastName1";
            ?>
            <!-- Modal -->
            <div class="modal fade" id="myModal<?php echo "_template_$temp_id1"; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Template Delete Information</h4>
                        </div>
                        <div class="modal-body">
                            Are you sure to delete the Template <strong><?php echo $templateTITLE1; ?> of User <?php echo $userFullName1; ?> </strong>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <a href="<?php echo base_url("templates/templates_delete/$templateTOKEN"); ?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    }
    ?>