import '../../css/complie/entry.css';

import { click } from '../aside';
import { search } from '../recommend';
import { header } from '../header';

const nav = new header();
nav.burger();
const aside = new click();
// const reco = new search();
aside.clickMenu();

// const form = document.getElementById('search');
// form.querySelector('.button').addEventListener('click', event => {
//   event.preventDefault();
//   reco.submit(form);
// });
