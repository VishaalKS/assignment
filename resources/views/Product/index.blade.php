@extends('Common.layout')


@section('content')
    <div class="container">
        <div class="row mt-4 justify-content-end">
            <div class="col-auto">
                <a href="{{route('product.create')}}" class="btn btn-primary">Create Product</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-12">
                <h1 class="text-center"> Product List </h1>
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Description</th>
                            <th scope="col">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->description ?? 'N/A' }}</td>
                                <td><a href="{{ route('product.show', $product->id) }}" class="btn btn-primary">View</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#myTable').DataTable();
        });
    </script>
@endsection
