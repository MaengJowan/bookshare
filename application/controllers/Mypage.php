<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mypage extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('join_model');
        $this->load->model('login_model');
    }
    public function index()
    {
        $this->_header();
        $nickname = $this->session->userdata('nickname');
        $result = $this->join_model->get_profile_info($nickname);
        if ($result) {
            $birth = $result->birthday;
            $userPhoto = $result->userPhoto;
            $userEmail = $result->userEmail;
            $this->load->view('mypage', array('birthday' => $birth, 'userPhoto' => $userPhoto, 'email' => $userEmail));
        }
        $this->_footer();
    }
    public function setBaseImage()
    {
        $nickname = $this->session->userdata('nickname');
        $userPhoto = null;
        $result = $this->join_model->set_thumbnail($nickname, $userPhoto);
        if (!$result) {
            echo "alert('이미지 변경에 실패했습니다.')";
        }

        redirect("/mypage");
    }

    public function thumbnailUpdate()
    {
        $path = $_SERVER["DOCUMENT_ROOT"];
        $path = $path . "/bookshare/uploadFiles/thumbnail";
        if (!file_exists($path . "/")) {
            mkdir($path, 0777, true);
        }
        $uploadOK = 0;

        if (isset($_FILES['thumbnail'])) {
            $uploadUrl = $_SERVER['DOCUMENT_ROOT'] . "/bookshare/uploadFiles/thumbnail";
            $uploadOK = 1;

            $name = $_FILES['thumbnail']['name'];
            $temp = $_FILES['thumbnail']['tmp_name'];
            $result = move_uploaded_file($temp, $uploadUrl . "/" . $name);
            if ($result) {
                $userPhoto = base_url("/uploadFiles/thumbnail") . "/" . $name;
                $nickname = $this->session->userdata('nickname');
                $dbresult = $this->join_model->set_thumbnail($nickname, $userPhoto);
                if (!$dbresult) {

                    $uploadOK = 0;
                }
            } else {
                $uploadOK = 0;
            }
        }
        if ($uploadOK == 1) {

            echo "1";
        } else {
            echo "0";
        }
    }
    public function deleteThumbnail()
    {
        $path = $_SERVER["DOCUMENT_ROOT"];
        $path = $path . "/bookshare/uploadFiles/thumbnail";

        $data = $this->input->post('data');

        if (!empty($this->input->post('data'))) {

            $data = $this->input->post('data');
            $result = unlink($path . "/" . $data['name'] . "." . $data['type']);
            if (!$result) {
                echo "썸네일 삭제에 실패했습니다.";
            } else {
                echo "1";
            }
        }
    }
    public function checkPw()
    {
        $pw = $this->input->post('pw');
        $id = $this->session->userdata('email');

        $result = $this->login_model->login($id, $pw);
        if ($result) {
            echo "1";
        } else {
            echo "0";
        }
    }
    public function updatePw()
    {
        $id = $this->session->userdata('email');
        $pw = password_hash($this->input->post('pw'), PASSWORD_BCRYPT);
        $result = $this->join_model->updatePw($id, $pw);
        if ($result) {
            echo "1";
        } else {
            echo "0";
        }
    }
    function _footer()
    {
        $jsData['data'] = 'mypage';
        $this->_mfooter($jsData);
    }
}
