@can('pay_antiran_pembayaran')
    <div class="lg:flex gap-x-2">
        <a href="{{ route('front-office.transaction.payment', $data->id) }}"
            class="btn btn-success">
            Bayar
        </a>
    </div>
@endcan
