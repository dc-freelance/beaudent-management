@can('pay_queue_transaction')
    <div class="lg:flex gap-x-2">
        <a href="{{ route('front-office.transaction.payment', $data->id) }}"
            class="text-white bg-orange-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
            Bayar
        </a>
    </div>
@endcan
