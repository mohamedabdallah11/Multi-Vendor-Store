@props([
    'name',
    'value',
])

<textarea 
    name ="{{$name}}"
    class="form-control @error ($name) is-invalid @enderror"
    {{$attributes}}
    
    >{{ old($name, $value)}}</textarea>
