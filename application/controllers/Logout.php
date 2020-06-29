<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Logout extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
    }
    public function index()
    {
        if ($this->session->userdata()) {
            $this->session->sess_destroy();
            redirect("/");
        } else {
            echo "로그아웃 실패";
        }
    }
}
