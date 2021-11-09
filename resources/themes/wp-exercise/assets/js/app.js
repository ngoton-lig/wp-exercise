/**
 * vewport-extraを有効にする場合はインストールしてコメントアウトを削除
 * npm i viewport-extra
 */

// import './module/viewport'

import Menu from './module/menu'

window.addEventListener('load', function () {
    //menu
    new Menu()
});