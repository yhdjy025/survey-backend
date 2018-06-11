
$(function() {
    $('table').on('click', '.delete', function() {
        var url = $(this).data('url');
        var id = $(this).data('id');
        var type = $(this).data('type');
        layer.confirm('确定删除吗？', function(index) {
            layer.close(index);
            $.post(url, {id: id, type: type}, function(ret) {
                if (ret.status == 1) {
                    layer.msg(ret.msg, {icon:6}, function() {
                        window.location.reload();
                    })
                } else {
                    layer.msg(ret.msg, {icon:5});
                    return false;
                }
            });
        }, function(index) {
            layer.close(index);
            return false;
        });
    });
});