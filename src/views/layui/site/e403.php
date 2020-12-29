<div class="z1msg">
<!--         <div class="ufo">
        <i class="seraph icon-test ufo_icon"></i>
        <i class="layui-icon page_icon">&#xe638;</i>
    </div> -->
    <div class="z1tip">
        <i class="z1iconfont z1icon-tip-layout"></i>
        <span style="font-size: 3.5em;margin-top: -1.6em;margin-left: -0.85em;position: absolute;">403</span>
        <p>叫你乱跑，没权限被拦住了吧！将于<span class="layui-red" id="go-home-time">30</span>秒后带你回首页。</p>
    </div>
</div>

<?php
    $homeUrl = yii\helpers\Url::to(['main']);
    $js = <<<JS
    var countdown = 30;
    var si = setInterval(function() {
        if (countdown>=0){
            $('#go-home-time').text(countdown--);
        } else {
            window.clearInterval(si);
            window.location.href="$homeUrl";
        }

    },1000);
JS;

    $this->registerJs($js);
?>