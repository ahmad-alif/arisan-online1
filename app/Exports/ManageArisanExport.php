<?php

namespace App\Exports;

use App\Models\Arisan;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ManageArisanExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function headings(): array
    {
        // Menentukan judul kolom
        return [
            'No',
            'Nama Arisan',
            'Mulai',
            'Berakhir',
            'Deskripsi',
            'Maksimal Member',
            'Frekuensi Setoran',
            'Nominal Setoran',
            'Nama Bank',
            'No Rekening',
            'Nama Pemilik',
            'Biaya Admin',
            'Dibuat Pada',
        ];
    }

    public function collection()
    {
        // Mengambil data dari model Arisan
        $arisanData = Arisan::all();

        // Memformat data yang akan di-export
        $formattedData = [];

        foreach ($arisanData as $index => $arisan) {
            $formattedData[] = [
                '' => $index + 1,
                'nama_arisan' => $arisan->nama_arisan,
                'start_date' => $arisan->start_date,
                'end_date' => $arisan->end_date,
                'deskripsi' => $arisan->deskripsi,
                'max_member' => $arisan->max_member,
                'deposit_frequency' => $arisan->deposit_frequency,
                'payment_amount' => $arisan->payment_amount,
                'nama_bank' => $arisan->nama_bank,
                'no_rekening' => $arisan->no_rekening,
                'nama_pemilik_rekening' => $arisan->nama_pemilik_rekening,
                'created_at' => $arisan->created_at,
                // Tambahkan kolom lain sesuai kebutuhan
            ];
        }

        return collect([$this->headings(), $formattedData]);
    }

    public function styles(Worksheet $sheet)
    {
        // Mengatur heading untuk bold
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}
