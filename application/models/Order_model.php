<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    // Ambil semua produk yang stoknya masih ada
    public function get_aktif_produk() {
        $this->db->where('stok >', 0);
        return $this->db->get('produk')->result_array();
    }

    // Ambil semua data pelanggan untuk pilihan di drop-down
    public function get_all_pelanggan() {
        return $this->db->get('pelanggan')->result_array();
    }

    // Generate Nomor Order Otomatis (Format: SO-YYYYMMDD-XXXX)
    public function generate_no_order() {
        $tanggal = date('Ymd');
        $prefix = "SO-" . $tanggal . "-";
        
        // Cari nomor terakhir di hari ini
        $this->db->like('no_order', $prefix, 'after');
        $this->db->order_by('no_order', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('sales_order')->row_array();

        if ($query) {
            // Jika sudah ada order hari ini, ambil 3 digit terakhir lalu + 1
            $no_terakhir = substr($query['no_order'], -3);
            $next_no = sprintf('%03d', intval($no_terakhir) + 1);
        } else {
            // Jika belum ada order hari ini, mulai dari 001
            $next_no = '001';
        }

        return $prefix . $next_no;
    }

    // =========================================================================
    // SINKRONISASI TRANSMISI DATA SALES ORDER (MVC INTEGRATED)
    // =========================================================================

    /**
     * Menyimpan data transaksi baru (Induk & Rincian Detail Item)
     * Sinkron dengan controller sales/Dashboard::tambah_order
     */
    public function insert_sales_order($data_order, $data_detail) {
        $this->db->trans_start();
        
        // 1. Insert ke tabel induk (sales_order)
        $this->db->insert('sales_order', $data_order);
        
        // Ambil ID auto_increment dari sales_order yang baru dimasukkan
        $id_order = $this->db->insert_id();
        
        // Pasangkan ID Header ke array rincian detail
        $data_detail['id_order'] = $id_order;
        
        // 2. Insert ke tabel rincian item (detail_order)
        $this->db->insert('sales_order_detail', $data_detail);
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    /**
     * Memperbarui data transaksi (Induk & Rincian Detail Item)
     * Sinkron dengan controller sales/Dashboard::edit_order
     */
    public function update_sales_order($id_order, $data_order, $data_detail) {
        $this->db->trans_start();
        
        // 1. Update tabel induk
        $this->db->where('id_order', $id_order);
        $this->db->update('sales_order', $data_order);
        
        // 2. Update tabel rincian detail item
        $this->db->where('id_order', $id_order);
        $this->db->update('sales_order_detail', $data_detail);
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // Ambil SEMUA order dari SEMUA sales untuk tampilan Admin
    public function get_all_orders() {
        $this->db->select('sales_order.*, pelanggan.nama_pelanggan, sales.nama_sales');
        $this->db->from('sales_order');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = sales_order.id_pelanggan');
        $this->db->join('sales', 'sales.id_sales = sales_order.id_sales');
        $this->db->order_by('sales_order.id_order', 'DESC');
        return $this->db->get()->result_array();
    }

    // Ambil DATA order spesifik milik sales yang sedang login
    public function get_orders_by_sales($id_user) {
        $this->db->select('sales_order.*, pelanggan.nama_pelanggan, sales.nama_sales');
        $this->db->from('sales_order');
        $this->db->join('pelanggan', 'sales_order.id_pelanggan = pelanggan.id_pelanggan');
        $this->db->join('sales', 'sales_order.id_sales = sales.id_sales');
        $this->db->where('sales.id_user', $id_user); 
        $this->db->order_by('sales_order.id_order', 'DESC');
        return $this->db->get()->result_array();
    }

    // Update status order (Draft -> Dikirim -> Selesai / Dibatalkan)
    public function update_status($id_order, $status_baru) {
        $this->db->where('id_order', $id_order);
        return $this->db->update('sales_order', ['status' => $status_baru]);
    }

    // ================= CRUD PRODUK =================
    public function get_all_produk() {
        return $this->db->get('produk')->result_array();
    }

    public function get_produk_by_id($id) {
        return $this->db->get_where('produk', ['id_produk' => $id])->row_array();
    }

    public function insert_produk($data) {
        return $this->db->insert('produk', $data);
    }

    public function update_produk($id, $data) {
        $this->db->where('id_produk', $id);
        return $this->db->update('produk', $data);
    }

    public function delete_produk($id) {
        $this->db->where('id_produk', $id);
        return $this->db->delete('produk');
    }

    // Otomatisasi generate kode produk (PRD001, PRD002, dst)
    public function generate_kode_produk() {
        $this->db->select('kode_produk');
        $this->db->order_by('kode_produk', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('produk')->row_array();

        if ($query) {
            $no_terakhir = substr($query['kode_produk'], 3);
            $next_no = sprintf('%03d', intval($no_terakhir) + 1);
        } else {
            $next_no = '001';
        }
        return 'PRD' . $next_no;
    }

    // ================= CRUD PELANGGAN =================
    public function get_produk_pelanggan() { 
        return $this->db->get('pelanggan')->result_array(); 
    }
    
    public function get_pelanggan_by_id($id) { 
        return $this->db->get_where('pelanggan', ['id_pelanggan' => $id])->row_array(); 
    }
    
    public function insert_pelanggan($data) { 
        return $this->db->insert('pelanggan', $data); 
    }
    
    public function update_pelanggan($id, $data) { 
        $this->db->where('id_pelanggan', $id); 
        return $this->db->update('pelanggan', $data); 
    }
    
    public function delete_pelanggan($id) { 
        $this->db->where('id_pelanggan', $id); 
        return $this->db->delete('pelanggan'); 
    }

    // ================= READ & DELETE SALES =================
    public function get_all_sales_list() {
        $this->db->select('sales.*, users.username');
        $this->db->from('sales');
        $this->db->join('users', 'users.id_user = sales.id_user', 'left');
        return $this->db->get()->result_array();
    }

    public function delete_sales($id_sales) {
        $sales = $this->db->get_where('sales', ['id_sales' => $id_sales])->row_array();
        if ($sales) {
            $this->db->where('id_user', $sales['id_user']);
            $this->db->delete('users');
        }
        $this->db->where('id_sales', $id_sales);
        return $this->db->delete('sales');
    }

    // ================= MANAGEMENT SUMMARY LOGS =================
    public function get_total_omset() {
        $this->db->select_sum('total_harga');
        $this->db->where('status', 'selesai'); 
        $query = $this->db->get('sales_order')->row_array();
        return $query['total_harga'] ?? 0;
    }

    public function get_count_all_orders() {
        return $this->db->count_all('sales_order');
    }

    // Hitung jumlah order berdasarkan status tertentu (untuk KPI "Pending Pengiriman")
public function get_count_by_status($status) {
    $this->db->where('status', $status);
    return $this->db->count_all_results('sales_order');
}

// Ambil data header order + info pelanggan & sales (untuk halaman detail)
public function get_order_header($id_order) {
    $this->db->select('sales_order.*, pelanggan.nama_pelanggan, pelanggan.alamat, pelanggan.no_telp, sales.nama_sales');
    $this->db->from('sales_order');
    $this->db->join('pelanggan', 'pelanggan.id_pelanggan = sales_order.id_pelanggan');
    $this->db->join('sales', 'sales.id_sales = sales_order.id_sales');
    $this->db->where('sales_order.id_order', $id_order);
    return $this->db->get()->row_array();
}

// Ambil rincian item produk dalam 1 order
public function get_order_detail_items($id_order) {
    $this->db->select('sales_order_detail.*, produk.nama_produk, produk.kode_produk');
    $this->db->from('sales_order_detail');
    $this->db->join('produk', 'produk.id_produk = sales_order_detail.id_produk');
    $this->db->where('sales_order_detail.id_order', $id_order);
    return $this->db->get()->result_array();
}
// Total omset milik sales tertentu (status selesai)
public function get_total_omset_by_sales($id_sales) {
    $this->db->select_sum('total_harga');
    $this->db->where('id_sales', $id_sales);
    $this->db->where('status', 'selesai');
    $query = $this->db->get('sales_order')->row_array();
    return $query['total_harga'] ?? 0;
}

// Total semua order milik sales tertentu
public function get_count_orders_by_sales($id_sales) {
    $this->db->where('id_sales', $id_sales);
    return $this->db->count_all_results('sales_order');
}

// Hitung order per status milik sales tertentu
public function get_count_by_status_sales($status, $id_sales) {
    $this->db->where('id_sales', $id_sales);
    $this->db->where('status', $status);
    return $this->db->count_all_results('sales_order');
}

// Laporan top produk terjual (berdasarkan order yang sudah status selesai)
public function get_laporan_per_produk($limit = 5) {
    $this->db->select('produk.nama_produk, produk.kode_produk, 
                        SUM(sales_order_detail.jumlah) as total_qty, 
                        SUM(sales_order_detail.jumlah * sales_order_detail.harga_satuan) as total_omset');
    $this->db->from('sales_order_detail');
    $this->db->join('produk', 'produk.id_produk = sales_order_detail.id_produk');
    $this->db->join('sales_order', 'sales_order.id_order = sales_order_detail.id_order');
    $this->db->where('sales_order.status', 'selesai');
    $this->db->group_by('sales_order_detail.id_produk');
    $this->db->order_by('total_omset', 'DESC');
    if ($limit) {
        $this->db->limit($limit);
    }
    return $this->db->get()->result_array();
}

// Laporan stok barang lengkap dengan nilai stok & status ketersediaan
public function get_laporan_stok() {
    $produk = $this->db->get('produk')->result_array();
    foreach ($produk as &$p) {
        $p['total_nilai_stok'] = $p['harga'] * $p['stok'];
        if ($p['stok'] <= 0) {
            $p['status_stok'] = 'Habis';
        } elseif ($p['stok'] < 10) {
            $p['status_stok'] = 'Stok Rendah';
        } else {
            $p['status_stok'] = 'Aman';
        }
    }
    return $produk;
}

// Ringkasan jumlah order per status (untuk laporan operasional admin)
public function get_ringkasan_status_order() {
    $statuses = ['draft', 'dikirim', 'selesai', 'dibatalkan'];
    $ringkasan = [];
    foreach ($statuses as $s) {
        $ringkasan[$s] = $this->get_count_by_status($s); // fungsi ini udah ada dari sebelumnya
    }
    return $ringkasan;
}

// Cek apakah produk masih terikat di transaksi sales_order_detail
public function is_produk_used($id_produk) {
    $this->db->where('id_produk', $id_produk);
    return $this->db->count_all_results('sales_order_detail') > 0;
}

// Cek apakah pelanggan masih terikat di transaksi sales_order
public function is_pelanggan_used($id_pelanggan) {
    $this->db->where('id_pelanggan', $id_pelanggan);
    return $this->db->count_all_results('sales_order') > 0;
}

// Cek apakah sales masih punya riwayat order
public function is_sales_used($id_sales) {
    $this->db->where('id_sales', $id_sales);
    return $this->db->count_all_results('sales_order') > 0;
}   
}