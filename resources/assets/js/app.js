window.$ = window.jQuery = require('jquery');
require('bootstrap-sass');

/**
 * @preserve jQuery flipcountdown plugin v3.0.5
 * @homepage http://xdsoft.net/jqplugins/flipcountdown/
 * (c) 2013, Chupurnov Valeriy.
 */
 /******************计时器插件******************/
(function($){
jQuery.fn.flipCountDown = jQuery.fn.flipcountdown = function( _options ){
	var default_options = {
			showHour	:true,
			showMinute	:true,
			showSecond	:true,
			am			:false,

			tzoneOffset	:0,
			speedFlip	:60,
			period		:1000,
			tick		:function(){
							return new Date();
						},
			autoUpdate	:true,
			size		:'md',

			beforeDateTime:false,

			prettyPrint :function( chars ){
				return (chars instanceof Array)?chars.join(' '):chars;
			}
		},

		digitsCount = 66,

		sizes = {
			lg:77,
			md:52,
			sm:35,
			xs:24
		},

		createFlipCountDown = function( $box ){
			var $flipcountdown 	= $('<div class="xdsoft_flipcountdown"></div>'),
				$clearex 		= $('<div class="xdsoft_clearex"></div>'),

				options = $.extend({},default_options),

				timer = 0,

				_animateRange = function( box,a,b ){
					if( !isNaN(a) ){
						_animateOne( box,a,((a>b && !(a==9&&b==0) )||(a==0&&b==9))?-1:1,!((a==9&&b==0)||(a==0&&b==9))?Math.abs(a-b):1 );
					}else{
						box.css('background-position','0px -'+((b+1)*6*sizes[options.size]+1)+'px' );
					}
				},

				_animateOne = function( box,a,arrow,range ){
					if( range<1 )
						return;

					_setMargin(box,-((a+1)*6*sizes[options.size]+1),1,arrow,function(){
						_animateOne(box,a+arrow,arrow,range-1);
					},range);
				},

				_setMargin = function( box, marginTop, rec, arrow,callback,range){
					if( marginTop<=-sizes[options.size]*digitsCount )
						marginTop = -(6*sizes[options.size]+1);
					box.css('background-position','0px '+marginTop+'px' );
					if( rec<=6 ){
						setTimeout(function(){
							_setMargin(box, marginTop-arrow*sizes[options.size], ++rec, arrow, callback,range);
						},parseInt(options.speedFlip/range));
					}else
						callback();
				},

				blocks = [],

				_typeCompare	= 	function ( a,b ){
					return 	a&&b&&(
								(a==b)||
								(/^[0-9]+$/.test(a+''+b))||
								(/^[:.\s]+$/.test(a+''+b))
							);
				},

				_generate = function( chars ){
					if( !(chars instanceof Array) || !chars.length )
						return false;
					for( var i = 0, n = chars.length;i<n;i++ ){
						if( !blocks[i] ){
							blocks[i] = $('<div class="xdsoft_digit"></div>');
							$clearex.before(blocks[i]);
						}
						if( blocks[i].data('value')!=chars[i] ){
							if( !_typeCompare(blocks[i].data('value'),chars[i]) ){
								blocks[i]
									.removeClass('xdsoft_separator')
									.removeClass('xdsoft_dot');
								switch( chars[i] ){
									case ':':blocks[i].addClass('xdsoft_separator');break;
									case '.':blocks[i].addClass('xdsoft_dot');break;
									case ' ':blocks[i].addClass('xdsoft_space');break;
								}
							}
							if( !isNaN(chars[i]) ){
								var old = parseInt(blocks[i].data('value')),
									ii = parseInt(blocks[i].data('i')),
									crnt = parseInt(chars[i]);
								_animateRange(blocks[i],old,crnt);
							}
							blocks[i].data('value',chars[i]);
							blocks[i].data('i',i);
						}
					}
					if( blocks.length>chars.length ){
						for(;i<blocks.length;i++ ){
							blocks[i][0].parentNode.removeChild(blocks[i][0]);
							delete blocks[i];
						}
						blocks.splice(chars.length);
					}

				},

				counter = 0,

				_calcMoment = function(){
					var value = '1',chars = [];
					if(options.tick)
						value = options.prettyPrint.call($box,(options.tick instanceof Function)?options.tick.call($box,counter):options.tick);

					if( typeof value!=='undefined' ){
						switch( value.constructor ){
							case Date:
								var h = (value.getHours()+options.tzoneOffset)%(options.am?12:24);

								if( options.showHour ){
									chars.push(parseInt(h/10));
									chars.push(h%10);
								}

								if( options.showHour && (options.showMinute || options.showSecond) )
									chars.push(':');

								if( options.showMinute ){
									chars.push(parseInt(value.getMinutes()/10));
									chars.push(value.getMinutes() % 10);
								}

								if( options.showMinute && options.showSecond )
									chars.push(':');

								if( options.showSecond ){
									chars.push(parseInt(value.getSeconds()/10));
									chars.push(value.getSeconds() % 10);
								}
							break;
							case String:
								chars = value.replace(/[^0-9\:\.\s]/g,'').split('');
							break;
							case Number:
								chars = value.toString().split('');
							break;
						}
						_generate(chars);
					}
				};



			$flipcountdown
				.append($clearex)
				.on('xdinit.xdsoft',function(){
					clearInterval(timer);
					if( options.autoUpdate )
						timer = setInterval( _calcMoment,options.period );
					_calcMoment();
				});

			$box.data('setOptions',function( _options ){
				options = $.extend(true,{},options,_options);
				if( !sizes[options.size] )
					options.size = defaulOptions.size;

				if( options.beforeDateTime && !_options.tick ){
					if( typeof(options.beforeDateTime) == 'string' )
						options.beforeDateTime = Math.round((new Date(options.beforeDateTime)).getTime()/1000);
					else{
						if ( Object.prototype.toString.call(options.beforeDateTime) !== "[object Date]" )
							options.beforeDateTime = Math.round((new Date()).getTime()/1000)+365*24*60;
					}
					var nol = function(h){
						return h>9?h:'0'+h;
					}

					options.tick = function(){
						var	range  	=  Math.max(0,options.beforeDateTime-Math.round((new Date()).getTime()/1000)),
							secday = 86400, sechour = 3600,
							days 	= parseInt(range/secday),
							hours	= parseInt((range%secday)/sechour),
							min		= parseInt(((range%secday)%sechour)/60),
							sec		= ((range%secday)%sechour)%60;
						return [nol(days),nol(hours),nol(min),nol(sec)];
					}
				}

				$flipcountdown
					.addClass('xdsoft_size_'+options.size)
					.trigger('xdinit.xdsoft');
			});
			$box.append($flipcountdown);
		};
	return this.each(function(){
		var $box = $(this);
		if( !$box.data('setOptions') ){
			$box.addClass('xdsoft')
			createFlipCountDown($box);
		}
		$box.data('setOptions')&&
			$.isFunction($box.data('setOptions'))&&
				$box.data('setOptions')(_options);
	});
}
})(jQuery);
 /******************计时器插件******************/


