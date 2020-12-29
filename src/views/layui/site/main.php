<blockquote class="layui-elem-quote layui-bg-green">
    <div id="nowTime"></div>
</blockquote>
<div class="layui-row layui-col-space10 panel_box">
    <div class="panel layui-col-lg4 layui-col-md4">
        <a href="javascript:;" data-url="https://github.com/myzero1/yii2-theme-layui" target="_blank">
            <div class="panel_icon layui-bg-black">
                <i class="layui-anim seraph icon-github"></i>
            </div>
            <div class="panel_word">
                <span>Github</span>
                <cite>模版下载链接</cite>
            </div>
        </a>
    </div>
    <div class="panel layui-col-lg4 layui-col-md4">
        <a href="javascript:;" data-url="<?=yii\helpers\Url::to(['doc/icons'])?>">
            <div class="panel_icon layui-bg-cyan">
                <i class="layui-anim layui-icon" data-icon="&#xe857;">&#xe857;</i>
            </div>
            <div class="panel_word outIcons">
                <span>34+</span>
                <em>外部图标</em>
                <cite class="layui-hide">图标管理</cite>
            </div>
        </a>
    </div>
    <div class="panel layui-col-lg4 layui-col-md4">
        <a href="javascript:;">
            <div class="panel_icon layui-bg-blue">
                <i class="layui-anim seraph icon-clock"></i>
            </div>
            <div class="panel_word">
                <span class="loginTime"></span>
                <cite>上次登录时间</cite>
            </div>
        </a>
    </div>
</div>
<blockquote class="layui-elem-quote main_btn">
    <p>
        本模板基于Layui2.*实现，支持除LayIM外所有的Layui组件。
        <a href="http://layim.layui.com/#getAuth" target="_blank" class="layui-btn layui-btn-xs">获取LayIM授权</a>
        　layui开发文档地址：
        <a class="layui-btn layui-btn-xs layui-btn-danger" target="_blank" href="http://www.layui.com/doc">layui文档</a>
        　代码地址：
        <a class="layui-btn layui-btn-xs layui-btn-normal" target="_blank" href="https://github.com/myzero1/yii2-theme-layui">github</a>
    </p>
    <p class="layui-red">
    郑重提示：本主题完全免费，遵循MIT开源协议。
    </p>
    <p>注意：在使用crud的时候，请先初始化，不然会报错。因为模块中的crud操作要操作数据库。在初始化的时候，会去创建对应的数据库表</p>
    <p class="layui-blue">PS：这只是模版而不是定制开发，不能覆盖升级很正常，请不要因为不能覆盖升级来喷我，我表示很无辜，谢谢大家</p>
</blockquote>

<div class="layui-row layui-col-space10">
    <div class="layui-col-lg12 layui-col-md12">
        <blockquote class="layui-elem-quote title">新加插件<i class="layui-icon layui-red">&#xe756;</i></blockquote>
        <table class="layui-table magt0">
            <colgroup>
                <col width="150">
                <col>
            </colgroup>
            <tbody>
            <tr>
                <td>Echart</td>
                <td>
                    <fieldset class="layui-elem-field layui-field-title magt30">
                        <legend>插件效果</legend>
                    </fieldset>
                    <p>
                        <div data-provide="z1echarts" id='client-chart' style="width: 100%;height:250px;" data-echarts-config="{title: {text: '折线图基本',left: 'center'}}"></div>
                    </p>
                    <br/>

                    <fieldset class="layui-elem-field layui-field-title magt30">
                        <legend>插件代码</legend>
                    </fieldset>
                    <p>
                        <pre class="layui-code">
&lt;?php myzero1\layui\assets\php\components\plugins\EchartsAsset::register($this); ?&gt;
&lt;div data-provide="z1echarts" id='client-chart' style="width: 100%;height:250px;" data-echarts-config="{title: {text: '折线图基本',left: 'center'}}"&gt;&lt;/div&gt;
                        </pre>
                    </p>
                    <br/>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>


<?php

$bundle = \myzero1\layui\assets\php\components\MainAsset::register(Yii::$app->view);
$bundle->js[] = 'resources/js/main.js';

?>

<?php myzero1\layui\assets\php\components\plugins\EchartsAsset::register($this); ?>