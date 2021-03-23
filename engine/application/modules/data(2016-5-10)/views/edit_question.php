<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="<?php echo base_url();?>gears/admin/js/plugins/wizard/jquery.form.wizard.min.js"></script>
<script>
    $(document).ready(function () {
        $("#subquestion-1").hide();
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
            selbox.options[selbox.options.length] = new Option("--Select Level--", "");
            selboxCourse.options[selbox.options.length] = new Option("--Select Course--", "");
            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
            selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
            selboxUnit.options[selboxUnit.options.length] = new Option("--Select Unit--", "");
        }
        selbox.options[selbox.options.length] = new Option("--Select Level--", "");
        selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--", "");
        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
        selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
        selboxUnit.options[selboxUnit.options.length] = new Option("--Select Unit--", "");

<?php
if (!empty($levels)) {
    foreach ($levels as $level) {
        $levelBoard_id = $level->board_id;
        $level_id = $level->level_id;
        $level_name = $level->level_name;
        ?>

                if (chosen == <?php echo $levelBoard_id ?>) {
                    selbox.options[selbox.options.length] = new Option("<?php echo $level_name; ?>", "<?php echo $level_id; ?>");
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
                if (chosen == <?php echo $courseBoard_id ?>) {
                    selboxCourse.options[selboxCourse.options.length] = new Option("<?php echo $course_name; ?>", "<?php echo $course_id; ?>");
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

                if (chosen == <?php echo $subjectBoard_id ?>) {
                    selboxSubject.options[selboxSubject.options.length] = new Option("<?php echo $subject_name; ?>", "<?php echo $subject_idd; ?>");
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
                if (chosen == <?php echo $chapterBoard_id ?>) {
                    selboxChapter.options[selboxChapter.options.length] = new Option("<?php echo $chapter_name; ?>", "<?php echo $chapter_id; ?>");
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
                    selboxUnit.options[selboxUnit.options.length] = new Option("<?php echo $unit_name; ?>", "<?php echo $unit_id; ?>");
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
            selbox.options[selbox.options.length] = new Option("--Select Stream--", "");
            selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--", "");
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
            selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
            selboxUnit.options[selboxUnit.options.length] = new Option("--Select unit--", "");
        }
        selbox.options[selbox.options.length] = new Option("--Select Stream--", "");
        selboxCourse.options[selboxCourse.options.length] = new Option("--Select Course--", "");
        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
        selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
        selboxUnit.options[selboxUnit.options.length] = new Option("--Select unit--", "");
<?php
if (!empty($streams)) {
    foreach ($streams as $stream) {
        $stream_id = $stream->stream_id;
        $streamLevel_id = $stream->level_id;
        $stream_name = $stream->stream_name;
        ?>

                if (chosen == <?php echo $streamLevel_id ?>) {
                    selbox.options[selbox.options.length] = new Option("<?php echo $stream_name; ?>", "<?php echo $stream_id; ?>");
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

                if (chosen == <?php echo $courseLevel_id ?>) {
                    selboxCourse.options[selboxCourse.options.length] = new Option("<?php echo $course_name; ?>", "<?php echo $course_id; ?>");
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

                if (chosen == <?php echo $departmentLevel_id ?>) {
                    selboxDepartment.options[selboxDepartment.options.length] = new Option("<?php echo $department_name; ?>", "<?php echo $department_id; ?>");
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

                if (chosen == <?php echo $subjectLevel_id ?>) {
                    selboxSubject.options[selboxSubject.options.length] = new Option("<?php echo $subject_name; ?>", "<?php echo $subject_idd; ?>");
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
                if (chosen == <?php echo $chapterLevel_id ?>) {
                    selboxChapter.options[selboxChapter.options.length] = new Option("<?php echo $chapter_name; ?>", "<?php echo $chapter_id; ?>");
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
                    selboxUnit.options[selboxUnit.options.length] = new Option("<?php echo $unit_name; ?>", "<?php echo $unit_id; ?>");
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
            selbox.options[selbox.options.length] = new Option("--Select--", "");
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
            selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
            selboxUnit.options[selboxUnit.options.length] = new Option("--Select Unit--", "");
        }
        selbox.options[selbox.options.length] = new Option("--Select Course--", "");
        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
        selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
        selboxUnit.options[selboxUnit.options.length] = new Option("--Select Unit--", "");
<?php
if (!empty($courses)) {
    foreach ($courses as $course) {
        $course_id = $course->course_id;
        $courseLevel_id = $course->level_id;
        $courseStream_id = $course->stream_id;
        $course_name = $course->course_name;
        ?>

                if (chosen == <?php echo $courseStream_id ?>) {
                    selbox.options[selbox.options.length] = new Option("<?php echo $course_name; ?>", "<?php echo $course_id; ?>");
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

                if (chosen == <?php echo $departmentStream_id ?>) {
                    selboxDepartment.options[selboxDepartment.options.length] = new Option("<?php echo $department_name; ?>", "<?php echo $department_id; ?>");
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

                if (chosen == <?php echo $subjectStream_id ?>) {
                    selboxSubject.options[selboxSubject.options.length] = new Option("<?php echo $subject_name; ?>", "<?php echo $subject_idd; ?>");
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

                if (chosen == <?php echo $chapterStream_id ?>) {
                    selboxChapter.options[selboxChapter.options.length] = new Option("<?php echo $chapter_name; ?>", "<?php echo $chapter_id; ?>");
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
                    selboxUnit.options[selboxUnit.options.length] = new Option("<?php echo $unit_name; ?>", "<?php echo $unit_id; ?>");
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
            selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select--", "");
            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
            selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
        }

        selboxDepartment.options[selboxDepartment.options.length] = new Option("--Select Department--", "");
        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
        selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
<?php
if (!empty($departments)) {
    foreach ($departments as $department) {
        $department_id = $department->department_id;
        $departmentCourse_id = $department->course_id;
        $department_name = $department->department_name;
        ?>

                if (chosen == <?php echo $departmentCourse_id ?>) {
                    selboxDepartment.options[selboxDepartment.options.length] = new Option("<?php echo $department_name; ?>", "<?php echo $department_id; ?>");
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

                if (chosen == <?php echo $subjectCourse_id ?>) {
                    selboxSubject.options[selboxSubject.options.length] = new Option("<?php echo $subject_name; ?>", "<?php echo $subject_idd; ?>");
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

                if (chosen == <?php echo $chapterCourse_id ?>) {
                    selboxChapter.options[selboxChapter.options.length] = new Option("<?php echo $chapter_name; ?>", "<?php echo $chapter_id; ?>");
                }
        <?php
    }
}
?>


    }


    function setYear(chosen) {

        var selboxSubject = document.addEditform.subject_id;
        var selboxChapter = document.addEditform.chapter_id;
        
        
        var boardID = document.getElementById("board_id").value;
        var levelID = document.getElementById("level_id").value;
        var streamID = document.getElementById("stream_id").value;
        var courseID = document.getElementById("course_id").value;
        var departmentID = document.getElementById("department_id").value;

        
        selboxSubject.options.length = 0;
        selboxChapter.options.length = 0;

        if (chosen == " ") {
            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
            selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
        }

        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
        selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
        <?php
        if (!empty($subjects)) {
            foreach ($subjects as $subject) {
        ?>
        if(boardID !=""){<?php $subject_boardID = $subject->board_id;?>}else{<?php $subject_boardID = "0";?> boardID= 0;}
        if(levelID !=""){<?php $subject_levelID = $subject->level_id;?>}else{<?php $subject_levelID = "0";?> levelID= 0;}
        if(streamID !=""){<?php $subject_streamID = $subject->stream_id;?>}else{<?php $subject_streamID = "0";?> streamID= 0;}
        if(courseID !=""){<?php $subject_courseID = $subject->course_id;?>}else{<?php $subject_courseID = "0";?> courseID= 0;}
        if(departmentID !=""){<?php $subject_departmentID = $subject->department_id;?>}else{<?php $subject_departmentID = "0";?> departmentID= 0;}

        <?php
                
                $subject_levelID = $subject->level_id;
                $subject_streamID = $subject->stream_id;
                $subject_courseID = $subject->course_id;
                $subject_departmentID = $subject->department_id;
                
                $subject_idd = $subject->subject_id;
                $subjectCourse_id = $subject->course_id;
                $subject_name = $subject->subject_name;
                $subject_year = $subject->year;
        ?>

                if (chosen == <?php echo $subject_year ?>  && (boardID == <?php echo $subject_boardID ?> || levelID == <?php echo $subject_levelID ?> || streamID == <?php echo $subject_streamID ?> || courseID == <?php echo $subject_courseID ?> || departmentID == <?php echo $subject_departmentID ?>)) {
                    selboxSubject.options[selboxSubject.options.length] = new Option("<?php echo $subject_name; ?>", "<?php echo $subject_idd; ?>");
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
                $chapter_year = $chapter->year;
        ?>

                if (chosen == <?php echo $chapter_year ?>) {
                    selboxChapter.options[selboxChapter.options.length] = new Option("<?php echo $chapter_name; ?>", "<?php echo $chapter_id; ?>");
                }
        <?php
            }
        }
        ?>


    }
    
    function setSemester(chosen) {

        var selboxSubject = document.addEditform.subject_id;
        var selboxChapter = document.addEditform.chapter_id;

        selboxSubject.options.length = 0;
        selboxChapter.options.length = 0;

        if (chosen == " ") {
            selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
            selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
        }

        selboxSubject.options[selboxSubject.options.length] = new Option("--Select Subject--", "");
        selboxChapter.options[selboxChapter.options.length] = new Option("--Select Chapter--", "");
        <?php
        if (!empty($subjects)) {
            foreach ($subjects as $subject) {
                $subject_idd = $subject->subject_id;
                $subjectCourse_id = $subject->course_id;
                $subject_name = $subject->subject_name;
                $subject_semester = $subject->semester;
        ?>

                if (chosen == <?php echo $subject_semester ?>) {
                    selboxSubject.options[selboxSubject.options.length] = new Option("<?php echo $subject_name; ?>", "<?php echo $subject_idd; ?>");
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
                $chapter_semester = $chapter->semester;
        ?>

                if (chosen == <?php echo $chapter_semester ?>) {
                    selboxChapter.options[selboxChapter.options.length] = new Option("<?php echo $chapter_name; ?>", "<?php echo $chapter_id; ?>");
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
            selbox.options[selbox.options.length] = new Option("--Select--", "");
        }
        selbox.options[selbox.options.length] = new Option("--Select Chapter--", "");
<?php
if (!empty($chapters)) {
    foreach ($chapters as $chapter) {
        $chapter_id = $chapter->chapter_id;
        $chapterSubject_id = $chapter->subject_id;
        $chapter_name = $chapter->chapter_name;
        ?>

                if (chosen == <?php echo $chapterSubject_id ?>) {
                    selbox.options[selbox.options.length] = new Option("<?php echo $chapter_name; ?>", "<?php echo $chapter_id; ?>");
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
            selbox.options[selbox.options.length] = new Option("--Select Unit--", "");
        }
        selbox.options[selbox.options.length] = new Option("--Select Unit--", "");
<?php
if (!empty($units)) {
    foreach ($units as $unit) {
        $unit_id = $unit->unit_id;
        $unitChapter_id = $unit->chapter_id;
        $unit_name = $unit->unit_name;
        ?>

                if (chosen == <?php echo $unitChapter_id ?>) {
                    selbox.options[selbox.options.length] = new Option("<?php echo $unit_name; ?>", "<?php echo $unit_id; ?>");
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
            selbox.options[selbox.options.length] = new Option("--Select SubUnit--", "");
        }
        selbox.options[selbox.options.length] = new Option("--Select SubUnit--", "");
<?php
if (!empty($subunits)) {
    foreach ($subunits as $s) {
        $subunit_id = $s->subunit_id;
        $subunitUnit_id = $s->unit_id;
        $subunit_name = $s->subunit_name;
        ?>

                if (chosen == <?php echo $subunitUnit_id ?>) {
                    selbox.options[selbox.options.length] = new Option("<?php echo $subunit_name; ?>", "<?php echo $subunit_id; ?>");
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


<script language="javascript" type="text/javascript" src="<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/jquery.tinymce.min.js"></script>
<!--<script>
  tinymce.init({
            selector: 'textarea',
            plugins: [
              'link image charmap ',
              'wordcount fullscreen ',
              'paste',
              'filemanager'
            ],
            toolbar: [
                'bold italic underline | link image | charmap insertfile undo redo',
                'bullist numlist outdent indent | styleselect formatselect fontselect fontsizeselect'
            ]
        });
 </script>-->
<script>
//tinymce.PluginManager.load('equationeditor', '<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/plugins/equationeditor/build/plugin.min.js');

tinymce.init({
    selector: 'textarea',
    plugins: [
      'advlist autolink link image lists charmap eqneditor print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'table insertdatetime save table contextmenu directionality emoticons template paste textcolor',
      'code jbimages filemanager'
    ],
    //content_css: '<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/plugins/equationeditor/build/mathquill.css',
    toolbar: [
        'newdocument | bold italic underline | strikethrough alignleft aligncenter alignright alignjustify | print preview media fullpage | forecolor backcolor emoticons| styleselect formatselect fontselect fontsizeselect',
        'link image jbimages media | charmap eqneditor cut copy paste | bullist numlist outdent indent | blockquote | insertfile undo redo | removeformat subscript superscript'
    ],
    menubar: false
});
 </script>
 
<style>
.tabbtn{margin-top: 2px !important;margin-right: 2px !important;margin-bottom: 0px !important;}
</style>
<?php $isEdit = isset($details) ? true : false; ?>


<div class="clearfix"></div>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">

            <div class="x_content">
                <?php if(!empty($isEdit)){$questionId = @$details->question_id;}?>
                <form action="<?php echo base_url("data/edit_question_submit/$questionId");?>" method="post" name="addEditform" id="addEditform" class="form-horizontal form-wizard" enctype='multipart/form-data' >

                    <!--<div class="row" id="first_form">-->
                    <div class="step" id="firstStep">
                        <span class="section">Please Complete the information below</span>
                        
                        
                        <div class="item form-group">
                            <label class="control-label col-md-2" for="board_id">Select Board <span class="required">*</span></label>
                            <div class="col-md-4">
                                <select name="board_id" id="board_id" class='form-control' onchange="setBoard(document.addEditform.board_id.options[ document.addEditform.board_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="">---Select Board---</option>
                                    <?php
                                    if (!empty($isEdit)) {
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
                            <!--                        </div>
                                                    <div class="item form-group">-->
                            <label class="control-label col-md-2" for="level_id">Select Level <span class="required">*</span></label>
                            <div class="col-md-4">
                                <select name="level_id"  id="level_id" class='form-control' onchange="setLevel(document.addEditform.level_id.options[ document.addEditform.level_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="">---Select Level---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($qlevels as $level) {
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
                            <label class="control-label col-md-2" for="stream_id">Select Stream</label>
                            <div class="col-md-4">
                                <select name="stream_id" id="stream_id" class='form-control' onchange="setStream(document.addEditform.stream_id.options[ document.addEditform.stream_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="">---Select Stream---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($qstreams as $stream) {
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
                            <!--                        </div>
                                                    <div class="item form-group">-->
                            <label class="control-label col-md-2" for="page_type">Select Course</label>
                            <div class="col-md-4">
                                <select name="course_id" id="course_id" class='form-control' onchange="setCourse(document.addEditform.course_id.options[document.addEditform.course_id.selectedIndex].value);">
                                    <option value="">---Select Course---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($qcourses as $course) {
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
                            <label class="control-label col-md-2" for="page_type">Select Department</label>
                            <div class="col-md-4">
                                <select name="department_id"  id="department_id" class='form-control'>
                                    <option value="">---Select Department---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($qdepartments as $department) {
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
                            <label class="control-label col-md-2" for="page_type">Select Year</label>

                            <div class="col-md-4">
                                
                                <select name="year" id="year" class='form-control' onchange="setYear(document.addEditform.year.options[document.addEditform.year.selectedIndex].value);">
                                    <option value="">---Select Year---</option>
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
                            <!--                        </div>
                                                    <div class="form-group">-->
                            <label class="control-label col-md-2" for="content">Select Semester</label>
                            <div class="col-md-4">
                                <select name="semester" id="semester" class='form-control' onchange="setSemester(document.addEditform.semester.options[document.addEditform.semester.selectedIndex].value);">
                                <option value="">---Select Semester---</option>
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
                            <label class="control-label col-md-2" for="subject_id">Select Subject <span class="required">*</span></label>
                            <div class="col-md-4">
                                <select name="subject_id" id="subject_id" class='subject_id select2_single form-control' onchange="setSubject(document.addEditform.subject_id.options[document.addEditform.subject_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="">---Select Subject---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($qsubjects as $subject) {
                                            $subjectIDs = $subject->subject_id;
                                            $subjectBoard_id = $subject->board_id;
                                            $subjectLevel_id = $subject->level_id;
                                            $subjectStream_id = $subject->stream_id;
                                            $subjectCourseID = $subject->course_id;
                                            $subjectYear = $subject->year;
                                            $subjectSemester = $subject->semester;
                                            $subjectDepartment_id = $subject->department_id;
                                            $subject_year = $subject->year;
                                            $subjectName = $subject->subject_name;
                                            if (($details->year == $subjectYear || $details->semester == $subjectSemester) && ($details->course_id == $subjectCourseID || $details->board_id == $subjectBoard_id || $details->level_id == $subjectLevel_id )) {
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
                            <!--                        </div>
                                                    <div class="form-group">-->
                            <label class="control-label col-md-2" for="content">Select Chapter <span class="required">*</span></label>
                            <div class="col-md-4">
                                <select name="chapter_id" id="chapter_id" class='form-control' data-rule-required="true" onchange="setChapter(document.addEditform.chapter_id.options[document.addEditform.chapter_id.selectedIndex].value);">
                                    <option value="">---Select Chapter---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($qchapters as $chapter) {
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
                            <label class="control-label col-md-2" for="content">Select Unit</label>
                            <div class="col-md-4">
                                <select name="unit_id"  id="unit_id" class='form-control' onchange="setUnit(document.addEditform.unit_id.options[document.addEditform.unit_id.selectedIndex].value);">
                                    <option value="">---Select Unit---</option>
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

                                                <option value="<?php echo $unitIDs; ?>" <?php
                                                        if (($isEdit) && ($details->unit_id == $unitIDs)) {
                                                            echo "selected";
                                                        }
                                                        ?>> <?php echo $unitName; ?> </option>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>
                            <!--                        </div>
                                                    
                                                    <div class="form-group" id="subunit">-->
                            <label class="control-label col-md-2" for="subunit_id">Select Sub-Unit</label>
                            <div class="col-md-4">
                                <select name="subunit_id"  id="subunit_id" class='form-control' >
                                    <option value="">---Select Sub-Unit---</option>
                                    <?php
                                    if (!empty($isEdit)) {
                                        foreach ($subunits as $subUnit) {
                                            $subunitIDs = $subUnit->subunit_id;
                                            $subunitLevelID = $subUnit->level_id;
                                            $subunitStreamID = $subUnit->stream_id;
                                            $subunitUnitID = $subUnit->unit_id;
                                            $subunitName = $subUnit->course_name;
                                            if ($details->unit_id == $subunitUnitID) {
                                                ?>

                                                <option value="<?php echo $subunitIDs; ?>" <?php
                                                        if (($isEdit) && ($details->subunit_id == $subunitIDs)) {
                                                            echo "selected";
                                                        }
                                                        ?>> <?php echo $subunitName; ?> </option>
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
                                <select name="question_set" id="question_set">
                                    <option value="">Select Set</option>
                                    <option value="A" <?php if (!empty($isEdit)) {if ($details->question_set == "A") { ?>selected="selected" <?php }}?>>A</option>
                                    <option value="B" <?php if (!empty($isEdit)) {if ($details->question_set == "B") { ?>selected="selected" <?php }}?>>B</option>
                                    <option value="C" <?php if (!empty($isEdit)) {if ($details->question_set == "C") { ?>selected="selected" <?php }}?>>C</option>
                                </select>   
                            </div>

                            <div class="form-group col-sm-6 my-form-element">
                                <label for="textitem">Question Tags</label>
                                <select name="question_tag">
                                    <option value="">Select Ques. Tags</option>
                                    <option value="very_short" <?php if (!empty($isEdit)) {if ($details->question_tag == "very_short") { ?>selected="selected" <?php }}?>>Very Short</option>
                                    <option value="short" <?php if (!empty($isEdit)) {if ($details->question_tag == "short") { ?>selected="selected" <?php }}?>>Short</option>
                                    <option value="long" <?php if (!empty($isEdit)) {if ($details->question_tag == "long") { ?>selected="selected" <?php }}?>>Long</option>
                                    <option value="theory" <?php if (!empty($isEdit)) {if ($details->question_tag == "theory") { ?>selected="selected" <?php }}?>>Theory</option>
                                    <option value="practical" <?php if (!empty($isEdit)) {if ($details->question_tag == "practical") { ?>selected="selected" <?php }}?>>Practical</option>
                                    <option value="short_note" <?php if (!empty($isEdit)) {if ($details->question_tag == "short_note") { ?>selected="selected" <?php }}?>>Write Short Note</option>
                                </select> 
                            </div>
                            <!--
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
                                <?php for ($i = $previous10Year; $i <= $after10Year; $i++) { ?>
                                        <option <?php if (@$isEdit) {if ($i == $details->appeared_year) { ?>selected="selected" <?php }} elseif ($i == $c_year) { ?>selected="selected" <?php } ?>value="<?php echo $i ?>"><?php echo $i; ?></option>
                                <?php } ?>
                                </select>
                                <input type="text" id="datepicker" class="form-control" name="template_title" value="<?php if (@$isEdit) echo $details->template_title; ?>" data-rule-required="true" />
                            </div>
                            -->
                            <script>
                                $(document).ready(function(){
                                    $('#change_date').on('change', function() {
                                        if ( this.value == 'bs')
                                      {
                                        $("#bs_date").show();
                                        $("#ad_date").hide();
                                      }else if ( this.value == 'ad')
                                      {
                                        $("#ad_date").show();
                                        $("#bs_date").hide();
                                      }
                                    });
                                });
                            </script>
                            <?php
                                   $currentDate = date('Y-m-d');
                                    $c_year = date('Y', strtotime($currentDate));
                                    $month = date('F', strtotime($currentDate));
                                    $previous10Year = $c_year - 10;
                                    $after10Year = $c_year + 10;
                                    if(!empty($c_year_n)){
                                        $previous_n_10Year = $c_year_n - 10;
                                        $after_n_10Year = $c_year_n + 10;
                                    }
                                    //echo $c_year_n;
                                    ?>
                            <div class="form-group col-sm-6 my-form-element">
                                <div class="">
                                    <!--<i class="fa fa-angle-down"></i>-->
                                    <!--<span class="">-->
                                        <select name="date_type" class="col-sm-4 btn btn-primary" id="change_date">
                                            <option value="">Date Type</option>
                                            <option value="bs" id="bs" <?php if (!empty($isEdit)) {if ($details->date_type == "bs") { ?>selected="selected" <?php }} elseif (empty($isEdit)) { ?>selected="selected" <?php } ?> >B.S.</option>
                                            <option value="ad" id="ad" <?php if (!empty($isEdit)) {if ($details->date_type == "ad") { ?>selected="selected" <?php }} ?>>A.D.</option>
                                            
                                        </select>
                                    <!--</span>-->
                                    
                                    <select name="appeared_year" id="ad_date" class="col-sm-6 ui-datepicker-year" style="display:none;" ><!-- data-event="change" data-handler="selectYear"-->
                                    <?php for ($i = $previous10Year; $i <= $c_year; $i++) { ?>
                                        <option <?php if (!empty($isEdit)) {if ($i == $details->appeared_year) { ?>selected="selected" <?php }} elseif ($i == $c_year) { ?>selected="selected" <?php } ?> value="<?php echo $i ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                    </select>

                                    <select name="appeared_year" id="bs_date" class="col-sm-6 ui-datepicker-year"><!-- data-event="change" data-handler="selectYear"-->
                                    <?php for ($n = $previous_n_10Year; $n <= $c_year_n; $n++) { ?>
                                        <option <?php if (!empty($isEdit)) {if ($n == $details->appeared_year) {?>selected="selected" <?php }} elseif ($n == $c_year_n) { ?>selected="selected" <?php } ?>value="<?php echo $n ?>"><?php echo $n; ?></option>
                                    <?php } ?>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="form-group col-sm-6 my-form-element">
                                <label for="textitem">Marks</label>
                                <input type="text" class="form-control" name="mark" value="<?php if (@$isEdit) echo $details->mark; ?>"/>
                            </div>

                            <div class="form-group col-sm-6 my-form-element">
                                <label for="textitem">Question Type</label>
                                <select name="question_type" class="form-control myselectbox" id="<?php echo $i; ?>">
                                    <option value="">Select Type</option>
                                    <option value="Text Entry" <?php if (!empty($isEdit)) {
                                        if ($details->question_type == "Text Entry") {
                                            echo "selected";
                                        }
                                    } ?>>Text Entry</option>
                                    <option value="Image" <?php if (!empty($isEdit)) {
                                        if ($details->question_type == "Image") {
                                            echo "selected";
                                        }
                                    } ?>>Image</option>
                                    <option value="Video" <?php if (!empty($isEdit)) {
                                        if ($details->question_type == "Video") {
                                            echo "selected";
                                        }
                                    } ?>>Video</option>
                                    <option value="Drop Down" <?php if (!empty($isEdit)) {
                                        if ($details->question_type == "Drop Down") {
                                            echo "selected";
                                        }
                                    } ?>>Drop Down</option>
                                    <option value="Radio Buttons" <?php if (!empty($isEdit)) {
                                        if ($details->question_type == "Radio Buttons") {
                                            echo "selected";
                                        }
                                    } ?>>Radio Buttons</option>
                                    <option value="Checkboxes" <?php if (!empty($isEdit)) {
                                        if ($details->question_type == "Checkboxes") {
                                            echo "selected";
                                        }
                                    } ?>>Checkboxes</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6 my-form-element">
                                <label for="question_no">Question No.</label>
                                <input type="text" class="form-control" name="question_no" id="question_no" value="<?php if (@$isEdit) echo $details->question_no; ?>"/>
                            </div>
                            <div class="row listContainer" id="myListsTable">
                                <div class="form-group col-sm-12 my-form-element">
                                    <label for="textitem">Question</label>
                                    <textarea name="question" id="question" class="form-control questionFull" rows="6">
                                        <?php
                                        if (@$isEdit) {
                                            echo $details->question;
                                        }
                                        ?>
                                    </textarea>
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
                                    <option value="1" <?php if (($isEdit) && ($details->status == '1')) {
                                            echo "selected";
                                        } ?>> Active </option>
                                    <option value="0" <?php if (($isEdit) && ($details->status == '0')) {
                                            echo "selected";
                                        } ?>> InActive </option>
                                </select>
                            </div>
                        </div>
<!--                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-3">
                                <button type="submit" name="submitTemplate" class="btn btn-primary submit-btn pull-right" id="next" value="Next">Next</button>
                                <button type="button" class="btn">Cancel</button>
                                <button type="button" onclick="history.go(-1);" class="btn btn-primary">Cancel</button>
                            </div>
                        </div>-->
                    </div>
                    
                    

                    <!--<div class="row featureHolder" id="second_form">-->
                    <div class="step" id="secondStep">
                        <div class="x_panel" style="background-color: #f7f7f7;">
                            <!--                            <div id="withoutSubquestion">
                                                            <button type="button" onclick="add('option')">Add Option</button>
                                                            <div id="option"></div>
                                                            <button type="button" onclick="add('hint')">Add Hint</button>
                                                            <div id="hint"></div>
                                                            <button type="button" onclick="add('answer')">Add Answer</button>
                                                            <div id="answer"></div>
                                                            <button type="button" onclick="add('reason')">Add Reason</button>
                                                            <div id="reason"></div>
                                                            <button type="button" onclick="add('description')">Add Description</button>
                                                            <div id="description"></div>
                                                        </div>-->

                            <div id="withoutSubquestion" class='subquestion'>
                                <?php
                                    $questionID = $details->question_id;
                                    $qoptions = $this->db->query("select * from hya_data_option where question_id=$questionID AND subquestion_id=0")->result();
                                    $qhints = $this->db->query("select * from hya_data_hint where question_id=$questionID AND subquestion_id=0")->result();
                                    $qanswers = $this->db->query("select * from hya_data_answer where question_id=$questionID AND subquestion_id=0")->result();
                                    $qreasons = $this->db->query("select * from hya_data_reason where question_id=$questionID AND subquestion_id=0")->result();
                                    $qdescriptions = $this->db->query("select * from hya_data_description where question_id=$questionID AND subquestion_id=0")->result();
                                
//                                    var_dump($qoptions,$qhints,$qanswers,$qreasons);die;
                                    ?>
                                
                                
                                <button type="button" id="option_1" onclick="add('option')" class="row btn btn-dark tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Option 1</button>
                                <div id="option" class="row" style="padding: 10px;border: 2px solid rgba(52, 73, 94, 0.88);">
                                        <?php
                                            if (!empty($qoptions)) {
                                                foreach ($qoptions as $oq) {
                                        ?>
                                                   
                                                    <div class="form-group col-sm-6 my-form-element">
                                                            <label for="textitem" style="background-color: #73879c;color: #FFF;">Option
                                                                <a class="btn btn-danger remove_option pull-right" id='<?php echo $oq->option_id;?>' href="#">
                                                                    <i class="fa fa-close"></i>
                                                                </a>
                                                            
                                                                <div class="clearfix"></div>
                                                                <textarea id="uniqID" class="form-control " rows="6" name="option[]"><?php echo $oq->option_name;?></textarea>
                                                            </label>
                                                    </div>
                                                     
                                        <?php
                                                }
                                            }
                                        ?>
                                </div>
                                <button type="button" id="hint_1" onclick="add('hint')" class="row btn btn-success tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Hint 1</button>
                                <div id="hint" class="row" style="padding: 10px;border: 2px solid #26b99a;">
                                    <?php
                                        if (!empty($qhints)) {
                                            foreach ($qhints as $hq) {
                                    ?>
                                    
                                                <div class="form-group col-sm-6 my-form-element">
                                                        <label for="textitem" style="background-color: #26b99a;color: #FFF;">Hint
                                                            <a class="btn btn-danger delete pull-right" href="#">
                                                                <i class="fa fa-close"></i>
                                                            </a>
                                                            <div class="clearfix"></div>
                                                            <textarea id="uniqID" class="form-control " rows="6" name="hint[]"><?php echo $hq->hint;?></textarea>
                                                        </label>
                                                </div>
                                    
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                                <button type="button" id="answer_1" onclick="add('answer')" class="row btn btn-info tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Answer 1</button>
                                <div id="answer" class="row" style="padding: 10px;border: 2px solid #5bc0de;">
                                    <?php
                                    if (!empty($qanswers)) {
                                        foreach ($qanswers as $aq) {
                                    ?>
                                        <div class="form-group col-sm-6 my-form-element">
                                                <label for="textitem" style="background-color: #5bc0de;color: #FFF;">Answer
                                                    <a class="btn btn-danger delete pull-right" href="#">
                                                        <i class="fa fa-close"></i>
                                                    </a>
                                                    <div class="clearfix"></div>
                                                    <textarea id="uniqID" class="form-control " rows="6" name="answer[]"><?php echo $aq->answer_name;?></textarea>
                                                </label>
                                        </div>
                                           
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <button type="button" id="reason_1" onclick="add('reason')" class="row btn btn-warning tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Reason 1</button>
                                <div id="reason" class="row" style="padding: 10px;border: 2px solid #f0ad4e;">
                                    <?php
                                        if (!empty($qreasons)) {
                                            foreach ($qreasons as $rq) {
                                    ?>
                                            <div class="form-group col-sm-6 my-form-element">
                                                    <label for="textitem" style="background-color: #f0ad4e;color: #FFF;">Reason
                                                        <a class="btn btn-danger delete pull-right" href="#">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                    
                                                        <div class="clearfix"></div>
                                                        <textarea id="uniqID" class="form-control " rows="6" name="reason[]"><?php echo $rq->reason;?></textarea>
                                                    </label>
                                            </div>
                                                
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                                <button type="button" id="description_1" onclick="add('description')" class="row btn btn-primary tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Description 1</button>
                                <div id="description" class="row" style="padding: 10px;border: 2px solid #1a82c3;">
                                    <?php
                                        if (!empty($qdescriptions)) {
                                            foreach ($qdescriptions as $dq) {
                                    ?>
                                        <div class="form-group col-sm-6 my-form-element">
                                                <label for="textitem" style="background-color: #1a82c3;color: #FFF;">Description
                                                    <a class="btn btn-danger delete pull-right" href="#">
                                                        <i class="fa fa-close"></i>
                                                    </a>
                                                
                                                    <div class="clearfix"></div>
                                                    <textarea id="uniqID" class="form-control " rows="6" name="description[]"><?php echo $dq->description;?></textarea>
                                                </label>
                                        </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>

                            </div>
                        </div>


                        <button type="button" class="btn btn-primary addSubQuestion" onclick="add('subquestion')">Add Sub Question</button>
                        <hr>
                        <div class="x_panel" style="background-color: #f7f7f7;">
                            <!--<div class="x_title row" style="background-color: #73879c;color: #FFF;">
                                <h2 >Sub Question 1</h2>
                                <a class="btn btn-danger delete pull-right"  href="#"><i class="fa fa-trash-o fa-lg"></i></a>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content row">
                                <div class="btn-toolbar editor">
                                    <textarea id="question" class="form-control subquestionEditor1" name="subquestion[]"> </textarea>
                                </div>
                                <br />
                            </div>-->
                            <!--                            <div id="subquestion-1" class="subquestion">
                                                            <button type="button" onclick="addSub('option','1')">Add Option</button>
                                                            <div id="option"></div>
                                                            <button type="button" onclick="addSub('hint','1')">Add Hint</button>
                                                            <div id="hint"></div>
                                                            <button type="button" onclick="addSub('answer','1')">Add Answer</button>
                                                            <div id="answer"></div>
                                                            <button type="button" onclick="addSub('reason','1')">Add Reason</button>
                                                            <div id="reason"></div>
                                                            <button type="button" onclick="addSub('description','1')">Add Description</button>
                                                            <div id="description"></div>
                                                        </div>-->
                                <?php
                                        $this->db->select("*");
                                        $this->db->from("hya_data_subquestion");
                                        $this->db->where("question_id", $details->question_id);
                                        $results = $this->db->get()->result();
                                        if (!empty($results)) {
                                            $count=1;
                                            foreach ($results as $key => $result) {
                                                
                                            $options = $this->db->query("select * from hya_data_option where question_id=$details->question_id AND subquestion_id=$result->subquestion_id")->result();
                                            $hints = $this->db->query("select * from hya_data_hint where question_id=$details->question_id AND subquestion_id=$result->subquestion_id")->result();
                                            $answers = $this->db->query("select * from hya_data_answer where question_id=$details->question_id AND subquestion_id=$result->subquestion_id")->result();
                                            $reasons = $this->db->query("select * from hya_data_reason where question_id=$details->question_id AND subquestion_id=$result->subquestion_id")->result();
                                            $descriptions = $this->db->query("select * from hya_data_description where question_id=$details->question_id AND subquestion_id=$result->subquestion_id")->result();
                                ?>
                            <div id="subquestion-<?php echo $count;?>" class="subquestion">
                                <div class="x_title row" style="background-color: #73879c;color: #FFF;">
                                    <h3>Sub-Question-<?php echo $count;?></h3>
                                    <a class="btn btn-danger delete pull-right"  href="#"><i class="fa fa-trash-o fa-lg"></i></a>
                                    <div class="clearfix"></div>
                                </div>

                                <textarea id="template_description" class="form-control ckeditor" name="subquestion[<?php echo $result->subquestion_id; ?>]"><?php echo $result->subquestion_name; ?> </textarea><a class="btn btn-danger delete"  href="#"><i class="fa fa-trash-o fa-lg"></i> Delete</a>
                                <div class="clearfix"></div>
                                
                                <button type="button" id="option_1" onclick="addSub('option', <?php echo $count ;?>)" class="row btn btn-dark tabbtn">
                                    <i class="fa fa-plus-square-o fa-lg"></i> Option 1</button>
                                    <div id="option<?php echo $count ;?>" class="row" style="padding: 10px;border: 2px solid rgba(52, 73, 94, 0.88);">
                                        <?php
                                            if (!empty($options)) {
                                                foreach ($options as $o) {
                                        ?>
                                                <div class="form-group col-sm-6 my-form-element">
                                                    <label for="textitem" style="background-color: #73879c;color: #FFF;">Option <?php echo $count ;?>
                                                        <a class="btn btn-danger remove_option pull-right" id='<?php echo $o->option_id;?>' href="#">
                                                            <i class="fa fa-close"></i>
                                                        </a>
                                                        <div class="clearfix"></div>
                                                        <textarea id="uniqID" class="form-control " rows="6" name="subquestion[option][<?php echo $key ?>][]"><?php echo $o->option_name;?></textarea>
                                                    </label>
                                                </div>
                                                        
                                        <?php
                                                }
                                            }
                                        ?>
                                    </div>
                                <button type="button" id="hint_1" onclick="addSub('hint', <?php echo $count ;?>)" class="row btn btn-success tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Hint 1</button>
                                <div id="hint<?php echo $count ;?>" class="row" style="padding: 10px;border: 2px solid #26b99a;">
                                    <?php
                                        if (!empty($hints)) {
                                            foreach ($hints as $h) {
                                    ?>
                                            <div class="form-group col-sm-6 my-form-element">
                                                <label for="textitem" style="background-color: #26b99a;color: #FFF;">Hint <?php echo $count ;?>
                                                    <a class="btn btn-danger delete pull-right" href="#">
                                                        <i class="fa fa-close"></i>
                                                    </a>
                                                    <div class="clearfix"></div>
                                                    <textarea id="uniqID" class="form-control " rows="6" name="subquestion[hint][<?php echo $key ?>][]"><?php echo $h->hint;?></textarea>
                                                </label>
                                            </div>
                                                       
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                                <button type="button" id="answer_1" onclick="addSub('answer',<?php echo $count ;?>)" class="row btn btn-info tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Answer 1</button>
                                <div id="answer<?php echo $count ;?>" class="row" style="padding: 10px;border: 2px solid #5bc0de;">
                                    <?php
                                        if (!empty($answers)) {
                                            foreach ($answers as $a) {
                                    ?>
                                    
                                        <div class="form-group col-sm-6 my-form-element">
                                            <label for="textitem" style="background-color: #5bc0de;color: #FFF;">Answer <?php echo $count ;?>
                                                <a class="btn btn-danger delete pull-right" href="#">
                                                    <i class="fa fa-close"></i>
                                                </a>
                                                <div class="clearfix"></div>
                                                <textarea id="uniqID" class="form-control " rows="6" name="subquestion[answer][<?php echo $key ?>][]"><?php echo $a->answer_name;?></textarea>
                                            </label>
                                        </div>
                                                        
                                                
                                    <?php
                                            }
                                        }
                                    ?>
                                </div>
                                <button type="button" id="reason_1" onclick="addSub('reason', <?php echo $count ;?>)" class="row btn btn-warning tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Reason 1</button>
                                <div id="reason<?php echo $count ;?>" class="row" style="padding: 10px;border: 2px solid #f0ad4e;">
                                    <?php
                                            if (!empty($reasons)) {
                                                foreach ($reasons as $r) {
                                    ?>
                                            <div class="form-group col-sm-6 my-form-element">
                                                <label for="textitem" style="background-color: #f0ad4e;color: #FFF;">Reason <?php echo $count ;?>
                                                    <a class="btn btn-danger delete pull-right" href="#">
                                                        <i class="fa fa-close"></i>
                                                    </a>
                                                    <div class="clearfix"></div>
                                                    <textarea id="uniqID" class="form-control " rows="6" name="subquestion[reason][<?php echo $key ?>][]"><?php echo $r->reason;?></textarea>
                                                </label>
                                            </div>
                                    <?php
                                                }
                                            }
                                    ?>
                                </div>
                                <button type="button" id="description_1" onclick="addSub('description',<?php echo $count ;?>)" class="row btn btn-primary tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Description 1</button>
                                <div id="description<?php echo $count ;?>" class="row" style="padding: 10px;border: 2px solid #1a82c3;">
                                    <?php
                                            if (!empty($descriptions)) {
                                                foreach ($descriptions as $d) {
                                    ?>      
                                            <div class="form-group col-sm-6 my-form-element">
                                                <label for="textitem" style="background-color: #5bc0de;color: #FFF;">Description <?php echo $count ;?>
                                                    <a class="btn btn-danger delete pull-right" href="#">
                                                        <i class="fa fa-close"></i>
                                                    </a>
                                                    <div class="clearfix"></div>
                                                    <textarea id="uniqID" class="form-control " rows="6" name="subquestion[description][<?php echo $key ?>][]"><?php echo $d->description;?></textarea>
                                                </label>
                                            </div>
                                    

                                        <?php
                                                }
                                            }
                                        ?>
                                </div>
                            
                                   
                            </div>
                             <?php
                                            $count++;}
                                            } else {
                                                ?>
                            <!--<div ></div>-->
                            <?php
                                               }
                //$qdescriptions=$this->db->query("select * from hya_data_description where question_id=$details->question_id ")->result(); 
                ?>
                        </div>

                    </div>
                    <div class="form-actions">
                            <input type="reset" class="btn" value="Back" id="back">
                            <input type="submit" class="btn btn-primary" value="Submit" id="next">
                    </div>

<!--                    <div class="ln_solid" style="border-top: 12px solid #e5e5e5;"></div>
                    <div class="form-group col-sm-12 my-form-element">
                        <input type="submit" name="submitQuestion" class="btn btn-primary" value="Save"/>
                        <button type="button" class="btn" id="cancel">Cancel</button>
                    </div>-->
                </form>

            </div>
        </div>
    </div>
</div>


<script>

$(function(){
        $("#level_id").change(function () {
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
    });
    
    
    function initMCEall(){
        tinymce.init({
            selector: 'textarea',
            plugins: [
                'advlist autolink link image lists charmap eqneditor print preview hr anchor pagebreak spellchecker',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table insertdatetime save table contextmenu directionality emoticons template paste textcolor',
                'code jbimages filemanager'
              ],
              //content_css: '<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/plugins/equationeditor/build/mathquill.css',
              toolbar: [
                  'newdocument | bold italic underline | strikethrough alignleft aligncenter alignright alignjustify | print preview media fullpage | forecolor backcolor emoticons| styleselect formatselect fontselect fontsizeselect',
                  'link image jbimages media | charmap eqneditor cut copy paste | bullist numlist outdent indent | blockquote | insertfile undo redo | removeformat subscript superscript'
              ],
            menubar:false
        });
    }
    
    function add(option){
        var uniqTextID = Math.random();
        if (option === 'subquestion') {
            var visible = $(".subquestion").is(":visible");
            if (visible) {
                var i = $(".subquestion").length;
                //console.log(i);
        var subquestion = '<div class="x_panel" style="background-color: #f7f7f7;">';
                subquestion += '<div class="x_title row" style="background-color: #73879c;color: #FFF;">';
                    subquestion += '<h2 >Sub-Question ' + (i + 1) + '</h2>';
                    subquestion += '<a class="btn btn-danger delete pull-right"  href="#"><i class="fa fa-trash-o fa-lg"></i></a>';
                        subquestion += '<div class="clearfix"></div>';
                subquestion += '</div>';
                subquestion += '<div class="x_content row">';
                    subquestion += '<div class="btn-toolbar">';
                        subquestion += '<textarea id="'+uniqTextID+'" class="form-control" name="subquestion[question][]"> </textarea>';
                    subquestion += '</div>';
                subquestion += '</div>';
                subquestion += '<br/>';
            subquestion += '</div>';

                subquestion += '<div id="subquestion-'+ (i + 1) +'" class="subquestion">';
                    subquestion += '<button type="button" id="option_' + (i + 1) + '" onclick="addSub(\'option\',' + (i + 1) + ')" class="row btn btn-dark tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Option ' + (i + 1) + '</button>';
                    subquestion += '<div id="option'+ (i + 1) +'" class="row" style="padding: 10px;border: 2px solid rgba(52, 73, 94, 0.88);"></div>';
                    subquestion += '<button type="button" id="hint_' + (i + 1) + '" onclick="addSub(\'hint\',' + (i + 1) + ')" class="row btn btn-success tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Hint ' + (i + 1) + '</button>';
                    subquestion += '<div id="hint'+ (i + 1) +'" class="row" style="padding: 10px;border: 2px solid #26b99a;"></div>';
                    subquestion += '<button type="button" id="answer_' + (i + 1) + '" onclick="addSub(\'answer\',' + (i + 1) + ')" class="row btn btn-info tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Answer ' + (i + 1) + '</button>';
                    subquestion += '<div id="answer'+ (i + 1) +'" class="row" style="padding: 10px;border: 2px solid #5bc0de;"></div>';
                    subquestion += '<button type="button" id="reason_' + (i + 1) + '" onclick="addSub(\'reason\',' + (i + 1) + ')" class="row btn btn-warning tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Reason ' + (i + 1) + '</button>';
                    subquestion += '<div id="reason'+ (i + 1) +'" class="row" style="padding: 10px;border: 2px solid #f0ad4e;"></div>';
                    subquestion += '<button type="button" id="description_' + (i + 1) + '" onclick="addSub(\'description\',' + (i + 1) + ')" class="row btn btn-primary tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Description ' + (i + 1) + '</button>';
                    subquestion += '<div id="description'+ (i + 1) +'" class="row" style="padding: 10px;border: 2px solid #1a82c3;"></div>';
                subquestion += '</div>';
                //subquestion += '</div>';

                $('.subquestion').append(subquestion);
                initMCEall();
            } else {
                $("#subquestion-1").show();
                //$('#withoutSubquestion').hide();
                //var input='<textarea id="question" class="form-control ckeditor" name="subquestion[]"> </textarea><a class="btn btn-danger delete"  href="#"><i class="fa fa-trash-o fa-lg"></i> Delete</a>';
        var subquestion = '<div class="x_panel" style="background-color: #f7f7f7;">';
                subquestion += '<div class="x_title row" style="background-color: #73879c;color: #FFF;">';
                    subquestion += '<h2 >Sub-Question 1</h2>';
                    subquestion += '<a class="btn btn-danger delete pull-right" href="#"><i class="fa fa-trash-o fa-lg"></i></a>';
                    subquestion += '<div class="clearfix"></div>';
                subquestion += '</div>';
                subquestion += '<div class="x_content row">';
                    subquestion += '<div class="btn-toolbar">';
                        subquestion += '<textarea id="'+uniqTextID+'" class="form-control" name="subquestion[question][]"> </textarea>';
                    subquestion += '</div>';
                subquestion += '<br />';
                subquestion += '</div>';
            subquestion += '</div>';

                $('#subquestion-1').prepend(subquestion);
                initMCEall();
                return;
            }
        }
        //var input="<input class='form-control' data-rule-required='true' type='text' name='"+option+"[]' value='"+option+"' ><a class='btn btn-danger delete'  href='#'><i class='fa fa-trash-o fa-lg'></i> Delete</a>";

        if (option == 'option') {
            var btn_color = 'dark';
            var background_style = 'background-color: #73879c;color: #FFF;';
        }
        if (option == 'hint') {
            var btn_color = 'success';
            var background_style = 'background-color: #26b99a;color: #FFF;';
        }
        if (option == 'answer') {
            var btn_color = 'info';
            var background_style = 'background-color: #5bc0de;color: #FFF;';
        }
        if (option == 'reason') {
            var btn_color = 'warning';
            var background_style = 'background-color: #f0ad4e;color: #FFF;';
        }
        if (option == 'description') {
            var btn_color = 'primary';
            var background_style = 'background-color: #1a82c3;color: #FFF;';
        }

    var input = '<div class="form-group col-sm-6 my-form-element">';
                input +='<label for="textitem" style="'+background_style+'">'+option ;
                    input +='<a class="btn btn-danger delete pull-right" href="#">';
                        input +='<i class="fa fa-close"></i>';
                    input +='</a>';
                input +='<div class="clearfix"></div>';
            input +='<textarea id="'+uniqTextID +'" class="form-control " rows="6" name="'+ option +'[]"></textarea>';
            input +='</label>';
        input +='</div>';

        $('#' + option).append(input);
        initMCEall();
    }


//      function addSub(suboption,num)
//      {
//          var input="<input class='form-control' data-rule-required='true' type='text' name='subquestion["+suboption+"]["+num+"][]' value='"+suboption+"' ><a class='btn btn-danger delete'  href='#'><i class='fa fa-trash-o fa-lg'></i> Delete</a>";
//          
////          var input="<input class='form-control' data-rule-required='true' type='text' name='"+suboption+"[]' value='"+suboption+"' ><a class='btn btn-danger delete'  href='#'><i class='fa fa-trash-o fa-lg'></i> Delete</a>";
//          $('#subquestion-'+num).find('#'+suboption).append(input);
//      }
    
    function addSub(suboption, num)
    {
        var uniqTextID = Math.random();
        
        if (suboption == 'option') {
            var btn_color = 'dark';
            var background_style = 'background-color: #73879c;color: #FFF;';
        }
        if (suboption == 'hint') {
            var btn_color = 'success';
            var background_style = 'background-color: #26b99a;color: #FFF;';
        }
        if (suboption == 'answer') {
            var btn_color = 'info';
            var background_style = 'background-color: #5bc0de;color: #FFF;';
        }
        if (suboption == 'reason') {
            var btn_color = 'warning';
            var background_style = 'background-color: #f0ad4e;color: #FFF;';
        }
        if (suboption == 'description') {
            var btn_color = 'primary';
            var background_style = 'background-color: #1a82c3;color: #FFF;';
        }

        
    var input = '<div class="form-group col-sm-6 my-form-element">';
            input +='<label for="textitem" style="'+background_style+'">'+suboption + num ;
            input +='<a class="btn btn-danger delete pull-right" href="#">';
                input +='<i class="fa fa-close remove_'+suboption+'"></i>';
            input +='</a>';
            
                input +='<div class="clearfix"></div>';
            input +='<textarea id="'+uniqTextID +'" class="form-control " rows="6" name="subquestion[' + suboption + '][' + num + '][]"></textarea>';
            input +='</label>';
        input +='</div>';
    $('#subquestion-' + num).find('#' + suboption+num).append(input);
        initMCEall();
        //tinymce.execCommand("mceAddControl", false, suboption + num);
    }
    



    $(".subquestion").on("click", ".remove_option", function (e) { //user click on remove text
            var _option_id = $(this).attr('id');
            $(this).html('<img src="<?php echo config_item('admin_images'); ?>ajax-loader.gif" />');
            $.post("<?php echo base_url("data/delete_ajax_option"); ?>", {option_id: _option_id},
                    function (data) {
                        $('a#' + _option_id + '').addClass(data);
                    });
            e.preventDefault();
            $(this).parent('label').parent('div').parent('div').remove();
            $(this).closest("i").remove();
            //j--;
        });
</script>