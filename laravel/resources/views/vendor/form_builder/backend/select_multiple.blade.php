<div class="form-group {{ $field_class }}">
    <label for="{{ $field_id }}">@if(!$hideTitle){{ $title }}<span class="text-danger">@if($require)*@endif</span>@else&nbsp;@endif</label>

    <select multiple class="form-control" id="{{ $field_id }}" name="{{ $field_id }}" disabled>
        @foreach($lists as $item)
            <option value="{{ $item->key }}" {{ in_array($item['key'], $value) ? 'selected' : '' }}>{{ $item->text }}</option>
        @endforeach
    </select>
    <small class="form-text text-muted">{!! $description !!}</small>
</div>