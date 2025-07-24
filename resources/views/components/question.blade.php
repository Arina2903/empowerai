@props(['label', 'name'])

<div class="mb-4">
    <label class="block font-medium mb-1">{{ $label }}</label>
    <select name="{{ $name }}" required class="w-full border rounded px-3 py-2">
        <option value="5">Strongly Agree</option>
        <option value="4">Agree</option>
        <option value="3">Neutral</option>
        <option value="2">Disagree</option>
        <option value="1">Strongly Disagree</option>
    </select>
</div>
