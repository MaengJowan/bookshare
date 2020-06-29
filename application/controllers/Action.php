<?php
class Action extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }
    public function _index()
    {
    }
    public function uploadImage()
    {
        $path = $_SERVER["DOCUMENT_ROOT"];
        $path = $path . "/bookshare/uploadFiles";
        if (!file_exists($path . "/")) {
            mkdir($path, 0777, true);
        }
        if (isset($_FILES['imageFiles'])) {
            $total = count($_FILES['imageFiles']['name']);
            $uploadUrl = $_SERVER['DOCUMENT_ROOT'] . "/bookshare/uploadFiles";
            $uploadOK = 1;
            // Loop through each file
            for ($i = 0; $i < $total; $i++) {
                $name = $_FILES['imageFiles']['name'][$i];
                $temp = $_FILES['imageFiles']['tmp_name'][$i];
                if (move_uploaded_file($temp, $uploadUrl . "/" . $name)) {
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
    }
    public function deleteimgfile()
    {
        $path = $_SERVER["DOCUMENT_ROOT"];
        $path = $path . "/bookshare/uploadFiles";
        $imgfile = $this->input->post('deleteimgfileList');
        if (!empty($imgfile)) {
            $length =  count($imgfile);

            for ($i = 0; $i < $length; $i++) {
                $name = $imgfile[$i]['imgname'];
                $type = $imgfile[$i]['fileType'];

                unlink($path . "/" . $name . "." . $type);
                echo "삭제 완료";
            }
        }
    }
}
