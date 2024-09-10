jQuery(document).ready(function ($) {
  $("#submit-btn").click(function (e) {
      e.preventDefault();

      var student_name = $("#student_name").val();
      var subject_name = $("#subject_name").val();
      var marks = $("#marks").val();

      $.ajax({
          url: ajax_marksEdit_object.marksEdit_ajaxurl,
          type: "POST",
          data: {
              action: "submit_marks_form",
              action_type: "create_course",
              student_name: student_name,
              subject_name: subject_name,
              marks: marks
          },
          success: function (response) {
              // alert("New Course Added: \n" +
              //     "Student Name: " + student_name + "\n" +
              //     "Subject Name: " + subject_name + "\n" +
              //     "Marks: " + marks);
              // location.reload(); 
          },
          error: function (xhr, status, error) {
              console.error('AJAX Error:', status, error);
          }
      });
  });
});
