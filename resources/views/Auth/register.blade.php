@extends('Common.layout')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h1 class="text-center"> Register </h1>
                <form id="register-form">
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName">
                    </div>
                    <div class="mb-3 error-name">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1">
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
        $('#register-form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route('api.register') }}',
                method: 'POST',
                data: formData,
                success: function(response) {
                    window.location.href = '{{ route('auth.showLogin') }}';
                },
                error: function(xhr) {
                    if (xhr.status == 422) {
                        var error = xhr.responseJSON.errors;
                        if (error.name) {
                            $('.error-name').html(`
                            <span class="text-danger">` + error.name[0] + `</span>
                            `);
                        } else {
                            $('.error-name').html('');
                        }

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
