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

            <input type="date" wire:model="tglawal"/> <input type="date" wire:model="tglakhir"/>

            <div>
                <table class="w-full whitespace-no-wrap">
                    <thead>
                        <tr
                            class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Pembayaran</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Disc</th>
                            <th class="px-4 py-3">Grand Total</th>
                            <th class="px-4 py-3">Jumlah Bayar</th>
                            <th class="px-4 py-3">Kembalian</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                    @foreach ($laporan->groupBy('m_invoice_id') as $invoices)

                        <tr class="ml-10 text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{ $invoices[0]['Tanggal'] }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $invoices[0]['nana_pembayaran'] }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ number_format($invoices[0]['total'],0,',','.') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ number_format($invoices[0]['disc'],0,',','.') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ number_format($invoices[0]['grand_total'],0,',','.') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ number_format($invoices[0]['jumlah_bayar'],0,',','.') }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ number_format($invoices[0]['kembalian'],0,',','.') }}
                                </td>
                        </tr>

                        @foreach ($invoices as $invoice)

                            <tr class="ml-10 text-gray-700 dark:text-gray-400">
                                <td class="px-4 py-3 text-sm">
                                    {{ $item['nama_menu'] }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ $item['jumlah'] }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    {{ number_format($item['harga'],0,',','.') }}
                                </td>
                            </tr>

                        @endforeach
                    @endforeach
                    </tbody>
                </table>
                {{ $menu->links() }}
            </div>
        </div>
        <div
            class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">

        </div>
    </div>
</div>
