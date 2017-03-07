<label class="control-label" for="{{ $id }}">{{ $title }}@if($require)<span class="text-danger">*</span>@endif</label>
<select class="form-control" name="{{ $id }}[]" id="{{ $id }}"{{ $type == 'SELECT_MULTIPLE' ? ' multiple' : '' }} {{ $require ? 'required' : '' }}>
@foreach($lists as $list)
    <option value="{{ $list['key'] }}"{{ $oldvalue && in_array($list['key'], $oldvalue) ? ' selected' : '' }}>{{ $list['text'] }}</option>
@endforeach
</select>