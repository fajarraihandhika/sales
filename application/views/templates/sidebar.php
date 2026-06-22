<?php
    // Ambil path URL saat ini untuk menentukan menu mana yang aktif
    $current_uri = uri_string();
    function is_active($prefix, $current_uri) {
        return (strpos($current_uri, $prefix) === 0) ? 'active-menu' : '';
    }
?>

<style>
    .sidebar-premium {
        background-color: #ffffff;
        border-right: 1px solid #e2e8f0;
        min-height: calc(100vh - 69px);
        padding: 30px 20px;
    }
    .sidebar-heading {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        color: #94a3b8;
        margin-left: 12px;
        margin-bottom: 12px;
    }
    .menu-link {
        display: flex;
        align-items: center;
        padding: 12px 16px;
        color: #475569;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        border-radius: 12px;
        margin-bottom: 6px;
        transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .menu-link i { font-size: 1.1rem; width: 28px; transition: transform 0.2s ease; }
    .menu-link:hover { background-color: #f1f5f9; color: #0f172a; }
    .menu-link:hover i { transform: translateX(3px); }
    .menu-link.active-menu { background: #e0f2fe; color: #0369a1; }
    .menu-link.text-danger:hover { background-color: #fef2f2; }
</style>

<div class="col-md-2 sidebar-premium">
    <div class="d-flex flex-column h-100">

        <div class="sidebar-heading">Operational Hub</div>

        <?php if($this->session->userdata('role') === 'admin'): ?>
            <a href="<?= base_url('admin/dashboard'); ?>" class="menu-link <?= is_active('admin/dashboard', $current_uri); ?>">
                <i class="fa-solid fa-table-cells-large text-primary me-2"></i> Core Control
            </a>
            <a href="<?= base_url('admin/produk'); ?>" class="menu-link <?= is_active('admin/produk', $current_uri); ?>">
                <i class="fa-solid fa-boxes-stacked me-2"></i> Stock Barang
            </a>
            <a href="<?= base_url('admin/pelanggan'); ?>" class="menu-link <?= is_active('admin/pelanggan', $current_uri); ?>">
                <i class="fa-solid fa-handshake me-2"></i> Client List
            </a>
            <a href="<?= base_url('admin/sales'); ?>" class="menu-link <?= is_active('admin/sales', $current_uri); ?>">
                <i class="fa-solid fa-id-card-clip me-2"></i> Sales Agents
            </a>

            <a href="<?= base_url('admin/laporan'); ?>" class="menu-link <?= is_active('admin/laporan', $current_uri); ?>">
    <i class="fa-solid fa-clipboard-list me-2"></i> Laporan Operasional
</a>

        <?php elseif($this->session->userdata('role') === 'sales'): ?>
            <a href="<?= base_url('sales/dashboard'); ?>" class="menu-link active-menu">
                <i class="fa-solid fa-chart-bar text-success me-2"></i> Sales Pipeline
            </a>

        <?php elseif($this->session->userdata('role') === 'manager'): ?>
            <a href="<?= base_url('manager/dashboard'); ?>" class="menu-link <?= ($current_uri == 'manager/dashboard') ? 'active-menu' : ''; ?>">
                <i class="fa-solid fa-wallet text-info me-2"></i> Revenue Stream
            </a>
            <a href="<?= base_url('manager/dashboard/cetak_laporan'); ?>" class="menu-link <?= is_active('manager/dashboard/cetak_laporan', $current_uri); ?>">
                <i class="fa-solid fa-file-pdf text-danger me-2"></i> Laporan Eksekutif
            </a>
        <?php endif; ?>

        <div class="sidebar-heading mt-4">Security Terminal</div>

        <a href="<?= base_url('auth/logout'); ?>" class="menu-link text-danger">
            <i class="fa-solid fa-power-off me-2"></i> Sign Out System
        </a>

    </div>
</div>