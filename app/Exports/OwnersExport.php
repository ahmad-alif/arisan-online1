<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class OwnersExport implements FromCollection, ShouldAutoSize, WithEvents
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function headings(): array
    {
        // Define column headings
        return [
            'No',
            'Username',
            'Name',
            'Email',
            'No HP',
            'Status',
            'Bergabung pada'
            // Add other columns as needed
        ];
    }

    public function collection()
    {
        // Fetch data from the User model
        $userData = User::where('role', 1)->get(['username', 'name', 'email', 'nohp', 'active', 'created_at']);

        // Format the data for export
        $formattedData = [];

        foreach ($userData as $index => $user) {
            $formattedData[] = [
                '' => $index + 1,
                'username' => $user->username,
                'name' => $user->name,
                'email' => $user->email,
                'nohp' => $user->nohp,
                'active' => $user->active == 1 ? 'Aktif' : 'Belum Verifikasi',
                'created_at' => $user->created_at,
                // Add other columns as needed
            ];
        }

        return collect([$this->headings(), $formattedData]);
    }

    public function registerEvents(): array
{
    return [
        AfterSheet::class => function (AfterSheet $event) {
            // Set font size to 13 and make it bold for all headers
            $cellRange = 'A1:W1'; // Adjust the range as needed
            $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12)->setBold(true);
        },
    ];
}

    public function columnFormats(): array
    {
        // Set number format for the 'nohp' column
        return [
            'E' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
