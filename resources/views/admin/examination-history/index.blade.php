<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Daftar Pemeriksaan', 'url' => '#'],
    ]" title="Daftar Pemeriksaan" />

    <x-card-container>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 items-end">
            <x-input id="start_date" label="Tanggal Awal" type="date" name="start_date" />
            <x-input id="end_date" label="Tanggal Akhir" type="date" name="end_date" />
            @hasrole(['admin_pusat'])
                <x-select id="branch_id" label="Cabang" name="branch_id">
                    <option value="">Semua</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </x-select>
            @endhasrole
            <div class="flex items-center gap-2">
                <div>
                    <button type="button" id="buttonFilter"
                        class="focus:outline-none text-white bg-gray-800 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2">
                        Filter Data
                    </button>
                </div>
                {{-- <div>
                    <button type="button" id="buttonExport"
                        class="focus:outline-none text-white bg-green-600 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        Export Data
                    </button>
                </div> --}}
            </div>
        </div>
    </x-card-container>

    <x-card-container>
        <table id="examinationHistoryTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Cabang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#examinationHistoryTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: '{{ route('admin.examination-history.index') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'date',
                            name: 'date'
                        },
                        {
                            data: 'patient',
                            name: 'patient'
                        },
                        {
                            data: 'doctor',
                            name: 'doctor'
                        },
                        {
                            data: 'branch',
                            name: 'branch'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                });

                let startDate = null;
                let endDate = null;
                let branchId = null;

                $('#buttonFilter').on('click', function(e) {
                    e.preventDefault();
                    startDate = $('#start_date').val();
                    endDate = $('#end_date').val();
                    branchId = $('#branch_id').val();

                    @role('admin_cabang')
                        branchId = '{{ auth()->user()->branch_id }}';
                    @endrole

                    if (startDate != '') {
                        if (endDate == '') {
                            Swal.fire('Error', 'Tanggal akhir harus diisi', 'error');
                            return false;
                        } else {
                            if (Date.parse(startDate) > Date.parse(endDate)) {
                                Swal.fire('Error', 'Tanggal awal harus lebih kecil dari tanggal akhir',
                                    'error');
                                return false;
                            }
                        }
                    }

                    $('#examinationHistoryTable').DataTable().ajax.url(
                        `{{ route('admin.examination-history.index') }}?start_date=${startDate}&end_date=${endDate}&branch_id=${branchId}`
                    ).load();
                });
            });
        </script>
    @endpush
</x-app-layout>
