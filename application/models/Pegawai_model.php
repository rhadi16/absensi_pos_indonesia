<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai_model extends CI_model
{
    public function getAllPegawai()
    {
        $this->db->where('nip !=', 1234);
        $this->db->join('role', 'role.id = accounts.role_id', 'left');
        return $this->db->get('accounts')->result_array();
    }

    public function getRole()
    {
        return $this->db->get('role')->result_array();
    }

    public function tambahPegawai()
    {
        $data = array(
            'nip' => $this->input->post('nip', true),
            'nama' => $this->input->post('nama', true),
            'jkl' => $this->input->post('jkl', true),
            'email' => $this->input->post('email', true),
            'password' => password_hash($this->input->post('password', true), PASSWORD_DEFAULT),
            'role_id' => $this->input->post('role_id', true),
            'is_active' => 1,
            'date_created' => date("Y-m-d H:i:s"),
        );

        $this->db->insert('accounts', $data);
    }
    public function editPegawai()
    {
        if ($this->input->post('password', true) == "") {
            $password = $this->input->post('password_lama', true);
        } else {
            $password = password_hash($this->input->post('password', true), PASSWORD_DEFAULT);
        }

        $data = array(
            'nip' => $this->input->post('nip', true),
            'nama' => $this->input->post('nama', true),
            'jkl' => $this->input->post('jkl', true),
            'email' => $this->input->post('email', true),
            'password' => $password,
            'role_id' => $this->input->post('role_id', true)
        );

        $this->db->where('nip', $this->input->post('nip_lama'));
        $this->db->update('accounts', $data);
    }
    public function hapusPegawai($nip)
    {
        $this->db->where('nip', $nip);
        $this->db->delete('accounts');
    }
    public function detailPegawai($nip)
    {
        $this->db->join('role', 'role.id = accounts.role_id', 'left');
        return $this->db->get_where('accounts', ['nip' => $nip])->row_array();
    }
}
