import {setContent} from 'viewport-extra'

(function () {
    const ua = navigator.userAgent;
    const isMobilePhone = ua.indexOf('iPhone') > -1 || (ua.indexOf('Android') > -1 && ua.indexOf('Mobile') > -1);
    setContent({ minWidth: isMobilePhone ? 375 : 1024 });
})();