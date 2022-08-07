@csrf
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
    @error('email') <p class="text-warning">{{ $message }}</p> @enderror
</div>
<div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
    @error('password') <p class="text-warning">{{ $message }}</p> @enderror
</div>
@if (session()->has('fail'))
    <p class="text-danger">{{ session()->get('fail') }}</p>
@endif