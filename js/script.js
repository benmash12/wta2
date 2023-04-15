var jp;
$(document).ready(()=>{
	jp = new Jpop(150);
    pre(0);
    $("#loginform").submit((evt)=>{
        var err = [];
        var un = $("#username").val();
        var pw = $("#password").val();
        if(un == "" || pw == ""){
            err.push("All fields are required!");
        }
        if(/[^a-zA-Z0-9\-_]/g.test(un)){
            err.push("Please do not include special characters or spaces in username!");
        }
        if(err.length > 0){
            evt.preventDefault();
            jp.err(err.join("<br><br>"));
        }
        else{
            pre(1);
        }
    });
    $("#addform").submit((evt)=>{
        var err = [];
        var n = $("#pr_name").val();
        var q = $("#pr_quantity").val();
        if(n == "" || q == ""){
            err.push("All fields are required!");
        }
        if(/[^a-zA-Z0-9\-_\s]/g.test(n)){
            err.push("Please do not include special characters name!");
        }
        if(err.length > 0){
            evt.preventDefault();
            jp.err(err.join("<br><br>"));
        }
        else{
            pre(1);
        }
    });
});

function deleteProd(x){
    jp.confirm("Are you sure you want to delete this product?", (res)=>{
        if(res){
            pre(1);
            window.location.href = "delete.php?id="+x;
        }
    });
}

function closeNote(btn){
    $(btn).parent().slideUp(100);
}

