@extends('backend.datatable-master')
@section('title','Users')
@section('content')
<div class="container-fluid">
    @include('backend.partials.massage')
    <!-- Exportable Table -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2>
                        All Users:
                        <span class="badge bg-blue">{{$users->count()}}</span>
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
                                    <th>Make Admin</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sl No.</th>
                                    <th>Name</th>
                                    <th>Post Count</th>
                                    <th>Make Admin</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{$loop->iteration}}</td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->posts_count}}</td>
                                    <td>
                                        <form action="{{ route('admin.users.reassign', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to make this user an admin?')" >Reassign Admin</button>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger" type="submit" onclick="deleteFrom()">
                                            <i class="material-icons" >delete</i>
                                        </button>
                                        <form action="{{ route('admin.user.destroy',$user->id)}}" method="POST" class="delete-from" id="delete">
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