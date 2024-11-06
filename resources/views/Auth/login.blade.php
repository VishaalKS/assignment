@extends('Common.layout')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h1 class="text-center"> Login </h1>
                <form id="login-form">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3 error-email">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3 error-password">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>


    <script>
        $('#login-form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route("api.login") }}',
                method: 'POST',
                data: formData,
                withCredentials : true,
                success: function(response) {
                    window.location.href = '{{ route("product.index") }}';
                },
                error: function(xhr) {
                    if (xhr.status == 422) {
                        var error = xhr.responseJSON.errors;
                        if (error.email) {
                            $('.error-email').html(`
                            <span class="text-danger">` + error.email[0] + `</span>
                            `);
                        } else {
                            $('.error-email').html('');
                        }

                        if (error.password) {
                            $('.error-password').html(`
                            <span class="text-danger">` + error.password[0] + `</span>
                            `);
                        } else {
                            $('.error-password').html('');
                        }
                    }
                }
            });


        });
    </script>
@endsection
