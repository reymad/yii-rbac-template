/**
 * Created by jrey on 15/02/2017.
 * function.js
 */
function ajaxStart(){
    $.blockUI(blockUIloadingConf);
}
function ajaxStop(){
    $.unblockUI();
}

// scroll manage
$(window).on("scroll", function () {
    if ($(this).scrollTop() > 10) {
        $("nav#main-header").css({'top':'0px','height': '60px'});
    }
    else {
        $("nav#main-header").css({'top':'10px','height': '60px'});
    }
});

/*
 * fin function.js
 * */