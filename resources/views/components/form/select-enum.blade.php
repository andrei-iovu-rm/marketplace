@props(['results', 'field', 'defaultValue' => 0])

<select id="{{ $field }}" name="{{ $field }}" class="select select-bordered select-md w-full max-w-xs text-sm text-gray-500 font-medium" {{ $attributes([]) }}>
    <option value="0">Select</option>
    @foreach($results as $result)
        <option value="{{ $result->value }}" {{ (empty($defaultValue) ? old($field) : old($field, $defaultValue)) == $result->value ? 'selected' : '' }}>
            {{ ucwords(strtolower($result->name)) }}
        </option>
    @endforeach
</select>
