<style>
    #add-form {
        width: 90%;
        padding: 20px;
    }
    .form-item-s {
        width: 100%;
        min-height: 50px;
        line-height: 30px;
    }
    .form-item-s label {
        width: 100px;
        text-align: right;
        display: inline-block;
        vertical-align: top;
    }
    .form-item-s input,.form-item-s p {
        display: inline-block;
        width: calc(100% - 250px);
        padding-top: calc(.375rem + 1px);
        padding-bottom: calc(.375rem + 1px);
        margin-bottom: 0;
        font-size: inherit;
        line-height: 1.5;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: .25rem;
        transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    }
    .survey-btn {
        display: inline-block;
        font-weight: 400;
        text-align: center;
        white-space: nowrap;
        vertical-align: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        border: 1px solid transparent;
        padding: .375rem .75rem;
        font-size: 1rem;
        line-height: 1.5;
        border-radius: .25rem;
        transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
    .survey-btn-sm {
        line-height: 1;
    }
</style>
<link rel="stylesheet" href="{{ asset('theme/default/layer.css') }}">
<div>
    <form id="add-form" action="post" onsubmit="return false;" :action="{{ url('survey/save') }}">
        <p style="text-align: center">未找到该题目，是否添加该题目。</p>
        <div class="form-item-s">
            <label for="">题干：</label>
            <input id="survey-title" name="title" type="text" value="{{ $title }}">
        </div>
        <div class="form-item-s">
            <label for="">答案：</label>
            <input class="survey-answer" name="answer[]" type="text">
        </div>
        <div class="extra-answer">

        </div>
        <div class="form-item-s">
            <label for="">：</label>
            <button id="add-answer-item" class="">添加一个答案</button>
        </div>
        <div class="form-item-s">
            <label></label>
            <button id="add-survey-btn" class="survey-btn">保存</button>
        </div>
    </form>
</div>
