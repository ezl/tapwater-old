!function(t){var e={};function i(s){if(e[s])return e[s].exports;var n=e[s]={i:s,l:!1,exports:{}};return t[s].call(n.exports,n,n.exports,i),n.l=!0,n.exports}i.m=t,i.c=e,i.d=function(t,e,s){i.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:s})},i.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},i.t=function(t,e){if(1&e&&(t=i(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var s=Object.create(null);if(i.r(s),Object.defineProperty(s,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var n in t)i.d(s,n,function(e){return t[e]}.bind(null,n));return s},i.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return i.d(e,"a",e),e},i.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},i.p="",i(i.s=23)}({23:function(t,e){!function(){"use strict";var t={bar:document.getElementById("smush-image-bar"),toggle:document.getElementById("smush-image-bar-toggle"),images:{bigger:[],smaller:[]},strings:window.wp_smush_resize_vars,init:function(){this.bar||(this.bar=document.getElementById("smush-image-bar")),this.toggle||(this.toggle=document.getElementById("smush-image-bar-toggle")),this.process(),this.toggle.addEventListener("click",this.handleToggleClick.bind(this))},process:function(){var t=this.toggle.querySelector("i");t.classList.add("sui-icon-loader"),t.classList.remove("sui-icon-info"),this.detectImages(),this.images.bigger.length||this.images.smaller.length?(this.toggle.classList.remove("smush-toggle-success"),document.getElementById("smush-image-bar-notice").style.display="none",document.getElementById("smush-image-bar-notice-desc").style.display="block",this.generateMarkup("bigger"),this.generateMarkup("smaller")):(this.toggle.classList.add("smush-toggle-success"),document.getElementById("smush-image-bar-notice").style.display="block",document.getElementById("smush-image-bar-notice-desc").style.display="none"),this.toggleDivs(),t.classList.remove("sui-icon-loader"),t.classList.add("sui-icon-info")},shouldSkipImage:function(t){return!!t.classList.contains("avatar")||("string"==typeof t.getAttribute("no-resize-detection")||(t.clientWidth===t.clientHeight&&1===t.clientWidth||(t.naturalWidth===t.naturalHeight&&1===t.naturalWidth||(null===t.clientWidth||null===t.clientHeight))))},getTooltipText:function(t){var e="";return t.bigger_width||t.bigger_height?e=this.strings.large_image:(t.smaller_width||t.smaller_height)&&(e=this.strings.small_image),e.replace("width",t.real_width).replace("height",t.real_height)},generateMarkup:function(t){var e=this;this.images[t].forEach((function(i,s){var n=document.createElement("div"),r=e.getTooltipText(i.props);n.setAttribute("class","smush-resize-box smush-tooltip smush-tooltip-constrained"),n.setAttribute("data-tooltip",r),n.setAttribute("data-image",i.class),n.addEventListener("click",(function(t){return e.highlightImage(t)})),n.innerHTML='\n\t\t\t\t\t<div class="smush-image-info">\n\t\t\t\t\t\t<span>'.concat(s+1,'</span>\n\t\t\t\t\t\t<span class="smush-tag">').concat(i.props.computed_width," x ").concat(i.props.computed_height,'px</span>\n\t\t\t\t\t\t<i class="smush-front-icons smush-front-icon-arrows-in" aria-hidden="true">&nbsp;</i>\n\t\t\t\t\t\t<span class="smush-tag smush-tag-success">').concat(i.props.real_width," × ").concat(i.props.real_height,'px</span>\t\t\t\t\t\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class="smush-image-description">').concat(r,"</div>\n\t\t\t\t"),document.getElementById("smush-image-bar-items-"+t).appendChild(n)}))},toggleDivs:function(){var t=this;["bigger","smaller"].forEach((function(e){var i=document.getElementById("smush-image-bar-items-"+e);0===t.images[e].length?i.style.display="none":i.style.display="block"}))},highlightImage:function(t){this.removeSelection();var e=document.getElementsByClassName(t.currentTarget.dataset.image);void 0!==e[0]&&(t.currentTarget.classList.toggle("show-description"),e[0].scrollIntoView({behavior:"smooth",block:"center",inline:"nearest"}),e[0].style.opacity="0.5",setTimeout((function(){e[0].style.opacity="1"}),1e3))},handleToggleClick:function(){this.bar.classList.toggle("closed"),this.toggle.classList.toggle("closed"),this.removeSelection()},removeSelection:function(){var t=document.getElementsByClassName("show-description");t.length>0&&Array.from(t).forEach((function(t){return t.classList.remove("show-description")}))},detectImages:function(){var t=document.getElementsByTagName("img"),e=!0,i=!1,s=void 0;try{for(var n,r=t[Symbol.iterator]();!(e=(n=r.next()).done);e=!0){var a=n.value;if(!this.shouldSkipImage(a)){var l={real_width:a.clientWidth,real_height:a.clientHeight,computed_width:a.naturalWidth,computed_height:a.naturalHeight,bigger_width:1.5*a.clientWidth<a.naturalWidth,bigger_height:1.5*a.clientHeight<a.naturalHeight,smaller_width:a.clientWidth>a.naturalWidth,smaller_height:a.clientHeight>a.naturalHeight};if(l.bigger_width||l.bigger_height||l.smaller_width||l.smaller_height){var o=l.bigger_width||l.bigger_height?"bigger":"smaller",g="smush-image-"+(this.images[o].length+1);this.images[o].push({src:a,props:l,class:g}),a.classList.add("smush-detected-img"),a.classList.add(g)}}}}catch(t){i=!0,s=t}finally{try{e||null==r.return||r.return()}finally{if(i)throw s}}},refresh:function(){this.images={bigger:[],smaller:[]};for(var t=document.getElementsByClassName("smush-resize-box");t.length>0;)t[0].remove();this.process()}};window.addEventListener("DOMContentLoaded",(function(){return t.init()})),window.addEventListener("lazyloaded",(function(){return t.refresh()}))}()}});
;