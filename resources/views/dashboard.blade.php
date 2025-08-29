@extends('layouts.app')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@endsection

@section('content')
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

{{-- Grafik --}}
<div class="row">
    <div class="col-lg-6">
        <div class="card card-outline card-success">
            <div class="card-header">
                <h3 class="card-title">Distribusi Status Gizi Balita</h3>
            </div>
            <div class="card-body">
                <canvas id="balitaChart" style="min-height:250px; height:250px; max-height:400px; width:100%;"></canvas>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Ambil data dari backend dengan aman
        let jumlahNormal   = @json($jumlahNormal ?? 0);
        let jumlahWasting  = @json($jumlahWasting ?? 0);
        let jumlahStunting = @json($jumlahStunting ?? 0);

        // Debugging data
        console.log("=== DEBUG DATA CHART ===");
        console.log("Jumlah Normal   :", jumlahNormal);
        console.log("Jumlah Wasting  :", jumlahWasting);
        console.log("Jumlah Stunting :", jumlahStunting);

        // Cek canvas
        let canvas = document.getElementById('balitaChart');
        console.log("Canvas ditemukan? :", canvas ? "✅ Ya" : "❌ Tidak");

        if (!canvas) {
            alert("Canvas #balitaChart tidak ditemukan di HTML!");
            return;
        }

        var ctx = canvas.getContext('2d');

        // Render chart
        var balitaChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Normal', 'Wasting', 'Stunting'],
                datasets: [{
                    data: [jumlahNormal, jumlahWasting, jumlahStunting],
                    backgroundColor: ['#28a745', '#dc3545', '#ffc107']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        console.log("Chart berhasil di-render:", balitaChart);
    });
</script>
@endsection

