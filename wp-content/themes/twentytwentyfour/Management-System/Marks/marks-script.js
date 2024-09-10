jQuery(document).ready(function ($) {
  $("#marks-submit-btn").click(function (e) {
    e.preventDefault();
     

    var studentId = $("#student_id").val();
    var subjectId = $("#subject_id").val();
    var marks = $("#marks").val();

    console.log(studentId);
    console.log(subjectId);
    console.log(marks);

    $.ajax({
      url: ajax_marks.marks_ajaxurl,
      type: "POST",
      data: {
        action: "submit_marks_form",
        action_type: "create_marks",
        student_id: studentId,
        subject_id: subjectId,
        marks: marks,
      },

      success: function (response) {
        alert(
          "New Marks Added: \n" +
            "Student Id: " +
            studentId +
            "\n" +
            "Subject Id: " +
            subjectId +
            "\n" +
            "marks: " +
            marks
        );
        location.reload();
      },
    });
  });

   // Handle Delete
   $(".delete-marks")
   .off("click")
   .on("click", function (e) {
     e.preventDefault();

     if (confirm("Are you sure you want to delete?")) {
       var $row = $(this).closest("tr");
       var id = $(this).data("id");

       $.ajax({
        url: ajax_marks.marks_ajaxurl,
         type: "POST",
         data: {
           action: "submit_marks_form",
           action_type: "delete_marks",
           id: id,
         },
         success: function (response) {
           alert("Item deleted successfully");
      
           $row.remove();
         },
  
       });
     }
   });
});
