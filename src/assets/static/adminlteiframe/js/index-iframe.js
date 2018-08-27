base = '';

$("script").each(function(){
    tmp = $(this).attr('src') + "";
    if ( tmp.indexOf("app_iframe.js" ) != -1 ) {
        base = tmp.replace('js/app_iframe.js', '');
    }
});

if (base == '') {
    alert("Must inclue app_iframe.js, before this.");
}


/**
 * 本地搜索菜单
 */
function search_menu() {
    //要搜索的值
    var text = $('input[name=q]').val();

    var $ul = $('.sidebar-menu');
    $ul.find("a.nav-link").each(function () {
        var $a = $(this).css("border", "");

        //判断是否含有要搜索的字符串
        if ($a.children("span.menu-text").text().indexOf(text) >= 0) {

            //如果a标签的父级是隐藏的就展开
            $ul = $a.parents("ul");

            if ($ul.is(":hidden")) {
                $a.parents("ul").prev().click();
            }

            //点击该菜单
            $a.click().css("border", "1px solid");

//                return false;
        }
    });
}

$(function () {
//        console.log(window.location);
    App.setbasePath(base);
    App.setGlobalImgPath("/img/");

    // var home = eval('(' + $("#index-iframe-home").text() + ')');
    var menus = eval('(' + $("#index-iframe-left-menu").text() + ')');
    var home_page = eval('(' + $("#index-iframe-home-page").text() + ')');

    addTabs(home_page);

    // addTabs({
    //     id: '-1',
    //     title: '欢迎页',
    //     close: false,
    //     url: '/z1demo/default/sub1',
    //     urlType: "abosulte"
    // });

    App.fixIframeCotent();

    /*addTabs({
     id: '10009',
     title: '404',
     close: true,
     url: 'UI/buttons_iframe2.html'
     });*/

    /*
     <li class="treeview">
     <a href="#">
     <i class="fa fa-edit"></i> <span>Forms</span>
     <span class="pull-right-container">
     <i class="fa fa-angle-left pull-right"></i>
     </span>
     </a>
     <ul class="treeview-menu">
     <li><a href="forms/general.html"><i class="fa fa-circle-o"></i> General Elements</a></li>
     <li><a href="forms/advanced.html"><i class="fa fa-circle-o"></i> Advanced Elements</a></li>
     <li><a href="forms/editors.html"><i class="fa fa-circle-o"></i> Editors</a></li>
     </ul>
     </li>
     */
    // var menus = [
    //     {
    //         id: "9000",
    //         text: "header",
    //         icon: "",
    //         targetType: "iframe-tab",
    //         isHeader: true
    //     },
    //     {
    //         id: "9001",
    //         text: "UI Elements",
    //         icon: "fa fa-laptop",
    //         children: [
    //             {
    //                 id: "90011",
    //                 text: "buttons",
    //                 icon: "fa fa-circle-o",
    //                 url: "UI/buttons_iframe.html",
    //                 targetType: "iframe-tab"
    //             },
    //             {
    //                 id: "90012",
    //                 text: "icons",
    //                 url: "UI/icons_iframe.html",
    //                 targetType: "iframe-tab",
    //                 icon: "fa fa-circle-o"
    //             },
    //             {
    //                 id: "90013",
    //                 text: "general",
    //                 url: "UI/general_iframe.html",
    //                 targetType: "iframe-tab",
    //                 icon: "fa fa-circle-o"
    //             },
    //             {
    //                 id: "90014",
    //                 text: "modals",
    //                 url: "UI/modals_iframe.html",
    //                 targetType: "iframe-tab",
    //                 icon: "fa fa-circle-o"
    //             },
    //             {
    //                 id: "90015",
    //                 text: "sliders",
    //                 url: "UI/sliders_iframe.html",
    //                 targetType: "iframe-tab",
    //                 icon: "fa fa-circle-o"
    //             },
    //             {
    //                 id: "90016",
    //                 text: "timeline",
    //                 url: "UI/timeline_iframe.html",
    //                 targetType: "iframe-tab",
    //                 icon: "fa fa-circle-o"
    //             }
    //         ]
    //     },
    //     {
    //         id: "9002",
    //         text: "Forms",
    //         icon: "fa fa-edit",
    //         children: [
    //             {
    //                 id: "90021",
    //                 text: "advanced",
    //                 url: "forms/advanced_iframe.html",
    //                 targetType: "iframe-tab",
    //                 icon: "fa fa-circle-o"
    //             },
    //             {
    //                 id: "90022",
    //                 text: "general",
    //                 url: "forms/general_iframe.html",
    //                 targetType: "iframe-tab",
    //                 icon: "fa fa-circle-o"
    //             },
    //             {
    //                 id: "90023",
    //                 text: "editors",
    //                 url: "forms/editors_iframe.html",
    //                 targetType: "iframe-tab",
    //                 icon: "fa fa-circle-o"
    //             },
    //             {
    //                 id: "90024",
    //                 text: "百度",
    //                 url: "https://www.baidu.com",
    //                 targetType: "iframe-tab",
    //                 icon: "fa fa-circle-o",
    //                 urlType: 'abosulte'
    //             }
    //         ]
    //     }
    // ];
    $('.sidebar-menu').sidebarMenu({data: menus});

    // 动态创建菜单后，可以重新计算 SlimScroll
    // $.AdminLTE.layout.fixSidebar();

    /*if ($.AdminLTE.options.sidebarSlimScroll) {
        if (typeof $.fn.slimScroll != 'undefined') {
            //Destroy if it exists
            var $sidebar = $(".sidebar");
            $sidebar.slimScroll({destroy: true}).height("auto");
            //Add slimscroll
            $sidebar.slimscroll({
                height: ($(window).height() - $(".main-header").height()) + "px",
                color: "rgba(0,0,0,0.2)",
                size: "3px"
            });
        }
    }*/



    // $('.nav-link[onclick]').click(function(){
    //     $('.nav-link[onclick]').parents('.treeview').removeClass('active');
    //     $(this).parents('.treeview').addClass('active');
    //     console.log($(this).attr('onclick'));
    // });

});