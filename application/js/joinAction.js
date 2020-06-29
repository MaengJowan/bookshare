/*
 * value가 ""일 때 그냥 넘어가게 하기
 */
class inputNickName {
  constructor() {}

  nickNameInputAddEventListener() {
    const nickname = document.querySelector('.nickname');
    const nickInput = nickname.querySelector('input');
    const li = document.getElementById('NicknameLi');
    const checkIcon = nickname.querySelector('.is-right');
    //특수문자를 사용했다면 return, 아니면 다음 조건
    if (this.inputCheckSpecial(nickInput.value, checkIcon)) {
      return;
    }
    //닉네임 길이 검사
    else {
      if (nickInput.value.length > 2 && nickInput.value.length < 11) {
        //마지막 중복검사
        this.checkNickname(nickInput.value);
      } else {
        checkIcon.classList.remove('has-text-success');
        checkIcon.classList.add('has-text-danger');

        li.classList.remove('is-success', 'is-primary');
        li.classList.add('is-danger');
        li.innerText = '2-8자로 입력해주세요!';
      }
    }
  }
  //특수문자 검사
  inputCheckSpecial(str, checkIcon) {
    var special = /[~!@#$%^&*()_+|<>?:{}]/;
    if (special.test(str)) {
      var li = document.getElementById('NicknameLi');
      li.classList.remove('is-success');
      li.classList.add('is-danger');

      li.innerText = '특수문자는 사용할 수 없습니다!';
      checkIcon.classList.remove('has-text-success');
      checkIcon.classList.add('has-text-danger');
      return true;
    } else {
      return false;
    }
  }
  //ajax 중복 검사
  checkNickname(nick) {
    const nickname = document.querySelector('.nickname');
    const li = document.getElementById('NicknameLi');
    const checkIcon = nickname.querySelector('.is-right');
    $.ajax({
      crossOrigin: true,
      method: 'POST',
      url: './join/nickCheck',
      data: { nickCheck: nick },
      success: function (data) {
        if (data === '1') {
          //값 중복
          nickFalse();
        } else if (data === '0') {
          //값 없음
          nickTrue();
        } else {
          console.log(data);
        }
      },
      error: function (request, status, error) {
        console.log(
          'code:' +
            request.status +
            '\n' +
            'message:' +
            request.responseText +
            '\n' +
            'error:' +
            error
        );
      }
    });
    function nickFalse() {
      checkIcon.classList.remove('has-text-success');
      checkIcon.classList.add('has-text-danger');
      li.classList.remove('is-success', 'is-primary');
      li.classList.add('is-danger');
      li.innerText = '이미 있는 닉네임입니다.';
    }
    function nickTrue() {
      checkIcon.classList.remove('has-text-danger');
      checkIcon.classList.add('has-text-success');
      li.classList.remove('is-danger', 'is-primary');
      li.classList.add('is-success');
      li.innerText = '사용할 수 있는 닉네임입니다.';
    }
  }
}
/*
 * email check
 */
class inputEmail {
  emailInputAddEventListener() {
    const email = document.querySelector('.email');
    const inputEmail = email.querySelector('input');
    const icon = email.querySelector('.is-right');
    const li = document.getElementById('emailLi');
    //to do : 이메일 중복 체크
    if (this.emailVaildCheck(inputEmail.value)) {
      this.checkEmail(inputEmail.value);
    } else {
      icon.classList.remove('has-text-success');
      icon.classList.add('has-text-danger');
      li.classList.remove('is-primary', 'is-success');
      li.classList.add('is-danger');
      li.innerText = '올바르지 않은 이메일 형식입니다.';
    }
  }
  //이메일 유효성 검사
  emailVaildCheck(str) {
    const regExp = /^[A-Za-z0-9_\.\-]+@[A-Za-z0-9\-]+\.[A-Za-z0-9\-]+/;
    if (regExp.test(str)) {
      return true;
    } else {
      return false;
    }
  }
  //이메일 중복 검사
  checkEmail(str) {
    const email = document.querySelector('.email');
    const icon = email.querySelector('.is-right');
    const li = document.getElementById('emailLi');

    // let httpRequest = new XMLHttpRequest();
    // if (!httpRequest) {
    //   console.log('ajax 문제가 있다.');
    //   return false;
    // }
    // httpRequest.onreadystatechange = printContent();
    // httpRequest.open('POST', 'join/emailcheck');
    // httpRequest.send();
    // function printContent() {
    //   if (httpRequest.readyState === XMLHttpRequest.DONE) {
    //     if (httpRequest.status === 200) {
    //       alert(httpRequest.responseText);
    //       if (httpRequest.responseText === '1') {
    //         //값 중복
    //         emailFalse();
    //       } else if (httpRequest.responseText === '0') {
    //         //사용할 수 있는 이메일
    //         emailTrue();
    //       } else {
    //         console.log(httpRequest.responseText);
    //       }
    //     }
    //   }
    // }
    $.ajax({
      crossOrigin: true,
      type: 'POST',
      url: './join/emailcheck',
      data: { CheckEmail: str },
      success: function (data) {
        if (data === '1') {
          //값 중복
          emailFalse();
        } else if (data === '0') {
          //사용할 수 있는 이메일
          emailTrue();
        } else {
          console.log(data);
        }
      }
    });
    function emailFalse() {
      icon.classList.remove('has-text-success');
      icon.classList.add('has-text-danger');
      li.classList.remove('is-primary', 'is-success');
      li.classList.add('is-danger');
      li.innerText = '이미 사용하고 있는 이메일입니다.';
    }
    function emailTrue() {
      icon.classList.remove('has-text-danger');
      icon.classList.add('has-text-success');
      li.classList.remove('is-primary', 'is-danger');
      li.classList.add('is-success');
      li.innerText = '사용할 수 있는 이메일입니다!';
    }
  }
}
class inputPassword {
  passwordInputAddEventListener() {
    const li = document.getElementById('passwordLi');
    const password = document.getElementById('password');
    if (this.passwordCheck(password.value)) {
      li.classList.remove('is-primary', 'is-danger');
      li.classList.add('is-success');
      li.innerText = '사용할 수 있는 비밀번호입니다!';
    } else {
      li.classList.remove('is-success', 'is-primary');
      li.classList.add('is-danger');
      li.innerText = '6-12자가 필요합니다.';
    }
    this.passwordVerifyInputAddEventListener();
  }
  passwordCheck(str) {
    if (str.length > 5 && str.length < 13) {
      return true;
    } else {
      return false;
    }
  }
  passwordVerifyInputAddEventListener() {
    const passwordVerify = document.getElementById('passwordVerify');
    const icon = document
      .querySelector('.passwordVerify')
      .querySelector('.is-right');
    const p = document.getElementById('passwordVerifyP');
    const password = document.getElementById('password');
    if (passwordVerify.value != password.value) {
      icon.classList.remove('has-text-success');
      icon.classList.add('has-text-danger');

      p.innerText = '비밀번호가 일치하지 않습니다.';
      p.classList.remove('is-success');
      p.classList.add('is-danger');
    } else {
      icon.classList.remove('has-text-danger');
      icon.classList.add('has-text-success');

      p.innerText = '비밀번호가 일치합니다.';
      p.classList.remove('is-danger');
      p.classList.add('is-success');
    }
  }
}
class inputBirthday {
  inputYearAddEventListener() {
    const year = document.getElementById('year');
    const date = new Date();
    const currnetYear = date.getFullYear();
    const p = document.getElementById('yearP');
    if (year.value === '') {
      return;
    }
    if (parseInt(year.value) > 1900 && parseInt(year.value) < currnetYear) {
      p.innerText = '';
    } else {
      p.innerText = '잘못된 년(연) 입력입니다.';
    }
  }
  inputMonthAddEventListener() {
    const month = document.getElementById('month');
    const p = document.getElementById('monthP');
    if (month.value === '') {
      return;
    }
    if (parseInt(month.value) > 0 && parseInt(month.value) < 13) {
      p.innerText = '';
    } else {
      p.innerText = '잘못된 월 입력입니다.';
    }
  }
  inputDayAddEventListener() {
    const day = document.getElementById('day');
    const p = document.getElementById('dayP');
    if (day.value === '') {
      return;
    }
    if (parseInt(day.value) > 0 && parseInt(day.value) < 32) {
      p.innerText = '';
    } else {
      p.innerText = '잘못된 일 입력입니다.';
    }
  }
}
class gender {
  cookieGender() {
    const gender = this.getCookie('gender');
    if (gender === '남자') {
      document.getElementById('men').checked = true;
    } else if (gender === '여자') {
      document.getElementById('women').checked = true;
    } else {
      return;
    }
  }
  getCookie(cname) {
    var name = cname + '=';
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for (var i = 0; i < ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return '';
  }
}
class submit {
  nickVaild() {
    const nicknameLi = document.getElementById('NicknameLi');
    if (nicknameLi.className === 'help is-success') {
      return true;
    } else {
      return false;
    }
  }
  emailVaild() {
    const emailLi = document.getElementById('emailLi');
    if (emailLi.textContent != '사용할 수 있는 이메일입니다!') {
      return false;
    } else {
      return true;
    }
  }
  pwdVaild() {
    const password = document.getElementById('password');
    const passwordVerify = document.getElementById('passwordVerify');
    if (
      password.value != passwordVerify.value ||
      password.value == '' ||
      passwordVerify.value == ''
    ) {
      return false;
    } else {
      const pwdli = document.getElementById('passwordLi');
      const pwdVli = document.getElementById('passwordVerifyP');
      if (
        pwdli.textContent === '사용할 수 있는 비밀번호입니다!' &&
        pwdVli.textContent === '비밀번호가 일치합니다.'
      ) {
        return true;
      }
      return false;
    }
  }
  birthVaild() {
    const year = document.getElementById('yearP');
    const month = document.getElementById('monthP');
    const day = document.getElementById('dayP');
    if (year.value === '' || month.value === '' || day.value === '') {
      return false;
    }
    return true;
  }
  genderVaild() {
    const men = document.getElementById('men');
    const women = document.getElementById('women');
    if (men.checked == false && women.checked == false) {
      return false;
    } else {
      return true;
    }
  }
}
export {
  inputNickName,
  inputEmail,
  inputPassword,
  inputBirthday,
  gender,
  submit
};
