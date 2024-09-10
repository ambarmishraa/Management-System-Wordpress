<?php
global $wpdb;

// Fetch course data
$course_table = $wpdb->prefix . 'course';
$course_results = $wpdb->get_results("SELECT id, course_name FROM $course_table");
$course_options = "";
if (!empty($course_results)) {
    foreach ($course_results as $course) {
        $course_options .= "<option value='{$course->id}'>{$course->course_name}</option>";
    }
} else {
    $course_options = "<option value=''>No courses available</option>";
}

// Fetch subject data
$subject_table = $wpdb->prefix . 'subject';
$subject_results = $wpdb->get_results("SELECT id, subject_name FROM $subject_table");
$subjectArray = [];
if (!empty($subject_results)) {
    foreach ($subject_results as $subject) {
        $subjectArray[$subject->id] = $subject->subject_name;
    }
}

// Fetch subcourse data
$subcourse_table = $wpdb->prefix . 'subcourse';
$subcourse_results = $wpdb->get_results("SELECT course_id, id, subject_id FROM $subcourse_table");
$courseToSubcourse = [];
if (!empty($subcourse_results)) {
    foreach ($subcourse_results as $subcourse) {
        $course_id = $subcourse->course_id;
        $subcourse_id = $subcourse->id;
        $subject_id = $subcourse->subject_id;

        if (!isset($courseToSubcourse[$course_id])) {
            $courseToSubcourse[$course_id] = [];
        }

        $subject_name = isset($subjectArray[$subject_id]) ? $subjectArray[$subject_id] : 'Unknown';
        $courseToSubcourse[$course_id][] = [
            'id' => $subcourse_id,
            'course_id' => $course_id,
            'subject_id' => $subject_id,
            'subject_name' => $subject_name
        ];
    }
}

// Fetch student data
$student_table = $wpdb->prefix . 'student';
$student_results = $wpdb->get_results("SELECT id, student_name, student_email, course_id FROM $student_table");
$studentsArray = [];
if (!empty($student_results)) {
    foreach ($student_results as $student) {
        $studentsArray[$student->id] = [
            'studentid' => $student->id,
            'student_name' => $student->student_name,
            'course_id' => $student->course_id,
            'student_email' => $student->student_email
        ];
    }
}

// Map students to subjects
$studentsWithSubjects = [];
foreach ($studentsArray as $studentId => $student) {
    $courseId = $student['course_id'];

    if (isset($courseToSubcourse[$courseId])) {
        $studentsWithSubjects[$studentId] = [
            'studentid' => $student['studentid'],
            'student_name' => $student['student_name'],
            'subjects' => $courseToSubcourse[$courseId]
        ];
    } else {
        $studentsWithSubjects[$studentId] = [
            'student_name' => $student['student_name'],
            'subjects' => [] 
        ];
    }
}

