<div class="container grid px-6 mx-auto" x-data="{open : false}">
        <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
            
        </h2>

        <!-- With actions -->
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
            Stok Bahan
        </h4>

        <div class="w-full overflow-hidden rounded-lg shadow-xs p-3">
            <div class="w-full overflow-x-auto">
             
                <div>
                    @if (session()->has('message'))
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                {{ session('message') }}
                            </p>
                        </div>
                    @endif
                </div>

                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Nama Bahan</th>
                            <th class="px-4 py-3">Stok</th>
                            <th class="px-4 py-3">@if(Auth()->user()->level == 'owner') Actions @endif</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                        @foreach ($bahan as $item)
                        <tr wire:key="{{ $item->id }}" class="text-gray-700 dark:text-gray-400">
                            <td class="px-4 py-3 text-sm">
                                {{ $item->nama_bahan }}
                            </td>
                            <td class="px-4 py-3 text-sm">
                                {{ $item->stok }}
                            </td>
                            <td class="px-4 py-3">
                                @if(Auth()->user()->level == 'owner')
                                <div class="flex items-center space-x-4 text-sm">
                                    <button
                                        @click="open = true"
                                        wire:click="tambahStok({{ $item->id }})"
                                        class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                        aria-label="Tambah Stok"> 
                                        <svg class="h-5 w-5  viewBox="0 0 20 20"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round">  <line x1="12" y1="5" x2="12" y2="19" />  <line x1="5" y1="12" x2="19" y2="12" /></svg>
                                    </button>
                                </div>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div
                class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                {{ $bahan->links() }}
            </div>
        </div>

        <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
            <!-- Modal -->
            <div x-show="open" x-transition:enter="transition ease-out duration-150" x-transition:enter-start="opacity-0 transform translate-y-1/2" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="open = false" @keydown.escape="open = false" class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl" role="dialog" id="modal">
                <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                <header class="flex justify-end">
                    <button class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700" aria-label="close" @click="open = false">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img" aria-hidden="true">
                            <path d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                    </button>
                </header>
                <!-- Modal body -->
                <div class="mt-4 mb-6">
                    <!-- Modal title -->
                    <p class="mb-3 text-lg font-semibold text-gray-700 dark:text-gray-300">
                        Tambah Stok Bahan
                    </p>
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Nama Bahan</span>
                        <input wire:model="nama_bahan" readonly class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>
                    <!-- Modal description -->
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Stok</span>
                        <input wire:model="stok" readonly class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Penambahan</span>
                        <input wire:model="tambah" wire:keyup="hitung" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                        @error('tambah')
                            <span class="text-xs text-red-600 dark:text-red-400">
                                {{ $message }}
                            </span>
                        @enderror
                    </label>
                    <label class="block text-sm">
                        <span class="text-gray-700 dark:text-gray-400">Stok Akhir</span>
                        <input wire:model="stokakhir" readonly class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                    </label>
                </div>
                <footer class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                    <button @click="open =  false" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                        Cancel
                    </button>
                    <button @click="open = false " wire:click="save" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                        Save
                    </button>
                </footer>
            </div>
        </div>
    </div>