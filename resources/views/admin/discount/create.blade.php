<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Diskon', 'url' => route('admin.discount.index')],
        ['name' => 'Tambah Diskon', 'url' => ''],
    ]" title="Tambah Diskon" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.discount.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <x-input id="name" label="Nama" name="name" required />
                    <div>
                        <label for="discount_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Tipe Diskon
                        </label>
                        <select id="discount_type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                            name="discount_type">
                            <option value="Percentage">Persentase</option>
                            <option value="Nominal">Nominal</option>
                        </select>
                    </div>
                    <x-input id="discount" label="Diskon" name="discount" type="number" required />
                    <x-input id="start_date" label="Awal Periode Diskon" name="start_date" type="date" required />
                    <x-input id="end_date" label="Akhir Periode Diskon" name="end_date" type="date" required />
                    <div>
                        <label for="control_list" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Status
                        </label>
                        <select id="control_list"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                            name="is_active">
                            <option value="1">Aktif</option>
                            <option value="0">Tidak Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6">
                    <x-button type="submit">Tambah Diskon</x-button>
                </div>
            </form>
        </x-card-container>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const discountTypeSelect = document.getElementById('discount_type');
            const discountInput = document.getElementById('discount');
            const discountMessage = document.getElementById('discount_message');

            // Fungsi untuk memformat nilai saat jenis diskon adalah "Nominal"
            function formatNominalValue(value) {
                const formattedValue = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR'
                }).format(value);

                return formattedValue;
            }

            // Fungsi untuk menghapus format "Rp " dari nilai saat jenis diskon adalah "Nominal"
            function removeRpFormat(value) {
                return value.replace('Rp ', '').replace('.', '').replace(',', '.');
            }

            // Fungsi untuk memperbarui tampilan input berdasarkan jenis diskon
            function updateDiscountFormat() {
                const selectedDiscountType = discountTypeSelect.value;
                const discountValue = parseFloat(removeRpFormat(discountInput.value));

                if (selectedDiscountType === 'Nominal') {
                    discountInput.value = formatNominalValue(discountValue);
                } else {
                    // Kembalikan nilai ke format angka biasa
                    discountInput.value = discountValue;
                }
            }

            // Fungsi untuk menampilkan pesan diskon jika lebih dari 100%
            function showDiscountMessage() {
                const selectedDiscountType = discountTypeSelect.value;
                const discountValue = parseFloat(removeRpFormat(discountInput.value));

                if (selectedDiscountType === 'Percentage' && (discountValue > 100 || discountValue < 0)) {
                    discountMessage.textContent = 'Maksimal diskon 100%';
                } else {
                    discountMessage.textContent = '';
                }
            }

            // Panggil fungsi saat halaman dimuat dan saat jenis diskon berubah
            document.addEventListener('change', function() {
                updateDiscountFormat();
                showDiscountMessage();
            });

            // Panggil fungsi saat nilai input diskon berubah
            discountInput.addEventListener('input', function() {
                updateDiscountFormat();
                showDiscountMessage();
            });

            // Validasi untuk memastikan persentase diskon tidak melebihi 100%
            const discountForm = document.querySelector('form');
            discountForm.addEventListener('submit', function(event) {
                const selectedDiscountType = discountTypeSelect.value;
                const discountValue = parseFloat(removeRpFormat(discountInput.value));

                if (selectedDiscountType === 'Percentage' && (discountValue > 100 || discountValue < 0)) {
                    event.preventDefault(); // Mencegah pengiriman formulir jika persentase tidak valid
                    alert('Persentase diskon harus di antara 0 dan 100.');
                }
            });
        });
    </script>
</x-app-layout>
