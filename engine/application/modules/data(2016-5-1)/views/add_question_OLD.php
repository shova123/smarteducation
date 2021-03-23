<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script>
    $(document).ready(function(){
      $("#second_form").hide();
//      $('#stream').hide();
//      $('#course').hide();
//            $('#department').hide();
//            $('#subject').hide();
//            $('#chapter').hide();
//            $('#unit').hide();
//            $('#subunit').hide();
//            $('#year').hide();
//            $('#semester').hide();
            //$("#subquestion-1").hide();

            $("#next").click(function (e) {
                e.preventDefault();
                $("#second_form").show("slow");
                $("#first_form").hide("slow", function () {});
            });
            $("#cancel").click(function () {
                $("#first_form").show("slow");
                $("#second_form").hide("slow", function () {});
            })
        });
    function setBoard(chosen) {
        var selbox = document.addEditform.level_id;
        var selboxCourse = document.addEditform.course_id;
        var selboxSubject = document.addEditform.subject_id;
        var selboxChapter = document.addEditform.chapter_id;
        var selboxUnit = document.addEditform.unit_id;
        
        selbox.options.length = 0;
        selboxCourse.options.length = 0;
        selboxSubject.options.length = 0;
        selboxChapter.options.length = 0;
        selboxUnit.options.length = 0;
        
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select Level--',' ');
            selboxCourse.options[selbox.options.length] = new Option('--Select Course--',' ');
            selboxSubject.options[selboxSubject.options.length] = new Option('--Select Subject--',' ');
            selboxChapter.options[selboxChapter.options.length] = new Option('--Select Chapter--', ' ');
            selboxUnit.options[selboxUnit.options.length] = new Option('--Select Unit--', ' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Level--',' ');
        selboxCourse.options[selboxCourse.options.length] = new Option('--Select Course--',' ');
        selboxSubject.options[selboxSubject.options.length] = new Option('--Select Subject--',' ');
        selboxChapter.options[selboxChapter.options.length] = new Option('--Select Chapter--', ' ');
        selboxUnit.options[selboxUnit.options.length] = new Option('--Select Unit--', ' ');
        
        
        <?php
        if (!empty($levels)) {
            foreach ($levels as $level) {
                $levelBoard_id = $level->board_id;
                $level_id = $level->level_id;
                $level_name = $level->level_name;
        ?>
                                                                                
            if (chosen == <?php echo $levelBoard_id?>){
                selbox.options[selbox.options.length] = new Option('<?php echo $level_name; ?>','<?php echo $level_id; ?>');
            }
        <?php
            }
        }
        ?>
            
        <?php
        if (!empty($courses)) {
            foreach ($courses as $course) {
                $courseBoard_id = $course->board_id;
                $course_id = $course->course_id;
                $courseLevel_id = $course->level_id;
                $courseStream_id = $course->stream_id;
                $course_name = $course->course_name;
        ?>
        if (chosen == <?php echo $courseBoard_id?>){
            selboxCourse.options[selboxCourse.options.length] = new Option('<?php echo $course_name; ?>','<?php echo $course_id; ?>');
        }
        <?php
            }
        }
        ?>
        <?php        
        if (!empty($subjects)) {
            foreach ($subjects as $subject) {
                $subject_idd = $subject->subject_id;
                $subjectBoard_id = $subject->board_id;
                $subjectCourse_id = $subject->course_id;
                $subject_name = $subject->subject_name;
        ?>
                                                                                
        if (chosen == <?php echo $subjectBoard_id?>){
            selboxSubject.options[selboxSubject.options.length] = new Option('<?php echo $subject_name; ?>','<?php echo $subject_idd; ?>');
        }
        <?php
            }
        }
        ?>
        
        <?php
        if (!empty($chapters)) {
            foreach ($chapters as $chapter) {
                $chapter_id = $chapter->chapter_id;
                $chapterBoard_id = $chapter->board_id;
                $chapterSubject_id = $chapter->subject_id;
                $chapter_name = $chapter->chapter_name;
                ?>
                    if (chosen == <?php echo $chapterBoard_id?>) {
                        selboxChapter.options[selboxChapter.options.length] = new Option('<?php echo $chapter_name; ?>', '<?php echo $chapter_id; ?>');
                    }
                <?php
            }
        }
        ?>
                
        <?php
        if (!empty($units)) {
            foreach ($units as $unit) {
                $unit_id = $unit->unit_id;
                $unitBoard_id = $unit->board_id;
                $unitChapter_id = $unit->chapter_id;
                $unit_name = $unit->unit_name;
                ?>

                    if (chosen == <?php echo $unitBoard_id ?>) {
                        selboxUnit.options[selboxUnit.options.length] = new Option('<?php echo $unit_name; ?>', '<?php echo $unit_id; ?>');
                    }
                <?php
            }
        }
        ?>
                
        
        
    }
    // set option for stream using levels
    function setLevel(chosen) {
        var selbox = document.addEditform.stream_id;
        var selboxCourse = document.addEditform.course_id;
        var selboxDepartment = document.addEditform.department_id;
        var selboxSubject = document.addEditform.subject_id;
        var selboxChapter = document.addEditform.chapter_id;
        var selboxUnit = document.addEditform.unit_id;
        
        selbox.options.length = 0;
        selboxCourse.options.length = 0;
        selboxDepartment.options.length = 0;
        selboxSubject.options.length = 0;
        selboxChapter.options.length = 0;
        selboxUnit.options.length = 0;
        
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select Stream--',' ');
            selboxCourse.options[selboxCourse.options.length] = new Option('--Select Course--',' ');
            selboxDepartment.options[selboxDepartment.options.length] = new Option('--Select Department--',' ');
            selboxSubject.options[selboxSubject.options.length] = new Option('--Select Subject--',' ');
            selboxChapter.options[selboxChapter.options.length] = new Option('--Select Chapter--',' ');
            selboxUnit.options[selboxUnit.options.length] = new Option('--Select unit--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Stream--',' ');
        selboxCourse.options[selboxCourse.options.length] = new Option('--Select Course--',' ');
        selboxDepartment.options[selboxDepartment.options.length] = new Option('--Select Department--',' ');
        selboxSubject.options[selboxSubject.options.length] = new Option('--Select Subject--',' ');
        selboxChapter.options[selboxChapter.options.length] = new Option('--Select Chapter--',' ');
        selboxUnit.options[selboxUnit.options.length] = new Option('--Select unit--',' ');
        <?php
        if (!empty($streams)) {
            foreach ($streams as $stream) {
                $stream_id = $stream->stream_id;
                $streamLevel_id = $stream->level_id;
                $stream_name = $stream->stream_name;
        ?>
                                                                                
        if (chosen == <?php echo $streamLevel_id?>){
            selbox.options[selbox.options.length] = new Option('<?php echo $stream_name; ?>','<?php echo $stream_id; ?>');
        }
        <?php
            }
        }
        ?>
                
        <?php
        if (!empty($courses)) {
            foreach ($courses as $course) {
                $course_id = $course->course_id;
                $courseLevel_id = $course->level_id;
                $courseStream_id = $course->stream_id;
                $course_name = $course->course_name;
        ?>
                                                                                
        if (chosen == <?php echo $courseLevel_id?>){
            selboxCourse.options[selboxCourse.options.length] = new Option('<?php echo $course_name; ?>','<?php echo $course_id; ?>');
        }
        <?php
            }
        }
        ?>
        
        
        <?php
        if (!empty($departments)) {
            foreach ($departments as $department) {
                $department_id = $department->department_id;
                $departmentLevel_id = $department->level_id;
                $departmentCourse_id = $department->course_id;
                $department_name = $department->department_name;
        ?>
                                                                                
        if (chosen == <?php echo $departmentLevel_id?>){
            selboxDepartment.options[selboxDepartment.options.length] = new Option('<?php echo $department_name; ?>','<?php echo $department_id; ?>');
        }
        <?php
            }
        }
        ?>
        
        <?php        
        if (!empty($subjects)) {
            foreach ($subjects as $subject) {
                $subject_idd = $subject->subject_id;
                $subjectBoard_id = $subject->board_id;
                $subjectLevel_id = $subject->level_id;
                $subject_name = $subject->subject_name;
        ?>
                                                                                
        if (chosen == <?php echo $subjectLevel_id?>){
            selboxSubject.options[selboxSubject.options.length] = new Option('<?php echo $subject_name; ?>','<?php echo $subject_idd; ?>');
        }
        <?php
            }
        }
        ?>
         
         
        <?php
        if (!empty($chapters)) {
            foreach ($chapters as $chapter) {
                $chapter_id = $chapter->chapter_id;
                $chapterBoard_id = $chapter->board_id;
                $chapterLevel_id = $chapter->level_id;
                $chapter_name = $chapter->chapter_name;
                ?>
                    if (chosen == <?php echo $chapterLevel_id?>) {
                        selboxChapter.options[selboxChapter.options.length] = new Option('<?php echo $chapter_name; ?>', '<?php echo $chapter_id; ?>');
                    }
                <?php
            }
        }
        ?>
                
                
        <?php
        if (!empty($units)) {
            foreach ($units as $unit) {
                $unit_id = $unit->unit_id;
                $unitLevel_id = $unit->level_id;
                $unitChapter_id = $unit->chapter_id;
                $unit_name = $unit->unit_name;
                ?>

                    if (chosen == <?php echo $unitLevel_id ?>) {
                        selboxUnit.options[selboxUnit.options.length] = new Option('<?php echo $unit_name; ?>', '<?php echo $unit_id; ?>');
                    }
                <?php
            }
        }
        ?>
                
                
    }
    // set option for stream using levels
    function setStream(chosen) {
        var selbox = document.addEditform.course_id;
        var selboxDepartment = document.addEditform.department_id;
        var selboxSubject = document.addEditform.subject_id;
        var selboxChapter = document.addEditform.chapter_id;
        var selboxUnit = document.addEditform.unit_id;
        
        selbox.options.length = 0;
        selboxDepartment.options.length = 0;
        selboxSubject.options.length = 0;
        selboxChapter.options.length = 0;
        selboxUnit.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select--',' ');
            selboxDepartment.options[selboxDepartment.options.length] = new Option('--Select Department--',' ');
            selboxSubject.options[selboxSubject.options.length] = new Option('--Select Subject--',' ');
            selboxChapter.options[selboxChapter.options.length] = new Option('--Select Chapter--',' ');
            selboxUnit.options[selboxUnit.options.length] = new Option('--Select Unit--',' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Course--',' ');
        selboxDepartment.options[selboxDepartment.options.length] = new Option('--Select Department--',' ');
        selboxSubject.options[selboxSubject.options.length] = new Option('--Select Subject--',' ');
        selboxChapter.options[selboxChapter.options.length] = new Option('--Select Chapter--',' ');
        selboxUnit.options[selboxUnit.options.length] = new Option('--Select Unit--',' ');
        <?php
        if (!empty($courses)) {
            foreach ($courses as $course) {
                $course_id = $course->course_id;
                $courseLevel_id = $course->level_id;
                $courseStream_id = $course->stream_id;
                $course_name = $course->course_name;
        ?>
                                                                                
        if (chosen == <?php echo $courseStream_id?>){
            selbox.options[selbox.options.length] = new Option('<?php echo $course_name; ?>','<?php echo $course_id; ?>');
        }
        <?php
            }
        }
        ?>
                
        <?php
        if (!empty($departments)) {
            foreach ($departments as $department) {
                $department_id = $department->department_id;
                $departmentLevel_id = $department->level_id;
                $departmentStream_id = $department->stream_id;
                $departmentCourse_id = $department->course_id;
                $department_name = $department->department_name;
        ?>
                                                                                
        if (chosen == <?php echo $departmentStream_id?>){
            selboxDepartment.options[selboxDepartment.options.length] = new Option('<?php echo $department_name; ?>','<?php echo $department_id; ?>');
        }
        <?php
            }
        }
        ?>
        
        
        <?php        
        if (!empty($subjects)) {
            foreach ($subjects as $subject) {
                $subject_idd = $subject->subject_id;
                $subjectBoard_id = $subject->board_id;
                $subjectStream_id = $subject->stream_id;
                $subject_name = $subject->subject_name;
        ?>
                                                                                
        if (chosen == <?php echo $subjectStream_id?>){
            selboxSubject.options[selboxSubject.options.length] = new Option('<?php echo $subject_name; ?>','<?php echo $subject_idd; ?>');
        }
        <?php
            }
        }
        ?>
                
         <?php
        if (!empty($chapters)) {
            foreach ($chapters as $chapter) {
                $chapter_id = $chapter->chapter_id;
                $chapterStream_id = $chapter->stream_id;
                $chapter_name = $chapter->chapter_name;
        ?>

                if (chosen == <?php echo $chapterStream_id?>) {
                    selboxChapter.options[selboxChapter.options.length] = new Option('<?php echo $chapter_name; ?>', '<?php echo $chapter_id; ?>');
                }
        <?php
            }
        }
        ?>
                
        <?php
        if (!empty($units)) {
            foreach ($units as $unit) {
                $unit_id = $unit->unit_id;
                $unitLevel_id = $unit->level_id;
                $unitStream_id = $unit->stream_id;
                $unit_name = $unit->unit_name;
                ?>

                    if (chosen == <?php echo $unitStream_id ?>) {
                        selboxUnit.options[selboxUnit.options.length] = new Option('<?php echo $unit_name; ?>', '<?php echo $unit_id; ?>');
                    }
                <?php
            }
        }
        ?>
        
    }
    
    function setCourse(chosen) {
        
        var selboxDepartment = document.addEditform.department_id;
        var selboxSubject = document.addEditform.subject_id;
        var selboxChapter = document.addEditform.chapter_id;
        
        selboxDepartment.options.length = 0;
        selboxSubject.options.length = 0;
        selboxChapter.options.length = 0;
        
        if (chosen == " ") {
            selboxDepartment.options[selboxDepartment.options.length] = new Option('--Select--',' ');
            selboxSubject.options[selboxSubject.options.length] = new Option('--Select Subject--',' ');
            selboxChapter.options[selboxChapter.options.length] = new Option('--Select Chapter--',' ');
        }
        
        selboxDepartment.options[selboxDepartment.options.length] = new Option('--Select Department--',' ');
        selboxSubject.options[selboxSubject.options.length] = new Option('--Select Subject--',' ');
        selboxChapter.options[selboxChapter.options.length] = new Option('--Select Chapter--',' ');
        <?php
        if (!empty($departments)) {
            foreach ($departments as $department) {
                $department_id = $department->department_id;
                $departmentCourse_id = $department->course_id;
                $department_name = $department->department_name;
        ?>
                                                                                
        if (chosen == <?php echo $departmentCourse_id?>){
            selboxDepartment.options[selboxDepartment.options.length] = new Option('<?php echo $department_name; ?>','<?php echo $department_id; ?>');
        }
        <?php
            }
        }
        
        if (!empty($subjects)) {
            foreach ($subjects as $subject) {
                $subject_idd = $subject->subject_id;
                $subjectCourse_id = $subject->course_id;
                $subject_name = $subject->subject_name;
        ?>
                                                                                
        if (chosen == <?php echo $subjectCourse_id?>){
            selboxSubject.options[selboxSubject.options.length] = new Option('<?php echo $subject_name; ?>','<?php echo $subject_idd; ?>');
        }
        <?php
            }
        }
        ?>
        
        <?php
        if (!empty($chapters)) {
            foreach ($chapters as $chapter) {
                $chapter_id = $chapter->chapter_id;
                $chapterCourse_id = $chapter->course_id;
                $chapter_name = $chapter->chapter_name;
        ?>

                if (chosen == <?php echo $chapterCourse_id?>) {
                    selboxChapter.options[selboxChapter.options.length] = new Option('<?php echo $chapter_name; ?>', '<?php echo $chapter_id; ?>');
                }
        <?php
            }
        }
        ?>
        
        
    }

    function setSubject(chosen) {
        var selbox = document.addEditform.chapter_id;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select--', ' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Chapter--', ' ');
    <?php
    if (!empty($chapters)) {
        foreach ($chapters as $chapter) {
            $chapter_id = $chapter->chapter_id;
            $chapterSubject_id = $chapter->subject_id;
            $chapter_name = $chapter->chapter_name;
            ?>

                if (chosen == <?php echo $chapterSubject_id ?>) {
                    selbox.options[selbox.options.length] = new Option('<?php echo $chapter_name; ?>', '<?php echo $chapter_id; ?>');
                }
            <?php
        }
    }
    ?>

    }

    function setChapter(chosen) {
        
        var selbox = document.addEditform.unit_id;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select Unit--', ' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select Unit--', ' ');
    <?php
    if (!empty($units)) {
        foreach ($units as $unit) {
            $unit_id = $unit->unit_id;
            $unitChapter_id = $unit->chapter_id;
            $unit_name = $unit->unit_name;
            ?>

                if (chosen == <?php echo $unitChapter_id ?>) {
                    selbox.options[selbox.options.length] = new Option('<?php echo $unit_name; ?>', '<?php echo $unit_id; ?>');
                }
            <?php
        }
    }
    ?>

    }
    
    function setUnit(chosen) {
        
        var selbox = document.addEditform.subunit_id;
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option('--Select SubUnit--', ' ');
        }
        selbox.options[selbox.options.length] = new Option('--Select SubUnit--', ' ');
    <?php
    if (!empty($subunits)) {
        foreach ($subUnits as $s) {
            $subunit_id = $s->subunit_id;
            $subunitUnit_id = $s->unit_id;
            $subunit_name = $s->subunit_name;
            
            ?>

                if (chosen == <?php echo $subunitUnit_id ?>) {
                    selbox.options[selbox.options.length] = new Option('<?php echo $subunit_name; ?>', '<?php echo $subunit_id; ?>');
                }
            <?php
        }
    }
    ?>
            //            if (selbox.options.length > 1) {
