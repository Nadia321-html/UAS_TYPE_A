<?php
class auth extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_operator');
        $this->load->library('session');
    }
    
    function login()
    {
        if (isset($_POST['submit'])) {
            // Validasi input
            $username = trim($this->input->post('username'));
            $password = trim($this->input->post('password'));
            
            // Cek apakah field kosong
            if (empty($username) || empty($password)) {
                $this->session->set_flashdata('error', 'Username dan password tidak boleh kosong!');
                redirect('auth/login');
                return;
            }
            
            try {
                // Proses login
                $hasil = $this->model_operator->login($username, $password);
                
                if ($hasil == 1) {
                    // Update last login
                    $update_data = array('last_login' => date('Y-m-d H:i:s'));
                    $this->db->where('username', $username);
                    $update_result = $this->db->update('operator', $update_data);
                    
                    if ($update_result) {
                        // Set session
                        $this->session->set_userdata(array(
                            'status_login' => 'oke', 
                            'username' => $username,
                            'login_time' => date('Y-m-d H:i:s')
                        ));
                        
                        $this->session->set_flashdata('success', 'Login berhasil! Selamat datang ' . $username);
                        redirect('dashboard');
                    } else {
                        $this->session->set_flashdata('error', 'Terjadi kesalahan saat update data login.');
                        redirect('auth/login');
                    }
                } else {
                    // Login gagal
                    $this->session->set_flashdata('error', 'Username atau password salah!');
                    redirect('auth/login');
                }
                
            } catch (Exception $e) {
                // Handle database error atau error lainnya
                log_message('error', 'Login Error: ' . $e->getMessage());
                $this->session->set_flashdata('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
                redirect('auth/login');
            }
            
        } else {
            // Cek apakah sudah login
            if ($this->session->userdata('status_login') == 'oke') {
                redirect('dashboard');
            }
            $this->load->view('form_login');
        }
    }
    
    function edit()
    {
        if (isset($_POST['submit'])) {
            $username = trim($this->input->post('username'));
            $password = trim($this->input->post('password'));
            $password_new = trim($this->input->post('password_new'));
            
            // Validasi input
            if (empty($username) || empty($password) || empty($password_new)) {
                $this->session->set_flashdata('error', 'Semua field harus diisi!');
                redirect('auth/form_reset');
                return;
            }
            
            // Validasi panjang password baru
            if (strlen($password_new) < 6) {
                $this->session->set_flashdata('error', 'Password baru minimal 6 karakter!');
                redirect('auth/form_reset');
                return;
            }
            
            try {
                $hasil = $this->model_operator->login($username, $password);
                
                if ($hasil == 1) {
                    // Update password
                    $update_data = array('password' => md5($password_new));
                    $this->db->where('username', $username);
                    $update_result = $this->db->update('operator', $update_data);
                    
                    if ($update_result) {
                        $this->session->sess_destroy();
                        $this->session->set_flashdata('success', 'Password berhasil diubah! Silakan login kembali.');
                        redirect('auth/login');
                    } else {
                        $this->session->set_flashdata('error', 'Gagal mengubah password. Silakan coba lagi.');
                        redirect('auth/form_reset');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Username atau password lama salah!');
                    redirect('auth/form_reset');
                }
                
            } catch (Exception $e) {
                log_message('error', 'Edit Password Error: ' . $e->getMessage());
                $this->session->set_flashdata('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
                redirect('auth/form_reset');
            }
            
        } else {
            chek_session_login();
            $this->load->view('form_reset');
        }
    }
    
    function form_reset()
    {
        $this->load->view('form_reset');
    }
    
    function registrasi()
    {
        $this->load->view('form_regis');
    }
    
    function regis()
    {
        if (isset($_POST['submit'])) {
            $nama = trim($this->input->post('nama', true));
            $username = trim($this->input->post('username', true));
            $password = trim($this->input->post('password', true));
            $confirm_password = trim($this->input->post('confirm_password', true));
            
            // Validasi input kosong
            if (empty($nama) || empty($username) || empty($password) || empty($confirm_password)) {
                $this->session->set_flashdata('error', 'Semua field harus diisi!');
                redirect('auth/registrasi');
                return;
            }
            
            // Validasi nama lengkap
            if (strlen($nama) < 2) {
                $this->session->set_flashdata('error', 'Nama lengkap minimal 2 karakter!');
                redirect('auth/registrasi');
                return;
            }
            
            // Validasi username format dan panjang
            if (strlen($username) < 3) {
                $this->session->set_flashdata('error', 'Username minimal 3 karakter!');
                redirect('auth/registrasi');
                return;
            }
            
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
                $this->session->set_flashdata('error', 'Username hanya boleh mengandung huruf, angka, dan underscore!');
                redirect('auth/registrasi');
                return;
            }
            
            // Validasi password
            if (strlen($password) < 6) {
                $this->session->set_flashdata('error', 'Password minimal 6 karakter!');
                redirect('auth/registrasi');
                return;
            }
            
            // Validasi password strength
            if (!preg_match('/[A-Z]/', $password)) {
                $this->session->set_flashdata('error', 'Password harus mengandung minimal 1 huruf besar!');
                redirect('auth/registrasi');
                return;
            }
            
            if (!preg_match('/[a-z]/', $password)) {
                $this->session->set_flashdata('error', 'Password harus mengandung minimal 1 huruf kecil!');
                redirect('auth/registrasi');
                return;
            }
            
            if (!preg_match('/[0-9]/', $password)) {
                $this->session->set_flashdata('error', 'Password harus mengandung minimal 1 angka!');
                redirect('auth/registrasi');
                return;
            }
            
            // Validasi konfirmasi password
            if ($password !== $confirm_password) {
                $this->session->set_flashdata('error', 'Password dan konfirmasi password tidak sama!');
                redirect('auth/registrasi');
                return;
            }
            
            // Validasi username sudah ada atau belum
            $this->db->where('username', $username);
            $cek_username = $this->db->get('operator');
            
            if ($cek_username->num_rows() > 0) {
                $this->session->set_flashdata('error', 'Username sudah digunakan! Pilih username lain.');
                redirect('auth/registrasi');
                return;
            }
            
            try {
                $data = array(
                    'nama_lengkap' => $nama,
                    'username' => $username,
                    'password' => md5($password),
                    'last_login' => date('Y-m-d H:i:s')
                );
                
                $insert_result = $this->db->insert('operator', $data);
                
                if ($insert_result) {
                    $this->session->set_flashdata('success', 'Registrasi berhasil! Akun Anda telah dibuat. Silakan login.');
                    redirect('auth/login');
                } else {
                    $this->session->set_flashdata('error', 'Registrasi gagal. Silakan coba lagi.');
                    redirect('auth/registrasi');
                }
                
            } catch (Exception $e) {
                log_message('error', 'Registration Error: ' . $e->getMessage());
                $this->session->set_flashdata('error', 'Terjadi kesalahan sistem. Silakan coba lagi.');
                redirect('auth/registrasi');
            }
            
        } else {
            $this->load->view('form_regis');
        }
    }
    
    function logout()
    {
        try {
            $this->session->sess_destroy();
            $this->session->set_flashdata('success', 'Anda berhasil logout.');
            redirect('auth/login');
        } catch (Exception $e) {
            log_message('error', 'Logout Error: ' . $e->getMessage());
            redirect('auth/login');
        }
    }
}