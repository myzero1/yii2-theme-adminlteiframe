function applyEcharts(){
    $('div[data-provide="z1echarts"]').each(function() {
        var myChart = echarts.init(document.getElementById($(this).attr('id')));

        var defaultConfig = {
            title: {
                text: '折线图堆叠',
                left: 'center'
            },
            tooltip: {
                trigger: 'axis'
            },
            legend: {
                data:['邮件营销','联盟广告','视频广告'],
                bottom: 0
            },
            grid: {
                left: '0%',
                right: '10px',
                bottom: '30px',
                containLabel: true
            },
            toolbox: {},
            xAxis: {
                type: 'category',
                boundaryGap: false,
                data: ['周一','周二','周三','周四','周五','周六','周日']
            },
            yAxis: {
                type: 'value'
            },
            series: [
                {
                    name:'邮件营销',
                    type:'line',
                    data:[120, 132, 101, 134, 90, 230, 210]
                },
                {
                    name:'联盟广告',
                    type:'line',
                    data:[220, 182, 191, 234, 290, 330, 310]
                },
                {
                    name:'视频广告',
                    type:'line',
                    data:[150, 232, 201, 154, 190, 330, 410]
                }
            ]
        };
        var configSetting = $(this).attr('data-echarts-config');
        if (configSetting=='undefied') {
            configSetting = {};
        } else {
            configSetting = eval('(' + configSetting + ')');
        }
        var config = $.extend({}, defaultConfig, configSetting);

        myChart.setOption(config);
    
    });
}

applyEcharts();