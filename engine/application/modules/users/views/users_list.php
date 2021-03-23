<?php
function shorten_string($string, $wordsreturned){
    $retval = $string; // Just in case of a problem
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
        $("#user_keywords").keyup(function(){
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
                                    var myModal = '#myModal'+val.USER_ID;
                                    var catTitle = val.CATEGORY_TITLE;
                                    var subCatTitle = val.SUBCATEGORY_TITLE;
                                    //var textOnly = $(val.TEMPLATE_DESCRIPTION).text();
                                    //var templateDetails = textOnly.substring(0, 160);
                                    
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
    });
</script>
<script type="text/javascript">
$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').focus()
})
</script>
<style>
    .temp-list{
        color :#000;
    }
</style>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        // Define any icon actions before calling the toolbar
        <?php
        if (!empty($users)) {
            $countusers = 1;
            foreach ($users as $usersDETAILS) {
                $user_id = $usersDETAILS->user_id;
        ?>
        $('div[data-toolbar="user-option<?php echo $user_id;?>"]').toolbar({
            content: '#user-options<?php echo $user_id;?>',
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
                <h1><small><i class="fa fa-list-ol"></i> </small> Users List
                    <div class="pull-right">
                        <div class="btn-group <?php if(@$bootstropIDA1 >=0){?>bootstro<?php }?>" <?php if(@$bootstropIDA1 >=0){?>
                        data-bootstro-title='Click To Create New User' 
                        data-bootstro-content="You can create new User"
                        data-bootstro-width="200px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropIDA1;?>'<?php }?>>
                            <a class="btn btn-primary" href="<?php echo base_url('users/create_user') ?>">Create Users <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </h1>
                <form class="search-item">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span>
                        <input type="text" name="user_keywords" id="user_keywords" class="form-control" placeholder="Search for...">
                    </div><!-- /input-group -->
                </form>
                <ul class="project-listings" id="finalResult">
                    <?php
                    if (!empty($users)) {
                        $countusers = 1;
                        foreach ($users as $usersDETAILS) {
                            $user_id = $usersDETAILS->user_id;
                            $user_token = $usersDETAILS->user_token;
                            $c_user_id = $usersDETAILS->c_user_id;
                            $category_id = $usersDETAILS->category_id;
                            $sub_cat_id = $usersDETAILS->sub_cat_id;
                            $username = $usersDETAILS->username;
                            $first_name = $usersDETAILS->first_name;
                            $last_name = $usersDETAILS->last_name;
                            $userFULL_NAME = "$first_name $last_name";
                            $email = $usersDETAILS->email;
                            $phone = $usersDETAILS->phone;
                            $address = $usersDETAILS->address;
                            $lat = $usersDETAILS->lat;
                            $lng = $usersDETAILS->lng;
                            $userIMAGE = $usersDETAILS->home_image;
                                if(!empty($userIMAGE)){
                                    $imagePath = "profile/$userIMAGE";
                                }else{
                                    $imagePath = "no-image.jpg";
                                }
                            $active = $usersDETAILS->active;
                            $created_on = $usersDETAILS->created_on;
                            $last_login = $usersDETAILS->last_login;
                            $sent_email = $usersDETAILS->sent_email;
                            $last_update = $usersDETAILS->last_update;
                            
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
                                <a href="<?php echo base_url("users/edit_user/$user_token"); ?>">
                                    <div class="list-action-left">
                                        <img src="<?php echo base_url();?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT;?>uploads/<?php echo $imagePath;?>&w=150&h=150" />
                                        
                                    </div>
                                    <div class="list-content" style="margin-right:0;padding: 15px;">
                                        <span class="title"><?php if(!empty($first_name)){echo $userFULL_NAME;}else{echo $email;?> <span class="label label-warning">Pending</span><?php } ?></span>
                                        <span class="caption"><?php if(!empty($catTitle)){echo $catTitle;} echo ', '; if(!empty($subCatTitle)){echo $subCatTitle;}?></span>
                                        <!--<span class="caption">
                                            <1?php echo strip_tags(shorten_string($templateDESCRIPTION, 120)); ?>
                                        </span>-->
                                    </div>
                                </a>
                                <div class="list-action-right">
                                    <div id="user-options<?php echo $user_id;?>" class="hidden">
                                       <a href="<?php echo base_url("users/edit_user/$user_token");?>" ><i class="fa fa-edit" style="font-size:12px;"></i></a>
                                       <a href="#" data-toggle="modal" data-target="#myModal<?php echo $user_id;?>"><i class="fa fa-times" style="font-size:12px;"></i></a>
                                    </div>
                                    <div class="btn-toolbar btn-toolbar-dark" id="button" data-toolbar="user-option<?php echo $user_id;?>"><i class="fa fa-cog"></i></div>

                                </div>
<!--                                <div class="list-action-right" style='top:0% !important;'>
                                    <a href='<?php echo base_url("users/edit_user/$user_token");?>' data-toggle='tooltip' title='Edit User'><i class='fa fa-edit' style='font-size:14px;'></i></a>
                                    <a href='#' data-toggle='modal' data-target='#myModal<?php echo $user_id;?>'><i class='fa fa-times' style='font-size:14px;'></i></a>
                                    <a data-container="body" data-toggle="popover" tabindex="0" role="button" data-trigger="focus" data-placement="left" data-content="<a href='<?php echo base_url("users/edit_user/$user_token");?>' data-toggle='tooltip' title='Edit User'><i class='fa fa-edit'></i></a><br><a href='#' data-toggle='modal' data-target='#myModal<?php echo $user_id;?>'><i class='fa fa-times'></i></a>">
                                        <i class="fa fa-cog"></i>
                                    </a>
                                </div>-->
                            </li>
                    <?php
                        $countusers++;}
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div><!--/template list-->
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
        <div class="modal fade" id="myModal<?php echo $user_idss;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
    <?php $this->load->view("include_dashboard/alert-message");?>
</div><!--/list template info-->


<!-- Button trigger modal -->


