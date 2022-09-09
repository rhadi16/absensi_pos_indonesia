<?php

function is_logged_in()
{
    $ci = get_instance();
    $data['account'] = $ci->db->get_where('accounts', ['email' => $ci->session->userdata('email')])->row_array();

    if (!$ci->session->userdata('email')) {
        redirect('auth');
    }

    if (!$data['account']) {
        redirect('auth/logout');
    }
}
function cek_admin()
{
    $ci = get_instance();
    if ($ci->session->userdata('role_id') != 1) {
        redirect('home_karyawan');
    }
}
function cek_user()
{
    $ci = get_instance();
    if ($ci->session->userdata('role_id') != 2) {
        redirect('home');
    }
}
function is_logged_out()
{
    $ci = get_instance();
    if ($ci->session->userdata('id')) {
        redirect('user');
    } else {
        if (get_cookie('remember_me')) {
            $cook = get_cookie('remember_me');
            $h = $ci->encryption->decrypt($cook);

            $user = $ci->db->get_where('users', ['email' => $h])->row_array();
            if ($user) {
                $data = array(
                    'id' => $user['id'],
                    'email' => $user['email'],
                    'role_id' => $user['role_id'],
                    'expired' => time() + 900
                );

                $ci->session->set_userdata($data);
                if ($user['role_id'] == 1) {
                    redirect('home');
                } else {
                    redirect('user');
                }
            }
        }
    }
}
function time_login()
{
    $ci = get_instance();

    if (time() > $ci->session->userdata('expired')) {
        redirect('auth/logout');
    } else {
        $ci->session->set_userdata('expired', time() + 900);
    }
}
