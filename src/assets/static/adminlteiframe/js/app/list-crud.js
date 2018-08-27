// styles

$(".list_crud_act").css({'color':'#0068b7','font-weight':'bold','font-size':'12px','cursor':'pointer'});

$('.list_crud_act').hover(function(){
　　　　$(this).css({"color":"#eb6100"});
}, function(){
　　　　$(this).css({"color":"#0068b7"});
})

// var style = '\
// <style type="text/css">\
//      .list_crud_act{color:#0068b7;font-weight:bold;font-size:12px;cursor:pointer}\
//      .list_crud_act:hover{color:#0068b7;}\
//      .list_crud_win{top:5vh;}\
//      .list_crud_win .d-content{max-height:80vh;overflow:auto}\
// </style;\
// ';
// $('body').append(style);

// actions

$('.list_cu').bind('click', function () {
    var url = $(this).attr('crud-url');
    var method = $(this).attr('crud-method');
    var data = $(this).attr('crud-data');
    var winTitle = $(this).attr('win-title');

    if (typeof(listCudDialog) != "undefined") {
        return false;
    }

    var listCudDialog = art.dialog({
        skin:'list_crud_win',
        width:'540px',
        fixed: true,
        cancel: true,
        
        title: winTitle,
        // content: '',
        ok:function(){
            submiting = art.dialog({
                title: '提交中。。。',
                fixed: true,
                cancel: false
            });
            $.ajax({
                type: "POST",   
                // dataType: "json",
                url: url,
                data: $(".list_crud_win form").serialize(),
                success: function (data) 
                {
                    submiting.close();
                    
                    if (data==0) {
                        listCudDialog.close();
                        location.reload();
                    } else {
                        listCudDialog.content('');

                        $(".list_crud_win .d-content").append(data);
                        $(".list_crud_win .d-content").css({'max-height':'80vh','overflow':'auto'});
                        $(".list_crud_win").css({'top':'5vh'});
                    }
                }
            });
            
            return false;
        }

    });

    jQuery.ajax({
        url: url,
        type: method,
        data: data,
        success: function(data) {
            listCudDialog.content('');
            $(".list_crud_win .d-content").append(data);
            $(".list_crud_win .d-content").css({'max-height':'80vh','overflow':'auto'});
            $(".list_crud_win").css({'top':'5vh'});
        }
    });
});

$('.list_r').bind('click', function () {
    var url = $(this).attr('crud-url');
    var method = $(this).attr('crud-method');
    var data = $(this).attr('crud-data');
    var winTitle = $(this).attr('win-title');
    var winWidth = $(this).attr('win-width');

    if (typeof(listCudDialog) != "undefined") {
        return false;
    }

    if (typeof(winWidth) == "undefined") {
        winWidth = '540px';
    } 

    var listCudDialog = art.dialog({
        skin:'list_crud_win',
        width: winWidth,
        fixed: true,
        cancel: true,
        
        title: winTitle,
        // content: '',
        ok: false
    });

    jQuery.ajax({
        url: url,
        type: method,
        data: data,
        success: function(data) {
            listCudDialog.content('');
            $(".list_crud_win .d-content").append(data);
            $(".list_crud_win .d-content").css({'max-height':'80vh','overflow':'auto'});
            $(".list_crud_win").css({'top':'5vh'});
        }
    });
});

$('.list_d').bind('click', function () {
    var url = $(this).attr('crud-url');
    var method = $(this).attr('crud-method');
    var data = $(this).attr('crud-data');
    var winTitle = $(this).attr('win-title');
    // var csrf = $('html head mata[name="csrf-token"]').attr('content');
    // var data = {"_csrf-backend":"dd"};

    if (typeof(listCudDialog) != "undefined") {
        return false;
    }

    var listCudDialog = art.dialog({
        skin:'list_crud_win',
        width:'300px',
        fixed: true,
        cancel: true,
        
        title: winTitle,
        content: data,
        ok:function(){
            submiting = art.dialog({
                title: '提交中。。。',
                fixed: true,
                cancel: false
            });

            $.ajax({
                type: method,   
                // dataType: "json",
                url: url,
                success: function (data) 
                {
                    submiting.close();
                    
                    if (data==0) {
                        listCudDialog.close();
                        location.reload();
                    } else {
                        listCudDialog.content(data);

                        $(".list_crud_win .d-content").append(data);
                    }
                }
            });
            
            return false;
        }

    });
});




//-----------------new adminlte-iframe
$('.list-action-create').bind('click', function () {
alert('234234');
});

$(document).on('click', '.list-action-create', function () {
    console.log($(this).attr('id'))
    $.get($(this).attr('action-url'), {},
        function (data) {
            var timestamp=new Date().getTime();
            $('#list-modal .modal-body').html(data);
            $('#list-modal .modal-body form').attr('id', timestamp);
        }  
    );
});

function list_create (target) {
    $.get(target.attr('action-url'), {},
        function (data) {
            var timestamp=new Date().getTime();
            $('.modal-body').html(data);
            $('.modal-body form').attr('id', timestamp);
        }  
    );
};


function form_submmit () {
    var form = $('#list-modal form');
    // // var $form = $(this),
    //             data = $form.data('yiiActiveForm');
    // console.log(data);
    // data.validate();
    // submitting = 1
    // form.submit();

    url = form.attr("action");

    $.ajax({
        type: "POST",   
        // dataType: "json",
        url: url,
        data: form.serialize(),
        success: function (data) 
        {
            console.log(data)
            var timestamp=new Date().getTime();
            $('#list-modal .modal-body').html(data);
            $('#list-modal .modal-body form').attr('id', timestamp);
        }
    });
};
