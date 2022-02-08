@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col d-flex flex-column justify-content-center align-items-center mt-5">
            <h1>Upload your image</h1>
            <form class="d-hidden" method="post" action="/upload-file" enctype="multipart/form-data">
                @csrf
                <input type="file" class="btn btn-secondary" id="avatar" name="avatar">
                <input type="submit" class="btn btn-secondary">
            </form>
            @error('avatar')
            <p class="text-sm text-danger">{{$message}}</p>
            @enderror
        </div>
    </div>

    @endsection