<div class="container-fluid">
    <form action="{{ url()->current() }}" method="post" onsubmit="return false;" class="form-horizontal" id="edit-form">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="" class="control-label col-sm-2">题目标题：</label>
            <div class="col-sm-9">
                <input type="text" name="title" class="form-control input-sm" value="{{ $title or ''}}">
            </div>
        </div>

        <div class="form-group">
            <label for="" class="control-label col-sm-2">题型：</label>
            <div class="col-sm-9">
                <label for="qtype-1" class="radio-inline">
                    <input type="radio" checked name="type" id="qtype-1" value="1"> 单选/多选
                </label>
                <label for="qtype-2" class="radio-inline">
                    <input type="radio" name="type" id="qtype-2" value="2"> 下拉选择
                </label>
                <label for="qtype-3" class="radio-inline">
                    <input type="radio" name="type" id="qtype-3" value="3"> 填空
                </label>
                <label for="qtype-4" class="radio-inline">
                    <input type="radio" name="type" id="qtype-4" value="4"> 表格选择
                </label>
                <label for="qtype-0" class="radio-inline">
                    <input type="radio" name="type" id="qtype-0" value="0"> 其他
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
                                          class="form-control input-sm" placeholder="js代码"></textarea>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="xpath-item">
                            <div class="form-group">
                                <a href="javascript:;" data-type="1"
                                   class="btn btn-primary btn-sm add-input">添加一个</a>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="answer-item">
                            <div class="form-group">
                                <a href="javascript:;" data-type="2"
                                   class="btn btn-primary btn-sm add-input">添加一个</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>