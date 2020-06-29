<!--
to do
    - 앨범형 게시판, 책 이미지, 제목, 작성자 표시
    - 글쓰기 버튼 존재 (write.php로 넘어감)
    - pagenation 생성
-->
<div id="detail" class="hero"> 
    <?php $this->load->view("templates/aside") ?>
    <main>
        디테일입니다.
        <?php
        // if (is_null($_GET["page"])) {
        //     include("./notice.php");
        // } else {
        //     $data = $_GET["page"];
        //     include("./" . $data . ".php");
        // }
        ?>
    </main>
</div>