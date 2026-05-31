@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<h5 class="fw-bold mb-4" style="color:#1a3c40">Dashboard of MedPatient</h5>

<!-- STAT CARDS -->
<div class="row g-3 mb-4">
    <div class="col-md-6">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#e8f7f9;color:#2aacbb">
                <i class="bi bi-people-fill"></i>
            </div>
            <div>
                <div class="stat-value">{{ $totalUsers }}</div>
                <div class="stat-label">Total Users</div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card d-flex align-items-center gap-3">
            <div class="stat-icon" style="background:#e8f9f0;color:#2ab87a">
                <i class="bi bi-clipboard2-heart-fill"></i>
            </div>
            <div>
                <div class="stat-value">{{ $totalPatients }}</div>
                <div class="stat-label">Total Patient Records</div>
            </div>
        </div>
    </div>
</div>

<!-- CHARTS -->
<div class="row g-3">
    <div class="col-md-7">
        <div class="card">
            <div class="card-header">
                <span class="fw-semibold" style="font-size:14px;color:#1a3c40">Patient Records per Month</span>
            </div>
            <div class="card-body">
                <canvas id="barChart" height="120"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <span class="fw-semibold" style="font-size:14px;color:#1a3c40">Common Diagnoses</span>
            </div>
            <div class="card-body">
                <canvas id="pieChart" height="180"></canvas>
                <div class="mt-3" id="pie-legend"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
            datasets: [{
                label: 'Patients',
                data: {!! json_encode($monthlyData) !!},
                backgroundColor: 'rgba(42,172,187,0.2)',
                borderColor: '#2aacbb',
                borderWidth: 2,
                borderRadius: 6,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: { y: { beginAtZero: true, ticks: { stepSize: 1 } } }
        }
    });

    const pieCtx = document.getElementById('pieChart').getContext('2d');
    const pieLabels = {!! json_encode($diagnoses->pluck('diagnosis')) !!};
    const pieData   = {!! json_encode($diagnoses->pluck('count')) !!};
    const pieColors = ['#2aacbb','#2ab87a','#f08c00','#e03131','#7048e8','#0c8599','#a61e4d'];

    new Chart(pieCtx, {
        type: 'doughnut',
        data: {
            labels: pieLabels,
            datasets: [{ data: pieData, backgroundColor: pieColors.slice(0, pieLabels.length), borderWidth: 1 }]
        },
        options: { responsive: true, plugins: { legend: { display: false } } }
    });

    const legend = document.getElementById('pie-legend');
    pieLabels.forEach((label, i) => {
        legend.innerHTML += `<span class="d-inline-flex align-items-center gap-1 me-2 mb-1" style="font-size:11px">
            <span style="width:10px;height:10px;border-radius:50%;background:${pieColors[i]};display:inline-block"></span>${label}
        </span>`;
    });
</script>
@endpush