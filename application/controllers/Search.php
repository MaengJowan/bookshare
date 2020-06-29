<?php
defined('BASEPATH') or exit('No direct script access allowed');

use function PHPSTORM_META\type;

class Search extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function index()
    {
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
        #python E:\Apache24\htdocs\bookshare\application\py\\test.py

        $data = $this->input->post('searchBy');
        str_replace(" ", "&", $data);
        $result = shell_exec("python E:\Apache24\htdocs\bookshare\application\py\\crolling.py 2>&1" . escapeshellarg($data));
        $result = iconv("EUC-KR", "UTF-8", $result);
        print_r($result);
        // echo $_POST['search'];
    }
}