/*******************Unity 动画******************/
var u;

/*****************Unity 对象初始化*********************/
function unityInitial()
{
  u = new UnityObject2();
  u.observeProgress(function (progress) {
      var $missingScreen = jQuery(progress.targetEl).find(".missing");
      switch(progress.pluginStatus) {
          case "unsupported":
              showUnsupported();
          break;
          case "broken":
              alert("You will need to restart your browser after installation.");
          break;
          case "missing":
              $missingScreen.find("a").click(function (e) {
                  e.stopPropagation();
                  e.preventDefault();
                  u.installPlugin();
                  return false;
              });
              $missingScreen.show();
          break;
          case "installed":
              $missingScreen.remove();
          break;
          case "first":
          break;
      }
  });

  u.initPlugin(jQuery("#plating-animation")[0], "/unity/UnityPlating.unity3d");
}



/******************WebSocket Initial*********************/
function socketSupport(){
  if(window.WebSocket)
    return true;
  else {
    return false;
  }
}

function socketInitial(){
  var wsUri = "ws://127.0.0.1:8181";

  var websocket = new WebSocket(wsUri);
  websocket.onopen = function(evt) {
        onOpen(evt)
    };
    websocket.onclose = function(evt) {
        onClose(evt)
    };
    websocket.onmessage = function(evt) {
        onMessage(evt)
    };
    websocket.onerror = function(evt) {
        onError(evt)
    };
}

