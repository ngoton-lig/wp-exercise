import { backfaceScroll } from './backface-fixed';

export default class Menu {
    constructor() {
        const $hamburger = document.getElementById('hamburger');
        const $headerMenu = document.getElementById('header-menu');
        $hamburger.addEventListener('click',(e)=>{
            e.preventDefault();
            if ($headerMenu.classList.contains('is-open')) {
                backfaceScroll(false);
                $headerMenu.classList.remove('is-open');
                $hamburger.classList.remove('is-open');
            } else {
                backfaceScroll(true);
                $headerMenu.classList.add('is-open');
                $hamburger.classList.add('is-open');
            }
        });
    }
}
