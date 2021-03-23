<?php
function shorten_string($string, $wordsreturned) {
    $retval = $string; // Just in case of a problem
    $array = explode(" ", $string);
    if (count($array) <= $wordsreturned) {
        $retval = $string;
    } else {
        array_splice($array, $wordsreturned);
        $retval = implode(" ", $array);
    }
    return $retval;
}
?>

<script>
    $(function () {
        $('.publish_status a').click(function () {

            var _id = $(this).attr('id');
            var _status = $(this).text().trim();
            $('a#' + _id + '').removeClass(_status);
            $(this).html('<img src="<?php echo config_item('admin_images'); ?>ajax-loader.gif" />');
            var _this = $(this);//alert(_id);
            $.get('<?php echo base_url('data/update_status_data'); ?>', {id: _id, status: _status},
            //alert(data);
                    function (data) {
                        _this.text(data);
                        $('a#' + _id + '').addClass(data);
                        //$('.cross').hide();
                    });
        });
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
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>gears/front_dashboard/css/listing.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>gears/front_dashboard/css/jquery.classyscroll.css">
<script type="text/javascript" src="<?php echo base_url(); ?>gears/front_dashboard/js/jquery.classyscroll.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>gears/front_dashboard/js/json2.js"></script>
<script>
    $(document).ready(function () {
        $("#data_keywords").keyup(function () {
            if($("#data_keywords").val().length>3){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url("data/search_questions"); ?>",
                cache: false,
                data: 'data_keywords=' + $("#data_keywords").val(),
                success: function (response) {
                    $('#finalResult').html("");
                    var obj = JSON.parse(response);
                    
                    if (obj.length > 0) {
                        var count ='';
                        try {
                            var items = [];
                            var count = 1;
                            $.each(obj, function (i, val) {
                                var questionEdit = "<?php echo base_url(); ?>data/edit_question/" + val.QUESTION_ID;
                                var questionID = val.QUESTION_ID;
                                var quest = val.QUESTION;
                                var textOnly = $(quest).text();
                                var subjectName = val.SUBJECT_NAME;
                                var myModal = '#modal-' + val.QUESTION_ID;
                                
                                var question = textOnly.substring(0, 160);
                                items.push('<li><a href="'+questionEdit+'"><div class="list-action-left">'+questionID+'</div><div class="list-content" style="margin-right:0;padding: 15px;"><span class="title">'+subjectName+'</span><span class="caption">'+question+'</span></div></a><div class="list-action-right" style="top:0% !important;"><a class="edit" href="'+questionEdit+'"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a><a href="'+myModal+'" role="button" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a></div></li>');
                            count++;
                        });
                        $('#finalResultCount').html($('<li/>').html('<span class="btn btn-default"> '+count+' </span> Result(s) Found'));
                        $('#finalResult').append.apply($('#finalResult'), items);
                        } catch (e) {
                            alert('Exception while request..');
                        }
                        
                    } else {
                    $('#finalResultCount').html($('<li/>').html('<span class="btn btn-danger"> 0 </span> Result(s) Found'));
                        $('#finalResult').html($('<li/>').html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button class="close" aria-label="Close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button><strong>No Data Found!</strong></div>'));
                    }
                },
                error: function () {
                    alert('Error while request..');
                }
            });
            }
//            return false;
        });

        // board dropdown On change
        $(".advance_search").change(function () {
            var boardID = $("#board_id").val();
            var levelID = $("#level_id").val();
            var streamID = $("#stream_id").val();
            var courseID = $("#course_id").val();
            var departmentID = $("#department_id").val();
            var year = $("#year").val();
            var semester = $("#semester").val();
            var subjectID = $("#subject_id").val();
            var chapterID = $("#chapter_id").val();
            var unitID = $("#unit_id").val();
            var subunitID = $("#subunit_id").val();
            
//            if($("#board_id").val().length>3){
            $.ajax({
                type: "POST",
                url: "<?php echo base_url("data/search_questionsby_boardid"); ?>",
                cache: false,
                data : { board_id : boardID,level_id : levelID,stream_id : streamID,course_id : courseID,department_id : departmentID,year : year,semester : semester,subject_id : subjectID,chapter_id : chapterID,unit_id : unitID,subunit_id : subunitID},//data: 'board_id=' + $("#board_id").val(),
                success: function (response) {
                    $('#finalResult').html("");
                    var obj = JSON.parse(response);
                    
                    if (obj.length > 0) {
                        var count ='';
                        try {
                                var items = [];
                                count = 1;
                                $.each(obj, function (i, val) {
                                    var questionEdit = "<?php echo base_url(); ?>data/edit_question/" + val.QUESTION_ID;
                                    var questionID = val.QUESTION_ID;
                                    var quest = val.QUESTION;
                                    var textOnly = $(quest).text();
                                    var subjectName = val.SUBJECT_NAME;
                                    var myModal = '#modal-' + val.QUESTION_ID;

                                    var question = textOnly.substring(0, 160);
                                    items.push('<li><a href="'+questionEdit+'"><div class="list-action-left">'+questionID+'</div><div class="list-content" style="margin-right:0;padding: 15px;"><span class="title">'+subjectName+'</span><span class="caption">'+question+'</span></div></a><div class="list-action-right" style="top:0% !important;"><a class="edit" href="'+questionEdit+'"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a><a href="'+myModal+'" role="button" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a></div></li>');
                                count++;
                            });
                            $('#finalResultCount').html($('<li/>').html('<span class="btn btn-default"> '+count+' </span> Result(s) Found'));
                            $('#finalResult').append.apply($('#finalResult'), items);
                        } catch (e) {
                            alert('Exception while request..');
                        }
                        
                    } else {
                    $('#finalResultCount').html($('<li/>').html('<span class="btn btn-danger"> 0 </span> Result(s) Found'));
                        $('#finalResult').html($('<li/>').html('<div class="alert alert-danger alert-dismissible fade in" role="alert"><button class="close" aria-label="Close" data-dismiss="alert" type="button"><span aria-hidden="true">×</span></button><strong>No Data Found!</strong></div>'));
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
    $(document).ready(function () {
        $('.sample').ClassyScroll();
//                $('[data-toggle="tooltip"]').tooltip();
//                $("[data-toggle=popover]").popover({html: true});
    });


</script>

<?php
if(!empty($this->session->userdata('board_id'))){
    $s_board_id = @$this->session->userdata('board_id');
    $s_level_id = @$this->session->userdata('level_id');
    $s_stream_id = @$this->session->userdata('stream_id');
    $s_course_id = @$this->session->userdata('course_id');
    $s_department_id = @$this->session->userdata('department_id');
    $s_year = @$this->session->userdata('year');
    $s_semester = @$this->session->userdata('semester');
    $s_subject_id = @$this->session->userdata('subject_id');
    $s_chapter_id = @$this->session->userdata('chapter_id');
    $s_unit_id = @$this->session->userdata('unit_id');
    $s_subunit_id = @$this->session->userdata('subunit_id');
//    $s_question_set = @$this->session->userdata('s_question_set');
//    $s_question_tag = @$this->session->userdata('s_question_tag');
//    $s_appeared_year = @$this->session->userdata('s_appeared_year');
//    $s_question_type = @$this->session->userdata('s_question_type');
//    $s_question = @$this->session->userdata('s_question');
//    $s_mark = @$this->session->userdata('s_mark');
    
}

?>

<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Advance Search<small>Toggle the bar</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-down"></i></a>
                        </li>
<!--                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#">Settings 1</a>
                                </li>
                                <li><a href="#">Settings 2</a>
                                </li>
                            </ul>
                        </li>-->
                        <li><a class="close-link"><i class="fa fa-close"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display: none;">
                    <form name="addEditform" id="addEditform" action="" method="post">
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="board_id" id="board_id" class='form-control board_id advance_search' onchange="setBoard(document.addEditform.board_id.options[ document.addEditform.board_id.selectedIndex].value);" data-rule-required="true">
                                <option value="">---Select Board---</option>
                                <?php
                                if (!empty($boards)) {
                                    foreach ($boards as $board) {
                                        $boardID = $board->board_id;
                                        $boardName = $board->board_name;
                                        $boardSlug = $board->board_slug;
                                        $boardAlias = $board->board_alias;
                                        ?>
                                        <option value="<?php echo $boardID; ?>" <?php
                                        if (!empty($s_board_id) && ($s_board_id == $boardID)) {
                                            echo "selected";
                                        }
                                        ?>><?php echo $boardName; ?> </option>
                                                <?php
                                            }
                                        }
                                        ?>    
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">

                            <select name="level_id" id="level_id" class='form-control level_id advance_search' onchange="setLevel(document.addEditform.level_id.options[ document.addEditform.level_id.selectedIndex].value);" data-rule-required="true">
                                <option value="">---Select Level---</option>
                                <?php
                                if (!empty($s_level_id)) {
                                    foreach ($levels as $level) {
                                        $levelBoardID = $level->board_id;
                                        $levelID = $level->level_id;

                                        if (!empty($s_board_id) && ($s_board_id == $levelBoardID)) {
                                            ?>
                                            <option value="<?php echo $levelID; ?>" <?php
                                            if (!empty($s_level_id) && ($s_level_id == $levelID)) {
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
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="stream_id" id="stream_id" class='form-control advance_search' onchange="setStream(document.addEditform.stream_id.options[ document.addEditform.stream_id.selectedIndex].value);" data-rule-required="true">
                                <option value="">---Select Stream---</option>
                                <?php
                                if (!empty($s_stream_id)) {
                                    foreach ($streams as $stream) {
                                        $streamLevelID = $stream->level_id;
                                        $streamID = $stream->stream_id;
                                        $streamName = $stream->stream_name;

                                        if (!empty($s_level_id) && ($s_level_id == $streamLevelID)) {
                                            ?>
                                            <option value="<?php echo $streamID; ?>" <?php
                                                    if (!empty($s_stream_id) && ($s_stream_id == $streamID)) {
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
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="course_id" id="course_id" class='form-control advance_search' onchange="setCourse(document.addEditform.course_id.options[document.addEditform.course_id.selectedIndex].value);">
                                <option value="">---Select Course---</option>
                                <?php
                                if (!empty($s_course_id)) {
                                    foreach ($courses as $course) {
                                        $courseIDs = $course->course_id;
                                        $courseLevelID = $course->level_id;
                                        $courseStreamID = $course->stream_id;
                                        $courseName = $course->course_name;
                                        if (!empty($s_stream_id) && ($s_stream_id == $courseStreamID)) {
                                            ?>
                                            <option value="<?php echo $courseIDs; ?>" <?php
                                                    if (!empty($s_course_id) && ($s_course_id == $courseIDs)) {
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
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="department_id" id="department_id" class='form-control advance_search'>
                                <option value="">---Select Department---</option>
                                <?php
                                if (!empty($s_department_id)) {
                                    foreach ($departments as $department) {
                                        $departmentID = $department->department_id;
                                        $departmentLevelID = $department->level_id;
                                        $departmentStreamID = $department->stream_id;
                                        $departmentCourseID = $department->course_id;
                                        $departmentName = $department->department_name;

                                        if (!empty($s_course_id) && ($s_course_id == $departmentCourseID)) {
                                            ?>
                                            <option value="<?php echo $departmentID; ?>" <?php
                                                    if (!empty($s_department_id) && ($s_department_id == $departmentID)) {
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
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="year" id="year" class='form-control advance_search' onchange="setYear(document.addEditform.year.options[document.addEditform.year.selectedIndex].value);">
                                <option value="">---Select Year---</option>
                                    <?php
                                    if ($s_year) {
                                        $streamed = $this->db->query("select * from hya_course_stream where stream_id=$s_stream_id")->row();
                                        $year = $streamed->year;
                                        for ($i = 1; $i <= $year; $i++) {
                                            ?>
                                        <option <?php
                                            if (!empty($s_year) && ($s_year == $i)) {
                                                echo "selected";
                                            }
                                            ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="semester" id="semester" class='select2_single form-control advance_search' onchange="setSemester(document.addEditform.semester.options[document.addEditform.semester.selectedIndex].value);">
                                <option value="">---Select Semester---</option>
                                    <?php
                                    if ($s_semester) {
                                        $streamed = $this->db->query("select * from hya_course_stream where stream_id=$s_stream_id")->row();
                                        $semester = $streamed->semester;
                                        for ($j = 1; $j <= $semester; $j++) {
                                            ?>
                                        <option <?php
                                            if (!empty($s_semester) && ($s_semester == $j)) {
                                                echo "selected";
                                            }
                                            ?> value="<?php echo $j; ?>"><?php echo $j; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="subject_id" id="subject_id" class='subject_id form-control advance_search' onchange="setSubject(document.addEditform.subject_id.options[document.addEditform.subject_id.selectedIndex].value);" data-rule-required="true">
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
                                        if (!empty($s_level_id) && ($s_level_id == $subjectLevelID) || !empty($s_stream_id) && ($s_stream_id == $subjectStreamID) || !empty($s_course_id) && ($s_course_id == $subjectCourseID)) {
                                            ?>

                                            <option value="<?php echo $subjectIDs; ?>" <?php
                                            if (!empty($s_subject_id) && ($s_subject_id == $subjectIDs)) {
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
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="chapter_id" id="chapter_id" class='form-control advance_search' data-rule-required="true" onchange="setChapter(document.addEditform.chapter_id.options[document.addEditform.chapter_id.selectedIndex].value);">
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
                                        if (!empty($s_subject_id) && ($s_subject_id == $chapterSubject_id)) {
                                            ?>
                                            <option value="<?php echo $chapterIDs; ?>" <?php
                                            if (!empty($s_chapter_id) && ($s_chapter_id == $chapterIDs)) {
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
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="unit_id" id="unit_id" class='form-control advance_search' onchange="setUnit(document.addEditform.unit_id.options[document.addEditform.unit_id.selectedIndex].value);">
                                <option value="">---Select Unit---</option>
                                        <?php
                                        if (!empty($s_unit_id)) {
                                            foreach ($units as $unit) {
                                                $unitIDs = $unit->unit_id;
                                                $unitLevelID = $unit->level_id;
                                                $unitStreamID = $unit->stream_id;
                                                $unitChapterID = $unit->chapter_id;
                                                $unitName = $unit->unit_name;
                                                if (!empty($s_chapter_id) && ($s_chapter_id == $unitChapterID)) {
                                                    //if ($details->chapter_id == $unitChapterID) {
                                                    ?>

                                            <option value="<?php echo $unitIDs; ?>" <?php
                                            if (!empty($s_unit_id) && ($s_unit_id == $unitIDs)) {
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
                        <div class="col-md-3 col-sm-12 col-xs-12 form-group">
                            <select name="subunit_id" id="subunit_id" class='form-control advance_search' >
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

                                                if (!empty($s_unit_id) && ($s_unit_id == $subunitUnitID)) {
                                                    ?>

                                            <option value="<?php echo $subunitIDs; ?>" <?php
                                                    if (!empty($s_subunit_id) && ($s_subunit_id == $subunitIDs)) {
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
                    </form>
                </div>
            </div>
        </div>
    </div>

    
<!--    <div class="page-title">
        <div class="title_left">
            <a class="btn btn-round btn-primary" href="<?php echo base_url("data/add_question") ?>"> Add Question <i class="fa fa-plus"></i></a>
        </div>

                <div class="title_right">
                    <button class="btn btn-round btn-success" type="button">Add Group</button>
                </div>
    </div>-->

    <div class="clearfix"></div>

    <div class="row">

        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2><?php echo ucfirst(@$page_title); ?></h2>
                    <ul class="project-listings pull-right" id="finalResultCount">
                        <li></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="temp-list">
                        <div class="sample">
                            <h1><small><i class="fa fa-list-ol"></i> </small> Question List
                                <div class="pull-right">
                                    <div class="btn-group">
                                        <a class="btn btn-primary" href="<?php echo base_url('data/add_question') ?>">Add Question<i class="fa fa-plus"></i></a>
                                    </div>
                                </div>
                            </h1>
                            <form class="search-item">
                                <div class="input-group">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                                    </span>
                                    <input type="text" name="data_keywords" id="data_keywords" class="form-control" placeholder="Search for...">
                                </div><!-- /input-group -->
                            </form>
                            <ul class="project-listings" id="finalResult">
                                <?php
                                if (!empty($result)) {
                                    $count = 1;
                                    foreach ($result as $row) {
                                        $question_id = $row->question_id;
                                        $level_id = $row->level_id;
                                        $active = $row->status;

                                        $this->db->select('*');
                                        $this->db->where('level_id', $level_id);
                                        $queryLevel = $this->db->get("course_level");
                                        $resultLevel = $queryLevel->row();
                                        $levelName = @$resultLevel->level_name;
                                        if (!empty($levelName)) {
                                            $levelName = $levelName;
                                        } else {
                                            $levelName = '-';
                                        }
                                        $chapter = $this->db->query("select * from hya_course_chapter where chapter_id=$row->chapter_id")->row();

                                        $unit = $this->db->query("select * from hya_course_unit where unit_id=$row->unit_id")->row();
                                        $subject = $this->db->query("select * from hya_course_subject where subject_id=$row->subject_id")->row();
                                        $course = $this->db->query("select * from hya_course_course where course_id=$row->course_id")->row();

                                        $level = $this->db->query("select * from hya_course_level where level_id=$row->level_id")->row();
                                        $stream = $this->db->query("select * from hya_course_stream where stream_id=$row->stream_id")->row();
                                        $department = $this->db->query("select * from hya_course_department where department_id=$row->department_id")->row();
                                        ?>
                                        <li>
                                            <a href="<?php echo base_url("data/edit_question/$question_id"); ?>">
                                                <div class="list-action-left">
                                                            <!--<img src="<?php echo base_url(); ?>gears/admin/createThumb/create_thumb.php?src=<?php echo ROOT; ?>uploads/<?php echo $imagePath; ?>&w=150&h=150" />-->
                                                    <?php echo $question_id; ?>
                                                </div>
                                                <div class="list-content" style="margin-right:0;padding: 15px;">
                                                    <span class="title">
                                                        <?php
                                                        if (empty($subject)) {
                                                            echo "-";
                                                        } else {
                                                            echo $subject->subject_name;
                                                        }
                                                        ?>
                                                    </span>
                                                    <span class="caption">
                                                        <?php echo strip_tags(shorten_string($row->question, 120)); ?>
                                                    </span>
                                                </div>
                                            </a>
                                            
                                            <div class="list-action-right" style='top:0% !important;'>
                                                <a class="edit" href="<?php echo base_url("data/edit_question/$question_id") ?>"><button class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></button></a>
                                                <a href="#modal-<?php echo $question_id; ?>" role="button" data-toggle="modal"><button class="btn btn-xs btn-danger"><i class="fa fa-times"></i></button></a>
                                            </div>
                                        </li>
        <?php
        $count++;
    }
}
?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br />
        <br />
        <br />

    </div>
</div>

<?php
if (!empty($result)) {
    $count = 1;
    foreach ($result as $row) {
        $question_id = $row->question_id;
        $level_id = $row->level_id;
        $active = $row->status;

        $this->db->select('*');
        $this->db->where('level_id', $level_id);
        $queryLevel = $this->db->get("course_level");
        $resultLevel = $queryLevel->row();
        $levelName = @$resultLevel->level_name;
        if (!empty($levelName)) {
            $levelName = $levelName;
        } else {
            $levelName = '-';
        }
        $chapter = $this->db->query("select * from hya_course_chapter where chapter_id=$row->chapter_id")->row();

        $unit = $this->db->query("select * from hya_course_unit where unit_id=$row->unit_id")->row();
        $subject = $this->db->query("select * from hya_course_subject where subject_id=$row->subject_id")->row();
        $course = $this->db->query("select * from hya_course_course where course_id=$row->course_id")->row();

        $level = $this->db->query("select * from hya_course_level where level_id=$row->level_id")->row();
        $stream = $this->db->query("select * from hya_course_stream where stream_id=$row->stream_id")->row();
        $department = $this->db->query("select * from hya_course_department where department_id=$row->department_id")->row();
        ?>
        <!-- Modal -->
        <div id="modal-<?php echo $question_id; ?>" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Delete Modal</h4>
                    </div>
                    <!-- /.modal-header -->
                    <div class="modal-body">
                        <p>
                            Are you sure to delete the Level  <strong><?php echo $row->question; ?></strong>.<br/>
                        </p>
                    </div>
                    <!-- /.modal-body -->
                    <div class="modal-footer">
                        <a href="<?php echo base_url("data/delete_question/$question_id") ?>" class="btn btn-danger">Delete</a>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                    <!-- /.modal-footer -->
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <?php
        $count++;
    }
}
?>
        <script type="text/javascript">
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
        </script>