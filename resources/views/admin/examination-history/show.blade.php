<x-app-layout>

    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Daftar Pemeriksaan', 'url' => route('admin.examination-history.index')],
        ['name' => date('Y-m-d', strtotime($data->created_at)) . ' - ' . $data->customer->name],
    ]" title="Detail Pemeriksaan" />

    <!-- Detail Information and History -->
    <x-card-container>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 lg:gap-0">
            <div>
                <h3 class="text-sm font-semibold mb-4">INFORMASI PASIEN</h3>
                <hr class="my-3">
                <div class="space-y-6">
                    <div>
                        <h4 class="font-semibold mb-2">Nama</h4>
                        <p>{{ $data->customer->name }}</p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">Tanggal Lahir</h4>
                        <p>
                            {{ Carbon\Carbon::parse($data->date_of_birth)->locale('id')->isoFormat('LL') }}
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">Tempat Lahir</h4>
                        <p>
                            {{ $data->customer->place_of_birth ?? '-' }}
                        </p>
                    </div>
                    <div>
                        <h4 class="font-semibold mb-2">Jenis Kelamin</h4>
                        <p>{{ $data->customer->gender == 'Male' ? 'Laki-laki' : 'Perempuan' }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="lg:col-span-3">
                <!-- Examination History -->
                <div>
                    <h3 class="text-sm font-semibold text-gray-800">RIWAYAT PEMERIKSAAN</h3>
                    <hr class="my-4">
                    <div class="grid grid-cols-4">
                        <h3 class="text-xs text-gray-500 font-semibold uppercase mb-6">Tanggal</h3>
                        <h3 class="text-xs text-gray-500 font-semibold uppercase mb-6">Dokter</h3>
                        <h3 class="text-xs text-gray-500 font-semibold uppercase mb-6">Branch</h3>
                        <h3 class="text-xs text-gray-500 font-semibold uppercase mb-6">Lihat</h3>
                    </div>
                    <div class="space-y-6">
                        @forelse ($examinationHistories as $history)
                            @if ($history->id != $data->id)
                                <x-examination-history :examination="$history" />
                            @endif
                        @empty
                            <p class="text-gray-500">Tidak ada riwayat pemeriksaan</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </x-card-container>

    <!-- Examination Form -->
    <x-card-container>
        <h3 class="text-sm font-semibold mb-4">PEMERIKSAAN</h3>
        <hr class="mt-3 mb-6">
        <div class="space-y-6">
            <div>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <x-select id="blood_type" label="Golongan Darah" disabled name="blood_type" required>
                        <option value="A" {{ $data->blood_type == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ $data->blood_type == 'B' ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ $data->blood_type == 'AB' ? 'selected' : '' }}>AB</option>
                        <option value="O" {{ $data->blood_type == 'O' ? 'selected' : '' }}>O</option>
                    </x-select>
                    <x-input id="systolic_blood_pressure" label="Sistolik" type="number" disabled
                        name="systolic_blood_pressure" required value="{{ $data->systolic_blood_pressure }}" />
                    <x-input id="diastolic_blood_pressure" label="Diastolik" type="number" disabled
                        name="diastolic_blood_pressure" required value="{{ $data->diastolic_blood_pressure }}" />
                </div>
            </div>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <x-select id="heart_disease" label="Riwayat Penyakit Jantung" disabled name="heart_disease" required>
                    <option value="0" {{ $data->heart_disease == 0 ? 'selected' : '' }}>Tidak</option>
                    <option value="1" {{ $data->heart_disease == 1 ? 'selected' : '' }}>Ya</option>
                </x-select>
                <x-select id="diabetes" label="Riwayat Penyakit Diabetes" disabled name="diabetes" required>
                    <option value="0" {{ $data->diabetes == 0 ? 'selected' : '' }}>Tidak</option>
                    <option value="1" {{ $data->diabetes == 1 ? 'selected' : '' }}>Ya</option>
                </x-select>
                <x-select id="blood_clotting_disorder" label="Riwayat Kelainan Pembekuan Darah" disabled
                    name="blood_clotting_disorder" required>
                    <option value="0" {{ $data->blood_clotting_disorder == 0 ? 'selected' : '' }}>Tidak
                    </option>
                    <option value="1" {{ $data->blood_clotting_disorder == 1 ? 'selected' : '' }}>Ya
                    </option>
                </x-select>
                <x-select id="hepatitis" label="Riwayat Penyakit Hepatitis" disabled name="hepatitis" required>
                    <option value="0" {{ $data->hepatitis == 0 ? 'selected' : '' }}>Tidak</option>
                    <option value="1" {{ $data->hepatitis == 1 ? 'selected' : '' }}>Ya</option>
                </x-select>
                <x-select id="digestive_diseases" label="Riwayat Penyakit Saluran Pencernaan" disabled
                    name="digestive_diseases" required>
                    <option value="0" {{ $data->digestive_diseases == 0 ? 'selected' : '' }}>Tidak
                    </option>
                    <option value="1" {{ $data->digestive_diseases == 1 ? 'selected' : '' }}>Ya
                    </option>
                </x-select>
                <x-select id="other_diseases" label="Riwayat Penyakit Lainnya" disabled name="other_diseases" required>
                    <option value="0" {{ $data->other_diseases == 0 ? 'selected' : '' }}>Tidak</option>
                    <option value="1" {{ $data->other_diseases == 1 ? 'selected' : '' }}>Ya</option>
                </x-select>
                <x-select id="allergies_to_medicines" label="Alergi Obat" disabled name="allergies_to_medicines"
                    required>
                    <option value="0" {{ $data->allergies_to_medicines == 0 ? 'selected' : '' }}>Tidak
                    </option>
                    <option value="1" {{ $data->allergies_to_medicines == 1 ? 'selected' : '' }}>Ya
                    </option>
                </x-select>
                <div class="{{ $data->allergies_to_medicines ? '' : 'hidden' }}" id="medication_field">
                    <x-input id="medications" label="Obat-obatan" type="text" disabled name="medications"
                        value="{{ $data->medications }}" />
                </div>
                <x-select id="allergies_to_food" label="Alergi Makanan" disabled name="allergies_to_food" required>
                    <option value="0" {{ $data->allergies_to_food == 0 ? 'selected' : '' }}>Tidak
                    </option>
                    <option value="1" {{ $data->allergies_to_food == 1 ? 'selected' : '' }}>Ya</option>
                </x-select>
                <div class="{{ $data->allergies_to_food ? '' : 'hidden' }}" id="foods_field">
                    <x-input id="foods" label="Makanan" type="text" disabled name="foods"
                        value="{{ $data->foods }}" />
                </div>
            </div>
        </div>
    </x-card-container>

    <!-- Odontogram -->
    <x-card-container>
        <h3 class="text-sm font-semibold mb-4">ODONTOGRAM</h3>
        <hr class="mt-3 mb-8">
        <div class="relative overflow-x-auto max-w-3xl mx-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <tbody>
                    @foreach (range(11, 18) as $i)
                        <tr class="bg-white border-b">
                            <td class="text-start">
                                {{ $i }} @if ($i <= 15)
                                    [{{ $i + 40 }}]
                                @endif
                            </td>
                            <td class="px-8 text-center">
                                @if (isset($odontogramForTable[$i]))
                                    <x-row-tooth :toothNumber="$i" :data="$odontogramForTable[$i]" />
                                @endif
                                @if ($i <= 15 && isset($odontogramForTable[$i + 40]))
                                    <x-row-tooth :toothNumber="$i + 40" :data="$odontogramForTable[$i + 40]" />
                                @endif
                            </td>
                            <td class="px-8 text-center">
                                @if ($i <= 15 && isset($odontogramForTable[$i + 50]))
                                    <x-row-tooth :toothNumber="$i + 50" :data="$odontogramForTable[$i + 50]" />
                                @endif
                                @if (isset($odontogramForTable[$i + 10]))
                                    <x-row-tooth :toothNumber="$i + 10" :data="$odontogramForTable[$i + 10]" />
                                @endif
                            </td>
                            <td class="text-end">
                                @if ($i <= 15)
                                    [{{ $i + 50 }}]
                                @endif {{ $i + 10 }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-12 pointer-events-none">
            <!-- Baris 1 -->
            <div class="flex justify-center">
                <!-- kiri -->
                @foreach (range(18, 11, -1) as $i)
                    @if (isset($odontogramGroup[$i]))
                        <x-tooth-with-data :toothNumber="$i" :odontogramGroup="$odontogramGroup[$i]" />
                    @else
                        <x-tooth-without-data :i="$i" />
                    @endif
                @endforeach
                <!-- kanan -->
                @foreach (range(21, 28) as $i)
                    @if (isset($odontogramGroup[$i]))
                        <x-tooth-with-data :toothNumber="$i" :odontogramGroup="$odontogramGroup[$i]" />
                    @else
                        <x-tooth-without-data :i="$i" />
                    @endif
                @endforeach
            </div>

            <!-- Baris 2 -->
            <div class="flex justify-center">
                <!-- Baris 2 kiri -->
                @foreach (range(55, 51, -1) as $i)
                    @if (isset($odontogramGroup[$i]))
                        <x-tooth-with-data :toothNumber="$i" :odontogramGroup="$odontogramGroup[$i]" />
                    @else
                        <x-tooth-without-data :i="$i" />
                    @endif
                @endforeach
                <!-- Baris 2 kanan -->
                @foreach (range(61, 65) as $i)
                    @if (isset($odontogramGroup[$i]))
                        <x-tooth-with-data :toothNumber="$i" :odontogramGroup="$odontogramGroup[$i]" />
                    @else
                        <x-tooth-without-data :i="$i" />
                    @endif
                @endforeach
            </div>

            <!-- Baris 3 -->
            <div class="flex justify-center">
                <!-- Baris 2 kiri -->
                @foreach (range(85, 81, -1) as $i)
                    @if (isset($odontogramGroup[$i]))
                        <x-tooth-with-data :toothNumber="$i" :odontogramGroup="$odontogramGroup[$i]" />
                    @else
                        <x-tooth-without-data :i="$i" />
                    @endif
                @endforeach
                <!-- Baris 2 kanan -->
                @foreach (range(71, 75) as $i)
                    @if (isset($odontogramGroup[$i]))
                        <x-tooth-with-data :toothNumber="$i" :odontogramGroup="$odontogramGroup[$i]" />
                    @else
                        <x-tooth-without-data :i="$i" />
                    @endif
                @endforeach
            </div>

            <!-- Baris 1 -->
            <div class="flex justify-center">
                <!-- kiri -->
                @foreach (range(48, 41, -1) as $i)
                    @if (isset($odontogramGroup[$i]))
                        <x-tooth-with-data :toothNumber="$i" :odontogramGroup="$odontogramGroup[$i]" />
                    @else
                        <x-tooth-without-data :i="$i" />
                    @endif
                @endforeach
                <!-- kanan -->
                @foreach (range(31, 38) as $i)
                    @if (isset($odontogramGroup[$i]))
                        <x-tooth-with-data :toothNumber="$i" :odontogramGroup="$odontogramGroup[$i]" />
                    @else
                        <x-tooth-without-data :i="$i" />
                    @endif
                @endforeach
            </div>
        </div>
        <div class="relative overflow-x-auto max-w-3xl mx-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <tbody>
                    @foreach (range(48, 41, -1) as $i)
                        <tr class="bg-white border-b">
                            <td class="text-start">
                                {{ $i }} @if ($i <= 45)
                                    [{{ $i + 40 }}]
                                @endif
                            </td>
                            <td class="px-8 text-center">
                                @if (isset($odontogramForTable[$i]))
                                    <x-row-tooth :toothNumber="$i" :data="$odontogramForTable[$i]" />,
                                @endif
                                @if ($i <= 45 && isset($odontogramForTable[$i + 40]))
                                    <x-row-tooth :toothNumber="$i + 40" :data="$odontogramForTable[$i + 40]" />
                                @endif
                            </td>
                            <td class="px-8 text-center">
                                @if ($i <= 45 && isset($odontogramForTable[$i + 30]))
                                    <x-row-tooth :toothNumber="$i + 30" :data="$odontogramForTable[$i + 30]" />
                                @endif
                                @if (isset($odontogramForTable[$i - 10]))
                                    <x-row-tooth :toothNumber="$i - 10" :data="$odontogramForTable[$i - 10]" />
                                @endif
                            </td>
                            <td class="text-end">
                                @if ($i <= 45)
                                    [{{ $i + 30 }}]
                                @endif {{ $i - 10 }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card-container>

    <!-- Treatment Form -->
    <x-card-container>
        <div class="max-w-4xl mx-auto">
            <div class="flex justify-between">
                <div>
                    <h3 class="font-semibold mb-1">Nomor Pembayaran</h3>
                    <p class="text-gray-500">{{ $transaction->code }}</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-1">No. Rekam Medis</h3>
                    <p class="text-gray-500">{{ $data->medicalRecord->medical_record_number }}</p>
                </div>
                <div>
                    <h3 class="font-semibold mb-1">Tanggal Pemeriksaan</h3>
                    <p class="text-gray-500">{{ date('d/m/Y', strtotime($data->created_at)) }}</p>
                </div>
            </div>
            <hr class="my-3">
            <div id="accordion-collapse" data-accordion="collapse">
                <!-- Patient -->
                <h2>
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-sm focus:ring-4 focus:ring-gray-2000 gap-3">
                        <span>Pasien</span>
                    </button>
                </h2>
                <div id="accordion-collapse-body-1" aria-labelledby="accordion-collapse-heading-1">
                    <div class="p-5 border border-b-0 border-gray-200">
                        <div class="space-y-2">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <h4 class="font-semibold mb-2">Nama</h4>
                                <p class="col-span-2">: {{ $data->customer->name }}</p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <h4 class="font-semibold mb-2">Jadwal</h4>
                                <p class="col-span-2">:
                                    {{ date('d/m/Y', strtotime($data->reservation->request_date)) }}
                                    {{ date('H:i', strtotime($data->reservation->request_time)) }}
                                    WIB
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <h4 class="font-semibold mb-2">Tanggal Lahir</h4>
                                <p class="col-span-2">:
                                    {{ Carbon\Carbon::parse($data->customer->date_of_birth)->locale('id')->isoFormat('LL') }}
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <h4 class="font-semibold mb-2">Tempat Lahir</h4>
                                <p class="col-span-2">:
                                    {{ $data->customer->place_of_birth }}
                                </p>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <h4 class="font-semibold mb-2">Jenis Kelamin</h4>
                                <p class="col-span-2">:
                                    {{ $data->customer->gender == 'Male' ? 'Laki-laki' : 'Perempuan' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Treatment -->
                <h2>
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 focus:ring-4 focus:ring-gray-200 gap-3">
                        <span>Layanan</span>
                    </button>
                </h2>
                <div id="accordion-collapse-body-2" aria-labelledby="accordion-collapse-heading-2">
                    <div class="p-5 border border-b-0 border-gray-200">
                        <div class="" id="treatmentContainer">
                            @forelse ($examinationTreatments as $data)
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <h4 class="font-semibold mb-1">{{ $data->treatment->name }}</h4>
                                        <p class="text-gray-500">Jumlah: {{ $data->qty }}</p>
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ env('ASSET_DOCTOR_URL') . 'storage/exmtreatment-proof/' . $data->proof }}"
                                            target="_blank" class="text-gray-500 hover:underline inline-block">
                                            <i class="fas fa-file"></i> Lihat Dokumentasi Pemeriksaan
                                        </a>
                                    </div>
                                    <div class="flex items-center">
                                        <p class="text-gray-500">Rp.
                                            {{ number_format($data->sub_total, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center">Tidak ada data</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Medicine -->
                <h2>
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 gap-3">
                        <span>Obat</span>
                    </button>
                </h2>
                <div id="accordion-collapse-body-3" aria-labelledby="accordion-collapse-heading-3">
                    <div class="p-5 border border-t-0 border-gray-200">
                        <div class="" id="itemsContainer">
                            @forelse ($examinationItems as $data)
                                <div class="flex justify-between items-start mb-4">
                                    <div class="space-y-1">
                                        <h4 class="font-semibold">{{ $data->item->name }}</h4>
                                        <p class="text-gray-500">
                                            Jumlah: {{ $data->qty . ' ' . $data->item->unit->name }}
                                        </p>
                                        <p class="text-gray-500">
                                            Dosis:
                                            {{ $data->amount_a_day . ' x ' . $data->day . ' ' . $data->item->unit->name . ' selama ' . $data->duration . ' ' . $data->period }}
                                        </p>
                                    </div>
                                    <div class="flex items-center">
                                        <p class="text-gray-500">Rp.
                                            {{ number_format($data->sub_total, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center">Tidak ada data</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Addon -->
                <h2>
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 gap-3">
                        <span>Addon</span>
                    </button>
                </h2>
                <div id="accordion-collapse-body-3" aria-labelledby="accordion-collapse-heading-3">
                    <div class="p-5 border border-t-0 border-gray-200">
                        <div id="listAddon">
                            @forelse ($examinationAddons as $data)
                                <div class="flex justify-between items-start mb-4">
                                    <div class="space-y-1">
                                        <h4 class="font-semibold">{{ $data->addon->name }}</h4>
                                        <p class="text-gray-500">Jumlah: {{ $data->qty }}</p>
                                        <p class="text-gray-500">+fee :
                                            {{ number_format($data->fee, 0, ',', '.') }}</p>
                                    </div>
                                    <div class="flex items-center">
                                        <p class="text-gray-500">Rp.
                                            {{ number_format($data->sub_total, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-gray-500 text-center">Tidak ada data</p>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Summary -->
                <h2>
                    <button type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-gray-200 focus:ring-4 focus:ring-gray-200 gap-3">
                        <span>Total</span>
                    </button>
                </h2>
                <div id="accordion-collapse-body-3" aria-labelledby="accordion-collapse-heading-3">
                    <div class="p-5 border border-t-0 border-gray-200 space-y-4">
                        <div class="flex justify-between items-center">
                            <h4 class="font-semibold">Layanan</h4>
                            <p class="text-gray-500">Rp.
                                {{ number_format($transactionSummary['treatments'], 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <h4 class="font-semibold">Obat</h4>
                            <p class="text-gray-500">Rp.
                                {{ number_format($transactionSummary['items'], 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <h4 class="font-semibold">Addon</h4>
                            <p class="text-gray-500">Rp.
                                {{ number_format($transactionSummary['addons'], 0, ',', '.') }}</p>
                        </div>
                        <div class="flex justify-between items-center">
                            <h4 class="font-semibold">Biaya</h4>
                            <p class="text-gray-500">Rp.
                                {{ number_format($transactionSummary['total'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-card-container>
</x-app-layout>
