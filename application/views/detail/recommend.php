<form id="search" action="<?= base_url() . "detail/recommend/search" ?>" method="post">
    <input type="text" name="search" /><button type="submit" class="button">검색</button>
</form>
<div id="recommend" class="hero detail__page">
    <?php $this->load->view("templates/aside") ?>
    <main>
        <?php
        if ($this->db->affected_rows() > 0) {
            foreach ($result->result() as $row) {
        ?>
                <div class="box post" onclick="location.href='<?= base_url() ?>detail/recommend/<?= $row->id ?>'">
                    <article class="media">
                        <div class="media-left">
                            <figure class="image is-64x64">
                                <?php
                                echo '<i class="fas fa-book-reader"></i>';
                                ?>
                            </figure>
                        </div>
                        <div class="media-content">
                            <div class="content">
                                <p>
                                    <strong><?= $row->title ?></strong> <small><?= $row->nickname ?></small>
                                    <br>
                                    <?= $row->contentText ?>
                                </p>
                            </div>
                            <nav class="level is-mobile">
                                <div class="level-left">
                                    <a class="level-item" aria-label="like">
                                        <span class="icon is-small">
                                            <i class="fas fa-heart" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                    <a class="level-item" aria-label="like">
                                        <span class="icon is-small">
                                            <i class="far fa-eye" aria-hidden="true"></i>
                                            <p><?= $row->hit ?></p>
                                        </span>
                                    </a>
                                </div>
                            </nav>
                        </div>
                    </article>
                </div>
        <?php
            }
        } else {
            echo "아직 글이 하나도 없네요.";
        }
        ?>
        <button type="button" class="button is-primary" onclick="location.href=`<?= base_url() . 'detail/recommend/write' ?>`">글쓰기</button>
    </main>
</div>