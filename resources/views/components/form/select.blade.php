@props(['results', 'field', 'defaultValue' => 0, 'foreignField' => ''])

<select id="{{ $field }}" name="{{ $field }}" class="border border-gray-200 p-2 rounded">
    <option value="0">Select</option>
    @foreach($results as $result)
        <option value="{{ $result->id }}" {{ (empty($defaultValue) ? old($field) : old($field, $defaultValue)) == $result->id ? 'selected' : '' }}>
            {{ ucwords($result->name) }}
            @if(!empty($foreignField))
                ({{ ucwords($result->$foreignField->name) }})
            @endif
        </option>
    @endforeach
</select>
