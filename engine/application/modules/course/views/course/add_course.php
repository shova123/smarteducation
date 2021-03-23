<script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/jquery.slugit.js"></script>
<script>
    $(function () {
        $('#course_name').slugIt({
            output: '#course_slug',
            separator: '-',
        });
        $('#course_name').keyup();
    });
</script>
<script>
    function setLevel(chosen) {
        var selbox = document.addEditform.stream_id;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select Stream--','');
        }
        selbox.options[selbox.options.length] = new Option('--Select Stream--','');
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
}
</script>


<script>
$(document).ready(function () {
    $(".select2_stream").select2({
        placeholder: "Select Stream",
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
                                <select name="level_id" id="level_id" class='select2_level form-control' tab-index="-1" data-rule-required="true" onchange="setLevel(document.addEditform.level_id.options[ document.addEditform.level_id.selectedIndex].value);" >
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stream_id">Stream<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="stream_id" id="stream_id" class='form-control'  data-rule-required="true">
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Course Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="course_name" id="course_name" value="<?php if (@$isEdit) {echo $details->course_name;}?>" class="slug_name form-control col-md-7 col-xs-12" placeholder="Course Name" data-rule-required="true" data-rule-minlength="2">
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Course Slug
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="course_slug" id="course_slug" value="<?php if (@$isEdit) {echo $details->course_slug;}?>" class="form-control col-md-7 col-xs-12" readonly>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Course Alias<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="course_alias" id="course_alias" value="<?php if (@$isEdit) {echo $details->course_alias;}?>" class="form-control col-md-7 col-xs-12" placeholder="Course Alias" data-rule-required="true" data-rule-minlength="2">
                            </div>
                        </div>               
                                                                        
<!--                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Order</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" placeholder="Only numbers" name="order" value="<?php if (@$isEdit) echo $details->department_order; ?>" id="numberfield" data-rule-number="true" class="form-control" data-rule-required="true">
                                </div>
                        </div>-->
                       <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Year</label>
                           
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="year" id="year" class='form-control'>
                                    <option value="" selected="selected">---Select Year---</option>
                                    <?php if($isEdit){
                                        $streamed=$this->db->query("select * from hya_course_stream where stream_id=$details->stream_id")->row();
                                        $year=$streamed->year;
                                        for($i=1;$i<=$year;$i++){
                                            ?>
                                    <option <?php if (($isEdit) && ($details->year ==  $i)){echo "selected";}?> value="<?php echo $i;?>"><?php echo $i;?></option>
                                    <?php
                                        }
                                    }?>
                                    
                                  </select>
                            </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Select Semester</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="semester" id="semester" class='select2_single form-control'>
                                    <option value="" selected="selected">---Select Semester---</option>
                                       <?php if($isEdit){
                                        $streamed=$this->db->query("select * from hya_course_stream where stream_id=$details->stream_id")->row();
                                        $semester=$streamed->semester;
                                        for($j=1;$j<=$semester;$j++){
                                            ?>
                                    <option <?php if (($isEdit) && ($details->semester ==  $j)){echo "selected";}?> value="<?php echo $j;?>"><?php echo $j;?></option>
                                    <?php
                                        }
                                    }?>
                                  </select>
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
<script>
$(function() { //run on document.ready
  $("#stream_id").change(function() { //this occurs when select 1 changes
        
        $.ajax({
            method: "post",
            dataType:'json',
            data: {'stream_id': $(this).val()},
            url: "<?php echo base_url(); ?>course/ajaxSelectYear",
            beforeSend: function () {
                $(".loader-image").show();
            },
            success: function (data) {
                //console.log(data.yearOption);
                var yearOption='';
                var semesterOption='';
                if(data.yearOption !==0){
                    yearOption +="<option value=''>Select Year</option>";
                        for(var i=1;i<=data.yearOption;i++){
                            yearOption +="<option value="+i+">"+i+"</option>";
                            // console.log(i);
                        }
//                        i = i-1;
//                        yearOption +="<option value="+i+">"+i+"</option>";
        
                }
                if(data.semesterOption !==0){
                    semesterOption +="<option value=''>Select Semester</option>";
                        for(var j=1;j<=data.semesterOption;j++){
                            semesterOption +="<option value="+j+">"+j+"</option>";
                        }
//                        j = j-1;
//                        semesterOption +="<option value="+j+">"+j+"</option>";
                }
                
                $("#year").html(yearOption);
                $("#semester").html(semesterOption);
            }

        });
        
  });
  });
</script>