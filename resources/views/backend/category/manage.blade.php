@extends('backend.backend-master')

@section('title' , 'Manage category')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="text-center mt-4">All category</h1>
                <h4><span>{{ Session::get('msg') }}</span></h4>
                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>Sl:</th>
                                <th>Category name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$category->name}}</td>
                                <td>
                                    <a href="{{route('category-edit', ['cat_id' => $category->id])}}" class="btn btn-primary">Edit</a>
                                    <a href="{{route('category-delete', ['cat_id' => $category->id])}}" class="btn btn-danger" onclick="return confirm('Are u sure delete this category');">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection