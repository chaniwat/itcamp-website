<div class="form-group {{ $field_class }}">
    <label for="{{ $field_id }}">@if(!$hideTitle){{ $title }}@endif</label>

    <select class="form-control" id="{{ $field_id }}" name="{{ $field_id }}">
        @foreach($lists as $item)
            <option value="{{ $item['key'] }}" {{ $item['key'] == $value ? 'selected' : '' }}>{{ $item['text'] }}</option>
        @endforeach
    </select>
    <small class="form-text text-muted">{{ $description }}</small>
</div>