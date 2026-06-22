<div class="col-md-10 p-4 animate-fade-in">

    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-pen-to-square text-warning me-2"></i>Edit Informasi Produk</h4>
            <p class="text-muted small mb-0">Perbarui detail harga atau stok untuk <?= $produk['nama_produk']; ?>.</p>
        </div>
        <a href="<?= base_url('admin/produk'); ?>" class="btn btn-sm btn-outline-secondary rounded-3 fw-semibold">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke List
        </a>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden rounded-4" style="max-width: 720px;">
        <div class="card-accent-bar bg-accent-amber"></div>

        <div class="card-body p-4-5">
            <div class="mb-4">
                <h5 class="fw-bold text-dark mb-1"><i class="fa-solid fa-file-pen me-2 text-warning"></i>Formulir Pembaruan Produk</h5>
                <p class="text-muted small mb-0">Kode produk bersifat permanen dan tidak dapat diubah.</p>
            </div>
            <hr class="text-muted opacity-25 mb-4">

            <form action="<?= base_url('admin/produk/edit/'.$produk['id_produk']); ?>" method="POST" autocomplete="off">
                <div class="form-group-premium mb-4">
                    <label class="form-label-premium"><i class="fa-solid fa-tag me-1 text-muted"></i>Kode Produk</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                        <input type="text" class="form-control premium-input border-start-0 bg-light fw-bold text-muted" value="<?= $produk['kode_produk']; ?>" readonly>
                    </div>
                </div>

                <div class="form-group-premium mb-4">
                    <label class="form-label-premium"><i class="fa-solid fa-box me-1 text-muted"></i>Nama Produk / Barang <span class="text-danger">*</span></label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-tv text-muted"></i></span>
                        <input type="text" name="nama_produk" class="form-control premium-input border-start-0" value="<?= set_value('nama_produk', $produk['nama_produk']); ?>">
                    </div>
                    <?= form_error('nama_produk', '<div class="error-msg-premium"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-premium mb-4">
                            <label class="form-label-premium"><i class="fa-solid fa-money-bill-wave me-1 text-muted"></i>Harga Satuan (Rp) <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">Rp</span>
                                <input type="number" name="harga" class="form-control premium-input border-start-0" value="<?= set_value('harga', $produk['harga']); ?>">
                            </div>
                            <?= form_error('harga', '<div class="error-msg-premium"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group-premium mb-4">
                            <label class="form-label-premium"><i class="fa-solid fa-warehouse me-1 text-muted"></i>Stok Gudang <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-cubes text-muted"></i></span>
                                <input type="number" name="stok" class="form-control premium-input border-start-0" value="<?= set_value('stok', $produk['stok']); ?>">
                            </div>
                            <?= form_error('stok', '<div class="error-msg-premium"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 mt-2 border-top">
                    <a href="<?= base_url('admin/produk'); ?>" class="btn btn-light fw-semibold px-4 py-2 text-secondary rounded-3">Batal</a>
                    <button type="submit" class="btn fw-bold px-4 py-2 rounded-3 shadow-sm btn-submit-amber">
                        <i class="fa-solid fa-rotate me-1"></i> Perbarui Produk
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'premium_form_style.php'; ?>