@props(['id' => null, 'type' => 'button', 'class' => ''])
<button type="{{ $type }}" id="{{ $id }}"
    class="btn btn-success">
    {{ $slot }}
</button>
