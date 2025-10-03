<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Posyandu {{ $bulan }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: center; }
        th { background: #eee; }
    </style>
</head>
<body>
    <h3 style="text-align: center;">Laporan Rekap Data Posyandu Kecamatan Ciomas</h3>
    <p style="text-align: center;">Bulan: {{ \Carbon\Carbon::parse($bulan.'-01')->translatedFormat('F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Nama Desa</th>
                <th>Jumlah Posyandu</th>
                <th>Jumlah Kader</th>
                <th>Balita Normal</th>
                <th>Wasting</th>
                <th>Stunting</th>
                <th>Total Balita</th>
            </tr>
        </thead>
        <tbody>
            @foreach($rekap as $r)
            <tr>
                <td>{{ $r->nama_desa }}</td>
                <td>{{ $r->jumlah_posyandu ?? 0 }}</td>
                <td>{{ $r->jumlah_kader ?? 0 }}</td>
                <td>{{ $r->balita_normal ?? 0 }}</td>
                <td>{{ $r->wasting ?? 0 }}</td>
                <td>{{ $r->stunting ?? 0 }}</td>
                <td>{{ $r->total_balita ?? 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
