<div class="col-md-10 p-4 animate-fade-in">

    <div class="d-flex justify-content-between align-items-center mb-4 pb-2 border-bottom">
        <div>
            <h4 class="fw-bold text-dark mb-1"><i class="fa-solid fa-user-plus text-primary me-2"></i>Registrasi Klien Baru</h4>
            <p class="text-muted small mb-0">Tambahkan data mitra toko atau pelanggan ritel baru ke dalam ekosistem PT Maju Jaya.</p>
        </div>
        <a href="<?= base_url('admin/pelanggan'); ?>" class="btn btn-sm btn-outline-secondary rounded-3 fw-semibold">
            <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke List
        </a>
    </div>

    <div class="card border-0 shadow-sm overflow-hidden rounded-4 w-100">
        <div class="card-accent-bar bg-accent-blue"></div>

        <div class="card-body p-4-5">
            <div class="mb-4">
                <h5 class="fw-bold text-dark mb-1"><i class="fa-solid fa-file-invoice me-2 text-primary"></i>Formulir Profil Pelanggan</h5>
                <p class="text-muted small mb-0">Silakan lengkapi seluruh data di bawah ini. Pastikan informasi alamat pengiriman terisi dengan valid.</p>
            </div>
            <hr class="text-muted opacity-25 mb-4">

            <form action="<?= base_url('admin/pelanggan/tambah'); ?>" method="POST" autocomplete="off">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group-premium mb-4">
                            <label class="form-label-premium"><i class="fa-solid fa-building me-1 text-muted"></i>Nama Pelanggan / Toko <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fa-regular fa-user text-muted"></i></span>
                                <input type="text" name="nama_pelanggan" class="form-control premium-input border-start-0" value="<?= set_value('nama_pelanggan'); ?>" placeholder="Contoh: Toko Elektronik Jaya / PT Sentosa">
                            </div>
                            <?= form_error('nama_pelanggan', '<div class="error-msg-premium"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
                        </div>

                        <div class="form-group-premium mb-4">
                            <label class="form-label-premium"><i class="fa-solid fa-phone me-1 text-muted"></i>No. Telepon Aktif <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-phone-flip text-muted"></i></span>
                                <input type="text" name="no_telp" class="form-control premium-input border-start-0" value="<?= set_value('no_telp'); ?>" placeholder="Contoh: 081234567xxx">
                            </div>
                            <?= form_error('no_telp', '<div class="error-msg-premium"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group-premium mb-4 h-100 d-flex flex-column">
                            <label class="form-label-premium"><i class="fa-solid fa-map-location-dot me-1 text-muted"></i>Alamat Pengiriman Lengkap <span class="text-danger">*</span></label>
                            <textarea name="alamat" class="form-control premium-input p-3 flex-grow-1" style="min-height: 122px;" placeholder="Masukkan nama jalan, nomor toko, RT/RW, Kecamatan, Kota/Kabupaten, dan Kode Pos..."><?= set_value('alamat'); ?></textarea>
                            <?= form_error('alamat', '<div class="error-msg-premium"><i class="fa-solid fa-circle-exclamation me-1"></i>', '</div>'); ?>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 pt-3 mt-2 border-top">
                    <a href="<?= base_url('admin/pelanggan'); ?>" class="btn btn-light fw-semibold px-4 py-2 text-secondary rounded-3">Batal</a>
                    <button type="submit" class="btn fw-bold px-4 py-2 rounded-3 shadow-sm btn-submit-blue">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Simpan Data Klien
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'premium_form_style.php'; ?>