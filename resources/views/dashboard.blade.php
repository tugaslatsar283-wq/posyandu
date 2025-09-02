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
                <h3>{{ $jumlahBalita ?? 0 }}</h3>
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
  <!-- Grafik 1 -->
  <div class="col-md-6">
    <div class="card mt-4">
      <div class="card-header bg-info text-white">
        <h3 class="card-title">Status Gizi Balita</h3>
      </div>
      <div class="card-body">
        <canvas id="statusGiziChart" style="height:250px;"></canvas>
      </div>
    </div>
  </div>

  <div class="row">
  <!-- Line Chart -->
  <div class="col-md-6">
    <div class="card mt-4">
      <div class="card-header bg-info text-white">
        <h3 class="card-title">Tren Jumlah Balita 6 Bulan Terakhir</h3>
      </div>
      <div class="card-body">
        <canvas id="lineChart" style="height:250px;"></canvas>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<!-- CDN Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('statusGiziChart').getContext('2d');

    new Chart(ctx, {
      type: 'bar',
      data: {
          labels: {!! json_encode($dataGizi->pluck('bulan')) !!},
        datasets: [
          {
            label: 'Normal',
             data: {!! json_encode($dataGizi->pluck('normal')) !!},
            backgroundColor: 'rgba(54, 162, 235, 0.8)'
          },
          {
            label: 'Wasting',
            data: {!! json_encode($dataGizi->pluck('wasting')) !!},
            backgroundColor: 'rgba(255, 99, 132, 0.8)'
          },
          {
            label: 'Stunting',
            data: {!! json_encode($dataGizi->pluck('stunting')) !!},
            backgroundColor: 'rgba(255, 206, 86, 0.8)'
          }
        ]
      },
      options: {
        responsive: true,
        plugins: {
          title: {
            display: true,
            text: 'Distribusi Status Gizi Balita per Bulan'
          },
          tooltip: {
            mode: 'index',
            intersect: false
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
  });
</script>


<!-- Script Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctxLine = document.getElementById('lineChart').getContext('2d');

  new Chart(ctxLine, {
    type: 'line',
    data: {
       labels: {!! json_encode($dataGizi->pluck('bulan')) !!},
      datasets: [
        {
          label: 'Jumlah Balita',
          data: [28, 30, 32, 31, 34, 36], // contoh data
          borderColor: 'rgba(54, 162, 235, 1)',
          backgroundColor: 'rgba(54, 162, 235, 0.2)',
          tension: 0.4, // bikin garis melengkung halus
          fill: true,   // area di bawah garis terwarnai
          pointBackgroundColor: 'rgba(54, 162, 235, 1)',
          pointRadius: 5
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top'
        },
        title: {
          display: true,
          text: 'Grafik Perkembangan Balita'
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
</script>
@endpush


