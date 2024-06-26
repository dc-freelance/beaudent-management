<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Pembayaran', 'url' => route('front-office.transaction.list-billing')],
        ['name' => 'Form Pembayaran', 'url' => ''],
    ]" title="Form Pembayaran" />
    
    <div class="grid grid-cols-2 gap-5">
        <div>
            <x-card-container>
                <div class="pb-2">
                    <p class="font-semibold text-lg">Detail Pemeriksaan (Treatment)</p>
                </div>
                <div class="pt-3">
                    <div class="relative overflow-x-auto" style="height: 300px;">
                        <table class="text-left w-full">
                            <thead class="bg-primary text-white">
                                <tr class="w-full">
                                    <th class="p-4">Nama Treatment</th>
                                    <th class="p-4">Qty</th>
                                    <th class="p-4">Harga</th>
                                    <th class="p-4">Jenis Diskon</th>
                                    <th class="p-4">Sub Total</th>
                                    <th class="p-4">Diskon</th>
                                    <th class="p-4">Harga Setelah Diskon</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-100">
                                @php
                                    $totalDiscountTreatment = 0;
                                    $totalAfterDiscountTreatment = 0;
                                @endphp
                                @foreach ($detailExaminationTreatment as $item)
                                <tr class="w-full mb-4">
                                    <td class="p-4">{{ $item->treatment->name }}</td>
                                    <td class="p-4">{{ $item->qty }}</td>
                                    <td class="p-4">{{ "Rp. ".number_format($item->treatment->price, 0, ',', '.') }}</td>
                                    <td class="p-4">{{ checkDiscountTreatment($item->treatment_id, $item->created_at) != null ? checkDiscountTreatment($item->treatment_id, $item->created_at)->discount_type : '-' }}</td>
                                    <td class="p-4">{{ "Rp. ".number_format($item->sub_total, 0, ',', '.') }}</td>
                                    <td class="p-4">
                                        @if (checkDiscountTreatment($item->treatment_id, $item->created_at) != null)
                                            @if (checkDiscountTreatment($item->treatment_id, $item->created_at)->discount_type == 'Percentage')
                                                {{ checkDiscountTreatment($item->treatment_id, $item->created_at)->discount.'%' }}
                                                ( {{ "Rp. ".number_format( $item->treatment ? $item->sub_total * checkDiscountTreatment($item->treatment_id, $item->created_at)->discount / 100 : 0, 0, ',', '.') }} )
                                                @php
                                                    $totalDiscountTreatment += ($item->sub_total * checkDiscountTreatment($item->treatment_id, $item->created_at)->discount / 100);
                                                    $totalAfterDiscountTreatment += $item->sub_total - ($item->sub_total * checkDiscountTreatment($item->treatment_id, $item->created_at)->discount / 100);
                                                @endphp
                                            @else
                                                {{ "Rp. ".number_format(checkDiscountTreatment($item->treatment_id, $item->created_at)->discount, 0, ',', '.') }}
                                                @php
                                                    $totalDiscountTreatment += checkDiscountTreatment($item->treatment_id, $item->created_at)->discount;
                                                    $totalAfterDiscountTreatment += $item->sub_total - checkDiscountTreatment($item->treatment_id, $item->created_at)->discount;
                                                @endphp
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        @if (checkDiscountTreatment($item->treatment_id, $item->created_at) != null)
                                            @if (checkDiscountTreatment($item->treatment_id, $item->created_at)->discount_type == 'Percentage')
                                                {{ "Rp. ".number_format( $item->treatment ? $item->sub_total - ($item->sub_total * checkDiscountTreatment($item->treatment_id, $item->created_at)->discount / 100) : 0, 0, ',', '.') }}
                                            @else
                                                {{ "Rp. ".number_format( $item->treatment ? $item->sub_total - checkDiscountTreatment($item->treatment_id, $item->created_at)->discount : 0, 0, ',', '.') }}
                                            @endif
                                        @else
                                            {{ "Rp. ".number_format( $item->treatment ? $item->sub_total : 0, 0, ',', '.') }}
                                            @php
                                                $totalAfterDiscountTreatment += $item->sub_total
                                            @endphp
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="px-5 pb-2 pt-5 text-right font-bold">Total Treatment : {{ "Rp. ".number_format($detailExaminationTreatment->sum('sub_total'), 0, ',', '.') }}</p>
                    <p class="px-5 pb-2 pt-5 text-right font-bold">Total Harga Diskon Treatment : {{ "Rp. ".number_format($totalDiscountTreatment, 0, ',', '.') }}</p>
                    <p class="px-5 pb-2 pt-5 text-right font-bold">Total Setelah Diskon Treatment : {{ "Rp. ".number_format($totalAfterDiscountTreatment, 0, ',', '.') }}</p>
                </div>
            </x-card-container>
            <x-card-container>
                <div class="pb-2">
                    <p class="font-semibold text-lg">Detail Pemeriksaan (Barang / Obat)</p>
                </div>
                <div class="pt-3">
                    <div class="relative overflow-x-auto" style="height: 300px;">
                        <table class="text-left w-full">
                            <thead class="bg-primary text-white">
                                <tr class="w-full">
                                    <th class="p-4">Nama Treatment</th>
                                    <th class="p-4">Qty</th>
                                    <th class="p-4">Harga</th>
                                    <th class="p-4">Jenis Diskon</th>
                                    <th class="p-4">Sub Total</th>
                                    <th class="p-4">Diskon</th>
                                    <th class="p-4">Harga Setelah Diskon</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-100">
                                @php
                                    $totalDiscountItem = 0;
                                    $totalAfterDiscountItem = 0;
                                @endphp
                                @foreach ($detailExaminationItem as $item)
                                <tr class="w-full mb-4">
                                    <td class="p-4">{{ $item->item ? $item->item->name : 'Item not found' }}</td>
                                    <td class="p-4">{{ $item->qty }}</td>
                                    <td class="p-4">{{ "Rp. ".number_format( $item->item ? $item->item->price : 0, 0, ',', '.') }}</td>
                                    <td class="p-4">{{ checkDiscountItem($item->item_id, $item->created_at) != null ? checkDiscountItem($item->item_id, $item->created_at)->discount_type : '-' }}</td>
                                    <td class="p-4">{{ "Rp. ".number_format( $item->item ? $item->sub_total : 0, 0, ',', '.') }}</td>
                                    <td class="p-4">
                                        @if (checkDiscountItem($item->item_id, $item->created_at) != null)
                                            @if (checkDiscountItem($item->item_id, $item->created_at)->discount_type == 'Percentage')
                                                {{ checkDiscountItem($item->item_id, $item->created_at)->discount.'%' }}
                                                ( {{ "Rp. ".number_format( $item->item ? $item->sub_total * checkDiscountItem($item->item_id, $item->created_at)->discount / 100 : 0, 0, ',', '.') }} )
                                                @php
                                                    $totalDiscountItem += ($item->sub_total * checkDiscountItem($item->item_id, $item->created_at)->discount / 100);
                                                    $totalAfterDiscountItem += $item->sub_total - ($item->sub_total * checkDiscountItem($item->item_id, $item->created_at)->discount / 100);
                                                @endphp
                                            @else
                                                {{ "Rp. ".number_format(checkDiscountItem($item->item_id, $item->created_at)->discount, 0, ',', '.') }}
                                                @php
                                                    $totalDiscountItem += checkDiscountItem($item->item_id, $item->created_at)->discount;
                                                    $totalAfterDiscountItem += $item->sub_total - checkDiscountItem($item->item_id, $item->created_at)->discount;
                                                @endphp
                                            @endif
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        @if (checkDiscountItem($item->item_id, $item->created_at) != null)
                                            @if (checkDiscountItem($item->item_id, $item->created_at)->discount_type == 'Percentage')
                                                {{ "Rp. ".number_format( $item->item ? $item->sub_total - ($item->sub_total * checkDiscountItem($item->item_id, $item->created_at)->discount / 100) : 0, 0, ',', '.') }}
                                            @else
                                                {{ "Rp. ".number_format( $item->item ? $item->sub_total - checkDiscountItem($item->item_id, $item->created_at)->discount : 0, 0, ',', '.') }}
                                            @endif
                                        @else
                                            {{ "Rp. ".number_format( $item->item ? $item->sub_total : 0, 0, ',', '.') }}
                                            @php
                                                $totalAfterDiscountItem += $item->sub_total
                                            @endphp
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="px-5 pb-2 pt-5 text-right font-bold">Total Barang / Obat : {{ "Rp. ".number_format($detailExaminationItem->sum('sub_total'), 0, ',', '.') }}</p>
                    <p class="px-5 pb-2 pt-5 text-right font-bold">Total Harga Diskon Barang / Obat : {{ "Rp. ".number_format($totalDiscountItem, 0, ',', '.') }}</p>
                    <p class="px-5 pb-2 pt-5 text-right font-bold">Total Setelah Diskon Barang / Obat : {{ "Rp. ".number_format($totalAfterDiscountItem, 0, ',', '.') }}</p>
                </div>
            </x-card-container>
            <x-card-container>
                <div class="pb-2">
                    <p class="font-semibold text-lg">Detail Pemeriksaan (Layanan Tambahan)</p>
                </div>
                <div class="pt-3">
                    <form action="{{ route('front-office.transaction.addon-transaction', [$detailTransaction->id, $detailTransaction->examination_id]) }}" method="POST">
                        @csrf
                        <div>
                            <p>Layanan Tambahan :</p>
                            <div class="mt-2">
                                <select id="addon_id" name="addon_id" class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    @foreach ($listAddon as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }} - {{ "Rp. ".number_format( $item->price, 0, ',', '.') }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class=" mt-2">
                                <x-input id="qty" label="Qty" name="qty" type="number" required />
                            </div>
                            <div class="mt-6 text-right">
                                <x-button type="submit">Tambah Layanan</x-button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="pt-3">
                    <div class="relative overflow-x-auto" style="height: 300px;">
                        <table class="text-left w-full">
                            <thead class="bg-primary text-white">
                                <tr class="w-full">
                                    <th class="p-4">Nama Layanan</th>
                                    <th class="p-4">Ditambahkan Oleh</th>
                                    <th class="p-4">Qty</th>
                                    <th class="p-4">Harga</th>
                                    <th class="p-4">Subtotal</th>
                                    <th class="p-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-gray-100">
                                @foreach ($detailAddonExamination as $item)
                                <tr class="w-full mb-4">
                                    <td class="p-4">{{ $item->addon ? $item->addon->name : 'Item not found' }}</td>
                                    <td class="p-4">{{ $item->user ? $item->user->name : $item->doctor->name }}</td>
                                    <td class="p-4">{{ $item->qty }}</td>
                                    <td class="p-4">{{ "Rp. ".number_format( $item->addon ? $item->addon->price : 0, 0, ',', '.') }}</td>
                                    <td class="p-4">{{ "Rp. ".number_format( $item->sub_total, 0, ',', '.') }}</td>
                                    <td class="p-2">
                                        @if ($item->user_id == auth()->user()->id)
                                        <form action="{{ route('front-office.transaction.remove_addon-transaction', $item->id) }}" method="POST">
                                            @method('delete')
                                            @csrf
                                            <button type="submit"
                                                class="text-white bg-red-500 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
                                                Hapus
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <p class="px-5 pb-2 pt-5 text-right font-bold">Total Layanan Tambahan : {{ "Rp. ".number_format($detailAddonExamination->sum('sub_total'), 0, ',', '.') }}</p>
                </div>
            </x-card-container>
        </div>

        <div>
            <x-card-container>
                <div class="pb-2">
                    <p class="font-semibold text-lg">Form Pemeriksaan</p>
                </div>
                <div class="pt-3">
                    <x-input id="medical_record" class="bg-gray-300 hover:cursor-not-allowed" label="Kode Rekam Medis" name="medical_record" readonly="readonly" value="{{ old('medical_record', $detailTransaction->examination->medicalRecord->medical_record_number) }}" required />
                </div>
                <div class="pt-3">
                    <x-input id="examination_date" class="bg-gray-300 hover:cursor-not-allowed" label="Tanggal Pemeriksaan" name="examination_date" readonly="readonly" value="{{ old('examination_date', $detailTransaction->examination->examination_date) }}" required />
                </div>
                <div class="pt-3">
                    <x-input id="examination_systolic_blood_pressure" class="bg-gray-300 hover:cursor-not-allowed" label="Tekanan Darah (Systolic)" name="examination_systolic_blood_pressure" readonly="readonly" value="{{ old('examination_systolic_blood_pressure', $detailTransaction->examination->systolic_blood_pressure) }}" required />
                </div>
                <div class="pt-3">
                    <x-input id="examination_diastolic_blood_pressure" class="bg-gray-300 hover:cursor-not-allowed" label="Tekanan Darah (diastolic)" name="examination_diastolic_blood_pressure" readonly="readonly" value="{{ old('examination_diastolic_blood_pressure', $detailTransaction->examination->diastolic_blood_pressure) }}" required />
                </div>
            </x-card-container>
            <x-card-container>
                <form action="{{ route('front-office.transaction.payment.confirm', $detailTransaction->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="pb-2">
                        <p class="font-semibold text-lg">Form Transaksi</p>
                    </div>
                    <div class="pt-3">
                        <x-input id="transaction_code" class="bg-gray-300 hover:cursor-not-allowed" label="Kode Transaksi" name="transaction_code" readonly="readonly" value="{{ old('transaction_code', $detailTransaction->code) }}" required />
                    </div>
                    <div class="pt-3">
                        <x-input id="transaction_branch_name" class="bg-gray-300 hover:cursor-not-allowed" label="Cabang" name="transaction_branch_name" readonly="readonly" value="{{ old('transaction_branch_name', $detailTransaction->branch->name) }}" required />
                    </div>
                    <div class="pt-3">
                        <x-input id="transaction_doctor_name" class="bg-gray-300 hover:cursor-not-allowed" label="Nama Dokter" name="transaction_doctor_name" readonly="readonly" value="{{ old('transaction_doctor_name', $detailTransaction->doctor->name) }}" required />
                    </div>
                    <div class="pt-3">
                        <x-input id="transaction_customer_name" class="bg-gray-300 hover:cursor-not-allowed" label="Nama Pasien" name="transaction_customer_name" readonly="readonly" value="{{ old('transaction_customer_name', $detailTransaction->customer->name) }}" required />
                    </div>
                    <div class="pt-3">
                        <x-input id="transaction_note" label="Catatan" name="transaction_note" value="{{ old('transaction_note', $detailTransaction->note) }}" />
                    </div>
                    <div class="pt-3">
                        <p class="mb-2">Metode Pembayaran :</p>
                        <select id="transaction_payment_method_id" name="transaction_payment_method_id" class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            @foreach ($listPaymentMethod as $item)
                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pt-3">
                        <p class="mb-2">Status PPN :</p>
                        <select id="transaction_ppn_status" name="transaction_ppn_status" class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value="Without" {{ $detailTransaction->ppn_status == 'Without' ? 'selected' : '' }}>Without</option>
                            {{-- <option value="Include">Include</option> --}}
                            <option value="Exclude" {{ $detailTransaction->ppn_status == 'Exclude' ? 'selected' : '' }}>Exclude</option>
                        </select>
                    </div>
                    <div class="pt-3">
                        <x-input id="transaction_total" class="bg-gray-300 hover:cursor-not-allowed" label="Total" name="transaction_total" type="text" placeholder="Rp." readonly="readonly" value="Rp. {{ number_format($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total'), 0, ',', '.') }}" required />
                    </div>
                    <div class="pt-3">
                        <x-input id="deposit" label="Deposit" class="bg-gray-300 hover:cursor-not-allowed" name="transaction_deposit" type="text" placeholder="Rp." readonly="readonly" value="Rp. {{ number_format($detailTransaction->examination->reservation->deposit, 0, ',', '.') }}" required />
                    </div>
                    <div class="pt-3">
                        <x-input id="transaction_discount" class="bg-gray-300 hover:cursor-not-allowed" label="Diskon" name="transaction_discount" type="text" placeholder="Rp." value="Rp. {{ number_format($totalDiscountTreatment+$totalDiscountItem, 0, ',', '.') }}" readonly="readonly" required />
                    </div>
                    <div>
                        <div class="pt-3">
                            <p class="mb-2">Jenis Diskon Tambahan :</p>
                            <select id="transaction_additional_discount_type" name="transaction_additional_discount_type" class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value="nominal" {{ $detailTransaction->additional_discount_type == 'nominal' ? 'selected' : '' }} >Nominal</option>
                                <option value="percentage" {{ $detailTransaction->additional_discount_type == 'percentage' ? 'selected' : '' }} >Percentage</option>
                            </select>
                        </div>
                        <div class="pt-3" id="parent_nominal" {{ $detailTransaction->additional_discount_type != 'nominal' ? 'hidden' : '' }}>
                            <x-input id="transaction_additional_discount_nominal" label="Diskon Tambahan :" name="transaction_additional_discount_nominal" type="text" placeholder="Rp." value="Rp. {{ number_format($detailTransaction->additional_discount_nominal, 0, ',', '.') }}" />
                        </div>
                        <div class="pt-3" id="parent_percentage" {{ $detailTransaction->additional_discount_type != 'percentage' ? 'hidden' : '' }}>
                            <x-input id="transaction_additional_discount_percentage" label="Diskon Tambahan :" name="transaction_additional_discount_percentage" type="number" value="{{ $detailTransaction->additional_discount_nominal }}" />
                        </div>
                    </div>
                    @php
                        $tempTotalPpn = 0;
                        $tempTotalAfterPpnDiscount = 0;
                        $tempTotalPaid = 0;
                        if($detailTransaction->ppn_status == 'Exclude'){
                            $tempTotalPpn = (($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100);
                            $tempTotalAfterPpnDiscount = ((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100) + ($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)));
                            $tempTotalPaid = ((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100) + ($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - $detailTransaction->examination->reservation->deposit - ($totalDiscountTreatment+$totalDiscountItem)));
                        } else {
                            $tempTotalAfterPpnDiscount = (($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)));
                            $tempTotalPaid = (($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - $detailTransaction->examination->reservation->deposit - ($totalDiscountTreatment+$totalDiscountItem)));
                        }

                        if($detailTransaction->additional_discount_type == 'nominal'){
                            $tempTotalAfterPpnDiscount = $tempTotalAfterPpnDiscount - $detailTransaction->additional_discount_nominal;
                            $tempTotalPaid = $tempTotalPaid - $detailTransaction->additional_discount_nominal;
                        } else {
                            $tempTotalAfterPpnDiscount = $tempTotalAfterPpnDiscount - ($tempTotalAfterPpnDiscount * $detailTransaction->additional_discount_nominal / 100);
                            $tempTotalPaid = $tempTotalPaid - ($tempTotalPaid * $detailTransaction->additional_discount_nominal / 100);
                        }
                    @endphp
                    <div class="pt-3">
                        <x-input id="transaction_total_ppn" class="bg-gray-300 hover:cursor-not-allowed" label="Total PPN (10%)" name="transaction_total_ppn" type="text" placeholder="Rp." value="Rp. {{ number_format($tempTotalPpn, 0, ',', '.') }}" readonly="readonly" required />
                    </div>
                    <div class="pt-3">
                        <x-input id="transaction_grand_total" class="bg-gray-300 hover:cursor-not-allowed" label="Total (Setelah diskon & PPN)" name="transaction_grand_total" type="text" placeholder="Rp." value="Rp. {{ number_format($tempTotalAfterPpnDiscount, 0, ',', '.') }}" readonly="readonly" required />
                    </div>
                    <div class="pt-3">
                        <x-input id="transaction_total_paid" class="bg-gray-300 hover:cursor-not-allowed" label="Total yang seharusnya dibayarkan (Setelah dipotong deposit)" name="transaction_total_paid" type="text" placeholder="Rp." value="Rp. {{ number_format($tempTotalPaid, 0, ',', '.') }}" readonly="readonly" required />
                    </div>
                    <div class="pt-3">
                        <x-input id="transaction_nominal_paid" label="Nominal yang dibayarkan" name="transaction_nominal_paid" type="text" placeholder="Rp." required />
                    </div>
                    <div class="pt-3">
                        <x-input id="transaction_nominal_return" class="bg-gray-300 hover:cursor-not-allowed" label="Kembalian" name="transaction_nominal_return" type="text" placeholder="Rp." value="Rp. 0" readonly="readonly" required />
                    </div>
                    <div class="mt-6 text-right">
                        <x-button type="submit">Simpan</x-button>
                    </div>
                </form>
            </x-card-container>
        </div>
    </div>

    @push('js-internal')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var transactionTotalInput = document.getElementById('transaction_total');
                transactionTotalInput.addEventListener('input', function(event) {
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;
                });

                var transactionDiscountInput = document.getElementById('transaction_discount');
                transactionDiscountInput.addEventListener('input', function(event) {
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;
                });

                var transactionTotalPPNInput = document.getElementById('transaction_total_ppn');
                transactionTotalPPNInput.addEventListener('input', function(event) {
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;
                });

                var transactionGrandTotalInput = document.getElementById('transaction_grand_total');
                transactionGrandTotalInput.addEventListener('input', function(event) {
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;
                });

                var transactionTotalPaidInput = document.getElementById('transaction_total_paid');
                transactionTotalPaidInput.addEventListener('input', function(event) {
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;
                });

                var transactionNominalReturnInput = document.getElementById('transaction_nominal_return');
                transactionNominalReturnInput.addEventListener('input', function(event) {
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;
                });

                var transactionNominalPaidInput = document.getElementById('transaction_nominal_paid');
                transactionNominalPaidInput.addEventListener('input', function(event) {
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);

                    var totalPaid = parseFloat(transactionTotalPaidInput.value.replace(/\D/g, ''));
                    var nominalPaid = parseFloat(transactionNominalPaidInput.value.replace(/\D/g, ''));
                    var nominalReturn = nominalPaid - totalPaid;
                    transactionNominalReturnInput.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(nominalReturn);

                    this.value = formattedVal;
                });

                var inputDiscount = document.getElementById('transaction_discount');
                var inputTotalPPN = document.getElementById('transaction_total_ppn');
                var inputGrandTotal = document.getElementById('transaction_grand_total');
                var inputTotal = document.getElementById('transaction_total');
                
                inputDiscount.addEventListener('keyup', function() {
                    var convertInputTotal = parseFloat(inputTotal.value.replace(/[^\d]/g, '').replace(',', '.'));
                    var convertInputDiscount = parseFloat(inputDiscount.value.replace(/[^\d]/g, '').replace(',', '.'));
                    var convertInputTotalPPN = parseFloat(inputTotalPPN.value.replace(/[^\d]/g, '').replace(',', '.'));
                    var convertInputGrandTotal = parseFloat(inputGrandTotal.value.replace(/[^\d]/g, '').replace(',', '.'));

                    var discount = convertInputDiscount;
                    var total = convertInputTotal;
                    var ppn = (total - discount) * 0.1;
                    var grandTotal = total - discount + ppn;

                    inputTotalPPN.value = formatCurrency(ppn);
                    inputGrandTotal.value = formatCurrency(grandTotal);
                });

                var statusPpnSelect = document.getElementById('transaction_ppn_status');
                var transactionTotalPpnInput = document.getElementById('transaction_total_ppn');
                var transactionGrandTotalInput = document.getElementById('transaction_grand_total');
                var totalPaidInput = document.getElementById('transaction_total_paid');
                statusPpnSelect.addEventListener('change', function () {
                    transactionDiscountNominalInput.value = 'Rp. 0';
                    transactionDiscountPercentageInput.value = '0';
                    var selectedValue = statusPpnSelect.value;
                    if (selectedValue === 'Without') {
                        transactionTotalPpnInput.value = 'Rp. 0';
                        transactionGrandTotalInput.value = 'Rp. {{ number_format((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem))), 0, ',', '.') }}';
                        totalPaidInput.value = 'Rp. {{ number_format((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - $detailTransaction->examination->reservation->deposit - ($totalDiscountTreatment+$totalDiscountItem))), 0, ',', '.') }}';
                    } else {
                        transactionTotalPpnInput.value = 'Rp. {{ number_format(((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100)), 0, ',', '.') }}';
                        transactionGrandTotalInput.value = 'Rp. {{ number_format(((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100) + ($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem))), 0, ',', '.') }}';
                        totalPaidInput.value = 'Rp. {{ number_format(((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100) + ($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - $detailTransaction->examination->reservation->deposit - ($totalDiscountTreatment+$totalDiscountItem))), 0, ',', '.') }}';
                    }
                });

                function formatCurrency(amount) {
                    return 'Rp. ' + amount.toFixed(0).replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.');
                }

                // Diskon Tambahan
                var additionalDiscountSelect = document.getElementById('transaction_additional_discount_type');
                var parentNominal = document.getElementById('parent_nominal');
                var parentPercentage = document.getElementById('parent_percentage');
                var transactionDiscountNominalInput = document.getElementById('transaction_additional_discount_nominal');
                var transactionDiscountPercentageInput = document.getElementById('transaction_additional_discount_percentage');

                additionalDiscountSelect.addEventListener('change', function () {
                    transactionDiscountNominalInput.value = 'Rp. 0';
                    transactionDiscountPercentageInput.value = '0';
                    
                    var selectedDiscount = additionalDiscountSelect.value;
                    if (selectedDiscount == 'nominal') {
                        parentNominal.style.display = 'block';
                        parentPercentage.style.display = 'none';

                        transactionDiscountNominalInput.value = "Rp. {{ $detailTransaction->additional_discount_type == 'nominal' ? number_format(($detailTransaction->additional_discount_nominal), 0, ',', '.') : 0 }}";
                        transactionDiscountPercentageInput.value = '0';

                        var selectedValue = statusPpnSelect.value;
                        if (selectedValue === 'Without') {
                            var parseGrandTotal = '{{ ((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                            var totalPaid = '{{ ((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - $detailTransaction->examination->reservation->deposit - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                        } else {
                            var parseGrandTotal = '{{ (((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100) + ($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                            var totalPaid = '{{ (((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100) + ($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - $detailTransaction->examination->reservation->deposit - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                        }

                        var parseDiscountNominal = parseFloat(transactionDiscountNominalInput.value.replace(/\D/g, ''));
                        transactionGrandTotalInput.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(parseGrandTotal - parseDiscountNominal);

                        var parseDiscountNominalPaid = parseFloat(transactionDiscountNominalInput.value.replace(/\D/g, ''));
                        totalPaidInput.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(totalPaid - parseDiscountNominalPaid);
                    } else if (selectedDiscount == 'percentage') {
                        parentNominal.style.display = 'none';
                        parentPercentage.style.display = 'block';

                        transactionDiscountPercentageInput.value = "{{ $detailTransaction->additional_discount_type == 'percentage' ? $detailTransaction->additional_discount_nominal : 0 }}";
                        transactionDiscountNominalInput.value = 'Rp. 0';

                        var selectedValue = statusPpnSelect.value;
                        if (selectedValue === 'Without') {
                            var parseGrandTotal = '{{ ((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                            var totalPaid = '{{ ((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - $detailTransaction->examination->reservation->deposit - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                        } else {
                            var parseGrandTotal = '{{ (((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100) + ($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                            var totalPaid = '{{ (((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100) + ($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - $detailTransaction->examination->reservation->deposit - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                        }

                        var parseDiscountPercentaged = parseFloat(transactionDiscountPercentageInput.value.replace(/\D/g, ',')) / 100;
                        transactionGrandTotalInput.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(parseGrandTotal - (parseGrandTotal * parseDiscountPercentaged));

                        var parseDiscountPercentagePaid = parseFloat(transactionDiscountPercentageInput.value.replace(/\D/g, ',')) / 100;
                        totalPaidInput.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(totalPaid - (totalPaid * parseDiscountPercentagePaid));
                    }
                });

                transactionDiscountNominalInput.addEventListener('input', function(event) {
                    var inputVal = this.value.replace(/\D/g, '');
                    var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(inputVal);
                    this.value = formattedVal;

                    var selectedValue = statusPpnSelect.value;
                    if (selectedValue === 'Without') {
                        var parseGrandTotal = '{{ ((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                        var totalPaid = '{{ ((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - $detailTransaction->examination->reservation->deposit - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                    } else {
                        var parseGrandTotal = '{{ (((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100) + ($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                        var totalPaid = '{{ (((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100) + ($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - $detailTransaction->examination->reservation->deposit - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                    }

                    var parseDiscountNominal = parseFloat(transactionDiscountNominalInput.value.replace(/\D/g, ''));
                    transactionGrandTotalInput.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(parseGrandTotal - parseDiscountNominal);

                    var parseDiscountNominalPaid = parseFloat(transactionDiscountNominalInput.value.replace(/\D/g, ''));
                    totalPaidInput.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(totalPaid - parseDiscountNominalPaid);
                });

                transactionDiscountPercentageInput.addEventListener('input', function(event) {
                    handleChange(this);
                });
                transactionDiscountPercentageInput.addEventListener('input', function(event) {
                    var selectedValue = statusPpnSelect.value;
                    if (selectedValue === 'Without') {
                        var parseGrandTotal = '{{ ((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                        var totalPaid = '{{ ((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - $detailTransaction->examination->reservation->deposit - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                    } else {
                        var parseGrandTotal = '{{ (((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100) + ($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                        var totalPaid = '{{ (((($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - ($totalDiscountTreatment+$totalDiscountItem)) * 10 / 100) + ($detailExaminationTreatment->sum('sub_total')+$detailExaminationItem->sum('sub_total')+$detailAddonExamination->sum('sub_total') - $detailTransaction->examination->reservation->deposit - ($totalDiscountTreatment+$totalDiscountItem)))) }}';
                    }

                    var parseDiscountPercentage = parseFloat(transactionDiscountPercentageInput.value.replace(/\D/g, '')) / 100;
                    transactionGrandTotalInput.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(parseGrandTotal - (parseGrandTotal * parseDiscountPercentage));

                    var parseDiscountPercentagePaid = parseFloat(transactionDiscountPercentageInput.value.replace(/\D/g, '')) / 100;
                    totalPaidInput.value = 'Rp. ' + new Intl.NumberFormat('id-ID').format(totalPaid - (totalPaid * parseDiscountPercentagePaid));
                });
            });
        </script>
        <script>
            function handleChange(input) {
                if (input.value < 0) input.value = 0;
                if (input.value > 100) input.value = 100;
            }
        </script>
        <script>
            @include('components.flash-message')
        </script>
    @endpush
</x-app-layout>
