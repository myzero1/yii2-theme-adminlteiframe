function applyz1wysihtml5(){
    $('textarea[data-provide="z1wysihtml5"]').each(function() {

        var defaultConfig = {
          toolbar: {
              "color": true,
              // "html": true,
              "size": 'sm'
          },
          "locale" : 'zh-CN',
        };

        var configSetting = $(this).attr('data-z1wysihtml5-config');
        if (configSetting=='undefied') {
            configSetting = {};
        } else {
            configSetting = eval('(' + configSetting + ')');
        }
        var config = $.extend({}, defaultConfig, configSetting);

        $(this).wysihtml5(config);
    });
}

applyz1wysihtml5();