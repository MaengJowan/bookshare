import '../../css/complie/entry.css';

import { click } from '../aside';
import { header } from '../header';

const nav = new header();
nav.burger();
const aside = new click();
aside.clickMenu();

const base_url = document.getElementById('base_url').innerText;

function deleteBtn() {
  document.getElementById('deleteBtn').addEventListener('click', () => {
    if (confirm('정말 삭제하시겠습니까??') == true) {
      const content = document.querySelector('td.content');
      let imgList = {};
      let cnt = 0;
      for (let i = 0; i < content.childNodes.length; i++) {
        if (content.childNodes[i].nodeName === 'IMG') {
          const img = content.childNodes[i].src.split('/').slice(-1);
          const imgInfo = img[0].split('.');
          imgList[cnt] = {
            imgname: imgInfo[0],
            fileType: imgInfo[1]
          };
          cnt++;
        }
      }
      console.log(imgList);
      sendJsonData(imgList);
      const id = document.getElementById('get_id').innerText;
      location.href = `${base_url}detail/recommend/${id}/delete`;
    } else return false;
  });
}
async function sendJsonData(imgList) {
  await $.ajax({
    method: 'POST',
    url: `${base_url}action/deleteImgFile`,
    data: { deleteimgfileList: imgList },
    processData: true,
    success: function (response) {
      console.log(response);
    }
  });
}
if (document.getElementById('deleteBtn')) {
  deleteBtn();
}
