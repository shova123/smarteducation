<script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/jquery.slugit.js"></script>
<script>
    $(function () {
        $('#page_title').slugIt({
            output: '#page_slug',
            separator: '_',
        });
        $('#page_title').keyup();
    });
</script>
<script>
    function setLevel(chosen) {
        var selbox = document.addEditform.stream_id;
        var selboxCourse = document.addEditform.course_id;
        selbox.options.length = 0;
        selboxCourse.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select Stream--',' ');
            selboxCourse.options[selboxCourse.options.length] = new Option('--Select Course--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Stream--',' ');
        selboxCourse.options[selboxCourse.options.length] = new Option('--Select Course--',' ');
        <?php
        if (!empty($stream)) {
            foreach ($stream as $allStream) {
                $s_level_id = $allStream->level_id;
                $stream_id = $allStream->stream_id;
                $stream_name = $allStream->stream_name;
      
        ?>
                                                                                
        if (chosen == "<?php echo $s_level_id?>") {
            selbox.options[selbox.options.length] = new Option('<?php echo $stream_name; ?>','<?php echo $stream_id; ?>');
        }
        <?php
            }
        }
        ?>
                
        <?php
        if (!empty($course)) {
            foreach ($course as $c) {
                $c_level_id = $c->level_id;
                $c_stream_id = $c->stream_id;
                $course_id=$c->course_id;
                $course_name = $c->course_name;
      
        ?>
                                                                                
        if (chosen == "<?php echo $c_level_id?>") {
            selboxCourse.options[selboxCourse.options.length] = new Option('<?php echo $course_name; ?>','<?php echo $course_id; ?>');
        }
        <?php
            }
        }
        ?>
        
    }
       function setStream(chosen) {
        var selbox = document.addEditform.course_id;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select Course--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Course--',' ');
        <?php
        if (!empty($course)) {
            foreach ($course as $c) {
                $c_level_id = $c->level_id;
                $c_stream_id = $c->stream_id;
                $course_id=$c->course_id;
                $course_name = $c->course_name;
      
        ?>
                                                                                
        if (chosen == "<?php echo $c_stream_id?>") {
            selbox.options[selbox.options.length] = new Option('<?php echo $course_name; ?>','<?php echo $course_id; ?>');
        }
        <?php
    }
}
?>
        
    }
</script>


<script>
$(document).ready(function () {
    $(".select2_stream").select2({
        placeholder: "Select Stream",
        allowClear: true
    });
    $(".select2_level").select2({
        placeholder: "Select Level",
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
                                <select name="level_id" id="level_id" class=' form-control' data-rule-required="true" onchange="setLevel(document.addEditform.level_id.options[ document.addEditform.level_id.selectedIndex].value);" >
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stream_id">Stream <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="stream_id" id="stream_id" class=' form-control' onchange="setStream(document.addEditform.stream_id.options[ document.addEditform.stream_id.selectedIndex].value);"  data-rule-required="true">
                                    <option value="" selected="selected">---Select Stream---</option>
                                    <?php
                                    if($isEdit){
                                    if (!empty($stream)) {
                                        foreach ($stream as $allstreams) {
                                            $streamLevelID = $allstreams->level_id;
                                            $streamID = $allstreams->stream_id;
                                            $streamNAME = $allstreams->stream_name;
                                            if($details->level_id == $streamLevelID){
                                    ?>
                                    <option value="<?php echo $streamID;?>" <?php if ($details->stream_id == "$streamID"){echo "selected";}?>> <?php echo ucfirst($streamNAME);?></option>
                                    <?php }}}}?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stream_id">Course </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="course_id" id="course_id" class=' form-control'>
                                    <option value="" selected="selected">---Select Course---</option>
                                    <?php
                                    if($isEdit){
                                    if (!empty($course)) {
                                        foreach ($course as $allcourse) {
                                            $courseID = $allcourse->course_id;
                                            $courseLevelID = $allcourse->level_id;
                                            $courseStreamID = $allcourse->stream_id;
                                            $courseNAME = $allcourse->course_name;
                                            if($details->stream_id == $courseStreamID){
                                    ?>
                                    <option value="<?php echo $courseID;?>" <?php if ($details->course_id == "$courseID"){echo "selected";}?>> <?php echo ucfirst($courseNAME);?></option>
                                    <?php }}}}?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Department Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="department_name" id="page_title" value="<?php if (@$isEdit) {echo $details->department_name;}?>" class="slug_name form-control col-md-7 col-xs-12" placeholder="Department Name" data-rule-required="true" data-rule-minlength="2">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Department Slug
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="department_slug" id="page_slug" value="<?php if (@$isEdit) {echo $details->department_slug;}?>" class="form-control col-md-7 col-xs-12" readonly>
                            </div>
                        </div>
                                              
                                                                        
<!--                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Order</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" placeholder="Only numbers" name="order" value="<?php if (@$isEdit) echo $details->department_order; ?>" id="numberfield" data-rule-number="true" class="form-control" data-rule-required="true">
                                </div>
                        </div>-->
<!--                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Year</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" placeholder="Only numbers" name="year" value="<?php if (@$isEdit) echo $details->year; ?>" id="numberfield" data-rule-number="true" class="form-control" data-rule-required="true">
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Semester</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="number" placeholder="Only numbers" name="semester" value="<?php if (@$isEdit) echo $details->semester; ?>" id="numberfield" data-rule-number="true" class="form-control" data-rule-required="true">
                                </div>
                        </div>-->
                        
                                             

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