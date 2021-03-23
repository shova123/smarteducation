<?php 

  function shorten_string($string, $wordsreturned)
    /* Returns the first $wordsreturned out of $string. If string
    contains more words than $wordsreturned, the entire string
    is returned.*/
    {
    $retval = $string; // Just in case of a problem
    $array = explode(" ", $string);
    /* Already short enough, return the whole thing*/
    if (count($array)<=$wordsreturned)
    {
    $retval = $string;
    }
    /* Need to chop of some words*/
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
        $("#group_keywords").keyup(function(){
//            if($("#group_keywords").val().length>3){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("users/search_groups");?>",
                    cache: false,
                    data:'group_keywords='+$("#group_keywords").val(),
                    success: function(response){
                        $('#finalResult').html("");
                        var obj = JSON.parse(response);
                        
                        if(obj.length>0){
                            try{
                                var items=[];
                                $.each(obj, function (i, val) {
                                    var groupEdit = '<?php echo base_url();?>users/edit_group/' + val.GROUP_ID;
                                    var name = val.NAME;
                                    var textOnly = $(val.DESCRIPTION).text();
                                    var groupInfo = textOnly.substring(0,120);
                                    var imageLocation = '<?php echo base_url();?>gears/front/images/wwd2.png';
                                    
                                    var myModal = '#myModal_group_'+val.GROUP_ID;
                                    
                                    //items.push('<li><a href="'+ templateView +'"><div class="list-content"><span class="title">'+ val.TEMPLATE_TITLE +'</span><span class="caption">'+ templateDetails +'</span></div></a><a href=""><div class="list-action-right"><ul class="list-unstyled"><li><a href="'+ templateView +'" data-toggle="tooltip" title="view"><i class="fa fa-eye"></i></a></li><li><a href="'+ templateEdit +'" data-toggle="tooltip" title="Edit Template"><i class="fa fa-edit"></i></a></li></ul></div></a></li>');
                                items.push('<li><a href="'+groupEdit+'"><div class="list-action-left"><img src="'+imageLocation+'" alt="img"></div><div class="list-content" style="margin-right:0px;width: 95%;"><span class="title">'+name+'</span><span class="caption">'+ groupInfo +'</span></div></a><div class="list-action-right" style="top:0% !important;"><a href="'+groupEdit+'" data-toggle="tooltip" title="Edit"><i class="fa fa-edit" style="font-size:14px;"></i></a><a href="#" data-toggle="modal" data-target="'+myModal+'"><i class="fa fa-times" style="font-size:14px;"></i></a></div></li>');
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
        if (!empty($groups)) {
            $countusers = 1;
            foreach ($groups as $group) {
                $groupID = $group->group_id;
        ?>
        $('div[data-toolbar="group-option<?php echo $groupID;?>"]').toolbar({
            content: '#group-options<?php echo $groupID;?>',
            position: 'left',
            style: 'dark',
            event: 'click',
            hideOnClick: true
        });
        <?php }}?>
    });
    
</script>
<!--<script>
    $(document).ready(function(){
        $("#group_keywords").keyup(function(){
            if($("#group_keywords").val().length>3){
                $.ajax({
                    type: "POST",
                    url: "<?php echo base_url("users/search_groups"); ?>",
                    cache: false,
                    data:'group_keywords='+$("#group_keywords").val(),
                    success: function(response){
                        $('#finalResult').html("");
                        var obj = JSON.parse(response);
                        
                        if(obj.length>0){
                            try{
                                var items=[];
                                $.each(obj, function (i, val) {
                                    var groupEdit = '<?php echo base_url(); ?>users/edit_group/' + val.GROUP_ID;
                                    //var groupDelete = '<?php echo base_url(); ?>users/delete_group/' + val.GROUP_ID;
                                    var name = val.NAME;
                                    var textOnly = $(val.DESCRIPTION).text();
                                    var groupInfo = textOnly.substring(0,120);
                                items.push('<li><a href="'+groupEdit+'"><div class="list-action-left"><img src="'+imageLocation+'" alt="img"></div><div class="list-content" style="margin-right:0px;width: 95%;"><span class="title">'+name+'</span><span class="caption">'+ groupInfo +'</span></div></a><div class="list-action-right" style="top:0% !important;"><a href="'+groupEdit+'" data-toggle="tooltip" title="Edit"><i class="fa fa-edit" style="font-size:14px;"></i></a><a href="#" data-toggle="modal" data-target="'+myModal+'"><i class="fa fa-times" style="font-size:14px;"></i></a></div></li>');
                                
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
            }
            return false;
        });
    });

</script>-->

<div class="clearfix"></div>
<div class="row">
    <div class="col-sm-12">
        <div class="temp-list">
            <div class="sample">
                <h1><small><i class="fa fa-list-ol"></i> </small> Group Lists
                <div class="pull-right">
                        <div class="btn-group <?php if(@$bootstropIDA3 >=0){?>bootstro<?php }?>" <?php if(@$bootstropIDA3 >=0){?>
                        data-bootstro-title='Click To Create New Group' 
                        data-bootstro-content="You can create new Group"
                        data-bootstro-width="200px" 
                        data-bootstro-placement='bottom' data-bootstro-step='<?php echo @$bootstropIDA3;?>'<?php }?>>
                            <a class="btn btn-primary" href="<?php echo base_url('users/create_group') ?>"><?php echo lang('index_create_group_link');?> <i class="fa fa-plus"></i></a>
                        </div>
                    </div>
                </h1>
                    
                <form class="search-item">
                    <div class="input-group">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                        </span>
                        <input type="text" name="group_keywords" id="group_keywords" class="form-control" placeholder="Search for...">
                    </div><!-- /input-group -->
                </form>
                <ul class="project-listings" id="finalResult">
                    <?php
                    if (!empty($groups)) {
                        $countusers = 1;
                        foreach ($groups as $group) {
                            $groupID = $group->group_id;
                            $name = $group->name;
                            $groupType = $group->group_type;
                            $description = $group->description;
                    ?>
                           
                            <li>
                                <a href="<?php echo base_url("users/edit_group/$groupID"); ?>">
                                    <div class="list-action-left">
                                        <img src="<?php echo base_url(); ?>gears/front/images/wwd2.png" alt="img">
                                    </div>
                                    <div class="list-content" style="margin-right:0px;width: 95%;">
                                        <span class="title"><?php echo $name; ?></span>
                                        <span class="caption">
                                            <?php echo strip_tags(shorten_string($description, 120)); ?>
                                        </span>
                                    </div>
                                </a>
                                
                                <div class="list-action-right">
                                    <div id="group-options<?php echo $groupID;?>" class="hidden">
                                       <a href="<?php echo base_url("users/edit_group/$groupID");?>" ><i class="fa fa-edit" style="font-size:12px;"></i></a>
                                       <a href="#" data-toggle="modal" data-target="#myModal<?php echo "_group_$groupID";?>"><i class="fa fa-times" style="font-size:12px;"></i></a>
                                    </div>
                                    <div class="btn-toolbar btn-toolbar-dark" id="button" data-toolbar="group-option<?php echo $groupID;?>"><i class="fa fa-cog"></i></div>

                                </div>
                                
<!--                                <div class="list-action-right" style='top:0% !important;'>
                                    <a href='<?php echo base_url("users/edit_group/$groupID");?>' data-toggle='tooltip' title='Edit'><i class='fa fa-edit' style='font-size:14px;'></i></a>
                                    <a href='#' data-toggle='modal' data-target='#myModal<?php echo "_group_$groupID";?>'><i class='fa fa-times' style='font-size:14px;'></i></a>
                                </div>-->
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div><!--/template list-->
    <?php $this->load->view("include_dashboard/alert-message");?>
</div><!--/list template info-->
<?php
    if (!empty($groups)) {
    $countusers = 1;
    foreach ($groups as $group) {
        $groupIDs = $group->group_id;
        $name = $group->name;
        $groupType = $group->group_type;
        $description = $group->description;
?>
    <!-- Modal -->
        <div class="modal fade" id="myModal<?php echo "_group_$groupIDs";?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Group Delete Information</h4>
              </div>
              <div class="modal-body">
                  Are you sure to delete the Group <strong><?php echo $name;?></strong>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a href="<?php echo base_url("users/delete_group/$groupIDs");?>" class="btn btn-danger">Delete</a>
              </div>
            </div>
          </div>
        </div>
    <?php
            }
        }
    ?>