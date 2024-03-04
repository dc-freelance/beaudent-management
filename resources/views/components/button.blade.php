@props(['id' => null, 'type' => 'button'])
<button type="{{ $type }}" id="{{ $id }}"
    class="btn-filled btn-success">
    {{ $slot }}
</button>
