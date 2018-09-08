function applyz1select2(){
    $('select[data-provide="z1select2"]').each(function() {
        var defaultConfig = {
          language: "zh-CN", //设置 提示语言
          width: "100%", //设置下拉框的宽度
          placeholder: "请选择"
        };

        var configSetting = $(this).attr('data-z1select2-config');
        if (configSetting=='undefied') {
            configSetting = {};
        } else {
            configSetting = eval('(' + configSetting + ')');
        }
        var config = $.extend({}, defaultConfig, configSetting);

        $(this).select2(config);
    });
}

applyz1select2();