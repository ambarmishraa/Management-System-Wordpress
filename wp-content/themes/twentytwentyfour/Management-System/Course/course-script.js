jQuery(document).ready(function($) {
    
  $('#course-submit-btn').on('click', function(event) {
      event.preventDefault(); 
      

      var courseId = $('#course_id').val() || ''; 
      var actionType = courseId ? 'update_course' : 'create_course';
      var data = {
          action_type: actionType,
          course_name: $('#course_name').val(),
          course_code: $('#course_code').val(),
          coordinator_id: $('#coordinator_id').val()
      };

      if (courseId) {
        console.log(courseId)
          data.id = courseId; 
      }

      $.ajax({
          url: ajax_object.course_ajaxurl,
          type: 'POST',
          data: {
              action: 'submit_course_form',
              ...data
          },
          success: function(response) {
              if (response.success) {
                  alert(response.data); 
                  location.reload(); 
              } else {
                  alert(response.data); 
              }
          },
          error: function() {
              alert('An error occurred.');
          }
      });
  });

  // Handle Delete
$(".delete-course")
.off("click")
.on("click", function (e) {
  e.preventDefault();

  if (confirm("Are you sure you want to delete?")) {
    var $row = $(this).closest("tr");
    var id = $(this).data("id");

    $.ajax({
        url: ajax_object.course_ajaxurl,
        type: 'POST',
        data: {
            action: 'submit_course_form',
            action_type: 'delete_course',
            id: courseId
        },
      success: function (response) {
        alert("Item deleted successfully");
   
        $row.remove();
      },

    });
  }
});
});
