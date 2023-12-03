<?php

// App\Exports\SetoranExport.php

namespace App\Exports;

use App\Models\Arisan;
use App\Models\Setoran;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SetoranExport implements FromCollection
{
    public function headings(): array
    {
        return [
            'No',
            'Invoice Number',
            'Arisan Name',
            'Bukti Setoran',
            'Status',
            'Created At',
        ];
    }

    public function collection()
    {
        $setoranData = Setoran::all(['id', 'invoice_number', 'uuid', 'bukti_setoran', 'status', 'created_at']);

        $formattedData = [];

        foreach ($setoranData as $index => $setoran) {
            // Get Arisan name based on the UUID
            $arisan = Arisan::where('uuid', $setoran->uuid)->first();

            $formattedData[] = [
                '' => $index + 1,
                'invoice_number' => $setoran->invoice_number,
                'arisan_name' => $arisan ? $arisan->nama_arisan : 'Unknown Arisan',
                'bukti_setoran' => $setoran->bukti_setoran,
                'status' => $setoran->status,
                'created_at' => $setoran->created_at,
                // Add other columns as needed
            ];
        }

        return collect([$this->headings(), $formattedData]);
    }

    public function map($setoran): array
    {
        // Get the image URL
        $imagePath = asset('storage/bukti_setoran/' . $setoran['bukti_setoran']);

        return [
            $setoran['id'],
            $setoran['invoice_number'],
            $setoran['arisan_name'],
            $imagePath,
            $setoran['status'],
            $setoran['created_at'],
            // Add other columns as needed
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }
}
