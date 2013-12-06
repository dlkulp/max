jQuery.extend({
  parseQuerystring: function(){
    var nvpair = {};
    var qs = window.location.search.replace('?', '');
    var pairs = qs.split('&');
    $.each(pairs, function(i, v){
      var pair = v.split('=');
      nvpair[pair[0]] = pair[1];
    });
    return nvpair;
  }
});

$(function() {
	var qs = jQuery.parseQuerystring();
    $("#user_pass").hide();
    $("#sign").click(function() {
        $("#user_pass").toggle('fast');
        $("#input_user").focus();
    });
    $("#tabs").tabs();
	$("#tab").tabs();
	if( qs['edit'] != null ) {
		$("#tabs").tabs( "select", 2 );
	}
	else if( qs['remove'] != null ) {
		$("#tabs").tabs( "select", 1 );
	}
});

function go(btn) {
	var product_id = $(btn).attr("data-product-id");
    window.location = "admin.php?edit=" + product_id;
};

function go2(btn) {
	var qs = jQuery.parseQuerystring();
    var product_id = $(btn).attr("data-product-id"); 
    window.location = "admin.php?remove=" + product_id;
};