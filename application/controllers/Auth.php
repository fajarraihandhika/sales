<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('auth_model');
    }

    public function index() {
        // Jika sudah login, tendang ke dashboard masing-masing
        if ($this->session->userdata('role')) {
            $this->redirect_by_role($this->session->userdata('role'));
        }

        // Aturan validasi form
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $this->_proses_login();
        }
    }

    private function _proses_login() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->auth_model->login($username);

        if ($user) {
            // Verifikasi password (mencocokkan text asli dengan hash di DB)
            // GANTI DENGAN INI:
if (md5($password) === $user['password']) {
                
                // Siapkan data session dasar
                $session_data = [
                    'id_user'      => $user['id_user'],
                    'username'     => $user['username'],
                    'nama_lengkap' => $user['nama_lengkap'],
                    'role'         => $user['role']
                ];

                // Khusus jika role-nya Sales, ambil juga id_sales-nya
                if ($user['role'] == 'sales') {
                    $sales = $this->auth_model->get_sales_id($user['id_user']);
                    $session_data['id_sales'] = $sales['id_sales'];
                }

                $this->session->set_userdata($session_data);
                
                // Redirect sesuai hak akses
                $this->redirect_by_role($user['role']);

            } else {
                $this->session->set_flashdata('message', '<div style="color:red;">Password salah!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div style="color:red;">Username tidak terdaftar!</div>');
            redirect('auth');
        }
    }

    private function redirect_by_role($role) {
        if ($role == 'admin') {
            redirect('admin/dashboard');
        } else if ($role == 'sales') {
            redirect('sales/dashboard');
        } else if ($role == 'manager') {
            redirect('manager/dashboard');
        }
    }

    // Auth.php - fungsi logout
public function logout() {
    $this->session->unset_userdata('id_user');
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('role');
    if($this->session->userdata('id_sales')) {
        $this->session->unset_userdata('id_sales');
    }
    $this->session->set_flashdata('success', 'Anda telah logout.');
    redirect('auth');
}

public function register() {
    if ($this->session->userdata('role')) {
        $this->redirect_by_role($this->session->userdata('role'));
    }

    $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[users.username]');
    $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
    $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[5]');

    if ($this->form_validation->run() == FALSE) {
        $this->load->view('auth/register');
    } else {
        $this->_proses_register_luar();
    }
}

private function _proses_register_luar() {
    // Role dikunci ke 'sales' — registrasi publik HANYA untuk tim sales lapangan
    $user_data = [
        'username'     => $this->input->post('username'),
        'nama_lengkap' => $this->input->post('nama_lengkap'),
        'password'     => md5($this->input->post('password')),
        'role'         => 'sales'
    ];

    $sales_data = [
        'id_sales_person' => $this->auth_model->generate_id_sales(),
        'nama_sales'      => $this->input->post('nama_lengkap')
    ];

    $simpan = $this->auth_model->register_user($user_data, $sales_data);

    if ($simpan) {
        $this->session->set_flashdata('message', 'Registrasi berhasil! Silakan login dengan akun Anda.');
        redirect('auth');
    } else {
        $this->session->set_flashdata('message', 'Registrasi gagal, coba lagi.');
        redirect('auth/register');
    }
}
}