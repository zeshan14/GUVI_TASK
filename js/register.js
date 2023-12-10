$(document).ready(function() {

    $("#signup-form").submit(function(event) {
        event.preventDefault();

        var username = $("#username").val();
        var email = $("#email").val();
        var password = $("#password").val();

        $.ajax({
            url: "php/register.php",
            method: "POST",
            data: {
                username: username,
                email: email,
                password: password
            },
            success: function(response) {
                console.log(response);
                alert("Registration successful!");
                window.location.href = "login.html";
            },
            error: function(error) {
                console.error(error);
                alert("Error: " + error.responseText);
            }
        });
    });
});