$studentsWithSubjectsJson = json_encode($studentsWithSubjects);
$subjectArrayJson = json_encode($subjectArray);
?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/Management-System/Student/student.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/Management-System/Shared/navbar/navbar.css" />

    <script>
        document.addEventListener("DOMContentLoaded", function () {
         
            var studentsWithSubjects = <?php echo $studentsWithSubjectsJson; ?>;
            var subjectArray = <?php echo $subjectArrayJson; ?>;

            if (typeof studentsWithSubjects !== 'object' || typeof subjectArray !== 'object') {
                console.error('studentsWithSubjects or subjectArray is not defined or is not an object');
                return;
            }

          
            console.log("Students with Subjects:", studentsWithSubjects);

           
            window.addMarks = function (studentId) {
                if (studentsWithSubjects.hasOwnProperty(studentId)) {
                    var student = studentsWithSubjects[studentId];
                    var studentName = student.student_name;
                    var subjects = student.subjects.map(sub => ({
                        subject_id: sub.subject_id,
                        subject_name: sub.subject_name
                    }));

                  
                    var result = {
                        studentid: studentId,
                        student_name: studentName,
                        subjects: subjects
                    };

                  
                    localStorage.setItem('studentResult', JSON.stringify(result));

                    
                    console.log("Student Details:", result);
                    console.log("Subject Array in Local Storage:", subjectArray);

                 
                    window.location.href = 'http://localhost/wordpress/marks-page/?id=' + encodeURIComponent(studentId);
                } else {
                    console.log("Student with ID " + studentId + " not found.");
                }
            };
        });

    </script>

    <?php
    include get_template_directory() . '/Management-System/Shared/navbar/navbar.php';
    ?>

    <div class="left-half">
        <div class="inner-container">
           
                <div class="input-box">
                    <h1 style="padding-left: 10px;">New Student</h1>
                    <div class="input">
                        <input class="field" placeholder="Student Name" type="text" id="student_name" name="student_name" required />
                    </div>
                    <div class="input">
                        <input class="field-1" placeholder="Student Email" type="email" id="student_email" name="student_email" required />
                    </div>
                    <div class="input">
                        <select class="option-menu" id="course_id" name="course_id">
                            <option value="">Choose Course</option>
                            <?php echo $course_options; ?>
                        </select>
                    </div>
                    <div class="input">
                    <button id="student-submit-btn" class="student-submit-btn">Add Student</button>
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
                    <th>Student Email</th>
                    <th>Student Course</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    <th>Add Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php


                // // Handle edit form submission
                // if (isset($_POST['update'])) {
                //     $id = intval($_POST['id']);
                //     $student_name = sanitize_text_field($_POST['student_name']);
                //     $course_id = intval($_POST['course_id']);

                //     $updated = $wpdb->update(
                //         $student_table,
                //         ['student_name' => $student_name, 'course_id' => $course_id],
                //         ['id' => $id]
                //     );

                //     if ($updated !== false) {
                //         // Reload the page to reflect changes
                //         // header("Location: " . $_SERVER['PHP_SELF']);
                //         // exit();
                //     } else {
                //         echo "Error updating record";
                //     }
                // }

                // Handle edit request
                if (isset($_GET['edit_id'])) {
                    $id = intval($_GET['edit_id']);
                    global $wpdb;
                    $student_table = $wpdb->prefix . 'student';
                    $course_table = $wpdb->prefix . 'course';
                    $student = $wpdb->get_row($wpdb->prepare("SELECT * FROM $student_table WHERE id = %d", $id));
                
                    if ($student) {
                        ?>
                        <div class="form-container" id="edit-form-container">
                            <h3>Edit Student</h3>
                            <form id="edit-student-form" method="post" action="">
                                <input type="hidden" name="id" value="<?php echo intval($student->id); ?>">
                                <div>
                                    <input type="text" name="student_name" value="<?php echo $student->student_name; ?>" required>
                                    <input type="email" name="student_email" value="<?php echo $student->student_email; ?>" required>
                                    <select name="course_id" required>
                                        <?php
                                        
                                        $courses = $wpdb->get_results("SELECT id, course_name FROM $course_table");
                                        foreach ($courses as $course) {
                                            $selected = ($course->id == $student->course_id) ? 'selected' : '';
                                            echo '<option value="' . $course->id . '" ' . $selected . '>' . $course->course_name . '</option>';
                                        }
                                        ?>
                                    </select>
                                    <button type="submit" name="update">Update</button>
                                </div>
                            </form>
                        </div>
                        <?php
                    }
                }

                 
                $students = $wpdb->get_results("
                    SELECT s.id, s.student_name, s.student_email, c.course_name 
                    FROM $student_table s 
                    JOIN $course_table c ON s.course_id = c.id
                ");
                $serial_no = 1;

                if (!empty($students)) {
                    foreach ($students as $student) {
                        echo "<tr>";
                        echo "<td>" . $serial_no++ . "</td>";
                        echo "<td>" . esc_html($student->student_name) . "</td>";
                        echo "<td>" . esc_html($student->student_email) . "</td>";
                        echo "<td>" . esc_html($student->course_name) . "</td>";
                        echo '<td><a href="?edit_id=' . $student->id . '">Edit</a></td>';
                        echo '<td><a href="#" class="delete-student button" data-id="' . $student->id . '">Delete</a></td>';
                        echo '<td><button onclick="addMarks(' . $student->id . ')">Add Marks</button></td>';
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No students found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

