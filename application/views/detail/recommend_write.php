<?php
#세션이 있는지 체크 있다면 공지 카테고리인 경우 관리자가 아니면 권한 없다고 출력
if (isset($_SESSION['logged_in'])) {
    $nickname = $this->session->userdata("nickname");
} else {
    echo "
        <script>
            alert('로그인부터 하세요!');
            location.href='" . base_url() . "login';
        </script>
    ";
}
if (!isset($url)) {
    $url = base_url() . "detail/recommend/writeAction";
}
if (isset($data['title'])) {
    $title = $data['title'];
    $content = $data['content'];
} else {
    $title = "";
    $content = "";
}
$baseUrl = base_url();
?>
<div class="modal_black_div"></div>
<div class="base_url" style="display:none"><?= $baseUrl ?></div>
<div class="container" id="recommend_write">
    <div id="modal">
        <input type="text" class="modal_input" name="width" placeholder="원하는 가로길이를 입력하세요." />
        <button type="button" id="modalConfirm">확인</button><button type="button" id="modalCancel">취소</button>
    </div>
    <form action="<?= $url ?>" method="post" id="recommend_write_form">
        <div class="field">
            <div class="control">
                <div class="field">
                    <label class="label nickname" name="nickname"><?= $nickname ?></label>
                    <label class="label" name="category"><?= $category ?></label>
                    <label class="label">제 목</label>
                </div>
                <input class="input title" type="text" placeholder="제목" name="title" value="<?= $title ?>">
            </div>
        </div>
        <div class="field">
            <div class="control">
                <div id="editor" contenteditable="true" style="height:500px"><?= $content ?></div>
            </div>
        </div>
        <div class="field">
            <input class="input" type="file" name="myfile" id="file" accept="image/*">
            <button class="button" type="button" id="uploadButton">글에 이미지 올리기</button>
        </div>
        <div class="field">
            <div class="control">
                <button class="button" type="button" onclick="history.back()">Cancel</button>
                <button class="button" type="submit">Write</button>
            </div>
        </div>
    </form>
</div>