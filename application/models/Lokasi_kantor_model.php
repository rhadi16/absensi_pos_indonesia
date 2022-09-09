<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Lokasi_kantor_model extends CI_model
{
    public function setLokasi()
    {
        $data = array(
            'lat' => $this->input->post('lat', true),
            'lon' => $this->input->post('lon', true),
            'jarak' => $this->input->post('jarak', true)
        );

        $this->db->where('id', 1);
        $this->db->update('lokasi_kantor', $data);
    }
}
