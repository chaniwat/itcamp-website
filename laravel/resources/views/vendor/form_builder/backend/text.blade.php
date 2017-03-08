<div class="form-group {{ $field_class }}">
    <label for="{{ $field_id }}">@if(!$hideTitle){{ $title }}@endif</label>

    <input type="{{ $field_type }}" class="form-control" id="{{ $field_id }}" name="{{ $field_id }}" {{ $require ? 'required' : '' }} value="{{ $value }}">
    <small class="form-text text-muted">{!! $description !!}</small>
</div>
