
<div class="form-group">

    <x-form.label for="name"> Product Name</x-form.label>

    <x-form.input type="text" name="name" value="{{$product->name }}" /> {{-- component with variable $type --}}

</div>
{{-- <div class="form-group">
    <label for="">Category</label>
    <select name="parent_id" class="form-control form-select">
        <option value="">Primary Category</option>
        @foreach (App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" @selected(old('parent_id', $product->parent_id) == $category->id)>{{ $category->name }}</option>
        @endforeach
    </select>
</div>
 --}}
 <div class="form-group">
    <label for="">Category</label>
    <select name ="category_id" class="form-control form-select">
        <option value="">PrimaryCateogry </option>
        @foreach (App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id == $category->id ? $product->category_id : null))>{{ $category->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <x-form.label id="description"> Description</x-form.label>
    <x-form.textarea name="description" value="{{ $product->description }}" />
</div>


</div>
<div class="form-group">
    <x-form.label id="image"> image</x-form.label>
    <x-form.input name="image" type="file" />

    @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" width="100" alt="" height="100"
            class="mt-2">
    @endif  

</div>
<div class="form-group">
    <x-form.label for="compare_price"> compare_price</x-form.label>
    <x-form.input  name="compare_price" value="{{ $product->compare_price }}" />
        
</div>
<div class="form-group">
<x-form.label for="tags"> Tags</x-form.label>
<x-form.input  name="tags" value="{{$tags}}" />
</div>
<div class="form-group">
    <x-form.label for="name"> Price</x-form.label>
    <x-form.input  name="price" value="{{ $product->price }}" />

</div>
<div class="form-group">
    <form.label id="status"> Status</form.label>
    <x-form.radio name="status" checked="{{ $product->status }}" :options="['active' => 'active','draft' => 'draft','archived' => 'archived']" />

</div>

</div>
<div>
    <button type="submit" class="btn btn-primary">
        @if ($product->exists)
            Update
        @else
            Create
        @endif
    </button>
</div>
