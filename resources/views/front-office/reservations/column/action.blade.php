<div class="lg:flex gap-x-2">
    @if ($data->status === 'Done' )
        <a href="{{ route('front-office.reservations.confirm.reschedule', $data->id) }}"
            class="text-white bg-orange-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
            <i class="fas fa-sync fa-sm"></i>
        </a>
        <a href="{{ route('front-office.reservations.confirm.detail', $data->id) }}"
            class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
            <i class="fas fa-eye fa-sm"></i>
        </a>
    @elseif ($data->status === 'Cancel')
        <a href="{{ route('front-office.reservations.cancel.detail', $data->id) }}"
            class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
            <i class="fas fa-eye fa-sm"></i>
        </a>
    @else
        <a href="{{ route('front-office.reservations.wait.detail', $data->id) }}"
            class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
            <i class="fas fa-eye fa-sm"></i>
        </a>
    @endif

    
    <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center cursor-pointer">
        <i class="fas fa-trash fa-sm"></i>
    </label>
</div>
