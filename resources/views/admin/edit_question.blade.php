<div class="container-fluid">
    <form action="{{ url()->current() }}" method="post" class="form-horizontal" id="edit-form">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="" class="control-label col-sm-2">题目标题：</label>
            <div class="col-sm-9">
                <input type="text" name="title" class="form-control input-sm" value="{{ $question->title }}">
            </div>
        </div>

        <div class="form-group">
            <label for="" class="control-label col-sm-2">题型：</label>
            <div class="col-sm-9">
                <label for="qtype-1" class="radio-inline">
                    <input @if($question->type == 1)checked @endif type="radio" name="type" id="qtype-1" value="1"> 单选/多选
                </label>
                <label for="qtype-2" class="radio-inline">
                    <input @if($question->type == 2)checked @endif type="radio" name="type" id="qtype-2" value="2"> 下拉选择
                </label>
                <label for="qtype-3" class="radio-inline">
                    <input @if($question->type == 3)checked @endif type="radio" name="type" id="qtype-3" value="3"> 填空
                </label>
                <label for="qtype-4" class="radio-inline">
                    <input @if($question->type == 4)checked @endif type="radio" name="type" id="qtype-4" value="4"> 表格选择
                </label>
                <label for="qtype-0" class="radio-inline">
                    <input @if($question->type == 0)checked @endif type="radio" name="type" id="qtype-0" value="0"> 其他
                </label>
            </div>
        </div>

        <div class="form-group">
            <label for="" class="control-label col-sm-2">答案：</label>
            <div class="col-sm-9">
                <div>
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#js-item" aria-controls="js-item" role="tab" data-toggle="tab">javascript</a>
                        </li>
                        <li role="presentation">
                            <a href="#xpath-item" aria-controls="xpath-item" role="tab" data-toggle="tab">xpath</a>
                        </li>
                        <li role="presentation">
                            <a href="#answer-item" aria-controls="answer-item" role="tab" data-toggle="tab">answer</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="js-item">
                            <div class="form-group">
                                <textarea name="script" id=""
                                          class="form-control input-sm" placeholder="js代码">{{ $question->script }}</textarea>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="xpath-item">
                            @foreach($question->xpath as $xpath)
                                <div class="input-group form-group">
                                    <div class="col-sm-6">
                                        <input type="text" name="xpath" class="form-control input-sm" placeholder="xpath"
                                               value="{{ $xpath[0] }}">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="value" class="form-control input-sm" placeholder="值，下拉和填空需要"
                                               value="{{ $xpath[1] }}">
                                    </div>
                                    <span class="input-group-btn">
                                        <button onclick="removeInput(this)" class="btn btn-danger btn-sm">删除</button>
                                    </span>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <a href="javascript:;" onclick="addInput(this, 1);"
                                   class="btn btn-primary btn-sm">添加一个</a>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="answer-item">
                            @foreach($question->answer as $answer)
                                <div class="input-group form-group">
                                    <input type="text" name="answer" class="form-control input-sm" placeholder="答案"
                                           value="{{ $answer }}">
                                    <span class="input-group-btn">
                                        <button onclick="removeInput(this, 2)" class="btn btn-danger btn-sm">删除</button>
                                    </span>
                                </div>
                            @endforeach
                            <div class="form-group">
                                <a href="javascript:;" onclick="addInput(this, 2);"
                                   class="btn btn-primary btn-sm">添加一个</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

<script>
    function editSubmit(index) {
        var url = $('#edit-form').attr('action');
        var params = {
            _token: $('#edit-form').find('input[name=_token]').val(),
            title: $('#edit-form').find('input[name=title]').val(),
            type: $('#edit-form').find('input[name=type]:checked').val(),
            script: $('#edit-form').find('textarea[name=script]').val(),
            xpath: [],
            answer: []
        };
        $('#xpath-item').find('.input-group').each(function (i, v) {
            var kv = [
                $(this).find('input[name=xpath]').val(),
                $(this).find('input[name=value]').val()
            ];
            if (kv[0] != '') {
                params.xpath.push(kv);
            }
        })
        $('#answer-item').find('.input-group').each(function (i, v) {
            var answer = $(this).find('input[name=answer]').val();
            if (answer != '') {
                params.answer.push(answer);
            }
        })
        $.post(url, params, function (ret) {
            if (ret.status == 1) {
                layer.msg(ret.msg, {icon: 6}, function () {
                    layer.close(index);
                });
                return true;
            } else {
                layer.msg(ret.msg, {icon: 5});
                return false;
            }
        })
    }

    function addInput(obj, type) {
        if (1 == type) {
            var input = '   <div class="input-group form-group">\n' +
                '                                <div class="col-sm-6"><input type="text" name="xpath" class="form-control input-sm" value="" placeholder="xpath"></div>' +
                '                                <div class="col-sm-6"><input type="text" name="value" class="form-control input-sm" value="" placeholder="值，下拉和填空需要"></div>' +
                '                                    <span class="input-group-btn">' +
                '                                        <button onclick="removeInput(this)" class="btn btn-danger btn-sm">删除</button>' +
                '                                    </span>' +
                '                                </div>';
        } else {
            var input = '   <div class="input-group form-group">\n' +
                '                                <input type="text" name="answer" class="form-control input-sm" value="" placeholder="答案">' +
                '                                    <span class="input-group-btn">' +
                '                                        <button onclick="removeInput(this)" class="btn btn-danger btn-sm">删除</button>' +
                '                                    </span>' +
                '                                </div>';
        }
        $(obj).parent('.form-group').before(input);
    }

    function removeInput(obj) {
        $(obj).parents('.input-group').remove();
    }

</script>