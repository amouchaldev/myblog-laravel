@extends('layouts.app')
@section('style')
    section > header {
        height: 556px;
    }
    .post-title {
        z-index: 5;
    }
    .overlay {
        z-index: 1;
        opacity: .7;
    }
@endsection
@section('content')
<section>
{{-- start header --}}
    <header class="position-relative mb-3">
        <div class="overlay position-absolute w-100 h-100 start-0 top-0 bg-dark"></div>
        <img src="{{ Storage::url($post->images[0]->path ?? null) }}" alt="image" class="position-absolute top-0 start-0 mb-3 post-image h-100 w-100"> 
        <h1 class="mb-3 post-title position-absolute text-center top-50 w-100 display-4 text-light">{{ $post->title }}</h1>
    </header>
{{-- end header --}}

<article class="container">
    <div class="row">

        {{-- start post --}}
            <section class="col-12 mb-3">
                <p class="lh-lg">{{ $post->body }}</p>
            </section>
        {{-- end post --}}

            {{-- start comments --}}
            <section class="col-12 mb-3 bg-primary py-3 rounded">
                <h2 class="mb-3 text-light">Comment(s)</h2>
                @forelse($post->comments as $comment)
                <div>
                    @if(in_array(session()->get('loginRole'), ['admin', 'owner']))
                        <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                            @method('DELETE')
                            @csrf
                            <button class="btn btn-sm btn-danger px-3" title="delete"><i class="fa-solid fa-xmark"></i></button>
                        </form>
                    @endif
                    <div class="mb-3 alert alert-light">
                        <span class="badge bg-primary mb-2">{{ $comment->fullName }}</span>
                        <p>{{ $comment->content }}</p>
                        <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                    </div>
                </div>
                @empty 
                    <div class="mb-3 alert alert-light">
                        <p>No Comment Yet</p>
                    </div>
                @endforelse
            </section>
            {{-- end comments --}}
    
              {{-- start add comment --}}
            <section class="col-12 mb-3">
                    <h2 class="mb-3">Add Comment</h2>
                    @if(session()->has('success')) <p class="alert alert-success">{{ session()->get('success') }}</p> @endif
                <form action="{{ route('comment.add', $post->id) }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Full name" value="{{ old('fullName') }}">
                            @error('fullName') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div class="mb-3">
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                            @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <textarea name="comment" id="comment" cols="30" rows="4" class="form-control mb-3" placeholder="Comment">{{ old('comment') }}</textarea>
                            @error('comment') <p class="text-danger">{{ $message }}</p> @enderror
                        </div>
                        <button class="btn btn-primary " type="submit">ADD</button>
                </form>
            </section>
           {{-- end add comment --}}
        
        </div>
    </article>                                                      
</section>

@endsection