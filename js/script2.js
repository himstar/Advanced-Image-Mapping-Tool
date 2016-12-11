$(document).ready(function(){
	
	// Preloading Images
	$.preloadImages = function() {
		for(var i = 0; i<arguments.length; i++) {
			$('<img>').attr('src', arguments[i]);
		}
	}
	$.preloadImages('images/logo_active.png');
	
	
	// Set Content Width exactly same with Navi Width
	var width = $('#navi ul').width() - $('#navi ul a').css('margin-left').split('px')[0] - $('#navi ul a').css('margin-right').split('px')[0];
	$('.infobox').width(width + 'px');
	
	// Top Navigation
	$('#navi a, a[rel^="#"]').click(function(e) {
		var current = $('#navi').attr('currentValue');
		var rel = $(this).attr('rel');
		$('#navi').attr('currentValue', rel);
		//if($(this).css('display') != 'block')
		$(current).slideUp(400, function() {
			$(rel).slideDown(400, function() {
				resizeHtml();
				if(rel == '#imagemap4posis')
					$('#dots').show();
			});
			resizeHtml();
		});
		if(current == '#imagemap4posis')
			$('#dots').hide();
		e.preventDefault();
	});
	
	
	resizeUploadContainer();
	
	// set a coordinate point
	$('#mapContainer').click(function(e) {
		setCoordinates(e, 1);
		e.preventDefault();
	});
	
	// ...
	$('#newUpload span, .textareaButton3').click(function(e) {
		$('#dots').hide();
		$('#navi').attr('currentValue', '#upload');

        // scroll window top
        $('html, body').animate({ scrollTop: 0 }, 200);

        // change view
		$('#imagemap4posis').slideUp(400, function() {
			$('#upload').slideDown(400, function() {
				resizeHtml();
			});
		});
	});
	
	// ...
	$('#urlMessage a').click(function(e) {
		$('#dots').empty();
		$('#imagemap4posis #mapContainer').find('img').attr('src', '#');
		$('#navi').attr('currentValue', '#upload');
		$('#imagemap4posis').slideUp(400, function() {
			$('#upload').slideDown(400, function() {
				resizeHtml();
			});
			removeErrorMessage();
		});
		e.preventDefault();
	});
	
	// ...
	$('#uploadUndo, #uploadUndo2').click(function(e) {
		$('#upload').slideUp(400, function() {
			if($('#imagemap4posis #mapContainer').find('img').attr('src') == '#') {
				$('#upload').slideDown(400);
				$('#navi').attr('currentValue', '#upload');
			} else {
				$('#navi').attr('currentValue', '#imagemap4posis');
				$('#imagemap4posis').slideDown(400, function() {
					resizeHtml();
					$('#dots').show();
				});
			}
		});
	});
	
	// insert image path via url
	$('#linkform').submit(function(e) {
		enterImagelinkForm();
		e.preventDefault();
	});
	$('.imageurl_submit').click(function(e) {
		enterImagelinkForm();
		e.preventDefault();
	});
	
	// ...
	$('#imageurl').focusout(function() {
		var val = $('#imageurl').val().trim();
		if(val !=  '')
			$(this).addClass('active');
		else
			$(this).removeClass('active');
	});
	
	// Imagemap Generator Buttons
	$('.clearButton').click(function() {
		$('#coordsText').val('');
	});

	// ...
	$('.clearCurrentButton').click(function() {
		$('#coordsText').val('');
		$('#mapContainer').find('area:last').remove();
		hightlight();
		
		// update textarea
		
		var textareaVal = $('#areaText').val();
		var tmpArr = textareaVal.split('<area');
		var lastCoords = tmpArr[tmpArr.length - 1].split('/>')[0];
		textarea = textareaVal.replace('<area' + lastCoords+'/>\n    ', '');
		$('#areaText').val(textarea);
	});

	// ...
	$('.clearAllButton').click(function() {
		$('#coordsText').val('');
		$('#areaText').val('');
		$('#mapContainer').find('map').empty();
		$('#dots').empty();
		hightlight();
		textarea = "";
	});
	
	var timeoutIdShow = 0
	var timeoutIdHide = 0
	
	$('#info').mouseover(function() {
		clearTimeout(timeoutIdHide);
		timeoutIdShow = setTimeout(function() {
			$('#infotext').stop(true, true).show(200);
			$('#info').stop(true, true).animate({opacity: 1}, 200);
		}, 200);
	});
	$('#infotext').mouseover(function() {
		clearTimeout(timeoutIdHide);
	});
	$('#infotext').mouseleave(function() {
		clearTimeout(timeoutIdShow);
		timeoutIdHide = setTimeout(function() {
			$('#infotext').stop(true, true).hide(200);
			$('#info').stop(true, true).animate({opacity: 0.5}, 200);
		}, 200);
	});
	
	// donate close-button fadeIn & fadeOut
	var timeoutIdHideBtn = 0
	$('#feedbackPopup').mouseover(function() {
		clearTimeout(timeoutIdHideBtn);
		$('#feedbackPopup a').show();
	});
	$('#feedbackPopup').mouseout(function() {
		timeoutIdHideBtn = setTimeout(function() {
			$('#feedbackPopup a').hide();
		}, 100);
	});
	$('#feedbackPopup a').mouseover(function() {
		clearTimeout(timeoutIdHideBtn);
	});
	$('#feedbackPopup a').mouseout(function() {
		clearTimeout(timeoutIdHideBtn);
	});
});

