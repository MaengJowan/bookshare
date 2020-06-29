import '../../css/complie/entry.css';

import { click } from '../aside';
import { recommendFile } from '../recommendFile';
import { saveContent } from '../recommendWriteSaveContent';
import { header } from '../header';

const nav = new header();
nav.burger();
const aside = new click();
const rfile = new recommendFile();
const sContent = new saveContent();
let base_url;
if (document.querySelector('.base_url')) {
  base_url = document.querySelector('.base_url').innerText;
}
//when modify post, get img name in editor
let getModifyImgCnt = 0;
let modifyImgList = {};
//get basic editor element
window.addEventListener('load', () => {
  if (document.getElementById('editor').innerHTML !== '') {
    const editor = document.getElementById('editor');
    for (let i = 0; i < editor.childNodes.length; i++) {
      if (editor.childNodes[i].nodeName === 'IMG') {
        const img = editor.childNodes[i].src.split('/').slice(-1);
        const imgInfo = img[0].split('.');
        modifyImgList[getModifyImgCnt] = {
          imgname: imgInfo[0],
          fileType: imgInfo[1]
        };
        getModifyImgCnt++;
      }
    }
    // console.log('modifyImgList');
    // console.log(modifyImgList);
  }
});

//create image in editor
let fileInfoCnt = 0;
let fileinfo = [];
aside.clickMenu();
if (document.getElementById('uploadButton')) {
  document.getElementById('uploadButton').addEventListener('click', () => {
    rfile.uploadFile(fileInfoCnt, fileinfo);
    fileInfoCnt++;
  });
}
//if img doesn't have dblclick, add dbclick.(when modify)
window.addEventListener('load', () => {
  rfile.addDblclick();
});
//modal
const fixWidth = divImgName => {
  const blackDiv = document.querySelector('.modal_black_div');
  const modal = document.getElementById('modal');

  blackDiv.style.display = 'block';
  modal.style.display = 'block';

  document.getElementById('modalConfirm').addEventListener(
    'click',
    () => {
      const inputFalse = rfile.modalConfirm(divImgName);
      if (inputFalse === false) {
        fixWidth(divImgName);
      }
    },
    { once: true }
  );
  document.getElementById('modalCancel').addEventListener(
    'click',
    () => {
      rfile.modalCancel();
    },
    { once: true }
  );
};
window.fixWidth = fixWidth;
//ajax linstener
if (document.getElementById('recommend_write_form')) {
  document
    .getElementById('recommend_write_form')
    .addEventListener('submit', event => {
      event.preventDefault();

      //this is delete when user deleted img in content
      let temp = {}; //length : 0
      const realFileList = sContent.realFileList(fileinfo);
      const image = new Promise((resolve, reject) => {
        if (Object.keys(modifyImgList).length !== Object.keys(temp).length) {
          // console.log('deleteimageFile 실행');
          //submit
          sContent.deleteimageFile(modifyImgList, base_url);
        }

        resolve(sContent.uploadimageFile(realFileList));
      });

      //두번째
      image
        .then(data => {
          sContent.makeContentText(realFileList, data, base_url);
        })
        .finally(function () {
          // console.log('이미지 저장 실행.');
          sContent.passPostData(base_url);
        });
    });
}
