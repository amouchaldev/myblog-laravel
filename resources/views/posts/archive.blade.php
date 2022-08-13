@extends('layouts.app')
@section('content')
<section class="container">
    <section class="row">
        {{-- latest posts --}}
        <article class="col-lg-12">
            <div class="row">
                <h2 class="last-posts position-relative mb-4 text-capitalize last-posts h4  my-3">Archive</h2>
                @forelse($posts as $post)
                <div class="col-sm-6 col-md-4 mb-4">
                    <a class="text-start card text-decoration-none" href="{{ route('post', $post->id) }}">
                        <div class="img-container">
                            <img class="card-img-top w-100 h-100" src="
                            @if(substr($post->images[0]->path, 0, 5) === 'http:' || substr($post->images[0]->path, 0, 6) === 'https:')
                            {{ $post->images[0]->path ?? null }}
                            @else
                            {{ Storage::url($post->images[0]->path ?? null) }}
                            @endif
                            " alt="Title" >
                        </div>
                      <div class="card-body">
                        <h4 class="card-title post-title">{{ $post->title }}</h4>
                            <span class="card-text badge bg-light text-primary">{{ $post->created_at->diffForHumans() }}</span>
                            @if ($post->comments_count == 1)
                            <span class="card-text badge bg-light text-primary">{{ $post->comments_count }} comment</span>
                            @elseif($post->comments_count > 1)
                            <span class="card-text badge bg-light text-primary">{{ $post->comments_count }} comments</span>
                            @else
                            <span class="card-text badge bg-light text-primary">No Comment Yet</span>
                            @endif
                        </div>
                </a>
                @if(in_array(session()->get('loginRole'), ['admin', 'owner']) && session()->get('loginEmail'))
                    <div class="mt-2">
                        {{-- EDIT --}}
                        <a class="btn btn-secondary btn-sm px-3" href="{{ route('post.edit', $post->id) }}" title="edit"><i class="fa-solid fa-pen-to-square"></i></a>
                        {{-- RESTORE --}}
                        <form action="{{ route('post.restore', $post->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success btn-sm  px-3" type="submit" title="restore"><i class="fa-solid fa-rotate-left"></i></button>
                        </form>
                    
                        {{-- FORCE DELETE --}}
                        @if(session()->get('loginRole') === 'owner')
                        <form action="{{ route('post.forcedelete', $post->id) }}" class="d-inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm px-3" title="force delete"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                        @endif
                    </div>
                @endif
                </div>
                @empty
                    <p>No Post Yet</p> 
                @endforelse
            </div>
        </article>

    </section>  
</section>
@endsection