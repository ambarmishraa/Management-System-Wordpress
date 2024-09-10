<?php
 
global $wpdb;

$edit_id = null;
$student_name = "";
$subject_name = "";
$marks = "";

// Table names
$marks_table = $wpdb->prefix . 'marks';
$student_table = $wpdb->prefix . 'student';
$subject_table = $wpdb->prefix . 'subject';

if (isset($_GET['edit_id'])) {
    $edit_id = intval($_GET['edit_id']);

    // Fetch the record to edit
    $record = $wpdb->get_row(
        $wpdb->prepare("
            SELECT m.id, m.marks, s.student_name, sub.subject_name 
            FROM $marks_table m
            JOIN $student_table s ON m.student_id = s.id
            JOIN $subject_table sub ON m.subject_id = sub.id
            WHERE m.id = %d",
            $edit_id
        )
    );

    if ($record) {
        $student_name = $record->student_name;
        $subject_name = $record->subject_name;
        $marks = $record->marks;
    } else {
        echo "Record not found.";
        exit();
    }
}

// Handle form submission to update the record
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $updated_student_name = sanitize_text_field($_POST['student_name']);
    $updated_subject_name = sanitize_text_field($_POST['subject_name']);
    $updated_marks = intval($_POST['marks']);

   
    $student_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM $student_table WHERE student_name = %s", $updated_student_name));
    $subject_id = $wpdb->get_var($wpdb->prepare("SELECT id FROM $subject_table WHERE subject_name = %s", $updated_subject_name));

    // Update the record
    $updated = $wpdb->update(
        $marks_table,
        array(
            'student_id' => $student_id,
            'subject_id' => $subject_id,
            'marks' => $updated_marks
        ),
        array('id' => $edit_id)
    );

    if ($updated !== false) {
        
        // wp_redirect('marks_interface.php');
        // exit();
    } else {
        echo "Error: Update failed.";
    }
}
?>

    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/Management-System/Marks/marks_edit.css" />
    <div class="main-container">
        <form action="<?php echo esc_url(add_query_arg('edit_id', $edit_id)); ?>" method="post">
            <table border="1">
                <thead>
                    <tr>
                        <th>Row No</th>
                        <th>Student Name</th>
                        <th>Subject Name</th>
                        <th>Marks</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo esc_html($edit_id); ?></td>
                        <td>
                            <input type="text" name="student_name" value="<?php echo $student_name; ?>" readonly />
                        </td>
                        <td>
                            <input type="text" name="subject_name" value="<?php echo $subject_name; ?>" readonly />
                        </td>
                        <td>
                            <input type="number" name="marks" value="<?php echo $marks; ?>" required />
                        </td>
                        <td><input type="submit" value="Update Marks" /></td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
