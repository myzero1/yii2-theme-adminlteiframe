function applyz1datarangepicker(){
    $('input[data-provide="z1datarangepicker"]').each(function() {
        $(this).after('<i style="line-height:32px;font-size:20px;right:5px;position:absolute;" class="z1datarangepicker-icon glyphicon glyphicon-calendar fa fa-calendar"></i>');
        
        var defaultConfig = {
            "timePicker": true,
            "timePicker24Hour": true,
            "linkedCalendars": false,
            "autoUpdateInput": false,
            "locale": {
                format: 'YYYY-MM-DD',
                separator: ' ~ ',
                daysOfWeek: ["日","一","二","三","四","五","六"],
                monthNames: ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
                applyLabel: "应用",
                cancelLabel: "取消",
                resetLabel: "重置"
            }};
        var configSetting = $(this).attr('data-z1datarangepicker-config');
        if (configSetting=='undefied') {
            configSetting = {};
        } else {
            configSetting = eval('(' + configSetting + ')');
        }
        var config = $.extend({}, defaultConfig, configSetting);

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

            if ($(this).val() == '') { // 点击当天不起作用
                $(this).val(moment().format(config.locale.format));
            }
            if ($(this).val() == '1970-01-01') { // 清空
                $(this).val('');
                picker.setStartDate(moment().format(config.locale.format));
            }
        });

        // $(this).on('show.daterangepicker', function(ev, picker) {
        //     console.log('show.daterangepicker');
        //     console.log(moment().format('YYYY-MM-DD'));
        //     console.log($(this));
        //     if ($(this).val() == '') {
        //         // $(this).val(picker.startDate.format('YYYY-MM-DD'));
        //         $(this).val(moment().format('YYYY-MM-DD'));
        //     }
        //     if ($(this).val() == 'Invalid date') {
        //         $(this).val('');
        //     }
        // });

        // $(this).on('hide.daterangepicker', function(ev, picker) {
        //     console.log('hide.daterangepicker');
        //     console.log($(this).val());
        //     if ($(this).val() == '') {
        //         // $(this).val(picker.startDate.format('YYYY-MM-DD'));
        //         console.log(moment().format('YYYY-MM-DD'));
        //         $(this).val(moment().format('YYYY-MM-DD'));
        //     }
        // });
    });
}

applyz1datarangepicker();