@props(['field'])

@if (request($field))
    <input type="hidden" name="{{ $field }}" value="{{ request($field) }}">
@endif
