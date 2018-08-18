$(document).ready(function () {

     var pageName = (function () {
        var a = window.location.href,
            b = a.lastIndexOf("/");
        return a.substr(b + 1);
    }());

    $( ".nav-item" ).each(function() {
        $(this).removeClass("active");
        var hf = $(this).children().attr("href");
        if(hf==pageName){
            $(this).addClass("active");
        }

      });



});