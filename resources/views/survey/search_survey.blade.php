@if($list->isEmpty())
    <tr>
        <td colspan="3">
            <p>暂无数据</p>
        </td>
    </tr>
@else
    @foreach($list as $item)
    <tr>
        <td>
            <input type="radio" data-survey='@json($item)' name="id" value="{{ $item->id }}">
            {{ $item->id }}
        </td>
        <td>{{ $item->title }}</td>
        <td>{{ date('Y-m-d H:i', $item->create_at) }}</td>
    </tr>
    @endforeach
@endif