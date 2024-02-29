@props(['id' => null, 'type' => 'button'])
<button type="{{ $type }}" id="{{ $id }}"
    class="focus:outline-none w-full text-white bg-green-400 hover:bg-opacity-80 focus:ring-4 focus:ring-green-300 transition duration-300 ease-in-out font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">
    {{ $slot }}
</button>
