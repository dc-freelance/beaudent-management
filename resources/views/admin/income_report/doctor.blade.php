<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Presentase Dokter', 'url' => route('admin.income-report.doctor')],
    ]" title="Presentase Dokter" />

    <x-card-container>
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-4 items-end">
            <x-input id="start_date" label="Tanggal Awal" type="date" name="start_date" />
            <x-input id="end_date" label="Tanggal Akhir" type="date" name="end_date" />
            <x-select id="doctor_id" label="Dokter" name="doctor_id">
                <option value="">Semua</option>
                @foreach ($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </x-select>
            @hasrole(['admin_pusat'])
                <x-select id="branch_id" label="Cabang" name="branch_id">
                    <option value="">Semua</option>
                    @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </x-select>
            @endhasrole

            @hasrole(['admin_cabang'])
                <div class="flex items-center gap-2">
                    <div>
                        <button type="button" id="buttonFilter"
                            class="focus:outline-none text-white bg-gray-800 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2">
                            Filter Data
                        </button>
                    </div>
                    <div>
                        <button type="button" id="buttonExport"
                            class="focus:outline-none text-white bg-green-600 hover:bg-green-600 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            Export Data
                        </button>
                    </div>
                </div>
            @endhasrole
        </div>
        @hasrole(['admin_pusat'])
            <div class="flex items-center gap-2 justify-end mt-6">
                <div>
                    <button type="button" id="buttonFilter"
                        class="focus:outline-none text-white bg-gray-800 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2">
                        Filter Data
                    </button>
                </div>
                <div>
                    <button type="button" id="buttonExport"
                        class="focus:outline-none text-white bg-green-400 hover:bg-green-400 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2">
                        Export Data
                    </button>
                </div>
            </div>
        @endhasrole
    </x-card-container>
    <x-card-container>
        <table id="incomeReportTable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Cabang</th>
                    <th>Pasien</th>
                    <th>Dokter</th>
                    <th>Total Fee</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th colspan="6" style="text-align:left">
                        Total
                    </th>
                    <th></th>
                </tr>
            </tfoot>
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
                    ajax: '{{ route('admin.income-report.doctor') }}',
                    columns: [{
                            data: 'DT_RowIndex',
                            name: 'DT_RowIndex'
                        },
                        {
                            data: 'transaction_code',
                            name: 'transaction_code'
                        },
                        {
                            data: 'transaction_date',
                            name: 'transaction_date'
                        },
                        {
                            data: 'branch',
                            name: 'branch'
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
                            data: 'total_fee',
                            name: 'total_fee'
                        },
                    ],
                    footerCallback: function(row, data, start, end, display) {
                        var api = this.api(),
                            data;

                        // Remove the formatting to get integer data for summation
                        var intVal = function(i) {
                            return typeof i === 'string' ?
                                i.replace(/[\$.]/g, '') * 1 :
                                typeof i === 'number' ?
                                i : 0;
                        };

                        // Total over all pages
                        total = api
                            .column(6)
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Total over this page
                        pageTotal = api
                            .column(6, {
                                page: 'current'
                            })
                            .data()
                            .reduce(function(a, b) {
                                return intVal(a) + intVal(b);
                            }, 0);

                        // Update footer
                        $(api.column(6).footer()).html(
                            new Intl.NumberFormat(['ban', 'id']).format(pageTotal)
                        );
                    }
                });
            });

            let startDate = null;
            let endDate = null;
            let branchId = null;

            $('#buttonFilter').on('click', function(e) {
                e.preventDefault();
                startDate = $('#start_date').val();
                endDate = $('#end_date').val();
                doctorId = $('#doctor_id').val();
                branchId = $('#branch_id').val();

                @role('admin_cabang')
                    branchId = '{{ auth()->user()->branch_id }}';
                    console.log(branchId);
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
                    `{{ route('admin.income-report.doctor') }}?start_date=${startDate}&end_date=${endDate}&branch_id=${branchId}&doctor_id=${doctorId}`
                ).load();
            });

            $('#buttonExport').on('click', function(e) {
                e.preventDefault();
                startDate = $('#start_date').val();
                endDate = $('#end_date').val();
                branchId = $('#branch_id').val();
                doctorId = $('#doctor_id').val();

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
                    `{{ route('admin.income-report.doctor.export') }}?start_date=${startDate}&end_date=${endDate}&branch_id=${branchId}&doctor_id=${doctorId}`;
            });
        </script>
    @endpush
</x-app-layout>
