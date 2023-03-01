@extends('backend.datatable-master')
@section('title','Tags')
@section('content')
<div class="container-fluid">
    @include('backend.partials.massage')
    <div class="block-header">
        <a class="btn btn-primary waves-effect" href="{{route('admin.tag.create')}}">
            <i class="material-icons">add</i>
            <span>Add new tag</span>
        </a>
    </div>
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        All Tags
                        <span class="badge bg-blue">{{$tags->count()}}</span>
                    </h2>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Name</th>
                                    <th>Post Count</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Name</th>
                                    <th>Post Count</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($tags as $tag)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$tag->name}}</td>
                                    <td>{{$tag->post->count()}}</td>
                                    <td >
                                        <a href="{{route('admin.tag.edit',$tag->id)}}" class="btn btn-primary">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <button class="btn btn-danger" type="submit" onclick="deleteFrom()">
                                            <i class="material-icons" >delete</i>
                                        </button>
                                        <form action="{{ route('admin.tag.destroy',$tag->id)}}" method="POST" class="delete-from" id="delete">
                                            @csrf
                                            @method('DELETE')
                                        </form>

                                        {{-- return confirm('Are u sure delete this brand'); --}}
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