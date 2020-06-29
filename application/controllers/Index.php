<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Index extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->_header();
    }
    public function index()
    {
        $this->load->view('index');
        $this->_footer();
    }
    function _footer()
    {
        $jsData['data'] = 'index';
        $this->_mfooter($jsData);
    }
}
