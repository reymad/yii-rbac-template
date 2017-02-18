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


/*
 * fin function.js
 * */