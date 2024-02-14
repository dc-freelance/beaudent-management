<div class="flex gap-4 flex-wrap">
    @foreach ($permissions as $item)
        <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">
            {{ $item->name }}
        </span>
    @endforeach
</div>
