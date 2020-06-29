<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Templates extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function header($session)
    {
        $this->load->view('/templates/header', $session);
    }
    public function footer($jsdata)
    {
        $this->load->view('/templates/footer', $jsdata);
    }
    public function _index()
    {
    }
}
