{{-- Call Error component --}}
<x-errors />

{{-- -------------------------- Show Errors ---------- --}}

<div class="form-group">
    <label for="">Category Name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ $category->name }}">
    @error('name')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>
<div class="form-group">
    <label for="">category parent</label>
    <select type="text" name="parent_id" class="form-control form-select">
        <option value="">primary category</option>
        {{-- ------------------------------------------------------
                @foreach ($categories as $categories)
                    <option value="{{ $categories->id }}"
                        @if ($categories->id == $category->parent_id) selected @endif>
                        {{ $categories->name }}</option>
                @endforeach
                ------------------------------------------------------------ --}}
        @foreach ($categories as $categories)
            <option value="{{ $categories->id }}" @selected($category->parent_id == $categories->id)>
                {{ $categories->name }}</option>
        @endforeach
    </select>

</div>
<div class="form-group">
    <label for="">Description</label>
    <textarea type="text" name="description" class="form-control">{{ $category->description }}</textarea>
</div>
<div class="form-group">
    <label for="">image</label>
    <input type="file" name="img" class="form-control" value="">
    @if ($category->image)
        <img src="{{ asset('categories/' . $category->image) }}" alt="">
    @endif
    @error('img')
        <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
<div class="form-group">
    <label for="">Status</label>

    <div class="form-check">
        <input class="form-check-input" type="radio" value="active" name="status"
            @if ($category->status == 'active') checked @endif>
        <label class="form-check-label" for="status">
            active
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" value="inactive" name="status" @checked($category->status == 'inactive')>
        <label class="form-check-label" for="status">
            inactive
        </label>
    </div>
</div>
<div class="form-group">
    <button type="submit" class="btn btn-primary" style="color:black">submit
</div>
