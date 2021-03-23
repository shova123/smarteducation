<script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/jquery.slugit.js"></script>
<script>
    $(function () {
        $('#stream_name').slugIt({
            output: '#stream_slug',
            separator: '-',
        });
        $('#stream_name').keyup();
    });
</script>

<script>
$(document).ready(function () {
    $(".select2_level").select2({
        placeholder: "Select Level(Board)",
        allowClear: true
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="level_id">Level<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="level_id" id="level_id" class='form-control' data-rule-required="true">
                                    <option value="" selected="selected">---Select Level---</option>
                                    <?php
                                        foreach($level as $levelList){
                                            $board_id = $levelList->board_id;
                                            $levelID = $levelList->level_id;
                                            $levelName = $levelList->level_name;
                                            
                                            $this->db->select('*');
                                            $this->db->where('board_id' ,$board_id); 
                                            $queryBoard = $this->db->get("course_board"); 
                                            $resultBoard = $queryBoard->row(); 
                                            $boardName = @$resultBoard->board_name;
                                                
                                    ?>              
                                    <option value="<?php echo $levelID;?>" <?php if (($isEdit) && ($details->level_id == $levelID)){echo "selected";}?>> <?php echo ucfirst($levelName); if(!empty($boardName)){echo "($boardName)";}?></option>
                                    <?php }?>
                                    
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Stream Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="stream_name" id="stream_name" value="<?php if (@$isEdit) {echo $details->stream_name;}?>" class="form-control col-md-7 col-xs-12" placeholder="Stream Name" data-rule-required="true" data-rule-minlength="2">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Stream Slug
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="stream_slug" id="stream_slug" value="<?php if (@$isEdit) {echo $details->stream_slug;}?>" class="form-control col-md-7 col-xs-12" readonly>
                            </div>
                        </div>
                                              
                                                                        
<!--                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Order</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" placeholder="Only numbers" name="order" value="<?php if (@$isEdit) echo $details->order; ?>" id="numberfield" data-rule-number="true" class="form-control" data-rule-required="true">
                                </div>
                        </div>
                        -->
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Year</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <!--<input type="number" placeholder="Only numbers" name="year" value="<?php if (@$isEdit) echo $details->year; ?>" id="numberfield" data-rule-number="true" class="form-control" data-rule-required="true">-->
                                    <select name="year" id="year" class='select2_single form-control' tabindex="-1" >
                                        <option value="" selected="selected">---Select Year---</option>
                                        <?php
                                        if(!empty($isEdit)){
                                            $coursed=$this->db->query("select * from hya_course_stream where stream_id=$details->stream_id")->row();
                                        $year=$coursed->year;
                                        if(!empty($year)){$year = $year;}else{$year = 10;}
                                        }else{
                                            $year = 10;
                                        }
                                        ?>
                                        <?php //$year = 10;?>
                                        <?php for($y=1;$y<=$year;$y++){?>
                                            <option value="<?php echo $y;?>" <?php if (($isEdit) && ($details->year == $y)){echo "selected";}?>> <?php echo $y;?> </option>
                                        <?php }?>
                                    </select>
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Semester</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <!--<input type="number" placeholder="Only numbers" name="semester" value="<?php if (@$isEdit) echo $details->semester; ?>" id="numberfield" data-rule-number="true" class="form-control" >-->
                                    <select name="semester" id="semester" class='select2_single form-control' tabindex="-1" >
                                        <option value="" selected="selected">---Select Semester---</option>
                                        <?php
                                        if(!empty($isEdit)){
                                            $streamed=$this->db->query("select * from hya_course_stream where stream_id=$details->stream_id")->row();
                                        $semester=$streamed->semester;
                                        if(!empty($semester)){$semester = $semester;}else{$semester = 10;}
                                        }else{
                                            $semester =10;
                                        }
                                        
                                        ?>
                                        <?php for($s=1;$s<=$semester;$s++){?>
                                            <option value="<?php echo $s;?>" <?php if (($isEdit) && ($details->semester == $s)){echo "selected";}?>> <?php echo $s;?> </option>
                                        <?php }?>
                                        
                                    </select>
                                </div>
                        </div>                  

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="status" id="select" class='form-control' data-rule-required="true">
                                    <option value="">--Select Status--</option>
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