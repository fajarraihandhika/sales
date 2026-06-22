<div class="col-md-10 p-4 animate-fade-in">

    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-clipboard-list text-primary me-2"></i>Laporan Operasional</h4>
            <p class="text-muted small mb-0">Ringkasan stok barang dan status pemrosesan order PT Maju Jaya.</p>
        </div>
    </div>

    <!-- RINGKASAN STATUS ORDER -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #ffc107;">
                <div class="card-body">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Draft</p>
                    <h4 class="fw-bold mb-0"><?= $ringkasan_status['draft']; ?> SO</h4>
                    <small class="text-muted">Belum diproses sales</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #0dcaf0;">
                <div class="card-body">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Dikirim</p>
                    <h4 class="fw-bold mb-0"><?= $ringkasan_status['dikirim']; ?> SO</h4>
                    <small class="text-muted">Dalam proses logistik</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #198754;">
                <div class="card-body">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Selesai</p>
                    <h4 class="fw-bold mb-0"><?= $ringkasan_status['selesai']; ?> SO</h4>
                    <small class="text-muted">Transaksi tuntas</small>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #dc3545;">
                <div class="card-body">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Dibatalkan</p>
                    <h4 class="fw-bold mb-0"><?= $ringkasan_status['dibatalkan']; ?> SO</h4>
                    <small class="text-muted">Transaksi gagal/batal</small>
                </div>
            </div>
        </div>
    </div>

    <!-- LAPORAN STOK BARANG -->
    <div class="card shadow-sm border-0">
        <div class="card-body">
            <h6 class="fw-bold mb-3"><i class="fa-solid fa-warehouse text-primary me-2"></i>Laporan Stok Barang</h6>
            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Kode</th>
                            <th>Nama Produk</th>
                            <th class="text-end">Harga Satuan</th>
                            <th class="text-center">Stok</th>
                            <th class="text-end">Total Nilai Stok</th>
                            <th class="text-center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $grand_total_stok = 0; foreach($laporan_stok as $p): $grand_total_stok += $p['total_nilai_stok']; ?>
                        <tr>
                            <td><span class="badge bg-secondary"><?= $p['kode_produk']; ?></span></td>
                            <td class="fw-semibold"><?= $p['nama_produk']; ?></td>
                            <td class="text-end">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></td>
                            <td class="text-center"><?= $p['stok']; ?></td>
                            <td class="text-end fw-bold">Rp <?= number_format($p['total_nilai_stok'], 0, ',', '.'); ?></td>
                            <td class="text-center">
                                <?php
                                    $s_badge = 'bg-success';
                                    if ($p['status_stok'] == 'Stok Rendah') $s_badge = 'bg-warning text-dark';
                                    elseif ($p['status_stok'] == 'Habis') $s_badge = 'bg-danger';
                                ?>
                                <span class="badge <?= $s_badge; ?>"><?= $p['status_stok']; ?></span>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr class="table-light">
                            <td colspan="4" class="text-end fw-bold">TOTAL NILAI SELURUH STOK</td>
                            <td class="text-end fw-bold text-success">Rp <?= number_format($grand_total_stok, 0, ',', '.'); ?></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>