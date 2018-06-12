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
                </form>

            </div>
        </div>
    </div>
</div>