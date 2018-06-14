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
            <label for="" class="control-label col-sm-2">题干选择器：</label>
            <div class="col-sm-10">
                <textarea name="get_title" class="form-control input-sm">{{ $survey->get_title }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-2">下一题选择器：</label>
            <div class="col-sm-10">
                <textarea name="next" class="form-control input-sm">{{ $survey->next }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-2">作答之前的JS：</label>
            <div class="col-sm-10">
                <textarea name="before" class="form-control input-sm">{{ $survey->before }}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label for="" class="control-label col-sm-2">作答之后的JS：</label>
            <div class="col-sm-10">
                <textarea name="after" class="form-control input-sm">{{ $survey->after }}</textarea>
            </div>
        </div>
        <p class="bg-danger">
            提示：题干选择器用于获取题目标题，下一题选择器是用于点击下一题按钮用的，（选择器可以是jquery选择器和xpath，如果是xpath请再前面加@做标识）
            标题的获取也可以用作答之前的JS来实现，格式为: title = $('#title').text();  js选择或者选择器任选。
        </p>
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