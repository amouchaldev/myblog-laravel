@extends('layouts.app')
@section('content')
    <div class="row mt-3">
        <div class="col-6 mx-auto">
            <form action="{{ route('loginHandle') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                @if (session()->has('fail'))
                    <p class="text-danger">{{ session()->get('fail') }}</p>
                @endif
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection