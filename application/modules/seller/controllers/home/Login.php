<?php

/*
 * @Author:    Hazitech
 *  Gitgub:    ""
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Login extends ADMIN_Controller
{

    public function index()
    {
        $data = array();
        $head = array();
        $head['title'] = 'Seller - Login';
        $head['description'] = '';
        $head['keywords'] = '';
        $this->load->view('_parts/header', $head);
        if ($this->session->userdata('logged_in')) {
            redirect('seller/home');
        } else {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run($this)) {
                //print_r($_POST);exit;
                $result = $this->Home_admin_model->loginCheck2($_POST);
                //print_r($this->db->last_query());exit;
                if (!empty($result)) {
                    $_SESSION['last_login'] = $result['last_login'];
                    $this->session->set_userdata('logged_in', $result['username']);
                    $this->saveHistory('User ' . $result['username'] . ' logged in');
                    redirect('seller/home');
                } else {
                    $this->saveHistory('Cant login with - User: ' . $_POST['username'] . ' and Pass: ' . $_POST['username']);
                    $this->session->set_flashdata('err_login', 'Wrong username or password!');
                    redirect('seller');
                }
            }
            $this->load->view('home/login');
        }
        $this->load->view('_parts/footer');
    }

}
