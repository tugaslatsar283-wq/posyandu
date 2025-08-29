@extends('adminlte::page')

@section('title', 'Rekap Data Desa')

@section('content_header')
    <h1>Rekap Data Semua Desa</h1>
@stop

@section('content')
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Desa</th>
                <th>Periode</th>
                <th>Posyandu</th>
                <th>Kader</th>
                <th>Balita</th>
                <th>Stunting</th>
                <th>Wasting</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rekap as $desa)
                @if ($desa->dataDesa->isNotEmpty())
                    @php $data = $desa->dataDesa->first(); @endphp
                    <tr>
                        <td>{{ $desa->nama_desa }}</td>
                        <td>{{ $data->periode }}</td>
                        <td>{{ $data->jumlah_posyandu }}</td>
                        <td>{{ $data->jumlah_kader }}</td>
                        <td>{{ $data->jumlah_balita }}</td>
                        <td>{{ $data->jumlah_stunting }}</td>
                        <td>{{ $data->jumlah_wasting }}</td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $desa->nama_desa }}</td>
                        <td colspan="6">Belum ada data</td>
                    </tr>
                @endif
            @endforeach
        </tbody>
    </table>

    <hr>

    <h3>Grafik Perbandingan Stunting & Wasting</h3>
    <canvas id="chartRekap" height="100"></canvas>
@stop

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartRekap');
    const chartRekap = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($rekap->pluck('nama_desa')) !!},
            datasets: [
                {
                    label: 'Stunting',
                    data: {!! json_encode($rekap->map(fn($desa) => $desa->dataDesa->first()->jumlah_stunting ?? 0)) !!},
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                },
                {
                    label: 'Wasting',
                    data: {!! json_encode($rekap->map(fn($desa) => $desa->dataDesa->first()->jumlah_wasting ?? 0)) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@stop
