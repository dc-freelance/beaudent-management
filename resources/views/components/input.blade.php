@props([
    'label' => '',
    'name' => '',
    'required' => false,
    'tip' => '',
    'id' => '',
    'type' => 'text',
    'value' => '',
    'format' => '',
    'readonly' => '',
])
<div>
    <label for="first_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="{{ $id }}">
        {{ $label }} {!! $required ? '<span class="text-red-600">*</span>' : '' !!}
    </label>
    <input type="{{ $type }}" id="{{ $id }}" data-format="{{ $format }}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-primary focus:border-primary block w-full p-2.5"
        name="{{ $name }}" value="{{ $value }}" required="{{ $required }}" {{ $readonly }} />
    @if ($tip)
        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">{{ $tip }}</p>
    @endif
    @error($name)
        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>
