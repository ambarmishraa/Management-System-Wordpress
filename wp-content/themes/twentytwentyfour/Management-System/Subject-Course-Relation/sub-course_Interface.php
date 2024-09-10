<?php
global $wpdb;
$table_course = $wpdb->prefix . 'course';       
$table_subject = $wpdb->prefix . 'subject';      
$table_subcourse = $wpdb->prefix . 'subcourse';  


// Handle form submission for updates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $edit_course_id = $_POST['edit_course_id'] ?? null;
    $subject_ids = $_POST['subject_ids'] ?? [];

    if ($edit_course_id) {
     
        $wpdb->delete($table_subcourse, ['course_id' => intval($edit_course_id)], ['%d']);

        // Insert updated subjects
        foreach ($subject_ids as $subject_id) {
            $wpdb->insert(
                $table_subcourse,
                [
                    'course_id' => intval($edit_course_id),
                    'subject_id' => intval($subject_id),
                ],
                ['%d', '%d']
            );
        }
        wp_redirect("sub-course_Interface.php");
        exit();
    }
}

// Fetch course options
$courses = $wpdb->get_results("SELECT id, course_name FROM $table_course", ARRAY_A);
$course_options = "";
if (!empty($courses)) {
    foreach ($courses as $row) {
        $course_id = $row["id"];
        $course_name = $row["course_name"];
        $course_options .= "<option value='$course_id'>$course_name</option>";
    }
} else {
    $course_options = "<option value=''>No courses available</option>";
}

// Fetch subject options
$subjects = $wpdb->get_results("SELECT id, subject_name FROM $table_subject", ARRAY_A);
$subject_options = "";
if (!empty($subjects)) {
    foreach ($subjects as $row) {
        $subject_id = $row["id"];
        $subject_name = $row["subject_name"];
        $subject_options .= "<label><input type='checkbox' name='subject_ids[]' value='$subject_id'>$subject_name</label><br>";
    }
} else {
    $subject_options = "<label>No subjects available</label>";
}

// Initialize variables for editing
$edit_course_id = $edit_subject_ids = [];

if (isset($_GET['edit_id'])) {
    $edit_course_id = intval($_GET['edit_id']);

  
    $edit_subject_ids = $wpdb->get_col($wpdb->prepare(
        "SELECT subject_id FROM $table_subcourse WHERE course_id = %d",
        $edit_course_id
    ));
}
?>


    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/Management-System/Subject-Course-Relation/sub-course.css" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/Management-System/Shared/navbar/navbar.css" />

    <?php include get_template_directory() . '/Management-System/Shared/navbar/navbar.php'; ?>

    <div class="left-half">
        <div class="inner-container">
           
                <div class="input-box">
                    <h1 style="padding-left: 30px; margin:32px 0;">Relate Subject & Course</h1>

                    <div class="input">
                        <select class="option-menu" id="course_id" name="course_id">
                            <option value="">Choose Course</option>
                            <?php echo $course_options; ?>
                        </select>
                    </div>
                    <p style="padding-left:38px; color:white;font-size:18px">Choose Subject :</p>
                    <div class="checkbox-input">
                        <?php echo $subject_options; ?>
                    </div>
                   <div class="box-bottom">
                        <div class="input">
                         <button id="submit-btn" class="submit-btn">Add Subject</button>

                
                        </div>
                        <div>
                            <button style="background-color: #fff; border-radius:10px; padding:4px">
                                <a href="#right-half">View Table</a>
                            </button>
                        </div>
                   </div>
                </div>
         

            <!-- Edit Form -->
            <?php if ($edit_course_id): ?>
                <form action="sub-course_Interface.php" method="post">
                    <input type="hidden" name="edit_course_id" value="<?php echo $edit_course_id; ?>">
                    <p style="color: white;">Select subjects to update:</p><br>
                    <?php
                    if (!empty($subjects)) {
                        foreach ($subjects as $row) {
                            $subject_id = $row["id"];
                            $subject_name = $row["subject_name"];
                            $checked = in_array($subject_id, $edit_subject_ids) ? 'checked' : '';

                            echo "<label style='color: white;'><input type='checkbox' name='subject_ids[]' value='$subject_id' $checked>$subject_name</label><br>";
                        }
                    } else {
                        echo "<label>No subjects available</label>";
                    }
                    ?>
                    <div class="input">
                        <input class="submit-btn" type="submit" name="update" value="Update">
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="right-half" id="right-half">
        <table border="1">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Course Name</th>
                    <th>Subject Name</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $course_subject_map = [];
                $results = $wpdb->get_results(
                    "SELECT sc.id AS subcourse_id, c.id AS course_id, c.course_name, s.subject_name
                    FROM $table_subcourse AS sc
                    JOIN $table_course AS c ON sc.course_id = c.id
                    JOIN $table_subject AS s ON sc.subject_id = s.id
                    ORDER BY c.id",
                    ARRAY_A
                );

                if (!empty($results)) {
                    $index = 1;
                    foreach ($results as $row) {
                        $course_id = $row['course_id'];
                        $course_name = $row['course_name'];
                        $subject_name = $row['subject_name'];
                        $subcourse_id = $row['subcourse_id'];

                        if (!isset($course_subject_map[$course_id])) {
                            $course_subject_map[$course_id] = [
                                'course_name' => $course_name,
                                'subjects' => []
                            ];
                        }

                        $course_subject_map[$course_id]['subjects'][] = $subject_name;
                    }

                    foreach ($course_subject_map as $course_id => $data) {
                        echo "<tr>";
                        echo "<td>{$index}</td>";
                        echo "<td>{$data['course_name']}</td>";
                        echo "<td>" . implode(", ", $data['subjects']) . "</td>";
                        echo "<td><a href='?edit_id={$course_id}' class='button'>Edit</a></td>";


                        // echo '<td><a href="#" class="edit-subcourse button" data-id="' . $course_id . '">Edit</a></td>';


                        echo '<td><a href="#" class="delete-subcourse button" data-id="' . $course_id . '">Delete</a></td>';
                        echo "</tr>";
                        $index++;
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
