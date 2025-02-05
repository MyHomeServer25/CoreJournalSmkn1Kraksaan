<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Jurnal PKL</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; text-align: center; }
        .bold { font-weight: bold; }
        .underline { text-decoration: underline; }
    </style>
</head>
<body>
    <h2 style="text-align: center;"><span class="bold underline">Daftar Jurnal PKL</span></h2>

    <!-- Tabel Daftar Jurnal PKL -->
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th><span class="bold underline">Kegiatan</span></th>
                <th><span class="bold underline">Deskripsi</span></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($journals as $journal)
                <tr>
                    <td>{{ date('d-m-Y', strtotime($journal->date)) }}</td>
                    <td>{{ $journal->name }}</td>
                    <td>{{ $journal->description ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <table style="width: 100%; margin-top: 50px; text-align: center; border-collapse: collapse;">
        <tr>
            <td style="text-align: left; border: none;"><strong>{{ $teacherName }}</strong></td>
            <td style="text-align: right; border: none;"><strong>{{ $dudiName }}</strong></td>
        </tr>
        <tr>
            <td style="height: 30px; border: none;"></td>
            <td style="height: 30px; border: none;"></td>
        </tr>
            {{-- <td style="text-align: left; border: none;">({{ str_repeat('.', strlen($teacherName)) }})</td>
            <td style="text-align: right; border: none;">({{ str_repeat('.', strlen($dudiName)) }})</td> --}}
            <td style="text-align: left; border: none;">(..........)</td>
            <td style="text-align: right; border: none;">(............)</td>
        </tr>
    </table>
    </body>
</html>