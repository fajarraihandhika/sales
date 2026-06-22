<div class="col-md-10 p-4 animate-fade-in">
    
    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom">
        <div>
            <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-chart-line text-primary me-2"></i>Executive Sales Intelligence Engine</h4>
            <p class="text-muted small mb-0">Sistem analisis performa multi-dimensi, omset, dan efisiensi kanal distribusi PT Maju Jaya.</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm" style="border-left: 5px solid #10b981 !important;">
                <div class="card-body p-3.5">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-uppercase small fw-bold text-muted font-monospace">Revenue Realized</span>
                        <div class="p-2 bg-success bg-opacity-10 text-success rounded-3"><i class="fa-solid fa-wallet fs-5"></i></div>
                    </div>
                    <h3 class="fw-bold text-dark mb-1">Rp <?= number_format($total_omset, 0, ',', '.'); ?></h3>
                    <small class="text-success fw-semibold"><i class="fa-solid fa-circle-check me-1"></i>Transaksi Status Selesai</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm" style="border-left: 5px solid #f59e0b !important;">
                <div class="card-body p-3.5">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-uppercase small fw-bold text-muted font-monospace">Pipeline / Pending</span>
                        <div class="p-2 bg-warning bg-opacity-10 text-warning rounded-3"><i class="fa-solid fa-hourglass-half fs-5"></i></div>
                    </div>
                    <?php 
                        // Hitung perkiraan dana menggantung dari data transaksi yang bukan selesai/batal
                        $pending_revenue = 0;
                        foreach($all_orders as $o) {
                            if($o['status'] == 'draft' || $o['status'] == 'dikirim') {
                                $pending_revenue += $o['total_harga'];
                            }
                        }
                    ?>
                    <h3 class="fw-bold text-dark mb-1">Rp <?= number_format($pending_revenue, 0, ',', '.'); ?></h3>
                    <small class="text-warning fw-semibold"><i class="fa-solid fa-circle-notch fa-spin me-1"></i>Dalam Proses Logistik</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm" style="border-left: 5px solid #3b82f6 !important;">
                <div class="card-body p-3.5">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-uppercase small fw-bold text-muted font-monospace">Total Volume</span>
                        <div class="p-2 bg-primary bg-opacity-10 text-primary rounded-3"><i class="fa-solid fa-file-invoice-dollar fs-5"></i></div>
                    </div>
                    <h3 class="fw-bold text-dark mb-1"><?= $total_order; ?> <span class="fs-6 fw-normal text-muted">SO</span></h3>
                    <small class="text-primary fw-semibold"><i class="fa-solid fa-chart-simple me-1"></i>Agregat Dokumen Masuk</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card h-100 border-0 shadow-sm" style="border-left: 5px solid #6366f1 !important;">
                <div class="card-body p-3.5">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="text-uppercase small fw-bold text-muted font-monospace">Avg. Order Value</span>
                        <div class="p-2 bg-indigo bg-opacity-10 text-indigo rounded-3" style="color: #6366f1;"><i class="fa-solid fa-calculator fs-5"></i></div>
                    </div>
                    <?php 
                        $aov = ($total_order > 0) ? ($total_omset / $total_order) : 0;
                    ?>
                    <h3 class="fw-bold text-dark mb-1">Rp <?= number_format($aov, 0, ',', '.'); ?></h3>
                    <small class="text-muted fw-semibold">Rataan Nilai Per Nota Pesanan</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-7">
            <div class="card border-0 shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-arrow-trend-up text-primary me-2"></i>Grafik Arus Distribusi Penjualan</h6>
                    <span class="badge bg-light text-secondary font-monospace">Real-time</span>
                </div>
                <div style="position: relative; height:280px;">
                    <canvas id="salesTrendChart"></canvas>
                </div>
            </div>
        </div>
        
        <div class="col-md-5">
            <div class="card border-0 shadow-sm p-4 h-100">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-trophy text-warning me-2"></i>Kompetisi & Kontribusi Sales Agent</h6>
                    <span class="badge bg-light text-success fw-bold">Top Performance</span>
                </div>
                <div style="position: relative; height:280px;">
                    <canvas id="salesLeaderboardChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold mb-0 text-dark"><i class="fa-solid fa-ranking-star text-success me-2"></i>Laporan Top Produk Terjual</h6>
                <span class="badge bg-light text-secondary font-monospace">Status Selesai</span>
            </div>
            <?php if(!empty($laporan_produk)): ?>
            <div class="row">
                <div class="col-md-6">
                    <div style="position: relative; height:260px;">
                        <canvas id="produkChart"></canvas>
                    </div>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm align-middle mb-0">
                        <thead>
                            <tr class="text-uppercase small text-muted">
                                <th>Produk</th>
                                <th class="text-center">Qty Terjual</th>
                                <th class="text-end">Total Omset</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($laporan_produk as $lp): ?>
                            <tr>
                                <td class="fw-semibold"><?= $lp['nama_produk']; ?></td>
                                <td class="text-center"><?= $lp['total_qty']; ?></td>
                                <td class="text-end fw-bold text-success">Rp <?= number_format($lp['total_omset'], 0, ',', '.'); ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php else: ?>
                <p class="text-muted text-center py-4 mb-0">Belum ada data penjualan produk yang berstatus selesai.</p>
            <?php endif; ?>
        </div>
    </div>
