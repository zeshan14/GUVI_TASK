$(document).ready(function() {

    var session_id = localStorage.getItem("session_id");

    if (!session_id) {
        window.location.href = "login.html";
        return;
    }

    function getProfileDetails() {
        $.ajax({
            url: "profile.php",
            method: "GET",
            data: {
                session_id: session_id
            },
            success: function(response) {
                console.log(response);
                $("#profile-details").html(response);
            },
            error: function(error) {
                console.error(error);
                alert("Error: " + error.responseText);
            }
        });
    }

    getProfileDetails();

    $("#profile-update-form").submit(function(event) {
        event.preventDefault();

        var age = $("#age").val();
        var dob = $("#dob").val();
        var contact = $("#contact").val();

        $.ajax({
            url: "php/profile.php",
            method: "POST",
            data: {
                age: age,
                dob: dob,
                contact: contact
            },
            success: function(response) {
                console.log(response);
                alert("Profile updated successfully!");
                getProfileDetails();
            },
            error: function(error) {
                console.error(error);
                alert("Error: " + error.responseText);
            }
        });
    });
});
