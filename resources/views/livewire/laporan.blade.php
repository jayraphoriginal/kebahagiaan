<div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">

    </h2>

    <!-- With actions -->
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
        Laporan Penjualan Harian
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

            <div class="flex p-5 mb-10">
                <input type="date" wire:model="tglawal"
                    class="flex-1/2 mr-5 w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
                <input type="date" wire:model="tglakhir"
                class="flex-1/2 w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"/>
            </div>

            <h4>Total Penjualan  : {{ number_format($total,0,',','.') }}</h4>

            <div>
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3 text-right">Pembayaran</th>
                            <th class="px-4 py-3 text-right">Total</th>
                            <th class="px-4 py-3 text-right">Disc</th>
                            <th class="px-4 py-3 text-right">Grand Total</th>
                            <th class="px-4 py-3 text-right">Jumlah Bayar</th>
                            <th class="px-4 py-3 text-right">Kembalian</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($laporan->groupBy('m_invoice_id') as $invoices)

                        <tr class="ml-10 text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{ date_create($invoices[0]->created_at)->format('d-m-Y') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $invoices[0]->nama_pembayaran }}
                                </td>
                                <td class="px-4 py-3 text-sm text-right">
                                    {{ number_format($invoices[0]->total,0,',','.') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-right">
                                    {{ number_format($invoices[0]->disc,0,',','.') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-right">
                                    {{ number_format($invoices[0]->grandtotal,0,',','.') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-right">
                                    {{ number_format($invoices[0]->jumlah_bayar,0,',','.') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-right">
                                    {{ number_format($invoices[0]->kembalian,0,',','.') }}
                                </td>
                        </tr>
                        <thead>
                            <tr
                                class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                <td></td>
                                <th class="px-4 py-3">Nama Menu</th>
                                <th class="px-4 py-3 text-right">Jumlah</th>
                                <th class="px-4 py-3 text-right">Harga</th>
                                <th class="px-4 py-3 text-right">Subtotal</th>
                            </tr>
                        </thead>

                        @foreach ($invoices as $invoice)


                            <tr class="ml-10 text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">

                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $invoice->nama_menu }}
                                </td>
                                <td class="px-4 py-3 text-sm text-right">
                                    {{ $invoice->jumlah }}
                                </td>
                                <td class="px-4 py-3 text-sm text-right">
                                    {{ number_format($invoice->harga,0,',','.') }}
                                </td>
                                <td class="px-4 py-3 text-sm text-right">
                                    {{ number_format($invoice->harga*$invoice->jumlah,0,',','.') }}
                                </td>
                            </tr>

                        @endforeach
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div
            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">

        </div>
    </div>
</div>
