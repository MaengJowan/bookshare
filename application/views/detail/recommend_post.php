<div id="base_url" style="display:none"><?= base_url() ?></div>
<div id="get_id" style="display:none"><?= $result['id'] ?></div>
<div id="recommend_post" class="hero detail__page">
    <?php $this->load->view("templates/aside") ?>
    <main>
        <div class="container post_container">
            <div class="post">
                <div class="table-container t_con">
                    <table class="table is-striped post_table">
                        <tr class="tr_head">
                            <td><?= $result['nickname'] ?></td>
                            <td><?= $result['title'] ?></td>
                            <td><?= $result['saveTime'] ?></td>
                        </tr>
                        <tr class="post_content">

                            <td class="content" colspan="3"><?= $result['content']; ?></td>
                        </tr>
                    </table>
                    <?php
                    if ($this->session->userdata('nickname') == $result['nickname']) {
                    ?>
                        <button type="button" class="button" onclick='location.href="<?= base_url() ?>detail/recommend/<?= $result['id'] ?>/modify"'>Modify</button>
                        <button type="button" class="button" id="deleteBtn">Delete</button>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>
</div>