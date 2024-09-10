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

  // Handle delete
  $('.delete-course').on('click', function(event) {
      event.preventDefault();  

      var courseId = $(this).data('id');

      if (confirm('Are you sure you want to delete this course?')) {
          $.ajax({
              url: ajax_object.course_ajaxurl,
              type: 'POST',
              data: {
                  action: 'submit_course_form',
                  action_type: 'delete_course',
                  id: courseId
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
      }
  });
});
