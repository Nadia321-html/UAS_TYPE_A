<?php
class Operator extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('model_operator');
        chek_session();
    }

    function index()
    {
        $data['record'] = $this->model_operator->tampil_data();
        $this->template->load('template', 'operator/lihat_data', $data);
    }
    function post()
    {
        if (isset($_POST['submit'])) {
            $nama_lengkap = $this->input->post('nama_lengkap');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $last_login = $this->input->post('last_login');
            $data = array('nama_lengkap' => $nama, 'username' => $username, 'password' => $password, 'last_login' => $last_login);
            $this->model_operator->post($data);
            redirect('operator');
        } else {
            $this->load->model('model_operator');
            $data['operator'] = $this->model_operator->tampilkan_data()->result();
            $this->template->load('template', 'operator/form_input', $data);
        }
    }

    function edit()
    {
        if (isset($_POST['submit'])) {
            // Process the form
            $id = $this->input->post('id');
            $nama = $this->input->post('nama_lengkap');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $last_login = $this->input->post('last_login');

            $data = array(
                'nama_lengkap' => $nama,
                'username' => $username,
                'password' => ($password),
                'last_login' => $last_login
            );

            $this->model_operator->edit_data($data, $id);
            redirect('operator');
        } else {
            $id = $this->uri->segment(3);
            $this->load->model('model_operator');
            $data['operator'] = $this->model_operator->tampilkan_data()->result();
            $data['record'] = $this->model_operator->get_one($id)->row_array();
            //$this->load->view('barang/form_edit','$data');
            $this->template->load('template', 'operator/form_edit', $data);
        }
    }
    function delete()
    {
        $id = $this->uri->segment(3);
        $this->model_operator->delete($id);
        //echo'Berhasil dihapus.';"Berhasi dihapus.';
        redirect('operator');
    }
}
