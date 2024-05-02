@props([
    'type'=>"text",
    'name',
    'value'=>""
])

<input type="{{$type}}"
    name="{{$name}}"
    class="form-control @error ($name) is-invalid @enderror"
    value= "{{ old($name,$value)}}"  
    {{$attributes}}> 
