@extends('backend.dashboard-master')
@section('title','Add category')
@section('content')
<div class="container-fluid">
    <!-- Vertical Layout | With Floating Label -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        Add New Category
                    </h2>
                </div>
                <div class="body">
                    @include('backend.partials.massage')
                    <form action="{{route('admin.category.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-5">
                            <label for="name" class="form-label">Category Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                        </div>
                        @error("name")
                        <div>
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                        <div class="mb-3">
                            <label for="formFile" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image" value="{{old('image')}}">
                          </div>
                        @error("image")
                        <div>
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                        <a href="{{route('admin.category.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Vertical Layout | With Floating Label -->
</div>
@endsection