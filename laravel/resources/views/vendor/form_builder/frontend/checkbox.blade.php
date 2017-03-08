<fieldset class="form-group {{ $field_class }}">
    <legend>{{ $title }}</legend>
    @foreach($lists as $item)
        <div class="form-check">
            <label class="form-check-label">
                <input type="checkbox" class="form-check-input" id="{{ $field_id }}" name="{{ $field_id }}[]" value="{{ $item['key'] }}">
                {{ $item['text'] }}
            </label>
        </div>
    @endforeach
    <small class="form-text text-muted">{{ $description }}</small>
</fieldset>