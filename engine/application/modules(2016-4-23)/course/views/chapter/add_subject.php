<script type="text/javascript" src="<?php echo base_url();?>gears/admin/js/jquery.slugit.js"></script>
<!--<script>
    $(document).on('keyup', '.slug_name', function(){
        var f_name = document.getElementById("first_name").value.toLowerCase();
        var l_name = document.getElementById("last_name").value.toLowerCase();
        var text = f_name + "_" + l_name;
        $("#username").val(text);     
    });
</script>-->
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
    function setOptions(chosen) {
        var selbox = document.addEditform.page_name;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = 
                new Option('--Select--',' ');

        }
        <?php
        if (!empty($all_pages)) {
            foreach ($all_pages as $allPage) {
                $page_title = $allPage->page_title;
        ?>
                                                                                
        if (chosen == "subcontent" || chosen == "subcontentvideo" || chosen == "subcontentpricing") {
        <?php $page_slug = $allPage->page_slug;?>
            selbox.options[selbox.options.length] = new Option('<?php echo $page_title; ?>','<?php echo $page_slug; ?>');
        }
        <?php
    }
}
?>
        
    }
</script>
<script>
$(document).ready(function(){
        $('#page_type').change(function(){
            var typeVal = $(this).val();
            if(typeVal == ''){
                //document.getElementById("label_" + incr + "_" + i).style.display = disp;//label_1_1
                $('#page_name').hide();
                $('#tutorialRow').hide();
                $('#videoiframe').hide();
                
            }else if(typeVal == 'subcontentvideo'){
                //document.getElementById("label_" + incr + "_" + i).style.display = disp;//label_1_1
                $('#tutorialRow').show();
                $('#videoiframe').show();
                
            }else
            {
                $('#videoiframe').hide();
                $('#tutorialRow').hide();
            }
            if(typeVal == 'subcontentpricing'){
                //document.getElementById("label_" + incr + "_" + i).style.display = disp;//label_1_1
                $('#pricingTable').show();
                
                
            }else
            {
                $('#pricingTable').hide();
                
            }
            
        });
        
        $('#youtube_link').keyup(function(){
            var youtube_linkVal = $(this).val();
            if(youtube_linkVal.length >0){
            $('#media_image').hide();
            //$('#videoiframe').html("");
            $('#videoiframe').html('<img src="<?php echo config_item('admin_images'); ?>ajax-loader.gif" />');
            var items=[];    
                var arr = youtube_linkVal.split('?'),i;
                for(i in arr){
                     var videoIDval = arr[1];
                }
                var idstrlength = videoIDval.length; //finding $video[1] length
                var videoID = videoIDval.substring(2, idstrlength); 
                //var ytApiKey = "AIzaSyCV_Xf4m8RN4rS554u-u9XozKTYOQOxZvM";
                //var getData ="https://www.googleapis.com/youtube/v3/videos?part=snippet&id=" + videoID + "&key=" + ytApiKey;
                //alert(getData);
//                $.get(getData, function(data) {
//                  alert(data.items[0].snippet.title);
//                });
//                var url = 'https://www.googleapis.com/youtube/v3/videos?id='+videoID+'&key='+API_keys+'&fields=items(snippet(title))&part=snippet';
//                alert(data.items[0].snippet.title);
                //var url = "http://gdata.youtube.com/feeds/api/videos/"+videoID;
                //document.load(url);
                //var title = document.getElementsByTagName("title").items[0];
                //alert(title);

                items.push('<object width="525" height="350" data="http://www.youtube.com/v/'+videoID+'" type="application/x-shockwave-flash"><param name="src" value="http://www.youtube.com/v/'+videoID+'" /></object>');
                $('#videoiframe').append.apply($('#videoiframe'), items);
                
            }else {
                $('#media_image').show();
                $('#videoiframe').html($('<object/>').text("No Data Found"));
            }
           
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
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Board<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="board_id"  id="page_type" class='select2_single form-control' tab-index="-1" data-rule-required="true">
                                    <option value="0" selected="selected">---Select Board---</option>
                                    <?php if(!empty($boards)):
                                        foreach($boards as $board):
                                        ?>
                                   
                                   <option value="<?php echo $board->id;?>" <?php if (($isEdit) && ($details->board_id == $board->id)){echo "selected";}?>> <?php echo $board->board_name;?> </option>
                                 <?php
                                        endforeach;
                                    endif;
                                    ?>    
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Level<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="level_id"  id="page_type" class='select2_single form-control' tab-index="-1" data-rule-required="true">
                                    <option value="0" selected="selected">---Select Level---</option>
                                    <?php if(!empty($levels)):
                                        foreach($levels as $level):
                                        ?>
                                   
                                   <option value="<?php echo $level->level_id;?>" <?php if (($isEdit) && ($details->level_id ==  $level->level_id)){echo "selected";}?>> <?php echo $level->level_name;?> </option>
                                      <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Stream<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="stream_id"  id="page_type" class='select2_single form-control' tab-index="-1" data-rule-required="true">
                                    <option value="0" selected="selected">---Select Stream---</option>
                                    <?php if(!empty($streams)):
                                        foreach($streams as $stream):
                                        ?>
                                   
                                   <option value="<?php echo $stream->stream_id;?>" <?php if (($isEdit) && ($details->stream_id ==  $stream->stream_id)){echo "selected";}?>> <?php echo $stream->stream_name;?> </option>
                                      <?php
                                        endforeach;
                                    endif;
                                    ?>  
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Department<span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="department_id"  id="department" class='select2_single form-control' tab-index="-1" data-rule-required="true">
                                    <option value="0" selected="selected">---Select Department---</option>
                                    <?php if(!empty($departments)):
                                        foreach($departments as $department):
                                        ?>
                                   
                                   <option value="<?php echo $department->department_id;?>" <?php if (($isEdit) && ($details->department_id ==  $department->department_id)){echo "selected";}?>> <?php echo $department->department_name;?> </option>
                                      <?php
                                        endforeach;
                                    endif;
                                    ?>  
                                  </select>
                            </div>
                        </div>
                                                                        
                        
                        <div class="form-group">
                             <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Year<span class="required">*</span></label>
                           
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="year"  id="year" class='select2_single form-control' tab-index="-1" data-rule-required="true">
                                    <option value="0" selected="selected">---Select Year---</option>
                                    <?php if($isEdit){
                                        $department=$this->db->query("select * from hya_course_department where department_id=$details->department_id")->row();
                                        $year=$department->year;
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
                                <select name="semester"  id="semester" class='select2_single form-control' tab-index="-1" data-rule-required="true">
                                    <option value="0" selected="selected">---Select Semester---</option>
                                     <?php if($isEdit){
                                        $department=$this->db->query("select * from hya_course_department where department_id=$details->department_id")->row();
                                        $semester=$department->semester;
                                        for($j=1;$j<=$semester;$j++){
                                            ?>
                                    <option <?php if (($isEdit) && ($details->semester ==  $j)){echo "selected";}?> value="<?php echo $j;?>"><?php echo $j;?></option>
                                    <?php
                                        }
                                    }?>
                                    
                                  </select>
                                </div>
                        </div>
                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Select Subject</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="subject_id"  id="semester" class='select2_single form-control' tab-index="-1" data-rule-required="true">
                                    <option value="0" selected="selected">---Select Subject---</option>
                                    <?php if($isEdit){
                                        $subjects=$this->db->query("select * from hya_course_subject where department_id=$details->department_id AND stream_id=$details->stream_id AND level_id=$details->level_id AND board_id=$details->board_id AND status=1")->result();
                                        $year=$department->year;
                                        foreach($subjects as $subject){
                                            ?>
                                    <option <?php if (($isEdit) && ($details->subject_id ==  $subject->subject_id)){echo "selected";}?> value="<?php echo $subject->subject_id;?>"><?php echo $subject->subject_name;?></option>
                                    <?php
                                        }
                                    }?>
                                    
                                  </select>
                                </div>
                        </div>
                        <div class="item form-group" >
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Chapter Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12" id="chapter">
                                <input type="text" name="chapter_name[]" id="page_title" value="<?php if (@$isEdit) {echo $details->chapter_name;}?>" class="slug_name form-control col-md-7 col-xs-12" placeholder="Subject Name" data-rule-required="true" data-rule-minlength="2">
                            </div>
                          <?php   if(!$isEdit):
                              ?>
                           
                            <a id="addChapter" class="btn btn-primary">Add More Chapter</a>
                             <?php
                          endif;
                          ?>
                        </div>
<!--                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Department Slug<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" name="subject_slug" id="page_slug" value="<?php if (@$isEdit) {echo $details->subject_slug;}?>" class="form-control col-md-7 col-xs-12" readonly>
                            </div>
                        </div>-->
<!--                        <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Order</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" placeholder="Only numbers" name="order" value="<?php if (@$isEdit) echo $details->subject_order; ?>" id="numberfield" data-rule-number="true" class="form-control" data-rule-required="true">
                                </div>
                        </div>              -->

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Status <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="status" id="select" class='select2_single form-control' tabindex="-1" >
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

<script>
$(function() { //run on document.ready
  $("#department").change(function() { //this occurs when select 1 changes
        //alert($(this).val());
        $.ajax({
            method: "post",
            dataType:'json',
            data: {'department_id': $(this).val()},
            url: "<?php echo base_url(); ?>course/ajaxSelectYear",
            beforeSend: function () {
                $(".loader-image").show();
            },
            success: function (data) {
               // console.log(data.yearOption);
                var yearOption='';
                var semesterOption='';
                if(data.yearOption !==0){
                            for(var i=1;i<=data.yearOption;i++){
                                
            yearOption +="<option value="+i+">"+i+"</option>";
           // console.log(i);
        }
        
                }
                if(data.semesterOption !==0){
                    for(var j=1;j<=data.semesterOption;j++){
             semesterOption +="<option value="+j+">"+j+"</option>";
        }
                }
                
                $("#year").html(yearOption);
                $("#semester").html(semesterOption);
            }

        });
        
  });
  $('#addChapter').click(function(){
  var add='<input type="text" name="chapter_name[]" id="page_title" value="" class="slug_name form-control col-md-7 col-xs-12" placeholder="Chapter Name" data-rule-required="true" >';
  $("#chapter").append(add).focus();
  })
  
  $('select').change(function(){
      if($(this).attr('name')==='subject_id'){
          return false;
      }
      var data ='';
      var key ,val;
      $("select option:selected").each(function () {
          if($(this).parent('select').attr('name')==='subject_id'){
              return false;
          }
          key=$(this).parent('select').attr('name');
          val=$(this).val();
          data +=key+"="+val + ' AND  ';
          //console.log($(this).parent('select').attr('name') +":"+$(this).val());
      })
      
     // alert($(this).val());
      $.ajax({
            method: "post",
            dataType:'json',
            //data:{'board_id':1,'department_id':0},
           data:data,
            url: "<?php echo base_url(); ?>course/ajaxSelectSubject",
            beforeSend: function () {
                $(".loader-image").show();
            },
            success: function (data) {
                console.log(data);
                var subject='<option value="0" selected="selected">---Select Subject---</option>';
                if(data.length !==0){
                    $.each(data, function( key, value ) {
                        
                            subject +="<option value="+value.subject_id+">"+value.subject_name+"</option>";
                        
                      
                      });
                            
                                
                                
            
           
        
                }
                
                
                $("select[name=subject_id]").html(subject);
                
            }

        });
  })
  });
</script>