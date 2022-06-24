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
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/validationForm.js":
/*!****************************************!*\
  !*** ./resources/js/validationForm.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var formDelete = document.querySelector('#formDelete');
var baseAction = window.location.origin + '/admin/houses-image/*****';
var deleteButtons = document.querySelectorAll('[data-image]').forEach(function (ele) {
  ele.addEventListener('click', function () {
    formDelete.action = baseAction;
    formDelete.action = formDelete.action.replace('*****', ele.dataset.image);
  });
});
var form = document.getElementById('form');
var errorElement = document.getElementById('error');
var title = document.getElementById('Title');
var n_rooms = document.getElementById('N_of_rooms');
var n_beds = document.getElementById('N_of_beds');
var n_baths = document.getElementById('N_of_baths');
var mq = document.getElementById('Mq');
var n_price = document.getElementById('Night_price');
var available_from = document.getElementById('Available_from');
var available_to = document.getElementById('Available_to');
var today = new Date();
var y = today.getFullYear();
var d = String(today.getDay()).padStart(2, '0');
var m = String(today.getMonth() + 1).padStart(2, '0');
var todayDate = "".concat(y, "-").concat(m, "-").concat(d); // console.log(todayDate)
// console.log(available_from.value)
// console.log(available_to.value)

form.addEventListener('submit', function (e) {
  e.preventDefault();
  var messages = [];

  if (!title.value) {
    messages.push('Il titolo è obbligatorio');
  }

  if (n_rooms.value < 0) {
    messages.push('Il numero delle stanze non può essere un valore negativo');
  }

  if (n_beds.value < 0) {
    messages.push('Il numero dei letti non può essere un valore negativo');
  }

  if (n_baths.value < 0) {
    messages.push('Il numero dei bagni non può essere un valore negativo');
  }

  if (mq.value < 0) {
    messages.push('Il numero dei metri quadri non può essere un valore negativo');
  }

  if (n_price.value < 0) {
    messages.push('Il prezzo non può essere un valore negativo');
  }

  if (available_from.value < todayDate) {
    messages.push('La disponibilità non può essere precedente alla data odierna');
  }

  if (available_to.value < available_from.value) {
    messages.push('La data di fine disponibilità non può essere precedente alla data di inizio disponibilità');
  }

  if (messages.length > 0) {
    errorElement.innerText = messages.join('  /  ');
  } else {
    form.submit();
  }
});

/***/ }),

/***/ 3:
/*!**********************************************!*\
  !*** multi ./resources/js/validationForm.js ***!
  \**********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\Boolean\Esercizi\php\laravel-BoolBnB\resources\js\validationForm.js */"./resources/js/validationForm.js");


/***/ })

/******/ });