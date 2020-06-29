class recommendFile {
  //image Upload
  uploadFile(i, fileinfo) {
    const file = document.getElementById('file');
    if (file.files.length) {
      const editor = document.getElementById('editor');
      const img = document.createElement('img');
      fileinfo[i] = file.files[0];
      img.src = URL.createObjectURL(file.files[0]);
      img.width = 300;
      img.alt = file.files[0].name;
      img.className = `img_${i}`;
      img.setAttribute('ondblclick', 'fixWidth(this.className)');
      img.onload = function () {
        URL.revokeObjectURL(this.src);
      };
      editor.appendChild(img);
    }
  }
  //add dblclick
  addDblclick() {
    const editor = document.getElementById('editor');
    const editorChildNodes = editor.childNodes;
    for (let i = 0; i < editorChildNodes.length; i++) {
      if (
        editorChildNodes[i].nodeName === 'IMG' &&
        !editorChildNodes[i].hasAttribute('dblclick')
      ) {
        editorChildNodes[i].setAttribute(
          'ondblclick',
          'fixWidth(this.className)'
        );
      }
    }
  }

  //Modal
  modalConfirm(imgClassName) {
    const modal_input = document.querySelector('.modal_input');
    const modal = document.getElementById('modal');
    const img = document.querySelector(`.${imgClassName}`);
    const width = modal_input.value;
    if (isNaN(parseInt(width))) {
      const p = document.createElement('p');
      p.innerText = '숫자만 입력해주세요!';
      p.className = 'has-text-danger';
      modal.append(p);
      return false;
    } else {
      img.setAttribute('style', `width:${parseInt(width)}px`);
      this.modalBtn();
    }
  }
  modalCancel() {
    this.modalBtn();
  }
  modalBtn() {
    const blackDiv = document.querySelector('.modal_black_div');
    const modal = document.getElementById('modal');

    blackDiv.style.display = 'none';
    modal.style.display = 'none';
    const p = document.querySelector('div#modal p.has-text-danger');
    if (p) {
      p.remove();
    }
  }
}

export { recommendFile };
