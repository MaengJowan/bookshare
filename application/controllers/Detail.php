<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->_header();
    }
    public function _index()
    {
    }
    # recommend
    public function recommend($id = null, $urldata = null)
    {

        $this->load->model('recommend_model');
        $jsData['data'] = 'recommend';
        if (is_null($id)) {
            $result = $this->recommend_model->get_board();
            $this->load->view('detail/recommend', array('result' => $result));
        }
        if ($id == "write") {
            //write일때
            $this->load->view('detail/recommend_write', array('category' => '추천도서'));
            $jsData['data'] = 'recommendWrite';
            $this->_footer($jsData);
            return;
        }
        //writeAction일때
        if ($id == "writeAction") {
            $data = array(
                'nickname' => $this->session->userdata('nickname'),
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content'),
                'contentText' => $this->input->post('contentText')
            );
            $result = $this->recommend_model->insert_post($data);
            if ($result) {
                redirect("detail/recommend");
            } else {
                echo "alert('글쓰기에 실패했습니다!')";
                $this->load->view('detail/recommend_write', array('category' => '추천도서', 'data' => $data));
            }
            return;
        }
        //도서관 글 검색
        if ($id == "search") {
            $jsData['data'] = 'search';
            $searchBy = $this->input->post('search');
            error_reporting(E_ALL);
            ini_set("display_errors", 1);
            #python E:\Apache24\htdocs\bookshare\application\py\\test.py

            str_replace(" ", "&", $searchBy);
            $result = shell_exec("python E:\Apache24\htdocs\bookshare\application\py\\crolling.py 2>&1" . escapeshellarg($searchBy));
            $result = iconv("EUC-KR", "UTF-8", $result);
            $this->load->view('detail/search', array('result' => $result));
            $this->_footer($jsData);
            return;
        }
        //글 클릭
        if (!is_null($id) && is_null($urldata)) {
            $jsData['data'] = 'recommend_post';
            $result = $this->recommend_model->get_post($id);
            if ($result->num_rows() > 0) {
                $row = $result->row();
                $resultData = array(
                    'id' => $row->id,
                    'title' => $row->title,
                    'nickname' => $row->nickname,
                    'saveTime' => $row->saveTime,
                    'content' => $row->content
                );
                $this->load->view('detail/recommend_post', array('result' => $resultData));
            } else {
                $this->load->view('errors/404notfound');
            }
            $this->_footer($jsData);
            return;
        }
        //id를 받고 sql 검색 결과 없으면 error페이지 출력

        if (!is_null($id) && !is_null($urldata)) {
            //글 수정, 글 삭제
            $jsData['data'] = 'recommendWrite';
            if ($urldata == "modify") {
                $result = $this->recommend_model->rewrite_post($id);
                if ($result->num_rows() > 0) {
                    $row = $result->row();
                    $writtenData = array(
                        'id' => $row->id,
                        'title' => $row->title,
                        'content' => $row->content,
                        'saveTime' => $row->saveTime
                    );
                    $this->load->view('detail/recommend_write', array('data' => $writtenData, 'category' => "추천도서", 'url' => base_url() . "detail/recommend/$id/update"));
                    $this->_footer($jsData);
                } else {
                    echo "글읽기에 실패했습니다.";
                }
                return;
            }
            //recommend post update 
            if ($urldata == "update") {
                $data = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content'),
                    'contentText' => $this->input->post('contentText')
                );
                $result = $this->recommend_model->post_update($data, $id);
                // $result ? redirect('/detail/recommend') : "글쓰기에 실패했습니다.";
                if ($result) {
                    echo "1";
                } else {
                    echo "0";
                }
            }
            //recommend post delete
            if ($urldata == "delete") {
                $result = $this->recommend_model->post_delete($id);
                $result ? redirect('detail/recommend') : "글삭제에 실패했습니다.";
            }
            if ($urldata != "update" && $urldata != "delete") {
                $this->load->view("errors/404notfound");
            }
        }
        $this->_footer($jsData);
    }
    # notice
    public function notice($page = 1, $id = null, $urldata = null)
    {
        $this->load->model('notice_model');
        $jsData['data'] = 'notice';
        //만약 id가 null값이면 그냥 공지사항 리스트를 보여준다.
        if (is_null($id)) {
            $result = $this->notice_model->get_board();
            $per_page = 10;
            //pagination
            $post_count = $result->num_rows();
            $pagination = ceil($post_count / $per_page);

            $per_page_post_list = $this->notice_model->get_page_board($page, $per_page);

            $this->load->view('/detail/notice', array('result' => $per_page_post_list, 'page' => $page, 'pagination' => $pagination));
            $this->_footer($jsData);
            return;
        }
        //id가 write면 글쓰기창
        if ($id == "write") {
            is_null($urldata) ? $this->load->view('detail/' . $id) : $this->load->view('errors/404notfound');
            $this->_footer($jsData);

            return;
        }
        if ($id == "writeAction") {
            $data = array(
                'nickname' => $this->session->userdata('nickname'),
                'title' => $this->input->post('title'),
                'content' => $this->input->post('content')
            );
            $result = $this->notice_model->insert_post($data);
            $result ? redirect('detail/notice') : "글쓰기에 실패했습니다.";
            $this->_footer($jsData);
            return;
        }
        //id가 있다. 글 하나 눌렀을 때
        if (!is_null($id) && is_null($urldata)) {
            $result = $this->notice_model->get_post($id);
            if ($result->num_rows() > 0) {
                $row = $result->row();
                $resultData = array(
                    'id' => $row->id,
                    'title' => $row->title,
                    'nickname' => $row->nickname,
                    'saveTime' => $row->saveTime,
                    'content' => $row->content
                );
                $category = "공지사항";
                $this->load->view('detail/notice_post', array('id' => $id, 'resultData' => $resultData, 'category' => $category));
                $this->_footer($jsData);
            }
            return;
            //id가 있고 data도 있을 떄
        }
        if (!is_null($id) && !is_null($urldata)) {
            if ($urldata == "modify") {
                $result = $this->notice_model->rewrite_post($id);
                if ($result->num_rows() > 0) {
                    $row = $result->row();
                    $writtenData = array(
                        'title' => $row->title,
                        'content' => $row->content
                    );
                    $this->load->view('detail/write', array('data' => $writtenData, 'category' => "notice", 'url' => base_url() . "detail/notice/$id/update"));
                    $this->_footer($jsData);
                } else {
                    echo "글읽기에 실패했습니다.";
                }
                $this->_footer($jsData);
                return;
            }
            if ($urldata == "update") {
                $data = array(
                    'title' => $this->input->post('title'),
                    'content' => $this->input->post('content')
                );
                $result = $this->notice_model->post_update($data, $id);
                $result ? redirect('/detail/notice') : "글쓰기에 실패했습니다.";
                $this->_footer($jsData);
                return;
            }
            if ($urldata == "delete") {
                $result = $this->notice_model->post_delete($id);
                $result ? redirect('detail/notice') : "글삭제에 실패했습니다.";
            }
            $this->load->view("errors/404notfound");
        }
    }
    #bestSeller
    public function bestSeller($id = null, $urldata = null)
    {
        $jsData['data'] = 'bestSeller';
        if (is_null($id)) {
            $this->load->view('detail/bestSeller');
        } else {
            $this->load->view('detail/bestSeller_post', array('id' => $id));
        }
        $this->_footer($jsData);
    }

    function _footer($jsData)
    {

        $this->_mfooter($jsData);
    }
}
# 디테일이라는 index
# index - recommend 
#       - notice
#       - bestseller
# - 첫번째 인자($param = 글의 번호나 write) 두 번째 인자는 ($param2 = update, delete)
# - notice와 bestseller는 공통된 write, update, delete메소드를 갖는다.
#   이들은 상속하는 MY_Controller에 구현한다.
#   파라미터로 어디서 들어오는 url인지 구분한다
# 
