<?php

namespace App\Exports;

use App\Models\Arisan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ArisansExport implements FromCollection, WithHeadings, WithMapping
{
    public function headings(): array
    {
        // Define column headings
        return [
            'No',
            'Nama Arisan',
            'Gambar Arisan',
            'Mulai',
            'Berakhir',
            'Deskripsi',
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
        // Fetch data from the Arisan model
        return Arisan::all();
    }

    public function map($arisan): array
    {
        // Format the data for export
        return [
            'No' => $arisan->id,
            'Nama Arisan' => $arisan->nama_arisan,
            'Gambar Arisan' => $arisan->img_arisan,
            'Mulai' => $arisan->start_date,
            'Berakhir' => $arisan->end_date,
            'Deskripsi' => $arisan->deskripsi,
            'Status' => $arisan->status,
            'Active' => $arisan->active == 1 ? 'Aktif' : 'Mati',
            'Max Member' => $arisan->max_member,
            'Deposit Frequency' => $arisan->deposit_frequency,
            'Payment Amount' => $arisan->payment_amount,
            'Nama Bank' => $arisan->nama_bank,
            'No Rekening' => $arisan->no_rekening,
            'Nama Pemilik Rekening' => $arisan->nama_pemilik_rekening,
            'Biaya Admin' => $arisan->fee_admin,
            'Dibuat Pada' => $arisan->created_at,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Set the heading to bold
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);

        // Set number format for specific columns
        $sheet->getStyle('E2:E' . $sheet->getHighestRow())->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
        $sheet->getStyle('O2:O' . $sheet->getHighestRow())->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DATETIME);
    }
}
