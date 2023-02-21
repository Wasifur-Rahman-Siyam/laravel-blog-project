@extends('backend.backend-master')
@section('title','Add category')
@section('content')
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                {{-- <span>{{ Session::get('msg') }}</span> --}}
                <h1>Category Add </h1>
                <script>
                    var msg = '{{Session::get('msg')}}';
                    var exist = '{{Session::has('msg')}}';
                    if(exist){
                    alert(msg); 
                    '{{Session::forget('msg')}}'
                    }
                </script>
                <form action="{{route('category-store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                      <label for="name" class="form-label">Add Category</label>
                      <input type="text" class="form-control" id="name" name="name">
                    </div>
                    @error("name")
                        <div>
                            <span class="text-danger">{{ $message }}</span>
                        </div>
                    @enderror
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
            </div>
        </div>
    </div>
@endsection