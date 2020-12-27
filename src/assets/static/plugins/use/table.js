function applyz1table(){
    $('table[data-provide="z1table"]').each(function() {
        var defaultConfig = {
          "fixedColumns" : true,
          "height": 500,
          "subtraction1" : 100,
          "subtraction2Selector" : [],// ["#table1",".mytable","table"]
        };

        var configSetting = $(this).attr('data-z1table-config');
        if (configSetting=='undefied') {
            configSetting = {};
        } else {
            configSetting = eval('(' + configSetting + ')');
        }
        var config = $.extend({}, defaultConfig, configSetting);

        var _that = $(this);

        fixTable(_that, config);

        $(window).resize(_that, function(){
            fixTable(_that, config);
        });

    });
}

// applyz1table();
setTimeout("applyz1table()",15);


function getTableHeight(defaultConfig){
    var subtraction2 = 0;
    for (var i = defaultConfig.subtraction2Selector.length - 1; i >= 0; i--) {
      if ($(defaultConfig.subtraction2Selector[i]).length > 0) {
        // subtraction2 = subtraction2 + $(defaultConfig.subtraction2Selector[i]).height();
        subtraction2 = subtraction2 + $(defaultConfig.subtraction2Selector[i]).outerHeight(true);
      }
    }

    subtractionNew = defaultConfig.subtraction1 + subtraction2;
    var heightNew = window.innerHeight;
    heightNew = heightNew - subtractionNew;
    return heightNew;
}

function fixTable(target, defaultConfig){
    if (!(target.find(".empty").length > 0 || target.find("tbody").find("tr").length == 0)) {
            if(typeof mybootstrapTable!="undefined"){
                mybootstrapTable.bootstrapTable('destroy');
            }

            mybootstrapTable = target.bootstrapTable('destroy').bootstrapTable({
                height: getTableHeight(defaultConfig),
                fixedColumns: defaultConfig.fixedColumns
            });
    }
}
