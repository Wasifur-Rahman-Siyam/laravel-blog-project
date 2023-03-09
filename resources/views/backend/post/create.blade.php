@extends('backend.datatable-master')
@section('title','Add new Post')
@section('content')
<div class="container-fluid">
    <!-- Vertical Layout | With Floating Label -->
    <form action="{{route('admin.post.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('backend.partials.massage')
        <div class="row clearfix">
            <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Add New Post
                        </h2>
                    </div>
                    <div class="body">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}">
                                    <label class="form-label">Post Title</label>
                                </div>
                            </div>
                            @error("title")
                            <div>
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                            @enderror
                            <div class="form-group">
                                <label for="image">Featured Image</label>
                                <input type="file" id="image" name="image">
                            </div><br>
                            @error("image")
                            <div>
                                <span class="text-danger">{{ $message }}</span>
                            </div>
                            @enderror
                            <div class="form-group">
                                <input type="checkbox" id="publish" name="status" value="1">
                                <label for="publish">Publish</label>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Categories and Tags 
                        </h2>
                    </div>
                    <div class="body">
                        <div class="form-group">
                            <label for="category">Select Category : </label><br>
                            <select class="form-select" aria-label="Default select example" name="categories[]" id="category">
                                <option></option>
                                @foreach ( $categories as $category)
                                    <option value="{{$category->id}}">{{ $category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error("categories")
                        <div>
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror

                        <div class="form-group">
                            <label for="category">Select Tag : </label><br>
                            <select class="form-select" aria-label="Default select example" name="tags[]" id="category">
                                <option></option>
                                @foreach ( $tags as $tag)
                                    <option value="{{$tag->id}}">{{ $tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error("tags")
                        <div>
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                        @enderror
                            <a href="{{route('admin.post.index')}}" class="btn btn-danger m-t-15 waves-effect">BACK</a>
                            <button type="submit" class="btn btn-primary m-t-15 waves-effect">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Body
                        </h2>
                    </div>
                    <div class="body">
                        <textarea id="post-body" name="body">
                        </textarea>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- Vertical Layout | With Floating Label -->
</div>
@endsection