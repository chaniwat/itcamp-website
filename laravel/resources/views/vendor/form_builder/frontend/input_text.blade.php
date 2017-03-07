{{-- FIXME change structure for form-horizontal (bt.v4) --}}
<label class="control-label" for="{{ $id }}">{{ $title }}@if($require)<span class="text-danger">*</span>@endif</label>
<input type="{{ $type }}" name="{{ $id }}" id="{{ $id }}" value="{{ $oldvalue }}" {{ $require ? 'required' : '' }}>