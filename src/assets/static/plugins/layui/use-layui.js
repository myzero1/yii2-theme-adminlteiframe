$(function(){
    $(document).on('click', '.use-layer',  function(){ // use-layer
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
        var defaultConfig = {
            type: 1,
            title: 'title',
            maxmin: true,
            shadeClose: true, //点击遮罩关闭层
            area : ['500px' , '400px'],
            content: 'content'
        };

        var config = eval('(' + $(this).attr('layer-config') + ')');

        $.extend(defaultConfig, config);

        layui.use('layer', function(){
          var layer = layui.layer;
          
          layer.open(defaultConfig);
        });
    });
});