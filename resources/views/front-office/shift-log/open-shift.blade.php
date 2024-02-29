<x-app-layout>
    <x-breadcrumb :links="[['name' => 'Dashboard', 'url' => route('admin.dashboard.index')], ['name' => 'Buka Sesi', 'url' => '']]" title="Buka Sesi" />

    <div class="lg:w-1/2">
        <x-card-container>
            @if ($checking == null)
                <form action="{{ route('front-office.shift-log.open-shift-create') }}" method="POST">
                    @csrf
                    <div class="space-y-6">
                        <div>
                            <p>Sesi :</p>
                            <div class="mt-2">
                                <select id="shift_id" name="shift_id"
                                    class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    @foreach ($configShift as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }} -
                                            ({{ $item->start_time }} - {{ $item->end_time }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <x-input id="user" label="Pengguna Aktif" name="user"
                            value="{{ auth()->user()->name }} - {{ auth()->user()->branch ? '(' . auth()->user()->branch->code . ' - ' . auth()->user()->branch->name . ')' : ' (Cabang Tidak Ditemukan)' }}"
                            readonly="readonly" />

                    </div>
                    <div class="max-md:w-2/3 max-md:mx-auto md:w-1/4 lg:w-1/4 xl:1/4 pt-5">
                        <x-button type="submit">Buka Sesi</x-button>
                    </div>
                </form>
            @else
                <div>
                    <div class="space-y-6">
                        <div>
                            <h5 class="mb-3"><b>Sesi Sudah Dibuka Pada :</b></h5>
                            <p>Sesi :</p>
                            <div class="mt-2">
                                <select id="shift_id" name="shift_id"
                                    class="block py-3 pl-3 pr-10 w-full text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md"
                                    disabled>
                                    @foreach ($configShift as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $checking->config_shift_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }} - ({{ $item->start_time }} - {{ $item->end_time }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <x-input id="user" label="Pengguna Aktif :" name="user"
                            value="{{ auth()->user()->name }} - ({{ auth()->user()->branch->code }} - {{ auth()->user()->branch->name }})"
                            readonly="readonly" />
                        <x-input id="start_time" label="Dibuka Pada :" name="start_time" type="datetime-local"
                            value="{{ $checking->start_time }}" readonly="readonly" />
                    </div>
                </div>
            @endif
        </x-card-container>
    </div>
    @push('js-internal')
        <script>
            @error('success')
                Swal.fire('Berhasil!', '{{ $message }}', 'success');
            @enderror

            @error('error')
                Swal.fire('Gagal!', '{{ $message }}', 'error');
            @enderror

            @include('components.flash-message')
        </script>
    @endpush
</x-app-layout>
