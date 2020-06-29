class saveContent {
  realFileList(fileinfo) {
    const div = document.getElementById('editor');
    let realFileInfo = [];
    let realFileInfoCNT = 0;
    for (let i = 0; i < div.childNodes.length; i++) {
      if (div.childNodes[i].nodeName === 'IMG') {
        const img = div.childNodes[i];
        //fileinfo에 들어있는 정보와 실체 전송하려는 이미지가 얼마나 일치하는지
        for (let j = 0; j < fileinfo.length; j++) {
          let checkimageindiv = false;
          if (img.alt === fileinfo[j].name) {
            checkimageindiv = true;
          }
          if (checkimageindiv === true) {
            realFileInfo[realFileInfoCNT] = fileinfo[j];
            realFileInfoCNT++;
            break;
          }
        }
      }
    }
    return realFileInfo;
  }
  async uploadimageFile(fileList) {
    let filenameArray = new Array();
    let form_data = new FormData();
    for (let i = 0; i < fileList.length; i++) {
      //date함수로 이미지이름 변환
      //시간차를 둬서 다른 파일 이름 생성
      let random = Math.random() * 10000;
      random = Math.floor(random);
      const date = new Date().getTime();
      const imageFileType = fileList[i].type.split('/');
      //json으로 이미지 정보 객체 생성
      const data = new Object();
      data.name = `i${date + '' + random}`;
      data.type = `${imageFileType[1]}`;

      filenameArray.push(data);
      form_data.append(
        'imageFiles[]',
        fileList[i],
        `i${date + '' + random}.${imageFileType[1]}`
      );
    }

    const form = document.getElementById('recommend_write_form');
    let url = '';
    if (form.action.split('/').slice(-1) == 'update') {
      url = '../../../action/uploadImage';
    } else if (form.action.split('/').slice(-1) == 'writeAction') {
      url = '../../action/uploadImage';
    }

    //action/uploadImage로 upload
    await $.ajax({
      crossOrigin: true,
      type: 'POST',
      url: `${url}`,
      data: form_data,
      enctype: 'multipart/form-data',
      contentType: false,
      processData: false,
      success: function (response) {},
      error: function (err) {}
    });

    return filenameArray;
  }

  makeContentText(fileList, data, baseUrl) {
    const editor = document.getElementById('editor');
    const cloneEditor = editor.cloneNode(true);
    let cnt = 0;
    for (let i = 0; i < cloneEditor.childNodes.length; i++) {
      const img = cloneEditor.childNodes[i];
      for (let j = 0; j < fileList.length; j++) {
        if (img.nodeName === 'IMG' && img.alt === fileList[j].name) {
          img.src = `${baseUrl}uploadFiles/${data[cnt].name}.${data[cnt].type}`;
          img.removeAttribute('ondblclick');
          cnt += 1;
        }
      }
    }
    const form = document.getElementById('recommend_write_form');
    //content
    const textarea = document.createElement('textarea');
    textarea.style.display = 'none';
    textarea.name = 'content';
    textarea.className = 'content';
    textarea.innerText = cloneEditor.innerHTML;
    form.append(textarea);

    //only text
    const content = document.createElement('textarea');
    content.style.display = 'none';
    content.className = 'contentText';
    content.name = 'contentText';
    const dump = document.createElement('div');
    dump.append(editor.innerText);
    content.innerText = dump.innerHTML;
    let loop = true;
    while (loop) {
      for (let i = 0; i < content.childNodes.length; i++) {
        if (content.childNodes[i].tagName == 'BR') {
          content.childNodes[i].remove();
        }
      }
      let cnt = 0;
      for (let i = 0; i < content.childNodes.length; i++) {
        if (content.childNodes[i].tagName == 'BR') {
          cnt++;
        }
      }
      if (cnt === 0) {
        loop = false;
      }
    }
    form.append(content);
    dump.remove();
  }
  async passPostData(baseUrl) {
    const content = document.querySelector('.content').value;
    const contentText = document.querySelector('.contentText').value;
    const title = document.querySelector('.title').value;
    const nickname = document.querySelector('.nickname').value;

    const form = document.getElementById('recommend_write_form');

    await $.ajax({
      crossOrigin: true,
      type: 'POST',
      url: `${form.action}`,
      data: {
        content: content,
        contentText: contentText,
        title: title,
        nickname: nickname
      },
      success: function (response) {
        //redirect
        location.href = `${baseUrl}detail/recommend`;
      },
      error: function (err) {
        alert('글쓰기에 실패했습니다.');
      }
    });
  }
  //delete img
  async deleteimageFile(modifyImgList, base_url) {
    const willDeleteImgList = this.deleteImgWhenModify(modifyImgList);
    await $.ajax({
      crossOrigin: true,
      method: 'POST',
      url: `${base_url}action/deleteImgFile`,
      data: { deleteimgfileList: willDeleteImgList },
      processData: true,
      success: function (response) {
        //console.log(response);
      }
    });
  }
  deleteImgWhenModify(modifyImgList) {
    //make result img list
    const editor = document.getElementById('editor');
    let resultImgListCnt = 0;
    let resultImgList = {};
    for (let i = 0; i < editor.childNodes.length; i++) {
      if (editor.childNodes[i].nodeName === 'IMG') {
        const img = editor.childNodes[i].src.split('/').slice(-1);
        const imgInfo = img[0].split('.');
        resultImgList[resultImgListCnt] = {
          imgname: imgInfo[0],
          fileType: imgInfo[1]
        };
        resultImgListCnt++;
      }
    }
    // console.log('resultImgList');
    // console.log(resultImgList);
    //compare twice list
    let willList = {}; //리턴할 array
    let willCnt = 0;

    //modifyImgList
    //resultImgList
    //두 json을 비교한다. modify에 있는 객체가 result에 없으면, will에 넣는다.
    //modify에 있는 객체가 result에 있으면 넘어간다.
    for (let i = 0; i < Object.keys(modifyImgList).length; i++) {
      let compareCnt = 0;
      for (let j = 0; j < Object.keys(resultImgList).length; j++) {
        if (modifyImgList[i]['imgname'] === resultImgList[j]['imgname']) {
          //둘 다 있으므로(사용자가 지우기 않았으므로) break;
          break;
        } else {
          compareCnt++;
          if (compareCnt === Object.keys(resultImgList).length) {
            willList[willCnt] = {
              imgname: modifyImgList[i]['imgname'],
              fileType: modifyImgList[i]['fileType']
            };
            willCnt++;
          }
        }
      }
    }
    // console.log(willList);

    return willList;
  }
}
export { saveContent };
