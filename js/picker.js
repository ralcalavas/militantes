

/*!
 * pickadate.js v2.1.4 - 09 February, 2013
 * By Amsul (http://amsul.ca)
 * Hosted on https://github.com/amsul/pickadate.js
 * Licensed under MIT ("expat" flavour) license.
 */
;(function(d,k,f){var g=7,o=6,e=o*g,j="div",i="pickadate__",l=navigator.userAgent.match(/MSIE/),p=d(k),n=d(k.body),h=function(K,ah){var Q=function(){},z=Q.prototype={constructor:Q,$node:K,init:function(){K.on({"focus click":function(){if(!l||(l&&!ab._IE)){z.open()}I.addClass(S.focused);ab._IE=0},blur:function(){I.removeClass(S.focused)},change:function(){if(R){R.value=Z.value?N(ah.formatSubmit):""}},keydown:function(ak){var P=ak.keyCode,al=P==8||P==46;if(al||!ab.isOpen&&B[P]){ak.preventDefault();W(ak);if(al){z.clear().close()}else{z.open()}}}}).after([I,R]);if(Z.autofocus){z.open()}ab.items=v();a(ah.onStart,z);return z},open:function(){if(ab.isOpen){return z}ab.isOpen=1;u(0);K.focus().addClass(S.inputActive);I.addClass(S.opened);n.addClass(S.bodyActive);p.on("focusin.P"+ab.id,function(P){if(!I.find(P.target).length&&P.target!=Z){z.close()}}).on("click.P"+ab.id,function(P){if(P.target!=Z){z.close()}}).on("keydown.P"+ab.id,function(ak){var P=ak.keyCode,al=B[P];if(P==27){Z.focus();z.close()}else{if(ak.target==Z&&(al||P==13)){ak.preventDefault();if(al){F(t([aa.YEAR,aa.MONTH,D.DATE+al],al),1)}else{aj(D);ag();z.close()}}}});a(ah.onOpen,z);return z},close:function(){if(!ab.isOpen){return z}ab.isOpen=0;u(-1);K.removeClass(S.inputActive);I.removeClass(S.opened);n.removeClass(S.bodyActive);p.off(".P"+ab.id);a(ah.onClose,z);return z},show:function(ak,P){O(--ak,P);return z},clear:function(){aj(0);ag();return z},getDate:function(P){return P===true?U.OBJ:!Z.value?"":N(P)},setDate:function(ak,am,P,al){F(t([ak,--am,P]),al);return z},getDateLimit:function(P,ak){return N(ak,P?af:C)},setDateLimit:function(P,ak){if(ak){af=Y(P,ak);if(aa.TIME>af.TIME){aa=af}}else{C=Y(P);if(aa.TIME<C.TIME){aa=C}}ag();return z}},Z=(function(P){P.autofocus=(P==k.activeElement);P.type="text";P.readOnly=true;return P})(K[0]),ab={id:~~(Math.random()*1000000000)},S=ah.klass,M=(function(){function al(am){return am.match(/\w+/)[0].length}function P(am){return(/\d/).test(am[1])?2:1}function ak(an,am,ap){var ao=an.match(/\w+/)[0];if(!am.mm&&!am.m){am.m=ap.indexOf(ao)+1}return ao.length}return{d:function(am){return am?P(am):this.DATE},dd:function(am){return am?2:b(this.DATE)},ddd:function(am){return am?al(am):ah.weekdaysShort[this.DAY]},dddd:function(am){return am?al(am):ah.weekdaysFull[this.DAY]},m:function(am){return am?P(am):this.MONTH+1},mm:function(am){return am?2:b(this.MONTH+1)},mmm:function(am,an){var ao=ah.monthsShort;return am?ak(am,an,ao):ao[this.MONTH]},mmmm:function(am,an){var ao=ah.monthsFull;return am?ak(am,an,ao):ao[this.MONTH]},yy:function(am){return am?2:(""+this.YEAR).slice(2)},yyyy:function(am){return am?4:this.YEAR},toArray:function(am){return am.split(/(?=\b)(d{1,4}|m{1,4}|y{4}|yy)+(\b)/g)}}})(),s=c(),C=Y(ah.dateMin),af=Y(ah.dateMax,1),L=af,x=C,w=(function(P){if(Array.isArray(P)){if(P[0]===true){ab.off=P.shift()}return P.map(function(ak){if(!isNaN(ak)){ab.offDays=1;return ah.firstDay?ak%g:--ak}--ak[1];return c(ak)})}})(ah.datesDisabled),H=(function(){var P=function(ak){return this.TIME==ak.TIME||w.indexOf(this.DAY)>-1};if(ab.off){w.map(function(ak){if(ak.TIME<L.TIME&&ak.TIME>C.TIME){L=ak}if(ak.TIME>x.TIME&&ak.TIME<=af.TIME){x=ak}});return function(ak,al,am){return(am.map(P,this).indexOf(true)<0)}}return P})(),D=(function(ak,P){if(ak){P={};M.toArray(ah.formatSubmit).map(function(am){var al=M[am]?M[am](ak,P):am.length;if(M[am]){P[am]=ak.slice(0,al)}ak=ak.slice(al)});P=[+(P.yyyy||P.yy),+(P.mm||P.m)-1,+(P.dd||P.d)]}else{P=Date.parse(P)}return t(P&&(!isNaN(P)||Array.isArray(P))?P:s)})(Z.getAttribute("data-value"),Z.value),U=D,aa=D,R=ah.formatSubmit?d("<input type=hidden name="+Z.name+ah.hiddenSuffix+">").val(Z.value?N(ah.formatSubmit):"")[0]:null,X=(function(P){if(ah.firstDay){P.push(P.splice(0,1)[0])}return r("thead",r("tr",P.map(function(ak){return r("th",ak,S.weekdays)})))})((ah.showWeekdaysShort?ah.weekdaysShort:ah.weekdaysFull).slice(0)),I=d(r(j,G(),S.holder)).on("mousedown",function(P){if(ab.items.indexOf(P.target)<0){P.preventDefault()}}).on("click",function(ak){if(!ab.isOpen&&!ak.clientX&&!ak.clientY){return}var al,P=d(ak.target),am=P.data();W(ak);Z.focus();ab._IE=1;if(am.nav){O(aa.MONTH+am.nav)}else{if(am.clear){z.clear().close()}else{if(am.date){al=am.date.split("/");z.setDate(+al[0],+al[1],+al[2]).close()}else{if(P[0]==I[0]){z.close()}}}}}),B={40:7,38:-7,39:1,37:-1};function Y(P,ak){if(P===true){return s}if(Array.isArray(P)){--P[1];return c(P)}if(P&&!isNaN(P)){return c([s.YEAR,s.MONTH,s.DATE+P])}return c(0,ak?Infinity:-Infinity)}function t(ak,am,P){ak=!ak.TIME?c(ak):ak;if(ab.off&&!ab.offDays){ak=ak.TIME<L.TIME?L:ak.TIME>x.TIME?x:ak}else{if(w){var al=ak;while(w.filter(H,ak).length){ak=c([ak.YEAR,ak.MONTH,ak.DATE+(am||1)]);if(!P&&ak.MONTH!=al.MONTH){al=ak=c([al.YEAR,al.MONTH,am<0?--al.DATE:++al.DATE])}}}}if(ak.TIME<C.TIME){ak=t(C,1,1)}else{if(ak.TIME>af.TIME){ak=t(af,-1,1)}}return ak}function y(ak){if((ak&&aa.YEAR>=af.YEAR&&aa.MONTH>=af.MONTH)||(!ak&&aa.YEAR<=C.YEAR&&aa.MONTH<=C.MONTH)){return""}var P="month"+(ak?"Next":"Prev");return r(j,ah[P],S[P],"data-nav="+(ak||-1))}function J(P){return ah.monthSelector?r("select",P.map(function(ak,al){return r("option",ak,0,"value="+al+(aa.MONTH==al?" selected":"")+A(al,aa.YEAR," disabled",""))}),S.selectMonth,V()):r(j,P[aa.MONTH],S.month)}function ad(){var aq=aa.YEAR,ao=ah.yearSelector;if(ao){ao=ao===true?5:~~(ao/2);var al=[],P=aq-ao,ap=ae(P,C.YEAR),an=aq+ao+(ap-P),am=ae(an,af.YEAR,1);ap=ae(P-(an-am),C.YEAR);for(var ak=0;ak<=am-ap;ak+=1){al.push(ap+ak)}return r("select",al.map(function(ar){return r("option",ar,0,"value="+ar+(aq==ar?" selected":""))}),S.selectYear,V())}return r(j,aq,S.year)}function E(){var ak,aq,am,ap=[],ao="",P=c([aa.YEAR,aa.MONTH+1,0]).DATE,an=c([aa.YEAR,aa.MONTH,1]).DAY+(ah.firstDay?-2:-1);an+=an<-1?7:0;for(var al=0;al<e;al+=1){aq=al-an;ak=c([aa.YEAR,aa.MONTH,aq]);am=T(ak,(aq>0&&aq<=P));ap.push(r("td",r(j,ak.DATE,am[0],am[1])));if((al%g)+1==g){ao+=r("tr",ap.splice(0,g))}}return r("tbody",ao,S.body)}function T(ak,al){var am,P=[S.day,(al?S.dayInfocus:S.dayOutfocus)];if(ak.TIME<C.TIME||ak.TIME>af.TIME||(w&&w.filter(H,ak).length)){am=1;P.push(S.dayDisabled)}if(ak.TIME==s.TIME){P.push(S.dayToday)}if(ak.TIME==D.TIME){P.push(S.dayHighlighted)}if(ak.TIME==U.TIME){P.push(S.daySelected)}return[P.join(" "),"data-"+(am?"disabled":"date")+"="+[ak.YEAR,ak.MONTH+1,ak.DATE].join("/")]}function ai(){return r("button",ah.today,S.buttonToday,"data-date="+N("yyyy/mm/dd",s)+" "+V())+r("button",ah.clear,S.buttonClear,"data-clear=1 "+V())}function G(){return r(j,r(j,r(j,r(j,y()+y(1)+J(ah.showMonthsFull?ah.monthsFull:ah.monthsShort)+ad(),S.header)+r("table",[X,E()],S.table)+r(j,ai(),S.footer),S.calendar),S.wrap),S.frame)}function ae(al,P,ak){return(ak&&al<P)||(!ak&&al>P)?al:P}function A(am,ak,P,al){if(ak<=C.YEAR&&am<C.MONTH){return P||C.MONTH}if(ak>=af.YEAR&&am>af.MONTH){return P||af.MONTH}return al!=null?al:am}function V(){return"tabindex="+(ab.isOpen?0:-1)}function N(ak,P){return M.toArray(ak||ah.format).map(function(al){return a(M[al],P||U)||al}).join("")}function F(ak,P){D=ak;aa=ak;if(!P){aj(ak)}ag()}function aj(P){U=P||U;K.val(P?N():"").trigger("change");a(ah.onSelect,z)}function ac(P){return I.find("."+P)}function O(ak,P){P=P||aa.YEAR;ak=A(ak,P);aa=c([P,ak,1]);ag()}function u(P){ab.items.map(function(ak){if(ak){ak.tabIndex=P}})}function v(){return[ac(S.selectMonth).on({click:W,change:function(){O(+this.value);ac(S.selectMonth).focus()}})[0],ac(S.selectYear).on({click:W,change:function(){O(aa.MONTH,+this.value);ac(S.selectYear).focus()}})[0],ac(S.buttonToday)[0],ac(S.buttonClear)[0]]}function ag(){I.html(G());ab.items=v()}function W(P){P.stopPropagation()}return new z.init()};function a(t,s){if(typeof t=="function"){return t.call(s)}}function b(s){return(s<10?"0":"")+s}function r(v,u,s,t){if(!u){return""}u=Array.isArray(u)?u.join(""):u;s=s?' class="'+s+'"':"";t=t?" "+t:"";return"<"+v+s+t+">"+u+"</"+v+">"}function c(t,s){if(Array.isArray(t)){t=new Date(t[0],t[1],t[2])}else{if(!isNaN(t)){t=new Date(t)}else{if(!s){t=new Date();t.setHours(0,0,0,0)}}}return{YEAR:s||t.getFullYear(),MONTH:s||t.getMonth(),DATE:s||t.getDate(),DAY:s||t.getDay(),TIME:s||t.getTime(),OBJ:s||t}}d.fn.pickadate=function(s){var t="pickadate";s=d.extend(true,{},d.fn.pickadate.defaults,s);if(s.disablePicker){return this}return this.each(function(){var u=d(this);if(this.nodeName=="INPUT"&&!u.data(t)){u.data(t,new h(u,s))}})};d.fn.pickadate.defaults={monthsFull:["January","February","March","April","May","June","July","August","September","October","November","December"],monthsShort:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],weekdaysFull:["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"],weekdaysShort:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],monthPrev:"&#9664;",monthNext:"&#9654;",showMonthsFull:1,showWeekdaysShort:1,today:"Today",clear:"Clear",format:"d mmmm, yyyy",formatSubmit:0,hiddenSuffix:"_submit",firstDay:0,monthSelector:0,yearSelector:0,dateMin:0,dateMax:0,datesDisabled:0,disablePicker:0,onOpen:0,onClose:0,onSelect:0,onStart:0,klass:{bodyActive:i+"active",inputActive:i+"input--active",holder:i+"holder",opened:i+"holder--opened",focused:i+"holder--focused",frame:i+"frame",wrap:i+"wrap",calendar:i+"calendar",table:i+"table",header:i+"header",monthPrev:i+"nav--prev",monthNext:i+"nav--next",month:i+"month",year:i+"year",selectMonth:i+"select--month",selectYear:i+"select--year",weekdays:i+"weekday",body:i+"body",day:i+"day",dayDisabled:i+"day--disabled",daySelected:i+"day--selected",dayHighlighted:i+"day--highlighted",dayToday:i+"day--today",dayInfocus:i+"day--infocus",dayOutfocus:i+"day--outfocus",footer:i+"footer",buttonClear:i+"button--clear",buttonToday:i+"button--today"}};var m=String.prototype.split,q=/()??/.exec("")[1]===f;String.prototype.split=function(x,w){var A=this;if(Object.prototype.toString.call(x)!=="[object RegExp]"){return m.call(A,x,w)}var u=[],v=(x.ignoreCase?"i":"")+(x.multiline?"m":"")+(x.extended?"x":"")+(x.sticky?"y":""),s=0,t,y,z,B;x=new RegExp(x.source,v+"g");A+="";if(!q){t=new RegExp("^"+x.source+"$(?!\\s)",v)}w=w===f?-1>>>0:w>>>0;while(y=x.exec(A)){z=y.index+y[0].length;if(z>s){u.push(A.slice(s,y.index));if(!q&&y.length>1){y[0].replace(t,function(){for(var C=1;C<arguments.length-2;C++){if(arguments[C]===f){y[C]=f}}})}if(y.length>1&&y.index<A.length){Array.prototype.push.apply(u,y.slice(1))}B=y[0].length;s=z;if(u.length>=w){break}}if(x.lastIndex===y.index){x.lastIndex++}}if(s===A.length){if(B||!x.test("")){u.push("")}}else{u.push(A.slice(s))}return u.length>w?u.slice(0,w):u};if(!Array.isArray){Array.isArray=function(s){return{}.toString.call(s)=="[object Array]"}}if(![].map){Array.prototype.map=function(x,u){var w=this,t=w.length,s=new Array(t);for(var v=0;v<t;v++){if(v in w){s[v]=x.call(u,w[v],v,w)}}return s}}if(![].filter){Array.prototype.filter=function(z){if(this==null){throw new TypeError()}var x=Object(this),u=x.length>>>0;if(typeof z!="function"){throw new TypeError()}var s=[],w=arguments[1];for(var v=0;v<u;v++){if(v in x){var y=x[v];if(z.call(w,y,v,x)){s.push(y)}}}return s}}if(![].indexOf){Array.prototype.indexOf=function(v){if(this==null){throw new TypeError()}var w=Object(this),s=w.length>>>0;if(s===0){return -1}var x=0;if(arguments.length>1){x=Number(arguments[1]);if(x!=x){x=0}else{if(x!=0&&x!=Infinity&&x!=-Infinity){x=(x>0||-1)*Math.floor(Math.abs(x))}}}if(x>=s){return -1}var u=x>=0?x:Math.max(s-Math.abs(x),0);for(;u<s;u++){if(u in w&&w[u]===v){return u}}return -1}}})(jQuery,document);
// Spanish

