@extends('Common.layout')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center"> {{ $product->name }}</h1>
                <div class="card" style="width: 18rem;">
                    <img src="{{ $product->image }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <p class="card-text">{{ $product->description ?? 'N/A' }}</p>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $product->price }}</p>
                    </div>
                    <div class="card-body">
                        <button class="btn btn-primary" onclick="addToCart({{$product->id}})">Add to Cart</button>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        function addToCart(id) {
            $.ajax({
                url: '{{ route('product.addToCart') }}',
                method: 'GET',
                success: function(response) {
                    window.location.href = '/product/'+id;
                },
                error: function(xhr) {}
            });
        }
    </script>
@endsection