//                $("#subunit").show();
//            } else {
//                $("#subunit").hide();
//            }
    }
</script>


<script language="javascript" type="text/javascript" src="<?php echo base_url();?>gears/admin/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url();?>gears/admin/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<script>
    <?php //for($i=1;$i<50;$i++){?>
  tinymce.init({
    //mode: 'textareas',
    selector: 'textarea.subquestionEditor1',
    plugin: 'a_tinymce_plugin',
    //theme : "advanced",
    a_plugin_option: true,
    a_configuration_option: 400,
    //inline:true,
    toolbar: [
        'bold italic underline | strikethrough alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect',
        'link image media | cut copy paste | bullist numlist outdent indent | blockquote | undo redo | removeformat subscript superscript | print preview fullpage | forecolor backcolor'
    ],
    //content_css: 'css/content.css',
//    menubar: {  file:{}, 
//                edit:{},
//                view: {title: 'Edit', items: 'cut, copy, paste, code'}
//            },
 //   subfolder:"uploads",
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor',
      'code filemanager'
    ],
    //advlist_bullet_styles: 'square,circle',
    //advlist_number_styles: 'lower-alpha,lower-roman,upper-alpha,upper-roman',
    //image_advtab: true,
     //elements : 'filemanager',
       //file_browser_callback : 'filemanager',
 //      Responsive Filemanager
       // relative_urls:true,
        //external_filemanager_path:"<?php echo base_url(); ?>tinymce/js/tinymce/plugins/filemanager/",
        //filemanager_title:"Responsive Filemanager" ,
       //external_plugins: { "filemanager" : "<?php echo base_url(); ?>tinymce/js/tinymce/plugins/filemanager/plugin.min.js"}
  });
  
  tinymce.init({
    //mode: 'textareas',
    selector: 'textarea.subquestionEditor2',
//    plugin: 'a_tinymce_plugin',
//    a_plugin_option: true,
//    a_configuration_option: 400,
    toolbar: [
        'bold italic underline | strikethrough alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect',
        'link image media | cut copy paste | bullist numlist outdent indent | blockquote | undo redo | removeformat subscript superscript | print preview fullpage | forecolor backcolor'
    ],
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'save table contextmenu directionality emoticons template paste textcolor',
      'code filemanager'
    ]
    });
    <?php //}?>
 </script>
