<script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/jquery.slugit.js"></script>
<script>
$(document).ready(function () {
    $('#level_name').slugIt({
        output: '#level_slug',
        separator: '-'
    });$('#level_name').keyup();

//    $(".select2_board").select2({
//        placeholder: "Select Board",
//        allowClear: true
//    });
//    $(".select2_type").select2({
//        placeholder: "Select Level Type",
//        allowClear: true
//    });
});
</script>
<?php $isEdit = isset($details)?true:false;?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3><?php echo $page_title;?></h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <form action="" method="post" name="addEditform" id="addEditform" class="form-horizontal form-label-left form-validate" >
                        
                        <span class="section">Please Complete the information below</span>

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level_board">Level Board<span class="required" style="color: #a94442;"><strong> *</strong></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="board_id" id="board_id" class='form-control' data-rule-required="true">
                                    <option value="">-- Select Board --</option>
                                    <?php
                                        foreach($board as $boardList){
                                            $boardID = $boardList->board_id;
                                            $boardName = $boardList->board_name;
                                    ?>
                                    <option value="<?php echo $boardID;?>" <?php if (($isEdit) && ($details->board_id == $boardID)){echo "selected";}?>> <?php echo ucfirst($boardName);?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level_type">Level Type<span class="required" style="color: #a94442;"><strong> *</strong></span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="level_type"  id="level_type" class='form-control' data-rule-required="true">
                                    <option value="">-- Select Type --</option>
                                    <option value="academic" <?php if (($isEdit) && ($details->level_type == 'academic')){echo "selected";}?>> Academic </option>
                                    <option value="general" <?php if (($isEdit) && ($details->level_type == 'general')){echo "selected";}?>> General</option>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Level Name<span class="required" style="color: #a94442;"><strong> *</strong></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="level_name" id="level_name" value="<?php if (@$isEdit) {echo $details->level_name;}?>" class="form-control col-md-7 col-xs-12" placeholder="Level Name" data-rule-required="true" data-rule-minlength="2" data-rule-letterswithbasicpunc='true'>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Level Slug
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="level_slug" id="level_slug" value="<?php if (@$isEdit) {echo $details->level_slug;}?>" class="form-control col-md-7 col-xs-12" readonly>
                            </div>
                        </div>
                                              
                                                                        
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="order">Order</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" placeholder="Only numbers" name="order" value="<?php if(!empty($order)){ echo ($order->order)+1 ;} if (@$isEdit) echo $details->order; ?>" id="numberfield" data-rule-number="true" class="form-control" data-rule-required="true" data-rule-integer='true'>
                                </div>
                        </div>
                        
                                             

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="status" id="select" class='form-control' data-rule-required="true">
                                    <option value="">--Select Status--</option>
                                    <option value="1" <?php if (($isEdit) && ($details->status == '1')){echo "selected";}else{echo "selected";}?>> Active </option>
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