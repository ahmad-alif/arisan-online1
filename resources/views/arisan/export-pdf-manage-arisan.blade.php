<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Arisan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
        }

        h3 {
            font-size: 15px; /* Adjust the font size for the heading */
            text-align: center; /* Center the text */
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
            background-color: #f7f7f7;
        }

        td:nth-child(3) {
            /* Mengatur maksimal lebar kolom deskripsi menjadi 10px */
            max-width: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        footer {
            text-align: center;
            padding: 3px;
            background-color: rgb(29, 26, 25);
            color: white;
        }
    </style>
</head>

<body>

    <h3>
        Daftar Arisan
    </h3>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Arisan</th>
                {{-- <th>Deskripsi</th> --}}
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
                    {{-- <td>{{ $arisan->deskripsi }}</td> --}}
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

    <footer>
        <p>© 2023 Media Sarana Digitalindo
        </p>
    </footer>

</body>

</html>
