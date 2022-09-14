/******/ (function() { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************!*\
  !*** ./src/blocks/tabs/script.js ***!
  \***********************************/
/**
 * File tabs/script.js
 *
 */
console.log('tabs.js'); // Make sure everything is loaded first.

if (('complete' === document.readyState || 'loading' !== document.readyState) && !document.documentElement.doScroll) {
  wdsTabs();
} else {
  document.addEventListener('DOMContentLoaded', wdsTabs);
}
/**
 * Start Tabs function
 *
 */


function wdsTabs() {
  const tabTitles = document.querySelectorAll('.wds-module-tabs .tab-title');
  tabTitles.forEach(item => {
    item.addEventListener('click', () => {
      console.log('tab title clicked');
    });
  });
}
/******/ })()
;
//# sourceMappingURL=script.js.map