@if ($errors->any())
    <div>
        <h1>Error</h1>
        <ul>
            @foreach ($errors->all() as $error)
                <li class="text-danger">
                    {{ $error }}
                </li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group">

    <x-form.label for="name"> Category Name</x-form.label>

    <x-form.input type="text" name="name" value="{{ $category->name }}" /> {{-- component with variable $type --}}

</div>
<div class="form-group">
    <label for="">parentCategory</label>
    <select name ="parent_id" class="form-control form-select @error('parent_id') is-invalid @enderror">
        <option value="">PrimaryCateogry </option>
        @foreach ($parentCategories as $parentCategory)
            <option value="{{ $parentCategory->id }}" @selected(old('parent_id', $parentCategory->id == $category->parent_id ? $category->parent_id : null))>{{ $parentCategory->name }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <x-form.label id="description"> Description</x-form.label>
    <x-form.textarea name="description" value="{{ $category->description }}" />
</div>


</div>
<div class="form-group">
    <x-form.label id="Image"> Image</x-form.label>
    <x-form.input name="image" type="file" />

    @if ($category->image)
        <img src="{{ asset('storage/' . $category->image) }}" width="100" alt="" height="100"
            class="mt-2">
    @endif
</div>
<div class="form-group">
    <form.label id="status"> Status</form.label>
    <x-form.radio name="status" checked="{{ $category->status }}" :options="['active' => 'active', 'archived' => 'archived']" />

</div>

</div>
<div>
    <button type="submit" class="btn btn-primary">
        @if ($category->exists)
            Update
        @else
            Create
        @endif
    </button>
</div>
