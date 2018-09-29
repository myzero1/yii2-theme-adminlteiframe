function applyz1datarangepicker(){
    $('input[data-provide="z1datarangepicker"]').each(function() {
        $(this).after('<i style="line-height:32px;font-size:20px;right:5px;position:absolute;" class="z1datarangepicker-icon glyphicon glyphicon-calendar fa fa-calendar"></i>');
        
        var defaultConfig = {
            "timePicker": true,
            "timePicker24Hour": true,
            "linkedCalendars": false,
            "autoUpdateInput": false,
            "autoUpdateInput": false,
            "locale": {
                format: 'YYYY-MM-DD',
                separator: ' ~ ',
                daysOfWeek: ["日","一","二","三","四","五","六"],
                monthNames: ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
                applyLabel: "应用",
                cancelLabel: "取消",
                clearLabel: "清空",
                customRangeLabel: '自定义'
            }};
        var configSetting = $(this).attr('data-z1datarangepicker-config');
        if (configSetting=='undefied') {
            configSetting = {};
        } else {
            configSetting = eval('(' + configSetting + ')');
        }
        var config = $.extend({}, defaultConfig, configSetting);

/*
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        */

        if (config.ranges != undefined) {
            config.ranges[config.locale.clearLabel] = ["1970-01-01", "1970-01-01"];
        }

        if (config.singleDatePicker === true) {
            $(this).daterangepicker(config, function(start, end, label) {
                beginTimeTake = start;
                if(!this.startDate){
                    this.element.val('');
                }else{
                    this.element.val(this.startDate.format(this.locale.format));
                }
            });
        } else {
            $(this).daterangepicker(config, function(start, end, label) {
                beginTimeStore = start;
                endTimeStore = end;
                if(!this.startDate){
                    this.element.val('');
                }else{
                    this.element.val(this.startDate.format(this.locale.format) + this.locale.separator + this.endDate.format(this.locale.format));
                }
            });
        }

        $(this).on('apply.daterangepicker', function(ev, picker) {
            // 点击当天不起作用
            if ($(this).val() == '') {
                $(this).val(moment().format(config.locale.format));
            }

            // 在range中添加清空
            if ($(this).val() == '1970-01-01' || $(this).val() == '1970-01-01'+config.locale.separator+'1970-01-01') {
                $(this).val('');
                picker.setStartDate(moment().format(config.locale.format));
            }
        });
    });
}

applyz1datarangepicker();