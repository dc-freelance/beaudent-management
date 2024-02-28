@props(['header' => '', 'id' => '', 'padding' => true])

<div class="py-2" id="{{ $id }}">
    <div class="mx-auto">
        <div class="bg-white border border-gray-100 shadow-sm overflow-hidden rounded-2xl px-4">
            <div class="{{ $padding == true ? 'p-4' : '' }}">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
