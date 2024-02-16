<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Pengguna', 'url' => route('admin.user-management.index')],
        ['name' => 'Tambah', 'url' => '#'],
    ]" title="Tambah Pengguna" />

    <div class="w-1/2">
        <x-card-container>
            <form action="{{ route('admin.user-management.store') }}" method="post">
                @csrf
                <div class="space-y-6 mb-6">
                    <x-input id="name" label="Nama" name="name" required />
                    <x-input id="email" label="Email" name="email" required />
                    <x-input id="phone_number" label="Nomor Telepon" name="phone_number" type="number" required />
                    <x-input id="join_date" label="Tanggal Bergabung" name="join_date" type="date" required />
                    <div>
                        <p>Lokasi</p>
                        <div class="flex flex-wrap gap-6 mt-6">
                            <div class="flex items-center space-x-2">
                                <input type="radio" name="branch_type" id="pusat" value="pusat" checked
                                    class="radio radio-primary">
                                <label for="pusat">Pusat</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" name="branch_type" id="cabang" value="cabang"
                                    class="radio radio-primary">
                                <label for="cabang">Cabang</label>
                            </div>
                        </div>
                    </div>
                    <div class="hidden">
                        <label for="branch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Daftar Cabang
                        </label>
                        <select id="branch"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                            name="branch_id">
                            <option value="" selected disabled>Pilih Cabang</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <p>Role</p>
                        <div class="flex flex-wrap gap-6 mt-6">
                            @foreach ($roles as $role)
                                <div class="flex items-center space-x-2" id="role-{{ $role->name }}">
                                    <input type="radio" name="role" id="{{ $role->name }}"
                                        value="{{ $role->name }}" class="radio radio-primary">
                                    <label
                                        for="{{ $role->name }}">{{ ucwords(str_replace('_', ' ', $role->name)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <x-button type="submit" class="mt-6">Tambah Pengguna</x-button>
            </form>
        </x-card-container>
    </div>

    @push('js-internal')
        <script>
            $(function() {
                const branchTypeInput = $('input[name="branch_type"]');
                const branchSelect = $('#branch');
                const adminCabangRole = $('#role-admin_cabang');
                const managerCabangRole = $('#role-manager_cabang');
                const adminPusatRole = $('#role-admin_pusat');
                const ownerRole = $('#role-owner');

                adminCabangRole.addClass('hidden');
                managerCabangRole.addClass('hidden');

                branchTypeInput.on('change', function() {
                    const selectedBranchType = $(this).val();

                    if (selectedBranchType === 'cabang') {
                        // remove value branch_id
                        branchSelect.val('');
                        branchSelect.parent().removeClass('hidden');
                        adminCabangRole.removeClass('hidden');
                        managerCabangRole.removeClass('hidden');
                        adminPusatRole.addClass('hidden');
                        ownerRole.addClass('hidden');

                    } else {
                        // remove value branch_id
                        branchSelect.val('');
                        branchSelect.parent().addClass('hidden');
                        adminCabangRole.addClass('hidden');
                        managerCabangRole.addClass('hidden');
                        adminPusatRole.removeClass('hidden');
                    }
                });
            });
        </script>
    @endpush
</x-app-layout>
