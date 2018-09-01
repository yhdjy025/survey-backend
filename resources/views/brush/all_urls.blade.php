@foreach($urls as $url)
    <div class="form-group">
        <label>{{ $url->title }}</label>
        <div class="input-group">
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-sm url-open {{ $url->status == 1 ? 'btn-success' : '' }}"
                                type="button" data-id="{{ $url->id }}">
                            <i class="glyphicon glyphicon-ok"></i>
                        </button>
                      </span>
            <input type="text" name="url7654" class="form-control input-sm" readonly value="{{ $url->url }}"
                   placeholder="{{ $url->title }}">
        </div>
    </div>
@endforeach