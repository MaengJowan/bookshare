<!-- 
    닉네임을 외래키로 받아와서 데이터베이스 구성
    write 페이지 들어올 때, 닉네임 받아와서 뿌려주기
    제출 버튼 클릭시 title, nickname, content, date, 저장하기
    저장한 db로부터 게시물 뿌려주기

-->
<?php
#세션이 있는지 체크 있다면 공지 카테고리인 경우 관리자가 아니면 권한 없다고 출력
if(isset($_SESSION['logged_in'])){
    $nickname=$this->session->userdata("nickname");
    
    if($category == "notice" && !$nickname =="관리자"){
        $this->load->view("errors/noPermission");
    }
} else{
    echo "
        <script>
            alert('로그인부터 하세요!');
            location.href='".base_url()."login';
        </script>
    ";
}
if(!isset($url)){
    $url = base_url()."detail/notice/writeAction";
}
if(isset($data['title'])){
    $title = $data['title'];
    $content = $data['content'];
}else{
    $title = "";
    $content = "";
}
?>
<div class="container">
    <form action="<?= $url?>" method="post">
        <div class="field">
            <div class="control">
                <div class="field">
                    <label class="label" name="nickname"><?= $nickname ?></label>
                    <label class="label" name="category"><?= $category ?></label>
                    <label class="label">제 목</label>
                </div>
                <input class="input" type="text" placeholder="제목" name="title" value="<?= $title ?>">
            </div>
        </div>
        <div class="field">
            <div class="control">
                <textarea class="textarea is-large" placeholder="Large textarea" name="content"><?= $content ?></textarea>
            </div>
        </div>
        <div class="field">
            <div class="control">
                <button class="button" type="button" onclick="history.back()">Cancel</button>
                <button class="button" type="submit">Write</button>
            </div>
        </div>
    </form>
</div>