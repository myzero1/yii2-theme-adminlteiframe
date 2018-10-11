$(".form-group .help-block").mouseenter(function(){
    console.log($(this).text());
    $(this).attr('title', $(this).text());
});