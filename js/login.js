$(document).ready(function() {

    $("#login-form").submit(function(event) {
        event.preventDefault();

        var username = $("#username").val();
        var password = $("#password").val();

        $.ajax({
            url: "php/login.php",
            method: "POST",
            data: {
                username: username,
                password: password
            },
            success: function(response) {
                console.log(response);
                window.location.href = "profile.html";
            },
            error: function(error) {
                console.error(error);
                alert("Error: " + error.responseText);
            }
        });
    });
});
