<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<?php
if(!empty($this->session->userdata('s_board_id'))){
    $s_board_id = @$this->session->userdata('s_board_id');
    $s_level_id = @$this->session->userdata('s_level_id');
    $s_stream_id = @$this->session->userdata('s_stream_id');
    $s_course_id = @$this->session->userdata('s_course_id');
    $s_department_id = @$this->session->userdata('s_department_id');
    $s_year = @$this->session->userdata('s_year');
    $s_semester = @$this->session->userdata('s_semester');
    $s_subject_id = @$this->session->userdata('s_subject_id');
    $s_chapter_id = @$this->session->userdata('s_chapter_id');
    $s_unit_id = @$this->session->userdata('s_unit_id');
    $s_subunit_id = @$this->session->userdata('s_subunit_id');
//    $s_question_set = @$this->session->userdata('s_question_set');
//    $s_question_tag = @$this->session->userdata('s_question_tag');
//    $s_appeared_year = @$this->session->userdata('s_appeared_year');
//    $s_question_type = @$this->session->userdata('s_question_type');
//    $s_question = @$this->session->userdata('s_question');
//    $s_mark = @$this->session->userdata('s_mark');
    
}

?>
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
                $subject_boardID = $subject->board_id;
                $subject_levelID = $subject->level_id;
                $subject_streamID = $subject->stream_id;
                $subject_courseID = $subject->course_id;
                $subject_departmentID = $subject->department_id;
                $subject_year = $subject->year;
                
                $subject_idd = $subject->subject_id;
                $subject_name = $subject->subject_name;
        ?>

                if (boardID == <?php echo $subject_boardID ?> && levelID == <?php echo $subject_levelID ?> && streamID == <?php echo $subject_streamID ?> && chosen == <?php echo $subject_year?>) {
                    selboxSubject.options[selboxSubject.options.length] = new Option("<?php echo $subject_name; ?>", "<?php echo $subject_idd; ?>");
                }
        <?php
            }
        }
        ?>

        <?php
        if (!empty($chapters)) {
            foreach ($chapters as $chapter) {
                $chapter_boardID = $chapter->board_id;
                $chapter_levelID = $chapter->level_id;
                $chapter_streamID = $chapter->stream_id;
                $chapter_courseID = $chapter->course_id;
                $chapter_departmentID = $chapter->department_id;
                $chapter_subjectID = $chapter->subject_id;
                $chapter_year = $chapter->year;
                
                $chapter_id = $chapter->chapter_id;
                $chapter_name = $chapter->chapter_name;
        ?>
                if (boardID == <?php echo $chapter_boardID ?> && levelID == <?php echo $chapter_levelID ?> && streamID == <?php echo $chapter_streamID ?> && chosen == <?php echo $chapter_year?>) {
                    selboxChapter.options[selboxChapter.options.length] = new Option("<?php echo $chapter_name; ?>", "<?php echo $chapter_id; ?>");
                }
        <?php
            }
        }
        ?>
                
        <?php
        if (!empty($units)) {
            foreach ($units as $unit) {
                $unit_boardID = $unit->board_id;
                $unit_levelID = $unit->level_id;
                $unit_streamID = $unit->stream_id;
                $unit_courseID = $unit->course_id;
                $unit_departmentID = $unit->department_id;
                $unit_subjectID = $unit->subject_id;
                $unit_chapterID = $unit->chapter_id;
                $unit_year = $unit->year;
                
                $unit_id = $unit->unit_id;
                $unit_name = $unit->unit_name;
        ?>
                if (boardID == <?php echo $unit_boardID ?> && levelID == <?php echo $unit_levelID ?> && streamID == <?php echo $unit_streamID ?> && chosen == <?php echo $unit_year?>) {
                    selboxChapter.options[selboxChapter.options.length] = new Option("<?php echo $unit_name; ?>", "<?php echo $unit_id; ?>");
                }
        <?php
            }
        }
        ?>
               

    }
    
    function setSemester(chosen) {

        var selboxSubject = document.addEditform.subject_id;
        var selboxChapter = document.addEditform.chapter_id;
        
        var boardID = document.getElementById("board_id").value;
        var levelID = document.getElementById("level_id").value;
        var streamID = document.getElementById("stream_id").value;
        var courseID = document.getElementById("course_id").value;
        var departmentID = document.getElementById("department_id").value;
        var year = document.getElementById("year").value;
        

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
                $subject_boardID = $subject->board_id;
                $subject_levelID = $subject->level_id;
                $subject_streamID = $subject->stream_id;
                $subject_courseID = $subject->course_id;
                $subject_departmentID = $subject->department_id;
                $subject_year = $subject->year;
                $subject_semester = $subject->semester;
                
                $subject_idd = $subject->subject_id;
                $subject_name = $subject->subject_name;
        ?>

                if (boardID == <?php echo $subject_boardID ?> && levelID == <?php echo $subject_levelID ?> && streamID == <?php echo $subject_streamID ?> && year == <?php echo $subject_year?> && chosen == <?php echo $subject_semester?>) {
                    selboxSubject.options[selboxSubject.options.length] = new Option("<?php echo $subject_name; ?>", "<?php echo $subject_idd; ?>");
                }
        <?php
            }
        }
        ?>

        <?php
        if (!empty($chapters)) {
            foreach ($chapters as $chapter) {
                $chapter_boardID = $chapter->board_id;
                $chapter_levelID = $chapter->level_id;
                $chapter_streamID = $chapter->stream_id;
                $chapter_courseID = $chapter->course_id;
                $chapter_departmentID = $chapter->department_id;
                $chapter_subjectID = $chapter->subject_id;
                $chapter_year = $chapter->year;
                $chapter_semester = $chapter->semester;
                
                $chapter_id = $chapter->chapter_id;
                $chapter_name = $chapter->chapter_name;
        ?>
                if (boardID == <?php echo $chapter_boardID ?> && levelID == <?php echo $chapter_levelID ?> && streamID == <?php echo $chapter_streamID ?> && year == <?php echo $chapter_year?> && chosen == <?php echo $chapter_semester?>) {
                    selboxChapter.options[selboxChapter.options.length] = new Option("<?php echo $chapter_name; ?>", "<?php echo $chapter_id; ?>");
                }
        <?php
            }
        }
        ?>
                
        <?php
        if (!empty($units)) {
            foreach ($units as $unit) {
                $unit_boardID = $unit->board_id;
                $unit_levelID = $unit->level_id;
                $unit_streamID = $unit->stream_id;
                $unit_courseID = $unit->course_id;
                $unit_departmentID = $unit->department_id;
                $unit_subjectID = $unit->subject_id;
                $unit_chapterID = $unit->chapter_id;
                $unit_year = $unit->year;
                $unit_semester = $unit->semester;
                
                $unit_id = $unit->unit_id;
                $unit_name = $unit->unit_name;
        ?>
                if (boardID == <?php echo $unit_boardID ?> && levelID == <?php echo $unit_levelID ?> && streamID == <?php echo $unit_streamID ?> && year == <?php echo $unit_year?> && chosen == <?php echo $unit_semester?>) {
                    selboxChapter.options[selboxChapter.options.length] = new Option("<?php echo $unit_name; ?>", "<?php echo $unit_id; ?>");
                }
        <?php
            }
        }
        ?>


    }
    
    function setSubject(chosen){
        var selbox = document.addEditform.chapter_id;
        
        var boardID = document.getElementById("board_id").value;
        var levelID = document.getElementById("level_id").value;
        var streamID = document.getElementById("stream_id").value;
        var courseID = document.getElementById("course_id").value;
        var departmentID = document.getElementById("department_id").value;
        var year = document.getElementById("year").value;
        var subject_id = document.getElementById("subject_id").value;
        
        
        selbox.options.length = 0;
        if (chosen == " ") {
            selbox.options[selbox.options.length] = new Option("--Select--", "");
        }
        selbox.options[selbox.options.length] = new Option("--Select Chapter--", "");
<?php
if (!empty($chapters)) {
    foreach ($chapters as $chapter) {
        $chapter_boardID = $chapter->board_id;
        $chapter_levelID = $chapter->level_id;
        $chapter_streamID = $chapter->stream_id;
        $chapter_courseID = $chapter->course_id;
        $chapter_departmentID = $chapter->department_id;
        $chapter_year = $chapter->year;
        $chapter_semester = $chapter->semester;
        $chapter_subjectID = $chapter->subject_id;
        
        $chapter_id = $chapter->chapter_id;
        $chapter_name = $chapter->chapter_name;
        ?>
            if (boardID == <?php echo $chapter_boardID ?> && levelID == <?php echo $chapter_levelID ?> && streamID == <?php echo $chapter_streamID ?> && year == <?php echo $chapter_year?> && chosen == <?php echo $chapter_subjectID?>) {
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
<!--<script type="text/javascript" src="<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/plugins/equationeditor/js/mathquill.min.js"></script>-->
<script>
//tinymce.PluginManager.load('equationeditor', '<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/plugins/equationeditor/build/plugin.min.js');

tinymce.init({
    selector: 'textarea.questionFull',
    plugins: [
      'advlist autolink link image lists charmap eqneditor print preview hr anchor pagebreak spellchecker',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'table insertdatetime save table contextmenu directionality emoticons paste textcolor',
      'code jbimages filemanager'
    ],
    //content_css: '<?php echo base_url(); ?>gears/admin/tinymce/js/tinymce/plugins/equationeditor/build/mathquill.css',
    toolbar: [
        'newdocument | bold italic underline | strikethrough alignleft aligncenter alignright alignjustify | print preview media fullpage | forecolor backcolor emoticons| styleselect formatselect fontselect fontsizeselect',
        'link image jbimages media | charmap eqneditor cut copy paste | bullist numlist outdent indent | blockquote | insertfile undo redo | removeformat subscript superscript'
    ],
    contextmenu: "cut copy paste link image inserttable | cell row column deletetable",
    //menubar:false,
    paste_merge_formats: false,
    paste_enable_default_filters: false,
    paste_remove_styles_if_webkit: false,   
    //    wirisimagebgcolor: '#FFFFFF',
//    wirisimagesymbolcolor: '#000000',
//    wiristransparency: 'true',
//    wirisimagefontsize: '16',
//    wirisimagenumbercolor: '#000000',
//    wirisimageidentcolor: '#000000',
//    wirisformulaeditorlang: 'es'
//    tiny_mce_wiris_formulaEditor,
//    tiny_mce_wiris_formulaEditorChemistry,
//    tiny_mce_wiris_CAS,

    //paste_data_images: true
    
//    theme_advanced_buttons3_add : "pastetext,pasteword,selectall",
//    paste_auto_cleanup_on_paste : true,
//    paste_preprocess : function(pl, o) {
//        // Content string containing the HTML from the clipboard
//        alert(o.content);
//        o.content = "-: CLEANED :-\n" + o.content;
//    },
//    paste_postprocess : function(pl, o) {
//        // Content DOM node containing the DOM structure of the clipboard
//        alert(o.node.innerHTML);
//        o.node.innerHTML = o.node.innerHTML + "\n-: CLEANED :-";
//    },
    
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
            <div class="row">
                <div class="pull-right">
                    <a href="<?php echo base_url("data/reset_add_question");?>" class="btn btn-dark">Reset Form</a>
                </div>
            </div>

            <div class="x_content">

                <form action="<?php echo base_url("data/add_question_submit");?>" method="POST" name="addEditform" id="addEditform" class="form-horizontal form-wizard" enctype='multipart/form-data' >
<!--                    <input type="hidden" value="<?php //if (!empty($isEdit)) {echo $details->token;} else {echo md5(uniqid(mt_rand(), True));}?>" name="token" />-->
                    <div class="step" id="firstStep">
                    <!--<div class="row" id="first_form">-->
                        <span class="section">Please Complete the information below</span>
                        
                        <div class="item form-group">
                            <label class="control-label col-md-2" for="board_id">Select Board<span class="required">*</span></label>
                            <div class="col-md-4">
                                <select name="board_id" id="board_id" class='form-control board_id' onchange="setBoard(document.addEditform.board_id.options[ document.addEditform.board_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="">---Select Board---</option>
                                    <?php
                                    if (!empty($boards)) {
                                        foreach ($boards as $board) {
                                            $boardID = $board->board_id;
                                            $boardName = $board->board_name;
                                            $boardSlug = $board->board_slug;
                                            $boardAlias = $board->board_alias;
                                    ?>
                                        <option value="<?php echo $boardID; ?>" <?php if (!empty($s_board_id) && ($s_board_id == $boardID)) {echo "selected";}?>><?php echo $boardName; ?> </option>
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
                                <select name="level_id" id="level_id" class='form-control level_id' onchange="setLevel(document.addEditform.level_id.options[ document.addEditform.level_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="">---Select Level---</option>
                                    <?php
                                    if (!empty($s_level_id)) {
                                        foreach ($levels as $level) {
                                            $levelBoardID = $level->board_id;
                                            $levelID = $level->level_id;
                                    
                                            if (!empty($s_board_id) && ($s_board_id == $levelBoardID)){
                                    ?>
                                                <option value="<?php echo $levelID; ?>" <?php if (!empty($s_level_id) && ($s_level_id == $levelID)) {echo "selected";}?>> <?php echo $level->level_name; ?> </option>
                                    <?php
                                                    }
                                                }
                                            }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="item form-group">
                            <label class="control-label col-md-2" for="page_type">Select Stream</label>
                            <div class="col-md-4">
                                <select name="stream_id" id="stream_id" class='form-control' onchange="setStream(document.addEditform.stream_id.options[ document.addEditform.stream_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="">---Select Stream---</option>
                                    <?php
                                    if (!empty($s_stream_id)) {
                                        foreach ($streams as $stream) {
                                            $streamLevelID = $stream->level_id;
                                            $streamID = $stream->stream_id;
                                            $streamName = $stream->stream_name;
                                            
                                            if (!empty($s_level_id) && ($s_level_id == $streamLevelID)){
                                    ?>
                                            <option value="<?php echo $streamID; ?>" <?php if (!empty($s_stream_id) && ($s_stream_id == $streamID)) {echo "selected";}?>> <?php echo $streamName; ?> </option>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>
                            <!--                        </div>
                                                    <div class="item form-group">-->
                            <label class="control-label col-md-2" for="course_id">Select Course</label>
                            <div class="col-md-4">
                                <select name="course_id" id="course_id" class='form-control' onchange="setCourse(document.addEditform.course_id.options[document.addEditform.course_id.selectedIndex].value);">
                                    <option value="">---Select Course---</option>
                                    <?php
                                    if (!empty($s_course_id)) {
                                        foreach ($courses as $course) {
                                            $courseIDs = $course->course_id;
                                            $courseLevelID = $course->level_id;
                                            $courseStreamID = $course->stream_id;
                                            $courseName = $course->course_name;
                                            if (!empty($s_stream_id) && ($s_stream_id == $courseStreamID)){
                                    ?>
                                        <option value="<?php echo $courseIDs; ?>" <?php if (!empty($s_course_id) && ($s_course_id == $courseIDs)) {echo "selected";}?>> <?php echo $courseName; ?> </option>
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
                                <select name="department_id" id="department_id" class='form-control'>
                                    <option value="">---Select Department---</option>
                                    <?php
                                    if (!empty($s_department_id)) {
                                        foreach ($departments as $department) {
                                            $departmentID = $department->department_id;
                                            $departmentLevelID = $department->level_id;
                                            $departmentStreamID = $department->stream_id;
                                            $departmentCourseID = $department->course_id;
                                            $departmentName = $department->department_name;
                                            
                                            if (!empty($s_course_id) && ($s_course_id == $departmentCourseID)){
                                    ?>
                                        <option value="<?php echo $departmentID; ?>" <?php if (!empty($s_department_id) && ($s_department_id == $departmentID)) {echo "selected";}?>> <?php echo $departmentName; ?> </option>
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
                                    <?php
                                    if ($s_year) {
                                        $streamed = $this->db->query("select * from hya_course_stream where stream_id=$s_stream_id")->row();
                                        $year = $streamed->year;
                                        for ($i = 1; $i <= $year; $i++){
                                    ?>
                                        <option <?php if (!empty($s_year) && ($s_year == $i)) { echo "selected";} ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <!--                        </div>
                                                    <div class="form-group">-->
                            <label class="control-label col-md-2" for="content">Select Semester</label>
                            <div class="col-md-4">
                                <select name="semester" id="semester" class='select2_single form-control' onchange="setSemester(document.addEditform.semester.options[document.addEditform.semester.selectedIndex].value);">
                                    <option value="">---Select Semester---</option>
                                    <?php
                                    if ($s_semester) {
                                        $streamed = $this->db->query("select * from hya_course_stream where stream_id=$s_stream_id")->row();
                                        $semester = $streamed->semester;
                                        for ($j = 1; $j <= $semester; $j++) {
                                    ?>
                                            <option <?php if (!empty($s_semester) && ($s_semester == $j)) {echo "selected";} ?> value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="item form-group">
                            <label class="control-label col-md-2" for="subject_id">Select Subject <span class="required">*</span></label>
                            <div class="col-md-4">
                                <select name="subject_id" id="subject_id" class='subject_id form-control' onchange="setSubject(document.addEditform.subject_id.options[document.addEditform.subject_id.selectedIndex].value);" data-rule-required="true">
                                    <option value="">---Select Subject---</option>
                                    <?php
                                    if (!empty($s_subject_id)) {
                                        foreach ($subjects as $subject) {
                                            $subjectIDs = $subject->subject_id;
                                            $subjectBoardID = $subject->board_id;
                                            $subjectLevelID = $subject->level_id;
                                            $subjectStreamID = $subject->stream_id;
                                            $subjectCourseID = $subject->course_id;
                                            $subjectDepartment_id = $subject->department_id;
                                            $subject_year = $subject->year;
                                            $subjectName = $subject->subject_name;
                                            if (!empty($s_level_id) && ($s_level_id == $subjectLevelID) || !empty($s_stream_id) && ($s_stream_id == $subjectStreamID) || !empty($s_course_id) && ($s_course_id == $subjectCourseID)){
                                    ?>

                                        <option value="<?php echo $subjectIDs; ?>" <?php if (!empty($s_subject_id) && ($s_subject_id == $subjectIDs)) {echo "selected";}?>> <?php echo $subjectName; ?> </option>
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
                                    if (!empty($s_chapter_id)) {
                                        foreach ($chapters as $chapter) {
                                            $chapterIDs = $chapter->chapter_id;
                                            $chapterBoard_id = $chapter->board_id;
                                            $chapterLevel_id = $chapter->level_id;
                                            $chapterStream_id = $chapter->stream_id;
                                            $chapterCourseID = $chapter->course_id;
                                            $chapterDepartment_id = $chapter->department_id;
                                            $chapterSubject_id = $chapter->subject_id;
                                            $chapterName = $chapter->chapter_name;
                                            //if ($details->subject_id == $chapterSubject_id) {
                                            if (!empty($s_subject_id) && ($s_subject_id == $chapterSubject_id)){
                                    ?>
                                        <option value="<?php echo $chapterIDs; ?>" <?php if (!empty($s_chapter_id) && ($s_chapter_id == $chapterIDs)) {echo "selected";}?>> <?php echo $chapterName; ?> </option>
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
                                <select name="unit_id" id="unit_id" class='form-control' onchange="setUnit(document.addEditform.unit_id.options[document.addEditform.unit_id.selectedIndex].value);">
                                    <option value="">---Select Unit---</option>
                                    <?php
                                    if (!empty($s_unit_id)) {
                                        foreach ($units as $unit) {
                                            $unitIDs = $unit->unit_id;
                                            $unitLevelID = $unit->level_id;
                                            $unitStreamID = $unit->stream_id;
                                            $unitChapterID = $unit->chapter_id;
                                            $unitName = $unit->unit_name;
                                            if (!empty($s_chapter_id) && ($s_chapter_id == $unitChapterID)){
                                            //if ($details->chapter_id == $unitChapterID) {
                                    ?>

                                        <option value="<?php echo $unitIDs; ?>" <?php if (!empty($s_unit_id) && ($s_unit_id == $unitIDs)) {echo "selected";}?>> <?php echo $unitName; ?> </option>
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
                                <select name="subunit_id" id="subunit_id" class='form-control' >
                                    <option value="" >---Select Sub-Unit---</option>
                                    <?php
                                    if (!empty($s_subunit_id)) {
                                        foreach ($subunits as $subUnit) {
                                            $subunitUnitID = $subUnit->unit_id;
                                            $subunitIDs = $subUnit->subunit_id;
                                            $subunitLevelID = $subUnit->level_id;
                                            $subunitStreamID = $subUnit->stream_id;
                                            $subunitName = $subUnit->subunit_name;
                                            //if ($details->unit_id == $subunitUnitID) {
                                            
                                        if (!empty($s_unit_id) && ($s_unit_id == $subunitUnitID)){
                                    ?>

                                        <option value="<?php echo $subunitIDs; ?>" <?php if (!empty($s_subunit_id) && ($s_subunit_id == $subunitIDs)) {echo "selected";}?>> <?php echo $subunitName; ?> </option>
                                    <?php
                                            }
                                        }
                                    }
                                    ?>  
                                </select>
                            </div>
                        </div>
                        <hr>
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
                        <div style="background-color: #ddd; ">
                            <div class="form-group col-sm-6 my-form-element">
                                <label for="textitem">Set</label>
                                <select name="set">
                                    <option value="">Select Set</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>   
                            </div>

                            <div class="form-group col-sm-6 my-form-element">
                                <label for="textitem">Question Tags</label>
                                <select name="question_tag">
                                    <option value="">Select Ques. Tags</option>
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
                                            <option value="bs" id="bs">B.S.</option>
                                            <option value="ad" id="ad">A.D.</option>
                                            
                                        </select>
                                    <!--</span>-->
                                    
                                    <select name="appeared_year" id="ad_date" class="col-sm-6 ui-datepicker-year" style="display:none;" ><!-- data-event="change" data-handler="selectYear"-->
                                    <?php for ($i = $previous10Year; $i <= $c_year; $i++) { ?>
                                                                            <option <?php if (@$isEdit) {
                                            if ($i == $details->appeared_year) { ?>selected="selected" <?php }
                                        } elseif ($i == $c_year) { ?>selected="selected" <?php } ?>value="<?php echo $i ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                    </select>

                                    <select name="appeared_year" id="bs_date" class="col-sm-6 ui-datepicker-year"><!-- data-event="change" data-handler="selectYear"-->
                                    <?php for ($n = $previous_n_10Year; $n <= $c_year_n; $n++) { ?>
                                        <option <?php if (@$isEdit) {if ($n == $details->appeared_year) {?>selected="selected" <?php }} elseif ($n == $c_year_n) { ?>selected="selected" <?php } ?>value="<?php echo $n ?>"><?php echo $n; ?></option>
                                    <?php } ?>
                                    </select>
                                    
                                </div>
                                
<!--                                <label for="textitem">Appeared Year</label>
                                <select name="date_type" class="col-sm-4" id="change_date">
                                    <option value="">Select Date</option>
                                    <option value="ad" id="ad">A.D.</option>
                                    <option value="bs" id="bs">B.S.</option>
                                </select>
                                
                                <select name="appeared_year" id="ad_date" class="col-sm-6 ui-datepicker-year"> data-event="change" data-handler="selectYear"
                                <?php for ($i = $previous10Year; $i <= $c_year; $i++) { ?>
                                                                        <option <?php if (@$isEdit) {
                                        if ($i == $details->appeared_year) { ?>selected="selected" <?php }
                                    } elseif ($i == $c_year) { ?>selected="selected" <?php } ?>value="<?php echo $i ?>"><?php echo $i; ?></option>
                                <?php } ?>
                                </select>
                                
                                <select name="appeared_year" id="bs_date" style="display:none;" class="col-sm-6 ui-datepicker-year"> data-event="change" data-handler="selectYear"
                                <?php for ($n = $previous_n_10Year; $n <= $c_year_n; $n++) { ?>
                                    <option <?php if (@$isEdit) {if ($n == $details->appeared_year) {?>selected="selected" <?php }} elseif ($n == $c_year_n) { ?>selected="selected" <?php } ?>value="<?php echo $n ?>"><?php echo $n; ?></option>
                                <?php } ?>
                                </select>-->
                                <!--<input type="text" id="datepicker" class="form-control" name="template_title" value="<?php if (@$isEdit) echo $details->template_title; ?>" data-rule-required="true" />-->
                            </div>
                            
                            <div class="form-group col-sm-6 my-form-element">
                                <label for="textitem">Marks</label>
                                <input type="text" class="form-control" name="mark" value="<?php if (@$isEdit) echo $details->mark; ?>"/>
                            </div>

                            <div class="form-group col-sm-6 my-form-element">
                                <label for="textitem">Question Type</label>
                                <select name="question_type" class="form-control myselectbox" id="<?php echo $i; ?>">
                                    <option value="">Select Que. Type</option>
                                    <option value="Text Entry" <?php if (!empty($resultQuestionArr)) {if ($Q_typeArr == "Text Entry") {echo "selected";}}?>>Text Entry</option>
<!--                                    <option value="Image" <?php if (!empty($resultQuestionArr)) {if ($Q_typeArr == "Image") {echo "selected"; }}?>>Image</option>
                                    <option value="Video" <?php if (!empty($resultQuestionArr)) {if ($Q_typeArr == "Video") {echo "selected";}}?>>Video</option>-->
                                    <option value="Drop Down" <?php if (!empty($resultQuestionArr)) { if ($Q_typeArr == "Drop Down") { echo "selected"; }}?>>Drop Down</option>
                                    <option value="Radio Buttons" <?php if (!empty($resultQuestionArr)) {if ($Q_typeArr == "Radio Buttons") {echo "selected";}}?>>Radio Buttons</option>
                                    <option value="Checkboxes" <?php if (!empty($resultQuestionArr)) {if ($Q_typeArr == "Checkboxes") {echo "selected";}}?>>Checkboxes</option>
                                </select>
                            </div>
                            
                            <div class="form-group col-sm-6 my-form-element">
                                <label for="textitem">Question No.</label>
                                <input type="text" class="form-control" name="question_no" id="question_no" value="<?php if (@$isEdit) echo $details->question_no; ?>" data-rule-alphanumber="true"/>
                            </div>

                            <div class="row listContainer" id="myListsTable">
                                <div class="form-group col-sm-12 my-form-element">
                                    <label for="textitem">Question</label>
                                    <textarea name="question" id="question" class="form-control questionFull" rows="6"></textarea>
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
                                    <option value="1" <?php if (($isEdit) && ($details->status == '1')) {echo "selected";}?>> Active </option>
                                    <option value="0" <?php if (($isEdit) && ($details->status == '0')) {echo "selected";}?>> InActive </option>
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
                    
                    

                    
                    <div class="step" id="secondStep">
                        <div class="x_panel" style="background-color: #f7f7f7;">
                            <div id="withoutSubquestion" class="withoutSubquestion">
                                <button type="button" id="option_1" onclick="add('option')" class="row btn btn-dark tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Option 1</button>
                                <div id="option" class="row" style="padding: 10px;border: 2px solid rgba(52, 73, 94, 0.88);"></div>
                                <button type="button" id="hint_1" onclick="add('hint')" class="row btn btn-success tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Hint 1</button>
                                <div id="hint" class="row" style="padding: 10px;border: 2px solid #26b99a;"></div>
                                <button type="button" id="answer_1" onclick="add('answer')" class="row btn btn-info tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Answer 1</button>
                                <div id="answer" class="row" style="padding: 10px;border: 2px solid #5bc0de;"></div>
<!--                                <button type="button" id="reason_1" onclick="add('reason')" class="row btn btn-warning tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Reason 1</button>
                                <div id="reason" class="row" style="padding: 10px;border: 2px solid #f0ad4e;"></div>-->
                                <button type="button" id="description_1" onclick="add('description')" class="row btn btn-primary tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Description 1</button>
                                <div id="description" class="row" style="padding: 10px;border: 2px solid #1a82c3;"></div>

                            </div>
                        </div>


                        <button type="button" class="btn btn-primary addSubQuestion" onclick="add('subquestion')">Add Sub Question</button>
                        <hr>
                        <div class="x_panel" style="background-color: #f7f7f7;">
                            <div id="subquestion-1" class="subquestion">
                                <div class="x_panel" style="background-color: #f7f7f7;">
                                    <div class="x_title row" style="background-color: #73879c;color: #FFF;">
                                        <h2 >Sub-Question 1</h2>
                                        <a class="btn btn-danger delete pull-right" onclick="remove_subquestion(1)" href="javascript:;"><i class="fa fa-trash-o fa-lg"></i></a>';
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="x_content row">
                                        <div class="btn-toolbar">
                                            <textarea id="template_description" class="form-control" name="subquestion[question][]"> </textarea>
                                        </div>
                                        <br />
                                    </div>
                                </div>
                                <button type="button" id="option_1" onclick="addSub('option', '1')" class="row btn btn-dark tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Option 1</button>
                                <div id="option1" class="row" style="padding: 10px;border: 2px solid rgba(52, 73, 94, 0.88);"></div>
                                <button type="button" id="hint_1" onclick="addSub('hint', '1')" class="row btn btn-success tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Hint 1</button>
                                <div id="hint1" class="row" style="padding: 10px;border: 2px solid #26b99a;"></div>
                                <button type="button" id="answer_1" onclick="addSub('answer', '1')" class="row btn btn-info tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Answer 1</button>
                                <div id="answer" class="row" style="padding: 10px;border: 2px solid #5bc0de;"></div>
<!--                                <button type="button" id="reason_1" onclick="addSub('reason', '1')" class="row btn btn-warning tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Reason 1</button>
                                <div id="reason1" class="row" style="padding: 10px;border: 2px solid #f0ad4e;"></div>-->
                                <button type="button" id="description_1" onclick="addSub('description', '1')" class="row btn btn-primary tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Description 1</button>
                                <div id="description1" class="row" style="padding: 10px;border: 2px solid #1a82c3;"></div>
                            </div>
                        </div>
                    <!--<div class="row featureHolder" id="second_form">-->
<!--                        <div class="x_panel" style="background-color: #f7f7f7;">
                            <div id="withoutSubquestion">
                                <button type="button" id="option_1" onclick="add('option')" class="row btn btn-dark tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Option 1</button>
                                <div id="option" class="row" style="padding: 10px;border: 2px solid rgba(52, 73, 94, 0.88);"></div>
                                <button type="button" id="hint_1" onclick="add('hint')" class="row btn btn-success tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Hint 1</button>
                                <div id="hint" class="row" style="padding: 10px;border: 2px solid #26b99a;"></div>
                                <button type="button" id="answer_1" onclick="add('answer')" class="row btn btn-info tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Answer 1</button>
                                <div id="answer" class="row" style="padding: 10px;border: 2px solid #5bc0de;"></div>
                                <button type="button" id="reason_1" onclick="add('reason')" class="row btn btn-warning tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Reason 1</button>
                                <div id="reason" class="row" style="padding: 10px;border: 2px solid #f0ad4e;"></div>
                                <button type="button" id="description_1" onclick="add('description')" class="row btn btn-primary tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Description 1</button>
                                <div id="description" class="row" style="padding: 10px;border: 2px solid #1a82c3;"></div>

                            </div>
                        </div>


                        <button type="button" class="btn btn-primary addSubQuestion" onclick="add('subquestion')">Add Sub Question</button>
                        <hr>
                        <div class="x_panel" style="background-color: #f7f7f7;">
                            <div id="subquestion-1" class="subquestion">
                                <button type="button" id="option_1" onclick="addSub('option', '1')" class="row btn btn-dark tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Option 1</button>
                                <div id="option1" class="row" style="padding: 10px;border: 2px solid rgba(52, 73, 94, 0.88);"></div>
                                <button type="button" id="hint_1" onclick="addSub('hint', '1')" class="row btn btn-success tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Hint 1</button>
                                <div id="hint1" class="row" style="padding: 10px;border: 2px solid #26b99a;"></div>
                                <button type="button" id="answer_1" onclick="addSub('answer', '1')" class="row btn btn-info tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Answer 1</button>
                                <div id="answer" class="row" style="padding: 10px;border: 2px solid #5bc0de;"></div>
                                <button type="button" id="reason_1" onclick="addSub('reason', '1')" class="row btn btn-warning tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Reason 1</button>
                                <div id="reason1" class="row" style="padding: 10px;border: 2px solid #f0ad4e;"></div>
                                <button type="button" id="description_1" onclick="addSub('description', '1')" class="row btn btn-primary tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Description 1</button>
                                <div id="description1" class="row" style="padding: 10px;border: 2px solid #1a82c3;"></div>
                            </div>
                        </div>-->

                    </div>
                    <div class="form-actions">
                            <input type="reset" class="btn" value="Back" id="back">
                            <input type="submit" class="btn btn-primary" value="Submit" id="next">
                    </div>
                    <!--                    <div class="row featureHolder" id="second_form">
                                            <div class="x_panel" style="background-color: #f7f7f7;">
                                                <div class="x_title row" style="background-color: #73879c;color: #FFF;">
                                                    <h2 >Sub Question 1</h2>
                                                    <a class="btn btn-danger delete pull-right"  href="#"><i class="fa fa-trash-o fa-lg"></i></a>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content row">
                                                    <div class="btn-toolbar editor">
                                                        <textarea id="question" class="form-control subquestionEditor1" name="subquestion[]"> </textarea>
                                                    </div>
                                                    <br />
                                                </div>
                                                
                                                
                                                <div id="withoutSubquestion">
                                                    <button type="button" id="option_1" onclick="add('option')" class="row btn btn-dark tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Option 1</button>
                                                    <div id="option" class="row" style="padding: 10px;border: 2px solid rgba(52, 73, 94, 0.88);"></div>
                                                    <button type="button" id="hint_1" onclick="add('hint')" class="row btn btn-success tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Hint 1</button>
                                                    <div id="hint" class="row" style="padding: 10px;border: 2px solid #26b99a;"></div>
                                                    <button type="button" id="answer_1" onclick="add('answer')" class="row btn btn-info tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Answer 1</button>
                                                    <div id="answer" class="row" style="padding: 10px;border: 2px solid #5bc0de;"></div>
                                                    <button type="button" id="reason_1" onclick="add('reason')" class="row btn btn-warning tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Reason 1</button>
                                                    <div id="reason" class="row" style="padding: 10px;border: 2px solid #f0ad4e;"></div>
                                                    <button type="button" id="description_1" onclick="add('description')" class="row btn btn-primary tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Description 1</button>
                                                    <div id="description" class="row" style="padding: 10px;border: 2px solid #1a82c3;"></div>
                                                    
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary addSubQuestion">Add Sub Question</button>
                                            <button type="button" class="btn btn-primary addSubQuestion" onclick="add('subquestion')">Add Sub Question</button>
                                            <hr>
                                            <div class="row listContainer" id="myListsTable">
                                                <div class="form-group col-sm-9">
                                                    
                                                </div>
                                                <div class="form-group col-sm-3">
                                                    
                                                </div>
                                            </div>
                                            
                                            <div class="x_panel" style="background-color: #f7f7f7;">
                                                <div class="x_title row" style="background-color: #73879c;color: #FFF;">
                                                    <h2 >Sub Question 1</h2>
                                                    <a class="btn btn-danger delete pull-right"  href="#"><i class="fa fa-trash-o fa-lg"></i></a>
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="x_content row">
                                                    <div class="btn-toolbar editor">
                                                        <textarea id="question" class="form-control subquestionEditor1" name="subquestion[]"> </textarea>
                                                    </div>
                                                    <br />
                                                </div>
                                            
                                                <div id="subquestion-1" class="subquestion">
                                                    <button type="button" id="option_1" onclick="addSub('option','1')" class="row btn btn-dark tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Option 1</button>
                                                    <div id="option" class="row" style="padding: 10px;border: 2px solid rgba(52, 73, 94, 0.88);"></div>
                                                    <button type="button" id="hint_1" onclick="addSub('hint','1')" class="row btn btn-success tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Hint 1</button>
                                                    <div id="hint" class="row" style="padding: 10px;border: 2px solid #26b99a;"></div>
                                                    <button type="button" id="answer_1" onclick="addSub('answer','1')" class="row btn btn-info tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Answer 1</button>
                                                    <div id="answer" class="row" style="padding: 10px;border: 2px solid #5bc0de;"></div>
                                                    <button type="button" id="reason_1" onclick="addSub('reason','1')" class="row btn btn-warning tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Reason 1</button>
                                                    <div id="reason" class="row" style="padding: 10px;border: 2px solid #f0ad4e;"></div>
                                                    <button type="button" id="description_1" onclick="addSub('description','1')" class="row btn btn-primary tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Description 1</button>
                                                    <div id="description" class="row" style="padding: 10px;border: 2px solid #1a82c3;"></div>
                                                </div>
                                                <div id="withoutSubquestion">
                                                    <button type="button" id="option_1" onclick="add('option')" class="row btn btn-dark tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Option 1</button>
                                                    <div id="option" class="row" style="padding: 10px;border: 2px solid rgba(52, 73, 94, 0.88);"></div>
                                                    <button type="button" id="hint_1" onclick="add('hint')" class="row btn btn-success tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Hint 1</button>
                                                    <div id="hint" class="row" style="padding: 10px;border: 2px solid #26b99a;"></div>
                                                    <button type="button" id="answer_1" onclick="add('answer')" class="row btn btn-info tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Answer 1</button>
                                                    <div id="answer" class="row" style="padding: 10px;border: 2px solid #5bc0de;"></div>
                                                    <button type="button" id="reason_1" onclick="add('reason')" class="row btn btn-warning tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Reason 1</button>
                                                    <div id="reason" class="row" style="padding: 10px;border: 2px solid #f0ad4e;"></div>
                                                    <button type="button" id="description_1" onclick="add('description')" class="row btn btn-primary tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Description 1</button>
                                                    <div id="description" class="row" style="padding: 10px;border: 2px solid #1a82c3;"></div>
                                                    
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
                                                </div>
                                            </div>
                                            
                                            <div style="background-color: #ddd;">
                                                
                    
                    
                    
                                                
                                            </div>
                                        </div>-->

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
    function initMCEall(){
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
    }
    
    function add(option){
        var uniqTextID = Math.random();
        if (option === 'subquestion') {
            var visible = $(".subquestion").is(":visible");
            if (visible) {
                var i = $(".subquestion").length;
                //console.log(i);
        var subquestion = '<div id="subquestion-'+ (i + 1) +'" class="subquestion">';
               subquestion += '<div class="x_panel" style="background-color: #f7f7f7;">';
                subquestion += '<div class="x_title row" style="background-color: #73879c;color: #FFF;">';
                    subquestion += '<h2 >Sub-Question ' + (i + 1) + '</h2>';
                    subquestion += '<a class="btn btn-danger delete pull-right" onclick="remove_subquestion('+(i+1)+')" href="javascript:;"><i class="fa fa-trash-o fa-lg "></i></a>';
                        subquestion += '<div class="clearfix"></div>';
                subquestion += '</div>';
                subquestion += '<div class="x_content row">';
                    subquestion += '<div class="btn-toolbar">';
                        subquestion += '<textarea id="'+uniqTextID+'" class="form-control" name="subquestion[question][]"> </textarea>';
                    subquestion += '</div>';
                subquestion += '</div>';
                subquestion += '<br/>';
            subquestion += '</div>';
                    subquestion += '<button type="button" id="option_' + (i + 1) + '" onclick="addSub(\'option\',' + (i + 1) + ')" class="row btn btn-dark tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Option ' + (i + 1) + '</button>';
                    subquestion += '<div id="option'+ (i + 1) +'" class="row" style="padding: 10px;border: 2px solid rgba(52, 73, 94, 0.88);"></div>';
                    subquestion += '<button type="button" id="hint_' + (i + 1) + '" onclick="addSub(\'hint\',' + (i + 1) + ')" class="row btn btn-success tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Hint ' + (i + 1) + '</button>';
                    subquestion += '<div id="hint'+ (i + 1) +'" class="row" style="padding: 10px;border: 2px solid #26b99a;"></div>';
                    subquestion += '<button type="button" id="answer_' + (i + 1) + '" onclick="addSub(\'answer\',' + (i + 1) + ')" class="row btn btn-info tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Answer ' + (i + 1) + '</button>';
                    subquestion += '<div id="answer'+ (i + 1) +'" class="row" style="padding: 10px;border: 2px solid #5bc0de;"></div>';
//                    subquestion += '<button type="button" id="reason_' + (i + 1) + '" onclick="addSub(\'reason\',' + (i + 1) + ')" class="row btn btn-warning tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Reason ' + (i + 1) + '</button>';
//                    subquestion += '<div id="reason'+ (i + 1) +'" class="row" style="padding: 10px;border: 2px solid #f0ad4e;"></div>';
                    subquestion += '<button type="button" id="description_' + (i + 1) + '" onclick="addSub(\'description\',' + (i + 1) + ')" class="row btn btn-primary tabbtn"><i class="fa fa-plus-square-o fa-lg"></i> Description ' + (i + 1) + '</button>';
                    subquestion += '<div id="description'+ (i + 1) +'" class="row" style="padding: 10px;border: 2px solid #1a82c3;"></div>';
                subquestion += '</div>';
                //subquestion += '</div>';

                $(subquestion).insertAfter('.subquestion:last');
                initMCEall();
            } else {
                $("#subquestion-1").show();
                //$('#withoutSubquestion').hide();
//                var input='<textarea id="question" class="form-control ckeditor" name="subquestion[]"> </textarea><a class="btn btn-danger delete"  href="javascript:;"><i class="fa fa-trash-o fa-lg"></i> Delete</a>';
//        var subquestion = '<div class="x_panel" style="background-color: #f7f7f7;">';
//                subquestion += '<div class="x_title row" style="background-color: #73879c;color: #FFF;">';
//                    subquestion += '<h2 >Sub-Question 1</h2>';
//                    subquestion += '<a class="btn btn-danger delete pull-right" onclick="remove_subquestion(1)" href="javascript:;"><i class="fa fa-trash-o fa-lg"></i></a>';
//                    subquestion += '<div class="clearfix"></div>';
//                subquestion += '</div>';
//                subquestion += '<div class="x_content row">';
//                    subquestion += '<div class="btn-toolbar">';
//                        subquestion += '<textarea id="'+uniqTextID+'" class="form-control" name="subquestion[question][]"> </textarea>';
//                    subquestion += '</div>';
//                subquestion += '<br />';
//                subquestion += '</div>';
//            subquestion += '</div>';
//
//                $('#subquestion-1').prepend(subquestion);
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
//        if (option == 'reason') {
//            var btn_color = 'warning';
//            var background_style = 'background-color: #f0ad4e;color: #FFF;';
//        }
        if (option == 'description') {
            var btn_color = 'primary';
            var background_style = 'background-color: #1a82c3;color: #FFF;';
        }

    var input = '<div class="form-group col-sm-6 my-form-element">';
                input +='<label for="textitem" style="'+background_style+'">'+option ;
                    input +='<a class="btn btn-danger delete pull-right"  href="javascript:;">';
                        input +='<i class="fa fa-close remove_'+option+'"></i>';
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
            input +='<a class="btn btn-danger delete pull-right" href="javascript:;">';
                input +='<i class="fa fa-close remove_sub'+suboption+'"></i>';
            input +='</a>';
            
                input +='<div class="clearfix"></div>';
            input +='<textarea id="'+uniqTextID +'" class="form-control " rows="6" name="subquestion[' + suboption + '][' + num + '][]"></textarea>';
            input +='</label>';
        input +='</div>';
    $('#subquestion-' + num).find('#' + suboption+num).append(input);
        initMCEall();
        //tinymce.execCommand("mceAddControl", false, suboption + num);
    }
    
    
    $(function () {
        $("#datepicker").datepicker({
            dateFormat: 'yy',
            changeMonth: true,
            changeYear: true
        });
        $(".delete").bind('click', function () {
            alert("delete");
        })
    });
    $(function () {
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
        
        
        $(".withoutSubquestion").on("click", ".remove_option", function (e) { //user click on remove text
            $(this).parent('a').parent('label').parent('div').remove();
            $(this).closest("i").remove();
           
        });
         $(".withoutSubquestion").on("click", ".remove_hint", function (e) { //user click on remove text
            $(this).parent('a').parent('label').parent('div').remove();
            $(this).closest("i").remove();
            //j--;
        });

        $(".withoutSubquestion").on("click", ".remove_answer", function (e) { //user click on remove text
            $(this).parent('a').parent('label').parent('div').remove();
            $(this).closest("i").remove();
            //j--;
        });
        $(".withoutSubquestion").on("click", ".remove_description", function (e) { //user click on remove text
            $(this).parent('a').parent('label').parent('div').remove();
            $(this).closest("i").remove();
            //j--;
        });
        
         
        $(".subquestion").on("click", ".remove_suboption", function (e) { //user click on remove text
            e.preventDefault();
             $(this).parent('a').parent('label').parent('div').remove();
            $(this).closest("i").remove();
            //j--;
        });
         $(".subquestion").on("click", ".remove_subhint", function (e) { //user click on remove text
            $(this).parent('a').parent('label').parent('div').remove();
            $(this).closest("i").remove();
            //j--;
        });

        $(".subquestion").on("click", ".remove_subanswer", function (e) { //user click on remove text
             $(this).parent('a').parent('label').parent('div').remove();
            $(this).closest("i").remove();
            //j--;
        });
        $(".subquestion").on("click", ".remove_subdescription", function (e) { //user click on remove text
            $(this).parent('a').parent('label').parent('div').remove();
            $(this).closest("i").remove();
            //j--;
        });
    
    })
    
    function remove_subquestion(subquestionID){
      // alert(subquestionID);
       if(subquestionID==1){
            $("#subquestion-"+subquestionID).hide();
       }
       else if(subquestionID >1){
             $("#subquestion-"+subquestionID).remove();
         }
     }
    
</script>