jQuery(document).ready(function ($) {
  $("#submit-btn").click(function (e) {
    e.preventDefault();

    var courseId = $("#course_id").val();
    var subjectIds = [];

    $("input[name='subject_ids[]']:checked").each(function () {
      subjectIds.push($(this).val());
    });

    var subjectIdsStr = subjectIds.join(",");

    $.ajax({
      url: my_ajax_subcourse.ajaxurl_subcourse,
      type: "POST",
      data: {
        action: "submit_subcourse_form",
        action_type: "create_subcourse",
        course_id: courseId,
        subject_ids: subjectIdsStr,
      },
      success: function (response) {
        if (response.success) {
          alert(
            "New Relation Established:\nCourse Id: " +
              courseId +
              "\nSubjects Ids: " +
              subjectIdsStr
          );
        } else {
          alert("Error: " + response.data);
        }
        location.reload();
      },
    });
  });

  // Handle Delete
  // $(".delete-subcourse")
  //   .off("click")
  //   .on("click", function (e) {
  //     e.preventDefault();

  //     if (confirm("Are you sure you want to delete?")) {
  //       var $row = $(this).closest("tr");
  //       var id = $(this).data("id");

  //       $.ajax({
  //           url: my_ajax_subcourse.ajaxurl_subcourse,
  //         type: "POST",
  //         data: {
  //           action: "submit_subcourse_form",
  //           action_type: "delete_subcourse",
  //           id: id,
  //         },
  //         success: function (response) {
  //           alert("Item deleted successfully");

  //           $row.remove();
  //         },

  //       });
  //     }
  //   });

  // Handle Delete
  $(".delete-subcourse").click(function (e) {
    e.preventDefault();

    if (confirm("Are you sure you want to delete?")) {
      var $row = $(this).closest("tr");
      var id = $(this).data("id");

      $.ajax({
        url: my_ajax_subcourse.ajaxurl_subcourse,
        type: "POST",
        data: {
          action: "submit_subcourse_form",
          action_type: "delete_subcourse",
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
