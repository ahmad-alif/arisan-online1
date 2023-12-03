<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Arisan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        td:nth-child(3) {
            /* Mengatur maksimal lebar kolom deskripsi menjadi 10px */
            max-width: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
    </style>
</head>

<body>

    <h2>
        Daftar Arisan
    </h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Arisan</th>
                <th>Deskripsi</th>
                <th>Maks Member</th>
                <th>Mulai</th>
                <th>Berakhir</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($arisans as $arisan)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $arisan->nama_arisan }}</td>
                    <td>{{ $arisan->deskripsi }}</td>
                    <td>{{ $arisan->max_member }}</td>
                    <td>{{ $arisan->start_date }}</td>
                    <td>
                        @if ($arisan->status == 2 && $arisan->active == 0)
                            Suspended
                        @else
                            {{ $arisan->end_date }}
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
