@extends('backend.datatable-master')
@section('title','Edit Profile')
@section('content')
<div class="container-fluid">
    <!-- Vertical Layout | With Floating Label -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                @include('backend.partials.massage')
                <div class="header">
                    <h2>
                        TABS WITH ICON TITLE
                    </h2>
                </div>
                <div class="body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="">
                            <a href="#profile_with_icon_title" data-toggle="tab" aria-expanded="false">
                                <i class="material-icons">face</i> UPDATE PROFILE
                            </a>
                        </li>
                        <li role="presentation" class="">
                            <a href="#password_with_icon_title" data-toggle="tab" aria-expanded="false">
                                <i class="material-icons">password</i>CHANGE PASSWORD
                            </a>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                            <form class="form-horizontal" action="{{route('user.profile.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name">Name:</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="name" class="form-control" placeholder="Enter your name" name="name" value="{{Auth::user()->name}}">
                                            </div>
                                        </div>
                                        @error("name")
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email">Email Address</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="email" class="form-control" placeholder="Enter your email address" name="email" value="{{Auth::user()->email}}">
                                            </div>
                                        </div>
                                        @error("email")
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email">Profile Image</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div>
                                                <input type="file" id="image" class="form-control" name="image">
                                            </div>
                                        </div>
                                        @error("image")
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="password_with_icon_title">
                            <form class="form-horizontal" action="{{route('user.password.update')}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="old_password">Old Password:</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="old_password" class="form-control" name="old_password">
                                            </div>
                                        </div>
                                        @error("old_password")
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password">New Password:</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="password" class="form-control"  name="password">
                                            </div>
                                        </div>
                                        @error("password")
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password_confirmation">Confirm Password:</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="password_confirmation" class="form-control"  name="password_confirmation">
                                            </div>
                                        </div>
                                        @error("password_confirmation")
                                        <div>
                                            <span class="text-danger">{{ $message }}</span>
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">UPDATE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vertical Layout | With Floating Label -->
</div>
@endsection