<aside class="aside menu" id="menu">
    <p class="menu-label">
        BookofBest
    </p>
    <ul class="menu-list" id="main">
        <li><a class="link notice" href="<?= base_url()?>detail/notice">공지사항</a></li>
    </ul>
    <p class="menu-label">
        User
    </p>
    <ul class="menu-list" id="sub">
        <li class="caret"><a>Book</a>
            <ul>
                <li><a class="link bestSeller" href="<?= base_url()?>detail/bestSeller">베스트셀러</a></li>
                <li><a class="link recommend" href="<?= base_url()?>detail/recommend">공유해요 나만의 책</a></li>
            </ul>
        </li>
    </ul>
</aside>