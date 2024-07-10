@extends('pages.master_layout')
@section('content')
    <div class="d-flex justify-content-center">
        <form action="{{route('addStudent')}}" method="post" class="w-50 mt-3 p-3 border" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">User name</label>
                <input type="text" class="form-control" id="name" aria-describedby="nameHelp" name="name">
                @error('image')
                    <div class="alert alert-danger mb-1 mt-1">image not found</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" aria-describedby="ageHelp" name="age">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" aria-describedby="addressHelp" name="address">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Images</label>
                <input type="file" class="form-control" id="image" aria-describedby="imageHelp" name="image" accept=".jpg,.png,.jpeg">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection