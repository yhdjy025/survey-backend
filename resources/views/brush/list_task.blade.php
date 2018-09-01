@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel">
            <div class="panel-heading">
                <h4>任务列表</h4>
                <form action="{{ url()->current() }}" method="get" class="form-inline text-right">
                    <a href="javascript:;" class="btn btn-primary btn-sm" id="add-task">添加任务</a>
                </form>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>日期</th>
                        <th>数量</th>
                        <th>完成数量</th>
                        <th class="text-right">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->id }}</td>
                            <td>{{ $task->day }}</td>
                            <td>{{ $task->num }}</td>
                            <td>{{ $task->completed_num }}</td>
                            <td class="text-right">
                                <a href="{{ url('brush/getTaskInfo') }}/{{ $task->id }}" class="label label-info">详情</a>
                                <a href="javascript:;" data-url="{{ url('brush/deleteTask') }}" data-type="task"
                                   data-id="{{ $task->id }}" class="label label-danger delete">删除</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    $('#add-task').on('click', function () {
        $.get("{{ url('brush/addTask') }}", function (ret) {
            layer.open({
                type: 1,
                title: '添加任务',
                btn: ['确定', '取消'],
                area: ['700px', '400px'],
                content: ret,
                yes: function (index) {
                    editSubmit(index);
                }
            })
        })
    })
</script>
@endsection
