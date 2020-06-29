<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		// Your own constructor code
		$this->load->model('login_model');
	}
	public function index()
	{
		if ($this->session->userdata('logged_in')) {
			echo "<script>
				alert('이미 로그인을 하셨습니다.');
				window.location.href='" . base_url() . "';
				</script>";
		}
		$jsdata['data'] = "index";
		$this->_header();
		$this->load->view('login');
		$this->login_model->set_users_table();
		$this->_mfooter($jsdata);
	}
	function action()
	{
		$result = $this->login_model->login($this->input->post('id'), $this->input->post('pw'));
		if ($result) {
			//세션 발급
			$result = $this->login_model->getNickName($this->input->post('id'));
			$nickname =  $result->nickname;
			$email = $result->userEmail;

			if ($result == false) {
				echo "alert('세션 발급에 실패했습니다.');";
				redirect('/login');
			}
			$sessionData = array(
				'nickname'  => $nickname,
				'email'     => $email,
				'logged_in' => TRUE
			);
			$this->session->set_userdata($sessionData);
			redirect('/');
		} else {
			echo "<script>
				alert('아이디가 잘못됐거나 비밀번호가 틀렸습니다.');
				window.location.href='" . base_url() . "login';
				</script>";
		}
	}
}
