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
        var inputNum = Math.floor(Math.random()*(999999999));
        var ztreeId = 'ztree-' + inputNum;
        var ztreeSearchId = 'ztree-search' + inputNum;
        var target = $(this);
        var radioCheck = {
          enable: true,
          chkStyle: 'radio',
          chkboxType: { "Y": "", "N": "" },
          radioType: 'all'
        };
        var checkboxCheck = {
          enable: true,
          chkStyle: 'checkbox',
          chkboxType: { "Y": "ps", "N": "ps" }
        };

        /*
          {"withParents": true,"checkType": "radio"}
        */
        var defaultConfig = {
          "checkType": "checkbox", // checkbox radio
          // "withParents": true,
            "radioWithParents": true,
            "valFieldName": 'name',
            "ztreeLayerPadding": "10px",
            "ztreeLayerBorder": "1px solid #d2d6de",
            "ztreeLayerSearchShow": true,
            "setting": {
              check: {
                enable: true,
                chkStyle: 'checkbox',
                chkboxType: { "Y": "ps", "N": "ps" }
              },
              view: {
                dblClickExpand: true
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
                beforeClick: function(treeId, treeNode) {
                  var zTree = $.fn.zTree.getZTreeObj(ztreeId);
                  zTree.checkNode(treeNode, !treeNode.checked, null, true);
                  return false;
                },
                beforeCheck: function(treeId, treeNode) {
                  if (defaultConfig.setting.check.chkStyle == 'radio') {
                    return !treeNode.isParent;//当是父节点 返回false 不让选取
                  }
                },
                onCheck: function(e, treeId, treeNode) {
                  var zTree = $.fn.zTree.getZTreeObj(ztreeId),
                  nodes = zTree.getCheckedNodes(true),
                  ztvalue = new Array();
                  ztname = new Array();
                  for (var i=0, l=nodes.length; i<l; i++) {
                    ztvalue.push(nodes[i][defaultConfig.valFieldName]);
                    // ztname.push(nodes[i].name);
                    // str.replace(/<[^>]+>/g,"");//去掉所有的html标记
                    ztname.push(nodes[i].name.replace(/<[^>]+>/g,""));

                    // just for radio
                    if (defaultConfig.setting.check.chkStyle == 'radio' && config.radioWithParents) {
                      var tmpNode = nodes[i];
                      while( tmpNode.getParentNode() != null){
                        ztvalue.push(tmpNode.getParentNode()[defaultConfig.valFieldName]);
                        ztname.push(tmpNode.getParentNode().name.replace(/<[^>]+>/g,""));
                        tmpNode = tmpNode.getParentNode();
                      }
                    }
                  }

                  if (defaultConfig.setting.check.chkStyle == 'radio') {
                    ztvalue.reverse();
                    ztname.reverse();
                    target.attr("value", ztvalue.join('>'));
                    target.next(".ztreeShowInput").attr(config.valFieldName, ztname.join('>'));
                  } else {
                    target.attr("value", ztvalue.join(','));
                    target.next(".ztreeShowInput").attr(config.valFieldName, ztname.join(','));
                  }
                }
              }
            },
            "data": [
              {id:1, pId:0, name:"l11", value:"v11"},
              {id:2, pId:0, name:"l12", value:"v12"},
              {id:3, pId:0, name:"l13", value:"v13", open:true},
              {id:4, pId:3, name:"l21", value:"v21", chkDisabled:true},
              {id:5, pId:3, name:"l22", value:"v22", checked:true},
              {id:6, pId:3, name:"l23", value:"v23"},
              {id:7, pId:6, name:"l31", value:"v31"}
            ]
          };

          var configSetting = $(this).attr('data-z1ztree-config');
          if (configSetting===undefined) {//undefined
              configSetting = {};
          } else {
              configSetting = eval('(' + configSetting + ')');
              if (configSetting.checkType && configSetting.checkType=='checkbox') {
                defaultConfig.setting.check = checkboxCheck;
              } else {
                defaultConfig.setting.check = radioCheck;
              }
          }
          var config = $.extend({}, defaultConfig, configSetting);
          var setting = config.setting;
          var data = config.data;

          var ztreeLayerPadding=config.ztreeLayerPadding
          var ztreeLayerBorder=config.ztreeLayerBorder
          var ztreeLayerSearch='\
          <div class="ztreeLayer-search">\
            <input type="text" id="'+ztreeSearchId+'" placeholder="请输入" class="ztreeLayer-search-name" style="width: 100%;padding-left:5px;border:'+ztreeLayerBorder+'" />\
          </div>'
          if (!config.ztreeLayerSearchShow) {
            ztreeLayerSearch=''
          }

          var ztreeLayer = '\
          <div class="ztree-input-layout">\
            <div class="ztreeLayer-layout" style="padding: '+ztreeLayerPadding+';border: '+ztreeLayerBorder+';">\
              '+ztreeLayerSearch+'<div id="ztreeLayer-body">\
              <ul id="'+ztreeId+'" class="ztree ztree-content" style="margin-top:0; width:100%; height: max-200px;overflow: auto;"></ul>\
              </div>\
            </div>\
          </div>\
          ';

          var width = target.outerWidth() - 2;
          var height = target.outerHeight() - 2;

          var ztreeShow = '<input type="text" readonly value="" onclick="showMenu($(this));" class="ztreeShowInput" style="padding-left: 10px;position: absolute;top: 1px;left:1px;border: 0;width:'+width+'px;height:'+height+'px" />';

          target.after(ztreeLayer);
          // target.after(ztreeShow);

          $.fn.zTree.init($("#"+ztreeId), setting, data);
          fuzzySearch(ztreeId,"#"+ztreeSearchId,null,true); //initialize fuzzysearch function
    });
}


function showMenu(target) {
  target.next(".ztree-input-layout").slideDown("fast");

  $("body").bind("mousedown", onBodyDown);
}
function hideMenu() {
  $(".ztree-input-layout").fadeOut("fast");
  $("body").unbind("mousedown", onBodyDown);
}
function onBodyDown(event) {
  var tmp = $(event.target);

  if (tmp.parents(".ztree-input-layout").length==0) {
    hideMenu();
  }
}

applyz1ztree();