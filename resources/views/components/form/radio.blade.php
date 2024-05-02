@props([
    'name',
    'options',
    'checked'=>'false'
    ])


@foreach ($options as $value=>$text)
<div class="form-group">
    <div class="form-check">
        <input class="form-check-input @error ($name) is-invalid @enderror" type="radio" name="{{$name}}" value="{{$value}}" 
        @checked(old($name, $checked) == $value) 
         {{$attributes}}
         >

        <label class="form-check-label" >
            {{$text}}
        </label>    
    </div>

@endforeach