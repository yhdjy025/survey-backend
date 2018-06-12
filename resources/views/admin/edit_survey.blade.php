<div class="container-fluid">
    <form action="{{ url()->current() }}" method="post" class="form-horizontal" id="edit-form">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="" class="control-label col-sm-2">调查标题：</label>
            <div class="col-sm-10">
                <input type="text" name="title" class="form-control input-sm" value="{{ $survey->title }}">
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-2">作答之前的JS：</label>
            <div class="col-sm-10">
                <textarea name="before" id="" class="form-control input-sm">{{ $survey->before }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-2">作答之后的JS：</label>
            <div class="col-sm-10">
                <textarea name="after" id="" class="form-control input-sm">{{ $survey->after }}</textarea>
            </div>
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
                layer.msg(ret.msg, {icon:6}, function () {
                    layer.close(index);
                });
                return true;
            }  else {
                layer.msg(ret.msg, {icon:5});
                return false;
            }
        })
    }
</script>