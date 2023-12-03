<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OwnersExport implements FromCollection
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

    public function styles(Worksheet $sheet)
    {
        // Set the heading to bold
        $sheet->getStyle('A1:' . $sheet->getHighestColumn() . '1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
    }

    public function columnFormats(): array
    {
        // Set number format for the 'nohp' column
        return [
            'E' => NumberFormat::FORMAT_NUMBER,
        ];
    }
}
