<div class="col-md-10 p-4">

    <!-- KPI SUMMARY CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #16a34a;">
                <div class="card-body">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Total Omset Saya</p>
                    <h4 class="fw-bold mb-0 text-success">Rp <?= number_format($total_omset, 0, ',', '.'); ?></h4>
                    <small class="text-muted">Dari order status selesai</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #0dcaf0;">
                <div class="card-body">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Total Order Saya</p>
                    <h4 class="fw-bold mb-0"><?= $total_order; ?> SO</h4>
                    <small class="text-muted">Seluruh transaksi yang Anda buat</small>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100" style="border-left: 4px solid #ffc107;">
                <div class="card-body">
                    <p class="text-muted small mb-1 text-uppercase fw-bold">Order Draft</p>
                    <h4 class="fw-bold mb-0"><?= $order_draft; ?> SO</h4>
                    <small class="text-muted">Masih bisa Anda edit</small>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="fw-bold mb-1">Riwayat Order Saya (Sales)</h4>
                    <p class="text-muted small mb-0">
                        Selamat datang kembali, <strong><?= $this->session->userdata('nama_lengkap'); ?></strong>. Berikut adalah performa penjualan Anda.
                    </p>
                </div>
                <a href="<?= base_url('sales/dashboard/tambah_order'); ?>" class="btn btn-success fw-bold">+ Buat Sales Order</a>
            </div>

            <?= $this->session->flashdata('msg'); ?>

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle rounded">
                    <thead class="table-dark">
                        <tr>
                            <th>No. Order</th>
                            <th>Tanggal Transaksi</th>
                            <th>Nama Pelanggan / Toko</th>
                            <th>Total Nilai Kontrak</th>
                            <th class="text-center">Status Distribusi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(!empty($my_orders)): ?>
                            <?php foreach($my_orders as $row): ?>
                            <tr>
                                <td><strong class="text-primary"><?= $row['no_order']; ?></strong></td>
                                <td><?= date('d-m-Y', strtotime($row['tanggal_order'])); ?></td>
                                <td><?= $row['nama_pelanggan']; ?></td>
                                <td class="fw-bold text-success">Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                                <td class="text-center">
                                    <?php 
                                        $badge = 'bg-secondary';
                                        if($row['status'] == 'draft') $badge = 'bg-warning text-dark';
                                        elseif($row['status'] == 'dikirim') $badge = 'bg-info text-white';
                                        elseif($row['status'] == 'selesai') $badge = 'bg-success text-white';
                                        elseif($row['status'] == 'dibatalkan') $badge = 'bg-danger text-white';
                                    ?>
                                    <span class="badge <?= $badge; ?> text-uppercase px-3 py-2 small" style="letter-spacing: 0.5px;">
                                        <?= $row['status']; ?>
                                    </span>
                                </td>
                                <td class="text-center">
                                    <?php if($row['status'] == 'draft'): ?>
                                        <a href="<?= base_url('sales/dashboard/edit_order/'.$row['id_order']); ?>" class="btn btn-sm btn-warning fw-bold text-dark">
                                            <i class="fa-solid fa-pen me-1"></i>Edit
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted small"><i class="fa-solid fa-lock me-1"></i>Terkunci</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Anda belum memiliki riwayat catatan sales order. Klik tombol di kanan atas untuk membuat pesanan baru!
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>