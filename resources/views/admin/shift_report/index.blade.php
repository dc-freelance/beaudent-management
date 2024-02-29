<x-app-layout>
    <x-breadcrumb :links="[['name' => 'Dashboard', 'url' => route('admin.dashboard.index')], ['name' => 'Laporan Shif']]" title="Laporan Shif" />
    <x-card-container>
        <div class="grid grid-cols-4 lg:grid-cols-2 gap-4 items-end">
            <x-input id="start_date" label="Tanggal Awal" type="date" name="start_date" />
            <x-input id="end_date" label="Tanggal Akhir" type="date" name="end_date" />
            @hasrole(['admin_pusat'])
                <x-select id="branch_id" label="Cabang" name="branch_id">
                    <option value="all">Semua</option>
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
                @can('export_shift_report_general')
                    <div>
                        <button type="button" id="buttonExport"
                            class="focus:outline-none text-white bg-gray-700 hover:bg-gray-700 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2">
                            Export Data
                        </button>
                    </div>
                @endcan
            </div>
        </div>
    </x-card-container>
    <x-card-container>
        <table id="incomeReportTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Shift</th>
                    <th>Cabang</th>
                    <th>User</th>
                    <th>Sub total</th>
                </tr>
            </thead>
        </table>
    </x-card-container>

    @push('js-internal')
        <script>
            $(function() {
                $('#incomeReportTable').DataTable({
                    processing: true,
                    serverSide: true,
                    autoWidth: false,
                    responsive: true,
                    ajax: '{{ route('admin.shift_report.general') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'tanggal',
                            name: 'tanggal'
                        },
                        {
                            data: 'shift',
                            name: 'shift'
                        },
                        {
                            data: 'cabang',
                            name: 'cabang'
                        },
                        {
                            data: 'user',
                            name: 'user'
                        },
                        {
                            data: 'sub_total',
                            name: 'sub_total'
                        },
                    ],
                });
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
                        if (startDate > endDate) {
                            Swal.fire('Error', 'Tanggal awal harus lebih kecil dari tanggal akhir', 'error');
                            return false;
                        }
                    }
                }

                $('#incomeReportTable').DataTable().ajax.url(
                    `{{ route('admin.shift_report.general') }}?start_date=${startDate}&end_date=${endDate}&branch_id=${branchId}`
                ).load();
            });

            $('#buttonExport').on('click', function(e) {
                e.preventDefault();
                startDate = $('#start_date').val();
                endDate = $('#end_date').val();
                branchId = $('#branch_id').val();
                console.log(startDate);
                console.log(endDate);
                console.log(branchId);

                @role('admin_cabang')
                    branchId = '{{ auth()->user()->branch_id }}';
                @endrole

                if (startDate != '') {
                    if (endDate == '') {
                        Swal.fire('Error', 'Tanggal akhir harus diisi', 'error');
                        return false;
                    } else {
                        if (startDate > endDate) {
                            Swal.fire('Error', 'Tanggal awal harus lebih kecil dari tanggal akhir', 'error');
                            return false;
                        }
                    }
                }

                window.location.href =
                    `{{ route('admin.shift_report.general.export') }}?start_date=${startDate}&end_date=${endDate}&branch_id=${branchId}`;
            });
        </script>
    @endpush
</x-app-layout>
