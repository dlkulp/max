$(function() {
    $("#user_pass").hide();
    $("#sign").click(function() {
        $("#user_pass").toggle('fast');
        $("#input_user").focus();
    });
});

function go() {
    var a = jQuery(this).attr("id"); 
    window.location = "product_info.php?id=" + a;
};