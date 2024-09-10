jQuery(document).ready(function($) {
 
  $("#student-submit-btn").click(function(e) {
      e.preventDefault();
 
      var studentName = $("#student_name").val();
      var studentEmail = $("#student_email").val();
      var courseId = $("#course_id").val();

      $.ajax({
          url: ajax_student_object.ajaxurl_student,
          type: "POST",
          data: {
              action: "submit_student_form",
              action_type: "create_student",
              student_name: studentName,
              student_email: studentEmail,
              course_id: courseId
          },
          success: function(response) {
              alert("New Student Added: \n" +
                  "Student Name: " + studentName + "\n" +
                  "Student Email: " + studentEmail + "\n" +
                  "Course ID: " + courseId);
              location.reload();
          },
          error: function(xhr, status, error) {
              console.error('AJAX Error:', status, error);
              alert('An error occurred while processing the request.');
          }
      });
  });

   // Handle edit form submission
   $('#edit-student-form').on('submit', function(event) {
    event.preventDefault();

    var formData = $(this).serialize();
    console.log(formData);  

    $.ajax({
        type: 'POST',
        url: ajax_student_object.ajaxurl_student,
        data: {
            action: 'submit_student_form',
            action_type: 'update_student',
            data: formData
        },
        success: function(response) {
            console.log(response);
            if (response.success) {
                alert('Student updated successfully.');
                location.reload();
            } else {
                alert('Error updating student: ' + response.data);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
            console.error(xhr.responseText);  
            alert('An error occurred while processing the request.');
        }
    });
});



  // Handle student deletion
  $(".delete-student").click(function(e) {
      e.preventDefault();

      if (confirm("Are you sure you want to delete?")) {
          var id = $(this).data("id");

          $.ajax({
              url: ajax_student_object.ajaxurl_student,
              type: "POST",
              data: {
                  action: "submit_student_form",
                  action_type: "delete_student",
                  id: id,
              },
              success: function(response) {
                  alert(response);
                  location.reload();
              },
            
          });
      }
  });
}); 