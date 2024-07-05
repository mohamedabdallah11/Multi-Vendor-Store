{{--  @props([
    'name',
    'options',
    'selected'=>'false'
    
])
<select>
    name="{{ $name }}"
    {{ $attributes->class(
        [
            'form-control',
            'form-select',
            'is-invalid' => $errors->has($name)
        ]
    ) }}
    @foreach($options as $value => $text) 
        <option
            value="{{$value}}" @selected($value==$selected )>{{ $text }}</option>
    @endforeach

</select>
  --}}
  @props([
    'name',
    'options',
    'selected' => ''
])

<select name="{{ $name }}" {{ $attributes->class(['form-control', 'form-select', 'is-invalid' => $errors->has($name)]) }}>
    @foreach($options as $value => $text)
        <option value="{{ $value }}" @if($value == $selected) selected @endif>{{ $text }}</option>
    @endforeach
</select>

{{-- 
@props(['name', 'options', 'options'])

<select {{ $attributes->merge(['class' => 'form-control']) }} name="{{ $name }}">
    @foreach ($options as $value => $val)
        <option value="{{ $value }}">{{ $val }}</option>
    @endforeach
</select> --}}

<x-form.validation-feedback :name="$name" />