<?php //$isEdit = isset($template_details) ? true : false; ?>
<?php $isEdit = isset($details) ? true : false; ?>

<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>
                <?php echo $page_title; ?>
            </h3>
        </div>


    </div>
    <div class="clearfix"></div>

    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">

                <div class="x_content">

                    <form action="" method="post" name="addEditform" id="addEditform" class="form-horizontal form-label-left form-validate" enctype='multipart/form-data' >
                    <input type="hidden" value="<?php if(!empty($isEdit)){ echo $template_details->token;}else{ echo md5(uniqid(mt_rand(), True)); }?>" name="token" />
                    <div class="row" id="first_form">
                        <span class="section">Please Complete the information below</span>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Board <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="board_id"  id="page_type" class=' form-control' onchange="setBoard(document.addEditform.board_id.options[ document.addEditform.board_id.selectedIndex].value);" tab-index="-1" data-rule-required="true">
                                    <option value="" selected="selected">---Select Board---</option>
                                    <?php
                                    if (!empty($boards)) {
                                        foreach ($boards as $board) {
                                            $boardID = $board->board_id;
                                            $boardName = $board->board_name;
                                            $boardSlug = $board->board_slug;
                                            $boardAlias = $board->board_alias;
                                            ?>

                                            <option value="<?php echo $boardID; ?>" <?php
                                            if (($isEdit) && ($details->board_id == $boardID)) {
                                                echo "selected";
                                            }
                                            ?>> <?php echo $boardName; ?> </option>
                                                    <?php
                                                }
                                            }
                                            ?>    
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Level <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="level_id"  id="level_id" class=' form-control' onchange="setLevel(document.addEditform.level_id.options[ document.addEditform.level_id.selectedIndex].value);" tab-index="-1" data-rule-required="true">
                                    <option value="" selected="selected">---Select Level---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($levels as $level) {
                                            $levelBoardID = $level->board_id;
                                            $levelID = $level->level_id;
                                            if ($details->board_id == $levelBoardID) {
                                                ?>

                                                <option value="<?php echo $levelID; ?>" <?php
                                                if (($isEdit) && ($details->level_id == $levelID)) {
                                                    echo "selected";
                                                }
                                                ?>> <?php echo $level->level_name; ?> </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Stream</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="stream_id"  id="stream_id" class=' form-control' onchange="setStream(document.addEditform.stream_id.options[ document.addEditform.stream_id.selectedIndex].value);">
                                    <option value="0" selected="selected">---Select Stream---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($streams as $stream) {
                                            $streamLevelID = $stream->level_id;
                                            $streamID = $stream->stream_id;
                                            $streamName = $stream->stream_name;
                                            if ($details->level_id == $streamLevelID) {
                                                ?>

                                                <option value="<?php echo $streamID; ?>" <?php
                                                if (($isEdit) && ($details->stream_id == $streamID)) {
                                                    echo "selected";
                                                }
                                                ?>> <?php echo $streamName; ?> </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>  
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Course</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="course_id"  id="course_id" class=' form-control' onchange="setCourse(document.addEditform.course_id.options[document.addEditform.course_id.selectedIndex].value);">
                                    <option value="" selected="selected">---Select Course---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($courses as $course) {
                                            $courseIDs = $course->course_id;
                                            $courseLevelID = $course->level_id;
                                            $courseStreamID = $course->stream_id;
                                            $courseName = $course->course_name;
                                            if ($details->stream_id == $courseStreamID) {
                                                ?>

                                                <option value="<?php echo $courseIDs; ?>" <?php
                                                if (($isEdit) && ($details->course_id == $courseIDs)) {
                                                    echo "selected";
                                                }
                                                ?>> <?php echo $courseName; ?> </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>  
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Department</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="department_id"  id="department_id" class=' form-control'>
                                    <option value="" selected="selected">---Select Department---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($departments as $department) {
                                            $departmentID = $department->department_id;
                                            $departmentLevelID = $department->level_id;
                                            $departmentStreamID = $department->stream_id;
                                            $departmentCourseID = $department->course_id;
                                            $departmentName = $department->department_name;
                                            if ($details->course_id == $departmentCourseID) {
                                                ?>
                                                <option value="<?php echo $departmentID; ?>" <?php
                                                if (($isEdit) && ($details->department_id == $departmentID)) {
                                                    echo "selected";
                                                }
                                                ?>> <?php echo $departmentName; ?> </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>  
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="page_type">Select Year</label>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="year"  id="year" class='form-control'>
                                    <option value="0" selected="selected">---Select Year---</option>
                                    <?php
                                    if ($isEdit) {
                                        $coursed = $this->db->query("select * from hya_course_course where course_id=$details->course_id")->row();
                                        $year = $coursed->year;
                                        for ($i = 1; $i <= $year; $i++) {
                                            ?>
                                            <option <?php
                                            if (($isEdit) && ($details->year == $i)) {
                                                echo "selected";
                                            }
                                            ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Select Semester</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="semester"  id="semester" class='form-control'>
                                    <option value="0" selected="selected">---Select Semester---</option>
                                    <?php
                                    if ($isEdit) {
                                        $coursed = $this->db->query("select * from hya_course_course where course_id=$details->course_id")->row();
                                        $semester = $coursed->semester;
                                        for ($j = 1; $j <= $semester; $j++) {
                                            ?>
                                            <option <?php
                                            if (($isEdit) && ($details->semester == $j)) {
                                                echo "selected";
                                            }
                                            ?> value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                </select>
                            </div>
                        </div>
                        

                        <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subject_id">Select Subject <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="subject_id" id="subject_id" class='subject_id select2_single form-control' onchange="setSubject(document.addEditform.subject_id.options[document.addEditform.subject_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="" selected="selected">---Select Subject---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($subjects as $subject) {
                                            $subjectIDs = $subject->subject_id;
                                            $subjectBoard_id = $subject->board_id;
                                            $subjectLevel_id = $subject->level_id;
                                            $subjectStream_id = $subject->stream_id;
                                            $subjectCourseID = $subject->course_id;
                                            $subjectDepartment_id = $subject->department_id;
                                            $subject_year = $subject->year;
                                            $subjectName = $subject->subject_name;
                                            if ($details->course_id == $subjectCourseID) {
                                                ?>

                                                <option value="<?php echo $subjectIDs; ?>" <?php
                                                if (($isEdit) && ($details->subject_id == $subjectIDs)) {
                                                    echo "selected";
                                                }
                                                ?>> <?php echo $subjectName; ?> </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>  
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Select Chapter <span class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="chapter_id"  id="chapter_id" class='form-control' data-rule-required="true" onchange="setChapter(document.addEditform.chapter_id.options[document.addEditform.chapter_id.selectedIndex].value);">
                                    <option value="" selected="selected">---Select Chapter---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($chapters as $chapter) {
                                            $chapterIDs = $chapter->chapter_id;
                                            $chapterBoard_id = $chapter->board_id;
                                            $chapterLevel_id = $chapter->level_id;
                                            $chapterStream_id = $chapter->stream_id;
                                            $chapterCourseID = $chapter->course_id;
                                            $chapterDepartment_id = $chapter->department_id;
                                            $chapterSubject_id = $chapter->subject_id;
                                            $chapterName = $chapter->chapter_name;
                                            if ($details->subject_id == $chapterSubject_id) {
                                                ?>
                                                <option value="<?php echo $chapterIDs; ?>" <?php
                                                if (($isEdit) && ($details->chapter_id == $chapterIDs)) {
                                                    echo "selected";
                                                }
                                                ?>> <?php echo $chapterName; ?> </option>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>  
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group" id="unit">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="content">Select Unit</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="unit_id"  id="unit_id" class='form-control' onchange="setUnit(document.addEditform.unit_id.options[document.addEditform.unit_id.selectedIndex].value);">
                                    <option value="" selected="selected">---Select Unit---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($units as $unit) {
                                            $unitIDs = $unit->unit_id;
                                            $unitLevelID = $unit->level_id;
                                            $unitStreamID = $unit->stream_id;
                                            $unitChapterID = $unit->chapter_id;
                                            $unitName = $unit->unit_name;
                                            if ($details->chapter_id == $unitChapterID) {
                                                ?>

                                                <option value="<?php echo $unitIDs; ?>" <?php if (($isEdit) && ($details->unit_id == $unitIDs)) {
                                        echo "selected";
                                    } ?>> <?php echo $unitName; ?> </option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group" id="subunit">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="subunit_id">Select Sub-Unit</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <select name="subunit_id"  id="subunit_id" class='form-control' >
                                    <option value="" selected="selected">---Select Sub-Unit---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($subUnits as $subUnit) {
                                            $subunitIDs = $subUnit->subunit_id;
                                            $subunitLevelID = $subUnit->level_id;
                                            $subunitStreamID = $subUnit->stream_id;
                                            $subunitUnitID = $subUnit->unit_id;
                                            $subunitName = $subUnit->course_name;
                                            if ($details->unit_id == $subunitUnitID) {
                                                ?>

                                                <option value="<?php echo $subunitIDs; ?>" <?php if (($isEdit) && ($details->subunit_id == $subunitIDs)) {
                                        echo "selected";
                                    } ?>> <?php echo $subunitName; ?> </option>
                                                <?php
                                            }
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div style="background-color: #ddd; ">
                        <div class="form-group col-sm-6 my-form-element">
                            <label for="textitem">Set</label>
                            <select name="set">
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                            </select>   
                        </div>

                        <div class="form-group col-sm-6 my-form-element">
                            <label for="textitem">Question Tags</label>
                            <select name="question_tag">
                                <option value="very_short">Very Short</option>
                                <option value="short">Short</option>
                                <option value="long">Long</option>
                                <option value="theory">Theoritical</option>
                                <option value="practical">Practical</option>
                                <option value="short_note">Write Short Note</option>
                            </select> 
                        </div>
                        <?php
                        $currentDate = date('Y-m-d');
                        $c_year = date('Y', strtotime($currentDate));
                        $month = date('F', strtotime($currentDate));
                        $previous10Year = $c_year - 10;
                        $after10Year = $c_year + 10;
                        ?>
                        <div class="form-group col-sm-6 my-form-element">
                            <label for="textitem">Appeared Year</label>
                            <select name="appeared_year" class="ui-datepicker-year" data-event="change" data-handler="selectYear">
                                <?php for($i=$previous10Year ; $i<=$after10Year;$i++){?>
                                <option <?php if (@$isEdit){if($i == $details->appeared_year){?>selected="selected" <?php }}elseif($i == $c_year){?>selected="selected" <?php }?>value="<?php echo $i?>"><?php echo $i;?></option>
                                <?php }?>
                            </select>
                                                   <!--<input type="text" id="datepicker" class="form-control" name="template_title" value="<?php if (@$isEdit) echo $template_details->template_title; ?>" data-rule-required="true" />-->
                        </div>
                        <div class="form-group col-sm-6 my-form-element">
                            <label for="textitem">Marks</label>
                           <input type="text" class="form-control" name="mark" value="<?php if (@$isEdit) echo $details->mark; ?>" data-rule-required="true" />
                       </div>
                        
                        
                        
                        <div class="row listContainer" id="myListsTable">
                            <div class="form-group col-sm-9 my-form-element">
                                <label for="textitem">Question</label>
                                <textarea name="template_description" id="template_description" class="form-control ckeditor"><?php
                                    if (@$isEdit) {
                                        echo $template_details->template_description;
                                    }
                                    ?>
                                </textarea>
                            </div>
                            <div class="form-group col-sm-3 my-form-element">
                               <label for="textitem">Question Type</label>
                                <select name="question_type" class="form-control myselectbox" id="<?php echo $i; ?>">
                                    <option value="">Select Type</option>
                                    <option value="Text Entry" <?php if (!empty($resultQuestionArr)) {if ($Q_typeArr == "Text Entry") {echo "selected";}}?>>Text Entry</option>
                                    <option value="Image" <?php if (!empty($resultQuestionArr)) {if ($Q_typeArr == "Image") {echo "selected";}}?>>Image</option>
                                    <option value="Video" <?php if (!empty($resultQuestionArr)) {if ($Q_typeArr == "Video") {echo "selected";}}?>>Video</option>
                                    <option value="Drop Down" <?php if (!empty($resultQuestionArr)) {if ($Q_typeArr == "Drop Down") {echo "selected";}}?>>Drop Down</option>
                                    <option value="Radio Buttons" <?php if (!empty($resultQuestionArr)) {if ($Q_typeArr == "Radio Buttons") {echo "selected";}}?>>Radio Buttons</option>
                                    <option value="Checkboxes" <?php if (!empty($resultQuestionArr)) {if ($Q_typeArr == "Checkboxes") {echo "selected";}}?>>Checkboxes</option>
                                </select>
                            </div>
                        </div>
                            </div>
                        
                        
                        <div class="ln_solid"></div>
                        
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
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" name="submitTemplate" class="btn btn-primary submit-btn pull-right" id="next" value="Next">Next</button>
                                <!--<button type="button" class="btn">Cancel</button>-->
                                <button type="button" onclick="history.go(-1);" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="ln_solid" ></div>
                    <div class="row featureHolder" id="second_form">
                        <button type="button" class="btn btn-primary addSubQuestion">Add Sub Question</button>
<!--                        <button type="button" class="btn btn-primary addSubQuestion" onclick="add('subquestion')">Add Sub Question</button>-->
                        <hr>
                        <div class="row listContainer" id="myListsTable">
                            <div class="form-group col-sm-9">
                                
                            </div>
                            <div class="form-group col-sm-3">
                                
                            </div>
                        </div>
                        
                        <div class="x_panel">
                            <div class="x_title" style="background-color: #73879c;color: #FFF;">
                                <h2 >Sub Question 1</h2>
                                <a class="btn btn-danger delete pull-right"  href="#"><i class="fa fa-trash-o fa-lg"></i></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class="btn-toolbar editor">
                                    <textarea id="template_description" class="form-control subquestionEditor1" name="subquestion[]"> </textarea>
                                </div>
                                <br />
                            </div>
                            
                            <div id="subquestion-1" class="subquestion">
                                <button type="button" onclick="addSub('option','1')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Option</button>
                                <div id="option"></div>
                                <button type="button" onclick="addSub('hint','1')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Hint</button>
                                <div id="hint"></div>
                                <button type="button" onclick="addSub('answer','1')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Answer</button>
                                <div id="answer"></div>
                                <button type="button" onclick="addSub('reason','1')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Reason</button>
                                <div id="reason"></div>
                                <button type="button" onclick="addSub('description','1')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Description</button>
                                <div id="description"></div>
                            </div>
<!--                            <div id="withoutSubquestion">
                                <button type="button" onclick="add('option')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Option</button>
                                <div id="option"></div>
                                <button type="button" onclick="add('hint')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Hint</button>
                                <div id="hint"></div>
                                <button type="button" onclick="add('answer')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Answer</button>
                                <div id="answer"></div>
                                <button type="button" onclick="add('reason')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Reason</button>
                                <div id="reason"></div>
                                <button type="button" onclick="add('description')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Description</button>
                                <div id="description"></div>
                            </div>-->
                        </div>
                        
                        <!--<div style="background-color: #ddd;">-->
                            



                            
                        <!--</div>-->
                    </div>
                    
                    
                    <div class="form-group col-sm-12 my-form-element">
                        <input type="submit" name="submitQuestion" class="btn btn-primary" value="Save"/>
                        <button type="button" class="btn" id="cancel">Cancel</button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    
$(document).ready(function() {
    var max_fields      = 50; //maximum input boxes allowed
    var wrapper         = $(".featureHolder"); //Fields wrapper
    var add_button      = $(".addSubQuestion"); //Add button ID
    var i =1;
   /*
   <?php
    if (!empty($template_questions)) {
            $totalQuestionCount = count($template_questions);
    ?>
        var i = <?php echo $totalQuestionCount;?>; //initlal text box count
    <?php 
    }else{
    ?>
        var i = 1; //initlal text box count
    <?php }?>
     */
    var optQuesIncr = 0;
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        //for(i=1;i< max_fields; i++){
            if(i < max_fields){ //max input box allowed
                var count = i+1;
                            var subquestion ='<div class="x_panel">';
                        subquestion +='<div class="x_title" style="background-color: #73879c;color: #FFF;">';
                            subquestion +='<h2 >Sub-Question '+count+'</h2>';
                            subquestion +='<a class="btn btn-danger delete pull-right"  href="#"><i class="fa fa-trash-o fa-lg"></i></a>';
                            subquestion +='<div class="clearfix"></div>';
                        subquestion +='</div>';
                        subquestion +='<div class="x_content">';
                            subquestion +='<div class="btn-toolbar">';
                                subquestion +='<textarea id="template_description" class="form-control subquestionEditor2" name="subquestion[]"> </textarea>';
                            subquestion +='</div>';
                            subquestion +='<br />';
                        subquestion +='</div>';

                        subquestion +='<div id="subquestion-1" class="subquestion">';
                            subquestion +='<button type="button" onclick="addSub(\'option\','+count+')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Option</button>';
                            subquestion +='<div id="option"></div>';
                            subquestion +='<button type="button" onclick="addSub(\'hint\','+count+')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Hint</button>';
                            subquestion +='<div id="hint"></div>';
                            subquestion +='<button type="button" onclick="addSub(\'answer\','+count+')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Answer</button>';
                            subquestion +='<div id="answer"></div>';
                            subquestion +='<button type="button" onclick="addSub(\'reason\','+count+')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Reason</button>';
                            subquestion +='<div id="reason"></div>';
                            subquestion +='<button type="button" onclick="addSub(\'description\','+count+')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Description</button>';
                            subquestion +='<div id="description"></div>';
                        subquestion +='</div>';
                    subquestion +='</div>';
                i++; //text box increment
                optQuesIncr++;
                $(wrapper).append(subquestion); //add input box
            }
        //}
    });
   
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
    
       
        var _qid = $(this).attr('id');
        $(this).html('<img src="<?php echo config_item('admin_images'); ?>ajax-loader.gif" />');
        $.get('<?php echo base_url("templates/delete_question"); ?>', {qid: _qid},
            //alert(data);
        function (data) {
            _this.text(data);
            $('a#' + _qid + '').addClass(data);
            //$('.cross').hide();
        });
         e.preventDefault(); $(this).parent('div').remove(); i--;
        
    })
    
    $(wrapper).on("click",".remove_option", function(e){ //user click on remove text
    
       
        var _opid = $(this).attr('id');
        //$(this).html('<img src="<?php echo config_item('admin_images'); ?>ajax-loader.gif" />');
        $.get('<?php echo base_url("templates/delete_question_option"); ?>', {opid: _opid},
            //alert(data);
        function (data) {
            _this.text(data);
            $('a#' + _qid + '').addClass(data);
            //$('.cross').hide();
        });
         e.preventDefault(); $(this).parent().parent().remove();
        
    })
});
</script>


<script>
    /*
      function add(option)
      {var count =1;
          if(option==='subquestion'){
              
              var visible=$(".subquestion").is(":visible");
              if(visible){
                  var i=$(".subquestion").length;
                  //console.log(i);
//                  var subquestion ='<div style="background-color: #ddd;">';
//                        subquestion +='<div class="form-group col-sm-12 my-form-element">';
//                            subquestion +='<label for="textitem">Sub Question '+count+'</label>';
//                            subquestion +='<a class="btn btn-danger delete pull-right"  href="#"><i class="fa fa-trash-o fa-lg"></i> Delete</a><textarea id="template_description" class="form-control ckeditor" name="subquestion[]"> </textarea>';
//                        subquestion +='</div>';
//                    
//                    
//                    //subquestion +='<span class="badge badge-success pull-left">'+count+'</span><a class="btn btn-danger delete pull-right"  href="#"><i class="fa fa-trash-o fa-lg"></i> Delete</a><textarea id="template_description" class="form-control ckeditor" name="subquestion[]"> </textarea>';
//                        subquestion +="<div id='subquestion-"+(i+1)+"' style='background-color: #ddd;'>"; 
//                        subquestion +='<button class="btn btn-info" type="button" onclick="addSub(\'option\','+(i+1)+')">Add Option</button><div id="option"></div>';
//                        subquestion +='<button class="btn btn-info" type="button" onclick="addSub(\'hint\','+(i+1)+')">Add Hint</button><div id="hint"></div>';
//                        subquestion +='<button class="btn btn-info" type="button" onclick="addSub(\'answer\','+(i+1)+')">Add Answer</button><div id="answer"></div>';
//                        subquestion +='<button class="btn btn-info" type="button" onclick="addSub(\'reason\','+(i+1)+')">Add Reason</button><div id="reason"></div>';
//                        subquestion +='<button class="btn btn-info" type="button" onclick="addSub(\'description\','+(i+1)+')">Add Description</button><div id="description"></div>';
//                        subquestion +='</div>';
//                    subquestion +='</div>';
                    
                    
                    var subquestion ='<div class="x_panel">';
                        subquestion +='<div class="x_title">';
                            subquestion +='<h2>Add Sub-Question '+count+'</h2>';
                            subquestion +='<a class="btn btn-danger delete pull-right"  href="#"><i class="fa fa-trash-o fa-lg"></i></a>';
                            subquestion +='<div class="clearfix"></div>';
                        subquestion +='</div>';
                        subquestion +='<div class="x_content">';
                            subquestion +='<div class="btn-toolbar editor">';
                                subquestion +='<textarea id="template_description" class="form-control ckeditor" name="subquestion[]"> </textarea>';
                            subquestion +='</div>';
                            subquestion +='<br />';
                        subquestion +='</div>';

                        subquestion +='<div id="subquestion-1" class="subquestion">';
                            subquestion +='<button type="button" onclick="addSub(\'option\','+(i+1)+')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Option</button>';
                            subquestion +='<div id="option"></div>';
                            subquestion +='<button type="button" onclick="addSub(\'hint\','+(i+1)+')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Hint</button>';
                            subquestion +='<div id="hint"></div>';
                            subquestion +='<button type="button" onclick="addSub(\'answer\','+(i+1)+')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Answer</button>';
                            subquestion +='<div id="answer"></div>';
                            subquestion +='<button type="button" onclick="addSub(\'reason\','+(i+1)+')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Reason</button>';
                            subquestion +='<div id="reason"></div>';
                            subquestion +='<button type="button" onclick="addSub(\'description\','+(i+1)+')" class="btn btn-info"><i class="fa fa-plus-square-o fa-lg"></i> Description</button>';
                            subquestion +='<div id="description"></div>';
                        subquestion +='</div>';
                    subquestion +='</div>';
                    
                $('.subquestion').append(subquestion);
                count++;
              } else{
                    $("#subquestion-1").show();
                    $('#withoutSubquestion').hide();
                    var input ='<div style="background-color: #ddd;">';
                        input +='<div class="form-group col-sm-12 my-form-element">';
                            input +='<label for="textitem">Sub Question 1</label>';
                            input +='<a class="btn btn-danger delete pull-right" href="#"><i class="fa fa-trash-o fa-lg"></i> Delete</a><textarea id="template_description" class="form-control ckeditor" name="subquestion[]"> </textarea>';
                        input +='</div>';
                        input +='</div>';
                        
                   // var input='<span class="badge badge-success pull-left">1</span><a class="btn btn-danger delete pull-right"  href="#"><i class="fa fa-trash-o fa-lg"></i> Delete</a><textarea id="template_description" class="form-control ckeditor" name="subquestion[]"> </textarea>';
                    $('#subquestion-1').prepend(input);
                    return;
                }      
                  
             
             
          }
          var input="<input class='form-control' data-rule-required='true' type='text' name='"+option+"[]' value='"+option+"' ><a class='btn btn-danger delete'  href='#'><i class='fa fa-trash-o fa-lg'></i> Delete</a>";
          $('#'+option).append(input);
      }
      
      */
      function addSub(suboption,num)
      {
          var input="<input class='form-control' data-rule-required='true' type='text' name='subquestion["+suboption+"]["+num+"][]' value='"+suboption+"' ><a class='btn btn-danger delete'  href='#'><i class='fa fa-trash-o fa-lg'></i> Delete</a>";
          
//          var input="<input class='form-control' data-rule-required='true' type='text' name='"+suboption+"[]' value='"+suboption+"' ><a class='btn btn-danger delete'  href='#'><i class='fa fa-trash-o fa-lg'></i> Delete</a>";
          $('#subquestion-'+num).find('#'+suboption).append(input);
      }
      
  $(function() {
    $( "#datepicker" ).datepicker({
        
            dateFormat:'yy',
        
      changeMonth: true,
      changeYear: true
    });
    $(".delete").bind('click',function(){
        alert("delete");
    })
  });
</script>
<script>
    
    
    $(function () { //run on document.ready
        $("#level_id").change(function () { //this occurs when select 1 changes

            $.ajax({
                method: "post",
                dataType: 'json',
                data: {'level_id': $(this).val()},
                url: "<?php echo base_url(); ?>course/ajaxSelectYear",
                beforeSend: function () {
                    $(".loader-image").show();
                },
                success: function (data) {
                    //console.log(data.yearOption);
                    var yearOption = '';
                    var semesterOption = '';
                    if (data.yearOption !== 0) {
                        yearOption += "<option value=''>Select Year</option>";
                        for (var i = 1; i <= data.yearOption; i++) {
                            yearOption += "<option value=" + i + ">" + i + "</option>";
                            // console.log(i);
                        }
//                        i = i-1;
//                        yearOption +="<option value="+i+">"+i+"</option>";

                    }
                    if (data.semesterOption !== 0) {
                        semesterOption += "<option value=''>Select Semester</option>";
                        for (var j = 1; j <= data.semesterOption; j++) {
                            semesterOption += "<option value=" + j + ">" + j + "</option>";
                        }
//                        j = j-1;
//                        semesterOption +="<option value="+j+">"+j+"</option>";
                    }

                    $("#year").html(yearOption);
                    $("#semester").html(semesterOption);
                }

            });

        });

        $("#stream_id").change(function () { //this occurs when select 1 changes

            $.ajax({
                method: "post",
                dataType: 'json',
                data: {'stream_id': $(this).val()},
                url: "<?php echo base_url(); ?>course/ajaxSelectYear",
                beforeSend: function () {
                    $(".loader-image").show();
                },
                success: function (data) {
                    //console.log(data.yearOption);
                    var yearOption = '';
                    var semesterOption = '';
                    if (data.yearOption !== 0) {
                        yearOption += "<option value=''>Select Year</option>";
                        for (var i = 1; i <= data.yearOption; i++) {
                            yearOption += "<option value=" + i + ">" + i + "</option>";
                            // console.log(i);
                        }
//                        i = i-1;
//                        yearOption +="<option value="+i+">"+i+"</option>";

                    }
                    if (data.semesterOption !== 0) {
                        semesterOption += "<option value=''>Select Semester</option>";
                        for (var j = 1; j <= data.semesterOption; j++) {
                            semesterOption += "<option value=" + j + ">" + j + "</option>";
                        }
//                        j = j-1;
//                        semesterOption +="<option value="+j+">"+j+"</option>";
                    }

                    $("#year").html(yearOption);
                    $("#semester").html(semesterOption);
                }

            });

        });

        $("#course_id").change(function () { //this occurs when select 1 changes

            $.ajax({
                method: "post",
                dataType: 'json',
                data: {'course_id': $(this).val()},
                url: "<?php echo base_url(); ?>course/ajaxSelectYear",
                beforeSend: function () {
                    $(".loader-image").show();
                },
                success: function (data) {
                    //console.log(data.yearOption);
                    var yearOption = '';
                    var semesterOption = '';
                    if (data.yearOption !== 0) {
                        yearOption += "<option value=''>Select Year</option>";
                        for (var i = 1; i <= data.yearOption; i++) {
                            yearOption += "<option value=" + i + ">" + i + "</option>";
                            // console.log(i);
                        }
//                        i = i-1;
//                        yearOption +="<option value="+i+">"+i+"</option>";

                    }
                    if (data.semesterOption !== 0) {
                        semesterOption += "<option value=''>Select Semester</option>";
                        for (var j = 1; j <= data.semesterOption; j++) {
                            semesterOption += "<option value=" + j + ">" + j + "</option>";
                        }
//                        j = j-1;
//                        semesterOption +="<option value="+j+">"+j+"</option>";
                    }

                    $("#year").html(yearOption);
                    $("#semester").html(semesterOption);
                }

            });

        });
        $("#subject").change(function () { //this occurs when select 1 changes
            var data = '';
            var key, val;
            $("select option:selected").each(function () {
                if ($(this).parent('select').attr('name') === 'chapter_id') {
                    return false;
                }
                key = $(this).parent('select').attr('name');
                val = $(this).val();
                data += key + "=" + val + ' AND  ';
                //console.log($(this).parent('select').attr('name') +":"+$(this).val());
            })
            $.ajax({
                method: "post",
                dataType: 'json',
                data: data,
                url: "<?php echo base_url(); ?>course/ajaxSelectchapter",
                beforeSend: function () {
                    $(".loader-image").show();
                },
                success: function (data) {
                    var chapter = '<option value="" selected="selected">---Select Chapter---</option>';
                    if (data.length !== 0) {
                        $.each(data, function (key, value) {

                            chapter += "<option value=" + value.chapter_id + ">" + value.chapter_name + "</option>";


                        });
                    }



                    $("#chapter").html(chapter);
                }

            });

        });



        $('select').change(function () {
            if ($(this).attr('name') === 'chapter_id' || $(this).attr('name') === 'subject_id') {
                return false;
            }
            var data = '';
            var key, val;
            $("select option:selected").each(function () {
                if ($(this).parent('select').attr('name') === 'subject_id') {
                    return false;
                }
                key = $(this).parent('select').attr('name');
                val = $(this).val();
                data += key + "=" + val + ' AND  ';
                //console.log($(this).parent('select').attr('name') +":"+$(this).val());
            })

            // alert($(this).val());
            $.ajax({
                method: "post",
                dataType: 'json',
                //data:{'board_id':1,'department_id':0},
                data: data,
                url: "<?php echo base_url(); ?>course/ajaxSelectSubjectFromUnit",
                beforeSend: function () {
                    $(".loader-image").show();
                },
                success: function (data) {
                    console.log(data);
                    var subject = '<option value="0" selected="selected">---Select Subject---</option>';
                    var chapter = '<option value="0" selected="selected">---Select Chapter---</option>';
                    if (data.subject.length !== 0) {
                        $.each(data.subject, function (key, value) {

                            subject += "<option value=" + value.subject_id + ">" + value.subject_name + "</option>";


                        });






                    }
                    if (data.chapter.length !== 0) {
                        $.each(data.chapter, function (key1, value1) {

                            chapter += "<option value=" + value1.chapter_id + ">" + value1.chapter_name + "</option>";


                        });






                    }


                    $("select[name=subject_id]").html(subject);
                    $("#chapter").html(chapter);

                }

            });
        })
    });
</script>