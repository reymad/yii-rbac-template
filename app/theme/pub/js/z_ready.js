/**
 * Created by jrey on 19/09/2016.
 * ready
 */
$(document).ready(function(){

    console.log('app.js');

    // comment here
    fun();

    tellWidth($('.tellWidth'));

    //
    var to = setInterval(function(){

        $('div.transition')
            .slideToggle('slow')
            .promise()
            .done(function(){
                console.log('done!!');
            });

        intervalCounter++;
        if(intervalCounter>5){ clearInterval(to); }

    }, 2000);


    $.blockUI(growlUIconfig);
   //  $.blockUI({})


});

$(window).on('resize', function(){

    $.each($('.tellWidth'), function(){
        tellWidth($(this));
    });

});

$(window).on('click', function(){
    $.unblockUI();
});

$(document).ajaxStart(ajaxStart).ajaxStop(ajaxStop);

/*
* fin ready
* */
