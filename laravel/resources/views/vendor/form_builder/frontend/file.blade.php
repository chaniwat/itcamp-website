<div class="form-group {{ $field_class }}">
    <label class="form-control-label" for="{{ $field_id }}">@if(!$hideTitle){{ $title }}<span class="text-danger">@if($require)*@endif</span>@else&nbsp;@endif</label>
    <input type="{{ $field_type }}" class="form-control-file" id="{{ $field_id }}" name="{{ $field_id }}" {{ $require ? 'required' : '' }}>
    <small class="form-text text-muted">{!! $description !!}</small>
</div>
