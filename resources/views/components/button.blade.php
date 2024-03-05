@props(['id' => null, 'type' => 'button'])
<button type="{{ $type }}" id="{{ $id }}"
    class="btn btn-success">
    {{ $slot }}
</button>
