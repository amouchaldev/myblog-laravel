@extends('layouts.app')
@section('content')
    <div class="row mt-3 py-5">
        <div class="col-6 mx-auto">
            <form action="{{ route('loginHandle') }}" method="POST">
                @include('auth.form')
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection