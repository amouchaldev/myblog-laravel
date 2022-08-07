@extends('layouts.app')
@section('content')
    <div class="row">
        {{--  start comments --}}
        <div class="col-12">
            @forelse($comments as $comment)
            <div class="row alert alert-light mb-3">
                <div class="col-10">{{ $comment->content }}</div>
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
            @endforelse
        </div>
        {{-- end comments --}}
    </div>
@endsection