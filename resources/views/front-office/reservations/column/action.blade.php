<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beaudent Doctor</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Dark background for the modal */
        .modal-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            /* Semi-transparent black background */
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 50;
            /* Ensure it is above other content */
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s linear;
        }

        .modal-background.show {
            visibility: visible;
            opacity: 1;
        }

        /* Center the modal card */
        .modal-card {
            background-color: white;
            border-radius: 0.5rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            padding: 1rem;
            z-index: 100;
            /* Ensure it is above the background */
        }
    </style>
</head>

<body>
    <div class="lg:flex gap-x-2">
        @if ($data->status === 'Confirm')
            @can('reschedule_reservation')
                @role('frontoffice')
                    <div></div>
                @else
                    <a href="{{ route('front-office.reservations.confirm.reschedule', $data->id) }}"
                        class="text-white bg-orange-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
                        Jadwal ulang
                    </a>
                @endrole
            @endcan
            @can('detail_reservation')
                @role('frontoffice')
                    <div id="check-modal-{{ $data->id }}" class="modal-background">
                        <div class="modal-card relative">
                            <button type="button"
                                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                                data-modal-hide="check-modal">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Tutup</span>
                            </button>
                            <form method="POST" action="{{ route('front-office.reservation.queue', $data->id) }}"
                                class="p-4 md:p-5">
                                @csrf
                                <h3 class="mb-5 text-lg font-normal">Pilih dokter untuk pemeriksaan</h3>
                                <x-select id="doctor_id" name="doctor_id">
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                    @endforeach
                                </x-select>
                                <button data-modal-hide="check-modal" type="button"
                                    class="py-2.5 px-5 mt-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-gray-700 focus:z-10 focus:ring-4 focus:ring-gray-100">Batalkan</button>
                                <button type="submit"
                                    class="py-2.5 px-5 ms-1 mt-3 text-sm font-medium text-white focus:outline-none bg-green-600 rounded-lg border border-green-200 hover:bg-green-600 hover:text-white focus:z-10 focus:ring-4 focus:ring-green-600">
                                    Pilih
                                </button>
                            </form>
                        </div>
                    </div>
                    <button data-modal-target="check-modal-{{ $data->id }}"
                        data-modal-toggle="check-modal-{{ $data->id }}"
                        class="text-white bg-green-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center"
                        type="button">
                        Periksa
                    </button>
                    <a href="{{ route('front-office.reservations.confirm.detail', $data->id) }}"
                        class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
                        Detail
                    </a>
                @else
                    <a href="{{ route('front-office.reservations.confirm.detail', $data->id) }}"
                        class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
                        Detail
                    </a>
                @endrole
            @endcan
        @elseif ($data->status === 'Pending')
            @can('detail_reservation')
                <a href="{{ route('front-office.reservations.wait.detail', $data->id) }}"
                    class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
                    Detail
                </a>
            @endcan
        @else
            @can('detail_reservation')
                <a href="{{ route('front-office.reservations.cancel.detail', $data->id) }}"
                    class="text-white bg-blue-400 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center">
                    Detail
                </a>
            @endcan
        @endif

        @if ($data->status !== 'Done' && $data->status !== 'Cancel')
            @can('delete_reservation')
                @role('frontoffice')
                    <div></div>
                @else
                    <label onclick="btnDelete('{{ $data->id }}', '{{ $data->name }}')"
                        class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-md text-sm p-2 text-center inline-flex items-center cursor-pointer">
                        Batal
                    </label>
                @endrole
            @endcan
        @endif
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(function() {
            $('select.select-input').select2({
                width: '100%',
                // placeholder: " -- Pilih Data -- ",
            });
        });

        // Initialize modal functionality
        document.querySelectorAll('[data-modal-toggle]').forEach((toggle) => {
            toggle.addEventListener('click', function() {
                const targetModalId = toggle.getAttribute('data-modal-target');
                const targetModal = document.getElementById(targetModalId);
                targetModal.classList.add('show');
            });
        });

        document.querySelectorAll('[data-modal-hide]').forEach((closeButton) => {
            closeButton.addEventListener('click', function() {
                const modal = closeButton.closest('.modal-background');
                modal.classList.remove('show');
            });
        });
    </script>

    @stack('js-internal')

</body>

</html>
