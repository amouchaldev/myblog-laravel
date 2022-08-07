<div class="mb-3">
    <label for="title" class="form-label">title</label>
    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $post->title ?? null) }}">
    @error('title') <p class="text-danger">{{ $message }}</p> @enderror
</div>
<div class="mb-3">
    <label for="body" class="form-label">body</label>
    <textarea name="body" id="body" cols="30" rows="10" class="form-control">{{ old('body', $post->body ?? null) }}</textarea>
    @error('body') <p class="text-danger">{{ $message }}</p> @enderror
</div>
<div class="mb-3">
    <label for="image" class="form-label">image</label>
    <input type="file" class="form-control" id="image" name="image">
    @error('image') <p class="text-danger">{{ $message }}</p> @enderror
</div>
