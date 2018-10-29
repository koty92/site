var array_script = [];
var array_style = [];
var array_menu_style = ['business'];
var array_menu_script = ['business'];
	
// Check get var
//var getNav = getVar('n');
var base_url = document.location.href;
base_url = base_url.replace('#', '');
var getNav = base_url.split('/')[4];
load_resource(getNav);
	
function getVar(variable)
{
	var query = window.location.search.substring(1);
    var vars = query.split("&");
	for (var i=0;i<vars.length;i++) {
	   var pair = vars[i].split("=");
	   if(pair[0] == variable){return pair[1];}
	}
	return(false);
}

function load_resource(getNav) {
	// load css
	if(getNav && $.inArray(getNav, array_menu_style) > -1) {
		if($.inArray(getNav, array_style) == -1) {
			$('head').append('<link rel="stylesheet" type="text/css" href="' + baseUrl + 'assets/css/' + getNav + '.css" />');
			array_style.push(getNav);
		}
				
	}
	
	// load js
	if(getNav && $.inArray(getNav, array_menu_script) > -1) {
		if($.inArray(getNav, array_script) == -1) {
			$.getScript(baseUrl + "assets/js/" + getNav + '.js');
			array_script.push(getNav);
		}
	}
}

$(document).ready(function() {

	// Nav
	$('body').delegate('.nav, .nav_profile', 'click', function() {
		var nav = $(this).data('nav');
		var loader = $('.loader');
		
		$('.container_user_nav').slideUp();
		
		loader.show();
		$('.loading').css('animation-play-state', 'running');
		//alert(baseUrl + 'user/' + nav + '/content');
		$('.container_content').load(baseUrl + 'user/' + nav + '/content', function() {
			loader.hide();
		});
		
		load_resource(nav);
		
        window.history.replaceState("object or string", "Title", nav);
	});

});