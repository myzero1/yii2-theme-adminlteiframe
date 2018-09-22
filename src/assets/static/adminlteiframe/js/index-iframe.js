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
    App.setbasePath(base);
    App.setGlobalImgPath("/img/");

    var menus = eval('(' + $("#index-iframe-left-menu").text() + ')');
    var home_page = eval('(' + $("#index-iframe-home-page").text() + ')');

    addTabs(home_page);
    var int=self.setInterval(function(){
        if ($(".nav-link[data-pageid="+home_page.id+"]").length==1) {
            $(".nav-link[data-pageid="+home_page.id+"]").parent().addClass('active');
            int=window.clearInterval(int);
        }
    },50);

    App.fixIframeCotent();
    
    $('.sidebar-menu').sidebarMenu({data: menus});
});