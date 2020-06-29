<div id="notice_post" class="hero detail__page">
    <?php $this->load->view("templates/aside") ?>
    <main>
        <div class="container notice__post__page">
            <div class="notification">
                <div class="table-container">
                    <table class="table is-striped">
                        <tr>
                            <td class="table_nickname"><?= $resultData['nickname'] ?></td>
                            <td class="table_savetime"><?= $resultData['saveTime'] ?></td>
                        </tr>
                        <tr>
                            <td class="table_title">제목</td>
                            <td class="table_title_content"><?= $resultData['title'] ?></td>
                        </tr>
                        <tr class="table__content">
                            <td colspan="2"><?= $resultData['content'] ?></td>
                        </tr>
                    </table>
                    <?php
                    if ($this->session->userdata('nickname') == "관리자") {
                    ?>
                        <button type="button" class="button" onclick='location.href="<?= base_url() ?>detail/notice/<?= $id ?>/modify"'>Modify</button>
                        <button type="button" class="button" onclick=check()>Delete</button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</div>
<script>
    function check() {
        if (confirm("정말 삭제하시겠습니까??") == true)
            location.href = "<?= base_url() ?>detail/notice/<?= $id ?>/delete";
        else
            return false;
    }
</script>