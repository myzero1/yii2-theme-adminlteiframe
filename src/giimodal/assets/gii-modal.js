$(function(){
    $(document).on('click', '.show-modal',  function(){
        var self = $(this),
        	// target = $(self.attr('data-target')),
        	// window.parent.$("#modal").modal()
        	target = $(self.attr('data-target')),
            ajax_url = self.attr('data-url') || self.attr('href'),
            header = self.attr('data-header')||'';
            confirm_msg = self.attr('confirm-msg')||'';
		var h4 = target.find('.modal-header').find('h4');
		if (h4.length === 0) {
		    $('<h4>'+header+'</h4>').appendTo(target.find('.modal-header'));
		} else {
			h4.text(header);
		}
// console.log(confirm_msg!='');return false
		if (confirm_msg!='') {
			var body = target.modal('show').find('.modal-body').empty();
			body.html('<div class="confirm_msg">'+confirm_msg+'</div><div class="confirm_btn"><a class="btn btn-danger" href="'+ajax_url+'" data-ajax >删除</a></div>');
			return false;
		} else if (ajax_url) {
        	var body = target.modal('show').find('.modal-body').empty();
            body.html('<iframe src="/site/change-pw"></iframe>');
      //   	$.ajax({
    		// 	url: ajax_url,
    		// 	success: function (response) {
    		// 		body.html(response);
      //               if ($('input[data-provide="z1datarangepicker"]').length > 0) {
      //                   applyz1datarangepicker();
      //               }
    		// 	},
    		// 	error: function (jqXHR) {
    		// 		body.html('<div class="error-summary">'+jqXHR.responseText+'</div>');
    		// 	}
    		// });
        	return false;
        }
    });
    $(document).on('submit', 'form[data-ajax]', function(event) {
    	event.preventDefault();
		var formData = new FormData(this);
		var form = $(this);
        // var body = form.closest('.modal-body').empty();
		var body = form.closest('.modal-body');
        var loading = '<div id="submitting-loading" class="blockUI blockMsg blockElement" style="line-height:50;z-index: 1011; position: absolute; padding: 0px; margin: 0px; height:100%; width: 100%; top: 0; left: 0;background: rgba(0, 0, 0, 0.35); text-align: center; color: rgb(0, 0, 0); border: 0px; cursor: wait;"><div style="line-height:22px;height:44px;" class="loading-message loading-message-boxed"><span>&nbsp;&nbsp;提交中......</span></div></div>'
        form.closest('.modal-content').append(loading);

		// submit form
		$.ajax({
			url: form.attr('action'),
			type: 'post',
			enctype: 'multipart/form-data',
			processData: false,  // tell jQuery not to process the data
			contentType: false,   // tell jQuery not to set contentType
			data: formData,
			success: function (response) {
                $("#submitting-loading").remove();

                if(typeof response == 'object'){
                    if( typeof response.length != 'number' ){
                    	window.location.href=response.url;
                        $('#modal_view .close').click();
                    }
                }else{
                    form.closest('.modal-body').html(response);
                }

				// body.html(response);
			},
			error: function (jqXHR, textStatus, errorThrown) {
				body.html('<div class="error-summary">'+jqXHR.responseText+'</div>');
			}
		});
		return false;
	});
	$('body').on('click', 'a[data-ajax]', function () {
		var self = $(this);
		// var	modal_body = self.closest('.modal-body').empty();
		var	modal_body = self.closest('.modal-body');
        var loading = '<div id="submitting-loading" class="blockUI blockMsg blockElement" style="line-height:50;z-index: 1011; position: absolute; padding: 0px; margin: 0px; height:100%; width: 100%; top: 0; left: 0;background: rgba(0, 0, 0, 0.35); text-align: center; color: rgb(0, 0, 0); border: 0px; cursor: wait;"><div style="line-height:22px;height:44px;" class="loading-message loading-message-boxed"><span>&nbsp;&nbsp;提交中......</span></div></div>'
        $('.modal-content').append(loading);
		$.ajax({
			url: self.attr('href'),
			type: 'post',
			success: function (response) {
                $("#submitting-loading").remove();

                if(typeof response == 'object'){
                    if( typeof response.length != 'number' ){
                        window.location.href=response.url;
                        $('#modal_view .close').click();
                    }
                }else{
                    form.closest('.modal-body').html(response);
                }

				// modal_body.html(response);
			},
			error: function (jqXHR) {
				modal_body.html('<div class="error-summary">'+jqXHR.responseText+'</div>');
			}
		});
		return false;
	});
	$('body').on('mouseenter', '#delete-selected', function () {
		var ids = $(".adminlteiframe-gridview").yiiGridView("getSelectedRows");
		var idsStr = ids.join(',');
		var href = $(this).attr('href');
		var base = href.split('ids=');
		var hrefNew = base[0] + 'ids=' + idsStr
		$(this).attr('href', hrefNew);
		return false;
	});
});