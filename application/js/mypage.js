class mypageEvent {
  modalCloseBtn() {
    const modalBack = document.querySelector('.modal__bg');
    const modalProfile = document.querySelector('.profile__modal');
    const modalChangePw = document.querySelector('.change__pw__modal');
    //비밀번호 변경 모달 dom 추가하기

    modalBack.setAttribute('style', 'display:none');
    modalProfile.setAttribute('style', 'display:none');
    modalChangePw.setAttribute('style', 'display:none');
  }
  profileBtn() {
    const modalBack = document.querySelector('.modal__bg');
    const modalProfile = document.querySelector('.profile__modal');

    modalBack.setAttribute('style', 'display:block');
    modalProfile.setAttribute('style', 'display:flex');
  }
  changePwBtn() {
    const modalBack = document.querySelector('.modal__bg');
    const modalChangePw = document.querySelector('.change__pw__modal');

    modalBack.setAttribute('style', 'display:block');
    modalChangePw.setAttribute('style', 'display:flex');
  }
}
class changePw {
  async checkPw(pw) {
    const url = './mypage/checkPw';
    await $.ajax({
      crossOrigin: true,
      type: 'POST',
      url: `${url}`,
      data: { pw: pw },
      success: function (response) {
        if (response === '1') {
          const checkForm = document.querySelector('.check__pw__form');
          checkForm.setAttribute('style', 'display:none');

          const changeForm = document.querySelector('.change__pw__form');
          changeForm.setAttribute('style', 'display:flex');
        } else {
          console.log(response);
          alert('비밀번호가 다릅니다.');
          return false;
        }
      }
    });
  }
  conditionPw() {
    const verify = document.querySelector('.pw_verify');
    const pw = document.querySelector('.new_pw');
    const show = document.querySelector('.show_condition');
    if (pw.value.length > 7 && pw.value.length < 13) {
      const url = './mypage/checkPw';
      $.ajax({
        crossOrigin: true,
        type: 'POST',
        url: `${url}`,
        data: { pw: pw.value },
        success: function (response) {
          if (response === '1') {
            //이전 비밀번호와 일치함.
            show.classList.remove('has-text-primary');
            show.classList.add('has-text-danger');
            show.innerText = '이전에 사용했던 비밀번호입니다.';
          } else {
            //이전 비밀번호와 일치하지 않음
            show.classList.remove('has-text-danger');
            show.classList.add('has-text-success');
            show.innerText = '사용가능한 비밀번호입니다.';
          }
        }
      });
    } else {
      show.classList.remove('has-text-primary');
      show.classList.add('has-text-danger');
      show.innerText = '8~12자로 입력하셔야합니다.';
    }
  }

  checkSamePw() {
    const verify = document.querySelector('.pw_verify');
    const pw = document.querySelector('.new_pw');
    const show = document.querySelector('.show_condition');
    //비밀번호 일치 조건
    if (pw.value.length > 7 && pw.value.length < 13) {
      if (verify.value === pw.value) {
        show.classList.remove('has-text-danger');
        show.classList.add('has-text-success');
        show.innerText = '비밀번호가 일치합니다.';
      } else {
        show.classList.remove('has-text-primary');
        show.classList.add('has-text-danger');
        show.innerText = '비밀번호가 불일치합니다.';
      }
    }
  }
  async submit(show) {
    if (show.innerText === '비밀번호가 일치합니다.') {
      const pw = document.querySelector('.new_pw');
      const url = './mypage/updatePw';
      await $.ajax({
        crossOrigin: true,
        type: 'POST',
        url: `${url}`,
        data: { pw: pw.value },
        success: function (response) {
          if (response === '1') {
            //비밀번호 변경 성공
            alert('비밀번호를 변경하였습니다.');
            location.reload();
          } else {
            //비밀번호 변경 실패
            alert('비밀번호 변경에 실패하셨습니다.');
            return false;
          }
        },
        error: function (request, status, error) {
          alert(
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
    } else {
      alert('비밀번호 제출 불가능');
    }
  }
}
class profile {
  getCurrentThumbnail(userPhoto) {
    for (let i = 0; i < userPhoto.childNodes.length; i++) {
      const nodename = userPhoto.childNodes[i].nodeName;
      if (nodename === 'svg') {
        return false;
      }
      if (nodename === 'IMG') {
        const src = userPhoto.childNodes[i].src;
        const filename = src.split('/').slice(-1);
        return filename;
      }
    }
  }
  inputBtn() {
    document.querySelector('.form .photo_file').click();
  }
  viewFile() {
    const file = document.querySelector('.photo_file').files[0];
    const fileArray = file;
    if (file.name.length) {
      const img = document.createElement('img');
      const photo = document.querySelector('div.photo');
      img.className = 'profile_img';
      img.src = URL.createObjectURL(file);

      img.onload = function () {
        URL.revokeObjectURL(this.src);
      };
      let isSVG = false;
      for (let i = 0; i < photo.childNodes.length; i++) {
        //만약 div에 svg,img 있으면 photo안에 있는 모든 노드를 삭제함.
        if (
          photo.childNodes[i].nodeName === 'svg' ||
          photo.childNodes[i].nodeName === 'IMG'
        ) {
          isSVG = true;
        }
      }
      if (isSVG) {
        while (photo.firstChild) {
          photo.removeChild(photo.firstChild);
        }
        img.setAttribute('style', 'display:block');
      }
      photo.appendChild(img);
      return fileArray;
    }
  }
  async deleteThumbnail(currnetImage) {
    const url = './mypage/deleteThumbnail';
    const data = new Object();
    data.name = currnetImage[0].split('.')[0];
    data.type = currnetImage[0].split('.')[1];
    await $.ajax({
      crossOrigin: true,
      type: 'POST',
      url: `${url}`,
      data: { data: data },
      success: function (response) {
        if (response === '1') {
          location.reload();
        } else {
          console.log(response);
          alert('썸네일삭제에 실패했습니다.');
          return false;
        }
      }
    });
  }
  async uploadFile(fileArray, currentThumbnail) {
    //기존 이미지가 있다면, 이미지 삭제할 준비
    const img = document.querySelector('img.profile_img');
    console.log(fileArray);
    if (img.width !== 64 || img.height !== 64) {
      alert('이미지가 64x64가 아닙니다.');
      return false;
    } else {
      //upload를 위한 셋팅
      let imageFormData = new FormData();
      let random = Math.random() * 10000;
      random = Math.floor(random);
      const date = new Date().getTime();
      const imageFileType = fileArray.type.split('/');

      const data = new Object();
      data.name = `ti${date + '' + random}`;
      data.type = `${imageFileType[1]}`;

      imageFormData.append('thumbnail', fileArray, `${data.name}.${data.type}`);
      const url = './mypage/thumbnailUpdate';
      //파일 전송할 때 data타입 _쓰지말것...
      await $.ajax({
        crossOrigin: true,
        type: 'POST',
        url: `${url}`,
        data: imageFormData,
        enctype: 'multipart/form-data',
        contentType: false,
        processData: false,
        success: function (response) {
          if (response === '1') {
            if (!currentThumbnail) {
              location.reload();
            }
          } else {
            console.log(response);
            alert('업로드에 실패했습니다.');
            return false;
          }
        }
      });
    }
  }
}

export { mypageEvent, profile, changePw };
