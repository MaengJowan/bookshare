<?php
    if($this->session->flashdata('message')){
        echo"
            <script>
                alert('이미 로그인을 하셨습니다!');
            </script>
        ";
        redirect('/');
    }
?>
<div class="login section">
    <div class="container">
        <div class="field">
            <h1>LOGIN</h1>
        </div>
        <form action="<?= base_url();?>login/action" method="post">
            <div class="field">
                <p class="control has-icons-left has-icons-right">
                    <input class="input" type="email" placeholder="Email" name="id">
                    <span class="icon is-small is-left">
                        <i class="fas fa-envelope"></i>
                    </span>
                    <span class="icon is-small is-right">
                        <i class="fas fa-check"></i>
                    </span>
                </p>
            </div>
            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="password" placeholder="Password" name="pw">
                    <span class="icon is-small is-left">
                        <i class="fas fa-lock"></i>
                    </span>
                </p>
            </div>
            <div class="field">
                <button type="submit" class="button is-success">
                    로그인하기
                </button>
                <button type="button" class="button is-primary" onclick="location.href='<?= base_url();?>join'">
                    회원가입하기
                </button>
            </div>
        </form>
    </div>
</div>