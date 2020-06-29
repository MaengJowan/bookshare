/*
* to do : 드롭다운 하위 목록 클릭시 줄어들지 않게 하기
  클릭시 section페이지 이동
*/

class click {
  clickMenu() {
    const url=document.location.href.split("detail/");
    console.log(url[1]);

    const link = document.querySelectorAll(".link");
    for(let i=0; i<link.length; i++){
        if(link[i].className.indexOf(`${url[1]}`) !== -1)
          link[i].classList.add("is-active");
    }
  }
}

export { click };
