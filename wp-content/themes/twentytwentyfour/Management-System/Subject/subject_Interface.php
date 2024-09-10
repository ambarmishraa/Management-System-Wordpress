<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?> /Management-System/Subject/subject.css" />

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?> /Management-System/Shared/navbar/navbar.css" />

<?php
include get_template_directory() . '/Management-System/Shared/navbar/navbar.php';
?>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-subject');
        var formTitle = document.getElementById('form-title');
        var submitButton = document.getElementById('submit-btn');
        var form = document.querySelector('.left-half .input-box');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault(); 
                
                var subjectId = this.getAttribute('data-id');
                var subjectName = this.getAttribute('data-name');
                var subjectCode = this.getAttribute('data-code');

                
                document.getElementById('subject_name').value = subjectName;
                document.getElementById('subject_code').value = subjectCode;

               
                formTitle.textContent = 'Edit Subject';
                submitButton.textContent = 'Update Subject';

                if (!document.getElementById('subject_id')) {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.id = 'subject_id';
                    hiddenInput.name = 'subject_id';
                    hiddenInput.value = subjectId;
                    form.appendChild(hiddenInput);
                } else {
                    document.getElementById('subject_id').value = subjectId;
                }
            });
        });
    });
</script>

<div class="left-half">
  <div class="inner-container">

    <div class="input-box">
      <h1 style="padding-left: 15px;" id="form-title">New Subject</h1>
      <div class="input">
        <input
          class="field"
          placeholder="Subject Name"
          type="text"
          id="subject_name"
          name="subject_name"
          required />
      </div>
      <div class="input">
        <input
          class="field-1"
          placeholder="Subject Code"
          type="text"
          id="subject_code"
          name="subject_code"
          required />
      </div>

      <div class="input">

        <button id="subject-submit-btn" class="subject-submit-btn">Add Subject</button>

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
        <th>Subject Name</th>
        <th>Subject Code</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
    <?php
global $wpdb;
$subject_table = $wpdb->prefix . 'subject';


$results = $wpdb->get_results("SELECT id, subject_name, subject_code FROM $subject_table");

if (!empty($results)) {
    foreach ($results as $row) {
        echo "<tr>";
        echo "<td>" . $row->id . "</td>";
        echo "<td>" . $row->subject_name . "</td>";
        echo "<td>" . $row->subject_code . "</td>";
        echo '<td><a href="#" class="edit-subject button" data-id="' . $row->id . '" data-name="' . $row->subject_name . '" data-code="' . $row->subject_code . '">Edit</a></td>';
        echo '<td><a href="#" class="delete-subject button" data-id="' . $row->id . '">Delete</a></td>';
        echo '</tr>';
    }
} else {
    echo "<tr><td colspan='5'>0 results</td></tr>";
}
?>

    </tbody>
  </table>
 
</div>
