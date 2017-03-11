<fieldset class="form-group {{ $field_class }}">
    <legend>@if(!$hideTitle){{ $title }}<span class="text-danger">@if($require)*@endif</span>@else&nbsp;@endif</legend>
    @foreach($lists as $item)
        <div class="form-check">
            <label class="form-check-label">
                <input type="radio" class="form-check-input" id="{{ $field_id }}" name="{{ $field_id }}" value="{{ $item['key'] }}" {{ $item['key'] == $value ? 'checked' : '' }} disabled>
                {{ $item['text'] }}
            </label>
        </div>
    @endforeach
    <small class="form-text text-muted">{!! $description !!}</small>
</fieldset>