function onOpen(evt) {
    writeToScreen("CONNECTED");
}

function onClose(evt) {
    writeToScreen("DISCONNECTED");
}

function carCommand(name, func, instruction){
  this.obj = name;
  this.func = func;
  this.str = instruction;
}

function autoScroll() {
  var mybox = $(".middle-right");
  var nowPos = mybox[0].scrollTop;
  var maxPos = mybox[0].scrollHeight - mybox.outerHeight();
  if (nowPos < maxPos) {
    mybox[0].scrollTop = maxPos;
  }
}

function onMessage(evt) {
  var patt_num = new RegExp("send to unity");
  var test_result = patt_num.test(evt.data);
  if(test_result){
    var data = JSON.parse(evt.data);
    var command = new carCommand(data.carName, data.methods, data.instruction);
    u.getUnity().SendMessage(command.obj,command.func,command.str);
    writeToScreen(command.obj+" "+command.func+" "+command.str);
    autoScroll();
  }
}

function onError(evt) {
  writeToScreen(evt.data);
}

function writeToScreen(message) {
  $("div.middle-right").append("<p>"+message+"</p>");
}

  /*************************计时器显示部分js*******************************/
function startTimer() {
  var s1 = 0;
  var s2 = 0;
  var m1 = 0;
  var m2 = 0;
  var h1 = 0;
  var h2 = 0;

  $(".time-counter .hidden-div").removeClass("hidden-div");
  $("#sec-show-1").flipcountdown({
    size:'xs',
    tick:function(){
      if(s1 < 10)
        return s1++;
      else{
        s2++;
        s1 = 0;
        return s1++;
      }
    }
  });

  $("#sec-show-2").flipcountdown({
    size:'xs',
    tick:function(){
      if(s2 < 6)
        return s2;
      else{
        s2 = 0;
        m1++;
        return s2;
      }
    }
  });

  $("#min-show-1").flipcountdown({
    size:'xs',
    tick:function(){
      if(m1 < 10)
        return m1;
      else{
        m1 = 0;
        m2++;
        return m1;
      }
    }
  });

  $("#min-show-2").flipcountdown({
    size:'xs',
    tick:function(){
      if(m2 < 6)
        return m2;
      else{
          m2 = 0;
          h1++;
          return m2;
        }
    }
  });

  $("#hour-show-1").flipcountdown({
    size:'xs',
    tick:function(){
      if(h1 < 10)
        return h1;
      else{
        h1 = 0;
        h2++;
        return h1;
      }
    }
  });

  $("#hour-show-2").flipcountdown({
    size:'xs',
    tick:function(){
      return h2;
    }
  });
/*************************计时器显示部分js*******************************/
}



/***************鼠标触发事件*******************/
var pd_name_err = $("#product-name").next();
var pd_name_repeat_err = pd_name_err.next();
var pd_num_err = $("#product-number").next();
var pd_type_err = $("#product-type").next();

