$(function(){
    $(document).on('click', '.use-layer',  function(){
        layerOpen($(this));
    });

    $(document).on('click', 'a[data-provide="z1layer"]',  function(){
        layerOpen($(this));
    });

    function layerOpen(target){
        /*
          //弹出一个iframe层
          $('#parentIframe').on('click', function(){
          layer.open({
            type: 2,
            title: 'iframe父子操作',
            maxmin: true,
            shadeClose: true, //点击遮罩关闭层
            area : ['800px' , '520px'],
            content: 'test/iframe.html'
          });
          });
          https://layer.layui.com/hello.html

          type: ["dialog", "page", "iframe", "loading", "tips"],// 依次为0,1,2,3,4

        */
        var config = eval('(' + target.attr('layer-config') + ')');
        var width = 660;
        var height = 400;
        if (config.area !== undefined) {
          var widthTmp = config.area[0];
          if (widthTmp.indexOf("%") != -1 ) {
            widthTmp = widthTmp.replace("%", "");
            widthTmp = parseInt(widthTmp);
            var height = Math.floor($('html').outerHeight(true));
            width = width * (widthTmp/100);
            width = parseInt(width);
          }
          var heightTmp = config.area[1];
          if (heightTmp.indexOf("%") != -1 ) {
            heightTmp = heightTmp.replace("%", "");
            heightTmp = parseInt(heightTmp);
            var height = Math.floor($('html').outerHeight(true));
            height = height * (heightTmp/100);
            height = parseInt(height);
          }
        }

        var defaultConfig = {
            type: 1,
            title: 'title',
            shadeClose: true, //点击遮罩关闭层
            area : [width+'px' , height+'px'],
            content: 'content',
            maxmin: true,
            full: function(layero, index){
              var heightTmp=$('.layui-layer-iframe').height()-$('.layui-layer-title').height()-2
              $('.layui-layer-content iframe').css({"height":heightTmp+"px"})
            },
            restore: function(layero, index){
              $('.layui-layer-content iframe').css({"height":height+"px"})
            }
        };

        $.extend(defaultConfig, config);

        layer.open(defaultConfig);
    }
});
