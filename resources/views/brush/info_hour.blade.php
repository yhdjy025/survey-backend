@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel">
            <div class="panel-heading">
                <h4>任务小时详情</h4>
            </div>
            <div class="panel-body">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>时间（小时）</th>
                        <th>IP</th>
                        <th>Port</th>
                        <th>添加时间</th>
                        <th>间隔时间</th>
                        <th>完成时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($hourInfo as $info)
                        <tr>
                            <td>{{ $info->hour }}</td>
                            <td>{{ $info->ip }}</td>
                            <td>{{ $info->port }}</td>
                            <td>{{ date('Y-m-d H:i:s', $info->created_at) }}</td>
                            <td>{{ $info->time }}</td>
                            <td>{{ date('Y-m-d H:i:s', $info->created_at + $info->time) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
