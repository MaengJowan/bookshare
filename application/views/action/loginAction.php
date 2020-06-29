<?php
    include("../../pageName.php");
    include("../../db.php");

    $id = $_POST["id"];
    $pw = $_POST["pw"];

    $sql = "SELECT userEmail, userPassword, nickname FROM users WHERE userEmail = '$id' AND userPassword ='$pw'";

    $result=mysqli_query($con, $sql);
    $nick = "";
    if(mysqli_num_rows($result)){
        global $nick;
        $nick = getNickName();
        settingSession();
        
        echo "
        <script>
            location.href='$home';
        </script>";
    } else{
        echo "
        <script>
            alert('아이디가 잘못되었거나 비밀번호가 일치하지 않습니다!');

        </script>";
    }
    function getNickName(){
        global $result;
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
              $nick =  $row["nickname"];
            }
            return $nick;
        };
    };
    function settingSession(){
        global $nick, $id;
        session_start();
        $_SESSION["id"] = $id;
        $_SESSION["nick"] = $nick;
    }
