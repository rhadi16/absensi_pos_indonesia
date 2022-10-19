<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Absensi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = "Absensi";

        $this->load->view('templates/scanner_header', $data);
        $this->load->view('absensi/index');
        $this->load->view('templates/scanner_footer');
    }

    public function rekap()
    {
        is_logged_in();
        cek_admin();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();

        $data['judul'] = "Rekap Absensi";

        $data['pegawai'] = $this->Absensi_model->rekapAbsen();

        $data['jum_tanggal'] = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));

        $this->load->view('templates/admin_header', $data);
        $this->load->view('absensi/rekap', $data);
        $this->load->view('templates/admin_footer');
    }
    public function detailrekap()
    {
        is_logged_in();
        cek_admin();
        $data['account'] = $this->db->get_where('accounts', ['email' => $this->session->userdata('email')])->row_array();

        if ($this->input->post('bulan', true) == 0) {
            $data['bulan'] = date('m');
        } else {
            $data['bulan'] = $this->input->post('bulan', true);
        }

        if ($this->input->post('tahun', true) == '' || $this->input->post('tahun', true) == null) {
            $data['tahun'] = date('Y');
        } else {
            $data['tahun'] = $this->input->post('tahun', true);
        }

        $data['judul'] = "Rekap Absensi";

        $data['pegawai'] = $this->Absensi_model->rekapAbsen();

        $data['jum_tanggal'] = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));

        $this->load->library('pdf');
        $this->pdf->setPaper('A4', 'landscape');
        $this->pdf->filename = "rekap absen " . bulan($data['bulan']) . " " . $data['tahun'] . ".pdf";
        // $this->load->view('absensi/rekapdetail', $data);
        $this->pdf->load_view('absensi/rekapdetail', $data);
    }

    public function absen()
    {
        $this->form_validation->set_rules('result', 'ID', 'required|trim', array('required' => 'ID Harus Diisi, '));
        // $this->form_validation->set_rules('lat', 'Latitude', 'required|trim', array('required' => 'Latitude Harus Diisi, '));
        // $this->form_validation->set_rules('lon', 'Longitude', 'required|trim', array('required' => 'Longitude Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal! Nip, Jarak, dan Waktu tidak terisi. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            redirect('admin');
        } else {
            $this->Absensi_model->inputAbsen();
        }
    }

    public function adm_absen()
    {
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim', array('required' => 'NIP Harus Diisi'));
        $this->form_validation->set_rules('time', 'Date', 'required|trim', array('required' => 'Date Harus Diisi'));

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal! Ada Kesalahan. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            redirect('absensi/rekap');
        } else {
            $this->Absensi_model->inputAbsenAdmin();
        }
    }

    public function del_adm_absen()
    {
        $this->Absensi_model->hapusAbsenAdmin($this->input->post('id', true));
        $this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Absensi Karyawan Berhasil Dihapus. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
        redirect('absensi/rekap');
    }
}
