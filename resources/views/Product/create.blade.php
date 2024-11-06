@extends('Common.layout')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-6">
                <h1 class="text-center"> Product List </h1>
                <form id="product-form">
                    @csrf
                    <div class="mb-3">
                        <label for="exampleInputName" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="exampleInputName">
                    </div>
                    <div class="mb-3 error-name">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Price</label>
                        <input type="number" name="price" class="form-control" id="exampleInputEmail1">
                    </div>
                    <div class="mb-3 error-price">
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control" id="exampleInputPassword1">
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#product-form').on('submit', function(e) {
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url: '{{ route('product.store') }}',
                method: 'POST',
                eaders: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                success: function(response) {
                    window.location.href = '{{ route('product.index') }}';
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

                        if (error.price) {
                            $('.error-price').html(`
                            <span class="text-danger">` + error.price[0] + `</span>
                            `);
                        } else {
                            $('.error-price').html('');
                        }

                    }
                }
            });


        });
    </script>
@endsection
