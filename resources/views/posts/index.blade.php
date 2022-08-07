@extends('layouts.app')
@section('style')
    .img-container {
        height: 209px;
    }
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="row">
                @forelse($posts as $post)
                <div class="col-4 mb-3">
                    <a class="text-start card text-decoration-none" href="{{ route('post', $post->id) }}">
                        <div class="img-container">
                            <img class="card-img-top w-100 h-100" src="{{ Storage::url($post->images[0]->path ?? null) }}" alt="Title" >
                        </div>
                      <div class="card-body">
                        <h4 class="card-title">{{ $post->title }}</h4>
                            @if ($post->comments_count == 1)
                            <p class="card-text badge bg-info">{{ $post->comments_count }} comment</p>
                            @elseif($post->comments_count > 1)
                            <p class="card-text badge bg-info">{{ $post->comments_count }} comments</p>
                            @else
                            <p class="card-text badge bg-light text-primary">No Comment Yet</p>
                            @endif
                        @if(session()->has('loginEmail'))
                        @endif
                    </div>
                </a>
                <div>
                    <a class="btn btn-secondary btn-sm mt-2 px-3" href="{{ route('post.edit', $post->id) }}"><i class="fa-solid fa-pen-to-square"></i></a>
                    <form action="{{ route('post.destroy', $post->id) }}" class="d-inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm mt-2 px-3"><i class="fa-solid fa-xmark"></i></button>
                    </form>
                </div>
                </div>
                @empty
                    
                @endforelse
            </div>
        </div>
        {{-- <div class="col-4">
            <img src="{{ Storage::url('posts/ads.png') }}" alt="ads" class="img-fluid">
        </div> --}}
    </div>  
@endsection