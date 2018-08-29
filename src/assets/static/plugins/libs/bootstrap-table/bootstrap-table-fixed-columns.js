/**
 * @author rioli <cjtty2@gmail.com>
 * @version: v1.0.1
 */

(function ($) {
    'use strict';

    $.extend($.fn.bootstrapTable.defaults, {
        fixedColumns: false,
        leftFixedNumber: 1,
        rightFixedNumber: 1,
        rightPostion: 0
    });

    var BootstrapTable = $.fn.bootstrapTable.Constructor,
        _initHeader = BootstrapTable.prototype.initHeader,
        _initBody = BootstrapTable.prototype.initBody,
        _resetView = BootstrapTable.prototype.resetView;

    BootstrapTable.prototype.initFixedColumns = function () {
        this.$fixedHeader = $([
            '<div class="fixed-table-header-columns header-left">',
            '<table>',
            '<thead></thead>',
            '</table>',
            '</div>',
            '<div class="fixed-table-header-columns-background">',
            '</div>',
            '<div class="fixed-table-header-columns header-right">',
            '<table>',
            '<thead></thead>',
            '</table>',
            '</div>'
            ].join(''));

        this.timeoutHeaderColumns_ = 0;

        this.$fixedHeader.find('table').attr('class', this.$el.attr('class'));

        this.$fixedHeaderLeftColumns = this.$fixedHeader.find('thead').first();
        this.$fixedHeaderRightColumns = this.$fixedHeader.find('thead').last();

        // this.$fixedHeader.last().css({ right: 17 });

        this.$tableHeader.before(this.$fixedHeader);

        this.$fixedBody = $([
            '<div class="fixed-table-body-columns body-left">',
            '<table>',
            '<tbody></tbody>',
            '</table>',
            '</div>',
            '<div class="fixed-table-body-columns body-right">',
            '<table>',
            '<tbody></tbody>',
            '</table>',
            '</div>'
            ].join(''));

        this.timeoutBodyColumns_ = 0;

        this.$fixedBody.find('table').attr('class', this.$el.attr('class'));

        this.$fixedLeftBody = this.$fixedBody.find('tbody').first();
        this.$fixedRightBody = this.$fixedBody.find('tbody').last();

        this.$tableBody.before(this.$fixedBody);

        // set rightPostion
        function getScrollbarWidth() {
            var odiv = document.createElement('div'),//创建一个div
                styles = {
                    width: '100px',
                    height: '100px',
                    overflowY: 'scroll'//让他有滚动条
                }, i, scrollbarWidth;
            odiv.id = 'getScrollbarWidth';
            for (i in styles) odiv.style[i] = styles[i];
            document.body.appendChild(odiv);//把div添加到body中
            scrollbarWidth = odiv.offsetWidth - odiv.clientWidth;//相减
            // odiv.remove();//移除创建的div
            $('#getScrollbarWidth').remove();
            return scrollbarWidth;//返回滚动条宽度
        }

        function rightPostion(fixed){
            if ($(".fixed-table-body").height() > fixed.options.height) {//有垂直滚动条
                return getScrollbarWidth();
            } else {
                return 0;
            }
        }

        this.options.rightPostion = rightPostion(this);

        this.$fixedHeader.last().css({ right: this.options.rightPostion });
        this.$fixedBody.last().css({ right: this.options.rightPostion });
    };

    BootstrapTable.prototype.initHeader = function () {
        _initHeader.apply(this, Array.prototype.slice.apply(arguments));

        if (!this.options.fixedColumns) {
            return;
        }

        this.initFixedColumns();

        var that = this;
        var $trsLeft = this.$header.find('tr').clone();
        var $trsRight = this.$header.find('tr').clone();
        
        $trsLeft.each(function () {
            $(this).find('th:gt(' + (that.options.leftFixedNumber-1) + ')').remove();
        });
        this.$fixedHeaderLeftColumns.html('').append($trsLeft);

        $trsRight.each(function () {
            var index = that.options.columns[0].length - Math.abs(parseInt(that.options.rightFixedNumber));
            $(this).find('th:lt(' + index + ')').remove();
        });
        this.$fixedHeaderRightColumns.html('').append($trsRight);
    };

    BootstrapTable.prototype.initBody = function () {
        _initBody.apply(this, Array.prototype.slice.apply(arguments));

        if (!this.options.fixedColumns) {
            return;
        }

        var that = this,
            rowspan = 0;

        // fixedLeftBody
        this.$fixedLeftBody.html('');
        this.$body.find('> tr[data-index]').each(function () {
            var $tr = $(this).clone(),
                $tds = $(this).find('td'); // Change $tr to $(this)

            $tr.html('');
            var end = that.options.leftFixedNumber;

            if (rowspan > 0) {
                --end;
                --rowspan;
            }
            
            for (var i = 0; i < end; i++) {
                $tr.append($tds.eq(i).clone());
            }

            that.$fixedLeftBody.append($tr);

            if ($tds.eq(0).attr('rowspan')) {
                rowspan = $tds.eq(0).attr('rowspan') - 1;
            }
        });

        // fixedRightBody
        this.$fixedRightBody.html('');
        this.$body.find('> tr[data-index]').each(function () {
            var $tr = $(this).clone(),
                $tds = $(this).find('td'); // Change $tr to $(this)

            $tr.html('');
            var end = that.options.columns[0].length - Math.abs(parseInt(that.options.rightFixedNumber));

            if (rowspan > 0) {
                --end;
                --rowspan;
            }

            for (var i = end; i < that.options.columns[0].length; i++) {
                $tr.append($tds.eq(i).clone());
            }

            that.$fixedRightBody.append($tr);

            if ($tds.eq(0).attr('rowspan')) {
                rowspan = $tds.eq(0).attr('rowspan') - 1;
            }
        });
    };

    BootstrapTable.prototype.resetView = function () {
        _resetView.apply(this, Array.prototype.slice.apply(arguments));

        if (!this.options.fixedColumns) {
            return;
        }

        clearTimeout(this.timeoutHeaderColumns_);
        this.timeoutHeaderColumns_ = setTimeout($.proxy(this.fitHeaderColumns, this), this.$el.is(':hidden') ? 100 : 0);

        clearTimeout(this.timeoutBodyColumns_);
        this.timeoutBodyColumns_ = setTimeout($.proxy(this.fitBodyColumns, this), this.$el.is(':hidden') ? 100 : 0);
    };

    BootstrapTable.prototype.fitHeaderColumns = function () {
        var that = this,
            visibleFields = this.getVisibleFields(),
            headerWidth = 0,
            leftHeaderWidth = 0,
            rightHeaderWidth = 0;

        // right
        var trs = [].slice.call(this.$body.find('tr:first-child:not(.no-records-found) > *'));
        var $trs = $(trs.reverse());
        $trs.each(function (i) {
            var $this = $(this);
            var index = i;
            if (i >= Math.abs(that.options.rightFixedNumber)) {
                return false;
            }

            if (that.options.detailView && !that.options.cardView) {
                index = i - 1;
            }
            that.$fixedHeader.find('th[data-field="' + visibleFields[$trs.length - 1 + index] + '"]')
                .find('.fht-cell').width($this.innerWidth());
            rightHeaderWidth += $this.outerWidth();
        });
        that.$header.find('> tr').each(function (i) {
          that.$fixedHeader.height($(this).height());
        });

        this.$fixedHeader.last().width(rightHeaderWidth + 1).show();


        // left 
        this.$body.find('tr:first-child:not(.no-records-found) > *').each(function (i) {
            var $this = $(this),
                index = i;
            if (i >= that.options.leftFixedNumber) {
                return false;
            }
            if (that.options.detailView && !that.options.cardView) {
                index = i - 1;
            }
            that.$fixedHeader.find('th[data-field="' + visibleFields[index] + '"]')
                .find('.fht-cell').width($this.innerWidth());
            leftHeaderWidth += $this.outerWidth();
        });

        this.$fixedHeader.first().width(leftHeaderWidth + 1).show();
    };

    BootstrapTable.prototype.fitBodyColumns = function () {
        var that = this,
            top = -(parseInt(this.$el.css('margin-top')) - 2),
            // the fixed height should reduce the scorll-x height
            height = this.$tableBody.height() - 18;
            // console.log("fitBodyColumns" + height);

        if (!this.$body.find('> tr[data-index]').length) {
            this.$fixedBody.hide();
            return;
        }

        if (!this.options.height) {
            top = this.$fixedHeader.height();
            // console.log("fitBodyColumns header Height" + top);
            height = height - top;
        }

        // height = this.$tableBody.find("tbody").height();
        // left
        this.$fixedBody.first().css({
            width: this.$fixedHeader.first().width(),
            height: height,
            top: top-1
        }).show();

        // right
        this.$fixedBody.last().css({
            width: this.$fixedHeader.last().width(),
            height: height,
            top: top-1
        }).show();

        this.$body.find('> tr').each(function (i) {
            that.$fixedBody.find('tr:eq(' + i + ')').height($(this).height());
        });

        // events
        this.$tableBody.on('scroll', function () {
            that.$fixedBody.find('table').css('top', -$(this).scrollTop());
        });
        this.$body.find('> tr[data-index]').off('hover').hover(function () {
            var index = $(this).data('index');
            that.$fixedBody.find('tr[data-index="' + index + '"]').addClass('hover');
        }, function () {
            var index = $(this).data('index');
            that.$fixedBody.find('tr[data-index="' + index + '"]').removeClass('hover');
        });
        this.$fixedBody.find('tr[data-index]').off('hover').hover(function () {
            var index = $(this).data('index');
            that.$body.find('tr[data-index="' + index + '"]').addClass('hover');
        }, function () {
            var index = $(this).data('index');
            that.$body.find('> tr[data-index="' + index + '"]').removeClass('hover');
        });
        fixFixedRightColumnsEvents.call(this);
    };

    function fixFixedRightColumnsEvents() {
        var that = this;

        var fixedBeginIndex = that.options.columns[0].length - 1 - that.options.fixedNumber;
        $.each(this.header.events, function (i, events) {
            if (i < fixedBeginIndex) {
                return;
            }
            if (!events) {
                return;
            }
            // fix bug, if events is defined with namespace
            if (typeof events === 'string') {
                events = calculateObjectValue(null, events);
            }

            var field = that.header.fields[i];
            var fieldIndex = $.inArray(field, that.getVisibleFields());

            if (fieldIndex === -1) {
                return;
            }

            if (that.options.detailView && !that.options.cardView) {
                fieldIndex += 1;
            }

            for (var key in events) {
                that.$fixedBodyColumns.find('>tr:not(.no-records-found)').each(function () {
                    var $tr = $(this),
                        $td = $tr.find(that.options.cardView ? '.card-view' : 'td').eq(fieldIndex - fixedBeginIndex - 1),
                        index = key.indexOf(' '),
                        name = key.substring(0, index),
                        el = key.substring(index + 1),
                        func = events[key];

                    $td.find(el).off(name).on(name, function (e) {
                        var index = $tr.data('index'),
                            row = that.data[index],
                            value = row[field];

                        func.apply(this, [e, value, row, index]);
                    });
                });
            }
        });

    }

})(jQuery);
