/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./node_modules/@wordpress/icons/build-module/library/link.js":
/*!********************************************************************!*\
  !*** ./node_modules/@wordpress/icons/build-module/library/link.js ***!
  \********************************************************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/primitives */ "@wordpress/primitives");
/* harmony import */ var _wordpress_primitives__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__);

/**
 * WordPress dependencies
 */

const link = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.SVG, {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 24 24"
}, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_primitives__WEBPACK_IMPORTED_MODULE_1__.Path, {
  d: "M10 17.389H8.444A5.194 5.194 0 1 1 8.444 7H10v1.5H8.444a3.694 3.694 0 0 0 0 7.389H10v1.5ZM14 7h1.556a5.194 5.194 0 0 1 0 10.39H14v-1.5h1.556a3.694 3.694 0 0 0 0-7.39H14V7Zm-4.5 6h5v-1.5h-5V13Z"
}));
/* harmony default export */ __webpack_exports__["default"] = (link);
//# sourceMappingURL=link.js.map

/***/ }),

/***/ "./inc/ourColors.js":
/*!**************************!*\
  !*** ./inc/ourColors.js ***!
  \**************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
const ourColors = [{
  name: "blue",
  color: "#0d3b66"
}, {
  name: "orange",
  color: "#ee964b"
}, {
  name: "dark-orange",
  color: "#f95738"
}];
/* harmony default export */ __webpack_exports__["default"] = (ourColors);

/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ (function(module) {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ (function(module) {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ (function(module) {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ (function(module) {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/primitives":
/*!************************************!*\
  !*** external ["wp","primitives"] ***!
  \************************************/
/***/ (function(module) {

module.exports = window["wp"]["primitives"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be isolated against other modules in the chunk.
!function() {
/*!*************************************!*\
  !*** ./our-blocks/genericbutton.js ***!
  \*************************************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _inc_ourColors__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../inc/ourColors */ "./inc/ourColors.js");
/* harmony import */ var _wordpress_icons__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/icons */ "./node_modules/@wordpress/icons/build-module/library/link.js");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_4___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_4__);


// to import @wordpress/icons should use npm to install it


// LinkControl is for link urls.
// InspectorControls for sidebar settings


// we import useState from react using @wordpress/element

// first argument: namespace for all our blocks, and name for our specific block
(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_4__.registerBlockType)("ourblocktheme/genericbutton", {
  apiVersion: 2,
  title: "Generic Button",
  attributes: {
    text: {
      type: "string"
    },
    size: {
      type: "string",
      default: "large"
    },
    linkObject: {
      type: "object",
      default: {
        url: ""
      }
    },
    colorName: {
      type: "string",
      default: "blue"
    }
  },
  edit: EditComponent,
  save: SaveComponent
});
function EditComponent(props) {
  // note that isLinkPickerVisible is for toggle so we don't save it in database(attributes)
  const [isLinkPickerVisible, setIsLinkPickerVisible] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const blockProps = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.useBlockProps)();
  // providing an empty array to allowedFormats makes all of the options like bold or italic gone in the toolbar editor for the block.
  // for the isPressed value, we give it a value of true or false, so that decides whether the button should be selected or highlighted.
  function handleTextChange(x) {
    props.setAttributes({
      text: x
    });
  }
  function buttonHandler() {
    setIsLinkPickerVisible(prev => !prev);
  }
  function handleLinkChange(newLink) {
    props.setAttributes({
      linkObject: newLink
    });
  }
  const currentColorValue = _inc_ourColors__WEBPACK_IMPORTED_MODULE_1__["default"].filter(color => {
    return color.name == props.attributes.colorName;
  })[0].color;
  function handleColorChange(colorCode) {
    // from the hex value that the color palette gives us, we need to find its color name
    const {
      name
    } = (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.getColorObjectByColorValue)(_inc_ourColors__WEBPACK_IMPORTED_MODULE_1__["default"], colorCode);
    props.setAttributes({
      colorName: name
    });
  }
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    ...blockProps
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.BlockControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.ToolbarGroup, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.ToolbarButton, {
    onClick: buttonHandler,
    icon: _wordpress_icons__WEBPACK_IMPORTED_MODULE_5__["default"]
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.ToolbarGroup, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.ToolbarButton, {
    isPressed: props.attributes.size === "large",
    onClick: () => props.setAttributes({
      size: "large"
    })
  }, "Large"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.ToolbarButton, {
    isPressed: props.attributes.size === "medium",
    onClick: () => props.setAttributes({
      size: "medium"
    })
  }, "Medium"), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.ToolbarButton, {
    isPressed: props.attributes.size === "small",
    onClick: () => props.setAttributes({
      size: "small"
    })
  }, "Small"))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelBody, {
    title: "Color",
    initialOpen: true
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.ColorPalette, {
    disableCustomColors: true,
    clearable: false,
    colors: _inc_ourColors__WEBPACK_IMPORTED_MODULE_1__["default"],
    value: currentColorValue,
    onChange: handleColorChange
  })))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.RichText, {
    allowedFormats: [],
    tagName: "a",
    className: `btn btn--${props.attributes.size} btn--${props.attributes.colorName}`,
    value: props.attributes.text,
    onChange: handleTextChange
  }), isLinkPickerVisible && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Popover, {
    position: "middle center",
    onFocusOutside: () => setIsLinkPickerVisible(false)
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.__experimentalLinkControl, {
    settings: [],
    value: props.attributes.linkObject,
    onChange: handleLinkChange
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_2__.Button, {
    variant: "primary",
    onClick: () => setIsLinkPickerVisible(false),
    style: {
      display: "block",
      width: "100%"
    }
  }, "Confirm Link")));
}
// return content of SaveComponent will be saved in database
// we don't need RichText.Content since we don't include nested element like strong or em (bold, and italics)
function SaveComponent(props) {
  const blockProps = _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_3__.useBlockProps.save({
    className: `btn btn--${props.attributes.size} btn--${props.attributes.colorName}`
  });
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("a", {
    href: props.attributes.linkObject.url,
    ...blockProps
  }, props.attributes.text);
}
}();
/******/ })()
;
//# sourceMappingURL=genericbutton.js.map