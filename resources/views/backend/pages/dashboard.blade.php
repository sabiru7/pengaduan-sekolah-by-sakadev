@extends('backend.layout.app')
@section('content')
<div class="page-heading">
    <h3>Dashboard</h3>
</div>

<div class="page-content">
    <section class="row">
        <div class="col-12 col-lg-9">

            {{-- ✅ GANTI CARD JADI CHART --}}
            <div class="row">
                <div class="col-20">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="dashboardChart" height="75"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ✅ SISANYA TETAP --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Log Aktivitas User</h4>
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <tr>
                                    <th width="10%">#</th>
                                    <th width="75%">Activity</th>
                                    <th width="15%">Time</th>
                                </tr>
                                @foreach ($activities as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->activity }}</td>
                                        <td>{{ $item->created_at->diffForHumans() }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Admin & Petugas</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-lg">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Comment</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="backend/images/faces/5.jpg">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Siti Romlah</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">bagaimana cara kerjanya ini?</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img src="backend/images/faces/2.jpg">
                                                    </div>
                                                    <p class="font-bold ms-3 mb-0">Iwan Simanjuntak</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">Gokil webnya pertahankn terus ya!</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- SIDEBAR TETAP --}}
        <div class="col-12 col-lg-3">
            <div class="card">
                <div class="card-body py-4 px-5">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-xl">
                            <img src="backend/images/faces/1.jpg" alt="Face 1">
                        </div>
                        <div class="ms-3 name">
                            <h5 class="font-bold">{{ Auth::user()->name }}</h5>
                            <h6 class="text-muted mb-0">@ {{ Auth::user()->name }}</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h4>Recent Messages</h4>
                </div>
                <div class="card-content pb-4">
                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="backend/images/faces/4.jpg">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Hank Schrader</h5>
                            <h6 class="text-muted mb-0">@johnducky</h6>
                        </div>
                    </div>

                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="backend/images/faces/5.jpg">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">Dean Winchester</h5>
                            <h6 class="text-muted mb-0">@imdean</h6>
                        </div>
                    </div>

                    <div class="recent-message d-flex px-4 py-3">
                        <div class="avatar avatar-lg">
                            <img src="backend/images/faces/1.jpg">
                        </div>
                        <div class="name ms-4">
                            <h5 class="mb-1">John Dodol</h5>
                            <h6 class="text-muted mb-0">@dodoljohn</h6>
                        </div>
                    </div>

                    <div class="px-4">
                        <button class='btn btn-block btn-xl btn-light-primary font-bold mt-3'>
                            Start Conversation
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

{{-- ✅ SCRIPT --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="application/json" id="summary-data">
{!! json_encode($summary) !!}
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const dataSummary = JSON.parse(document.getElementById('summary-data').textContent);

    const ctx = document.getElementById('dashboardChart');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Aktivasi', 'Total User', 'Total Tanggapan', 'Laporan Aduan'],
            datasets: [{
                label: 'Jumlah',
                data: [
                    dataSummary.aktivitas_user ?? 0,
                    dataSummary.total_user ?? 0,
                    dataSummary.total_tanggapan ?? 0,
                    dataSummary.total_pengaduan ?? 0
                ],
                backgroundColor: [
                    '#6f42c1',
                    '#0d6efd',
                    '#198754',
                    '#dc3545'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false }
            }
        }
    });

});
</script>

@endsection