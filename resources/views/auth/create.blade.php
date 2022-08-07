@extends('layouts.app')
@section('content')
    <div class="row mt-3">
        <div class="col-6 mx-auto">
            <h2>ADD NEW USER</h2>
            <form action="{{ route('users.store') }}" method="POST">
                <div class="mb-3">
                    <label for="firstName" class="form-label">first name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName">
                    @error('firstName') <p class="text-warning">{{ $message }}</p> @enderror
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">last name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName">
                    @error('lastName') <p class="text-warning">{{ $message }}</p> @enderror
                </div>
                @include('auth.form')
                <div class="mb-3">
                    <label for="role" class="form-label">role</label>                
                    <select class="form-select"  id="role" name="role">
                        <option value="owner">Owner</option>
                        <option value="admin">admin</option>
                        <option value="publisher">publisher</option>
                    </select>
                </div>
                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">ADD NEW USER</button>
                </div>
            </form>
        </div>
    </div>
@endsection