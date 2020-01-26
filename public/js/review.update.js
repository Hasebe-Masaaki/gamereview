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
/******/ 	return __webpack_require__(__webpack_require__.s = 5);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/components/review.update.js":
/*!**************************************************!*\
  !*** ./resources/js/components/review.update.js ***!
  \**************************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('#title-search').autocomplete({
  source: function source(req, resp) {
    // csrfトークンを設定
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: '/ajax/autocomp',
      type: 'POST',
      cache: false,
      dataType: 'json',
      data: {
        str: req.term
      }
    }).done(function (o) {
      /* 通信成功時 */
      resp(o.data);
    }).fail(function (o) {
      /* 通信失敗時 */
      resp(['']);
    });
  },
  select: function select(event, ui) {
    // csrfトークンを設定
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: '/ajax/select',
      type: 'POST',
      dataType: 'json',
      data: {
        str: ui.item
      }
    }).done(function (data) {
      /* 通信成功時 */
      $("#game-id").val(data.game_id);
      $("#game-title").text(data.game_title);
      $("#maker-name").text(data.maker_name);
      $("#game-genre").text(data.game_genre);
      $("#release-date").text(data.release_date);
      $("#review-count").text("レビュー件数: " + data.review_count + " 件");
      $("#game-summary").text(data.game_summary);
      $("#average").text(data.average);
      $("#trim-ave").text(data.trim_ave);
      $("#median").text(data.median);
      $("#review-id").val(data.review_id);
      $("#review-point").val(data.review_point);
      $("#review-title").val(data.review_title);
      $("#review-content").val(data.review_content);
      $("#spoiler-flg").prop('checked', data.spoiler_flg);

      if (data.submit_flg) {
        $("#review-submit").val('レビュー内容を更新');
      }
    }).fail(function (data) {
      /* 通信失敗時 */
    });
  },
  //ここにAutocompleteのオプションを設定
  delay: 0
});
$('#form-add').submit(function (event) {
  if (!confirm("レビュー内容を登録します。よろしいですか？")) {
    event.preventDefault();
  }
}); // $('.review_delete').on('click', function(event) {
//   if (!confirm("レビュー内容を削除します。よろしいですか？")) {
//       return false;
//   }
// });

/***/ }),

/***/ 5:
/*!********************************************************!*\
  !*** multi ./resources/js/components/review.update.js ***!
  \********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /mnt/c/php/techboost/gamereview/resources/js/components/review.update.js */"./resources/js/components/review.update.js");


/***/ })

/******/ });