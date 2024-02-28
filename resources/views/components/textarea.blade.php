@props(['id', 'label', 'name', 'required' => false, 'value' => ''])

<div>
    <label for="{{ $id }}" class="block mb-2 text-sm font-medium text-gray-900">
        {{ $label }} {!! $required ? '<span class="text-red-500">*</span>' : '' !!}
    </label>
    <textarea id="{{ $id }}" rows="4" name="{{ $name }}" {{ $required ? 'required' : '' }}
        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border focus:ring-1 border-slate-200 focus:ring-blue-500 focus:border-blue-500 transition duration-200 ">{{ $value }}</textarea>
</div>
