import requests
import json
from bs4 import BeautifulSoup
import sys
 
word = sys.argv[1]
word = word.strip().replace("&", "+")


def get_coverImg(url):
  result=requests.get(url)
  soup = BeautifulSoup(result.text, 'html.parser')
  div = soup.find("div", {"id":"divDetailInfo"})
  if(div == None):
    imgUrl = "http://hanul.hannam.ac.kr/image/ko/common/noImageM.gif"
    return imgUrl
  else:
    iframe=div.find('iframe')['src']
    iframeResult=requests.get(iframe)
    soup = BeautifulSoup(iframeResult.text, 'html.parser')
    imgUrl=soup.find('td').find("img")['src']
    return imgUrl

def get_list():
  source={}
  url = f"http://hanul.hannam.ac.kr/search/tot/result?pn=1&st=KWRD&si=TOTAL&oi=DISP06&os=DESC&q={word}&cpp=20"
  result=requests.get(url)
  if(result.status_code != requests.codes.ok):
    print(f"{word} can not search")
  else:
    soup = BeautifulSoup(result.text, 'html.parser')
    div = soup.find("div", {"id" : "divResultList"})
    cnt = soup.find("div", {"id" : "searchCnt"}).find("strong").get_text()
    booklist=div.find_all("div", {"class" : "briefData"})
    i = 0
    for book in booklist:
      detail=book.find("dl", {"class" : "briefDetail"})
      searchTitle=detail.find("dd", {"class" : "searchTitle"}).find("a")
      title=searchTitle.get_text()
      url = f"http://hanul.hannam.ac.kr{searchTitle['href']}"
      imgUrl=get_coverImg(url)
      bookline=detail.find_all("dd", {"class" : "bookline"})
      author=bookline[0].get_text()
      publisher = bookline[1].get_text()
      borrow = bookline[-1].get_text()
      if(borrow == "\xa0"):
        borrow = "전자책"
      source[f"{i}"]={"imgUrl":imgUrl, "url":url, "title":title, "author":author, "publisher":publisher, "borrow":borrow}
      i += 1
    source[f"{i}"]={"cnt":cnt, "libraryUrl":f"http://hanul.hannam.ac.kr/search/tot/result?st=KWRD&si=TOTAL&oi=DISP06&os=DESC&q={word}&cpp=20"}
  return source

def listToDict(lst):
  op = { i : lst[i] for i in range(0, len(lst) ) }
  return op

def main():
  result=get_list()
  print(result)
  
main()



