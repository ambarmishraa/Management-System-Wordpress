<?php
global $wpdb;

$table_coordinator = $wpdb->prefix . "coordinator";

$coordinators = $wpdb->get_results("SELECT id, name FROM $table_coordinator");

$options = "";
if ($coordinators) {
    foreach ($coordinators as $coordinator) {
        $options .= "<option value='" . ($coordinator->id) . "'>" . ($coordinator->name) . "</option>";
    }
} else {
    $options = "<option value=''>No Coordinators Available</option>";
}
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-course');
        var formTitle = document.getElementById('form-title');
        var submitButton = document.getElementById('submit-btn');
        var form = document.querySelector('.left-half .input-box');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); 
                
                var courseId = this.getAttribute('data-id');
                var courseName = this.getAttribute('data-name');
                var courseCode = this.getAttribute('data-code');
                var coordinatorId = this.getAttribute('data-coordinator');

                
                document.getElementById('course_name').value = courseName;
                document.getElementById('course_code').value = courseCode;
                document.getElementById('coordinator_id').value = coordinatorId;

               
                formTitle.textContent = 'Edit Course';
                submitButton.textContent = 'Update Course';

                if (!document.getElementById('course_id')) {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.id = 'course_id';
                    hiddenInput.name = 'course_id';
                    hiddenInput.value = courseId;
                    form.appendChild(hiddenInput);
                } else {
                    document.getElementById('course_id').value = courseId;
                }
            });
        });
    });
</script>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?> /Management-System/Course/course.css" />

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?> /Management-System/Shared/navbar/navbar.css" />

<?php
include get_template_directory() . '/Management-System/Shared/navbar/navbar.php';
?>

<div class="left-half">
    <div class="inner-container">
        <div class="input-box">
            <h1 style="padding-left: 17px" id="form-title">New Course</h1>
            <div class="input">
                <input
                    class="field"
                    placeholder="Course Name"
                    type="text"
                    id="course_name"
                    name="course_name"
                    required />
            </div>
            <div class="input">
                <input
                    class="field-1"
                    placeholder="Course Code"
                    type="text"
                    id="course_code"
                    name="course_code"
                    required />
            </div>
            <div class="input">
                <select class="option-menu" id="coordinator_id" name="coordinator_id">
                    <option value="">Choose Co-Ordinator</option>
                    <?php echo $options; ?>
                </select>
            </div>
            <div class="input">
                <button id="course-submit-btn" class="course-submit-btn">Add Course</button>
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
                <th>Course Name</th>
                <th>Course Code</th>
                <th>Coordinator Name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php
            global $wpdb;
            $course_table = $wpdb->prefix . 'course';
            $coordinator_table = $wpdb->prefix . 'coordinator';

            $results = $wpdb->get_results("
                SELECT course.id, course.course_name, course.course_code, coordinator.name AS coordinator_name, course.coordinator_id
                FROM $course_table AS course
                JOIN $coordinator_table AS coordinator ON course.coordinator_id = coordinator.id
            ");

            $coordinator_result = $wpdb->get_results("SELECT id, name FROM $coordinator_table");

            if ($results) {
                $serialNo = 1;
                foreach ($results as $row) {
                    echo '<tr>';
                    echo '<td>' . $serialNo++ . '</td>';
                    echo '<td>' . $row->course_name . '</td>';
                    echo '<td>' . $row->course_code . '</td>';
                    echo '<td>' . $row->coordinator_name . '</td>';

                    echo '<td><a href="#" class="edit-course button" data-id="' . $row->id . '" data-name="' . $row->course_name . '" data-code="' . $row->course_code . '" data-coordinator="' . $row->coordinator_id . '">Edit</a></td>';

                    echo '<td><a href="#" class="delete-course button" data-id="' . $row->id . '">Delete</a></td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>

</div>