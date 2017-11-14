/**
 * 通用对象方法
 * eg...
 * 1.WW.alert('xx') 弹框
 * 2.WW.post('xx.do',{},function(){}) 统一post提交
 * 3.WW('#formId').validate() 统一验证 返回true/false
 * @return {}
 */
var MW = function(seletor){
	if(this === window){
		return new MW(seletor);
	}
	this.seletor = seletor;
	return this.init();
};

//原型方法
$.extend(MW.prototype,{
	init:function(){
		this.$zp = (this.seletor instanceof Zepto) ? this.seletor : $(this.seletor);
		this.isForm = this.$zp.is('form');
		return this;
	},
	validate:function(){
		if(!this.isForm) return false;
		var rval = true;
		this.$zp.find('input,select,textarea').each(function(){
			var $el = $(this);
			var error = $el.attr('error');
			var reg = $el.attr('reg');
			var equal = $el.attr('equal');
			var val = $.trim(this.value);
			if($el.attr('required') && val.length == 0){
				rval = false;
				MW.alert(error);
				return false;
			}
			if(equal && val != $.trim($(equal).val())){
				rval = false;
				MW.alert(error);
				return false;
			}
			if(reg && val.test(reg)){
				rval = false;
				MW.alert(error);
				return false;
			}
		});
		return rval;
	}
});
//静态方法
$.extend(MW,{
	platform:6,
	alert:function(msg){
		alert(msg);
	},
	isCardNo:function(card){
		return  /(^\d{15}$)|(^\d{18}$)|(^\d{17}(\d|X|x)$)/.test(card);
	},
	getBornYear:function(idCard){
		var birthday = '';
		if(!idCard) return '';
		if(idCard.length == 15){
			birthday = '19'+idCard.substr(6,6);
		} else if(idCard.length == 18){
			birthday = idCard.substr(6,8);
		}
		return birthday.replace(/(.{4})(.{2})/,'$1-$2-');
	},
	getSex:function(card){
		return parseInt(card.substr(16, 1)) % 2;
	},
	toast:function(msg){
		var $tips = $('#toast_tips');
		if(!$tips[0]){
			$tips = $('<div class="outMsg fz-m" id="toast_tips" style="display:none"></div>');
			$('body').append($tips);
		}
		$tips.html(msg).fadeIn(200);;
		var hidefunc = $tips[0].hidefunc;
		if(hidefunc){
			clearTimeout(hidefunc);
		}
		$tips[0].hidefunc = setTimeout(function(){
			$tips.fadeOut(200);
		},2000);
	},
	post:function(url,params,callback){
		try{
			$(".gzwy-loading").show();
		}catch(e){}
		if(typeof params === 'string'){
			params += '&platform='+MW.platform+'&pagesize=2000';
		}else{
			params.platform = MW.platform;
			params.pagesize = 2000;
		}
		$.post(url,params,function(result){
			try{
				$(".gzwy-loading").hide();
			}catch(e){}
			if(result.breturn){
				callback && callback.call(MW,result.ireturn,result.obj||{});
			}else{
				MW.alert(result.errorinfo);
			}
		},'json');
	},
	getCookie:function(name){
	    var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
	    if(arr=document.cookie.match(reg))
	        return unescape(arr[2]).replace(/\"/g,"");
	    else
	        return '';
	},
	init:function(){
		//这里作为适配以及插件初始化
		//Zepto 方法扩展
		$.extend($.fn,{
			validate:function(){
				return MW(this).validate();
			}
		});
		//faskclick
		$(function(){
			FastClick.attach(document.body);
			//模板
			$.fn.tpl = function(data,func,empty){
				if($.isArray(data) && !data[0]){
					return '<div class="emptyTip">'+(empty||'抱歉，没有相关信息！')+'</div>';
				}
			    $.template('template', $(this).html().replace(/@/g,"$"));
			    return $.tmpl('template',data,func);
			}
		});
	}
});

//执行初始化
(function(){
	MW.init();
})();

Date.prototype.format = function (format) {
    var o = {
        "M+": this.getMonth() + 1, //month
        "d+": this.getDate(), //day
        "h+": this.getHours(), //hour
        "m+": this.getMinutes(), //minute
        "s+": this.getSeconds(), //second
        "q+": Math.floor((this.getMonth() + 3) / 3), //quarter
        "S": this.getMilliseconds() //millisecond
    }
    if (/(y+)/.test(format))
        format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length));
    for (var k in o)
        if (new RegExp("(" + k + ")").test(format))
            format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length));
    return format;
}

/**
 * approx distance between two points on earth ellipsoid
 * @param {Object} lat1
 * @param {Object} lng1
 * @param {Object} lat2
 * @param {Object} lng2
 */
function getRad(d){
    return d*Math.PI/180.0;
}
function getFlatternDistance(lat1,lng1,lat2,lng2){
	lat1 = + lat1;
	lng1 = + lng1;
	lat2 = + lat2;
	lng2 = + lng2;
    var f = getRad((lat1 + lat2)/2);
    var g = getRad((lat1 - lat2)/2);
    var l = getRad((lng1 - lng2)/2);
    
    var sg = Math.sin(g);
    var sl = Math.sin(l);
    var sf = Math.sin(f);
    
    var s,c,w,r,d,h1,h2;
    var a = 6378137.0;
    var fl = 1/298.257;
    
    sg = sg*sg;
    sl = sl*sl;
    sf = sf*sf;
    
    s = sg*(1-sl) + (1-sf)*sl;
    c = (1-sg)*(1-sl) + sf*sl;
    
    w = Math.atan(Math.sqrt(s/c));
    r = Math.sqrt(s*c)/w;
    d = 2*w*a;
    h1 = (3*r -1)/2/c;
    h2 = (3*r +1)/2/s;
    
    return d*(1 + fl*(h1*sf*(1-sg) - h2*(1-sf)*sg));
}