@extends('layouts.front')

@section('content')
    <div class="container-fluid">
        <form action="{{ url()->current() }}" method="post" onsubmit="return false;" class="form-horizontal"
              id="edit-form">
            {{ csrf_field() }}

            <div class="form-group">
                <label for="" class="control-label text-right col-xs-2">题目标题：</label>
                <div class="col-xs-9 input-group form-group">
                    <input type="text" name="title" class="form-control input-sm" value="{{ $title or ''}}">
                    <span class="input-group-btn">
                    <button class="btn btn-info btn-sm get-title">获取</button>
                    </span>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="control-label text-right col-xs-2">题型：</label>
                <div class="col-xs-9">
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
                <label for="" class="control-label text-right col-xs-2">答案：</label>
                <div class="col-xs-9">
                    <div>
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#xpath-item" aria-controls="xpath-item" role="tab" data-toggle="tab">xpath</a>
                            </li>
                            <li role="presentation">
                                <a href="#js-item" aria-controls="js-item" role="tab" data-toggle="tab">javascript</a>
                            </li>
                            <li role="presentation">
                                <a href="#answer-item" aria-controls="answer-item" role="tab"
                                   data-toggle="tab">answer</a>
                            </li>
                            <li role="presentation">
                                <a href="#random-item" aria-controls="random-item" role="tab"
                                   data-toggle="tab">全选/随机</a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="xpath-item">
                                <div class="form-group" style="margin-left: 0;">
                                    <a href="javascript:;" data-type="1"
                                       class="btn btn-primary btn-sm add-input">添加一个</a>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="js-item">
                                <div class="form-group" style="margin-left: 0;">
                                <textarea name="script" id="" style="height: 130px;"
                                          class="form-control input-sm" placeholder="js代码"></textarea>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="answer-item">
                                <div class="form-group">
                                    <a href="javascript:;" data-type="2"
                                       class="btn btn-primary btn-sm add-input">添加一个</a>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="random-item">
                                <div class="form-group" style="margin-left: 0;">
                                    <label class="radio-inline">
                                        <input type="radio" name="random-type" value="random">随机但单选
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="random-type" value="randoms">随机多选
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="random-type" value="all">全选
                                    </label>
                                </div>
                                <div class="form-group" style="margin-left: 0;">
                                    <span class="pull-left control-label">除了第</span>
                                    <div class="col-xs-4"><input type="text" class="input-sm form-control" name="except"></div>
                                    <span class="pull-left">个不选（从0开始,多个用英文逗号分开）</span>
                                </div>
                                <div class="input-group form-group col-xs-8" style="margin-left: 0;">
                                    <span class="pull-left control-label">xpath</span>
                                    <div class="col-xs-10">
                                        <input class="input-sm form-control" name="xpath" type="text">
                                    </div>
                                    <span class="input-group-btn">
                                        <button class="btn btn-info btn-sm get-random">获取</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection