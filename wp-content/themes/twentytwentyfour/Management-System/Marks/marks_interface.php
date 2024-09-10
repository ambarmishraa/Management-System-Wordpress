<?php
ob_start(); 

require_once('wp-load.php');

global $wpdb;

$table_name_marks = $wpdb->prefix . 'marks';
$table_name_student = $wpdb->prefix . 'student';
$table_name_subject = $wpdb->prefix . 'subject';

$marks_query = $wpdb->prepare(
    "SELECT marks.id AS marks_id, marks.student_id, marks.subject_id, marks.marks, 
            student.student_name, subject.subject_name
     FROM $table_name_marks AS marks
     JOIN $table_name_student AS student ON marks.student_id = student.id
     JOIN $table_name_subject AS subject ON marks.subject_id = subject.id
     ORDER BY student.id"
);

$marks_result = $wpdb->get_results($marks_query, ARRAY_A);

$last_student_name = "";
$index = 1;

ob_end_flush(); 
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/Management-System/Marks/marks.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/Management-System/Shared/navbar/navbar.css" />

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Marks</title>
    <script>
        function updateSubjects() {
            var studentSelect = document.getElementById('student_id');
            if (studentSelect) {
                studentSelect.addEventListener('change', function() {
                    console.log('Selected student ID:', this.value);
                    this.form.submit();
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var studentResult = localStorage.getItem('studentResult');
            if (studentResult) {
                var result = JSON.parse(studentResult);
                var studentName = result.student_name;
                var studentId = result.studentid;

                var studentNameInput = document.getElementById('studentName');
                if (studentNameInput) {
                    studentNameInput.value = studentName;
                }

                var studentIdInput = document.getElementById('student_id');
                if (studentIdInput) {
                    studentIdInput.value = studentId;
                }

                var subjectSelect = document.getElementById('subject_id');
                if (subjectSelect) {
                    subjectSelect.innerHTML = '';
                    var defaultOption = document.createElement('option');
                    defaultOption.value = '';
                    defaultOption.textContent = 'Select a subject';
                    subjectSelect.appendChild(defaultOption);

                    var subjects = result.subjects || [];
                    subjects.forEach(function(subject) {
                        if (subject.subject_name !== "Unknown") {
                            var option = document.createElement('option');
                            option.value = subject.subject_id;
                            option.textContent = subject.subject_name;
                            subjectSelect.appendChild(option);
                        }
                    });
                }
            } else {
                var studentNameInput = document.getElementById('studentName');
                if (studentNameInput) {
                    studentNameInput.value = "";
                }

                var subjectSelect = document.getElementById('subject_id');
                if (subjectSelect) {
                    subjectSelect.innerHTML = '';
                }
            }
        });
    </script>
</head>

<body>
    <?php
    include get_template_directory() . '/Management-System/Shared/navbar/navbar.php';
    ?>

    <div class="left-half">
        <div class="inner-container">
            <div class="input-box">
                <h1 style="padding-left: 33px;">Add Marks</h1>
                <div class="input">
                    <input type="hidden" id="student_id" name="student_id" />
                    <input class="option-menu" placeholder="Student Name" id="studentName" readonly />
                </div>
                <div class="input">
                    <select class="option-menu" id="subject_id" name="subject_id">
                    </select>
                </div>
                <div class="input">
                    <input class="field-1" placeholder="Enter Marks" type="number" id="marks" name="marks" required />
                </div>
                <div class="input">
                    <button id="marks-submit-btn" class="marks-submit-btn">Add Marks</button>
                </div>
                <div style="color: red; margin-left:40%;">
                    <button style="background-color: #fff; border-radius:10px; padding:4px"><a href="#right-half">View Table</a></button>
                </div>
            </div>
        </div>
    </div>

    <div class="right-half" id="right-half">
        <table border="1">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Student Name</th>
                    <th>Subject Name</th>
                    <th>Marks</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($marks_result) {
                    $last_student_name = "";
                    $index = 1;
                    foreach ($marks_result as $row) {
                        if ($last_student_name != $row['student_name']) {
                            if ($last_student_name != "") {
                                echo "<tr class='gap-row'><td colspan='6'></td></tr>";
                            }
                            echo "<tr>";
                            echo "<td>{$index}</td>";
                            echo "<td>{$row['student_name']}</td>";
                            $last_student_name = $row['student_name'];
                            $index++;
                        } else {
                            echo "<tr>";
                            echo "<td></td>";
                            echo "<td></td>";
                        }
                        echo "<td>{$row['subject_name']}</td>";
                        echo "<td>{$row['marks']}</td>";
                        echo "<td><a href='http://localhost/wordpress/marksedit-page/?edit_id={$row['marks_id']}' class='button'>Edit</a></td>";
                        echo '<td><a href="#" class="delete-marks button" data-id="' . $row['marks_id'] . '">Delete</a></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>
