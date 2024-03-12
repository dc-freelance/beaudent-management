<x-app-layout>
    <x-breadcrumb :links="[
        ['name' => 'Dashboard', 'url' => route('admin.dashboard.index')],
        ['name' => 'Manajemen Jadwal Dokter', 'url' => route('admin.doctor-schedule.index')],
        ['name' => 'Tambah Jadwal Dokter', 'url' => ''],
    ]" title="Tambah Jadwal Dokter" />

    {{-- <div class="lg:w-1/2">
        <x-card-container>
            <form action="{{ route('admin.doctor-schedule.store') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <p>Pilih Dokter</p>
                        <div class="mt-1">
                            <x-select
                                id="doctor_id"
                                name="doctor_id[]"
                                class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                multiple required>
                                @foreach ($doctor as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <div>
                        <p>Pilih Cabang</p>
                        <div class="mt-1">
                            <x-select id="branch_id" name="branch_id"
                                class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md select-input">
                                @foreach ($branch as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <x-input id="date" label="Tgl. Praktik" name="date" type="date" required />
                    <div>
                        <p>Sesi</p>
                        <div class="mt-1">
                            <select id="shift" name="shift"
                                class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md select-input">
                                <option value="Pagi">Pagi</option>
                                <option value="Sore">Sore</option>
                            </select>
                        </div>
                    </div>

                    <div class="max-md:w-full md:w-1/2 lg:w-1/3 xl:w-1/3 pt-5">
                        <x-button type="submit">Tambah Jadwal Dokter</x-button>
                    </div>
                </div>
            </form>
        </x-card-container>
    </div> --}}

    <div class="w-full">
        <x-card-container>
            <form action="{{ route('admin.doctor-schedule.create-multiple') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <p>Pilih Cabang</p>
                        <div class="mt-1">
                            <x-select id="branch_id" name="branch_id"
                                class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md select-input">
                                @foreach ($branch as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </x-select>
                        </div>
                    </div>
                    <x-input id="date" label="Atur Tanggal Mulai" name="date" type="date" required />

                    <div class="pt-3">
                        <div class="relative overflow-x-auto">
                            <table class="text-left w-full">
                                <thead class="bg-primary text-white">
                                    <tr class="w-full">
                                        <th class="p-4"><center>Sesi</center></th>
                                        <th class="p-4"><center>Hari ke-1</center></th>
                                        <th class="p-4"><center>Hari ke-2</center></th>
                                        <th class="p-4"><center>Hari ke-3</center></th>
                                        <th class="p-4"><center>Hari ke-4</center></th>
                                        <th class="p-4"><center>Hari ke-5</center></th>
                                        <th class="p-4"><center>Hari ke-6</center></th>
                                        <th class="p-4"><center>Hari ke-7</center></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-gray-100">
                                    <tr class="w-full">
                                        <th class="p-4"><center>Pagi</center></th>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_1_morning']['shift_time']" type="hidden" value="Pagi" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_1_morning']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_2_morning']['shift_time']" type="hidden" value="Pagi" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_2_morning']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_3_morning']['shift_time']" type="hidden" value="Pagi" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_3_morning']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_4_morning']['shift_time']" type="hidden" value="Pagi" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_4_morning']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_5_morning']['shift_time']" type="hidden" value="Pagi" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_5_morning']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_6_morning']['shift_time']" type="hidden" value="Pagi" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_6_morning']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_7_morning']['shift_time']" type="hidden" value="Pagi" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_7_morning']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="w-full">
                                        <th class="p-4"><center>Sore</center></th>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_1_afternoon']['shift_time']" type="hidden" value="Sore" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_1_afternoon']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_2_afternoon']['shift_time']" type="hidden" value="Sore" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_2_afternoon']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_3_afternoon']['shift_time']" type="hidden" value="Sore" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_3_afternoon']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_4_afternoon']['shift_time']" type="hidden" value="Sore" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_4_afternoon']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_5_afternoon']['shift_time']" type="hidden" value="Sore" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_5_afternoon']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_6_afternoon']['shift_time']" type="hidden" value="Sore" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_6_afternoon']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                        <td class="p-4">
                                            <x-input name="shift['shift_day_7_afternoon']['shift_time']" type="hidden" value="Sore" />
                                            <p>Pilih Dokter :</p>
                                            <div class="mt-1">
                                                <x-select
                                                    name="shift['shift_day_7_afternoon']['doctor_id'][]"
                                                    class="block w-full py-2 pl-3 pr-10 text-base border-gray-300 focus:outline-none focus:ring-primary focus:border-primary sm:text-sm rounded-md"
                                                    multiple required>
                                                    @foreach ($doctor as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </x-select>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="w-1/5">
                        <x-button type="submit">Tambah Jadwal Dokter</x-button>
                    </div>
                </div>
            </form>
        </x-card-container>
    </div>
</x-app-layout>
