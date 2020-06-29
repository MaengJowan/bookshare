<!DOCTYPE html>
<html lang=ko>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Best Book | MBB </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.8.2/css/bulma.min.css">
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>
    <script src="https://code.jquery.com/jquery-latest.min.js"></script>
    <script src="<?= base_url() ?>application/dist/jquery.ajax-cross-origin.min.js"></script>
</head>

<body>
    <?php
    var_dump($this->session->all_userdata());
    ?>
    <nav class="navbar" role="navigation" aria-label="main navigation">
        <div class="navbar-brand">
            <a class="navbar-item" href="<?= base_url("/"); ?>">
                <img src="<?= base_url("application/images/logo.png"); ?>" width="112" height="28">
            </a>

            <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
                <span aria-hidden="true"></span>
            </a>
        </div>

        <div id="navbarBasicExample" class="navbar-menu">
            <div class="navbar-start">
                <a class="navbar-item" href="<?= base_url() ?>detail/bestSeller">
                    베스트셀러
                </a>

                <a class="navbar-item" href="<?= base_url() ?>detail/recommend">
                    공유해요 나만의 책
                </a>

                <div class="navbar-item has-dropdown is-hoverable">
                    <a class="navbar-link">
                        More
                    </a>

                    <div class="navbar-dropdown">
                        <a class="navbar-item">
                            About
                        </a>
                        <a class="navbar-item">
                            Contact
                        </a>
                        <hr class="navbar-divider">
                        <a class="navbar-item">
                            Report an issue
                        </a>
                    </div>
                </div>
            </div>
            <div class="navbar-end">
                <div class="navbar-item">
                    <div class="buttons">
                        <?php
                        //session_start();
                        $isLogin = $this->session->userdata('logged_in');
                        if (isset($isLogin)) {
                        ?>
                            <a class="button is-warning" href="<?= base_url("/mypage") ?>">
                                My Page
                            </a>
                            <a class="button is-warning" href="<?= base_url("/logout") ?>">
                                Log out
                            </a>
                        <?php
                        } else {
                        ?>
                            <a class="button is-warning" href="<?= base_url("/join") ?>">
                                <strong>Sign up</strong>
                            </a>
                            <a class="button is-warning" href="<?= base_url("/login") ?>">
                                Log in
                            </a>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <ul class="navbar__menu">
            <a href="<?= base_url() ?>detail/notice">
                <li>공지 사항</li>
            </a>
            <a href="<?= base_url() ?>detail/bestSeller">
                <li>베스트셀러</li>
            </a>
            <a href="<?= base_url() ?>detail/recommend">
                <li>공유해요 나만의 책</li>
            </a>
            <?php
            if (!isset($_SESSION['logged_in'])) {
            ?>
                <a href="<?= base_url() ?>login">
                    <li>로그인</li>
                </a>
                <a href="<?= base_url() ?>join">
                    <li>회원 가입</li>
                </a>
            <?php
            } else {
            ?>
                <a href="<?= base_url() ?>mypage">
                    <li>마이 페이지</li>
                </a>
                <a href="<?= base_url() ?>logout">
                    <li>로그 아웃</li>
                </a>
            <?php
            }
            ?>
        </ul>
    </nav>