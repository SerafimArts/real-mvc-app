!function(e){var t={};function n(o){if(t[o])return t[o].exports;var r=t[o]={i:o,l:!1,exports:{}};return e[o].call(r.exports,r,r.exports,n),r.l=!0,r.exports}n.m=e,n.c=t,n.d=function(e,t,o){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:o})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(n.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var r in e)n.d(o,r,function(t){return e[t]}.bind(null,r));return o},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=0)}([function(e,t,n){"use strict";function o(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}function r(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}function i(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}n.r(t);var c=function(){function e(t){var n=arguments.length>1&&void 0!==arguments[1]?arguments[1]:100;o(this,e),i(this,"_connection",null),i(this,"_host",void 0),i(this,"_reconnect",void 0),i(this,"_commands",{}),i(this,"_closed",!1),i(this,"_handlers",[]),this._host=t,this._reconnect=n}var t,n,c;return t=e,(n=[{key:"listen",value:function(e){return this._commands[e.getName()]=e,this}},{key:"answer",value:function(e){var t=arguments.length>1&&void 0!==arguments[1]?arguments[1]:{};this.send({id:e.id,name:e.name,data:t})}},{key:"connect",value:function(){var e=this;return this._connection=new WebSocket(this._host),this._connection.onopen=function(e){console.log("connected")},this._connection.onerror=function(e){console.error(e.message)},this._connection.onmessage=function(t){var n=JSON.parse(t.data)||{};e._commands[n.name]?e._commands[n.name].handle(n,e):console.error("Unrecognized command ".concat(n.name))},this._connection.onclose=function(){console.log("disconnected"),!1===e._closed&&e.reconnect()},this}},{key:"reconnect",value:function(){var e=this;return this._connection&&this._reconnect&&(this._connection=null,setTimeout((function(){return e.connect()}),this._reconnect)),this}},{key:"send",value:function(e){return this._connection&&this._connection.send(JSON.stringify(e,this._serializer)),this}},{key:"_serializer",value:function(e,t){return t instanceof Node?"Node":t instanceof Window?"Window":t}}])&&r(t.prototype,n),c&&r(t,c),e}();function a(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}function u(e,t,n){return t in e?Object.defineProperty(e,t,{value:n,enumerable:!0,configurable:!0,writable:!0}):e[t]=n,e}var l=function(){function e(t,n){!function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,e),u(this,"_name",void 0),u(this,"_handler",void 0),this._name=t,this._handler=n||function(){}}var t,n,o;return t=e,(n=[{key:"getName",value:function(){return this._name}},{key:"handle",value:function(e,t){this._handler(e,t)}}])&&a(t.prototype,n),o&&a(t,o),e}();function f(e){return(f="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function s(e,t){return!t||"object"!==f(t)&&"function"!=typeof t?function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e):t}function y(e){return(y=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function p(e,t){return(p=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}var b=function(e){function t(){return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t),s(this,y(t).call(this,"render",(function(e,t){var n;document.body.innerHTML=null!==(n=e.data.html)&&void 0!==n?n:"<span># command error</span>"})))}return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&p(e,t)}(t,e),t}(l);function d(e){return(d="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function h(e,t){for(var n=0;n<t.length;n++){var o=t[n];o.enumerable=o.enumerable||!1,o.configurable=!0,"value"in o&&(o.writable=!0),Object.defineProperty(e,o.key,o)}}function m(e,t){return!t||"object"!==d(t)&&"function"!=typeof t?function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e):t}function v(e){return(v=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function _(e,t){return(_=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}var g=function(e){function t(){var e;return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t),e=m(this,v(t).call(this,"listen",(function(t,n){var o=document.getElementById(t.data.id);o&&o.addEventListener(t.data.event,(function(o){return n.answer(t,{id:t.data.id,event:t.data.event,payload:e.event(o)}),!1}),!0)})))}var n,o,r;return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&_(e,t)}(t,e),n=t,(o=[{key:"event",value:function(e){return{altKey:e.altKey,bubbles:e.bubbles,button:e.button,buttons:e.buttons,cancelBubble:e.cancelBubble,cancelable:e.cancelable,clientX:e.clientX,clientY:e.clientY,composed:e.composed,ctrlKey:e.ctrlKey,currentTarget:e.currentTarget,defaultPrevented:e.defaultPrevented,detail:e.detail,eventPhase:e.eventPhase,isTrusted:e.isTrusted,metaKey:e.metaKey,movementX:e.movementX,movementY:e.movementY,offsetX:e.offsetX,offsetY:e.offsetY,pageX:e.pageX,pageY:e.pageY,relatedTarget:e.relatedTarget,returnValue:e.returnValue,screenX:e.screenX,screenY:e.screenY,shiftKey:e.shiftKey,timeStamp:e.timeStamp,type:e.type,x:e.x,y:e.y}}}])&&h(n.prototype,o),r&&h(n,r),t}(l);function w(e){return(w="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function O(e,t){return!t||"object"!==w(t)&&"function"!=typeof t?function(e){if(void 0===e)throw new ReferenceError("this hasn't been initialised - super() hasn't been called");return e}(e):t}function j(e){return(j=Object.setPrototypeOf?Object.getPrototypeOf:function(e){return e.__proto__||Object.getPrototypeOf(e)})(e)}function S(e,t){return(S=Object.setPrototypeOf||function(e,t){return e.__proto__=t,e})(e,t)}var P=function(e){function t(){return function(e,t){if(!(e instanceof t))throw new TypeError("Cannot call a class as a function")}(this,t),O(this,j(t).call(this,"update",(function(e,t){var n=document.getElementById(e.data.id);if(n)switch(!0){case!0===e.data.value:n.setAttribute(e.data.attr,e.data.attr);break;case"object"===w(e.data.value):for(var o=[],r=0,i=Object.keys(e.data.value);r<i.length;r++){var c=i[r];o.push("".concat(c,": ").concat(e.data.value[c]))}n.setAttribute(e.data.attr,o.join("; "));break;case null===e.data.value:break;default:n.setAttribute(e.data.attr,e.data.value)}})))}return function(e,t){if("function"!=typeof t&&null!==t)throw new TypeError("Super expression must either be null or a function");e.prototype=Object.create(t&&t.prototype,{constructor:{value:e,writable:!0,configurable:!0}}),t&&S(e,t)}(t,e),t}(l),T=new c("".concat("ws","://").concat(window.location.hostname,":").concat("81"));T.listen(new b),T.listen(new g),T.listen(new P),T.connect()}]);