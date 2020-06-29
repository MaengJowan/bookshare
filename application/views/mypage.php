<?php
$nickname = $this->session->userdata('nickname');
?>

<div class="mypage">
    <div class="profile__box">
        <div class="user__photo">
            <?php
            if (empty($userPhoto)) {
                echo '<i class="fas fa-user"></i>';
            } else {
                echo '<img src=' . $userPhoto . '>';
            }
            ?>
        </div>
        <div class="user__info">
            <p class="nickname"><?= $nickname ?></p>
            <p class="email"><?= $email ?></p>
            <p class="birthday"><?= $birthday ?></p>
        </div>

    </div>
    <ul class="mypage__btn">
        <li class="btn profile"><button class="button is-primary">프로필 수정</button></li>
        <li class="btn change_pw"><button class="button is-primary">비밀번호 변경</button> </li>
    </ul>
    <!-- modal bg -->
    <div class="modal__bg">
        <div class="close__btn">
            <i class="fas fa-times"></i>
        </div>
    </div>
    <!-- profile modal -->
    <div class="profile__modal">
        <div class="profile__box">
            <div class="photo">
                <?php
                if (empty($userPhoto)) {
                    echo '<i class="fas fa-user"></i>';
                } else {
                    echo '<img src=' . $userPhoto . '>';
                }
                ?>
            </div>
            <div class="form">
                <form method="post" enctype="multipart/form-data">
                    <p class="description">이미지는 64x64인 크기이어야 합니다.</p>
                    <input type="file" class="photo_file" accept="image/*">
                    <button type="button" class="button is-primary setBasicImageBtn" onclick="location.href='<?= base_url() . "mypage/setBaseImage" ?>'">기본 이미지로 변경</button>
                    <button type="button" class="button is-primary inputBtn">사진 업로드</button>
                </form>
            </div>
        </div>
        <div class="photo_ok">
            <button class="button is-primary photo_ok_btn">확인</button>
        </div>
    </div>

    <!-- password change modal -->
    <div class="change__pw__modal">
        <form method="post" class="check__pw__form">
            <label for="pw" class="label">현재 비밀번호 : </label>
            <input type="password" class="pw" placeholder="비밀번호 입력">
            <input type="submit" id="checkBtn" class="button is-warning" value="확인">
        </form>
        <form method="post" class="change__pw__form">
            <div class="field">
                <label for="new_pw" class="label">바꿀 비밀번호 : </label>
                <input type="password" class="new_pw" placeholder="8~12자로 입력">
            </div>
            <div class="field">
                <label for="pw_verify" class="label">비밀번호 확인: </label>
                <input type="password" class="pw_verify" placeholder="비밀번호 확인">
            </div>
            <div class="field">
                <input type="submit" value="비밀번호 변경하기" class="button is-warning submit">
            </div>
            <div class="field">
                <p class="show_condition"></p>
            </div>
        </form>
    </div>
</div>