function buttonClick(){
  $("#initial-plating").click(function(){
    $(".middle-center #plating-animation div.hidden-div").removeClass("hidden-div").addClass("show-div");
    $(".disabled-first").removeAttr("disabled");
    $(".disabled-first").addClass("active-btn");
    $(this).attr("disabled","disabled");
    $(this).removeClass("active-btn");

    if(socketSupport() && u.getUnity()) {
      socketInitial();
    }
  });


  $("#add-pd-btn").click(function(){
    if($("#plating-animation").hasClass("hidden-div") == false){
        $("#plating-animation").addClass("hidden-div");
    }

    $(".modal-body input").val("");

    if(pd_name_err.css("opacity") == 1) {
      pd_name_err.fadeOut(0);
    }
    if(pd_name_repeat_err.css("opacity") == 1) {
      pd_name_repeat_err.fadeOut(0);
    }
    if(pd_num_err.css("opacity") == 1) {
      pd_num_err.fadeOut(0);
    }
    if(pd_type_err.css("opacity") == 1) {
      pd_type_err.fadeOut(0);
    }

  });

  var show_or_hide_text;
  $("#show-or-hide-emulate").click(function(){
    show_or_hide_text = $(this).children("span:eq(0)").text();
    if(show_or_hide_text == "显示仿真") {
      $(this).children("span:eq(0)").text("隐藏仿真");
      $("#plating-animation").removeClass("hidden-div");
    }
    else if(show_or_hide_text == "隐藏仿真") {
      $(this).children("span:eq(0)").text("显示仿真");
      $("#plating-animation").addClass("hidden-div");
    }
    else{
      ;
    }
  });

  $("#pd-save-btn").click(function(){
    var pd_name = $("#product-name").val();
    var pd_num = $("#product-number").val();
    var pd_type = $("#product-type").val();

    var patt_num = new RegExp("([\x2E]|-|^0)");
    var test_result = patt_num.test(pd_num);


    if(!pd_name) {
      pd_name_err.fadeTo(1500,1);
    }
    if( (!pd_num) || test_result ) {
      pd_num_err.fadeTo(1500,1);
    }
    if(!pd_type) {
      pd_type_err.fadeTo(1500,1);
    }

    var no_repeat = true;
    if($(".middle-left tbody tr").length > 0) {
      $(".middle-left tbody tr").each(function(){
        var added_pd_name = $(this).children("td:eq(1)").text();
        if(added_pd_name == pd_name) {
          no_repeat = false;
          return false;
        }
      });
    }

    if(!no_repeat) {
      pd_name_repeat_err.fadeTo(1500,1);
    }

    if(pd_name && no_repeat && pd_num && (!test_result) && pd_type) {
      var insert_td2 = "<td>"+pd_name+"</td>";
      var pd_no_ = $(".middle-left tbody").children().length + 1;
      var insert_td1 = "<td>"+pd_no_+"</td>";
      var insert_td3 = "<td>尚未进行装货</td>";
      var insert_tr = "<tr>"+insert_td1+insert_td2+insert_td3+"</tr>";
      $(".middle-left tbody").append(insert_tr);
      $("#modal-close-btn").trigger( "click" );
    }
  });

  $("#modal-close-btn, #close-btn").click(function(){
    show_or_hide_text = $("#show-or-hide-emulate").children("span:eq(0)").text();
    if(show_or_hide_text == "隐藏仿真") {
      setTimeout(function(){$("#plating-animation").removeClass("hidden-div");},400);

    }
  });

  $("#myModal").click(function(e){
    var modal_dialog = document.getElementsByClassName("modal-dialog")[0];
    var dialog_x1 = modal_dialog.offsetLeft;
    var dialog_x2 = dialog_x1 + modal_dialog.offsetWidth;
    var dialog_y1 = modal_dialog.offsetTop;
    var dialog_y2 = dialog_y1 + modal_dialog.offsetHeight;

    if(e.clientX < dialog_x1 || e.clientX > dialog_x2 || e.clientY < dialog_y1 || e.clientY > dialog_y2) {
      show_or_hide_text = $("#show-or-hide-emulate").children("span:eq(0)").text();
      if(show_or_hide_text == "隐藏仿真") {
        setTimeout(function(){$("#plating-animation").removeClass("hidden-div");},400);
      }
    }
  });

  $("#product-number").click(function(){
    if(pd_num_err.css("opacity") == 1) {
          pd_num_err.fadeOut(1500);
    }
  });



  $("#start-plating").click(function(){
    $(this).attr("disabled", "disabled");
    $(this).removeClass("active-btn");
  //  $("#plating-animation  div.hidden-div").removeClass("hidden-div");
    startTimer();
  });
}


/***********************按键触发事件******************************/
function keyDown(){
  $("#product-name").keydown(function(){
    if(pd_name_err.css("opacity") == 1 ) {
          pd_name_err.fadeOut(1500);
    }
    if(pd_name_repeat_err.css("opacity") == 1 ) {
          pd_name_repeat_err.fadeOut(1500);
    }
  });

  $("#product-number").keydown(function(){
    if(pd_num_err.css("opacity") == 1) {
          pd_num_err.fadeOut(1500);
    }
  });

  $("#product-type").keydown(function(){
    if(pd_type_err.css("opacity") == 1) {
        pd_type_err.fadeOut(1500);
    }
  });
}

/************************消息闪现隐藏***********************/
function fadeMessageOut()
{
    if($("div.flash-message").length > 0) {
      $("div.flash-message").fadeOut(8800);
    }
}


$(document).ready(function() {

  fadeMessageOut();
  unityInitial();
  buttonClick();
  keyDown();

});
