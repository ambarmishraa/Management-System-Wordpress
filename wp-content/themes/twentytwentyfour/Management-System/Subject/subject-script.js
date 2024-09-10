jQuery(document).ready(function ($) {
  $("#subject-submit-btn").click(function (e) {
    e.preventDefault();

    var subjectId = $('#subject_id').val() || ''; 
    var actionType = subjectId ? 'update_subject' : 'create_subject';
    var subjectName = $('#subject_name').val();
    var subjectCode = $('#subject_code').val();
    var data = {
      action_type: actionType,
      subject_name: subjectName,
      subject_code: subjectCode
    };

    if (subjectId) {
      data.id = subjectId;
    }

    $.ajax({
      url: ajax_subject_object.subject_ajaxurl,
      type: "POST",
      data: {
        action: 'submit_subject_form',
        ...data
      },
      success: function (response) {
        alert(
          "New Subject Added!\nSubject Name: " +
            subjectName +
            "\nSubject Code: " +
            subjectCode
        );
        location.reload();
      },
      error: function () {
        alert("An error occurred while submitting the form.");
      }
    });
  });

  // // Handle Delete
  // $(".delete-subject")
  //   .off("click")
  //   .on("click", function (e) {
  //     e.preventDefault();

  //     if (confirm("Are you sure you want to delete?")) {
  //       var $row = $(this).closest("tr");
  //       var id = $(this).data("id");

  //       $.ajax({
  //         url: ajax_subject_object.subject_ajaxurl,
  //         type: "POST",
  //         data: {
  //           action: "submit_subject_form",
  //           action_type: "delete_subject",
  //           id: id,
  //         },
  //         success: function (response) {
  //           alert("Item deleted successfully");
  //           $row.remove();
  //         },
  //         error: function () {
  //           alert("An error occurred while deleting the item.");
  //         },
  //       });
  //     }
  //   });

      // Handle Delete
  $(".delete-subject").click(function (e) {
    e.preventDefault();

    if (confirm("Are you sure you want to delete?")) {
      var $row = $(this).closest("tr");
      var id = $(this).data("id");

      $.ajax({
        url: ajax_subject_object.subject_ajaxurl,
        type: "POST",
        data: {
          action: "submit_subject_form",
          action_type: "delete_subject",
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
