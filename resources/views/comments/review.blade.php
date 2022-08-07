@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-12">
            @forelse($comments as $comment)
            <div class="row alert alert-light mb-3">
                <div class="col-10">{{ $comment->content }}</div>
                <div class="col-2 d-flex justify-content-center">
                    <button class="btn btn-sm btn-success px-3 me-1"><i class="fa-solid fa-check"></i></button>
                    <button class="btn btn-sm btn-danger px-3"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
            @empty 
            @endforelse

        </div>
    </div>
@endsection