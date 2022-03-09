@props(['results', 'field', 'defaultValue' => 0, 'foreignField' => '', 'label' => 'Select', 'search' => false])

@php
    $class = 'select select-bordered w-full max-w-xs text-sm text-gray-500 font-medium';
    if($search){
        $class.= ' select-sm';
    } else {
        $class.= ' select-md';
    }
@endphp

@if($search)
    <div class="indicator">
@endif

<select id="{{ $field }}" name="{{ $field }}" class="{{ $class }}" {{ $attributes([]) }}>
    <option value="{{ $search ? '' : 0 }}">{{ $label }}</option>
    @foreach($results as $result)
        @if($search)
            <option value="{{ $result->slug }}" {{ (empty($defaultValue) ? old($field) : old($field, $defaultValue)) == $result->slug ? 'selected' : '' }}>
        @else
            <option value="{{ $result->id }}" {{ (empty($defaultValue) ? old($field) : old($field, $defaultValue)) == $result->id ? 'selected' : '' }}>
        @endif
            {{ ucwords($result->name) }}
            @if(!empty($foreignField))
                ({{ ucwords($result->$foreignField->name) }})
            @endif
        </option>
    @endforeach
</select>

@if($search)
    </div>
@endif
