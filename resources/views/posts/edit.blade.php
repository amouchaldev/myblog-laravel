@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-8 mx-auto">
            @if(session()->has('success'))
                <p class="alert alert-success">{{ session()->get('success') }}</p>
            @endif
            <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @include('posts.form')
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">Update Post</button>
                </div>
            </form>
        </div>
    </div>  
@endsection