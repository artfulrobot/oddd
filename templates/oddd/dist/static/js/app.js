webpackJsonp([1],{"4icS":function(t,e){},NHnr:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0});var s=a("/5sW"),o=a("fZjL"),n=a.n(o),r=a("mtWM"),i=a.n(r),l={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"odd__buttons"},t._l(t.presets,function(e){return a("div",{key:e,staticClass:"odd__button-wrapper"},[a("button",{staticClass:"odd__button",class:{selected:e==t.local_amount},on:{click:function(a){return a.preventDefault(),t.selectAmount(e)}}},[t._v(t._s(t.currency_symbol)+t._s(e)+"\n              "),"regular"===t.recur?a("div",{staticClass:"odd__buttons__a-month"},[t._v("a month")]):t._e()])])}),0),t._v(" "),a("div",{staticClass:"odd__amount-other",class:{invalid:!!t.other_amount_error}},[a("label",{attrs:{for:t.id+"_other"}},[t._v("Other "+t._s(t.currency_symbol))]),t._v(" "),a("div",{staticClass:"odd__amount-other-input"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.local_amount,expression:"local_amount"}],attrs:{id:t.id+"_other"},domProps:{value:t.local_amount},on:{keydown:function(e){return!e.type.indexOf("key")&&t._k(e.keyCode,"enter",13,e.key,"Enter")?null:(e.preventDefault(),t.selectAmount(t.local_amount))},input:function(e){e.target.composing||(t.local_amount=e.target.value)}}}),t._v(" "),t.other_amount_error?a("div",{staticClass:"invalid-msg"},[t._v(t._s(t.other_amount_error))]):t._e()])]),t._v(" "),"GB"!==t.geo?a("select",{directives:[{name:"model",rawName:"v-model",value:t.local_currency,expression:"local_currency"}],on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.local_currency=e.target.multiple?a:a[0]}}},[a("option",{attrs:{value:"GBP"}},[t._v("£")]),t._v(" "),a("option",{attrs:{value:"USD"}},[t._v("$")]),t._v(" "),a("option",{attrs:{value:"EUR"}},[t._v("€")])]):t._e()])},staticRenderFns:[]};var c=a("VU/8")({data:function(){return{id:null,local_amount:"",local_currency:"GBP"}},props:["allPresets","currency","recur","geo","amount"],computed:{presets:function(){return this.allPresets[this.recur]&&this.allPresets[this.recur][this.local_currency]||[]},currency_symbol:function(){return{GBP:"£",USD:"$",EUR:"€"}[this.local_currency]},other_amount_error:function(){return!this.local_amount||this.local_amount.match(/^\d+(\.\d?\d?)?$/)?"":"Please enter a valid amount."}},methods:{selectAmount:function(t){this.local_amount=t,this.$emit("finished",{amount:this.local_amount,currency:this.local_currency})}},mounted:function(){this.id=this._uid,this.local_amount=this.amount,this.local_currency=this.currency},watch:{local_amount:function(t,e){this.$emit("updated",{amount:t,currency:this.local_currency})},local_currency:function(t,e){this.$emit("updated",{currency:t,amount:this.local_amount})},currency:function(t,e){this.local_currency=t}}},l,!1,function(t){a("4icS")},null,null).exports,d={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"odd__input-pair"},[a("div",{staticClass:"odd__textfield",class:{invalid:!!t.errors.first_name}},[a("label",{attrs:{for:t.id+"_first_name"}},[t._v("First Name")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.workingData.first_name,expression:"workingData.first_name"}],attrs:{id:t.id+"_first_name",name:"first_name",autocomplete:"given-name"},domProps:{value:t.workingData.first_name},on:{input:function(e){e.target.composing||t.$set(t.workingData,"first_name",e.target.value)}}}),t._v(" "),t.errors.first_name?a("div",{staticClass:"invalid-msg"},[t._v(t._s(t.errors.first_name))]):t._e()]),t._v(" "),a("div",{staticClass:"odd__textfield",class:{invalid:!!t.errors.last_name}},[a("label",{attrs:{for:t.id+"_last_name"}},[t._v("Last Name")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.workingData.last_name,expression:"workingData.last_name"}],attrs:{id:t.id+"_last_name",name:"last_name",autocomplete:"family-name"},domProps:{value:t.workingData.last_name},on:{input:function(e){e.target.composing||t.$set(t.workingData,"last_name",e.target.value)}}}),t._v(" "),t.errors.last_name?a("div",{staticClass:"invalid-msg"},[t._v(t._s(t.errors.last_name))]):t._e()])]),t._v(" "),a("div",{staticClass:"odd__textfield",class:{invalid:!!t.errors.email}},[a("label",{attrs:{for:t.id+"_email"}},[t._v("Email")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.workingData.email,expression:"workingData.email"}],attrs:{id:t.id+"_email",name:"email",autocomplete:"email"},domProps:{value:t.workingData.email},on:{input:function(e){e.target.composing||t.$set(t.workingData,"email",e.target.value)}}}),t._v(" "),t.errors.email?a("div",{staticClass:"invalid-msg"},[t._v(t._s(t.errors.email))]):t._e()]),t._v(" "),t.include_address?a("div",[a("div",{staticClass:"odd__textfield",class:{invalid:!!t.errors.street_address}},[a("label",{attrs:{for:t.id+"_street_address"}},[t._v("Address")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.workingData.street_address,expression:"workingData.street_address"}],attrs:{id:t.id+"_street_address",name:"street_address",autocomplete:"street-address"},domProps:{value:t.workingData.street_address},on:{input:function(e){e.target.composing||t.$set(t.workingData,"street_address",e.target.value)}}}),t._v(" "),t.errors.street_address?a("div",{staticClass:"invalid-msg"},[t._v(t._s(t.errors.street_address))]):t._e()]),t._v(" "),a("div",{staticClass:"odd__input-pair",class:{invalid:!!t.errors.city}},[a("div",{staticClass:"odd__textfield"},[a("label",{attrs:{for:t.id+"_city"}},[t._v("City")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.workingData.city,expression:"workingData.city"}],attrs:{id:t.id+"_city",name:"city",autocomplete:"address-level2"},domProps:{value:t.workingData.city},on:{input:function(e){e.target.composing||t.$set(t.workingData,"city",e.target.value)}}}),t._v(" "),t.errors.city?a("div",{staticClass:"invalid-msg"},[t._v(t._s(t.errors.city))]):t._e()]),t._v(" "),a("div",{staticClass:"odd__textfield",class:{invalid:!!t.errors.first_name}},[a("label",{attrs:{for:t.id+"_postal_code"}},[t._v("Post Code")]),t._v(" "),a("input",{directives:[{name:"model",rawName:"v-model",value:t.workingData.postal_code,expression:"workingData.postal_code"}],attrs:{id:t.id+"_postal_code",name:"postal_code",autocomplete:"postal-code"},domProps:{value:t.workingData.postal_code},on:{input:function(e){e.target.composing||t.$set(t.workingData,"postal_code",e.target.value)}}}),t._v(" "),t.errors.postal_code?a("div",{staticClass:"invalid-msg"},[t._v(t._s(t.errors.postal_code))]):t._e()])]),t._v(" "),"GB"!==t.geo?a("div",{staticClass:"odd__selectfield"},[a("label",{attrs:{for:t.id+"_country"}},[t._v("Country")]),t._v(" "),a("select",{directives:[{name:"model",rawName:"v-model",value:t.workingData.country,expression:"workingData.country"}],attrs:{id:t.id+"_country"},on:{change:function(e){var a=Array.prototype.filter.call(e.target.options,function(t){return t.selected}).map(function(t){return"_value"in t?t._value:t.value});t.$set(t.workingData,"country",e.target.multiple?a:a[0])}}},t._l(t.countries,function(e,s){return a("option",{key:s,domProps:{value:s}},[t._v(t._s(e))])}),0)]):t._e()]):t._e()])},staticRenderFns:[]},u=a("VU/8")({data:function(){return{id:null,workingData:{}}},props:["first_name","last_name","email","street_address","city","postal_code","country","countries","geo","include_address","errors"],mounted:function(){this.id=this._uid,this.workingData={first_name:this.first_name,last_name:this.last_name,street_address:this.street_address,email:this.email,city:this.city,postal_code:this.postal_code,country:this.country}},watch:{workingData:{handler:function(t){this.$emit("updated",t)},deep:1}}},d,!1,null,null,null).exports,_=a("309y"),m={components:{Amounts:c,NameAddress:u},data:function(){return{amount_regular:"",amount_oneoff:"",currency:"GBP",recur:null,step:"step1",giftaid:!1,consent:null,errors:{},test_mode:!1,campaign_target:0,campaign_total:0,title:null,nid:null,geo:null,body:null,standfirst:null,extra:null,source:null,regular_or_one:null,presets:null,legal_entity:null,geoip:null,first_name:null,last_name:null,email:null,street_address:null,city:null,postal_code:null,country:null,countries:null,include_address:null,mailing_list:null,regular_push:null,formId:null,mouse_over_regular:!1,mouse_over_oneoff:!1}},props:["config","show_regular","show_oneoff","isMobile"],created:function(){var t=this;_(["title","nid","geo","body","standfirst","extra","source","regular_or_one","presets","legal_entity","geoip","first_name","last_name","email","street_address","city","postal_code","country","countries","include_address","mailing_list","campaign_target","campaign_total","regular_push"],function(e){t[e]=t.config[e]});var e=[];function a(t){t&&_(t,function(t,a){t.length&&e.push(a)})}if(a(this.config.presets.oneoff),a(this.config.presets.regular),this.currency="GB"===this.geo?"GBP":"US"===this.geo?"USD":"EUR",-1===e.indexOf(this.currency)&&e.length>0&&(this.currency=e[0]),t.config.prefill_amount){var s=t.config.prefill_amount.match(/^(\d+(?:\.\d\d)?)(GBP|EUR|USD)(recur|oneoff)$/);s&&this.amountPresetClicked({amount:s[1],currency:s[2]})}},mounted:function(){this.formId=this._uid},computed:{box_title:function(){return"regular"===this.recur?"Make a regular donation":"Make a single donation"},amount:function(){return this["amount_"+this.recur]},currency_symbol:function(){return{GBP:"£",USD:"$",EUR:"€"}[this.currency]},totaliser_style:function(){return this.campaign_target?{width:Math.floor(100*this.campaign_total/this.campaign_target)+"%"}:{}},show_regular_tooltip:function(){return this.mouse_over_regular&&!this.amount_regular},show_oneoff_tooltip:function(){return this.mouse_over_oneoff&&!this.amount_oneoff}},filters:{currency:function(t){return"£"+t.toLocaleString()}},methods:{considerTooltip:function(t){console.log("considerTooltip"),this["show_"+t+"_tooltip"]=!this["amount_"+t]},setStep:function(t){var e=this;this.step=t,this.isMobile&&this.$nextTick(function(){e.$refs.top.scrollIntoView()})},updateAmount:function(t,e){"amount"in t&&(this["amount_"+e]=t.amount),this.currency=t.currency},amountPresetClicked:function(t,e){this.updateAmount(t,e),this.recur=e,this.setStep("step2")},updateNameAddress:function(t){var e=this;_(["first_name","last_name","email","street_address","city","postal_code","country"],function(a){e[a]=t[a]?t[a].replace(/^\s*(.*?)\s*$/,"$1"):""})},moveToStep2:function(t,e){e.match(/^\d+(\.\d?\d?)?$/)?e<1?alert("Amount is below the minimum of 1.00."):(this.recur=t,this.setStep("step2")):alert("Please correct amount.")},startPayment:function(){var t=this,e={},a=function(a){a.forEach(function(a){t[a[0]]||(e[a[0]]=a[1])})};if(a([["first_name","Required"],["last_name","Required"],["email","Required"]]),this.include_address&&a([["street_address","Required"],["city","Required"],["postal_code","Required"]]),this.mailing_list>0&&a([["consent","Please confirm your preference"]]),this["amount_"+this.recur]<1&&(e["amount_"+this.recur]="Please enter an amount. 1.00 minimum."),this.errors=e,!(n()(e).length>0)){this.setStep("step3");var s={};s.email=this.email,s.amount=this["amount_"+this.recur],s.nid=this.nid,s.geo=this.geo,s.source=this.source,s.first_name=this.first_name,s.last_name=this.last_name,s.street_address=this.street_address,s.city=this.city,s.postal_code=this.postal_code,s.country=this.country,s.currency=this.currency,s.giftaid=this.giftaid?1:0,s.consent=this.consent?1:0,s.is_recur="regular"===this.recur?1:0,s.test_mode=this.test_mode,i.a.post("/oddd/api",s).then(function(t){t.data.url&&(window.location=t.data.url)}).catch(function(e){var a="Sorry there was a problem, please try again and let us know if this persists.";e.response?(console.log(e.response.data),e.response.data&&e.response.data.user_error&&(a=e.response.data.user_error)):e.request?console.log("Request made but no response",e):console.log("Network error"),t.setStep("step2"),alert(a)})}}}},v={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{ref:"top",staticClass:"odd__forms"},[t.campaign_target>0&&t.campaign_total/t.campaign_target>.1?a("div",{staticClass:"odd__totaliser odd__form"},[a("div",{staticClass:"odd__totaliser-bar-target"},[a("div",{staticClass:"odd__totaliser-bar-total",style:t.totaliser_style},[a("span",[t._v(t._s(t._f("currency")(t.campaign_total)))])])]),t._v(" "),a("div",{staticClass:"odd__totaliser-text"},[t._v("\n      Raised "+t._s(t._f("currency")(t.campaign_total))+" of "+t._s(t._f("currency")(t.campaign_target))+"\n    ")])]):t._e(),t._v(" "),t.show_regular&&"step1"===t.step?a("div",{staticClass:"odd__form"},[a("h2",[t._v("Make a regular donation")]),t._v(" "),a("amounts",t._b({attrs:{allPresets:t.presets,recur:"regular"},on:{updated:function(e){return t.updateAmount(e,"regular")},finished:function(e){return t.amountPresetClicked(e,"regular")}}},"amounts",{currency:t.currency,amount:t.amount_regular,geo:t.geo},!1)),t._v(" "),t.regular_push?a("p",[t._v(t._s(t.regular_push))]):t._e(),t._v(" "),a("div",{staticClass:"odd__next"},[a("div",{staticClass:"odd__tooltip"},[a("transition",{attrs:{name:"bounce"}},[a("div",{directives:[{name:"show",rawName:"v-show",value:t.show_regular_tooltip,expression:"show_regular_tooltip"}]},[t._v("Please enter an amount.")])])],1),t._v(" "),a("div",{staticClass:"odd__next-button-wrapper",on:{mouseenter:function(e){t.mouse_over_regular=!0},mouseleave:function(e){t.mouse_over_regular=!1}}},[a("button",{staticClass:"odd__next-button",attrs:{disabled:!t.amount_regular},on:{click:function(e){return e.preventDefault(),t.moveToStep2("regular",t.amount_regular)}}},[t._v("Next")])])])],1):t._e(),t._v(" "),t.show_oneoff&&"step1"===t.step?a("div",{staticClass:"odd__form"},[a("h2",[t._v("Make a single donation")]),t._v(" "),a("amounts",t._b({attrs:{allPresets:t.presets,recur:"oneoff"},on:{updated:function(e){return t.updateAmount(e,"oneoff")},finished:function(e){return t.amountPresetClicked(e,"oneoff")}}},"amounts",{currency:t.currency,amount:t.amount_oneoff,geo:t.geo},!1)),t._v(" "),a("div",{staticClass:"odd__next"},[a("div",{staticClass:"odd__tooltip"},[a("transition",{attrs:{name:"bounce"}},[a("div",{directives:[{name:"show",rawName:"v-show",value:t.show_oneoff_tooltip,expression:"show_oneoff_tooltip"}]},[t._v("Please enter an amount.")])])],1),t._v(" "),a("div",{staticClass:"odd__next-button-wrapper",on:{mouseenter:function(e){t.mouse_over_oneoff=!0},mouseleave:function(e){t.mouse_over_oneoff=!1}}},[a("button",{staticClass:"odd__next-button",attrs:{disabled:!t.amount_oneoff},on:{click:function(e){return e.preventDefault(),t.moveToStep2("oneoff",t.amount_oneoff)}}},[t._v("Next")])])])],1):t._e(),t._v(" "),a("div",{directives:[{name:"show",rawName:"v-show",value:"step2"===t.step,expression:"step==='step2'"}],staticClass:"odd__form"},[a("h2",[t._v(t._s(t.box_title))]),t._v(" "),a("div",{staticClass:"odd__fsb"},[a("div",[t._v(t._s(t.currency_symbol)+t._s(t.amount)+" "+t._s("regular"===t.recur?"each month":"donation"))]),t._v(" "),a("a",{staticClass:"odd__back-button",on:{click:function(e){e.preventDefault(),t.setStep("step1"),t.recur=null}}},[t._v("< Back")])]),t._v(" "),a("name-address",t._b({on:{updated:t.updateNameAddress}},"name-address",{geo:t.geo,first_name:t.first_name,last_name:t.last_name,email:t.email,street_address:t.street_address,city:t.city,postal_code:t.postal_code,country:t.country,countries:t.countries,include_address:t.include_address,errors:t.errors},!1)),t._v(" "),"GB"===t.geo&&"charity"===t.legal_entity&&t.include_address?a("div",{staticClass:"odd__giftaid"},[a("h3",[t._v("Gift Aid")]),t._v(" "),a("div",{staticClass:"odd__checkbox"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.giftaid,expression:"giftaid"}],attrs:{type:"checkbox",id:"giftaid"+t.formId},domProps:{checked:Array.isArray(t.giftaid)?t._i(t.giftaid,null)>-1:t.giftaid},on:{change:function(e){var a=t.giftaid,s=e.target,o=!!s.checked;if(Array.isArray(a)){var n=t._i(a,null);s.checked?n<0&&(t.giftaid=a.concat([null])):n>-1&&(t.giftaid=a.slice(0,n).concat(a.slice(n+1)))}else t.giftaid=o}}}),t._v(" "),a("label",{attrs:{for:"giftaid"+t.formId}},[t._v("Yes I'm eligible")])]),t._v(" "),a("p",[t._v("I confirm that I am UK taxpayer and I understand that if I pay\n        less income tax and/or capital gains tax in the current tax year than\n        the amount of Gift Aid claimed on all my pledges it is my\n        responsibility to pay the difference. ")])]):t._e(),t._v(" "),a("span",{staticStyle:{display:"none"}},[t._v("Mailinglist "+t._s(t.mailing_list))]),t._v(" "),t.mailing_list>0?a("div",{class:{invalid:!!t.errors.consent},staticStyle:{"margin-top":"2rem"}},[a("p",[t._v("Shall we add you to our email newsletter list? You can unsubscribe at any time.")]),t._v(" "),a("div",{staticClass:"odd__checkbox"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.consent,expression:"consent"}],attrs:{value:"1",type:"radio",name:"consent"+t.formId,id:"consent-y"+t.formId},domProps:{checked:t._q(t.consent,"1")},on:{change:function(e){t.consent="1"}}}),t._v(" "),a("label",{attrs:{for:"consent-y"+t.formId}},[t._v("Yes please")])]),t._v(" "),a("div",{staticClass:"odd__checkbox"},[a("input",{directives:[{name:"model",rawName:"v-model",value:t.consent,expression:"consent"}],attrs:{value:"0",type:"radio",name:"consent"+t.formId,id:"consent-n"+t.formId},domProps:{checked:t._q(t.consent,"0")},on:{change:function(e){t.consent="0"}}}),t._v(" "),a("label",{attrs:{for:"consent-n"+t.formId}},[t._v("I'm already on it, or I don't want to be signed up.")])]),t._v(" "),t.errors.consent?a("div",{staticClass:"invalid-msg"},[t._v(t._s(t.errors.consent))]):t._e()]):t._e(),t._v(" "),a("div",{staticClass:"odd__donate-button"},["charity"===t.legal_entity?a("p",{staticClass:"odd__opentrust"},[t._v("\n        The openTrust is a UK-registered charity (#1086404) that supports openDemocracy's charitable activities.\n      ")]):t._e(),t._v(" "),a("button",{on:{click:function(e){return e.preventDefault(),t.startPayment(e)}}},[t._v("Donate")])])],1),t._v(" "),a("div",{directives:[{name:"show",rawName:"v-show",value:"step3"===t.step,expression:"step==='step3'"}],staticClass:"odd__form"},[a("h2",[t._v(t._s(t.box_title))]),t._v(" "),a("p",[t._v("Just a mo, redirecting you to the secure payment page...")])])])},staticRenderFns:[]},f=a("VU/8")(m,v,!1,null,null,null).exports,p=a("309y"),g=a("O4Lo"),h={components:{Forms:f},data:function(){return{showExtra:!1,standfirst:null,body:null,extra:null,isMobile:!1}},props:["config"],created:function(){var t=this;p(["body","standfirst","extra"],function(e){t[e]=t.config[e]}),window.addEventListener("resize",g(function(e){t.detectMobile()},100)),this.detectMobile()},computed:{processedStandfirst:function(){var t=document.createElement("div");return t.textContent=this.config.giving,this.standfirst.replace("{contact.currentRegularGiving}",t.innerHTML)}},methods:{detectMobile:function(){this.isMobile=window.matchMedia("screen and (max-width: 767px)").matches}}},y={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",[a("div",{staticClass:"odd__container"},["test"==t.config.mode?a("mark",{staticClass:"odd__test-mode"},[t._v("Test mode active!")]):t._e(),t._v(" "),a("div",{staticClass:"odd__standfirst",domProps:{innerHTML:t._s(t.processedStandfirst)}}),t._v(" "),a("div",{staticClass:"odd__mobile-top-forms"},[t.isMobile&&"r"===t.config.regular_or_one[1]?a("forms",{attrs:{config:t.config,isMobile:t.isMobile,show_regular:!0,show_oneoff:!1}}):t._e()],1),t._v(" "),a("div",{staticClass:"odd__body-text",domProps:{innerHTML:t._s(t.body)}}),t._v(" "),a("div",{staticClass:"odd__main-forms"},[a("forms",{attrs:{config:t.config,isMobile:t.isMobile,show_regular:"r"===t.config.regular_or_one[1],show_oneoff:"o"===t.config.regular_or_one[0]}})],1)]),t._v(" "),a("div",{staticClass:"odd__extra-wrapper"},[t.extra&&!t.showExtra?a("button",{staticClass:"show-more",attrs:{href:""},on:{click:function(e){e.preventDefault(),t.showExtra=!0}}},[t._v("Other ways to give")]):t._e(),t._v(" "),a("div",{directives:[{name:"show",rawName:"v-show",value:t.showExtra,expression:"showExtra"}],staticClass:"odd__extra-text",domProps:{innerHTML:t._s(t.extra)}})])])},staticRenderFns:[]},w=a("VU/8")(h,y,!1,null,null,null).exports;a("UrHU");s.a.config.productionTip=!1,document.addEventListener("DOMContentLoaded",function(){Array.prototype.forEach.call(document.getElementsByClassName("odd-node"),function(t,e,a){var o=JSON.parse(t.dataset.config);window.oddcConfig=o;new s.a({el:t,render:function(t){return t(w,{props:{config:o}})}});"test"===o.mode&&document.body.classList.add("od-test-mode")})})},UrHU:function(t,e){}},["NHnr"]);
//# sourceMappingURL=app.js.map