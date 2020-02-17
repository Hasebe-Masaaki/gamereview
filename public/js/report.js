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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/components/report.js":
/*!*******************************************!*\
  !*** ./resources/js/components/report.js ***!
  \*******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

eval("// 通報ボタンを押したとき\n$('#report-button').on('click', function () {\n  var rid = $(\"#reviewid-text\").text();\n\n  if (!confirm(\"ネタバレまたは不適切な記事として通報します。よろしいですか？\")) {\n    event.preventDefault();\n  } else {\n    // csrfトークンを設定\n    $.ajaxSetup({\n      headers: {\n        'X-CSRF-TOKEN': $('meta[name=\"csrf-token\"]').attr('content')\n      }\n    });\n    $.ajax({\n      url: '/ajax/report',\n      type: 'POST',\n      dataType: 'text',\n      data: {\n        review_id: rid\n      }\n    }).done(function (data) {\n      /* 通信成功時 */\n      alert('通報を受付しました');\n    }).fail(function (data) {\n      /* 通信失敗時 */\n      alert('通報を受付できませんでした'); //console.log(\"XMLHttpRequest : \" + XMLHttpRequest.status);\n      //console.log(\"textStatus     : \" + textStatus);\n      //console.log(\"errorThrown    : \" + errorThrown.message);\n    });\n  }\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvY29tcG9uZW50cy9yZXBvcnQuanM/ZmFjZSJdLCJuYW1lcyI6WyIkIiwib24iLCJyaWQiLCJ0ZXh0IiwiY29uZmlybSIsImV2ZW50IiwicHJldmVudERlZmF1bHQiLCJhamF4U2V0dXAiLCJoZWFkZXJzIiwiYXR0ciIsImFqYXgiLCJ1cmwiLCJ0eXBlIiwiZGF0YVR5cGUiLCJkYXRhIiwicmV2aWV3X2lkIiwiZG9uZSIsImFsZXJ0IiwiZmFpbCJdLCJtYXBwaW5ncyI6IkFBQUE7QUFDQUEsQ0FBQyxDQUFDLGdCQUFELENBQUQsQ0FBb0JDLEVBQXBCLENBQXVCLE9BQXZCLEVBQWdDLFlBQVc7QUFDdkMsTUFBSUMsR0FBRyxHQUFHRixDQUFDLENBQUMsZ0JBQUQsQ0FBRCxDQUFvQkcsSUFBcEIsRUFBVjs7QUFFQSxNQUFJLENBQUNDLE9BQU8sQ0FBQyxnQ0FBRCxDQUFaLEVBQWdEO0FBQzlDQyxTQUFLLENBQUNDLGNBQU47QUFDRCxHQUZELE1BR0s7QUFDSDtBQUNBTixLQUFDLENBQUNPLFNBQUYsQ0FBWTtBQUNSQyxhQUFPLEVBQUU7QUFDUCx3QkFBZ0JSLENBQUMsQ0FBQyx5QkFBRCxDQUFELENBQTZCUyxJQUE3QixDQUFrQyxTQUFsQztBQURUO0FBREQsS0FBWjtBQU1BVCxLQUFDLENBQUNVLElBQUYsQ0FBTztBQUNMQyxTQUFHLEVBQUUsY0FEQTtBQUVMQyxVQUFJLEVBQUUsTUFGRDtBQUdMQyxjQUFRLEVBQUUsTUFITDtBQUlMQyxVQUFJLEVBQUc7QUFDSEMsaUJBQVMsRUFBR2I7QUFEVDtBQUpGLEtBQVAsRUFPR2MsSUFQSCxDQU9RLFVBQVNGLElBQVQsRUFBYztBQUNsQjtBQUNBRyxXQUFLLENBQUMsV0FBRCxDQUFMO0FBQ0gsS0FWRCxFQVVHQyxJQVZILENBVVEsVUFBU0osSUFBVCxFQUFjO0FBQ2xCO0FBQ0FHLFdBQUssQ0FBQyxlQUFELENBQUwsQ0FGa0IsQ0FHbEI7QUFDQTtBQUNBO0FBQ0gsS0FoQkQ7QUFpQkQ7QUFDSixDQWhDRCIsImZpbGUiOiIuL3Jlc291cmNlcy9qcy9jb21wb25lbnRzL3JlcG9ydC5qcy5qcyIsInNvdXJjZXNDb250ZW50IjpbIi8vIOmAmuWgseODnOOCv+ODs+OCkuaKvOOBl+OBn+OBqOOBjVxuJCgnI3JlcG9ydC1idXR0b24nKS5vbignY2xpY2snLCBmdW5jdGlvbigpIHtcbiAgICB2YXIgcmlkID0gJChcIiNyZXZpZXdpZC10ZXh0XCIpLnRleHQoKTtcblxuICAgIGlmICghY29uZmlybShcIuODjeOCv+ODkOODrOOBvuOBn+OBr+S4jemBqeWIh+OBquiomOS6i+OBqOOBl+OBpumAmuWgseOBl+OBvuOBmeOAguOCiOOCjeOBl+OBhOOBp+OBmeOBi++8n1wiKSkge1xuICAgICAgZXZlbnQucHJldmVudERlZmF1bHQoKTtcbiAgICB9XG4gICAgZWxzZSB7XG4gICAgICAvLyBjc3Jm44OI44O844Kv44Oz44KS6Kit5a6aXG4gICAgICAkLmFqYXhTZXR1cCh7XG4gICAgICAgICAgaGVhZGVyczoge1xuICAgICAgICAgICAgJ1gtQ1NSRi1UT0tFTic6ICQoJ21ldGFbbmFtZT1cImNzcmYtdG9rZW5cIl0nKS5hdHRyKCdjb250ZW50JylcbiAgICAgICAgICB9XG4gICAgICB9KTtcblxuICAgICAgJC5hamF4KHtcbiAgICAgICAgdXJsOiAnL2FqYXgvcmVwb3J0JyxcbiAgICAgICAgdHlwZTogJ1BPU1QnLFxuICAgICAgICBkYXRhVHlwZTogJ3RleHQnLFxuICAgICAgICBkYXRhIDoge1xuICAgICAgICAgICAgcmV2aWV3X2lkIDogcmlkXG4gICAgICAgIH1cbiAgICAgIH0pLmRvbmUoZnVuY3Rpb24oZGF0YSl7XG4gICAgICAgICAgLyog6YCa5L+h5oiQ5Yqf5pmCICovXG4gICAgICAgICAgYWxlcnQoJ+mAmuWgseOCkuWPl+S7mOOBl+OBvuOBl+OBnycpO1xuICAgICAgfSkuZmFpbChmdW5jdGlvbihkYXRhKXtcbiAgICAgICAgICAvKiDpgJrkv6HlpLHmlZfmmYIgKi9cbiAgICAgICAgICBhbGVydCgn6YCa5aCx44KS5Y+X5LuY44Gn44GN44G+44Gb44KT44Gn44GX44GfJyk7XG4gICAgICAgICAgLy9jb25zb2xlLmxvZyhcIlhNTEh0dHBSZXF1ZXN0IDogXCIgKyBYTUxIdHRwUmVxdWVzdC5zdGF0dXMpO1xuICAgICAgICAgIC8vY29uc29sZS5sb2coXCJ0ZXh0U3RhdHVzICAgICA6IFwiICsgdGV4dFN0YXR1cyk7XG4gICAgICAgICAgLy9jb25zb2xlLmxvZyhcImVycm9yVGhyb3duICAgIDogXCIgKyBlcnJvclRocm93bi5tZXNzYWdlKTtcbiAgICAgIH0pO1xuICAgIH1cbn0pO1xuIl0sInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/components/report.js\n");

/***/ }),

/***/ 4:
/*!*************************************************!*\
  !*** multi ./resources/js/components/report.js ***!
  \*************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /mnt/c/php/techboost/gamereview/resources/js/components/report.js */"./resources/js/components/report.js");


/***/ })

/******/ });