<?php

$result = str_replace("'", '"', $result);

$result = json_decode(trim($result), true);
#var_dump($result);
#imgUrl, url, title, author, publisher, borrow

?>
<div id="search" class="hero">
    <?php $this->load->view("templates/aside") ?>
    <main class="search_container">
        <div class="libraryInfo">
            <span> 총 <?php echo end($result)['cnt']; ?> 건이 검색되었습니다. 더 많은 정보는 도서관에서 확인하세요! <a href='<?php echo end($result)["libraryUrl"]; ?>' target="_blank"><i class="fas fa-link"></i> 바로가기</a></span>
        </div>
        <?php
        foreach ($result as &$value) {
            if (!isset($value['cnt'])) {
        ?>
                <div class="box search_card">
                    <div class="img_container">
                        <img src=<?= $value["imgUrl"] ?> width="75" height="103">
                    </div>
                    <ul class="card_source">
                        <li class="book_title"><?= $value["title"] ?></li>
                        <li class="book_author"><?= $value["author"] ?></li>
                        <li class="book_publisher"><?= $value["publisher"] ?></li>
                        <li class="book_borrow"><strong><?= $value["borrow"] ?></strong></li>
                    </ul>
                    <div class="link">
                        <a href="<?= $value['url'] ?>" class="library_link" target="_blank">
                            <i class="fas fa-arrow-circle-right"></i>
                            <span>자세히 보기</span>
                        </a>
                    </div>
                </div>
        <?php
            }
        }
        ?>
</div>
</div>