<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi_model extends CI_model
{
    public function rekapAbsen()
    {
        $q = $this->db->query("SELECT DISTINCT
                                a.nip,
                                b.nama
                            FROM tb_absensi a
                            LEFT JOIN accounts b ON a.nip = b.nip
                            ORDER BY a.nip");

        return $q->result_array();
    }
    public function jum_absen($nip, $date)
    {
        $q = $this->db->query("SELECT 
                                *
                            FROM tb_absensi a
                            WHERE DAY(a.time) = $date AND MONTH(a.time) = MONTH(now()) AND a.nip = $nip");

        return $q->result_array();
    }
    public function inputAbsen()
    {
        $dt_kr = explode('||', $this->input->post('result', true));
        $absen = $this->db->get_where('tb_absensi a', ['a.nip' => $dt_kr[0], 'date(a.time)' => date('Y-m-d')])->row_array();

        $loc_off = $this->db->get_where('lokasi_kantor', ['id' => 1])->row_array();

        if ($absen) {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Anda telah melakukan absen pada tanggal sekarang <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
            redirect('admin');
        } else {
            $jarak = intval($this->_getDistanceBetweenPoints($dt_kr[2], $dt_kr[3], $loc_off['lat'], $loc_off['lon']));

            if ($jarak > $loc_off['jarak']) {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger alert-dismissible fade show" role="alert">Gagal Melakukan Absensi! Anda Jauh Dari Kantor Silahkan Generate Ulang Qrcode.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                redirect('admin');
            } else {
                $data = array(
                    'nip' => $dt_kr[0],
                    'lat' => $dt_kr[2],
                    'lon' => $dt_kr[3],
                    'time' => $this->input->post('time', true)
                );

                $this->db->insert('tb_absensi', $data);

                $this->session->set_flashdata('flash', '<div class="alert alert-success alert-dismissible fade show" role="alert">Berhasil Melakukan Absensi. <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>');
                redirect('admin');
            }
        }
    }
    private function _getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet  = $miles * 5280;
        // $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return $meters;
        // return compact('miles','feet','yards','kilometers','meters'); 
    }
}
