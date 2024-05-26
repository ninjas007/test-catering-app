<script type="text/javascript">
    function login() {
        $('#modalLogin').modal('show');
        $('#modalRegister').modal('hide');

        resetStyleLogin();
    }

    function styleValidLogin() {
        $('#email').addClass('is-valid');
        $('#password').addClass('is-valid');

        $('#email').removeClass('is-invalid');
        $('#password').removeClass('is-invalid');
    }

    function styleInvalidLogin() {
        $('#email').addClass('is-invalid');
        $('#password').addClass('is-invalid');

        $('#email').removeClass('is-valid');
        $('#password').removeClass('is-valid');
    }

    function resetStyleLogin() {
        $('#email').removeClass('is-valid');
        $('#password').removeClass('is-valid');
        $('#email').removeClass('is-invalid');
        $('#password').removeClass('is-invalid');

        $('#error').text('');
        $('#success').text('');
    }

    function resetValueLogin() {
        $('#email').val('');
        $('#email2').val('');
        $('#password').val('');
        $('#password2').val('');

        $('#email').removeClass('is-valid');
        $('#password').removeClass('is-valid');
        $('#email').removeClass('is-invalid');
        $('#password').removeClass('is-invalid');
    }

    // login
    $('#loginForm').submit(function(event) {
        event.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            url: "{{ route('login.user') }}",
            type: "POST",
            dataType: "json",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                email: email,
                password: password
            },
            beforeSend: function() {
                resetStyleLogin();
                $('#btnSignin').addClass('disabled');
            },
            success: function(data, textStatus, xhr) {
                if (xhr.status == 200) {
                    $('#success').text(data.message);
                    $('#btnSignin').removeClass('disabled');

                    styleValidLogin();
                    setTimeout(() => {
                        window.location.href = `{{ route('home') }}`
                    }, 2000);
                } else {
                    styleInvalidLogin();

                    $('#btnSignin').removeClass('disabled');
                    $('#error').text(data.message);
                }
            },
            error: function(xhr) {
                styleInvalidLogin();
                $('#error').text(xhr.responseJSON.message);
                $('#btnSignin').removeClass('disabled');
            }
        });
    });
</script>
