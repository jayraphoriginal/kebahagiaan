<div class="grid xs:grid-cols-none grid-cols-2 gap-2 p-5">
    
    <div>
        <input type="text" wire:model="search" class="px-3 py-2 w-full lg:w-1/2 mb-5 rounded-lg border-2 border-gray-300 focus:outline-black" placeholder="search">
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4 overflow-y-scroll">   
            <!-- Card -->
            @foreach ($menus as $item)
                <button wire:key="{{ $item->id }}" wire:click="add({{ $item->id }})" class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800 outline-none focus:outline-none">
                    <div class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                        <img src="https://ui-avatars.com/api/?size=512?background=&&name={{ str_replace(' ', '+', $item->nama_menu) }}">
                    </div>
                    <div>
                        <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            {{ $item->nama_menu }}
                        </p>
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                            {{ number_format($item->harga,0,',','.') }}
                        </p>
                    </div>
                </button>
            @endforeach
        </div>
    </div>

    <div>
        <div>
            @if (session()->has('message'))
                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ session('message') }}
                    </p>
                </div>
            @endif
        </div>
        <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">Order</h4>
        <table class="w-full whitespace-no-wrap mb-10">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-2 py-3">Nama menu</th>
                    <th class="px-2 py-3 text-center">Jumlah</th>
                    <th class="px-2 py-3 text-right">Harga</th>
                    <th class="px-2 py-3 text-right"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($tmp as $item)
                <tr wire:key="{{ 'tmp'.$item->id }}" class="text-gray-700 dark:text-gray-400">
                    <td class="px-2 py-3 text-sm">
                        {{ $item->nama_menu }}
                    </td>
                    <td class="px-2 py-3 text-sm text-center">
                        <button wire:click="decrease({{ $item->id }})" class="py-1 px-3 bg-red-700 rounded-md text-white">-</button>
                        <input class="px-1 py-2 w-10 text-center text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" type="number" value="{{ number_format($item->jumlah,0,',','.') }}">
                        <button wire:click="increase({{ $item->id }})" class="py-1 px-3 bg-green-700 rounded-md text-white">+</button>
                    </td>
                    <td class="px-2 py-3 text-sm text-right">
                        {{ number_format($item->harga,0,',','.') }}
                    </td>
                    <td class="px-2 py-3">
                        <div class="flex items-center space-x-4 text-sm">
                            <button
                
                            wire:click="delete({{ $item->id }})"
                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Delete">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="px-2 text-gray-600 dark:text-gray-300 my-2">
            Pembayaran : <select wire:model="pembayaran_id" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                            <option value="">-- Tipe Pembayaran --</option>
                            @foreach ($pembayarans as $pembayaran)
                                <option value="{{ $pembayaran->id }}">{{ $pembayaran->nama_pembayaran }}</option>
                            @endforeach
                        </select>
            @error('pembayaran_id')
                <span class="text-xs text-red-600 dark:text-red-400">
                    {{ $message }}
                </span>
            @enderror
        </div>

        <div class="px-2 text-gray-600 dark:text-gray-300 my-2">
            Total : <input type="text" wire:model="total" class="text-right block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" readonly>
            @error('total')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
            @enderror
        </div>
        
        <div class="px-2 text-gray-600 dark:text-gray-300 my-2">
            Bayar : <input wire:model="bayar" wire:keyup="numericFormat($event.key)" type="text" class="text-right block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
            @error('bayar')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
            @enderror
        </div>
        <div class="px-2 text-gray-600 dark:text-gray-300 my-2">
            Kembalian : <input wire:model="kembalian" type="text" class="text-right block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" readonly>
            @error('kembalian')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
            @enderror
        </div>
        
        <div class="w-full text-right mt-5">
            <button wire:click="save" class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                Save
            </button>
        </div>
    </div>
</div>
