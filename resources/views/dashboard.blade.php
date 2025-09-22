@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
      {{-- Jumlah Posyandu --}}
      <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
              <div class="inner">
                  <h3>{{ $jumlahPosyandu ?? 0 }}</h3>
                  <p>Jumlah Posyandu</p>
              </div>
              <div class="icon"><i class="fas fa-clinic-medical"></i></div>
          </div>
      </div>

      {{-- Jumlah Desa --}}
      <div class="col-lg-3 col-6">
          <div class="small-box bg-warning">
              <div class="inner">
                  <h3>{{ $jumlahDesa ?? 0 }}</h3>
                  <p>Jumlah Desa</p>
              </div>
              <div class="icon"><i class="fas fa-map-marked-alt"></i></div>
          </div>
      </div>

      {{-- Jumlah Kader --}}
      <div class="col-lg-3 col-6">
          <div class="small-box bg-primary">
              <div class="inner">
                  <h3>{{ $jumlahKader ?? 0 }}</h3>
                  <p>Jumlah Kader</p>
              </div>
              <div class="icon"><i class="fas fa-user-nurse"></i></div>
          </div>
      </div>
  </div>

  <div class="row">
    <!-- Stacked Bar Chart -->
    <div class="col-md-6">
      <div class="card mt-4">
        <div class="card-header bg-info text-white">
          <h3 class="card-title">Status Gizi Balita (6 Bulan Terakhir)</h3>
        </div>
        <div class="card-body">
          <canvas id="statusGiziChart" style="height:250px;"></canvas>
        </div>
      </div>
    </div>

    <!-- Line Chart -->
    <div class="col-md-6">
      <div class="card mt-4">
        <div class="card-header bg-primary text-white">
          <h3 class="card-title">Tren Jumlah Balita 6 Bulan Terakhir</h3>
        </div>
        <div class="card-body">
          <canvas id="lineChart" style="height:250px;"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- Grafik per Desa --}}
<div class="card mt-4">
    <div class="card-header">
        <h5>Grafik Stunting & Wasting per Desa</h5>
    </div>
    <div class="card-body">
        <div class="mb-3">
            <label for="filterBulan">Pilih Bulan:</label>
           <select id="filterBulan" class="form-control" style="width:200px; display:inline-block;">
    <option value="all">Semua Bulan</option>
    @foreach ($bulanOptions as $value => $label)
        <option value="{{ $value }}">{{ $label }}</option>
    @endforeach
</select>
        </div>
        <div id="desaChart"></div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<!-- ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    // === Chart.js Data ===
    const bulan   = {!! json_encode($dataGizi->pluck('bulan')) !!};
    const normal  = {!! json_encode($dataGizi->pluck('normal')) !!};
    const wasting = {!! json_encode($dataGizi->pluck('wasting')) !!};
    const stunting= {!! json_encode($dataGizi->pluck('stunting')) !!};
    const total   = {!! json_encode($dataGizi->pluck('total')) !!};

    // === Stacked Bar Chart ===
    new Chart(document.getElementById('statusGiziChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: bulan,
            datasets: [
                { label: 'Normal', data: normal, backgroundColor: 'rgba(54, 162, 235, 0.8)' },
                { label: 'Wasting', data: wasting, backgroundColor: 'rgba(255, 99, 132, 0.8)' },
                { label: 'Stunting', data: stunting, backgroundColor: 'rgba(255, 206, 86, 0.8)' }
            ]
        },
        options: {
            responsive: true,
            plugins: { title: { display: true, text: 'Distribusi Status Gizi Balita' } },
            scales: {
                x: { stacked: true },
                y: { stacked: true, beginAtZero: true, title: { display: true, text: 'Jumlah Balita' } }
            }
        }
    });

    // === Line Chart ===
    new Chart(document.getElementById('lineChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: bulan,
            datasets: [{
                label: 'Jumlah Balita',
                data: total,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                tension: 0.4,
                fill: true,
                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            plugins: { title: { display: true, text: 'Grafik Perkembangan Jumlah Balita' } },
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Jumlah' } },
                x: { title: { display: true, text: 'Bulan' } }
            }
        }
    });

    // === ApexCharts per Desa dengan Filter Bulan ===
    let chart;

    function loadChart(bulan = 'all') {
        fetch("{{ url('/gizi/chart-data-all-desa') }}?bulan=" + bulan)
            .then(response => response.json())
            .then(data => {
                let options = {
                    chart: { type: 'bar', height: 400 },
                    plotOptions: { bar: { horizontal: false, columnWidth: '55%', endingShape: 'rounded' } },
                    series: [
                        { name: 'Stunting', data: data.map(d => d.stunting) },
                        { name: 'Wasting', data: data.map(d => d.wasting) }
                    ],
                    xaxis: { categories: data.map(d => d.desa) },
                    colors: ['#E74C3C', '#3498DB'],
                    noData: { text: "Tidak ada data untuk bulan ini" }
                };

                if (chart) {
                    chart.updateOptions(options, true, true);
                } else {
                    chart = new ApexCharts(document.querySelector("#desaChart"), options);
                    chart.render();
                }
            });
    }

    // pertama kali load
    loadChart();

    // Event filter
    document.getElementById('filterBulan').addEventListener('change', function () {
        loadChart(this.value);
    });
});
</script>
@endpush
