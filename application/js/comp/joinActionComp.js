import '../../css/complie/entry.css';
import {
  inputNickName,
  inputEmail,
  inputPassword,
  inputBirthday,
  gender,
  submit
} from '../joinAction';
import { header } from '../header';

const nav = new header();
nav.burger();
//NickName
document.getElementById('nickname').addEventListener('keyup', () => {
  const initInputNickName = new inputNickName();
  initInputNickName.nickNameInputAddEventListener();
});

//email
document.getElementById('email').addEventListener('keyup', () => {
  const initInputEmail = new inputEmail();
  initInputEmail.emailInputAddEventListener();
});

//password
document.getElementById('password').addEventListener('keyup', () => {
  const initInputPassword = new inputPassword();
  initInputPassword.passwordInputAddEventListener();
});
document.getElementById('passwordVerify').addEventListener('keyup', () => {
  const initInputPasswordVerify = new inputPassword();
  initInputPasswordVerify.passwordVerifyInputAddEventListener();
});

//birthday
document.getElementById('year').addEventListener('keyup', () => {
  const initInpuYear = new inputBirthday();
  initInpuYear.inputYearAddEventListener();
});
document.getElementById('month').addEventListener('keyup', () => {
  const initInpuMonth = new inputBirthday();
  initInpuMonth.inputMonthAddEventListener();
});
document.getElementById('day').addEventListener('keyup', () => {
  const initInpuDay = new inputBirthday();
  initInpuDay.inputDayAddEventListener();
});

//Vaildate
document.getElementById('formCheck').onsubmit = () => {
  const initsubmit = new submit();

  if (!initsubmit.emailVaild()) {
    document.getElementById('email').focus();
    alert('이메일을 조건에 맞게 입력하지 않았습니다.');
    return false;
  }
  if (!initsubmit.nickVaild()) {
    document.getElementById('nickname').focus();
    alert('아이디를 조건에 맞게 입력하지 않았습니다.');
    return false;
  }

  if (!initsubmit.pwdVaild()) {
    document.getElementById('passwordVerifyP').focus();
    alert('비밀번호를 조건에 맞게 입력하지 않았습니다.');
    return false;
  }
  if (!initsubmit.birthVaild()) {
    document.getElementById('year').focus();
    alert('생년월일을 조건에 맞게 입력하지 않았습니다.');
    return false;
  }
  if (!initsubmit.genderVaild()) {
    document.getElementById('men').focus();
    alert('성별을 조건에 맞게 입력하지 않았습니다.');
    return false;
  }
  sessionStorage.setItem('visit', false);
};
//when page load, change input value

//첫번째로 방문할 때는 작동x, 두번째부터 작동 o
window.addEventListener('load', () => {
  if (sessionStorage.getItem('visit') != null) {
    const initInputNickName = new inputNickName();
    initInputNickName.nickNameInputAddEventListener();

    const initInputEmail = new inputEmail();
    initInputEmail.emailInputAddEventListener();

    const initInputPassword = new inputPassword();
    initInputPassword.passwordInputAddEventListener();

    const initInpuYear = new inputBirthday();
    initInpuYear.inputYearAddEventListener();
    const initInpuMonth = new inputBirthday();
    initInpuMonth.inputMonthAddEventListener();
    const initInpuDay = new inputBirthday();
    initInpuDay.inputDayAddEventListener();

    const initGender = new gender();
    initGender.cookieGender();
  }
  sessionStorage.setItem('visit', true);
});
/* window.onclick 예제
document.getElementById("test").onclick = () => {
  const init = new test();
  init.test();
};
*/
