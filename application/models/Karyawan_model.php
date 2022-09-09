<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan_model extends CI_model
{
    public function settingpassword($password_baru = null)
    {
        $this->db->set('password', $password_baru);
        $this->db->where('nip', $this->input->post('nip'));
        $this->db->update('accounts');
    }
}
