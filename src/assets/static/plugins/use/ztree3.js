/*
'data-provide' =>"z1ztree",'data-z1ztree-config' => '{setting: {},isAjax:false,data:[..]}'
'data-provide' =>"z1ztree",'data-z1ztree-config' => '{setting: {},isAjax:true,data:"https://www.baidu.com"}'


*/
function applyz1ztree(){
    initUl();
    initInput();


}

function initUl(){
/*
  {
    "setting": {...},
    "data": [...],
  }

    var setting = {
      view: {
        selectedMulti: false
      },
      async: {
        enable: true,
        url:"../asyncData/getNodes.php",
        autoParam:["id", "name=n", "level=lv"],
        otherParam:{"otherParam":"zTreeAsyncTest"},
        dataFilter: filter
      },
      callback: {
        beforeClick: beforeClick,
        beforeAsync: beforeAsync,
        onAsyncError: onAsyncError,
        onAsyncSuccess: onAsyncSuccess
      }
    };
    $.fn.zTree.init($("#treeDemo"), setting);

    $.fn.zTree.init($("#treeDemo"), setting, zNodes);
  
*/
    $('ul[data-provide="z1ztree"]').each(function() {
        var target = $(this);

        if (!target.hasClass("ztree")) {
          alert('The element must has the ztree class');
          return false;
        }

        var defaultConfig = {
            "setting": {
              data: {
                simpleData: {
                  enable: true
                }
              },
              async: {
                enable: false
              }
            },
            "data": [
              {id:1, pId:0, name:"level1"},
              {id:2, pId:0, name:"level1"},
              {id:3, pId:0, name:"level1", open:true},
              {id:6, pId:3, name:"level2"},
              {id:4, pId:3, name:"level2"},
              {id:41, pId:3, name:"level2"}
            ]
          };

          var configSetting = $(this).attr('data-z1ztree-config');
          if (configSetting=='undefied') {
              configSetting = {};
          } else {
              configSetting = eval('(' + configSetting + ')');
          }
          var config = $.extend({}, defaultConfig, configSetting);

          if (config.setting.async.enable) {
            $.fn.zTree.init(target, config.setting);
          } else {
            $.fn.zTree.init(target, config.setting, config.data);
          }
    });
}

function initInput(){
    $('input[data-provide="z1ztree"]').each(function() {
        var ztreeId = 'ztree-'+Math.floor(Math.random()*(999999999));
        var target = $(this);

        var defaultConfig = {
            "setting": {
              check: {
                enable: true,
                chkboxType: {"Y":"", "N":""}
              },
              view: {
                dblClickExpand: false
              },
              data: {
                simpleData: {
                  enable: true
                }
              },
              async: {
                enable: false
              },
              callback: {
                // beforeClick: beforeClick,
                // onCheck: onCheck
                beforeClick: function(treeId, treeNode) {
                  var zTree = $.fn.zTree.getZTreeObj(ztreeId);
                  zTree.checkNode(treeNode, !treeNode.checked, null, true);
                  return false;
                },
                onCheck: function(e, treeId, treeNode) {
                  var zTree = $.fn.zTree.getZTreeObj(ztreeId),
                  nodes = zTree.getCheckedNodes(true),
                  ztvalue = new Array();
                  ztname = new Array();
                  for (var i=0, l=nodes.length; i<l; i++) {
                    ztvalue.push(nodes[i].value);
                    // ztname.push(nodes[i].name);
                    // str.replace(/<[^>]+>/g,"");//去掉所有的html标记
                    ztname.push(nodes[i].name.replace(/<[^>]+>/g,""));
                  }

                  target.attr("value", ztvalue.join(','));
                  $(".ztreeShowInput").attr("value", ztname.join(','));

                }
              }
            },
            "data": [
              {id:1, pId:0, name:"l11", value:"v11"},
              {id:2, pId:0, name:"l12", value:"v12"},
              {id:3, pId:0, name:"l13", value:"v13", open:true},
              {id:4, pId:3, name:"l21", value:"v21"},
              {id:5, pId:3, name:"l22", value:"v22"},
              {id:6, pId:3, name:"l23", value:"v23"}
            ]
          };

          var configSetting = $(this).attr('data-z1ztree-config');
          if (configSetting=='undefied') {
              configSetting = {};
          } else {
              configSetting = eval('(' + configSetting + ')');
          }
          var config = $.extend({}, defaultConfig, configSetting);
          var setting = config.setting;
          var data = config.data;

          var ztreeLayer = '\
          <div class="ztreeLayer-layout" style="padding: 10px;border: 1px solid #d2d6de;margin-top: 2px;overflow: auto;">\
            <div class="ztreeLayer-search">\
              <input type="text" class="ztreeLayer-search-name" style="width: 100%;" />\
            </div>\
            <div id="ztreeLayer-body">\
            <ul id="'+ztreeId+'" class="ztree ztree-content" style="margin-top:0; width:100%; height: 200px;overflow: auto;"></ul>\
            </div>\
          </div>\
          ';

          var width = target.outerWidth() - 2;
          var height = target.outerHeight() - 2;

          var ztreeShow = '<input type="text" class="ztreeShowInput" style="padding-left: 10px;position: absolute;top: 1px;left:1px;border: 0;width:'+width+'px;height:'+height+'px" />';

          target.after(ztreeLayer);
          target.after(ztreeShow);

          $.fn.zTree.init($("#"+ztreeId), setting, data);
          fuzzySearch(ztreeId,'.ztreeLayer-search-name',null,true); //initialize fuzzysearch function
    });
}

applyz1ztree();