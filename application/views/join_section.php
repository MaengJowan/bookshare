<section class="join hero">
    <div class="container">
        <form action="<?= $pageNamejoinAction ?>" method="post" id="formCheck">
            <div class=" field nickname">
                <label class="label">Nickname</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input" type="text" name="userNickname" id="nickname" placeholder="Text input" minlength="3" required>
                    <span class="icon is-small is-left">
                        <i class="fas fa-user"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-check"></i>
                    </span>
                </div>
                <ul class="input-requirement">
                    <li class="help is-primary" id="NicknameLi">2-8자이내, 특수문자 제외하고 입력가능합니다.</li>
                </ul>
            </div>

            <div class="field email">
                <label class="label">Email</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input" type="email" id="email" name="userEmail" placeholder="Email input">
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-check"></i>
                    </span>
                </div>
                <ul class="input-requirement">
                    <li class="help is-primary" id="emailLi">아이디로 사용됩니다.</li>
                </ul>
            </div>


            <div class="field password">
                <label class="label">Password</label>
                <div class="field">
                    <p class="control has-icons-left">
                        <input class="input" type="password" name="userPassword" id="password" placeholder="Password" minlength="5" maxlength="16">
                        <span class="icon is-small is-left">
                            <i class="fas fa-lock"></i>
                        </span>
                    </p>
                    <ul class="input-requirement">
                        <li class="help is-primary" id="passwordLi">6-12자가 필요합니다.</li>
                    </ul>
                </div>
            </div>
            <div class="field passwordVerify">
                <label class="label">Password Verify</label>
                <div class="control has-icons-left has-icons-right">
                    <input class="input" type="password" name="userPasswordVerify" id="passwordVerify" placeholder="Password" minlength="6" maxlength="16">
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-check"></i>
                    </span>
                </div>
                <p class="help" id="passwordVerifyP"></p>
            </div>
            <div class="field birthday">
                <label class="label" id="birthdayLabel">Your Birthday</label>
                <p>입력 예) 1994/02/03</p>
                <div class="control">
                    <div class="field">
                        <input class="input" type="text" name="year" id="year" placeholder="Year" maxlength="4">
                        <label class="label">/</label>
                        <input class="input" type="text" name="month" id="month" placeholder="Month" maxlength="2">
                        <label class="label">/</label>
                        <input class="input" type="text" name="day" id="day" placeholder="Day" maxlength="2">
                    </div>
                    <p class="help is-danger" id="yearP"></p>
                    <p class="help is-danger" id="monthP"></p>
                    <p class="help is-danger" id="dayP"></p>
                </div>
            </div>
            <div class="field gender">
                <label class="label">Your Gender</label>
                <div class="control">
                    <label class="radio">
                        <input type="radio" name="gender" id="men" value="남자">
                        Men
                    </label>
                    <label class="radio">
                        <input type="radio" name="gender" id="women" value="여자">
                        Women
                    </label>
                </div>

            </div>
            <div class="field is-grouped submit">
                <div class="control">
                    <button type="submit" class="button is-link" id="submit">Submit</button>
                </div>
                <div class="control">
                    <button type="button" class="button is-link is-light" onclick=location.href="history.back()">Cancel </button>
                </div>
            </div>
</section>