$(window).resize(function() {
	resizeUploadContainer();
});

var counter = 1;
var coordsLength = 0;
var textarea = '';
function setCoordinates(e, status) {
	var x = e.pageX;
	var y = e.pageY;

	$('#dots').append('<img class="dot" src="./img/dot.png" style="left: '+ (x-1) +'px; top: '+ (y-1) +'px;" />');

	var offset = $('#imagemap4posis img').offset();
	x -= parseInt(offset.left);
	y -= parseInt(offset.top);
	if(x < 0) { x = 0; }
	if(y < 0) { y = 0; }
	
	var value = $('#coordsText').val();
	if(value == '') {
		value = x+','+y;
		coordsLength = value.length;
		counter++;
	} else {
		value = value+','+x+','+y;
		coordsLength = value.length;
	}
	if(status)
		$('#coordsText').val(value);
	
	if($('#area'+counter).length != 0)
		$('#area'+counter).remove();
	var countKomma = value.split(',').length;
	var shape = (countKomma <= 4) ? 'rect' : 'poly';
	if(countKomma >= 4) {
		var html = '<area shape="'+shape+'" id="area'+counter+'" class="area" coords="'+value+'" href="#" alt="" title="">';
		$('map').append(html);
	}
	
	$('#mapContainer').append($('.imgmapMainImage'));
	$('#mapContainer').children('div').remove();
	$('.imgmapMainImage').removeClass('maphilighted');
	//$('canvas').remove();

	hightlight();
	
	var area = '<area alt="" title="" href="#" shape="'+shape+'" coords="'+value+'" />\n';
	//var textarea = $('#areaText').val();
	if(textarea == '')
	{
		// create textarea context
		textarea = '<img src="https://www.imagemap.in/'+ imgvalue +'" alt="QuickMap" class="QuickMap" usemap="#QuickMap" />\n'
				+ '<map name="QuickMap" id="QuickMap">\n'
				+ '    ' + area
				+ '    <area../>\n'
				+ '</map>';
	}
	else 
	{
		if(countKomma == 2)
		{
			// new <area> context
			textarea = textarea.replace('<area../>', area + '    <area../>');
		}
		else 
		{
			// edit / update <area> context
			var arr = value.split(',');
			var oldCoor = '';
			for(var i = 0; i < arr.length -2; i++)
			{
				if(i >= 1)
					oldCoor += ',';
				oldCoor += arr[i];
			}
			textarea = textarea.replace('shape="rect" coords="'+oldCoor, 'shape="'+shape+'" coords="'+oldCoor);
			textarea = textarea.replace(oldCoor, value);
		}
	}
	$('#areaText').val(textarea);
}

function hightlight() {
	$('.imgmapMainImage').maphilight({
		strokeColor: '64CB81',
		alwaysOn: true,
		fillColor: 'B22B1F',
		fillOpacity: 0.2,
		shadow: true,
		shadowColor: 'B22B1F',
		shadowRadius: 5,
		shadowOpacity: 0.6,
		shadowPosition: 'outside'
	});
}

