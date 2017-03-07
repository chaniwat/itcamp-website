{{-- FIXME change structure for form-horizontal (bt.v4) --}}
<label class="control-label" for="{{ $id }}">{{ $title }}@if($require)<span class="text-danger">*</span>@endif</label>
<textarea name="{{ $id }}" id="{{ $id }}" rows="5" style="resize: none;" {{ $require ? 'required' : '' }}>{{ $oldvalue }}</textarea>