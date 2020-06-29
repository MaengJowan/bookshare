<div id="notice" class="hero detail__page">
    <?php $this->load->view("templates/aside") ?>
    <main class="notice__main">
        <div class="table-container">
            <table class="table">
                <thead>
                    <tr>
                        <th class="table__id">ID</th>
                        <th>Title</th>
                        <th>Writer</th>
                        <th class="table__date">Date</th>
                        <th>Hit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($this->db->affected_rows() > 0) {
                        foreach ($result->result() as $row) {
                    ?>
                            <tr onclick="location.href='<?= base_url() ?>detail/notice/<?= $page . "/" . $row->id ?>'">
                        <?php
                            echo "<td class='table__id'>" . $row->id . "</td>";
                            echo "<td class='table__title'>" . $row->title . "</td>";
                            echo "<td class='table__nickname'>" . $row->nickname . "</td>";
                            echo "<td class='table__date'>" . $row->saveTime . "</td>";
                            echo "<td>" . $row->hit . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<td colspan='5'>공지사항이 없네요.</td>";
                    }
                        ?>
                </tbody>
            </table>


            <nav class="pagination" role="navigation" aria-label="pagination">
                <ul class="pagination-list">
                    <?php
                    for ($i = 1; $i < $pagination; $i++) {
                        if ($page == $i) {
                    ?>
                            <li>
                                <a class="pagination-link is-current" href="<?= base_url() ?>detail/notice/<?= $i ?>" aria-label="Page <?= $i ?>" aria-current="page"><?= $i ?></a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li>
                                <a class="pagination-link" href="<?= base_url() ?>detail/notice/<?= $i ?>" aria-label="Page <?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php
                        }
                        ?>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
            <?php if ($this->session->userdata('nickname') == '관리자') { ?>
                <button class=" button" onclick="location.href='<?= base_url() ?>detail/notice/write'">쓰기</button>
            <?php } ?>
        </div>
    </main>
</div>