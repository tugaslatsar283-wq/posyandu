@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
      {{-- Total Balita --}}
      <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
              <div class="inner">
                  <h3></h3>
                  <p>Total Balita</p>
              </div>
              <div class="icon"><i class="fas fa-child"></i></div>
          </div>
      </div>

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
@endsection

@push('scripts')
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const bulan   = {!! json_encode($dataGizi->pluck('bulan')) !!};
    const normal  = {!! json_encode($dataGizi->pluck('normal')) !!};
    const wasting = {!! json_encode($dataGizi->pluck('wasting')) !!};
    const stunting= {!! json_encode($dataGizi->pluck('stunting')) !!};
    const total   = {!! json_encode($dataGizi->pluck('total')) !!};

    // === Stacked Bar Chart ===
    const ctxBar = document.getElementById('statusGiziChart').getContext('2d');
    new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: bulan,
            datasets: [
                {
                    label: 'Normal',
                    data: normal,
                    backgroundColor: 'rgba(54, 162, 235, 0.8)'
                },
                {
                    label: 'Wasting',
                    data: wasting,
                    backgroundColor: 'rgba(255, 99, 132, 0.8)'
                },
                {
                    label: 'Stunting',
                    data: stunting,
                    backgroundColor: 'rgba(255, 206, 86, 0.8)'
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                title: {
                    display: true,
                    text: 'Distribusi Status Gizi Balita'
                }
            },
            scales: {
                x: { stacked: true },
                y: {
                    stacked: true,
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah Balita'
                    }
                }
            }
        }
    });

    // === Line Chart ===
    const ctxLine = document.getElementById('lineChart').getContext('2d');
    new Chart(ctxLine, {
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
            plugins: {
                legend: { position: 'top' },
                title: {
                    display: true,
                    text: 'Grafik Perkembangan Jumlah Balita'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Jumlah'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Bulan'
                    }
                }
            }
        }
    });
});
</script>
@endpush