</div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    <h5 class="fw-bold mb-1 text-dark">Data Log Transaksi Menyeluruh</h5>
                    <p class="text-muted small mb-0">Menampilkan detail pelacakan status nota pesanan harian dari seluruh agent sales lapangan.</p>
                </div>
            </div>
            
            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr class="text-uppercase bg-light rounded-3">
                            <th>No. Order</th>
                            <th>Tanggal Penjualan</th>
                            <th>Mitra Pelanggan/Toko</th>
                            <th>Sales Agent Lapangan</th>
                            <th class="text-end">Nilai Valuasi Order</th>
                            <th class="text-center">Status Transaksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($all_orders as $row): 
                            // Set dynamic badges design
                            $badge_class = 'bg-secondary';
                            if ($row['status'] == 'draft') $badge_class = 'bg-warning text-dark';
                            elseif ($row['status'] == 'dikirim') $badge_class = 'bg-info text-white';
                            elseif ($row['status'] == 'selesai') $badge_class = 'bg-success text-white';
                            elseif ($row['status'] == 'batal') $badge_class = 'bg-danger text-white';
                        ?>
                        <tr>
                            <td><span class="badge bg-light text-dark font-monospace border fw-bold px-2.5 py-1.5 shadow-sm"><?= $row['no_order']; ?></span></td>
                            <td class="text-secondary small font-monospace"><i class="fa-regular fa-calendar me-1.5"></i><?= date('d M Y', strtotime($row['tanggal_order'])); ?></td>
                            <td>
                                <div class="fw-bold text-dark"><?= $row['nama_pelanggan']; ?></div>
                            </td>
                            <td>
                                <div class="small fw-semibold text-secondary"><i class="fa-solid fa-user-tag me-1.5 text-muted"></i><?= $row['nama_sales']; ?></div>
                            </td>
                            <td class="fw-extrabold text-dark text-end font-monospace">
                                Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?>
                            </td>
                            <td class="text-center">
                                <span class="badge badge-premium text-uppercase px-3 py-1.5 <?= $badge_class; ?> shadow-sm">
                                    <?= $row['status']; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php
            // 1. Ekstrak data untuk grafik tren (kelompokkan berdasarkan tanggal)
            $chart_dates = [];
            $chart_amounts = [];
            foreach(array_reverse($all_orders) as $o) {
                if($o['status'] == 'selesai') {
                    $tgl = date('d/m', strtotime($o['tanggal_order']));
                    if(!in_array($tgl, $chart_dates)) {
                        $chart_dates[] = $tgl;
                        $chart_amounts[$tgl] = $o['total_harga'];
                    } else {
                        $chart_amounts[$tgl] += $o['total_harga'];
                    }
                }
            }
            
            // 2. Ekstrak data untuk performa agen sales
            $sales_perf = [];
            foreach($all_orders as $o) {
                if($o['status'] == 'selesai') {
                    if(!isset($sales_perf[$o['nama_sales']])) {
                        $sales_perf[$o['nama_sales']] = $o['total_harga'];
                    } else {
                        $sales_perf[$o['nama_sales']] += $o['total_harga'];
                    }
                }
            }
            arsort($sales_perf); // Urutkan dari omset terbesar
        ?>

        // --- LINE CHART: TREN OMSET ---
        const ctxTrend = document.getElementById('salesTrendChart').getContext('2d');
        new Chart(ctxTrend, {
            type: 'line',
            data: {
                labels: <?= json_encode($chart_dates); ?>,
                datasets: [{
                    label: 'Omset Realisasi (Rp)',
                    data: <?= json_encode(array_values($chart_amounts)); ?>,
                    borderColor: '#3b82f6',
                    backgroundColor: 'rgba(59, 130, 246, 0.05)',
                    borderWidth: 3,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#3b82f6'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } },
                scales: {
                    y: { grid: { color: '#f1f5f9' }, ticks: { font: { family: 'Plus Jakarta Sans' } } },
                    x: { grid: { display: false }, ticks: { font: { family: 'Plus Jakarta Sans' } } }
                }
            }
        });

        // --- BAR CHART: TOP PRODUK TERJUAL ---
<?php if(!empty($laporan_produk)): ?>
const ctxProduk = document.getElementById('produkChart').getContext('2d');
new Chart(ctxProduk, {
    type: 'bar',
    data: {
        labels: <?= json_encode(array_column($laporan_produk, 'nama_produk')); ?>,
        datasets: [{
            label: 'Omset (Rp)',
            data: <?= json_encode(array_column($laporan_produk, 'total_omset')); ?>,
            backgroundColor: '#10b981',
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        indexAxis: 'y',
        plugins: { legend: { display: false } },
        scales: {
            x: { grid: { color: '#f1f5f9' } },
            y: { grid: { display: false } }
        }
    }
});
<?php endif; ?>

        // --- DOUGHNUT CHART: LEADERBOARD PERFORMA SALES ---
        const ctxLeader = document.getElementById('salesLeaderboardChart').getContext('2d');
        new Chart(ctxLeader, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode(array_keys($sales_perf)); ?>,
                datasets: [{
                    data: <?= json_encode(array_values($sales_perf)); ?>,
                    backgroundColor: ['#10b981', '#3b82f6', '#6366f1', '#f59e0b', '#ec4899', '#94a3b8'],
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { font: { family: 'Plus Jakarta Sans', weight: 600 }, boxWidth: 12 }
                    }
                }
            }
        });
    });
</script>