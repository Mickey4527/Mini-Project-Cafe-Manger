/*ajax for setup */
$(document).ready(function () {
    $("#setup").click(function () {
        $.ajax({
            type: "POST",
            url: "../pages/setup.php",
            data: {
                'setup': 'setup'
            },
            success: function (data) {
                if (data == "success") {
                    alert("Setup Complete");
                    window.location.href = "index.php";
                } else {
                    alert(data);
                }
            }
        });
    });
});