function resizeUploadContainer() {
	if($('#upload').length) {
		var val = (($(window).height() - $('#logo').outerHeight() - $('#upload').outerHeight()) / 2) * 0.6;
		if(val < 100) { val = 100; }
		$('.infobox').css('margin-top', val+'px');
	}
	resizeHtml();
}
	
function loadImagemapGenerator(width, height) {
	$('#mapContainer img');
	if(width == 0)
		width = $('#mapContainer img').width();
	if(height == 0)
		height = $('#mapContainer img').height();
	$('#newUpload').width(width-8);
	$('#mapContainer').width(width);
	widthTmp = (width < 350) ? 364 : width;
	widthTmp2 = (width < 350) ? 350 : width;
	$('div.form').width(widthTmp+4);
	$('div.form input').width(widthTmp2-34);
	width = (width < 363) ? 363 : width;
	$('div.form textarea').css({'width': width-10});
	$('#mapContainer').height(height);
	if($("#mapContainer").height() < 55) {
		$("#urlMessage").css("display", "block");
	}	
	resizeHtml();
}

function resizeHtml() {
	var current, height;
	$.each($('.infobox'), function() {
		if($(this).css('display') != 'none')
		current = $(this);
	});
	
	if(typeof(current) == 'undefined') {
		height = $('#imagemap4posis').outerHeight() + $('#header').outerHeight();
	} else {
		height = $(current).outerHeight(true) + $('#header').outerHeight();
	}
	
	if((typeof(current) == 'undefined' && height > $(window).height())
		|| (typeof(current) != 'undefined' && height > $(window).height())) {
		$('html').height(height);
		$('footer').css('top', height - 30 +'px');
	} else if(typeof(current) != 'undefined') {
		$('html').height('100%');
		$('footer').css('top', $(window).height() - 30 +'px');
	}
}
		
function removeOldMapAndValues() {
	if($('.imgmapMainImage').hasClass('maphilighted')) {
		$('#mapContainer').append($('.imgmapMainImage'));
		$('#mapContainer').children('div').remove();
		$('.imgmapMainImage').removeClass('maphilighted').css('opacity', 1);
		$('#dots').empty();
		$('#coordsText').val('');
		$('#areaText').val('');
		$('#map').children('area').remove();
	}
}
function removeErrorMessage() {
	$('#urlMessage').hide();
}
function enterImagelinkForm() {

	removeErrorMessage();
	var url = $('#imageurl').val().trim();
	var error = true;
	
	var urlBegin = url.substr(0, 4);
	if(urlBegin == 'http' || urlBegin == 'www.')
		error = false;
		
	var parts = url.split('.');
	var ext = parts[parts.length-1].toLowerCase();

	if(ext == 'gif' || ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'tif' || ext == 'tiff' || ext == 'bmp')
		error = false;
	
	if(error == false) {
		$("#urlMessage").css("display", "none");
		$('#imagemap4posis #mapContainer').find('img').attr('src', url);
		removeOldMapAndValues();
		jQuery.ajax({
			type: 'POST',
			url: 'upload_ident.php',
			data: {'file': url, 'width': 0, 'height': 0},
			//data: {'data': '[true, "'+url+'", 0, 0]'},
			dataType : 'json'
		});
		$('#navi').attr('currentValue', '#imagemap4posis');
		$('#upload').slideUp(400, function() {
			$('#uploadUndo, #uploadUndo2').show();
			$('#imagemap4posis').slideDown(400, function() {
				resizeHtml();
				
				// not correct loaded yet?
				setTimeout(function() {
					loadImagemapGenerator();
				}, 300);
				
				setTimeout(function() {
					if($('#main').width() <= 20 && $('#main').height() <= 20)
						$('#urlMessage').slideDown(600);
				}, 1000);
				
			});
			loadImagemapGenerator(0, 0);
		});
	} else {
		$('#imageurl').find('.alert-danger').remove();
		$('<div class="alert alert-danger"> <strong>ERROR !</strong> Image URL entered not a valid Image URL, please enter again</div>').insertAfter('#imageurl');
		$('#linkform').find('.alert-danger').slideDown(400).delay(5000).slideUp(400, function(){ $(this).remove(); });
	}
}