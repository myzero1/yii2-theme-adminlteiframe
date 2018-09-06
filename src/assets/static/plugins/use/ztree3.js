/*
'data-provide' =>"z1ztree",'data-z1ztree-config' => '{setting: {},isAjax:false,data:[..]}'
'data-provide' =>"z1ztree",'data-z1ztree-config' => '{setting: {},isAjax:true,data:"https://www.baidu.com"}'


*/
function applyz1ztree(){
    initUl();
    initSelect();
    // initInput();


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

function initSelect(){

}

function initInput(){
    $('input[data-provide="z1ztree"]').each(function() {
        var defaultConfig = {
            "setting": {
              check: {
                enable: true//checkbox
              },
              view: {
                nameIsHTML: true, //allow html in node name for highlight use       
                selectedMulti: false
              },
              edit: {
                enable: false,
                editNameSelectAll: false
              },
              data: {
                simpleData: {
                  enable: true
                }
              }
            },
            "isAjax": false,
            "data": [
              {id:1, pId:0, name:"Beijing"},
              {id:2, pId:0, name:"Tianjin"},
              {id:3, pId:0, name:"Shanghai"},
              {id:6, pId:0, name:"Chongqing"},
              {id:4, pId:0, name:"Hebei Province", open:true},
              {id:41, pId:4, name:"Shijiazhuang"},
              {id:42, pId:4, name:"Baoding"},
              {id:43, pId:4, name:"Handan"},
              {id:44, pId:4, name:"Chengde"},
              {id:5, pId:0, name:"Guangdong Province", open:true},
              {id:51, pId:5, name:"Guangzhou"},
              {id:52, pId:5, name:"Shenzhen"},
              {id:53, pId:5, name:"Dongguan"},
              {id:54, pId:5, name:"Fushan"},
              {id:6, pId:0, name:"Fujian Province", open:true},
              {id:61, pId:6, name:"Fuzhou"},
              {id:62, pId:6, name:"Xiamen"},
              {id:63, pId:6, name:"Quanzhou"},
              {id:64, pId:6, name:"Sanming"}
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

          if (config.isAjax) {
            $data = [];
          }

          var target = $(this);
          var ztreeId = 'ztree-'+Math.floor(Math.random()*(999999999));
          var ztreeLayer = '\
          <div id="ztreeLayer-layout">\
            <div id="ztreeLayer-search">\
              <input type="text" id="ztreeLayer-search-name" />\
            </div>\
            <div id="ztreeLayer-body">\
            <ul id="'+ztreeId+'" class="ztree" style="margin-top:0; width:180px; height: 300px;"></ul>\
            </div>\
          </div>\
          ';
          var ztreeVal = '<input type="hidden" name="'+target.attr('name')+'" />';

          target.attr('name', 'ztreeShow');
          target.after(ztreeVal);
          target.after(ztreeLayer);

          $.fn.zTree.init($("#"+ztreeId), setting, data);
          fuzzySearch(ztreeId,'#ztreeLayer-search-name',null,true); //initialize fuzzysearch function
    });
}

applyz1ztree();