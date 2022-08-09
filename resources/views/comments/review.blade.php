@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row py-5">
        {{--  start comments --}}
        <div class="col-12">
            @forelse($comments as $comment)
            <div class="row alert alert-info mb-3">
                <div class="col-10">
                    <p class="mb-2">{{ $comment->content }} </p>
                    <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                </div>
                <div class="col-2 d-flex justify-content-center align-items-center">
                    {{-- update --}}
                    <form action="{{ route('comments.publish', $comment->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button class="btn btn-sm btn-success px-3 me-1" title="publish"><i class="fa-solid fa-check"></i></button>
                    {{-- destroy --}}
                    </form>
                    <form action="{{ route('comment.destroy', $comment->id) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-sm btn-danger px-3" title="delete"><i class="fa-solid fa-xmark"></i></button>
                    </form>
                </div>
            </div>
            @empty 
                <p class="alert alert-secondary">No Comment Yet</p>
            @endforelse
        </div>
        {{-- end comments --}}
    </div>
</div>
@endsection