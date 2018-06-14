<div class="container-fluid">
    <div id="survey-option">
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active" data-action="search">
                <a href="#search-action" aria-controls="search-action" role="tab" data-toggle="tab">搜索调查</a>
            </li>
            <li role="presentation" data-action="add">
                <a href="#add-action" aria-controls="add-action" role="tab" data-toggle="tab">添加调查</a>
            </li>
        </ul>

        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="search-action">
                <form action="{{ url('chrome/searchSurvey') }}" class="form-inline pull-right">
                    <div class="input-group">
                        <span class="input-group-addon">标题：</span>
                        <input type="text" class="form-control input-sm" id="survey-title-input">
                        <span class="input-group-btn">
                            <a href="javascript:;" id="survey-search-btn" class="btn btn-primary btn-sm">搜索</a>
                        </span>
                    </div>
                </form>
                <div class="form-group">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>标题</th>
                            <th>创建时间</th>
                        </tr>
                        </thead>
                        <tbody id="survey-list">

                        </tbody>
                    </table>
                </div>
            </div>
            <div role="tabpanel" class="tab-pane" id="add-action">
                <form action="{{ url('chrome/addSurvey') }}" method="post" class="form-horizontal" id="edit-form">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="" class="control-label col-sm-2">调查标题：</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control input-sm" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-2">题干选择器：</label>
                        <div class="col-sm-10">
                            <textarea name="get_title" class="form-control input-sm"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-2">下一题选择器：</label>
                        <div class="col-sm-10">
                            <textarea name="next" class="form-control input-sm"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-2">作答之前的JS：</label>
                        <div class="col-sm-10">
                            <textarea name="before" class="form-control input-sm"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label col-sm-2">作答之后的JS：</label>
                        <div class="col-sm-10">
                            <textarea name="after" class="form-control input-sm"></textarea>
                        </div>
                    </div>
                    <p class="bg-danger">
                        提示：题干选择器用于获取题目标题，下一题选择器是用于点击下一题按钮用的，（选择器可以是jquery选择器和xpath，如果是xpath请再前面加@做标识）
                        标题的获取也可以用作答之前的JS来实现，格式为: title = $('#title').text();  js选择或者选择器任选。
                    </p>
                </form>

            </div>
        </div>
    </div>
</div>