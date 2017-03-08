<div class="form-group {{ $field_class }}">
    <label for="{{ $field_id }}">@if(!$hideTitle){{ $title }}@endif</label>

    <div>
        <a href="/storage/{{ $value }}" class="btn btn-primary" target="-_blank">ดูใบ ปพ.1</a>
    </div>
    <small class="form-text text-muted">{{ $description }}</small>
</div>
