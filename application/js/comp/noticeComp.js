import '../../css/complie/entry.css';
import { click } from '../aside';
import { header } from '../header';

const nav = new header();
nav.burger();
const aside = new click();

aside.clickMenu();
