/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/components/modal.js":
/*!******************************************!*\
  !*** ./resources/js/components/modal.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#Modal').on('show.bs.modal', function (event) {
  // ボタンを取得
  var button = $(event.relatedTarget); // data-***の部分を取得

  var reviewId = button.data('reviewid');
  var point = button.data('point');
  var gameTitle = button.data('gametitle');
  var gameLink = button.data('gamelink');
  var maker = button.data('maker');
  var genre = button.data('genre');
  var date = button.data('date');
  var reviewTitle = button.data('reviewtitle');
  var content = button.data('content');
  var image = button.data('image');
  var user = button.data('user');
  var userLink = button.data('userlink');
  var reviewEval = button.data('eval');
  var loginid = button.data('loginid');
  var modal = $(this); // 評価値の初期化

  $("#reteit-value").text("-");
  $("#rateit").rateit("reset"); // csrfトークンを設定

  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    url: '/ajax/getrate',
    type: 'GET',
    dataType: 'text',
    data: {
      review_id: reviewId,
      login_id: loginid
    }
  }).done(function (data) {
    /* 通信成功時 */
    $("#reteit-value").text(data);
  }).fail(function (data) {
    /* 通信失敗時 */
    // alert('評価を取得できませんでした');
    //console.log("XMLHttpRequest : " + XMLHttpRequest.status);
    //console.log("textStatus     : " + textStatus);
    //console.log("errorThrown    : " + errorThrown.message);
  }); // モーダルに取得したパラメータを表示
  // 以下ではモーダルのクラス名を取得している

  modal.find('#reviewid-text').text(reviewId);
  modal.find('#point-text').text(point);
  modal.find('#gametitle-text').text(gameTitle);
  modal.find('#gametitle-text').attr('href', gameLink);
  modal.find('#maker-text').text(maker);
  modal.find('#genre-text').text(genre);
  modal.find('#date-text').text(date);
  modal.find('#reviewtitle-text').text(reviewTitle);
  modal.find('#content-text').text(content);
  modal.find('#image').attr('src', image);
  modal.find('#user-text').text(user);
  modal.find('#user-text').attr('href', userLink);
  modal.find('#eval-text').text("☆" + reviewEval);
});

/***/ }),

/***/ 1:
/*!************************************************!*\
  !*** multi ./resources/js/components/modal.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /mnt/c/php/techboost/gamereview/resources/js/components/modal.js */"./resources/js/components/modal.js");


/***/ })

/******/ });