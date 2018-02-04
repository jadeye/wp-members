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
                createDiv('alert-success', response.msg);
                /*$('#register-status').html(
                    '<div class="alert alert-success">' + response.msg + '</div>'
                ).fadeIn().delay(5000).fadeOut();*/
                setTimeout( function() {
                        location.href = member_obj.home_url;
                    }, 5000);
            } else {
                showMsg(160);
                createDiv('alert-danger', response.msg);
                /*$('#register-status').html(
                    '<div class="alert alert-danger">' + response.msg + '</div>'
                ).fadeIn().delay(5000).fadeOut();*/
                thisForm.show();
            }
        });

        function showMsg(goto) {
            $('html, body').animate({
                scrollTop: $("#register-status").offset().top-goto
            }, 500);
        }

        function createDiv(state, _msg) {
            $('#register-status').html(
                '<div class="alert ' + state + '">' + _msg + '</div>'
            ).fadeIn().delay(5000).fadeOut();
        }

    });

    $("#login-form").on( 'submit', function (e) {
        e.preventDefault();

        var loginForm = $(this);

        $("login-status").html(
            '<div class="alert alert-info">Please wait while you are being Logged-in.</div>'
        );
        loginForm.hide();

        var form            =   {
            action:             "member_user_login",
            username:           $("#login-form-username").val(),
            pass:               $("#login-form-password").val(),
            _wpnonce:           $("#_wpnonce").val()
        };

        $.post( member_obj.ajax_url, form ).always(function (data) {
            if (data.status === 2){
                showMsg(160);
                createDiv('alert-success', data.msg);
                setTimeout( function() {
                    location.href = member_obj.home_url;
                }, 5000);
            } else {
                showMsg(160);
                createDiv('alert-danger', data.msg);
                loginForm.show();
            }
        });

        function showMsg(goto) {
            $('html, body').animate({
                scrollTop: $("#login-status").offset().top-goto
            }, 500);
        }

        function createDiv(state, _msg) {
            $('#login-status').html(
                '<div class="alert ' + state + '">' + _msg + '</div>'
            ).fadeIn().delay(5000).fadeOut();
        }

    });

});