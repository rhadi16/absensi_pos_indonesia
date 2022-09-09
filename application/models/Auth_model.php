<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth_model extends CI_model
{
    public function login()
    {
        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        $acoount = $this->db->get_where('accounts', ['email' => $email])->row_array();

        if ($acoount) {
            if ($acoount['is_active'] == 1) {
                if (password_verify($password, $acoount['password'])) {
                    $data = array(
                        'nip' => $acoount['nip'],
                        'email' => $acoount['email'],
                        'role_id' => $acoount['role_id'],
                        'expired' => time() + 900
                    );
                    $this->session->set_userdata($data);

                    if ($this->input->post('remember', true) == 1) {
                        $dt_cookie = $this->encryption->encrypt($acoount['email']);
                        $cookie = array(
                            'name'   => 'remember_me',
                            'value'  => $dt_cookie,
                            'expire' => '900',
                            'secure' => TRUE
                        );

                        set_cookie($cookie);
                    }

                    if ($acoount['role_id'] == 1) {
                        redirect('admin');
                    } elseif ($acoount['role_id'] == 2) {
                        redirect('home_karyawan');
                    } elseif ($acoount['role_id'] == 3) {
                        // redirect('home');
                        echo "Siswa";
                    } else {
                        $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Role Anda Tidak Jelas!</div>');
                        redirect('auth');
                    }
                } else {
                    $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Password yang Anda Masukkan Salah!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Akun Belum Diaktifkan. Silahkan Aktifkan Melalui Email Anda!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('flash', '<div class="alert alert-danger" role="alert">Akun Belum Terdaftar!</div>');
            redirect('auth');
        }
    }
}
