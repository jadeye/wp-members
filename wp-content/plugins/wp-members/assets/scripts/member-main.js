jQuery(function($){

    $("#register-form").on( 'submit', function (e) {
        e.preventDefault();

        var thisForm = $(this);

        $("register-status").html(
            '<div class="alert alert-info">Please wait while your account is beong created.</div>'
        );
        thisForm.hide();

        var form            =   {
            action:             "member_create_account",
            name:               $("#register-form-name").val(),
            username:           $("#register-form-username").val(),
            email:              $("#register-form-email").val(),
            pass:               $("#register-form-password").val(),
            confirm_pass:       $("#register-form-repassword").val(),
            _wpnonce:           $("#_wpnonce").val()
        };

        $.post( member_obj.ajax_url, form ).always(function (response) {
            if (response.status === 2){
                showMsg(160);
                $('#register-status').html(
                    '<div class="alert alert-success">' + response.msg + '</div>'
                ).fadeIn().delay(5000).fadeOut();
                console.log("GOOD MEMBER FORM");
                setTimeout( function() {
                        location.href = member_obj.home_url;
                    }, 5000);
            } else {
                showMsg(160);
                $('#register-status').html(
                    '<div class="alert alert-danger">' + response.msg + '</div>'
                ).fadeIn().delay(5000).fadeOut();
                thisForm.show();
            }
        });

        function showMsg(goto) {
            $('html, body').animate({
                scrollTop: $("#register-status").offset().top-goto
            }, 500);
        }

    });

});