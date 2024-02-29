@props(['id' => null, 'type' => 'button'])
<button type="{{ $type }}" id="{{ $id }}"
    class="focus:outline-none text-white bg-gray-800 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2">
    {{ $slot }}
</button>
