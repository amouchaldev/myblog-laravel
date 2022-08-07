@extends('layouts.app')
@section('content')
         <img src="{{ Storage::url($post->images[0]->path ?? null) }}" alt="image" class="img-fluid mb-3"> 
         <h1 class="mb-3">{{ $post->title }}</h1>
         <p>{{ $post->body }}</p>
@endsection