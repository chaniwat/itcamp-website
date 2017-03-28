<div class="form-group {{ $field_class }}">
    <label class="form-control-label" for="{{ $field_id }}">@if(!$hideTitle){{ $title }}<span class="text-danger">@if($require)*@endif</span>@else&nbsp;@endif</label>
    <div class="custom-controls-stacked">
        @foreach($lists as $item)
        <label class="custom-control custom-checkbox" style="font-size: 1rem;">
            <input type="checkbox" class="custom-control-input" id="{{ $field_id }}" name="{{ $field_id }}[]" value="{{ $item['key'] }}" {{ old($field_id) && in_array($item['key'], old($field_id)) ? 'checked' : '' }}>
            <span class="custom-control-indicator"></span>
            <span class="custom-control-description" style="padding-top: 1px;">{{ $item['text'] }}</span>
        </label>
        @endforeach
    </div>
    <small class="form-text text-muted">{!! $description !!}</small>
</div>