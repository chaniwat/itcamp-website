<div class="form-group {{ $field_class }}">
    <label for="{{ $field_id }}">@if(!$hideTitle){{ $title }}<span class="text-danger">@if($require)*@endif</span>@else&nbsp;@endif</label>

    <div>
        <a href="{{ asset('storage/'.$value) }}" class="btn btn-primary" target="-_blank">ดูไฟล์ที่แนบ</a>
    </div>
    <small class="form-text text-muted">{!! $description !!}</small>
</div>
