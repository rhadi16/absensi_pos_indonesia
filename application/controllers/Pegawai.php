<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->library('form_validation');

        is_logged_in();
        cek_admin();
    }

    public function index()
    {
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = "Pegawai";

        $data['pegawai'] = $this->Pegawai_model->getAllPegawai();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('pegawai/index', $data);
            $this->load->view('templates/admin_footer');
        } else {
            // $this->Auth_model->login();
        }
    }

    public function tambah()
    {
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = "Pegawai";

        $data['role'] = $this->Pegawai_model->getRole();

        $this->form_validation->set_rules('nip', 'NIP', 'required|numeric|is_unique[accounts.nip]', array('required' => 'NIP Harus Diisi', 'numeric' => 'Isi NIP dengan Angka', 'is_unique' => 'NIP Telah Terpakai'));
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama Harus Diisi'));
        $this->form_validation->set_rules('jkl', 'Jenis Kelamin', 'required|callback_check_jkl');
        $this->form_validation->set_message('check_jkl', 'Field Jenis Kelamin Harus Diisi');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[accounts.email]|trim', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email dengan Format yang Benar', 'is_unique' => 'Email Telah Digunakan'));
        $this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[8]|matches[password2]', array('required' => 'Password Harus Diisi', 'min_length' => 'Password Harus Lebih 8 Karakter', 'matches' => 'Password Tidak Sama Dengan Ulangi Password'));
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password]', array('required' => 'Ulangi Password Harus Diisi', 'min_length' => 'Password Harus Lebih 8 Karakter', 'matches' => 'Ulangi Password Tidak Sama Dengan Password'));
        $this->form_validation->set_rules('role_id', 'Status', 'required|callback_check_role');
        $this->form_validation->set_message('check_role', 'Field Status Harus Diisi');

        if ($this->form_validation->run() == FALSE) {
            $data['input'] = array(
                'nip' => $this->input->post('nip'),
                'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email')
            );

            $this->load->view('templates/admin_header', $data);
            $this->load->view('pegawai/tambah', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Pegawai_model->tambahPegawai();
            $this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Karyawan Berhasil Ditambah. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            redirect('pegawai');
        }
    }
    function check_jkl($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }
    function check_role($post_string)
    {
        return $post_string == '0' ? FALSE : TRUE;
    }

    public function edit($nip)
    {
        if ($this->input->post('nip') == $nip) {
            $this->form_validation->set_rules('nip', 'NIP', 'required|numeric', array('required' => 'NIP Harus Diisi', 'numeric' => 'Isi NIP dengan Angka'));
        } else {
            $this->form_validation->set_rules('nip', 'NIP', 'required|numeric|is_unique[accounts.nip]', array('required' => 'NIP Harus Diisi', 'numeric' => 'Isi NIP dengan Angka', 'is_unique' => 'NIP Telah Terpakai'));
        }
        $this->form_validation->set_rules('nama', 'Nama', 'required', array('required' => 'Nama Harus Diisi'));
        $this->form_validation->set_rules('jkl', 'Jenis Kelamin', 'required|callback_check_jkl');
        $this->form_validation->set_message('check_jkl', 'Field Jenis Kelamin Harus Diisi');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim', array('required' => 'Email Harus Diisi', 'valid_email' => 'Isi Email dengan Format yang Benar'));
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|matches[password2]', array('required' => 'Password Harus Diisi', 'min_length' => 'Password Harus Lebih 8 Karakter', 'matches' => 'Password Tidak Sama Dengan Ulangi Password'));
        $this->form_validation->set_rules('password2', 'Password', 'trim|matches[password]', array('required' => 'Ulangi Password Harus Diisi', 'min_length' => 'Password Harus Lebih 8 Karakter', 'matches' => 'Ulangi Password Tidak Sama Dengan Password'));
        $this->form_validation->set_rules('role_id', 'Status', 'required|callback_check_role');
        $this->form_validation->set_message('check_role', 'Field Status Harus Diisi');

        $data['user'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();
        $data['judul'] = "Pegawai";

        $data['pegawai'] = $this->Pegawai_model->detailPegawai($nip);
        $data['role'] = $this->Pegawai_model->getRole();

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('pegawai/edit', $data);
            $this->load->view('templates/admin_footer');
        } else {
            $this->Pegawai_model->editPegawai();
            $this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Karyawan Berhasil Diubah. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            redirect('pegawai');
        }
    }

    public function hapus($nip)
    {
        $this->Pegawai_model->hapusPegawai($nip);
        $this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Karyawan Berhasil Dihapus. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        redirect('pegawai');
    }
}
