@extends('backend.datatable-master')
@section('title','Post')
@section('content')
<div class="container-fluid">
    @include('backend.partials.massage')
    <div class="block-header">
        <a class="btn btn-primary waves-effect" href="{{route('admin.post.create')}}">
            <i class="material-icons">add</i>
            <span>Add new Post</span>
        </a>
    </div>
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        All Posts
                        <span class="badge bg-blue">{{$posts->count()}}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>
                                        <i class="material-icons" >visibility</i>
                                    </th>
                                    <th>Is Approved</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>
                                        <i class="material-icons" >visibility</i>
                                    </th>
                                    <th>Is Approved</th>
                                    <th>Is Active</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($posts as $post)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{Str::limit($post->title,10)}}</td>
                                    <td>{{$post->user->name}}</td>
                                    <td>{{$post->view_count}}</td>
                                    <td>
                                        @if ($post->is_approved == true)
                                            <span class="badge bg-blue">Approved</span>
                                        @else
                                            <span class="badge bg-yellow">Painding</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($post->status == true)
                                            <span class="badge bg-blue">Active</span>
                                        @else
                                            <span class="badge bg-yellow">Inactive</span>
                                        @endif
                                    </td>
                                    <td >
                                        <a href="{{route('admin.post.edit',$post->id)}}" class="btn btn-primary">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button class="btn btn-danger" type="submit" onclick="deleteFrom()">
                                            <i class="material-icons" >delete</i>
                                        </button>
                                        <form action="{{ route('admin.post.destroy',$post->id)}}" method="POST" class="delete-from" id="delete">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Exportable Table -->
</div>
@endsection