<div class="col-md-10 p-4 animate-fade-in">

    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-cart-plus text-success me-2"></i>Buat Sales Order Baru</h4>
            <p class="text-muted small mb-0">Catat pesanan baru dari pelanggan/toko Anda.</p>
        </div>
        <a href="<?= base_url('sales/dashboard'); ?>" class="btn btn-sm btn-outline-secondary rounded-3 fw-semibold">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali
        </a>
    </div>

    <?= $this->session->flashdata('msg'); ?>

    <div class="card border-0 shadow-sm overflow-hidden rounded-4" style="max-width: 760px;">
        <div class="card-accent-bar bg-accent-green"></div>

        <div class="card-body p-4-5">
            <div class="mb-4">
                <h5 class="fw-bold text-dark mb-1"><i class="fa-solid fa-file-invoice me-2 text-success"></i>Formulir Pemesanan</h5>
                <p class="text-muted small mb-0">No. order dan tanggal akan ter-generate otomatis oleh sistem.</p>
            </div>
            <hr class="text-muted opacity-25 mb-4">

            <form action="<?= base_url('sales/dashboard/tambah_order'); ?>" method="POST" autocomplete="off">

                <div class="form-group-premium mb-4">
                    <label class="form-label-premium"><i class="fa-solid fa-store me-1 text-muted"></i>Pilih Pelanggan / Toko <span class="text-danger">*</span></label>
                    <select name="id_pelanggan" class="form-select premium-input" required>
                        <option value="">-- Pilih Toko Tujuan --</option>
                        <?php foreach($pelanggan as $plg): ?>
                            <option value="<?= $plg['id_pelanggan']; ?>"><?= $plg['nama_pelanggan']; ?> — <?= $plg['alamat']; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?= form_error('id_pelanggan', '<div class="error-msg-premium"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
                </div>

                <div class="bg-light rounded-3 p-3 mb-4">
                    <h6 class="fw-bold text-success mb-3 small text-uppercase"><i class="fa-solid fa-box me-1"></i>Item Produk Yang Dipesan</h6>

                    <div class="row g-3">
                        <div class="col-md-7">
                            <label class="form-label-premium">Pilih Produk Elektronik <span class="text-danger">*</span></label>
                            <select name="id_produk" id="selectProduk" class="form-select premium-input" required>
                                <option value="">-- Pilih Barang --</option>
                                <?php foreach($produk as $prd): ?>
                                    <option value="<?= $prd['id_produk']; ?>" data-harga="<?= $prd['harga']; ?>" data-stok="<?= $prd['stok']; ?>">
                                        <?= $prd['nama_produk']; ?> (Rp <?= number_format($prd['harga'], 0, ',', '.'); ?>) | Stok: <?= $prd['stok']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('id_produk', '<div class="error-msg-premium"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label-premium">Jumlah (Qty) <span class="text-danger">*</span></label>
                            <input type="number" name="jumlah" id="inputJumlah" class="form-control premium-input" min="1" placeholder="Contoh: 5" required>
                            <small id="stokInfo" class="text-muted"></small>
                            <?= form_error('jumlah', '<div class="error-msg-premium"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center bg-white border rounded-3 px-3 py-2 mt-3">
                        <span class="small fw-bold text-muted text-uppercase">Estimasi Total Harga</span>
                        <span id="totalPreview" class="fw-bold fs-5 text-success">Rp 0</span>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 mt-2 border-top">
                    <a href="<?= base_url('sales/dashboard'); ?>" class="btn btn-light fw-semibold px-4 py-2 text-secondary rounded-3">Batal</a>
                    <button type="submit" class="btn fw-bold px-4 py-2 rounded-3 shadow-sm btn-submit-green">
                        <i class="fa-solid fa-paper-plane me-1"></i> Simpan & Ajukan Order
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
</script>