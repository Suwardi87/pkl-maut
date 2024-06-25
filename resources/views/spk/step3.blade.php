<x-app-layout>
    <div class="py-1">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container px-36 py-10">
                    <div class="flex justify-between mb-1">
                        <span class="text-base font-medium text-teal-700">3. Alternatif</span>
                        <span class="text-sm font-medium text-teal-700">30%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5">
                        <div class="bg-teal-600 h-2.5 rounded-full" style="width: 45%"></div>
                    </div>

                    <div class="relative my-10 overflow-x-auto">
                        <!-- tambah -->
                        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                            class="block text-white bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                            type="button">
                            Tambah
                        </button>
                        <div class="flex p-4 my-4 text-sm text-teal-800 rounded-lg bg-teal-50 dark:bg-gray-800 dark:text-teal-400"
                            role="alert">
                            <svg class="flex-shrink-0 inline w-4 h-4 me-3 mt-[2px]" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div>
                                <span class="font-medium">Aturan Alternatif:</span>
                                <ul class="mt-1.5 list-disc list-inside">
                                    <li>Tambahkan semua alternatif dengan cara klik tombol tambah.</li>
                                    <li>Setiap alternatif harus diberikan bobot untuk setiap kriteria yang ada dengan
                                        nilai dari 1 hingga 5.</li>
                                    <li>Pemberian bobot tidak hanya mengikuti aturan kedua.</li>
                                </ul>
                            </div>
                        </div>


                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">No</th>
                                        <th scope="col" class="px-6 py-3">Nama Supplier</th>
                                        <th scope="col" class="px-6 py-3">Kriteria</th>
                                        <th scope="col" class="px-6 py-3">Bobot</th>
                                        {{-- <th scope="col" class="px-6 py-3">Aksi</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $groupedData = $dataSupplier->groupBy('nama_supplier');
                                    @endphp
                                    @foreach ($groupedData as $supplierName => $group)
                                        @php
                                            $rowspan = $group->count();
                                        @endphp
                                        @foreach ($group as $index => $supplier)
                                            <tr class="bg-white border-b">
                                                @if ($index === 0)
                                                    <td rowspan="{{ $rowspan }}"
                                                        class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                                        {{ $loop->parent->iteration }}
                                                    </td>
                                                    <td rowspan="{{ $rowspan }}" class="px-6 py-4">
                                                        {{ $supplierName }}
                                                    </td>
                                                @endif
                                                <td class="px-6 py-4">
                                                    {{ $supplier->nama_kriteria }}
                                                </td>
                                                <td class="px-6 py-4">
                                                    {{ $supplier->bobot }}
                                                </td>
                                                {{-- <td class="px-6 py-4">
                                                    <!-- Add action buttons as needed -->
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="container px-4 py-10">
                                @include('spk.pagination')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</x-app-layout>




<!-- Main modal -->
<div id="crud-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                <h3 class="text-lg font-semibold text-gray-900">
                    Tambahkan alternatif
                </h3>
                <button type="button"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-toggle="crud-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form class="p-4 md:p-5" action="{{ route('supplier.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 mb-4 grid-cols-2">
                    <div class="col-span-2">
                        <label for="nama_supplier" class="block mb-2 text-sm font-medium text-gray-900">
                            Nama Supplier
                        </label>
                        <input type="text" id="nama_supplier" name="nama_supplier"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5"
                            placeholder="Masukkan nama supplier" required>
                    </div>

                    @foreach ($dataKriteria as $kriteria)
                        <div class="col-span-2">
                            <label for="bobots_id_{{ $kriteria->id }}"
                                class="block mb-2 text-sm font-medium text-gray-900">
                                {{ $kriteria->nama_kriteria }} Bobot
                            </label>
                            <input type="number" id="bobots_id_{{ $kriteria->id }}"
                                name="bobots_id_{{ $kriteria->id }}"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5">
                        </div>
                    @endforeach
                </div>
                <button type="submit"
                    class="text-white inline-flex items-center bg-teal-700 hover:bg-teal-800 focus:ring-4 focus:outline-none focus:ring-teal-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                    Tambah Alternatif
                </button>
            </form>
        </div>
    </div>
</div>