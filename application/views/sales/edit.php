<div class="col-md-10 p-4 animate-fade-in">

    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-pen-to-square text-warning me-2"></i>Edit Sales Order</h4>
            <p class="text-muted small mb-0">Perbarui pesanan <strong><?= $order['no_order']; ?></strong> sebelum dikirim ke logistik.</p>
        </div>
        <a href="<?= base_url('sales/dashboard'); ?>" class="btn btn-sm btn-outline-secondary rounded-3 fw-semibold">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <?= $this->session->flashdata('msg'); ?>

    <div class="card border-0 shadow-sm overflow-hidden rounded-4" style="max-width: 760px;">
        <div class="card-accent-bar bg-accent-amber"></div>

        <div class="card-body p-4-5">
            <div class="mb-4">
                <h5 class="fw-bold text-dark mb-1"><i class="fa-solid fa-file-pen me-2 text-warning"></i>Formulir Pembaruan Order</h5>
                <p class="text-muted small mb-0">Order ini hanya bisa diubah selama statusnya masih "Draft".</p>
            </div>
            <hr class="text-muted opacity-25 mb-4">

            <form action="<?= base_url('sales/dashboard/edit_order/'.$order['id_order']); ?>" method="POST" autocomplete="off">

                <div class="form-group-premium mb-4">
                    <label class="form-label-premium"><i class="fa-solid fa-store me-1 text-muted"></i>Pelanggan / Toko Tujuan <span class="text-danger">*</span></label>
                    <select name="id_pelanggan" class="form-select premium-input" required>
                        <?php foreach($pelanggan as $plg): ?>
                            <option value="<?= $plg['id_pelanggan']; ?>" <?= ($plg['id_pelanggan'] == $order['id_pelanggan']) ? 'selected' : ''; ?>>
                                <?= $plg['nama_pelanggan']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('id_pelanggan', '<div class="error-msg-premium"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
                </div>

                <div class="bg-light rounded-3 p-3 mb-4">
                    <h6 class="fw-bold text-warning mb-3 small text-uppercase"><i class="fa-solid fa-box me-1"></i>Item Produk Yang Dipesan</h6>

                    <div class="row g-3">
                        <div class="col-md-7">
                            <label class="form-label-premium">Pilih Produk <span class="text-danger">*</span></label>
                            <select name="id_produk" id="selectProduk" class="form-select premium-input" required>
                                <?php foreach($produk as $prd): ?>
                                    <option value="<?= $prd['id_produk']; ?>" data-harga="<?= $prd['harga']; ?>" data-stok="<?= $prd['stok']; ?>" <?= ($prd['id_produk'] == $detail['id_produk']) ? 'selected' : ''; ?>>
                                        <?= $prd['nama_produk']; ?> (Rp <?= number_format($prd['harga'], 0, ',', '.'); ?>) | Stok: <?= $prd['stok']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('id_produk', '<div class="error-msg-premium"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label-premium">Jumlah (Qty) <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah" id="inputJumlah" class="form-control premium-input" value="<?= $detail['jumlah']; ?>" min="1" required>
                            <small id="stokInfo" class="text-muted"></small>
                            <?= form_error('jumlah', '<div class="error-msg-premium"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center bg-white border rounded-3 px-3 py-2 mt-3">
                        <span class="small fw-bold text-muted text-uppercase">Estimasi Total Harga</span>
                        <span id="totalPreview" class="fw-bold fs-5 text-warning">Rp 0</span>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 mt-2 border-top">
                    <a href="<?= base_url('sales/dashboard'); ?>" class="btn btn-light fw-semibold px-4 py-2 text-secondary rounded-3">Batal</a>
                    <button type="submit" class="btn fw-bold px-4 py-2 rounded-3 shadow-sm btn-submit-amber">
                        <i class="fa-solid fa-rotate me-1"></i> Perbarui Orderan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'premium_form_style.php'; ?>

<script>
    const selectProduk = document.getElementById('selectProduk');
    const inputJumlah  = document.getElementById('inputJumlah');
    const totalPreview = document.getElementById('totalPreview');
    const stokInfo      = document.getElementById('stokInfo');

    function hitungTotal() {
        const opt = selectProduk.options[selectProduk.selectedIndex];
        const harga = parseFloat(opt?.dataset?.harga) || 0;
        const stok  = parseInt(opt?.dataset?.stok) || 0;
        const qty   = parseInt(inputJumlah.value) || 0;

        stokInfo.textContent = opt && opt.value ? 'Stok tersedia: ' + stok + ' unit' : '';
        stokInfo.classList.toggle('text-danger', qty > stok && stok > 0);

        const total = harga * qty;
        totalPreview.textContent = 'Rp ' + total.toLocaleString('id-ID');
    }

    selectProduk.addEventListener('change', hitungTotal);
    inputJumlah.addEventListener('input', hitungTotal);
    window.addEventListener('DOMContentLoaded', hitungTotal); // langsung tampilkan saat halaman dibuka
</script>