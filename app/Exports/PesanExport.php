<?php

namespace App\Exports;

use App\Models\Profit;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PesanExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Profit::get(['nomor_po', 'nama_perusahaan', 'nomor_invoice', 'date', 'biaya_operasional', 'total_jual', 'status', 'sum_profit', 'average_profit']);
    }
    public function headings(): array
    {
        return [
            'Nomor PO',
            'Nomor Perusahaan',
            'Nomor Invoice',
            'Date',
            'Biaya Operasional',
            'Total Profit',
            'Status',
            'Jumlah Profit',
            'Average Profit (%)',
        ];
    }
}
