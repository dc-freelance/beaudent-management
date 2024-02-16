<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Pengguna', 'url' => route('admin.user-management.index')],
        ['name' => 'Ubah', 'url' => '#'],
    ]" title="Ubah Pengguna" />

    <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.user-management.update', $data->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="space-y-6 mb-6">
                    <x-input id="name" label="Nama" name="name" required value="{{ $data->name }}" />
                    <x-input id="email" label="Email" name="email" required value="{{ $data->email }}" />
                    <x-input id="phone_number" label="Nomor Telepon" name="phone_number" type="number" required
                        value="{{ $data->phone_number }}" />
                    <x-input id="join_date" label="Tanggal Bergabung" name="join_date" type="date" required
                        value="{{ $data->join_date }}" />
                    <div>
                        <p>Lokasi</p>
                        <div class="flex flex-wrap gap-6 mt-6">
                            <div class="flex items-center space-x-2">
                                <input type="radio" name="branch_type" id="pusat" value="pusat"
                                    {{ $data->branch_id === 1 ? 'checked' : '' }} class="radio radio-primary">
                                <label for="pusat">Pusat</label>
                            </div>
                            <div class="flex items-center space-x-2">
                                <input type="radio" name="branch_type" id="cabang" value="cabang"
                                    {{ $data->branch_id !== 1 ? 'checked' : '' }} class="radio radio-primary">
                                <label for="cabang">Cabang</label>
                            </div>
                        </div>
                    </div>
                    <div class="{{ $data->branch_id === 1 ? 'hidden' : '' }}">
                        <label for="branch" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Daftar Cabang
                        </label>
                        <select id="branch"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5"
                            name="branch_id">
                            <option value="" selected disabled>Pilih Cabang</option>
                            @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}"
                                    {{ $data->branch_id === $branch->id ? 'selected' : '' }}>
                                    {{ $branch->name }}
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <p>Role</p>
                        <div class="flex flex-wrap gap-6 mt-6">
                            @foreach ($roles as $role)
                                <div class="flex items-center space-x-2" id="role-{{ $role->name }}">
                                    <input type="radio" name="role" id="{{ $role->name }}"
                                        value="{{ $role->name }}" {{ $data->hasRole($role->name) ? 'checked' : '' }}
                                        class="radio radio-primary">
                                    <label
                                        for="{{ $role->name }}">{{ ucwords(str_replace('_', ' ', $role->name)) }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <x-button type="submit" class="mt-6">Simpan Perubahan</x-button>
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

                let branch_id = '{{ $data->branch_id }}';
                if (branch_id == 1) {
                    // hide admin cabang and manager cabang role
                    adminCabangRole.addClass('hidden');
                    managerCabangRole.addClass('hidden');
                } else {
                    // hide admin pusat and owner role
                    adminPusatRole.addClass('hidden');
                    ownerRole.addClass('hidden');
                }

                branchTypeInput.on('change', function() {
                    const selectedBranchType = $(this).val();

                    if (selectedBranchType === 'cabang') {
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
