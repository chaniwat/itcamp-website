<label class="control-label">{{ $title }}@if($require)<span class="text-danger">*</span>@endif</label>
<fieldset id="{{ $id }}">
    @foreach($lists as $list)
        <label class="{{ $type }}-inline">
            <input type="{{ $type }}" name="{{ $id }}[]" value="{{ $list['key }}"{{ $oldvalue && in_array($list['key'], $oldvalue) ? ' checked' : '' }} {{ $require ? 'required' : '' }}> {{ $list['text }}
        </label>
    @endforeach
    @if($other)
        <input type="text" name="{{ $id }}_other" id="{{ $id }}_other" value="{{ $otheroldvalue }}">
    @endif
</fieldset>