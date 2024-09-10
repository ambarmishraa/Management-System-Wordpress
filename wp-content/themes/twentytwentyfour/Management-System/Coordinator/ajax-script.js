
jQuery(document).ready(function ($) {
  $("#submit-btn") .click(function (e) {
    e.preventDefault();
     

    // Request to create new coordinator
    $.ajax({
      url: my_ajax_obj.ajaxurl,
      type: "POST",
      data: {
        action: "handle_request",
        action_type: "create",
        name: $("#coordinator_name").val(),
        email: $("#coordinator_email").val(),
      },
      success: function (response) {
        alert("New Coordinator Added");

        location.reload();
      },
    });
  });

  $("#right-half").on("click", ".edit-coordinator", function (e) {
    e.preventDefault();

    var id = $(this).data("id");
    var name = $(this).data("name");
    var email = $(this).data("email");

    $("#edit-id").val(id);
    $("#edit-name").val(name);
    $("#edit-email").val(email);

    $("#update-coordinator-form").show();
  });

  $("#update-coordinator-form").off("submit").on("submit", function (e) {
    e.preventDefault();

    $.ajax({
      url: my_ajax_obj.ajaxurl,
      type: "POST",
      data: {
        action: "handle_request",
        action_type: "update",
        id: $("#edit-id").val(),
        name: $("#edit-name").val(),
        email: $("#edit-email").val(),
      },
      success: function (response) {
        alert(response);
        location.reload();
      },
    });
  });

// Handle Delete
$(".delete-coordinator")
.off("click")
.on("click", function (e) {
  e.preventDefault();

  if (confirm("Are you sure you want to delete?")) {
    var $row = $(this).closest("tr");
    var id = $(this).data("id");

    $.ajax({
      url: my_ajax_obj.ajaxurl,
      type: "POST",
      data: {
        action: "handle_request",
          action_type: "delete",
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