/*JPOP BEGIN JS*/
var jp_public={};class Jpop{ct=-1;a;constructor(t){this.ct++,this.a=t}succ(t){var n=this.ct++,i=this.buildSucc(n,t),s=this.a,e=this;$("body").append(i.htm);var a=$("#jp-"+n);a.css("display","block"),$.when(void a.css("display","block")).done((function(){a.children().first().children().first().animate({opacity:"0.2"},s),a.children().first().children().last().animate({top:"20px"},s),jp_public["ct"+n]=function(t,s){i.ts==s&&e.destroyOne(n)}}))}err(t){var n=this.ct++,i=this.buildErr(n,t),s=this.a,e=this;$("body").append(i.htm);var a=$("#jp-"+n);a.css("display","block"),$.when(void a.css("display","block")).done((function(){a.children().first().children().first().animate({opacity:"0.2"},s),a.children().first().children().last().animate({top:"20px"},s),jp_public["ct"+n]=function(t,s){i.ts==s&&e.destroyOne(n)}}))}info(t){var n=this.ct++,i=this.buildInfo(n,t),s=this.a,e=this;$("body").append(i.htm);var a=$("#jp-"+n);a.css("display","block"),$.when(void a.css("display","block")).done((function(){a.children().first().children().first().animate({opacity:"0.2"},s),a.children().first().children().last().animate({top:"20px"},s),jp_public["ct"+n]=function(t,s){i.ts==s&&e.destroyOne(n)}}))}dia(t){var n=this.ct++,i=this.buildDia(n,t),s=this.a,e=this;$("body").append(i.htm);var a=$("#jp-"+n);a.css("display","block"),$.when(void a.css("display","block")).done((function(){a.children().first().children().first().animate({opacity:"0.2"},s),a.children().first().children().last().animate({top:"20px"},s),jp_public["ct"+n]=function(t,s){i.ts==s&&e.destroyOne(n)}}))}confirm(t,n){var i=this.ct++,s=this.buildConfirm(i,t),e=this.a,a=this;$("body").append(s.htm);var c=$("#jp-"+i);c.css("display","block"),$.when(void c.css("display","block")).done((function(){c.children().first().children().first().animate({opacity:"0.2"},e),c.children().first().children().last().animate({top:"20px"},e),jp_public["ct"+i]=function(t,e){s.ts==e&&(a.destroyOne(i),n(t))}}))}destroyOne(t){var n=$("#jp-"+t);$.when(void n.fadeOut(100)).done((function(){n.remove(),delete jp_public["ct"+t]}))}destroyAll(){$(".jp-shade").each((function(){$(this).hide().remove()})),jp_public={}}buildConfirm(t,n){var i=Date.now();return{htm:`\n\t\t\t<div id="jp-${t}"class="jp-shade">\n\t\t\t\t<div class="jp-cont">\n\t\t\t\t\t<div class="jp-back">\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class="jp-pop">\n\t\t\t\t\t\t<div class="jp-body">${n}\n\t\t\t\t\t\t</div>\n\t\t\t\t\t\t<div class="jp-footer">\n\t\t\t\t\t\t\t<button class="succ" onclick="jp_public['ct${t}'](true,${i})" >Yes</button>\n\t\t\t\t\t\t\t<button class="" onclick="jp_public['ct${t}'](false,${i})">No</button>\n\t\t\t\t\t\t</div>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t`,ts:i}}buildSucc(t,n){var i=Date.now();return{htm:`\n\t\t<div id="jp-${t}"class="jp-shade">\n\t\t\t<div class="jp-cont">\n\t\t\t\t<div class="jp-back">\n\t\t\t\t</div>\n\t\t\t\t<div class="jp-pop">\n\t\t\t\t\t<div class="jp-head">SUCCESS\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class="jp-body">${n}\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class="jp-footer">\n\t\t\t\t\t\t<button class="succ" onclick="jp_public['ct${t}'](false,${i})">Ok</button>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t\t`,ts:i}}buildErr(t,n){var i=Date.now();return{htm:`\n\t\t<div id="jp-${t}"class="jp-shade">\n\t\t\t<div class="jp-cont">\n\t\t\t\t<div class="jp-back">\n\t\t\t\t</div>\n\t\t\t\t<div class="jp-pop">\n\t\t\t\t\t<div class="jp-head err">ERROR\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class="jp-body">${n}\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class="jp-footer">\n\t\t\t\t\t\t<button class="err" onclick="jp_public['ct${t}'](false,${i})">Ok</button>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t\t`,ts:i}}buildInfo(t,n){var i=Date.now();return{htm:`\n\t\t<div id="jp-${t}"class="jp-shade">\n\t\t\t<div class="jp-cont">\n\t\t\t\t<div class="jp-back">\n\t\t\t\t</div>\n\t\t\t\t<div class="jp-pop">\n\t\t\t\t\t<div class="jp-body">${n}\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class="jp-footer">\n\t\t\t\t\t\t<button class="info" onclick="jp_public['ct${t}'](false,${i})">Ok</button>\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t\t`,ts:i}}buildDia(t,n){var i=Date.now();return{htm:`\n\t\t<div id="jp-${t}"class="jp-shade">\n\t\t\t<div class="jp-cont">\n\t\t\t\t<div class="jp-back">\n\t\t\t\t</div>\n\t\t\t\t<div class="jp-pop">\n\t\t\t\t\t<div class="jp-head def">${n.title}\n\t\t\t\t\t</div>\n\t\t\t\t\t<div class="jp-bodyx">${n.html}\n\t\t\t\t\t</div>\n\t\t\t\t</div>\n\t\t\t</div>\n\t\t</div>\n\t\t</div>\n\t\t`,ts:i}}prompt(t){var n=this.ct++,i=this.buildPrompt(n,t),s=this.a,e=this;$("body").append(i.htm);var a=$("#jp-"+n);a.css("display","block"),$.when(void a.css("display","block")).done((function(){a.children().first().children().first().animate({opacity:"0.2"},s),a.children().first().children().last().animate({top:"20px"},s),fc(),jp_public["ct"+n]=function(s,a,c){if(i.ts==a)if(1==s){var d=!0,l=$(c).parent().prev().children().first().val(),p=l.length;"textarea"==t.inputType?(t.minLength&&p<t.minLength&&(d=!1),t.maxLength&&p>t.maxLength&&(d=!1),t.required&&0==p&&(d=!1)):"number"==t.inputType?(t.minLength&&p<t.minLength&&(d=!1),t.maxLength&&p>t.maxLength&&(d=!1),t.min&&parseFloat(l)<t.min&&(d=!1),t.max&&parseFloat(l)>t.max&&(d=!1),t.required&&0==p&&(d=!1)):("select"==t.inputType||(t.minLength&&p<t.minLength&&(d=!1),t.maxLength&&p>t.maxLength&&(d=!1)),t.required&&0==p&&(d=!1)),d?(e.destroyOne(n),t.callback({stat:!0,res:l})):t.required?e.err("There is an eror in your input. please follow instructions."):(e.destroyOne(n),t.callback({stat:!1}))}else e.destroyOne(n),t.callback({stat:!1})}}))}buildPrompt(t,n){var i=Date.now(),s=`\n\t\t<div id="jp-${t}"class="jp-shade">\n\t\t\t<div class="jp-cont">\n\t\t\t\t<div class="jp-back">\n\t\t\t\t</div>\n\t\t\t\t<div class="jp-pop">\n\t\t\t\t<div class="jp-head def">${n.title}\n\t\t\t\t`;return n.ins&&(s+=`<span>${n.ins}</span>`),s+='</div>\n\t\t\t\t<div class="jp-bodyz">',"textarea"==n.inputType?(s+="<textarea",n.minLength&&(s+=` minlength="${n.minLength}" `),n.maxLength&&(s+=` maxlength="${n.maxLength}" `),n.eATTR&&(s+=` ${n.eATTR} `),n.required&&(s+=" required"),s+=">",n.value&&(s+=n.value),s+="</textarea>"):"number"==n.inputType?(s+='<input type="number"',n.minLength&&(s+=` minlength="${n.minLength}" `),n.maxLength&&(s+=` maxlength="${n.maxLength}" `),n.min&&(s+=` min="${n.min}" `),n.max&&(s+=` max="${n.max}" `),n.value&&(s+=` value="${n.value}" `),n.eATTR&&(s+=` ${n.eATTR} `),n.required&&(s+=" required"),s+="/>"):"select"==n.inputType&&n.opts.length>0?(s+="<select>",n.opts.forEach((function(t){s+=`<option value="${t.v}" `,t.s&&(s+="selected"),s+=`>${t.d}</option>`})),s+="</select>"):(s+=`<input type="${n.inputType}"`,n.minLength&&(s+=` minlength="${n.minLength}" `),n.maxLength&&(s+=` maxlength="${n.maxLength}" `),n.value&&(s+=` value="${n.value}" `),n.eATTR&&(s+=` ${n.eATTR} `),n.required&&(s+=" required"),s+="/>"),s+='</div>\n\t\t<div class="jp-footer">',n.cancel&&(s+=`<button onclick="jp_public['ct${t}'](false,${i},this)">Cancel</button>`),{htm:s+=`<button class="succ" onclick="jp_public['ct${t}'](true,${i},this)">Submit</button>\n\t\t</div>\n\t\t</div>\n\t\t</div>\n\t\t</div>\n\t\t`,ts:i}}}
/*JPOP END JS*/

function forgotPass(){
    jp.info("This feature is not applicable to this assignment.");
}

function pre(i){
    if(i == 0){
        $("#preloader").addClass("out");
    }
    else{
        $("#preloader").removeClass("out");
    }
}

function login(){
    
    
    return false;
}