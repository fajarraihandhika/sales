<div class="col-md-10 p-4 main-content-print">

    <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom no-print">
        <div>
            <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-file-invoice text-primary me-2"></i>Audit Report & Transaksi Penjualan</h4>
            <p class="text-muted small mb-0">Halaman khusus peninjauan berkas laporan formal dan arsip data penjualan PT Maju Jaya.</p>
        </div>
        <button onclick="window.print()" class="btn btn-dark fw-bold px-3 py-2 shadow-sm rounded-3 no-print">
            <i class="fa-solid fa-print me-2 text-info"></i>Cetak Laporan / Simpan PDF
        </button>
    </div>

    <div class="print-paper-setup">

        <div class="report-header-print d-flex justify-content-between align-items-start pb-3 mb-4">
            <div>
                <h3 class="company-title-print">PT MAJU JAYA</h3>
                <p class="company-address-print">Kawasan Industri Distribusi Utama, Gedung Jiwa Lt. 4, Tangerang<br>Email: corporate@majujaya.co.id &bull; Telp: (021) 555-8291</p>
            </div>
            <div class="text-end">
                <h4 class="report-title-print">SALES AUDIT REPORT</h4>
                <div class="font-monospace" style="font-size: 0.75rem;">Tanggal Dokumen: <?= date('d F Y / H:i'); ?></div>
            </div>
        </div>

        <table class="table-formal-print mb-4">
            <tr>
                <td style="width: 50%;"><strong>Total Akumulasi Omset Realisasi</strong></td>
                <td class="text-end"><strong>Rp <?= number_format($total_omset, 0, ',', '.'); ?></strong></td>
            </tr>
            <tr>
                <td><strong>Volume Dokumen Penjualan Terproses</strong></td>
                <td class="text-end"><strong><?= $total_order; ?> Nota Transaksi</strong></td>
            </tr>
        </table>

        <h6 class="fw-bold mb-2 text-uppercase" style="font-size: 0.85rem;">Rincian Audit Log Transaksi</h6>

        <table class="table-formal-print mb-4">
            <thead>
                <tr>
                    <th>No. Order</th>
                    <th>Tanggal Transaksi</th>
                    <th>Mitra Pelanggan/Toko</th>
                    <th>Sales Agent Lapangan</th>
                    <th class="text-end">Nilai Transaksi</th>
                    <th class="text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($all_orders as $row): ?>
                <tr>
                    <td><?= $row['no_order']; ?></td>
                    <td><?= date('d-m-Y', strtotime($row['tanggal_order'])); ?></td>
                    <td><?= $row['nama_pelanggan']; ?></td>
                    <td><?= $row['nama_sales']; ?></td>
                    <td class="text-end">Rp <?= number_format($row['total_harga'], 0, ',', '.'); ?></td>
                    <td class="text-center text-uppercase"><?= $row['status']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h6 class="fw-bold mb-2 text-uppercase" style="font-size: 0.85rem;">Rincian Laporan Per Produk</h6>

        <table class="table-formal-print mb-4">
            <thead>
                <tr>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th class="text-center">Total Qty Terjual</th>
                    <th class="text-end">Total Omset</th>
                </tr>
            </thead>
            <tbody>
                <?php if(!empty($laporan_produk)): ?>
                    <?php foreach($laporan_produk as $lp): ?>
                    <tr>
                        <td><?= $lp['kode_produk']; ?></td>
                        <td><?= $lp['nama_produk']; ?></td>
                        <td class="text-center"><?= $lp['total_qty']; ?> unit</td>
                        <td class="text-end">Rp <?= number_format($lp['total_omset'], 0, ',', '.'); ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4" class="text-center">Belum ada data transaksi produk.</td></tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end"><strong>TOTAL AKUMULASI OMSET PRODUK</strong></td>
                    <td class="text-end"><strong>Rp <?= number_format(array_sum(array_column($laporan_produk, 'total_omset')), 0, ',', '.'); ?></strong></td>
                </tr>
            </tfoot>
        </table>

        <div class="signature-container-print mt-5">
            <div class="signature-space"></div>
            <div class="signature-box">
                <p class="mb-5 text-muted small">Disahkan secara digital oleh,</p>
                <div class="fw-bold text-dark text-decoration-underline" style="font-size: 1.05rem;"><?= $this->session->userdata('nama_lengkap'); ?></div>
                <p class="text-muted small mb-0">Executive Manager PT Maju Jaya</p>
            </div>
        </div>

    </div>
</div>

<style>
    .print-paper-setup {
        background: #ffffff;
        padding: 30px;
        font-family: Arial, Helvetica, sans-serif;
        color: #000;
    }

    .report-header-print { border-bottom: 2px solid #000; }
    .company-title-print { font-weight: 800; margin-bottom: 5px; font-size: 1.4rem; }
    .company-address-print { font-size: 0.85rem; }
    .report-title-print { font-weight: 800; margin-bottom: 0; font-size: 1.2rem; }

    /* TABEL FORMAL: garis hitam tegas, polos, tanpa background warna */
    .table-formal-print {
        width: 100%;
        border-collapse: collapse;
    }
    .table-formal-print th,
    .table-formal-print td {
        border: 1px solid #000;
        padding: 10px 12px;
        font-size: 0.85rem;
        text-align: left;
    }
    .table-formal-print th {
        font-weight: 700;
        text-transform: uppercase;
        font-size: 0.75rem;
        background: #f3f4f6; /* abu sangat terang, aman dicetak hitam-putih */
    }
    .table-formal-print tfoot td {
        background: #f3f4f6;
    }

    .signature-container-print { display: flex; }
    .signature-space { flex: 2; }
    .signature-box { flex: 1; text-align: center; }

    @media print {
        .no-print, .navbar-premium, .sidebar-premium, .col-md-2, footer, nav, header {
            display: none !important;
        }

        @page {
            size: landscape;
            margin: 15mm;
        }

        .col-md-10, .main-content-print {
            width: 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .row { display: block !important; }

        tr { page-break-inside: avoid; }
        h6 { page-break-after: avoid; }
    }
</style>