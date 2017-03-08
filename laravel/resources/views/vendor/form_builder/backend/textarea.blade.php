<div class="form-group {{ $field_class }}">
    <label for="{{ $field_id }}">@if(!$hideTitle){{ $title }}@endif</label>
    <textarea class="form-control" id="{{ $field_id }}" name="{{ $field_id }}" rows="3">{{ $value }}</textarea>
    <small class="form-text text-muted">{!! $description !!}</small>
</div>