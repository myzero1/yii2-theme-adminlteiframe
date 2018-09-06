/*
'data-provide' =>"z1ztree",'data-z1ztree-config' => '{setting: {},isAjax:false,data:[..]}'
'data-provide' =>"z1ztree",'data-z1ztree-config' => '{setting: {},isAjax:true,data:"https://www.baidu.com"}'


*/
function applyz1ztree(){
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
              { id:1, pId:0, name:"fuzzySearch demo 1", t:"id=1", open:true},
              { id:11, pId:1, name:"[]\\^$.|?*+():keywords with js meta characters", t:"id=11"},
              { id:12, pId:1, name:"{}<>'\"~`!@#%&-;:/,=:keywords with other characters", t:"id=12"},
              { id:2, pId:0, name:"fuzzySearch demo 2", t:"id=2", open:true},
              { id:21, pId:2, name:"uppercase ABDEFGHINQRT:keywords igonore case", t:"id=21"},
              { id:22, pId:2, name:"lowercase abdefghinqrt:keywords igonore case", t:"id=21"},
              { id:3, pId:0, name:"fuzzySearch demo 3", t:"id=3", open:true },
              { id:31, pId:3, name:"blank blank:keywords with blank", t:"id=31"}
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
    });
}

applyz1ztree();