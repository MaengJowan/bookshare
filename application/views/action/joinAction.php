<?php
error_reporting(E_ALL);

ini_set("display_errors", 1);
$nickname = $_POST["userNickname"];
$userEmail = $_POST["userEmail"];
$userPassword = $_POST["userPassword"];
$userPasswordVerify = $_POST["userPasswordVerify"];
$year = $_POST["year"];
$month = $_POST["month"];
$day = $_POST["day"];
$birthday = $year . "-" . $month . "-" . $day;
$gender = $_POST["gender"];
include('../db.php');

//if not exists user tables
$createTableSql = "CREATE TABLE IF NOT EXISTS users (

    userEmail varchar(100) NOT NULL,  
    nickname varchar(16) NOT NULL,  
    userPassword varchar(12) NOT NULL,
    userPasswordVerify varchar(12) NOT NULL,
    birthday varchar(10) NOT NULL,
    gender varchar(4) NOT NULL,  
    PRIMARY KEY (userEmail)  
  )";
$createTable = mysqli_query($con, $createTableSql);



//sql
$sqlInsert = "insert into users(userEmail, nickname, userPassword, userPasswordVerify, birthday, gender)
        values('$userEmail','$nickname','$userPassword','$userPasswordVerify','$birthday','$gender')";

//check
//nickcheck
check();
//$nickRow = mysqli_fetch_array($checkNick, MYSQLI_ASSOC);
//$emailRow = mysqli_fetch_array($checkEmail, MYSQLI_ASSOC);
function check(){
  global $con, $sqlInsert;
 $insert= mysqli_query($con, $sqlInsert);
 if($insert){
   echo "<script>
         alert('회원가입이 완료되었습니다.');
         document.location.href='./login.php';
         </script>";
    return;
 } else{
  echo "<script>
  alert('데이터베이스 오류입니다.');
  document.location.href='./index.php';
  </script>";
  return;
 }
}
mysqli_close($con);
// function settingCookie($str)
// {
//     if ($str === "닉네임") {
//       print "쿠키생성중";
//       global $nickname, $userEmail, $userPassword, $userPasswordVerify, $year, $month, $day, $gender;
//       $cookieName = array("nickname", "userEmail", "userPassword", "userPasswordVerify", "year", "month","day","gender");
//       $cookieValue = array($nickname, $userEmail, $userPassword, $userPasswordVerify, $year, $month,$day,$gender);
//       for($i=0; $i<count($cookieName); $i++){
//         //쿠키 5분동안 생성
//         setCookie($cookieName[$i],$cookieValue[$i], time()+("300"),"/");
//       };
//       print "쿠키생성완료";
//       echo "<script>
//         alert('닉네임 중복검사를 해주세요!');
//         document.location.href='./join.php';
//         </script>";
//     } else {
//       //쿠키 제거
//       if (isset($_SERVER['HTTP_COOKIE'])) {
//         $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
//         foreach($cookies as $cookie) {
//             $parts = explode('=', $cookie);
//             $name = trim($parts[0]);
//             setcookie($name, '', time()-300);
//             setcookie($name, '', time()-300, '/');
//         }
//     }
//         echo "<script>
//         alert('이미 가입된 이메일이 있습니다!');
//         document.location.href='./login.php';
//         </script>";
//     }
// };
