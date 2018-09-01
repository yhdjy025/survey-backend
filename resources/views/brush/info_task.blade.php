@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel">
            <div class="panel-heading">
                <h4>任务列表</h4>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>时间（小时）</th>
                        <th>数量</th>
                        <th>完成数量</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($taskInfo as $hour)
                        <tr>
                            <td>{{ $hour->hour }}</td>
                            <td>{{ $hour->num }}</td>
                            <td>{{ $hour->completed_num }}</td>
                            <td>
                                <a href="{{ url('brush/getHourInfo') }}?taskId={{ $hour->task_id }}&hour={{ $hour->hour }}" class="label label-info">详情</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
