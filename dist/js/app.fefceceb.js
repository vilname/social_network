(function(t){function e(e){for(var r,o,i=e[0],l=e[1],c=e[2],p=0,f=[];p<i.length;p++)o=i[p],Object.prototype.hasOwnProperty.call(s,o)&&s[o]&&f.push(s[o][0]),s[o]=0;for(r in l)Object.prototype.hasOwnProperty.call(l,r)&&(t[r]=l[r]);u&&u(e);while(f.length)f.shift()();return n.push.apply(n,c||[]),a()}function a(){for(var t,e=0;e<n.length;e++){for(var a=n[e],r=!0,i=1;i<a.length;i++){var l=a[i];0!==s[l]&&(r=!1)}r&&(n.splice(e--,1),t=o(o.s=a[0]))}return t}var r={},s={app:0},n=[];function o(e){if(r[e])return r[e].exports;var a=r[e]={i:e,l:!1,exports:{}};return t[e].call(a.exports,a,a.exports,o),a.l=!0,a.exports}o.m=t,o.c=r,o.d=function(t,e,a){o.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:a})},o.r=function(t){"undefined"!==typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},o.t=function(t,e){if(1&e&&(t=o(t)),8&e)return t;if(4&e&&"object"===typeof t&&t&&t.__esModule)return t;var a=Object.create(null);if(o.r(a),Object.defineProperty(a,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var r in t)o.d(a,r,function(e){return t[e]}.bind(null,r));return a},o.n=function(t){var e=t&&t.__esModule?function(){return t["default"]}:function(){return t};return o.d(e,"a",e),e},o.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},o.p="/";var i=window["webpackJsonp"]=window["webpackJsonp"]||[],l=i.push.bind(i);i.push=e,i=i.slice();for(var c=0;c<i.length;c++)e(i[c]);var u=l;n.push([0,"chunk-vendors"]),a()})({0:function(t,e,a){t.exports=a("56d7")},"034f":function(t,e,a){"use strict";a("85ec")},"56d7":function(t,e,a){"use strict";a.r(e);a("e260"),a("e6cf"),a("cca6"),a("a79d");var r=a("2b0e"),s=a("8c4f"),n=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{attrs:{id:"app"}},[a("div",{attrs:{id:"nav"}},[a("menu-header")],1),a("router-view")],1)},o=[],i=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"container"},[a("div",{staticClass:"row"},[a("nav",{staticClass:"navbar navbar-expand-lg navbar-light bg-light"},[a("div",{staticClass:"collapse navbar-collapse menu-container justify-content-between",attrs:{id:"navbarSupportedContent"}},[a("ul",{staticClass:"navbar-nav mr-auto"},[a("li",{staticClass:"nav-item active"},[a("router-link",{staticClass:"nav-link",attrs:{to:"/"}},[t._v("Home")])],1),a("li",{staticClass:"nav-item"},[a("router-link",{staticClass:"nav-link",attrs:{to:"/about"}},[t._v("About")])],1)]),a("span",{staticClass:"navbar-text"},[a("ul",{staticClass:"navbar-nav mr-auto"},[a("li",{staticClass:"nav-item active"},[a("router-link",{staticClass:"nav-link",attrs:{to:"/login"}},[t._v("Вход")])],1),a("li",{staticClass:"nav-item"},[a("router-link",{staticClass:"nav-link",attrs:{to:"/registration"}},[t._v("Регистрация")])],1)])])])])])])},l=[],c={name:"Menu"},u=c,p=a("2877"),f=Object(p["a"])(u,i,l,!1,null,"17a69b7c",null),d=f.exports,m={components:{menuHeader:d}},v=m,h=(a("034f"),Object(p["a"])(v,n,o,!1,null,null,null)),b=h.exports,g=function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"container"},[a("div",{staticClass:"row justify-content-center"},[t.success?a("div",{staticClass:"alert alert-success",attrs:{role:"alert"}},[t._v(" "+t._s(t.success)+" ")]):t._e(),t.error?a("div",{staticClass:"alert alert-danger",attrs:{role:"alert"}},[t._v(" "+t._s(t.error)+" ")]):t._e(),a("h2",{staticClass:"text-center"},[t._v("Авторизация")]),a("form",{staticClass:"col-6",attrs:{method:"post"},on:{submit:t.authUser}},[a("div",{staticClass:"form-group mb-2"},[a("label",{attrs:{for:"loginInput"}},[t._v("Логин")]),a("input",{directives:[{name:"model",rawName:"v-model",value:t.formItems.login,expression:"formItems.login"}],staticClass:"form-control",attrs:{type:"text",id:"loginInput",placeholder:"Логин"},domProps:{value:t.formItems.login},on:{input:function(e){e.target.composing||t.$set(t.formItems,"login",e.target.value)}}})]),a("div",{staticClass:"form-group mb-2"},[a("label",{attrs:{for:"exampleInputPassword1"}},[t._v("Пароль")]),a("input",{directives:[{name:"model",rawName:"v-model",value:t.formItems.password,expression:"formItems.password"}],staticClass:"form-control",attrs:{type:"password",id:"exampleInputPassword1",placeholder:"Пароль"},domProps:{value:t.formItems.password},on:{input:function(e){e.target.composing||t.$set(t.formItems,"password",e.target.value)}}})]),t._m(0),a("button",{staticClass:"btn btn-primary",attrs:{type:"submit"}},[t._v("Отправить")])])])])},_=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"form-check mb-2"},[a("input",{staticClass:"form-check-input",attrs:{type:"checkbox",id:"exampleCheck1"}}),a("label",{staticClass:"form-check-label",attrs:{for:"exampleCheck1"}},[t._v("Запоминть меня")])])}],C=a("bc3a"),w=a.n(C),y={data:function(){return{formItems:{login:"",password:""},error:"",success:"",headers:{"Content-Type":"text/plain"},domain:"http://127.0.0.1:7777"}},methods:{authUser:function(t){var e=this;t.preventDefault();var a=this.headers;w.a.post("".concat(this.domain,"/login"),{form:this.formItems},{headers:a}).then((function(t){var a=t.data;e.error="",e.success="",a.error&&(e.error=a.error),a.success&&(e.success=a.success,localStorage.setItem("auth","true"))})).catch((function(t){console.log(t)}))}}},x=y,k=Object(p["a"])(x,g,_,!1,null,null,null),I=k.exports,j=function(){var t=this,e=t.$createElement;t._self._c;return t._m(0)},O=[function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"container"},[a("div",{staticClass:"row"},[a("div",[t._v("1111")])])])}],P={data:function(){return{formItems:{},headers:{credentials:"include"},domain:"http://network/app/api"}},methods:{getUser:function(){var t=this.headers;console.log("111111111111"),w.a.get("".concat(this.domain,"/get-user"),{headers:t}).then((function(t){console.log("response",t)})).catch((function(t){console.log(t)}))}},mounted:function(){this.getUser()}},$=P,S=Object(p["a"])($,j,O,!1,null,null,null),E=S.exports;r["default"].use(s["a"]);var M=[{path:"/",name:"Home",component:E},{path:"/login",name:"Login",component:I}],T=new s["a"]({routes:M}),U=T,H=a("5f5b"),J=a("b1e0");a("f9e3"),a("2dd8");r["default"].use(H["a"]),r["default"].use(J["a"]),r["default"].config.productionTip=!1,r["default"].use(s["a"]),new r["default"]({router:U,render:function(t){return t(b)}}).$mount("#app")},"85ec":function(t,e,a){}});
//# sourceMappingURL=app.fefceceb.js.map