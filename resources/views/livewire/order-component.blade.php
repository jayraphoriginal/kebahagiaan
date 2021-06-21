<div class="grid xs:grid-cols-none grid-cols-2 gap-2 p-5" x-data="{showprint: $wire.showprint}">
    <div>
        <input type="text" wire:model="search" class="px-3 py-2 w-full lg:w-1/2 mb-5 rounded-lg border-2 border-gray-300 focus:outline-black" placeholder="search">
        <div class="grid gap-6 mb-8 md:grid-cols-3 xl:grid-cols-4">
            <!-- Card -->
            @foreach ($menus as $item)
                <button wire:key="{{ $item->id }}" wire:click="add({{ $item->id }})" class="items-center p-0 bg-white rounded-lg shadow-xs dark:bg-gray-800 outline-none focus:outline-none">
                    @if(empty($item->picture))
                        <div class="text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <img src="https://ui-avatars.com/api/?size=512?background=&&name={{ str_replace(' ', '+', $item->nama_menu) }}">
                        </div>
                    @else
                        <div class="text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                            <img src="{{ asset('/storage/'.$item->picture) }}" width="512">
                        </div>
                    @endif
                    <div>
                        <p class="block m-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                            {{ $item->nama_menu }}
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
        <table class="whitespace-no-wrap mb-10 w-full">
            <thead>
                <tr
                    class="text-xs font-semibold tracking-tight text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                    <th class="px-2 py-3 break-words w-auto h-auto">Nama menu</th>
                    <th class="px-2 py-3 text-center">Jumlah</th>
                    <th class="px-2 py-3 text-right">Harga</th>
                    <th class="py-3 text-right"></th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                @foreach ($tmp as $item)
                <tr wire:key="{{ 'tmp'.$item->id }}" class="text-gray-700 dark:text-gray-400">
                    <td class="px-2 py-3 text-sm h-10 break-words ">
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
                    <td class=" y-3 text-right">
                        <button
                            wire:click="delete({{ $item->id }})"
                                class="flex items-center justify-between py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                aria-label="Delete">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                    viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                        clip-rule="evenodd"></path>
                                </svg>
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
            Disc : <input wire:model="disc" wire:keyup="numericFormat($event.key)" type="text" class="text-right block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
            @error('disc')
                    <span class="text-xs text-red-600 dark:text-red-400">
                        {{ $message }}
                    </span>
            @enderror
        </div>

        <div class="px-2 text-gray-600 dark:text-gray-300 my-2">
            GrandTotal : <input type="text" wire:model="grandtotal" class="text-right block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" readonly>
            @error('grandtotal')
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


    <div x-show="$wire.showprint" class="flex flex-col p-8 bg-white shadow-md hover:shodow-lg rounded-2xl absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="w-16 h-16 rounded-2xl p-3 border border-blue-200 text-blue-600 bg-blue-100" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="flex flex-col ml-3">
                    <div class="font-medium leading-none">Print Nota ?</div>
                </div>
            </div>
            <a href="/invoice/{{ encrypt($invoice_id) }}" target="_blank" mat-icon-button="" @click="$wire.showprint = false" @click.away="$wire.showprint=false" class="flex-no-shrink bg-white px-5 ml-4 py-2 text-sm shadow-sm font-medium
            tracking-wider border-2 border-green-400 text-green-400 rounded-full hover:text-white hover:bg-green-500">Print</a>
        </div>
    </div>
</div>
