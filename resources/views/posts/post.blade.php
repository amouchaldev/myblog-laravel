@extends('layouts.app')
@section('content')
    <div class="row">
        {{-- start post --}}
        <div class="col-12 mb-3">
            <img src="{{ Storage::url($post->images[0]->path ?? null) }}" alt="image" class="img-fluid mb-3"> 
            <h1 class="mb-3">{{ $post->title }}</h1>
            <p>{{ $post->body }}</p>
        </div>
        {{-- end post --}}


          {{-- start add comment --}}
          <div class="col-12 mb-3">
            <label for="comment" class="form-label h2 mb-3">Add Comment</label>
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
       </div>
       {{-- end add comment --}}
    </div>
@endsection