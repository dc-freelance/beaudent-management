<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Bonus Layanan', 'url' => route('admin.treatment-bonus.index')],
        ['name' => 'Tambah', 'url' => ''],
    ]" title="Tambah" />

    <div class="lg:w-1/2">
        <form action="{{ route('admin.treatment-bonus.store') }}" method="POST" id="submit-form" class="space-y-6">
        <x-card-container>
                @csrf
                <div class="space-y-6">
                    <x-select id="treatment_id" label="Layanan" name="treatment_id" required>
                        <option value="" selected disabled>Pilih Layanan</option>
                        @foreach ($treatments as $treatment)
                            <option value="{{ $treatment->id }}">{{ $treatment->name }}</option>
                        @endforeach
                    </x-select>
                    <x-select id="doctor_category_id" name="doctor_category_id[]" label="Kategori Dokter" class="js-example-basic-multiple" required multiple>
                        <option value="all">Semua</option>
                        @foreach ($doctorCategories as $doctorCategory)
                            <option value="{{ $doctorCategory->id }}">{{ $doctorCategory->name }}</option>
                        @endforeach
                    </x-select>
                    <div class="max-md:w-2/3 max-md:mx-auto md:w-1/3 lg:w-1/2 xl:w-1/2 pt-5">
                        <x-button type="button" class="lanjutkan">Lanjutkan</x-button>
                    </div>
                </div>
        </x-card-container>
        <x-card-container id="table-detail">
            <table class="w-full border text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 table-detail-layanan">
                <thead class="">
                    <th class="border px-2 py-2">No</th>
                    <th class="border px-2 py-2">Kategori</th>
                    <th class="border px-2 py-2">Tipe</th>
                    <th class="border px-2 py-2">Bonus</th>
                </thead>
                <tbody>
                    <tr id="empty">
                       <td colspan="4" class="text-center"> Tidak ada kategori Layanan</td>
                    </tr>
                </tbody>
            </table>
            <div id="submit-button" class="mt-4 hidden">
                <x-button type="submit" id="tambah-layanan">Tambah Bonus Layanan</x-button>
            </div>
        </x-card-container>
        </form>
    </div>

    @push('js-internal')
        <script>

            $(function() {
                let url = `{{ route('kategori.get') }}`
                $('#doctor_category_id').on("select2:select", function (e) {
                    var data = e.params.data.text;
                    if(data=='Semua'){
                        $("#doctor_category_id > option").prop("selected","selected");
                        $("#doctor_category_id").trigger("change");
                    }
                });
                // fungsi button lanjutkan
                $('.lanjutkan').on('click',function(e) {
                    $('.table-detail-layanan tbody').empty();
                    let kategori = $("#doctor_category_id").val();
                    $(`#table-detail`).removeClass('hidden')
                    $('#submit-button').removeClass('hidden')

                    if (kategori.length == 0) {
                        var new_body_tr;
                        new_body_tr += `
                            <tr id="empty">
                                <td colspan="4" class="text-center"> Tidak ada kategori Layanan</td>
                            </tr>
                        `;
                        $('.table-detail-layanan tbody').append(new_body_tr);
                        $('#submit-button').addClass('hidden')
                    }
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                            type: "POST",
                            url: url,
                            data: {
                                kategori: JSON.stringify(kategori),
                            },
                            beforeSend: function () {

                            },
                            success: function (res) {
                                $('.table-detail-layanan').removeClass('hidden');
                                var new_body_tr = ``
                                let no = 1;
                                $.each(res,function(key,value) {
                                    new_body_tr += `
                                        <tr>
                                            <td class="border px-2 py-2">
                                                <span>${no++}</span>
                                            </td>
                                            <td class="border px-2 py-2">
                                                <span class="">${value.name}</span>
                                                <input name="id[]" value="${value.id}">
                                            </td>
                                            <td class="border px-2 py-2">
                                                <select
                                                    id="bonus_type"
                                                    name="bonus_type[]"
                                                    label="Tipe Bonus"
                                                    required
                                                    class="block w-full py-2 pl-3 pr-10 text-base bg-gray-50 border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md select-input bonus_type">
                                                    <option value="" selected disabled>Pilih Tipe Bonus</option>
                                                    <option value="percentage">Persentase</option>
                                                    <option value="nominal">Nominal</option>
                                                </select>
                                            </td>
                                            <td class="border px-2 py-2">
                                                <input id="bonus_rate" required name="bonus_rate[]" type="text" class="bg-gray-50 mt-3 border border-gray-300 text-gray-900 text-sm rounded-md focus:ring-blue-500 focus:border-blue-500 transition duration-300 block w-full p-2.2 bonus_rate">
                                            </td>
                                        </tr>
                                    `;
                                })
                                $('.table-detail-layanan tbody').append(new_body_tr);
                            },
                            complete: function () {
                                // Remove the loading message or indicator after the API call is complete
                            }
                    });

                })

                let tipPercentageTag = '<p class="mt-2 text-gray-500">Gunakan . (titik) untuk desimal</p>';
                let tipNominalTag = '<p class="mt-2 text-gray-500">Hanya angka</p>';


                $(document).on('change', '#bonus_type', function(e) {
                    var bonusRateInput = $(this).closest('td').next().find('.bonus_rate');
                    bonusRateInput.val('');
                    bonusRateInput.off('input');

                    if ($(this).val() == 'percentage') {
                        bonusRateInput.next().remove();
                        bonusRateInput.after(tipPercentageTag);
                        bonusRateInput.on('input', function() {
                            var value = $(this).val();
                            // Menghapus semua karakter yang bukan angka atau desimal
                            value = value.replace(/[^\d.]/g, '');
                            // Membatasi input hanya satu desimal
                            var decimalIndex = value.indexOf('.');
                            if (decimalIndex !== -1) {
                                value = value.substr(0, decimalIndex + 3);
                            }
                            // Menetapkan nilai input kembali
                            $(this).val(value);
                            if (parseFloat(value) > 100) {

                                $(this).val('');

                                Swal.fire({

                                    icon: 'error',

                                    title: 'Oops...',

                                    text: 'Nilai tidak boleh lebih dari 100',

                                });
                            }
                        });
                    } else {
                        bonusRateInput.next().remove();
                        bonusRateInput.after(tipNominalTag);
                        bonusRateInput.on('input', function() {
                            var value = $(this).val();
                            // Menghapus semua karakter yang bukan angka
                            value = value.replace(/[^\d]/g, '');
                            // Memformat sebagai mata uang
                            var formattedVal = 'Rp. ' + new Intl.NumberFormat('id-ID').format(value);
                            $(this).val(formattedVal);
                        });
                    }
                });

            });
        </script>
    @endpush
</x-app-layout>