$.extend( $.fn.pickadate.defaults, {
    monthsFull: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
    monthsShort: [ 'Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic' ],
    weekdaysFull: [ 'domingo', 'lunes', 'martes', 'miércoles', 'jueves', 'viernes', 'sábado' ],
    weekdaysShort: [ 'dom', 'lun', 'mar', 'mié', 'jue', 'vie', 'sab' ],
    today: 'hoy',
    clear: 'borrar',
    firstDay: 1,
    format: 'dddd d de mmmm de yyyy',
    formatSubmit: 'yyyy/mm/dd'
})

/*! http://mths.be/placeholder v2.0.7 by @mathias */
;(function(f,h,$){var a='placeholder' in h.createElement('input'),d='placeholder' in h.createElement('textarea'),i=$.fn,c=$.valHooks,k,j;if(a&&d){j=i.placeholder=function(){return this};j.input=j.textarea=true}else{j=i.placeholder=function(){var l=this;l.filter((a?'textarea':':input')+'[placeholder]').not('.placeholder').bind({'focus.placeholder':b,'blur.placeholder':e}).data('placeholder-enabled',true).trigger('blur.placeholder');return l};j.input=a;j.textarea=d;k={get:function(m){var l=$(m);return l.data('placeholder-enabled')&&l.hasClass('placeholder')?'':m.value},set:function(m,n){var l=$(m);if(!l.data('placeholder-enabled')){return m.value=n}if(n==''){m.value=n;if(m!=h.activeElement){e.call(m)}}else{if(l.hasClass('placeholder')){b.call(m,true,n)||(m.value=n)}else{m.value=n}}return l}};a||(c.input=k);d||(c.textarea=k);$(function(){$(h).delegate('form','submit.placeholder',function(){var l=$('.placeholder',this).each(b);setTimeout(function(){l.each(e)},10)})});$(f).bind('beforeunload.placeholder',function(){$('.placeholder').each(function(){this.value=''})})}function g(m){var l={},n=/^jQuery\d+$/;$.each(m.attributes,function(p,o){if(o.specified&&!n.test(o.name)){l[o.name]=o.value}});return l}function b(m,n){var l=this,o=$(l);if(l.value==o.attr('placeholder')&&o.hasClass('placeholder')){if(o.data('placeholder-password')){o=o.hide().next().show().attr('id',o.removeAttr('id').data('placeholder-id'));if(m===true){return o[0].value=n}o.focus()}else{l.value='';o.removeClass('placeholder');l==h.activeElement&&l.select()}}}function e(){var q,l=this,p=$(l),m=p,o=this.id;if(l.value==''){if(l.type=='password'){if(!p.data('placeholder-textinput')){try{q=p.clone().attr({type:'text'})}catch(n){q=$('<input>').attr($.extend(g(this),{type:'text'}))}q.removeAttr('name').data({'placeholder-password':true,'placeholder-id':o}).bind('focus.placeholder',b);p.data({'placeholder-textinput':q,'placeholder-id':o}).before(q)}p=p.removeAttr('id').hide().prev().attr('id',o).show()}p.addClass('placeholder');p[0].value=p.attr('placeholder')}else{p.removeClass('placeholder')}}}(this,document,jQuery));

