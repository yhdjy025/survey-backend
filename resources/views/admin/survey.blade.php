@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel">
            <div class="panel-heading">
                <h4>调查列表</h4>
                <form action="{{ url()->current() }}" method="get" class="form-inline text-right">
                    <div class="form-group">
                        <label for="" class="control-label">标题：</label>
                        <input type="text" name="title" value="{{ request('title', '') }}"
                               class="form-control input-sm">
                    </div>
                    <input type="submit" class="btn btn-primary btn-sm" value="查找">
                </form>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>标题</th>
                        <th>创建时间</th>
                        <th class="text-right">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ date('Y-m-d H:i', $item->create_at) }}</td>
                            <td class="text-right">
                                <a href="javascript:;" data-url="{{ url('admin/delete') }}" data-type="survey"
                                   data-id="{{ $item->id }}" class="label label-danger delete">删除</a>
                                <a href="javascript:;" data-url="{{ url('admin/editSurvey') }}/{{ $item->id }}"
                                   class="label label-success edit">编辑</a>
                                <a href="{{ url('admin/question') }}/{{ $item->id }}" class="label label-primary">题目</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $list->links() }}
            </div>
        </div>
    </div>
@endsection