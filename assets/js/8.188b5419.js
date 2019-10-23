(window.webpackJsonp=window.webpackJsonp||[]).push([[8],{234:function(t,s,a){"use strict";a.r(s);var n=a(1),e=Object(n.a)({},function(){var t=this,s=t.$createElement,a=t._self._c||s;return a("ContentSlotsDistributor",{attrs:{"slot-key":t.$parent.slotKey}},[a("h1",{attrs:{id:"後台頁"}},[a("a",{staticClass:"header-anchor",attrs:{href:"#後台頁","aria-hidden":"true"}},[t._v("#")]),t._v(" 後台頁")]),t._v(" "),a("h2",{attrs:{id:"管理登出"}},[a("a",{staticClass:"header-anchor",attrs:{href:"#管理登出","aria-hidden":"true"}},[t._v("#")]),t._v(" 管理登出")]),t._v(" "),a("h3",{attrs:{id:"修改連結"}},[a("a",{staticClass:"header-anchor",attrs:{href:"#修改連結","aria-hidden":"true"}},[t._v("#")]),t._v(" 修改連結")]),t._v(" "),a("p",[t._v("找到管理登出鈕，把 onclick 裡面的"),a("code",[t._v("location.replace")]),t._v("路徑改為 api.php，讓 api.php 做登出處理")]),t._v(" "),a("div",{staticClass:"language-php line-numbers-mode"},[a("pre",{pre:!0,attrs:{class:"language-php"}},[a("code",[t._v("onclick"),a("span",{pre:!0,attrs:{class:"token operator"}},[t._v("=")]),a("span",{pre:!0,attrs:{class:"token double-quoted-string string"}},[t._v('"document.cookie=&#39;user=&#39;;location.replace(&#39;api.php?do=out&#39;)"')]),t._v(" style"),a("span",{pre:!0,attrs:{class:"token operator"}},[t._v("=")]),a("span",{pre:!0,attrs:{class:"token double-quoted-string string"}},[t._v('"width:99%; margin-right:2px; height:50px;"')]),t._v("\n")])]),t._v(" "),a("div",{staticClass:"line-numbers-wrapper"},[a("span",{staticClass:"line-number"},[t._v("1")]),a("br")])]),a("h3",{attrs:{id:"處理登出"}},[a("a",{staticClass:"header-anchor",attrs:{href:"#處理登出","aria-hidden":"true"}},[t._v("#")]),t._v(" 處理登出")]),t._v(" "),a("p",[t._v("編輯api.php")]),t._v(" "),a("div",{staticClass:"language-php line-numbers-mode"},[a("pre",{pre:!0,attrs:{class:"language-php"}},[a("code",[a("span",{pre:!0,attrs:{class:"token comment"}},[t._v("// 登出")]),t._v("\n"),a("span",{pre:!0,attrs:{class:"token keyword"}},[t._v("case")]),t._v(" "),a("span",{pre:!0,attrs:{class:"token double-quoted-string string"}},[t._v('"out"')]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("\n    "),a("span",{pre:!0,attrs:{class:"token comment"}},[t._v("// 只有 unset 管理員的 session")]),t._v("\n    "),a("span",{pre:!0,attrs:{class:"token comment"}},[t._v("// 避免進站人數因為 session_destroy 或 session_unset 而 +1")]),t._v("\n    "),a("span",{pre:!0,attrs:{class:"token keyword"}},[t._v("unset")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("(")]),a("span",{pre:!0,attrs:{class:"token variable"}},[t._v("$_SESSION")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),a("span",{pre:!0,attrs:{class:"token double-quoted-string string"}},[t._v('"a"')]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(")")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(";")]),t._v("\n    "),a("span",{pre:!0,attrs:{class:"token comment"}},[t._v("// 導回登入頁")]),t._v("\n    "),a("span",{pre:!0,attrs:{class:"token function"}},[t._v("lo")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("(")]),a("span",{pre:!0,attrs:{class:"token double-quoted-string string"}},[t._v('"login.php"')]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(")")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(";")]),t._v("\n    "),a("span",{pre:!0,attrs:{class:"token keyword"}},[t._v("break")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(";")]),t._v("\n")])]),t._v(" "),a("div",{staticClass:"line-numbers-wrapper"},[a("span",{staticClass:"line-number"},[t._v("1")]),a("br"),a("span",{staticClass:"line-number"},[t._v("2")]),a("br"),a("span",{staticClass:"line-number"},[t._v("3")]),a("br"),a("span",{staticClass:"line-number"},[t._v("4")]),a("br"),a("span",{staticClass:"line-number"},[t._v("5")]),a("br"),a("span",{staticClass:"line-number"},[t._v("6")]),a("br"),a("span",{staticClass:"line-number"},[t._v("7")]),a("br"),a("span",{staticClass:"line-number"},[t._v("8")]),a("br")])]),a("h2",{attrs:{id:"內容區"}},[a("a",{staticClass:"header-anchor",attrs:{href:"#內容區","aria-hidden":"true"}},[t._v("#")]),t._v(" 內容區")]),t._v(" "),a("p",[t._v("這頁的選單連結以 "),a("code",[t._v('$_GET["redo"]')]),t._v(" 判斷在內容區顯示的管理項目")]),t._v(" "),a("p",[t._v("找到"),a("code",[t._v('<p class="t cent botli">網站標題管理</p>')]),t._v(" ，把包住它的div裡面的內容全部剪下，另開新檔 "),a("code",[t._v("atitle.php")]),t._v(" 後貼上，然後在後面加上 include 程式碼")]),t._v(" "),a("p",[t._v("修改完成後的整段程式碼如下")]),t._v(" "),a("div",{staticClass:"language-php line-numbers-mode"},[a("pre",{pre:!0,attrs:{class:"language-php"}},[a("code",[a("span",{pre:!0,attrs:{class:"token tag"}},[a("span",{pre:!0,attrs:{class:"token tag"}},[a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("<")]),t._v("div")]),a("span",{pre:!0,attrs:{class:"token style-attr language-css"}},[a("span",{pre:!0,attrs:{class:"token attr-name"}},[t._v(" "),a("span",{pre:!0,attrs:{class:"token attr-name"}},[t._v("style")])]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v('="')]),a("span",{pre:!0,attrs:{class:"token attr-value"}},[a("span",{pre:!0,attrs:{class:"token property"}},[t._v("width")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("99%"),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(";")]),t._v(" "),a("span",{pre:!0,attrs:{class:"token property"}},[t._v("height")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("87%"),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(";")]),t._v(" "),a("span",{pre:!0,attrs:{class:"token property"}},[t._v("margin")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("auto"),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(";")]),t._v(" "),a("span",{pre:!0,attrs:{class:"token property"}},[t._v("overflow")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("auto"),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(";")]),t._v(" "),a("span",{pre:!0,attrs:{class:"token property"}},[t._v("border")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(":")]),t._v("#666 1px solid"),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(";")])]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v('"')])]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(">")])]),t._v("\n"),a("span",{pre:!0,attrs:{class:"token php language-php"}},[a("span",{pre:!0,attrs:{class:"token delimiter important"}},[t._v("<?php")]),t._v("\n    "),a("span",{pre:!0,attrs:{class:"token comment"}},[t._v("// 選單連結以 redo 判斷要在網頁內容區顯示哪個管理項目")]),t._v("\n    "),a("span",{pre:!0,attrs:{class:"token comment"}},[t._v("// 預設為 標題管理")]),t._v("\n    "),a("span",{pre:!0,attrs:{class:"token comment"}},[t._v("// 直接 include 檔名為redo值的php 就好")]),t._v("\n    "),a("span",{pre:!0,attrs:{class:"token comment"}},[t._v("// 不過要在前面加個 a ，避免和前台頁面衝突，例如更多最新消息頁")]),t._v("\n    "),a("span",{pre:!0,attrs:{class:"token keyword"}},[t._v("if")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("(")]),a("span",{pre:!0,attrs:{class:"token keyword"}},[t._v("empty")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("(")]),a("span",{pre:!0,attrs:{class:"token variable"}},[t._v("$_GET")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),a("span",{pre:!0,attrs:{class:"token double-quoted-string string"}},[t._v('"redo"')]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(")")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(")")]),t._v("\t"),a("span",{pre:!0,attrs:{class:"token keyword"}},[t._v("include")]),t._v(" "),a("span",{pre:!0,attrs:{class:"token double-quoted-string string"}},[t._v('"atitle.php"')]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(";")]),t._v("\n    "),a("span",{pre:!0,attrs:{class:"token keyword"}},[t._v("else")]),t._v(" \t"),a("span",{pre:!0,attrs:{class:"token keyword"}},[t._v("include")]),t._v(" "),a("span",{pre:!0,attrs:{class:"token double-quoted-string string"}},[t._v('"a"')]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(".")]),a("span",{pre:!0,attrs:{class:"token variable"}},[t._v("$_GET")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("[")]),a("span",{pre:!0,attrs:{class:"token double-quoted-string string"}},[t._v('"redo"')]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("]")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(".")]),a("span",{pre:!0,attrs:{class:"token double-quoted-string string"}},[t._v('".php"')]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(";")]),t._v("\t\n"),a("span",{pre:!0,attrs:{class:"token delimiter important"}},[t._v("?>")])]),t._v("\n"),a("span",{pre:!0,attrs:{class:"token tag"}},[a("span",{pre:!0,attrs:{class:"token tag"}},[a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v("</")]),t._v("div")]),a("span",{pre:!0,attrs:{class:"token punctuation"}},[t._v(">")])]),t._v("\n")])]),t._v(" "),a("div",{staticClass:"line-numbers-wrapper"},[a("span",{staticClass:"line-number"},[t._v("1")]),a("br"),a("span",{staticClass:"line-number"},[t._v("2")]),a("br"),a("span",{staticClass:"line-number"},[t._v("3")]),a("br"),a("span",{staticClass:"line-number"},[t._v("4")]),a("br"),a("span",{staticClass:"line-number"},[t._v("5")]),a("br"),a("span",{staticClass:"line-number"},[t._v("6")]),a("br"),a("span",{staticClass:"line-number"},[t._v("7")]),a("br"),a("span",{staticClass:"line-number"},[t._v("8")]),a("br"),a("span",{staticClass:"line-number"},[t._v("9")]),a("br"),a("span",{staticClass:"line-number"},[t._v("10")]),a("br")])])])},[],!1,null,null,null);s.default=e.exports}}]);