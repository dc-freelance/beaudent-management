<div class="lg:flex gap-x-2">
    @if ($data->status === 'Confirm')
        <a href="{{ route('front-office.deposit.confirm.detail', $data->id) }}"
            class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
            <i class="fas fa-eye fa-sm"></i>
        </a>
    @elseif ($data->status === 'Decline')
        <a href="{{ route('front-office.deposit.cancel.detail', $data->id) }}"
            class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
            <i class="fas fa-eye fa-sm"></i>
        </a>
    @else
        <a href="{{ route('front-office.deposit.wait.detail', $data->id) }}"
            class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
            <i class="fas fa-eye fa-sm"></i>
        </a>
    @endif
</div>