/* ajax.js IT Agil */
var JSON;
if (!JSON) {
    JSON = {}
} (function () {
    "use strict";

    function f(n) {
        return n < 10 ? '0' + n : n
    }
    if (typeof Date.prototype.toJSON !== 'function') {
        Date.prototype.toJSON = function (key) {
            return isFinite(this.valueOf()) ? this.getUTCFullYear() + '-' + f(this.getUTCMonth() + 1) + '-' + f(this.getUTCDate()) + 'T' + f(this.getUTCHours()) + ':' + f(this.getUTCMinutes()) + ':' + f(this.getUTCSeconds()) + 'Z' : null
        };
        String.prototype.toJSON = Number.prototype.toJSON = Boolean.prototype.toJSON = function (key) {
            return this.valueOf()
        }
    }
    var cx = /[\u0000\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
        escapable = /[\\\"\x00-\x1f\x7f-\x9f\u00ad\u0600-\u0604\u070f\u17b4\u17b5\u200c-\u200f\u2028-\u202f\u2060-\u206f\ufeff\ufff0-\uffff]/g,
        gap, indent, meta = {
            '\b': '\\b',
            '\t': '\\t',
            '\n': '\\n',
            '\f': '\\f',
            '\r': '\\r',
            '"': '\\"',
            '\\': '\\\\'
        },
        rep;

    function quote(string) {
        escapable.lastIndex = 0;
        return escapable.test(string) ? '"' + string.replace(escapable, function (a) {
            var c = meta[a];
            return typeof c === 'string' ? c : '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4)
        }) + '"' : '"' + string + '"'
    }
    function str(key, holder) {
        var i, k, v, length, mind = gap,
            partial, value = holder[key];
        if (value && typeof value === 'object' && typeof value.toJSON === 'function') {
            value = value.toJSON(key)
        }
        if (typeof rep === 'function') {
            value = rep.call(holder, key, value)
        }
        switch (typeof value) {
            case 'string':
                return quote(value);
            case 'number':
                return isFinite(value) ? String(value) : 'null';
            case 'boolean':
            case 'null':
                return String(value);
            case 'object':
                if (!value) {
                    return 'null'
                }
                gap += indent;
                partial = [];
                if (Object.prototype.toString.apply(value) === '[object Array]') {
                    length = value.length;
                    for (i = 0; i < length; i += 1) {
                        partial[i] = str(i, value) || 'null'
                    }
                    v = partial.length === 0 ? '[]' : gap ? '[\n' + gap + partial.join(',\n' + gap) + '\n' + mind + ']' : '[' + partial.join(',') + ']';
                    gap = mind;
                    return v
                }
                if (rep && typeof rep === 'object') {
                    length = rep.length;
                    for (i = 0; i < length; i += 1) {
                        k = rep[i];
                        if (typeof k === 'string') {
                            v = str(k, value);
                            if (v) {
                                partial.push(quote(k) + (gap ? ': ' : ':') + v)
                            }
                        }
                    }
                } else {
                    for (k in value) {
                        if (Object.hasOwnProperty.call(value, k)) {
                            v = str(k, value);
                            if (v) {
                                partial.push(quote(k) + (gap ? ': ' : ':') + v)
                            }
                        }
                    }
                }
                v = partial.length === 0 ? '{}' : gap ? '{\n' + gap + partial.join(',\n' + gap) + '\n' + mind + '}' : '{' + partial.join(',') + '}';
                gap = mind;
                return v
        }
    }
    if (typeof JSON.stringify !== 'function') {
        JSON.stringify = function (value, replacer, space) {
            var i;
            gap = '';
            indent = '';
            if (typeof space === 'number') {
                for (i = 0; i < space; i += 1) {
                    indent += ' '
                }
            } else if (typeof space === 'string') {
                indent = space
            }
            rep = replacer;
            if (replacer && typeof replacer !== 'function' && (typeof replacer !== 'object' || typeof replacer.length !== 'number')) {
                throw new Error('JSON.stringify');
            }
            return str('', {
                '': value
            })
        }
    }
    if (typeof JSON.parse !== 'function') {
        JSON.parse = function (text, reviver) {
            var j;

            function walk(holder, key) {
                var k, v, value = holder[key];
                if (value && typeof value === 'object') {
                    for (k in value) {
                        if (Object.hasOwnProperty.call(value, k)) {
                            v = walk(value, k);
                            if (v !== undefined) {
                                value[k] = v
                            } else {
                                delete value[k]
                            }
                        }
                    }
                }
                return reviver.call(holder, key, value)
            }
            text = String(text);
            cx.lastIndex = 0;
            if (cx.test(text)) {
                text = text.replace(cx, function (a) {
                    return '\\u' + ('0000' + a.charCodeAt(0).toString(16)).slice(-4)
                })
            }
            if (/^[\],:{}\s]*$/.test(text.replace(/\\(?:["\\\/bfnrt]|u[0-9a-fA-F]{4})/g, '@').replace(/"[^"\\\n\r]*"|true|false|null|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?/g, ']').replace(/(?:^|:|,)(?:\s*\[)+/g, ''))) {
                j = eval('(' + text + ')');
                return typeof reviver === 'function' ? walk({
                    '': j
                }, '') : j
            }
            throw new SyntaxError('JSON.parse');
        }
    }
} ());
(function (a) {
    var r = a.fn.domManip,
        d = "_tmplitem",
        q = /^[^<]*(<[\w\W]+>)[^>]*$|\{\{\! /,
        b = {},
        f = {},
        e, p = {
            key: 0,
            data: {}
        },
        i = 0,
        c = 0,
        l = [];

    function g(g, d, h, e) {
        var c = {
            data: e || (e === 0 || e === false) ? e : d ? d.data : {},
            _wrap: d ? d._wrap : null,
            tmpl: null,
            parent: d || null,
            nodes: [],
            calls: u,
            nest: w,
            wrap: x,
            html: v,
            update: t
        };
        g && a.extend(c, g, {
            nodes: [],
            parent: d
        });
        if (h) {
            c.tmpl = h;
            c._ctnt = c._ctnt || c.tmpl(a, c);
            c.key = ++i;
            (l.length ? f : b)[i] = c
        }
        return c
    }
    a.each({
        appendTo: "append",
        prependTo: "prepend",
        insertBefore: "before",
        insertAfter: "after",
        replaceAll: "replaceWith"
    }, function (f, d) {
        a.fn[f] = function (n) {
            var g = [],
                i = a(n),
                k, h, m, l, j = this.length === 1 && this[0].parentNode;
            e = b || {};
            if (j && j.nodeType === 11 && j.childNodes.length === 1 && i.length === 1) {
                i[d](this[0]);
                g = this
            } else {
                for (h = 0, m = i.length; h < m; h++) {
                    c = h;
                    k = (h > 0 ? this.clone(true) : this).get();
                    a(i[h])[d](k);
                    g = g.concat(k)
                }
                c = 0;
                g = this.pushStack(g, f, i.selector)
            }
            l = e;
            e = null;
            a.tmpl.complete(l);
            return g
        }
    });
    a.fn.extend({
        tmpl: function (d, c, b) {
            return a.tmpl(this[0], d, c, b)
        },
        tmplItem: function () {
            return a.tmplItem(this[0])
        },
        template: function (b) {
            return a.template(b, this[0])
        },
        domManip: function (d, m, k) {
            if (d[0] && a.isArray(d[0])) {
                var g = a.makeArray(arguments),
                    h = d[0],
                    j = h.length,
                    i = 0,
                    f;
                while (i < j && !(f = a.data(h[i++], "tmplItem")));
                if (f && c) g[2] = function (b) {
                    a.tmpl.afterManip(this, b, k)
                };
                r.apply(this, g)
            } else r.apply(this, arguments);
            c = 0;
            !e && a.tmpl.complete(b);
            return this
        }
    });
    a.extend({
        tmpl: function (d, h, e, c) {
            var i, k = !c;
            if (k) {
                c = p;
                d = a.template[d] || a.template(null, d);
                f = {}
            } else if (!d) {
                d = c.tmpl;
                b[c.key] = c;
                c.nodes = [];
                c.wrapped && n(c, c.wrapped);
                return a(j(c, null, c.tmpl(a, c)))
            }
            if (!d) return [];
            if (typeof h === "function") h = h.call(c || {});
            e && e.wrapped && n(e, e.wrapped);
            i = a.isArray(h) ? a.map(h, function (a) {
                return a ? g(e, c, d, a) : null
            }) : [g(e, c, d, h)];
            return k ? a(j(c, null, i)) : i
        },
        tmplItem: function (b) {
            var c;
            if (b instanceof a) b = b[0];
            while (b && b.nodeType === 1 && !(c = a.data(b, "tmplItem")) && (b = b.parentNode));
            return c || p
        },
        template: function (c, b) {
            if (b) {
                if (typeof b === "string") b = o(b);
                else if (b instanceof a) b = b[0] || {};
                if (b.nodeType) b = a.data(b, "tmpl") || a.data(b, "tmpl", o(b.innerHTML));
                return typeof c === "string" ? (a.template[c] = b) : b
            }
            return c ? typeof c !== "string" ? a.template(null, c) : a.template[c] || a.template(null, q.test(c) ? c : a(c)) : null
        },
        encode: function (a) {
            return ("" + a).split("<").join("&lt;").split(">").join("&gt;").split('"').join("&#34;").split("'").join("&#39;")
        }
    });
    a.extend(a.tmpl, {
        tag: {
            tmpl: {
                _default: {
                    $2: "null"
                },
                open: "if($notnull_1){__=__.concat($item.nest($1,$2));}"
            },
            wrap: {
                _default: {
                    $2: "null"
                },
                open: "$item.calls(__,$1,$2);__=[];",
                close: "call=$item.calls();__=call._.concat($item.wrap(call,__));"
            },
            each: {
                _default: {
                    $2: "$index, $value"
                },
                open: "if($notnull_1){$.each($1a,function($2){with(this){",
                close: "}});}"
            },
            "if": {
                open: "if(($notnull_1) && $1a){",
                close: "}"
            },
            "else": {
                _default: {
                    $1: "true"
                },
                open: "}else if(($notnull_1) && $1a){"
            },
            html: {
                open: "if($notnull_1){__.push($1a);}"
            },
            "=": {
                _default: {
                    $1: "$data"
                },
                open: "if($notnull_1){__.push($.encode($1a));}"
            },
            "!": {
                open: ""
            }
        },
        complete: function () {
            b = {}
        },
        afterManip: function (f, b, d) {
            var e = b.nodeType === 11 ? a.makeArray(b.childNodes) : b.nodeType === 1 ? [b] : [];
            d.call(f, b);
            m(e);
            c++
        }
    });

    function j(e, g, f) {
        var b, c = f ? a.map(f, function (a) {
            return typeof a === "string" ? e.key ? a.replace(/(<\w+)(?=[\s>])(?![^>]*_tmplitem)([^>]*)/g, "$1 " + d + '="' + e.key + '" $2') : a : j(a, e, a._ctnt)
        }) : e;
        if (g) return c;
        c = c.join("");
        c.replace(/^\s*([^<\s][^<]*)?(<[\w\W]+>)([^>]*[^>\s])?\s*$/, function (f, c, e, d) {
            b = a(e).get();
            m(b);
            if (c) b = k(c).concat(b);
            if (d) b = b.concat(k(d))
        });
        return b ? b : k(c)
    }
    function k(c) {
        var b = document.createElement("div");
        b.innerHTML = c;
        return a.makeArray(b.childNodes)
    }
    function o(b) {
        return new Function("jQuery", "$item", "var $=jQuery,call,__=[],$data=$item.data;with($data){__.push('" + a.trim(b).replace(/([\\'])/g, "\\$1").replace(/[\r\t\n]/g, " ").replace(/\$\{([^\}]*)\}/g, "{{= $1}}").replace(/\{\{(\/?)(\w+|.)(?:\(((?:[^\}]|\}(?!\}))*?)?\))?(?:\s+(.*?)?)?(\(((?:[^\}]|\}(?!\}))*?)\))?\s*\}\}/g, function (m, l, k, g, b, c, d) {
            var j = a.tmpl.tag[k],
                i, e, f;
            if (!j) throw "Unknown template tag: " + k;
            i = j._default || [];
            if (c && !/\w$/.test(b)) {
                b += c;
                c = ""
            }
            if (b) {
                b = h(b);
                d = d ? "," + h(d) + ")" : c ? ")" : "";
                e = c ? b.indexOf(".") > -1 ? b + h(c) : "(" + b + ").call($item" + d : b;
                f = c ? e : "(typeof(" + b + ")==='function'?(" + b + ").call($item):(" + b + "))"
            } else f = e = i.$1 || "null";
            g = h(g);
            return "');" + j[l ? "close" : "open"].split("$notnull_1").join(b ? "typeof(" + b + ")!=='undefined' && (" + b + ")!=null" : "true").split("$1a").join(f).split("$1").join(e).split("$2").join(g || i.$2 || "") + "__.push('"
        }) + "');}return __;")
    }
    function n(c, b) {
        c._wrap = j(c, true, a.isArray(b) ? b : [q.test(b) ? b : a(b).html()]).join("")
    }
    function h(a) {
        return a ? a.replace(/\\'/g, "'").replace(/\\\\/g, "\\") : null
    }
    function s(b) {
        var a = document.createElement("div");
        a.appendChild(b.cloneNode(true));
        return a.innerHTML
    }
    function m(o) {
        var n = "_" + c,
            k, j, l = {},
            e, p, h;
        for (e = 0, p = o.length; e < p; e++) {
            if ((k = o[e]).nodeType !== 1) continue;
            j = k.getElementsByTagName("*");
            for (h = j.length - 1; h >= 0; h--) m(j[h]);
            m(k)
        }
        function m(j) {
            var p, h = j,
                k, e, m;
            if (m = j.getAttribute(d)) {
                while (h.parentNode && (h = h.parentNode).nodeType === 1 && !(p = h.getAttribute(d)));
                if (p !== m) {
                    h = h.parentNode ? h.nodeType === 11 ? 0 : h.getAttribute(d) || 0 : 0;
                    if (!(e = b[m])) {
                        e = f[m];
                        e = g(e, b[h] || f[h]);
                        e.key = ++i;
                        b[i] = e
                    }
                    c && o(m)
                }
                j.removeAttribute(d)
            } else if (c && (e = a.data(j, "tmplItem"))) {
                o(e.key);
                b[e.key] = e;
                h = a.data(j.parentNode, "tmplItem");
                h = h ? h.key : 0
            }
            if (e) {
                k = e;
                while (k && k.key != h) {
                    k.nodes.push(j);
                    k = k.parent
                }
                delete e._ctnt;
                delete e._wrap;
                a.data(j, "tmplItem", e)
            }
            function o(a) {
                a = a + n;
                e = l[a] = l[a] || g(e, b[e.parent.key + n] || e.parent)
            }
        }
    }
    function u(a, d, c, b) {
        if (!a) return l.pop();
        l.push({
            _: a,
            tmpl: d,
            item: this,
            data: c,
            options: b
        })
    }
    function w(d, c, b) {
        return a.tmpl(a.template(d), c, b, this)
    }
    function x(b, d) {
        var c = b.options || {};
        c.wrapped = d;
        return a.tmpl(a.template(b.tmpl), b.data, c, b.item)
    }
    function v(d, c) {
        var b = this._wrap;
        return a.map(a(a.isArray(b) ? b.join("") : b).filter(d || "*"), function (a) {
            return c ? a.innerText || a.textContent : a.outerHTML || s(a)
        })
    }
    function t() {
        var b = this.nodes;
        a.tmpl(null, null, null, this).insertBefore(b[0]);
        a(b).remove()
    }
})(jQuery);
(function ($) {
    $.alerts = {
        verticalOffset: -75,
        horizontalOffset: 0,
        repositionOnResize: true,
        overlayOpacity: .08,
        overlayColor: '#000',
        draggable: true,
        okButton: '&nbsp;Aceptar&nbsp;',
        cancelButton: '&nbsp;Cancelar&nbsp;',
        dialogClass: null,
        alert: function (message, title, callback) {
            if (title == null) title = 'Alert';
            $.alerts._show(title, message, null, 'alert', function (result) {
                if (callback) callback(result)
            })
        },
        alertInfo: function (message, title, callback) {
            if (title == null) title = 'Alert';
            $.alerts._show(title, message, null, 'alertInfo', function (result) {
                if (callback) callback(result)
            })
        },
        confirm: function (message, title, callback) {
            if (title == null) title = 'Confirm';
            $.alerts._show(title, message, null, 'confirm', function (result) {
                if (callback) callback(result)
            })
        },
        prompt: function (message, value, title, callback) {
            if (title == null) title = 'Prompt';
            $.alerts._show(title, message, value, 'prompt', function (result) {
                if (callback) callback(result)
            })
        },
        _show: function (title, msg, value, type, callback) {
            $.alerts._hide();
            $.alerts._overlay('show');
            $("BODY").append('<div id="popup_container">' + '<h1 id="popup_title"></h1>' + '<div id="popup_content">' + '<div class="imagen"></div><div id="popup_message"></div>' + '</div>' + '</div>');
            if ($.alerts.dialogClass) $("#popup_container").addClass($.alerts.dialogClass);
            var pos = ($.browser.msie && parseInt($.browser.version) <= 6) ? 'absolute' : 'fixed';
            $("#popup_container").css({
                position: pos,
                zIndex: 99999,
                padding: 0,
                margin: 0
            });
            $("#popup_title").text(title);
            $("#popup_content").addClass(type);
            $("#popup_message").text(msg);
            $("#popup_message").html($("#popup_message").text().replace(/\n/g, '<br />'));
            $("#popup_container").css({
                minWidth: $("#popup_container").outerWidth(),
                maxWidth: $("#popup_container").outerWidth()
            });
            //-----------------------------------------------------------------------------------
            $.alerts._reposition();
            $.alerts._maintainPosition(true);
            switch (type) {
                case 'alert':
                    $("#popup_message").after('<div id="popup_panel"><button type="button" class="popup_boton" id="popup_ok">' + $.alerts.okButton + '</button></div>');
                    $("#popup_ok").click(function () {
                        $.alerts._hide();
                        callback(true)
                    });
                    $("#popup_ok").focus().keypress(function (e) {
                        if (e.keyCode == 13 || e.keyCode == 27) $("#popup_ok").trigger('click')
                    });
                    break;
                case 'alertInfo':
                    $("#popup_message").after('<div id="popup_panel"><button type="button" class="popup_boton" id="popup_ok">' + $.alerts.okButton + '</button></div>');
                    $("#popup_ok").click(function () {
                        $.alerts._hide();
                        callback(true)
                    });
                    $("#popup_ok").focus().keypress(function (e) {
                        if (e.keyCode == 13 || e.keyCode == 27) $("#popup_ok").trigger('click')
                    });
                    break;
                case 'confirm':
                    $("#popup_message").after('<div id="popup_panel"><button type="button" class="popup_boton" id="popup_ok">' + $.alerts.okButton + '</button> <button type="button" class="popup_boton" id="popup_cancel">' + $.alerts.cancelButton + '</button></div>');
                    $("#popup_ok").click(function () {
                        $.alerts._hide();
                        if (callback) callback(true)
                    });
                    $("#popup_cancel").click(function () {
                        $.alerts._hide();
                        if (callback) callback(false)
                    });
                    $("#popup_ok").focus();
                    $("#popup_ok, #popup_cancel").keypress(function (e) {
                        if (e.keyCode == 13) $("#popup_ok").trigger('click');
                        if (e.keyCode == 27) $("#popup_cancel").trigger('click')
                    });
                    break;
                case 'prompt':
                    $("#popup_message").append('<br /><input class="popup_boton" type="text" size="30" id="popup_prompt" />').after('<div id="popup_panel"><input class="popup_boton" type="button" value="' + $.alerts.okButton + '" id="popup_ok" /> <input class="popup_boton" type="button" value="' + $.alerts.cancelButton + '" id="popup_cancel" /></div>');
                    $("#popup_prompt").width($("#popup_message").width());
                    $("#popup_ok").click(function () {
                        var val = $("#popup_prompt").val();
                        $.alerts._hide();
                        if (callback) callback(val)
                    });
                    $("#popup_cancel").click(function () {
                        $.alerts._hide();
                        if (callback) callback(null)
                    });
                    $("#popup_prompt, #popup_ok, #popup_cancel").keypress(function (e) {
                        if (e.keyCode == 13) $("#popup_ok").trigger('click');
                        if (e.keyCode == 27) $("#popup_cancel").trigger('click')
                    });
                    if (value) $("#popup_prompt").val(value);
                    $("#popup_prompt").focus().select();
                    break
            }
            if ($.alerts.draggable) {
                try {
                    $("#popup_container").draggable({
                        handle: $("#popup_title")
                    });
                    $("#popup_title").css({
                        cursor: 'move'
                    })
                } catch (e) { }
            }
        },
        _hide: function () {
            $("#popup_container").remove();
            $.alerts._overlay('hide');
            $.alerts._maintainPosition(false)
        },
        _overlay: function (status) {
            switch (status) {
                case 'show':
                    $.alerts._overlay('hide');
                    $("BODY").append('<div id="popup_overlay"></div>');
                    $("#popup_overlay").css({
                        position: 'absolute',
                        zIndex: 99998,
                        top: '0px',
                        left: '0px',
                        width: '100%',
                        height: $(document).height(),
                        background: $.alerts.overlayColor,
                        opacity: $.alerts.overlayOpacity
                    });
                    break;
                case 'hide':
                    $("#popup_overlay").remove();
                    break
            }
        },
        _reposition: function () {
            var top = (($(window).height() / 2) - ($("#popup_container").outerHeight() / 2)) + $.alerts.verticalOffset;
            var left = (($(window).width() / 2) - ($("#popup_container").outerWidth() / 2)) + $.alerts.horizontalOffset;
            if (top < 0) top = 0;
            if (left < 0) left = 0;
            if ($.browser.msie && parseInt($.browser.version) <= 6) top = top + $(window).scrollTop();
            $("#popup_container").css({
                top: top + 'px',
                left: left + 'px'
            });
            $("#popup_overlay").height($(document).height())
        },
        _maintainPosition: function (status) {
            if ($.alerts.repositionOnResize) {
                switch (status) {
                    case true:
                        $(window).bind('resize', $.alerts._reposition);
                        break;
                    case false:
                        $(window).unbind('resize', $.alerts._reposition);
                        break
                }
            }
        }
    };
    jAlert = function (message, title, callback) {
        $.alerts.alert('Ha ocurrido un error. Por favor comuníquese con el administrador del sistema.', 'SITP - Error', callback)
    };
    jAlertInfo = function (message, title, callback) {
        $.alerts.alertInfo(message, title, callback)
    };
    jConfirm = function (message, title, callback) {
        $.alerts.confirm(message, title, callback)
    };
    jPrompt = function (message, value, title, callback) {
        $.alerts.prompt(message, value, title, callback)
    }
})(jQuery);
eval(function (p, a, c, k, e, d) {
    e = function (c) {
        return (c < a ? "" : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
    };
    if (!''.replace(/^/, String)) {
        while (c--) {
            d[e(c)] = k[c] || e(c)
        }
        k = [function (e) {
            return d[e]
        } ];
        e = function () {
            return '\\w+'
        };
        c = 1
    };
    while (c--) {
        if (k[c]) {
            p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c])
        }
    }
    return p
} ('(2($){$.c.f=2(p){p=$.d({g:"!@#$%^&*()+=[]\\\\\\\';,/{}|\\":<>?~`.- ",4:"",9:""},p);7 3.b(2(){5(p.G)p.4+="Q";5(p.w)p.4+="n";s=p.9.z(\'\');x(i=0;i<s.y;i++)5(p.g.h(s[i])!=-1)s[i]="\\\\"+s[i];p.9=s.O(\'|\');6 l=N M(p.9,\'E\');6 a=p.g+p.4;a=a.H(l,\'\');$(3).J(2(e){5(!e.r)k=o.q(e.K);L k=o.q(e.r);5(a.h(k)!=-1)e.j();5(e.u&&k==\'v\')e.j()});$(3).B(\'D\',2(){7 F})})};$.c.I=2(p){6 8="n";8+=8.P();p=$.d({4:8},p);7 3.b(2(){$(3).f(p)})};$.c.t=2(p){6 m="A";p=$.d({4:m},p);7 3.b(2(){$(3).f(p)})}})(C);', 53, 53, '||function|this|nchars|if|var|return|az|allow|ch|each|fn|extend||alphanumeric|ichars|indexOf||preventDefault||reg|nm|abcdefghijklmnopqrstuvwxyz|String||fromCharCode|charCode||alpha|ctrlKey||allcaps|for|length|split|1234567890|bind|jQuery|contextmenu|gi|false|nocaps|replace|numeric|keypress|which|else|RegExp|new|join|toUpperCase|ABCDEFGHIJKLMNOPQRSTUVWXYZ'.split('|'), 0, {}));
