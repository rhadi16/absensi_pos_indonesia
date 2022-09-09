<?php
defined('BASEPATH') or exit('No direct script access allowed');

class home_karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Karyawan_model');
        $this->load->library('form_validation');

        is_logged_in();
    }

    public function index()
    {
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = "Home";

        $this->load->view('templates/karyawan_header', $data);
        $this->load->view('karyawan/index');
        $this->load->view('templates/karyawan_footer');
    }
    public function qrcode()
    {
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = "Generate Qrcode";

        $this->load->view('templates/karyawan_header', $data);
        $this->load->view('karyawan/qrcode');
        $this->load->view('templates/karyawan_footer');
    }
    public function settingpassword()
    {
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = "Setting Password";

        $this->form_validation->set_rules('password_lama', 'Password Sekarang', 'required|trim', array('required' => 'Password Sekarang Harus Diisi'));
        $this->form_validation->set_rules('password_baru1', 'Password Baru', 'required|trim|min_length[8]|matches[password_baru2]', array('required' => 'Password Baru Harus Diisi', 'min_length' => 'Password Baru Tidak Boleh Kurang 8 Karakter', 'matches' => 'Password Baru Tidak Sama Dengan Repeat Password'));
        $this->form_validation->set_rules('password_baru2', 'Repeat Password Baru', 'required|trim', array('required' => 'Repeat Password Baru Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/karyawan_header', $data);
            $this->load->view('karyawan/settingpassword');
            $this->load->view('templates/karyawan_footer');
        } else {
            $password_lama = $this->input->post('password_lama');
            $password_baru = $this->input->post('password_baru1');

            if (!password_verify($password_lama, $data['account']['password'])) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Password yang Dimasukkan Salah!</div>');
                redirect('home_karyawan/settingpassword');
            } else {
                if ($password_lama == $password_baru) {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Password yang Baru Tidak Boleh Sama dengan Password Lama!</div>');
                    redirect('home_karyawan/settingpassword');
                } else {
                    // password ok
                    $password_hash = password_hash($password_baru, PASSWORD_DEFAULT);

                    $this->Karyawan_model->settingpassword($password_hash);

                    $this->session->set_flashdata('flash', '<div class="alert alert-success" role="alert">Password Telah Diubah.</div>');
                    redirect('home_karyawan/settingpassword');
                }
            }
        }
    }
}
