$('.btn-ajax').click(function () {
    var is_confirm = true;
    if ($(this).hasClass('btn-confirm')) {
        confirm_tip = $(this).data('confirm_tip');
        if (! confirm(confirm_tip ? confirm_tip : '确认操作？')) is_confirm = false;
    }

    if (! is_confirm) return false;

    var params = $(this).data('params');
    if (! params) params = {};
    params['_token'] = $(this).data('token');
    var method = $(this).data('method');
    var ajax_method = 'post';
    if (method === 'get' || method === 'GET') {
        ajax_method = 'get'
    } else if (method !== 'post' && method !== 'POST') {
        params['_method'] = method
    }

    $.ajax({
        url: $(this).data('action'),
        type: ajax_method,
        async: false,
        data: params,
        dataType: 'json',
        success: function (res) {
            alert(res.msg)
            if (res.ret) {
                window.location.reload()
            }
        },
        error: function (res, info) {
            alert(info)
        }
    })
});
