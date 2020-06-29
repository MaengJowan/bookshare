<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Join extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Your own constructor code
        $this->load->helper('url');
        $this->load->model('join_model');
    }
    function index()
    {
        $this->_header();
        $this->load->view('join');
        $this->join_model->set_users_table();
        $this->_footer();
    }
    function nickCheck()
    {
        $nickname = $this->input->post('nickCheck');
        $result = $this->join_model->getNickName($nickname);
        if ($result->num_rows() > 0) {
            echo "1";
        } else {
            echo "0";
        }
    }
    function emailCheck()
    {
        $email = $this->input->post('CheckEmail');
        $result = $this->join_model->getEmail($email);
        if ($result->num_rows() > 0) {
            echo "1";
        } else {
            echo "0";
        }
    }
    function action()
    {
        $data = array(
            'nickname' => $this->input->post('userNickname'),
            'useremail' => $this->input->post('userEmail'),
            'userPassword' => password_hash($this->input->post('userPassword'), PASSWORD_BCRYPT),
            'birthday' => $this->input->post('year') . $this->input->post('month') . $this->input->post('day'),
            'gender' => $this->input->post('gender')
        );
        $result = $this->join_model->insertUserInfo($data);
        if ($result) {
            redirect('/');
        } else {
            echo "
				<script>
					alert('회원가입에 실패했습니다.');
				</script>
			";
            redirect("/join");
        }
    }
    function _footer()
    {
        $jsData['data'] = 'joinAction';
        $this->_mfooter($jsData);
    }
}
