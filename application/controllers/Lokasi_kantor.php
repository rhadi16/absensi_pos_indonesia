<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi_kantor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Lokasi_kantor_model');
        $this->load->library('form_validation');

        is_logged_in();
        cek_admin();
    }

    public function index()
    {
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = "Lokasi Kantor";

        $this->form_validation->set_rules('jarak', 'Jarak', 'required|numeric|trim', array('required' => 'Jarak Harus Diisi', 'numeric' => 'Isi Jarak dengan Format Angka'));

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/admin_header', $data);
            $this->load->view('lokasi_kantor/index');
            $this->load->view('templates/admin_footer');
        } else {
            $this->Lokasi_kantor_model->setLokasi();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('lokasi_kantor');
        }
    }
}
