@if($list->isEmpty())
    <tr>
        <td colspan="3">
            <p>暂无数据</p>
        </td>
    </tr>
@else
    @foreach($list as $item)
    <tr class="survey-item" data-survey='@json($item)'>
        <td>
            {{ $item->id }}
        </td>
        <td>{{ $item->title }}</td>
        <td>{{ date('Y-m-d H:i', $item->create_at) }}</td>
    </tr>
    @endforeach
@endif