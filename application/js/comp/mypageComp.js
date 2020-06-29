import '../../css/complie/entry.css';
import { mypageEvent, profile, changePw } from '../mypage';
import { header } from '../header';

const nav = new header();
nav.burger();

const mypage = new mypageEvent();
const pfile = new profile();
const cpw = new changePw();

//modal 활성화시, 닫기 버튼
document.querySelector('.close__btn').addEventListener('click', () => {
  mypage.modalCloseBtn();
});
//패스워드 버튼
document.querySelector('li.change_pw button').addEventListener('click', () => {
  mypage.changePwBtn();

  //현재 패스워드 확인 버튼
  const form = document.querySelector('.check__pw__form');
  form.querySelector('.button').addEventListener('click', event => {
    event.preventDefault();
    const pw = form.querySelector('.pw').value;
    cpw.checkPw(pw);
  });
});
document.querySelector('.new_pw').addEventListener('keyup', () => {
  cpw.conditionPw();
});
document.querySelector('.pw_verify').addEventListener('keyup', () => {
  cpw.checkSamePw();
});
document
  .querySelector('.change__pw__form')
  .querySelector('.submit')
  .addEventListener('click', event => {
    event.preventDefault();
    const show = document.querySelector('.show_condition');
    cpw.submit(show);
  });

//프로필 수정 버튼
document.querySelector('li.profile button').addEventListener('click', () => {
  mypage.profileBtn();
});
//사진 업로드 버튼
document
  .querySelector('.profile__modal .inputBtn')
  .addEventListener('click', event => {
    event.preventDefault();
    //현재 썸네일을 받아온다.

    pfile.inputBtn();
  });
//기본 이미지로 변경
document.querySelector('.setBasicImageBtn').addEventListener('click', () => {
  const photo = document.querySelector('.photo');
  while (photo.firstChild) {
    photo.removeChild(photo.firstChild);
  }
  photo.innerHTML = `<i class="fas fa-user"></i>`;
});

let fileArray;
document.querySelector('.photo_file').addEventListener('change', () => {
  fileArray = pfile.viewFile();
});
document.querySelector('button.photo_ok_btn').addEventListener('click', () => {
  const userPhoto = document.querySelector('.user__photo');
  const currnetThumbnail = pfile.getCurrentThumbnail(userPhoto);
  console.log(currnetThumbnail);
  pfile.uploadFile(fileArray, currnetThumbnail);
  if (currnetThumbnail) {
    pfile.deleteThumbnail(currnetThumbnail);
  }
});
