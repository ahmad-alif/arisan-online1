<?php

namespace App\Exports;

use App\Models\Arisan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ArisansExport implements FromCollection, ShouldAutoSize, WithMapping, WithEvents, WithHeadings
{
    public function headings(): array
    {
        // Define column headings
        return [
            'No',
            'Nama Arisan',
            'Mulai',
            'Berakhir',
            'Status',
            'Active',
            'Max Member',
            'Frekuensi Setoran',
            'Total Setoran',
            'Nama Bank',
            'No Rekening',
            'Nama Pemilik Rekening',
            'Biaya Admin',
            'Dibuat Pada',
        ];
    }

    public function collection()
    {
        // Fetch data from the Arisan model where needed
        return Arisan::all();
    }

    public function registerEvents(): array
{
    return [
        AfterSheet::class => function (AfterSheet $event) {
            // Set font size to 12 and make it bold for all headers
            $cellRange = 'A1:W1'; // Adjust the range as needed
            $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12)->setBold(true);

            // Set the width for the 'No Rekening' column
            $event->sheet->getDelegate()->getColumnDimension('K')->setWidth(30);

            // Set custom number format for the 'No Rekening' column
            $event->sheet->getDelegate()
                ->getStyle('K2:K' . ($event->sheet->getDelegate()->getHighestRow()))
                ->getNumberFormat()
                ->setFormatCode('#,##');
        },
    ];
}

    public function columnFormats(): array
    {
        // Set number format for the relevant columns
        return [
            'G' => NumberFormat::FORMAT_NUMBER,
            'I' => NumberFormat::FORMAT_NUMBER,
            'J' => NumberFormat::FORMAT_NUMBER,
            'L' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function map($arisan): array
    {
        // Format the data for export
        return [
            'No' => $arisan->id_arisan,
            'Nama Arisan' => $arisan->nama_arisan,
            'Mulai' => $arisan->start_date,
            'Berakhir' => $arisan->end_date,
            'Status' => $arisan->status,
            'Active' => $arisan->active == 1 ? 'Aktif' : 'Mati',
            'Max Member' => $arisan->max_member,
            'Frekuensi Setoran' => $arisan->deposit_frequency,
            'Total Setoran' => $arisan->payment_amount,
            'Nama Bank' => $arisan->nama_bank,
            'No Rekening' => $arisan->no_rekening,
            'Nama Pemilik Rekening' => $arisan->nama_pemilik_rekening,
            'Biaya Admin' => $arisan->fee_admin,
            'Dibuat Pada' => $arisan->created_at,
        ];
    }
}
