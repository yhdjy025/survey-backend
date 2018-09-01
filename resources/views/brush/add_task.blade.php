<div class="container-fluid">
    <form action="{{ url()->current() }}" method="post" class="form" id="edit-form">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="" class="control-label">分组标识：</label>
            <input type="text" name="group" class="form-control input-sm" value="group1">
        </div>
        <div class="form-group">
            <label for="" class="control-label">数量：</label>
            <input type="text" name="num" class="form-control input-sm" value="">
        </div>
        <div class="form-group">
            <label for="" class="control-label">日期：</label>
            <input type="text" name="day" class="form-control input-sm" value="{{ date('Y-m-d') }}">
        </div>
    </form>
</div>

<script>
    function editSubmit(index) {
        var url = $('#edit-form').attr('action');
        var params = {};
        var foem = $('#edit-form').serializeArray();
        $.each(foem, function (i, v) {
            params[v.name] = v.value;
        })
        $.post(url, params, function (ret) {
            if (ret.status == 1) {
                layer.msg(ret.msg, {icon: 6}, function () {
                    layer.close(index);
                    window.location.reload();
                });
                return true;
            } else {
                layer.msg(ret.msg, {icon: 5});
                return false;
            }
        })
    }
</script>